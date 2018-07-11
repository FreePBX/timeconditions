<?php
namespace FreePBX\modules\Timeconditions;
use FreePBX\modules\Backup as Base;
class Backup Extends Base\BackupBase{
  public function runBackup($id,$transaction){
    $timecond = $this->FreePBX->Timeconditions();
    $configs = [
        'timeconditions' => $timecond->listTimeconditions(),
        'timegroups' => $timecond->dumpTimegroups(),
    ];
    $this->addDependency('cel');
    $this->addDependency('calendar');
    $this->addConfigs($configs);
  }
}
