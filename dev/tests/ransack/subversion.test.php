<?php
require_once 'simpletest/autorun.php';

require_once dirname(__FILE__).'/../../../lib/ransack/SubversionRepository.class.php';
require_once dirname(__FILE__).'/../../../lib/ransack/SubversionLogParser.class.php';

class RansackSubversionTest extends UnitTestCase {
	
	function setUp() {
		$this->clearExistingTestInstall();
	}
	
	function tearDown() {
		$this->clearExistingTestInstall();
	}
	
	function clearExistingTestInstall() {
		shell_exec('rm -rf /Users/maetl/Projects/web/tools/ransack/src/www/projectname');
	}
	
	function testReadOnlyCheckoutFromRepository() {
		$svn = new SubversionRepository("http://ransack.googlecode.com/svn/trunk");
		$svn->checkout('/Users/maetl/Projects/web/tools/ransack/src/www/', 'projectname');
		$this->assertTrue(file_exists('/Users/maetl/Projects/web/tools/ransack/src/www/projectname/README'));
	}
	
	function testLogFormatParser() {
		$svn = new SubversionRepository("http://ransack.googlecode.com/svn/trunk");
		$parser = new SubversionLogParser($svn->log());
		$this->assertEqual(6, $parser->getRev());
		$this->assertEqual("adding README", $parser->getMsg());
		$this->assertEqual("coretxt", $parser->getAuthor());
	}	
}

?>