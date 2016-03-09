#!/usr/bin/env php
<?php

//include bootstrap
$restrict_mods = array('timeconditions' => true);
$bootstrap_settings['freepbx_auth'] = false;
if (!@include_once(getenv('FREEPBX_CONF') ? getenv('FREEPBX_CONF') : '/etc/freepbx.conf')) {
    include_once('/etc/asterisk/freepbx.conf');
}
$tc = \FreePBX::Timeconditions();
$conditions = $tc->listTimeconditions();
$groups = $tc->listTimeGroups();
foreach($conditions as $item){
    $tctimes = timeconditions_timegroups_get_times($item['time'],null,$item['timeconditions_id']);
    foreach($tctimes as $tctime){
      if($tc->checkTime($tctime[1])){
        $response = $astman->send_request('Command',array('Command'=>"devstate change Custom:DAYNIGHT".$item['timeconditions_id']." INUSE"));
      } else {
        $response = $astman->send_request('Command',array('Command'=>"devstate change Custom:DAYNIGHT".$item['timeconditions_id']." NOT_INUSE"));
      }
    }
}
$tc->updateCron();
exit(0);
