<?php /* $Id: install.php $ */
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }

$table = \FreePBX::Database()->migrate("timeconditions");
$cols = array (
  'timeconditions_id' =>
  array (
    'type' => 'integer',
    'primaryKey' => true,
    'autoincrement' => true,
  ),
  'displayname' =>
  array (
    'type' => 'string',
    'length' => '50',
    'notnull' => false,
  ),
	'mode' =>
	array (
		'type' => 'string',
		'length' => '20',
		'notnull' => false,
		'default' => 'time-group'
	),
  'time' =>
  array (
    'type' => 'integer',
    'notnull' => false,
  ),
	'calendar' =>
	array (
		'type' => 'string',
		'length' => '150',
		'notnull' => false,
	),
  'truegoto' =>
  array (
    'type' => 'string',
    'length' => '50',
    'notnull' => false,
  ),
  'falsegoto' =>
  array (
    'type' => 'string',
    'length' => '50',
    'notnull' => false,
  ),
  'deptname' =>
  array (
    'type' => 'string',
    'length' => '50',
    'notnull' => false,
  ),
  'generate_hint' =>
  array (
    'type' => 'boolean',
    'notnull' => false,
    'default' => '0',
  ),
  'invert_hint' =>
  array (
    'type' => 'boolean',
    'notnull' => false,
    'default' => '0',
  ),
  'fcc_password' =>
  array (
    'type' => 'string',
    'length' => '20',
    'notnull' => false,
    'default' => '',
  ),
  'priority' =>
  array (
    'type' => 'string',
    'length' => '50',
    'notnull' => false,
  ),
  'timezone' =>
  array (
    'type' => 'string',
    'length' => '255',
    'notnull' => false,
  ),
);


$indexes = array (
);
$table->modify($cols, $indexes);
unset($table);

$table = \FreePBX::Database()->migrate("timegroups_groups");
$cols = array (
  'id' =>
  array (
    'type' => 'integer',
    'primaryKey' => true,
    'autoincrement' => true,
  ),
  'description' =>
  array (
    'type' => 'string',
    'length' => '50',
    'default' => '',
  ),
);


$indexes = array (
  'display' =>
  array (
    'type' => 'unique',
    'cols' =>
    array (
      0 => 'description',
    ),
  ),
);
$table->modify($cols, $indexes);
unset($table);


$table = \FreePBX::Database()->migrate("timegroups_details");
$cols = array (
  'id' =>
  array (
    'type' => 'integer',
    'primaryKey' => true,
    'autoincrement' => true,
  ),
  'timegroupid' =>
  array (
    'type' => 'integer',
    'default' => '0',
  ),
  'time' =>
  array (
    'type' => 'string',
    'length' => '100',
    'default' => '',
  ),
);


$indexes = array (
);
$table->modify($cols, $indexes);
unset($table);

$fcc = new featurecode('timeconditions', 'toggle-mode-all');
$fcc->setDescription("All: Time Condition Override");
$fcc->setDefault('*27');
$fcc->update();
unset($fcc);

$freepbx_conf =& freepbx_conf::create();

// TCINTERVAL
//
$set['value'] = '60';
$set['defaultval'] =& $set['value'];
$set['readonly'] = 0;
$set['hidden'] = 0;
$set['level'] = 1;
$set['module'] = 'timeconditions';
$set['category'] = 'Time Condition Module';
$set['emptyok'] = 0;
$set['name'] = 'Maintenance Polling Interval';
$set['description'] = 'The polling interval in seconds used by the Time Conditions maintenance task, launched by an Asterisk call file used to update Time Conditions override states as well as keep custom device state hint values up-to-date when being used with BLF. A shorter interval will assure that BLF keys states are accurate. The interval should be less than the shortest configured span between two time condition states, so that a manual override during such a period is properly reset when the new period starts.';
$set['type'] = CONF_TYPE_SELECT;
$set['options'] = '60, 120, 180, 240, 300, 600, 900';
$freepbx_conf->define_conf_setting('TCINTERVAL',$set);

// TCMAINT
//
$set['value'] = true;
$set['defaultval'] =& $set['value'];
$set['readonly'] = 0;
$set['hidden'] = 0;
$set['level'] = 1;
$set['module'] = 'timeconditions';
$set['category'] = 'Time Condition Module';
$set['emptyok'] = 0;
$set['name'] = 'Enable Maintenance Polling';
$set['description'] = 'If set to false, this will override the execution of the Time Conditions maintenance task launched by call files. If all the feature codes for time conditions are disabled, the maintenance task will not be launched anyhow. Setting this to false would be fairly un-common. You may want to set this temporarily if debugging a system to avoid the periodic dialplan running through the CLI that the maintenance task launches and can be distracting.';
$set['type'] = CONF_TYPE_BOOL;
$freepbx_conf->define_conf_setting('TCMAINT',$set);

$freepbx_conf->commit_conf_settings();
