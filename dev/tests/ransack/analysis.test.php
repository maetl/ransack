<?php
require_once 'simpletest/autorun.php';

require_once dirname(__FILE__).'/../../../lib/ransack/CodeSniffer.class.php';
require_once dirname(__FILE__).'/../../../lib/ransack/Depend.class.php';


class RansackAnalysisTest extends UnitTestCase {
	
	function testCodeSniffer() {
		$sniffer = new CodeSniffer('Floe');
		$sniffer->enableTabs();
		$sniffer->analyze(dirname(__FILE__).'/../../../lib/floe/');
		$this->dump($sniffer->getReport());
	}
	
	function testDepend() {
		$depend = new Depend();
		$depend->analyze(dirname(__FILE__).'/../../../lib/floe/');
		$this->dump($depend->getReport());
	}
	
}

?>