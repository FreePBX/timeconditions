<?php
//	License for all code of this FreePBX module can be found in the license file inside the module directory
//	Copyright 2015 Sangoma Technologies.
//

$timegroupslist = timeconditions_timegroups_list_groups();
foreach ($timegroupslist as $tg) {
	$tgid = $tg['value'];
	$time = timeconditions_timegroups_get_times($tgid);
	if(isset($time[0])){
		$time = explode("|", $time[0][1]);
	}else{
		$noval = _("NONE");
		$time = array($noval,$noval,$noval,$noval);
	}
	$lrows .= '<tr>';
	$lrows .= '<td>';
	$lrows .= $tg['text'];
	$lrows .= '</td>';
	$lrows .= '<td>';
	$lrows .= strtoupper($time[3]);
	$lrows .= '</td>';
	$lrows .= '<td>';
	$lrows .= $time[2];
	$lrows .= '</td>';
	$lrows .= '<td>';
	$lrows .= strtoupper($time[1]);
	$lrows .= '</td>';
	$lrows .= '<td>';
	$lrows .= $time[0];
	$lrows .= '</td>';
	$lrows .= '<td>';
	$lrows .= '<a href="?display=timegroups&view=form&extdisplay='.$tgid.'"><i class="fa fa-edit"></i></a>&nbsp;';
	$lrows .= '<a href="?display=timegroups&action=del&extdisplay='.$tgid.'"><i class="fa fa-trash"></i></a>';
	if($tc['time'] != ''){
		$lrows .= '&nbsp;<a href="?display=timegroups&view=form&extdisplay='.$tc['time'].'"><i class="fa fa-clock-o"></i></a>';
	}
	$lrows .= '</td>';
	$lrows .= '</tr>';
}

?>
<table class="table table-striped">
	<thead>
		<th><?php echo _("Time Group")?></th>
		<th><?php echo _("Month Range")?></th>
		<th><?php echo _("Days of Month")?></th>
		<th><?php echo _("Days")?></th>
		<th><?php echo _("Hours")?></th>
		<th><?php echo _("Actions")?></th>
	</thead>
	<tbody>
		<?php echo $lrows ?>
	</tbody>
</table>