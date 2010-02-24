<?php /* $Id */
//Copyright (C) 2004 Coalescent Systems Inc. (info@coalescentsystems.ca)
//
//This program is free software; you can redistribute it and/or
//modify it under the terms of the GNU General Public License
//as published by the Free Software Foundation; either version 2
//of the License, or (at your option) any later version.
//
//This program is distributed in the hope that it will be useful,
//but WITHOUT ANY WARRANTY; without even the implied warranty of
//MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//GNU General Public License for more details.


isset($_REQUEST['action'])?$action = $_REQUEST['action']:$action='';
//the item we are currently displaying
isset($_REQUEST['itemid'])?$itemid=mysql_real_escape_string($_REQUEST['itemid']):$itemid='';

$dispnum = "timeconditions"; //used for switch on config.php
$tabindex = 0;

//if submitting form, update database
switch ($action) {
	case "add":
		timeconditions_add($_POST);
		needreload();
		redirect_standard();
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

</div> <!-- end content div so we can display rnav properly-->

<!-- right side menu -->
<div class="rnav"><ul>
    <li><a id="<?php echo ($itemid=='' ? 'current':'') ?>" href="config.php?display=<?php echo urlencode($dispnum)?>"><?php echo _("Add Time Condition")?></a></li>
<?php
if (isset($timeconditions)) {
	foreach ($timeconditions as $timecond) {
		echo "<li><a id=\"".($itemid==$timecond['timeconditions_id'] ? 'current':'')."\" href=\"config.php?display=".urlencode($dispnum)."&itemid=".urlencode($timecond['timeconditions_id'])."\">{$timecond['displayname']}</a></li>";
	}
}
?>
</ul></div>

<div class="content">
<?php
if ($action == 'delete') {
	echo '<br><h3>'._("Time Condition").' '.$itemid.' '._("deleted").'!</h3>';
} else {
?>
	<h2><?php echo ($itemid ? _("Time Condition:")." ". $itemid : _("Add Time Condition")); ?></h2>
<?php		
	if ($itemid){ 
		$thisItem = timeconditions_get($itemid);
		$delURL = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&action=delete';
		$tlabel = sprintf(_("Delete Time Condition: %s"),trim($thisItem['displayname']) == '' ? $itemid : $thisItem['displayname']." ($itemid) ");
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
	} 
?>
	<form autocomplete="off" name="edit" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return edit_onsubmit();">
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
		<td><a href="#" class="info"><?php echo _("Time Group:")?><span><?php echo _("Select a Time Group created under Time Groups. Matching times will be sent to matching destination. If no group is selected, call will always go to no-match destination.")?></span></a></td>
		<td><?php echo timeconditions_timegroups_drawgroupselect('time', (isset($thisItem['time']) ? $thisItem['time'] : ''), true, ''); ?></td>
	</tr>
<?php
	if (isset($thisItem['time']) && $thisItem['time'] != '') {

		$grpURL = $_SERVER['PHP_SELF'].'?display=timegroups&extdisplay='.$thisItem['time'];
		$tlabel = _("Goto Current Time Group");
		$label = '<span><img width="16" height="16" border="0" title="'.$tlabel.'" alt="" src="images/time_edit.png"/>&nbsp;'.$tlabel.'</span>';
?>
		<tr>
			<td> <a href="<?php echo $grpURL ?>"><?php echo "&nbsp;".$label; ?></a></td>
		<tr>
<?php
	}
	// implementation of module hook
	// object was initialized in config.php
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
<script language="javascript">
<!--

var theForm = document.edit;
theForm.displayname.focus();

function edit_onsubmit() {
	var msgInvalidTimeCondName = "<?php echo _('Please enter a valid Time Conditions Name'); ?>";
	var msgInvalidTimeGroup = "<?php echo _('You have not selected a time group to associate with this timecondition. It will go to the un-matching destination until you update it with a valid group'); ?>";
	
	defaultEmptyOK = false;
	if (!isAlphanumeric(theForm.displayname.value))
		return warnInvalid(theForm.displayname, msgInvalidTimeCondName);
	if (isEmpty(theForm.time.value))
		return confirm(msgInvalidTimeGroup)
	
	if (!validateDestinations(edit,2,true))
		return false;
	
	return true;
}


//-->
</script>


	</form>
<?php		
} //end if action == delete
?>
