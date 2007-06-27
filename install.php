<?php

global $db;
global $amp_conf;

$autoincrement = (($amp_conf["AMPDBENGINE"] == "sqlite") || ($amp_conf["AMPDBENGINE"] == "sqlite3")) ? "AUTOINCREMENT":"AUTO_INCREMENT";

$sql = "CREATE TABLE IF NOT EXISTS timeconditions (
	timeconditions_id INTEGER NOT NULL PRIMARY KEY $autoincrement,
	displayname VARCHAR( 50 ) ,
	time VARCHAR( 100 ) ,
	truegoto VARCHAR( 50 ) ,
	falsegoto VARCHAR( 50 ),
	deptname VARCHAR( 50 )
)";

$check = $db->query($sql);
if(DB::IsError($check)) {
		die("Can not create `timeconditions` table: " .  $check->getMessage() .  "\n");
}

$results = array();
$sql = "SELECT timeconditions_id, truegoto, falsegoto FROM timeconditions";
$results = $db->getAll($sql, DB_FETCHMODE_ASSOC);
if (!DB::IsError($results)) { // error - table must not be there
	foreach ($results as $result) {
		$old_false_dest    = $result['falsegoto'];
		$old_true_dest     = $result['truegoto'];
		$timeconditions_id = $result['timeconditions_id'];

		$new_false_dest = merge_ext_followme(trim($old_false_dest));
		$new_true_dest  = merge_ext_followme(trim($old_true_dest));
		if (($new_true_dest != $old_true_dest) || ($new_false_dest != $old_false_dest)) {
			$sql = "UPDATE timeconditions SET truegoto = '$new_true_dest', falsegoto = '$new_false_dest' WHERE timeconditions_id = $timeconditions_id  AND truegoto = '$old_true_dest' AND falsegoto ='$old_false_dest'";
			$results = $db->query($sql);
			if(DB::IsError($results)) {
				die($results->getMessage());
			}
		}
	}
}

?>
