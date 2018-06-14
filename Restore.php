<?php
namespace FreePBX\modules\Timeconditions;
use FreePBX\modules\Backup as Base;
class Restore Extends Base\RestoreBase{
  public function runRestore($jobid){
    $timecond = $this->FreePBX->Timeconditions();
    $configs = $this->gerConfigs();
    foreach ($configs['timegroups'] as $timegroup) {
        $timecond->addTimeGroup($timegroup['description'], $timegroup['times']);
    }
    foreach ($configs['timeconditions'] as $condition) {
        $timecond->addTimecondition($condition);
    }
  }
}