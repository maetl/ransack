<?php $this->wrap('layout'); ?>

<h2>Global Settings</h2>

<p>Global configuration settings for Ransack, which are shared across all installed projects.</p>

<form name="configuration" action="/configuration" method="post">
<fieldset>	
	<div class="element">
		<label>Path to PEAR</label>
		<input type="text" name="pearBin">
		<p class="help">Leave empty if you only intend to run Ransack via command line scripts. Otherwise, a full path to the PEAR bin directory is needed. Type <code>which pear</code> at a shell prompt, and enter the directory location shown.</p>
	</div>
</fieldset>	
</form>

<div class="installed-list">
	<h3>PDepend</h3>
	<p>No options available</p>
	
	<h3>PHP CodeSniffer</h3>	
	<p>No options available</p>
	
	<p>Custom coding standards are <?php 
		$standards = array();
		$dir = new DirectoryIterator(LIB_DIR.'ransack/standards');
		foreach($dir as $file) {
			if (!$file->isDot() && $file->isDir() && $file != '.svn') $standards[] = (string)$file;
		}
		echo implode(", ", $standards);
	
	?></p>
	
</div>