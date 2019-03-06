<?php
namespace FreePBX\modules\Timeconditions;
use FreePBX\modules\Backup as Base;
class Backup Extends Base\BackupBase{
	public function runBackup($id,$transaction){
		$this->addDependency('cel');
		$this->addDependency('calendar');
		$this->addConfigs([
			'tables' => $this->dumpTables(),
			'features' => $this->dumpFeatureCodes()
		]);
	}
}
