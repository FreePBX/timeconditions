#!/usr/bin/env php
<?php

//include bootstrap
$restrict_mods = array('timeconditions' => true);
$bootstrap_settings['freepbx_auth'] = false;
if (!@include_once(getenv('FREEPBX_CONF') ? getenv('FREEPBX_CONF') : '/etc/freepbx.conf')) {
    include_once('/etc/asterisk/freepbx.conf');
}
$tc = \FreePBX::Timeconditions();
$tc->cleanuptcmaint();
