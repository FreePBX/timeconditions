<?php
namespace FreePBX\modules;
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }
//	License for all code of this FreePBX module can be found in the license file inside the module directory
//	Copyright 2015 Sangoma Technologies.

class Timeconditions implements \BMO {
	public function __construct($freepbx = null) {
		if ($freepbx == null) {
			throw new Exception("Not given a FreePBX Object");
		}
		$this->FreePBX = $freepbx;
		$this->db = $freepbx->Database;
	}
    public function install() {}
    public function uninstall() {}
    public function backup() {}
    public function restore($backup) {}
    public function doConfigPageInit($page) {
    	$request = $_REQUEST;
    	switch($page){
    		case "timeconditions":
				isset($request['action'])?$action = $request['action']:$action='';
				isset($request['itemid'])?$itemid=$request['itemid']:$itemid='';
				isset($request['view'])?$view=$request['view']:$view='';
				$invert_hint = isset($request['invert_hint'])?$request['invert_hint']:'0';
				$fcc_password = isset($request['fcc_password'])?$request['fcc_password']:'';
				//if submitting form, update database
				switch ($action) {
					case "add":
						$itemid = timeconditions_add($request);
						needreload();
						//Todo: Remove this later, need to fix redirects...
						//redirect_standard('itemid');
					break;
					case "delete":
						timeconditions_del($itemid);
						needreload();
						//Todo: Remove this later, need to fix redirects the BMO way.
						//redirect_standard();
					break;
					case "edit":  //just delete and re-add
						timeconditions_edit($itemid,$request);
						needreload();
						//Todo: Remove this later, need to fix redirects the BMO way.
						//redirect_standard('itemid', 'view');
					break;
				}
			break;
			case "timegroups":
				debug($request);
				$action= isset($request['action'])?$request['action']:null;
				$timegroup= isset($request['extdisplay'])?$request['extdisplay']:null;
				$description= isset($request['description'])?$request['description']:null;
				$times = isset($request['times'])?$request['times']:null;
				switch($action){
					case 'add':
						timeconditions_timegroups_add_group($description,$times);
						break;
					case 'edit':
						timeconditions_timegroups_edit_group($timegroup,$description);
						timeconditions_timegroups_edit_times($timegroup,$times);
						break;
					case 'del':
						timeconditions_timegroups_del_group($timegroup);
						break;
					case 'getJSON':
    					header('Content-Type: application/json');
    					switch ($request['jdata']) {
    						case 'servertime':
    							echo $this->serverTime();
    							exit();
    						break;
    						case 'grid':
    							$timegroupslist = timeconditions_timegroups_list_groups();
    							$rdata = array();
    							foreach($timegroupslist as $tg){
									$rdata[] = array('text' => $tg['text'],'value' => $tg['value'], 'link' => array($tg['text'],$tg['value']));
    							}
    							echo json_encode($rdata);
    							exit();
    						break;
   			 				default:
    							echo json_encode(array("error"=>"Unknown Request"));
    							exit();
    						break;
    					}
    				break;
    			}
    		break;
		}
    }
    public function getActionBar($request) {
		switch($request['display']) {
			case 'timeconditions':
			case 'timegroups':
				$buttons = array(
					'delete' => array(
						'name' => 'delete',
						'id' => 'delete',
						'value' => _('Delete')
					),
					'reset' => array(
						'name' => 'reset',
						'id' => 'reset',
						'value' => _('Reset')
					),
					'submit' => array(
						'name' => 'submit',
						'id' => 'submit',
						'value' => _('Submit')
					)
				);
				if (empty($request['itemid']) && $request['display'] == 'timeconditions') {
					unset($buttons['delete']);
				}
				if (empty($request['extdisplay']) && $request['display'] == 'timegroups') {
					unset($buttons['delete']);
				}
				if ($request['view'] != 'form'){
					unset($buttons);
				}
			break;
		}
		return $buttons;
	}
	public function serverTime(){
		return json_encode(localtime());
	}
}