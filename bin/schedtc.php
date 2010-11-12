#!/usr/bin/php -q
<?php
//Copyright (C) 2010 Astrogen LLC 
//
//This program is free software; you can redistribute it and/or
//modify it under the terms of the GNU General Public License
//as published by the Free Software Foundation; either version 2
//of the License, or (at your option) any later version.
//
//This program is distributed in the hope that it will be useful,
//but WITHOUT ANY WARRANTY; without even the implied warranty of
//MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//GNU General Public License for more details.

$tmp = "/tmp";

if (isset($argv[1]) && ctype_digit($argv[1])) {
	$time_offset = $argv[1];
} else {
	$time_offset = 60;
}

if (isset($argv[2]) && is_dir($argv[2])) {
  $call_spool = $argv[2];
} else {
  $call_spool = "/var/spool/asterisk/outgoing";
}

if (isset($argv[3]) && ($argv[3] == '0') || ($argv[3] == '1')) {
  $file_index = $argv[3];
  $next_index = $file_index ? '0' : '1';
} else {
  $file_index = 0;
  $next_index = 1;
}

$call_file = "schedtc.$file_index.call";

$now = time();
$next_time = $now+$time_offset;

// Now try to have the call file go off 'on the minute'
//
$remainder = $next_time % 60;
if ($remainder < 30) {
	$next_time -= $remainder;
} else {
	$next_time += 60 - $remainder;
}
if ($next_time < ($now + 30)) {
	$next_time += 60;
}


// Pass in the file index not being used into the CID field to be used by the dialplan when launching
// the next call file. You can't just use the same name over, even changing the modificaiton time since
// as soon as the call file is processed it is deleted
//
$sched_script = "Channel: Local/s@tc-maint\nCallerID: \"$next_index\" <$next_index>\nApplication: Noop\nData: Time Conditions Override Maintenance Script\n";

$fh = fopen("$tmp/$call_file","w");
if ($fh === false) {
  error_log("FATAL: FreePBX Time Conditions {$argv[0]} failed to create temporary file: $tmp/$call_file\n");
  exit(1);
}
if (fwrite($fh,$sched_script) === false) {
  error_log("FATAL: FreePBX Time Conditions {$argv[0]} failed to write to temporary file: $tmp/$call_file\n");
  exit(1);
}
if (fclose($fh) === false) {
  error_log("ERROR: FreePBX Time Conditions {$argv[0]} failed to close to temporary file: $tmp/$call_file, continuing execution\n");
}
if (touch("$tmp/$call_file",$next_time, $next_time) === false) {
  error_log("ERROR: FreePBX Time Conditions {$argv[0]} failed to set time on temporary file: $tmp/$call_file, continuing execution\n");
}
if (rename("$tmp/$call_file","$call_spool/$call_file") === false) {
  error_log("FATAL: FreePBX Time Conditions {$argv[0]} failed to initiate call file: $call_spool/$call_file\n");
  exit(1);
}
exit(0);
