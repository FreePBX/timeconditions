<?php
namespace FreePBX\modules\Timeconditions;
use FreePBX\modules\Backup as Base;
class Restore Extends Base\RestoreBase{
  public function runRestore($jobid){
    $timecond = $this->FreePBX->Timeconditions();
    $configs = reset($this->getConfigs());
    foreach ($configs['timegroups'] as $timegroup) {
        $timecond->addTimeGroup($timegroup['description'], $timegroup['times']);
    }
    foreach ($configs['timeconditions'] as $condition) {
        $timecond->addTimecondition($condition);
    }
  }
  
  public function processLegacy($pdo, $data, $tables, $unknownTables, $tmpfiledir){
    $tables = array_flip($tables+$unknownTables);
    if(!isset($tables['timeconditions'])){
      return $this;
    }
    $bmo = $this->FreePBX->Timeconditions;
    $bmo->setDatabase($pdo);
    $configs = [
      'timeconditions' => $timecond->listTimeconditions(),
      'timegroups' => $timecond->dumpTimegroups(),
    ];
    $bmo->resetDatabase();
    foreach ($configs['timegroups'] as $timegroup) {
      $bmo->addTimeGroup($timegroup['description'], $timegroup['times']);
    }
    foreach ($configs['timeconditions'] as $condition) {
      $bmo->addTimecondition($condition);
    }
    return $this;
  }
}
