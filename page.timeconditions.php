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

<div class="rnav" style="margin:15px 10px; padding: 5px; background: #e0e0ff; border: #2E78A7 solid 1px;">
	<?php echo _("Server time:")?> <span id="idTime">00:00:00</span>
</div>

<script>
var hour = <?php $l = localtime(); echo $l[2]?>;
var min  = <?php $l = localtime(); echo $l[1]?>;
var sec  = <?php $l = localtime(); echo $l[0]?>;

// happily stollen from http://www.aspfaq.com/show.asp?id=2300
function PadDigits(n, totalDigits) 
{ 
	n = n.toString(); 
	var pd = ''; 
	if (totalDigits > n.length) 
	{ 
		for (i=0; i < (totalDigits-n.length); i++) 
		{ 
			pd += '0'; 
		} 
	} 
	return pd + n.toString(); 
} 

function updateTime()
{
	sec++;
	if (sec==60)
	{
		min++;
		sec = 0;
	}	
		
	if (min==60)
	{
		hour++;
		min = 0;
	}

	if (hour==24)
	{
		hour = 0;
	}
	
	document.getElementById("idTime").innerHTML = PadDigits(hour,2)+":"+PadDigits(min,2)+":"+PadDigits(sec,2);
	setTimeout('updateTime()',1000);
}

updateTime();
</script>


