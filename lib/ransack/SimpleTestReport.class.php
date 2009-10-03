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
class SimpleTestReport {

	function analyze($command) {
		$this->report = shell_exec($command);
	}
	
	function getReport() {
		return $this->report;
	}
	
}

?>