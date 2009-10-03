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
require_once 'PHP/CodeSniffer.php';

if (!defined('TMP_DIR')) define('TMP_DIR', sys_get_temp_dir());

/**
 * Uses PHP CodeSniffer to check a project build for
 * style conformance.
 *
 * Requirements: PHP CodeSniffer installed on the include path.
 *
 * @package ransack
 * @subpackage analysis
 */
class CodeSniffer {

	private $command;
	private $standard;
	private $tabWidth;

	function __construct($standard='PEAR') {
		$this->standard = $standard;
		$this->command = PATH_TO_PEAR.'phpcs';
		$this->tabWidth = "";
	}

	function enableTabs() {
		$this->tabWidth = "--tab-width=4";
	}

	/**
	 * @param string $path path to the project build to check
	 */
	function analyze($path) {
		$report = TMP_DIR.'/codesniffer.report.xml';
		if (!in_array($this->standard, array('PEAR','Zend'))) {
			$this->standard = dirname(__FILE__).'/standards/'.$this->standard;
		}
		$standard = "--standard={$this->standard}";
		$format = "--report=xml";
		shell_exec("{$this->command} $standard $format {$this->tabWidth} $path > $report");
	}

	function getReport() {
		$report = new stdClass;
		$report->identifier = "CodeSniffer";
		$xml = file_get_contents(TMP_DIR.'/codesniffer.report.xml');
		$stats = new SimpleXMLElement($xml);
		$report->errors = 0;
		$report->warnings = 0;
		$report->report = "";
		foreach($stats->file as $file) {
			$report->errors += $file['errors'];
			$report->warnings += $file['warnings'];
			$pre = "";
			foreach($file->error as $error) {
				$pre .= sprintf("<li>Line <span>%s</span> at column <span>%s</span>: %s</li>", $error['line'], $error['column'], (string)$error);
			}
			$report->report .= sprintf("<div class=\"report-summary\"><p>%s</p><ul>%s</ul></div>", $file['name'], $pre);
		}
		$report->summary = "PHP Code Sniffer found {$report->errors} errors and {$report->warnings} warnings using the {$this->standard} standard.";
		return $report;
	}

}

?>