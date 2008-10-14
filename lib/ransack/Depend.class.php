<?php
/**
 *	Copyright (c) 2008 Coretxt
 *
 * 	Permission is hereby granted, free of charge, to any person
 *	obtaining a copy of this software and associated documentation
 *	files (the "Software"), to deal in the Software without
 *	restriction, including without limitation the rights to use,
 *	copy, modify, merge, publish, distribute, sublicense, and/or sell
 *	copies of the Software, and to permit persons to whom the
 *	Software is furnished to do so, subject to the following
 *	conditions:
 *
 *	The above copyright notice and this permission notice shall be
 *	included in all copies or substantial portions of the Software.
 *
 *	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 *	EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 *	OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 *	NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 *	HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 *	WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 *	FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 *	OTHER DEALINGS IN THE SOFTWARE.
*/

/**
 * @package ransack
 * @subpackage analysis
 */
require_once 'PHP/Depend.php';

if (!defined('TMP_DIR')) define('TMP_DIR', sys_get_temp_dir());

/**
 * Uses PHP CodeSniffer to check a project build for
 * style conformance.
 *
 * @package ransack
 * @subpackage analysis
 */
class Depend {
	
	/**
	 * @param string $path path to the project build to check
	 */
	function analyze($path) {
		$summary = TMP_DIR.'/depend.summary.xml';
		$packages = TMP_DIR.'/depend.packages.xml';
		$report = "--summary-xml=$summary --jdepend-xml=$packages";
		shell_exec("pdepend $report $path");
	}

	function getReport() {
		return file_get_contents(TMP_DIR.'/depend.packages.xml');
	}
	
	function getStatistics() {
		$xml = new SimpleXMLElement(file_get_contents(TMP_DIR.'/depend.summary.xml'));
		return $xml;
	}
	
}

?>