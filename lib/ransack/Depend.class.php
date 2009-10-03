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
require_once 'PHP/Depend.php';

if (!defined('TMP_DIR')) define('TMP_DIR', sys_get_temp_dir());

/**
 * Dependency analyzer. Uses PHP Depend to calculate various code metrics.
 *
 * @package ransack
 * @subpackage analysis
 */
class Depend {
	
	private $command;
	
	function __construct() {
		$this->command = PATH_TO_PEAR.'pdepend';
	}
	
	/**
	 * @param string $path path to the project build to check
	 */
	function analyze($path) {
		$summary = TMP_DIR.'/depend.summary.xml';
		$packages = TMP_DIR.'/depend.packages.xml';
		$overview = TMP_DIR.'/depend.pyramid.svg';
		$chart = TMP_DIR.'/depend.chart.svg';
		$badDocs = "--bad-documentation";
		$report = "--summary-xml=$summary --jdepend-xml=$packages --overview-pyramid=$overview --jdepend-chart=$chart";
		file_put_contents(TMP_DIR.'out.txt', "{$this->command} $report $path");
		shell_exec("{$this->command} $badDocs $report $path");
	}

	function getReport() {
		$out = "";
		$xml = new SimpleXMLElement(file_get_contents(TMP_DIR.'/depend.summary.xml'));
		$loc = $xml['loc'];
		$depth = $xml['ahh'];
		$derived = $xml['andc'];
		$comments = ((int)$xml['cloc']/$loc)*(100/1);
		$code = ((int)$xml['ncloc']/$loc)*(100/1);
		$out .= "<h3>Lines of Code Total: $loc</h3>\n";
		$out .= "<h3>Code/Comment Ratio: ".round($code,2)."%</h3><img src='http://chart.apis.google.com/chart?cht=p&chd=t:$code,$comments&chs=200x100&chco=629f24,a9f440'>";
		$out .= "<p>Inheritance Depth (average hierarchy height): $depth</p>\n";
		$out .= "<p>Average number of derived classes: $derived</p>\n";
		$report = new stdClass;
		$report->identifier = "DependencyAnalyzer";
		$report->summary = "";
		$report->warnings = 0;
		$report->errors = 0;
		$report->report = $out;
		return $report;
	}
	
}

?>