<div class="content">
<?php
if ($action == 'delete') {
	echo '<br><h3>'._("Time Condition").' '.$itemid.' '._("deleted").'!</h3>';
} else {
	if ($itemid){ 
		//get details for this time condition
		$thisItem = timeconditions_get($itemid);
	}

	$delURL = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&action=delete';
?>

	<h2><?php echo ($itemid ? _("Time Condition:")." ". $itemid : _("Add Time Condition")); ?></h2>
<?php		if ($itemid){ ?>
	<p><a href="<?php echo $delURL ?>"><?php echo _("Delete Time Condition")?> <?php echo $itemid; ?></a></p>
<?php		} ?>
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
		<td><input type="text" name="displayname" value="<?php echo (isset($thisItem['displayname']) ? $thisItem['displayname'] : ''); ?>"></td>
	</tr>
	<tr>
		<td><a href="#" class="info"><?php echo _("Time to match:")?><span><?php echo _("time range|days of week|days of month|months<br><br>you can use an * as a wildcard.<br><br>ex: <b>9:00-17:00|mon-fri|*|*</b>")?></span></a></td>
               <?php
                   // ----- Load Time Pattern Variables -----
		if (isset($thisItem)) {
			list($time_hour, $time_wday, $time_mday, $time_month) = explode( '|', $thisItem['time'] );
		} else {
			list($time_hour, $time_wday, $time_mday, $time_month) = Array('*','-','-','-');
		}
			
               ?>
               <tr>
                   <td><?php echo _("Time to start:")?></td>
                   <td>
                       <?php
                           // Hour could be *, hh:mm, hh:mm-hhmm
                           if ( $time_hour === '*' ) {
                               $hour_start = $hour_finish = '-';
                               $minute_start = $minute_finish = '-';
			   } else {
                               list($hour_start_string, $hour_finish_string) = explode('-', $time_hour);
                               list($hour_start, $minute_start) = explode( ':', $hour_start_string);
                               list($hour_finish, $minute_finish) = explode( ':', $hour_finish_string);
                               if ( !$hour_finish ) $hour_finish = $hour_start;
                               if ( !$minute_finish ) $minute_finish = $minute_start;
                           }
                       ?>
                        <select name="hour_start"/>
                        <?php
                           $default = '';
                            if ( $hour_start === '-' ) $default = ' selected';
                            echo "<option value=\"-\" $default>-";
                            for ($i = 0 ; $i < 24 ; $i++) {
                               $default = "";
                               if ( sprintf("%02d", $i) === $hour_start ) $default = ' selected';
                                echo "<option value=\"$i\" $default> ".sprintf("%02d", $i);
                            }
                        ?>
                        </select>
                       <nbsp>:<nbsp>
                        <select name="minute_start"/>
                        <?php
                           $default = '';
                            if ( $minute_start === '-' ) $default = ' selected';
                            echo "<option value=\"-\" $default>-";
                            for ($i = 0 ; $i < 60 ; $i++) {
                                $default = "";
                                if ( sprintf("%02d", $i) === $minute_start ) $default = ' selected';
                                echo "<option value=\"$i\" $default> ".sprintf("%02d", $i);
                            }
                        ?>
                        </select>
                    </td>
               </tr>
               <tr>
                   <td><?php echo _("Time to finish:")?></td>
                   <td>
                        <select name="hour_finish"/>
                        <?php
                           $default = '';
                            if ( $hour_finish === '-' ) $default = ' selected';
                            echo "<option value=\"-\" $default>-";
                            for ($i = 0 ; $i < 24 ; $i++) {
                                $default = "";
                                if ( sprintf("%02d", $i) === $hour_finish) $default = ' selected';
                                echo "<option value=\"$i\" $default> ".sprintf("%02d", $i);
                            }
                        ?>
                        </select>
                       <nbsp>:<nbsp>
                        <select name="minute_finish"/>
                        <?php
                            $default = '';
                            if ( $minute_finish === '-' ) $default = ' selected';
                            echo "<option value=\"-\" $default>-";
                            for ($i = 0 ; $i < 60 ; $i++) {
                               $default = '';
                                if ( sprintf("%02d", $i) === $minute_finish ) $default = ' selected';
                                echo "<option value=\"$i\" $default> ".sprintf("%02d", $i);
                            }
                        ?>
                        </select>
                    </td>
               </tr>
                <tr>
                   <?php 
                         // WDay could be *, day, day1-day2
                         if ( $time_wday != '*' ) {
                             list($wday_start, $wday_finish) = explode('-', $time_wday);
                             if ( !$wday_finish) $wday_finish = $wday_start;
                         } else {
                             $wday_start = $wday_finish = '-';
                         }
                    ?>
                   <td><?php echo _("Week Day Start:")?></td>
                   <td>
                       <select name="wday_start"/>
                           <?php 
                               if ( $wday_start == '-' ) { $default = ' selected'; }
                               else {$default = '';}
                               echo "<option value=\"-\" $default>-";
 
                               if ( $wday_start == 'mon' ) { $default = ' selected'; }
                                else {$default = '';}
                               echo "<option value=\"mon\" $default>" . _("Monday");

                                if ( $wday_start == 'tue' ) { $default = ' selected'; }
                               else {$default = '';}
                                echo "<option value=\"tue\" $default>" . _("Tuesday");

                                if ( $wday_start == 'wed' ) { $default = ' selected'; }
                               else {$default = '';}
                                echo "<option value=\"wed\" $default>" . _("Wednesday");

                                if ( $wday_start == 'thu' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"thu\" $default>" . _("Thursday");

                                if ( $wday_start == 'fri' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"fri\" $default>" . _("Friday");

                                if ( $wday_start == 'sat' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"sat\" $default>" . _("Saturday");

                               if ( $wday_start == 'sun' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"sun\" $default>" . _("Sunday");
                       ?>
           </td>
               </tr>
               <tr>
                   <td><?php echo _("Week Day finish:")?></td>
                   <td>
                       <select name="wday_finish"/>
                       <?php 
                               if ( $wday_finish == '-' ) { $default = ' selected'; }
                               else {$default = '';}
                               echo "<option value=\"-\" $default>-";
 
                               if ( $wday_finish == 'mon' ) { $default = ' selected'; }
                                else {$default = '';}
                               echo "<option value=\"mon\" $default>" . _("Monday");

                                if ( $wday_finish == 'tue' ) { $default = ' selected'; }
                               else {$default = '';}
                                echo "<option value=\"tue\" $default>" . _("Tuesday");

                                if ( $wday_finish == 'wed' ) { $default = ' selected'; }
                               else {$default = '';}
                                echo "<option value=\"wed\" $default>" . _("Wednesday");

                                if ( $wday_finish == 'thu' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"thu\" $default>" . _("Thursday");

                                if ( $wday_finish == 'fri' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"fri\" $default>" . _("Friday");

                                if ( $wday_finish == 'sat' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"sat\" $default>" . _("Saturday");

                               if ( $wday_finish == 'sun' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"sun\" $default>" . _("Sunday");
                       ?>
                   </td>
                </tr>
                <tr>
                   <td><?php echo _("Month Day start:")?></td>
                    <?php
                         // MDay could be *, day, day1-day2
                         if ( $time_mday != '*' ) {
                             list($mday_start, $mday_finish) = explode('-', $time_mday);
                             if ( !$mday_finish) $mday_finish = $mday_start;
                         } else {
                             $mday_start = $mday_finish = '-';
                         }
                   ?>
                  <td>
                        <select name="mday_start"/>
                         <?php
                            $default = '';
                            if ( $mday_start == '-' ) $default = ' selected';
                            echo "<option value=\"-\" $default>-";
                            for ($i = 1 ; $i < 32 ; $i++) {
                                $default = '';
                                if ( $i == $mday_start ) $default = ' selected';
                                echo "<option value=\"$i\" $default> $i";
                            }
                        ?>
                        </select>
                    </td>
               <tr>
                   <td><?php echo _("Month Day finish:")?></td>
                  <td>
                        <select name="mday_finish"/>
                        <?php
                            $default = '';
                            if ( $mday_finish == '-' ) $default = ' selected';
                            echo "<option value=\"-\" $default>-";
                            for ($i = 1 ; $i < 32 ; $i++) {
                                $default = '';
                                if ( $i == $mday_finish ) $default = ' selected';
                                echo "<option value=\"$i\" $default> $i";
                            }
                        ?>
                        </select>
                    </td>
               </tr>
                <tr>
                   <td><?php echo _("Month start:")?></td>
                     <?php
                         // Month could be *, month, month1-month2
                         if ( $time_month != '*' ) {
                             list($month_start, $month_finish) = explode('-', $time_month);
                             if ( !$month_finish) $month_finish = $month_start;
                         } else {
                             $month_start = $month_finish = '-';
                         }
                   ?>
                  <td>
                        <select name="month_start"/>
                            <?php   
                                if ( $month_start == '-' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"-\" $default>-";
                                if ( $month_start == 'jan' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"jan\" $default>" . _("January");
                               
                                if ( $month_start == 'feb' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"feb\" $default>" . _("February");

                                if ( $month_start == 'mar' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"mar\" $default>" . _("March");
                               
                                if ( $month_start == 'apr' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"apr\" $default>" . _("April");
 
                               if ( $month_start == 'may' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"may\" $default>" . _("May");
                               
                                if ( $month_start == 'jun' ) { $default = ' selected'; }
                               else {$default = '';}
                                echo "<option value=\"jun\" $default>" . _("June");

                                if ( $month_start == 'jul' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"jul\" $default>" . _("July");
                               
                                if ( $month_start == 'aug' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"aug\" $default>" . _("August");
 
                               if ( $month_start == 'sep' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"sep\" $default>" . _("September");
                               
                                if ( $month_start == 'oct' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"oct\" $default>" . _("October");
                                if ( $month_start == 'nov' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"nov\" $default>" . _("November");
                               
                                if ( $month_start == 'dec' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"dec\" $default>" . _("December");
                         ?>
                       </select>
                     </td>
        </tr>
                <tr>
                    <td><?php echo _("Month finish:")?></td>
                    <td>
                        <select name="month_finish"/>
                        <?php   
                                if ( $month_finish == '-' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"-\" $default>-";
                                if ( $month_finish == 'jan' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"jan\" $default>" . _("January");
                               
                                if ( $month_finish == 'feb' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"feb\" $default>" . _("February");

                                if ( $month_finish == 'mar' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"mar\" $default>" . _("March");
                               
                                if ( $month_finish == 'apr' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"apr\" $default>" . _("April");
 
                               if ( $month_finish == 'may' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"may\" $default>" . _("May");
                               
                                if ( $month_finish == 'jun' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"jun\" $default>" . _("June");

                                if ( $month_finish == 'jul' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"jul\" $default>" . _("July");
                               
                                if ( $month_finish == 'aug' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"aug\" $default>" . _("August");
 
                               if ( $month_finish == 'sep' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"sep\" $default>" . _("September");
                               
                               if ( $month_finish == 'oct' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"oct\" $default>" . _("October");

                                if ( $month_finish == 'nov' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"nov\" $default>" . _("November");
                               
                                if ( $month_finish == 'dec' ) { $default = ' selected'; }
                                else {$default = '';}
                                echo "<option value=\"dec\" $default>" . _("December");
                         ?>
                         </select>
                     </td>
                </tr>
	</tr>
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
		<td colspan="2"><br><h6><input name="Submit" type="submit" value="<?php echo _("Submit Changes")?>"></h6></td>		
	</tr>
	</table>
<script language="javascript">
<!--

var theForm = document.edit;
theForm.displayname.focus();

function edit_onsubmit() {
	var msgInvalidTimeCondName = "<?php echo _('Please enter a valid Time Conditions Name'); ?>";
	var msgInvalidTimeMatch = "<?php echo _('Please enter the Time to Match, or set all to - to match all times.'); ?>";
	var msgInvalidDay = "<?php echo _('Please select BOTH or NO days, not just one.'); ?>";
	var msgInvalidMday = "<?php echo _('Please select BOTH or NO days of the month, not just one.'); ?>";
	var msgInvalidMth = "<?php echo _('Please select BOTH or NO months, not just one.'); ?>";

	
	defaultEmptyOK = false;
	if (!isAlphanumeric(theForm.displayname.value))
		return warnInvalid(theForm.displayname, msgInvalidTimeCondName);
	
	// Check to see that they're either all '-' or all numbers.
	if ((theForm.hour_start.value == "-" || theForm.hour_finish.value == "-"  || theForm.minute_start.value == "-" || theForm.minute_finish.value == "-") && (theForm.hour_start.value != "-" || theForm.hour_finish.value != "-"  || theForm.minute_start.value != "-" || theForm.minute_finish.value != "-")) 
		return warnInvalid(theForm.displayname, msgInvalidTimeMatch);

	if ((theForm.wday_start.value == "-" || theForm.wday_finish.value == "-") && (theForm.wday_start.value != "-" ||theForm.wday_finish.value != "-" ))
		return warnInvalid(theForm.displayname, msgInvalidDay);

	if ((theForm.mday_start.value == "-" || theForm.mday_finish.value == "-") && (theForm.mday_start.value != "-" || theForm.mday_finish.value != "-" ))
		return warnInvalid(theForm.displayname, msgInvalidMday);

	if ((theForm.month_start.value == "-" || theForm.month_finish.value == "-") && (theForm.month_start.value != "-" || theForm.month_finish.value != "-" ))
		return warnInvalid(theForm.displayname, msgInvalidMth);
		
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
