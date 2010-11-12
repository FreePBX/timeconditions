<?php

$list = timeconditions_list(true);
if(is_array($list)) foreach ($list as $item) {
	$id = $item['timeconditions_id'];
  $fcc = new featurecode('timeconditions', 'toggle-mode-'.$id);
	$fcc->delete();
	unset($fcc);	
}

sql('DROP TABLE IF EXISTS `timegroups_groups`');
sql('DROP TABLE IF EXISTS `timegroups_detail`');
sql('DROP TABLE IF EXISTS `timeconditions`');
