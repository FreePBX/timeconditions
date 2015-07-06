<?php
//	License for all code of this FreePBX module can be found in the license file inside the module directory
//	Copyright 2015 Sangoma Technologies.
//
?>
<span class="list-group-item">
	<b><?php echo _("Server time:")?></b> <span id="idTime">Not received</span>
</span>
<a href="config.php?display=timegroups" class="list-group-item <?php echo ($request['view'] == ''? 'hidden':'')?>"><i class="fa fa-list"></i>&nbsp; <?php echo _("List Time Groups") ?></a>
<a href="config.php?display=timeconditions" class="list-group-item"><i class="fa fa-list"></i>&nbsp; <?php echo _("List Time Conditions") ?></a>
<a href="config.php?display=timegroups&view=form" class="list-group-item <?php echo ($request['view'] == 'form'? 'hidden':'')?>"><i class="fa fa-plus"></i>&nbsp; <?php echo _("Add Time Group") ?></a>
<?php
if($request['view'] == 'form'){
	echo '<table id="bnavgrid"></table>';
}
?>
