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
class LineCount {

	private $command;
	
	function __construct() {
		$this->command = PATH_TO_PEAR.'phploc';
	}
	
	function analyze($path) {
		$summary = TMP_DIR.'/loc.summary.xml';
		$this->report = shell_exec("{$this->command} $path");
	}
	
	function getReport() {
		//$xml = new SimpleXMLElement(file_get_contents(TMP_DIR.'/loc.summary.xml'));
		$report = new stdClass;
		$report->identifier = "LineCount";
		$report->summary = "";
		$report->warnings = 0;
		$report->errors = 0;
		$report->report = $this->report;
		return $report;
	}
	
}

?>