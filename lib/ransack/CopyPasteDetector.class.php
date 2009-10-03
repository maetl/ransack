<?php
/**
 * $Id$
 * Copyright (c) 2008-2009 maetl (http://maetl.net)
 * Free Software under the conditions of LICENSE.
 */

/**
 * @package ransack
 * @subpackage analysis
 */

/**
 * @package ransack
 * @subpackage analysis
 */
class CopyPasteDetector {
	
	private $command;
	
	function __construct() {
		$this->command = PATH_TO_PEAR.'phpcpd';
	}
	
	function analyze($path) {
		$summary = TMP_DIR.'/cpd.summary.xml';
		$this->report = shell_exec("{$this->command} --log-pmd=$summary --min-lines=2 --min-tokens=40 $path");
	}
	
	function getReport() {
		$xml = new SimpleXMLElement(file_get_contents(TMP_DIR.'/cpd.summary.xml'));
		$report = new stdClass;
		$report->identifier = "CopyPasteDetector";
		$lines = 0;
		$report->summary = "";
		$report->warnings = 0;
		$report->errors = 0;
		$report->report = $this->report;
		return $report;		
	}
	
}

?>