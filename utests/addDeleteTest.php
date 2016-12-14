<?php

/**
* https://blogs.kent.ac.uk/webdev/2011/07/14/phpunit-and-unserialized-pdo-instances/
* @backupGlobals disabled
*/

class tcAddDeleteTest extends PHPUnit_Framework_TestCase{

	//Will be FreePBX BMO object
	protected static $f;

	//Will become your Class object
	protected static $o;

	public static function setUpBeforeClass() {
			self::$f = FreePBX::create();
			self::$o = self::$f->Timeconditions;
	}

	public function testTimegroups(){
			$description = "UnitTest";
		$times = json_decode('{times":{"2":{"hour_start":"9","minute_start":"0","hour_finish":"17","minute_finish":"0","wday_start":"-","wday_finish":"-","mday_start":"-","mday_finish":"-","month_start":"-","month_finish":"-"}}}',true);
		$id = self::$o->addTimeGroup($description, $times);
		$this->assertNotFalse($id, "ID was false, Timegroup did not add");
		$tg = self::$o->getTimeGroup($id);
		$this->assertEquals($description, $tg[1], "Description is NOT as expected");
		$this->assertFalse(self::$o->addTimeGroup($description, $times), "Tried adding a duplicate timegroup should have returned false");
		$this->assertTrue(self::$o->delTimeGroup($id), "Could not delete the test timegroup");
	}

	public function testCheckTime() {
		$dtNow = new DateTime();
		$sub1Hour = clone $dtNow;
		$sub1Hour->modify('+1 hour');
		$add1Hour = clone $dtNow;
		$add1Hour->modify('-1 hour');
		$sub1Day = clone $dtNow;
		$sub1Day->modify('-1 day');
		$add1Day = clone $dtNow;
		$add1Day->modify('+1 day');

		$out = self::$o->checkTime('*|*|*|*');
		$this->assertTrue($out);

		//Normal
		$out = self::$o->checkTime('*|'.strtolower($sub1Day->format('D')).'-'.strtolower($add1Day->format('D')).'|*|*');
		$this->assertTrue($out);

		$out = self::$o->checkTime(strtolower($sub1Hour->format('H:i')).'-'.strtolower($add1Hour->format('H:i')).'|*|*|*');
		$this->assertTrue($out);

		$out = self::$o->checkTime('*|'.strtolower(date('D')).'|*|*');
		$this->assertTrue($out);

		//Inverted
		$out = self::$o->checkTime('*|'.strtolower($add1Day->format('D')).'-'.strtolower($sub1Day->format('D')).'|*|*');
		$this->assertFalse($out);

		$out = self::$o->checkTime(strtolower($add1Hour->format('H:i')).'-'.strtolower($sub1Hour->format('H:i')).'|*|*|*');
		$this->assertFalse($out);

		/*
		$out = self::$o->checkTime('18:00-07:30|mon-fri|*|*');
		print_r($out);

		$out = self::$o->checkTime('13:00-09:00|sat|nothing|nothing');
		print_r($out);
		*/

		//$out = self::$o->checkTime('*|'.strtolower(date('D')).'|*|*');
		//print_r($out);
	}

}
