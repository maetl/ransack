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
require_once 'PHP/CodeSniffer.php';

if (!defined('TMP_DIR')) define('TMP_DIR', sys_get_temp_dir());

/**
 * Uses PHP CodeSniffer to check a project build for
 * style conformance.
 *
 * @package ransack
 * @subpackage analysis
 */
class CodeSniffer {

	private $standard;
	private $tabWidth;

	function __construct($standard='PEAR') {
		$this->standard = $standard;
		$this->tabWidth = "";
	}

	function enableTabs() {
		$this->tabWidth = "--tab-width=4";
	}

	/**
	 * @param string $path path to the project build to check
	 */
	function analyze($path) {
		$report = TMP_DIR.'/codesniff.txt';
		if (!in_array($this->standard, array('PEAR','Zend'))) {
			$this->standard = dirname(__FILE__).'/standards/'.$this->standard;
		}
		$standard = "--standard={$this->standard}";
		shell_exec("phpcs $standard {$this->tabWidth} $path > $report");
	}

	function getReport() {
		return file_get_contents(TMP_DIR.'/codesniff.txt');
	}

}

?>