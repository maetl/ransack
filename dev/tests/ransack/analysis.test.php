<?php
require_once 'simpletest/autorun.php';

require_once dirname(__FILE__).'/../../../lib/ransack/CodeSniffer.class.php';
require_once dirname(__FILE__).'/../../../lib/ransack/Depend.class.php';
require_once dirname(__FILE__).'/../../../lib/ransack/Depend.class.php';


class RansackAnalysisTest extends UnitTestCase {
	
	function testCodeSniffer() {
		$analyzer = new CodeSniffer('Floe');
		$analyzer->enableTabs();
		$analyzer->analyze(dirname(__FILE__));
		$this->assertIsA('stdClass', $analyzer->getReport());
	}

	function testCopyPasteDetector() {
		$analyzer = new CopyPasteDetector();
		$analyzer->analyze(dirname(__FILE__));
		$this->assertIsA('stdClass', $analyzer->getReport());
	}
	
	function testLineCount() {
		$analyzer = new LineCount();
		$analyzer->analyze(dirname(__FILE__));
		$this->assertIsA('stdClass', $analyzer->getReport());
	}
	
	function testDepend() {
		$analyzer = new Depend();
		$analyzer->analyze(dirname(__FILE__));
		$this->assertIsA('stdClass', $analyzer->getReport());
	}
	
}

?>