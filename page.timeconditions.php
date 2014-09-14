<?php /* $Id */
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }

isset($_REQUEST['action'])?$action = $_REQUEST['action']:$action='';
//the item we are currently displaying
isset($_REQUEST['itemid'])?$itemid=$db->escapeSimple($_REQUEST['itemid']):$itemid='';

$invert_hint = isset($_POST['invert_hint'])?$_POST['invert_hint']:'0';
$fcc_password = isset($_POST['fcc_password'])?$_POST['fcc_password']:'';

$dispnum = "timeconditions"; //used for switch on config.php
$tabindex = 0;

//if submitting form, update database
switch ($action) {
	case "add":
		$_REQUEST['itemid'] = timeconditions_add($_POST);
		needreload();
		redirect_standard('itemid');
	break;
	case "delete":
		timeconditions_del($itemid);
		needreload();
		redirect_standard();
	break;
	case "edit":  //just delete and re-add
		timeconditions_edit($itemid,$_POST);
		needreload();
		redirect_standard('itemid');
	break;
}


//get list of time conditions
$timeconditions = timeconditions_list();
?>

<div class="rnav"><ul id="timelist">
    <li><a id="<?php echo ($itemid=='' ? 'current':'') ?>" href="config.php?display=<?php echo urlencode($dispnum)?>"><?php echo _("Add Time Condition")?></a></li>
<?php
if (isset($timeconditions)) {
	foreach ($timeconditions as $timecond) {
		echo "<li id=\"timelist".$timecond['timeconditions_id']."\"><a id=\"".($itemid==$timecond['timeconditions_id'] ? 'current':'')."\" href=\"config.php?display=".urlencode($dispnum)."&itemid=".urlencode($timecond['timeconditions_id'])."\">{$timecond['displayname']}</a></li>";
	}
}
?>
</ul></div>

