<?php

namespace FreePBX\modules\Timeconditions;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
class Job implements \FreePBX\Job\TaskInterface {
	public static function run(InputInterface $input, OutputInterface $output) {
		$tc = \FreePBX::Timeconditions();
		$calendar = \FreePBX::Calendar();
		$astman = \FreePBX::create()->astman;
		$conditions = $tc->listTimeconditions();
		$groups = $tc->listTimeGroups();
		$debug = false;
		foreach($conditions as $item){
			$output->writeln("==Working with TimeCondition:".$item['displayname']."==");
			if(!$item['invert_hint']) {
				$not_inuse = 'NOT_INUSE'; //true && deactivated
				$inuse = 'INUSE'; //false && activated
				$output->writeln("INVERTED BLF: false (NOT_INUSE = ".$not_inuse." & INUSE = ".$inuse.")");
			} else {
				$not_inuse = 'INUSE'; //true && deactivated
				$inuse = 'NOT_INUSE'; //false && activated
				$output->writeln("INVERTED BLF: true (NOT_INUSE = ".$not_inuse." & INUSE = ".$inuse.")");
			}
			$tco = $astman->database_get("TC",$item['timeconditions_id']);
			$sticky = false;
			switch($tco) {
				case "true_sticky":
					$sticky = true;
				case "true":
					$override = true;
					$output->writeln("OVERRIDE MODE: True (".$not_inuse.")");
				break;
				case "false_sticky":
					$sticky = true;
				case "false":
					$override = false;
					$output->writeln("OVERRIDE MODE: False (".$inuse.")");
				break;
				default:
					$override = null;
					$output->writeln("OVERRIDE MODE: not set");
				break;
			}
			$timeMatch = false;
			if($item['mode'] == 'time-group') {
				$tctimes = timeconditions_timegroups_get_times($item['time'],null,$item['timeconditions_id']);
				foreach($tctimes as $tctime){
					if($tc->checkTime($tctime[1])){
						$timeMatch = true;
						if(!$debug) {
							//no need to check other times if we matched
							//if debug is true run through all of them
							break;
						}
						$output->writeln("=>".$tctime[1]. " is now");
					} else {
						$output->writeln("=>".$tctime[1]. " is not now");
					}
				}
			} else {
				$item['timezone'] = ($item['timezone'] !== 'default') ? $item['timezone'] : \FreePBX::View()->getTimezone();
				if(!empty($item['calendar_group_id'])) {
					$timeMatch = $calendar->matchGroup($item['calendar_group_id'],null,$item['timezone']);
					$next = $calendar->getNextEventByGroup($item['calendar_group_id'],null,$item['timezone']);
				} else {
					$timeMatch = $calendar->matchCalendar($item['calendar_id'],null,$item['timezone']);
					$next = $calendar->getNextEvent($item['calendar_id'],null,$item['timezone']);
				}
				if($timeMatch) {
					$output->writeln("=>".$next['startdate']." ".$next['starttime']." is now");
				} else {
					$output->writeln("=>".$next['startdate']." ".$next['starttime']." is not now");
				}
			}
			$output->writeln("TIME MATCHED: ".(($timeMatch)?"True":"False")." (".(($timeMatch)?$not_inuse:$inuse).")");

			if(!is_null($override)) {
				if($sticky || ($timeMatch !== $override)) {
					$output->writeln("BLF MODE: Overridden to ".(($override)?"True":"False")." (".(($override)?$not_inuse:$inuse).")");
				} else {
					$output->writeln("BLF MODE: ".(($timeMatch)?"True":"False")." [Reset Override as time match is the same as override mode]");
					$astman->database_put("TC",$item['timeconditions_id'],"");
				}
				$timeMatch = $override;
			} elseif($timeMatch) {
				$output->writeln("BLF MODE: True (".$not_inuse.")");
			} else {
				$output->writeln("BLF MODE: False (".$inuse.")");
			}
			if($timeMatch) {
				$response = $astman->send_request('Command',array('Command'=>"devstate change Custom:TC".$item['timeconditions_id']." ".$not_inuse));
			} else {
				$response = $astman->send_request('Command',array('Command'=>"devstate change Custom:TC".$item['timeconditions_id']." ".$inuse));
			}
			$output->writeln($response['data']);
			$output->writeln("");
		}
		$tc->updateCron();
		return true;
	}
}