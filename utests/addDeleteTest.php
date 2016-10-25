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

		//Module name used in test output as self::$module. Can be anything unless you want to use this as something more.

		protected static $module = 'Timeconditions';

		//Change Moduleclass to your class name

		public static function setUpBeforeClass() {

				include 'setuptests.php';

				self::$f = FreePBX::create();

				self::$o = self::$f->Timeconditions;

		}

		//Stuff before the test

		public function setup() {}

		//Leave this alone, it test that PHPUnit is working

		public function testPHPUnit() {

				$this->assertEquals("test", "test", "PHPUnit is broken.");

				$this->assertNotEquals("test", "nottest", "PHPUnit is broken.");

		}


		public function testCreate() {

				$this->assertTrue(is_object(self::$o), sprintf("Did not get a %s object",self::$module));

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

}
