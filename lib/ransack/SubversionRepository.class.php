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

class SubversionRepository {
	
	private $baseUrl;
	
	function __construct($baseUrl) {
		$this->baseUrl = $baseUrl;
	}
	
	function checkout($toPath, $asName) {
		shell_exec("svn co {$this->baseUrl} $toPath/$asName");
	}
	
	function log() {
		return shell_exec("svn log {$this->baseUrl} -r HEAD --xml");
	}

	function getRevision() {
		$info = shell_exec("cd {$this->baseUrl} ; svn info");
		preg_match("/(Revision:\s)([0-9]+)/", $info, $matches);
		return $matches[2];
	}

}

?>
