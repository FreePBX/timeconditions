<?php
//	License for all code of this FreePBX module can be found in the license file inside the module directory
//	Copyright 2015 Sangoma Technologies.
//
$timeconditions = timeconditions_list();
$timegroupslist = timeconditions_timegroups_list_groups();
$timegroups = array();
foreach ($timegroupslist as $tg) {
	$timegroups[$tg['value']] = $tg['text'];
}

foreach ($timeconditions as $tc) {
	$lrows .= '<tr>';
	$lrows .= '<td>';
	$lrows .= $tc['displayname'];
	$lrows .= '</td>';
	$lrows .= '<td>';
	$lrows .= $timegroups[$tc['time']];
	$lrows .= '</td>';
	$lrows .= '<td>';
	$lrows .= '<a href="?display=timeconditions&view=form&itemid='.$tc['timeconditions_id'].'"><i class="fa fa-edit"></i></a>&nbsp;';
	$lrows .= '<a href="?display=timeconditions&action=delete&itemid='.$tc['timeconditions_id'].'"><i class="fa fa-trash"></i></a>';
	if($tc['time'] != ''){
		$lrows .= '&nbsp;<a href="?display=timegroups&view=form&extdisplay='.$tc['time'].'"><i class="fa fa-clock-o"></i></a>';
	}
	$lrows .= '</td>';
	$lrows .= '</tr>';
}

?>
<table class="table table-striped">
	<thead>
		<th><?php echo _("Time Condition")?></th>
		<th><?php echo _("Linked Time Group")?></th>
		<th><?php echo _("Actions")?></th>
	</thead>
	<tbody>
		<?php echo $lrows ?>
	</tbody>
</table>