<?php
if ($action == 'delete') {
	echo '<br><h3>'._("Time Condition").' '.$itemid.' '._("deleted").'!</h3>';
} else {
?>
	<h2><?php echo ($itemid ? _("Time Condition:")." ". $itemid : _("Add Time Condition")); ?></h2>
<?php
	if ($itemid){
		$fcc = new featurecode('timeconditions', 'toggle-mode-'.$itemid);
		$code = $fcc->getCodeActive();
		unset($fcc);

		$thisItem = timeconditions_get($itemid);
		$delURL = '?'.$_SERVER['QUERY_STRING'].'&action=delete';
		$tlabel = sprintf(_("Delete Time Condition: %s"),trim($thisItem['displayname']) == '' ? $code : $thisItem['displayname']." ($code) ");
		$label = '<span><img width="16" height="16" border="0" title="'.$tlabel.'" alt="" src="images/core_delete.png"/>&nbsp;'.$tlabel.'</span>';
?>
		<a href="<?php echo $delURL ?>"><?php echo $label; ?></a><br />
<?php
		$usage_list = framework_display_destination_usage(timeconditions_getdest($itemid));
		if (!empty($usage_list)) {
?>
			<a href="#" class="info"><?php echo $usage_list['text']?>:<span><?php echo $usage_list['tooltip']?></span></a>
<?php
		}
	$invert_hint = $thisItem['invert_hint'] == '1' ? '1' : '0';
	$fcc_password = $thisItem['fcc_password'];
    $tccode = $thisItem['tccode'] === false ? '' :  $thisItem['tccode'];
	} else {
    $tccode = '';
  }
  $tcval = $thisItem['tcval'];
?>
	<form autocomplete="off" name="edit" action="" method="post" onsubmit="return edit_onsubmit();">
	<input type="hidden" name="display" value="<?php echo $dispnum?>">
	<input type="hidden" name="action" value="<?php echo ($itemid ? 'edit' : 'add') ?>">
	<input type="hidden" name="deptname" value="<?php echo $_SESSION["AMP_user"]->_deptname ?>">
	<table>
	<tr><td colspan="2"><h5><?php echo ($itemid ? _("Edit Time Condition") : _("Add Time Condition")) ?><hr></h5></td></tr>

<?php		if ($itemid){ ?>
		<input type="hidden" name="account" value="<?php echo $itemid; ?>">
<?php		}?>

	<tr>
		<td><a href="#" class="info"><?php echo _("Time Condition name:")?><span><?php echo _("Give this Time Condition a brief name to help you identify it.")?></span></a></td>
		<td><input type="text" name="displayname" value="<?php echo (isset($thisItem['displayname']) ? $thisItem['displayname'] : ''); ?>" tabindex="<?php echo ++$tabindex;?>"></td>
	</tr>
	<tr>
		<td><a href="#" class="info"><?php echo _("Override Code Pin")?><span><?php echo sprintf(_("If set dialing the feature code will require a pin to change the override state"),$tcval)?></span></a></td>
		<td>
			<input name="fcc_password" type="number" value="<?php echo $fcc_password; ?>"  tabindex="<?php echo ++$tabindex;?>"/>
		</td>
	</tr>
	<tr>
		<td><a href="#" class="info"><?php echo _("Invert BLF Hint")?><span><?php echo sprintf(_("If set the hint will be INUSE if the time condition is matched, and NOT_INUSE if it fails"),$tcval)?></span></a></td>
		<td>
			<input name="invert_hint" type="checkbox" value="1" <?php echo ($invert_hint == '1' ? 'checked' : ''); ?>  tabindex="<?php echo ++$tabindex;?>"/>
		</td>
	</tr>
<?php
  if ($itemid && $thisItem['tcstate'] !== false) {
    $tcstate = $thisItem['tcstate'] == '' ? 'auto' : $thisItem['tcstate'];
    switch ($tcstate) {
      case 'auto':
        $state_msg = _('No Override');
      break;
      case 'true':
        $state_msg = _('Temporary Override matching state');
      break;
      case 'true_sticky':
        $state_msg = _('Permanent Override matching state');
      break;
      case 'false':
        $state_msg = _('Temporary Override unmatching state');
      break;
      case 'false_sticky':
        $state_msg = _('Permanent Override unmatching state');
      break;
      default:
        $state_msg = _('Unknown State');
      break;
    }
?>
	<tr>
		<td><a href="#" class="info"><?php echo _("Current Override:")?><span><?php echo _("Indicates the current state of this Time Condition. If it is in a Temporary Override state, it will automatically resume at the next time transition based on the associated Time Group. If in a Permanent Override state, it will stay in that state until changed here or through other means such as external XML applications on your phone. If No Override then it functions normally based on the time schedule.")?></span></a></td>
		<td><?php echo $state_msg; ?></td>
	</tr>
  <tr>
		<td><a href="#" class="info"><?php echo _("Change Override:")?><span><?php echo sprintf(_("This Time Condition can be set to Temporarily go to the 'matched' or 'unmatched' destination in which case the override will automatically reset once the current time span has elapsed. If set to Permanent it will stay overridden until manually reset. All overrides can be removed with the Reset Override option. Temporary Overrides can also be toggled with the %s feature code, which will also remove a Permanent Override if set but can not set a Permanent Override which must be done here or with other applications such as an XML based phone options."),$tcval)?></span></a></td>
    <td>
      <select name="tcstate_new" tabindex="<?php echo ++$tabindex;?>">
        <option value="unchanged" SELECTED><?php echo _("Unchanged");?></option>
        <option value="auto" ><?php echo _("Reset Override");?></option>
        <option value="true" ><?php echo _("Temporary matched");?></option>
        <option value="true_sticky" ><?php echo _("Permanently matched");?></option>
        <option value="false" ><?php echo _("Temporary unmatched");?></option>
        <option value="false_sticky" ><?php echo _("Permanently unmatched");?></option>
			</select>
		</td>
	</tr>
<?php } ?>
	<tr>
		<td><a href="#" class="info"><?php echo _("Time Group:")?><span><?php echo _("Select a Time Group created under Time Groups. Matching times will be sent to matching destination. If no group is selected, call will always go to no-match destination.")?></span></a></td>
		<td><?php echo timeconditions_timegroups_drawgroupselect('time', (isset($thisItem['time']) ? $thisItem['time'] : ''), true, ''); ?></td>
	</tr>
<?php
	if (isset($thisItem['time']) && $thisItem['time'] != '') {

		$grpURL = '?display=timegroups&extdisplay='.$thisItem['time'];
		$tlabel = _("Goto Current Time Group");
		$label = '<span><img width="16" height="16" border="0" title="'.$tlabel.'" alt="" src="images/time_edit.png"/>&nbsp;'.$tlabel.'</span>';
?>
		<tr>
			<td> <a href="<?php echo $grpURL ?>"><?php echo "&nbsp;".$label; ?></a></td>
		<tr>
<?php
	}
	// implementation of module hook
	$module_hook = moduleHook::create();
	echo $module_hook->hookHtml;
?>
	<tr><td colspan="2"><br><h5><?php echo _("Destination if time matches")?>:<hr></h5></td></tr>
<?php
//draw goto selects
if (isset($thisItem)) {
	echo drawselects($thisItem['truegoto'],0);
} else {
	echo drawselects(null, 0);
}
?>

	<tr><td colspan="2"><br><h5><?php echo _("Destination if time does not match")?>:<hr></h5></td></tr>

<?php
//draw goto selects
if (isset($thisItem)) {
	echo drawselects($thisItem['falsegoto'],1);
} else {
	echo drawselects(null, 1);
}
?>

	<tr>
		<td colspan="2"><br><h6><input name="Submit" type="submit" value="<?php echo _("Submit")?>" tabindex="<?php echo ++$tabindex;?>"></h6></td>
	</tr>
	</table>
	</form>
<?php
} //end if action == delete
?>
