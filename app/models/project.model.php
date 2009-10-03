<?php
Package::import('floe.repository.Record');

/**
 * A project requires a link to source repository and local installation.
 */
class Project extends Record {
	
	private $analysisPlugins = array();
	
	function __define() {
		$this->property("name","string");
		$this->property("title", "string");
		$this->property("description", "string");
		$this->property("sourcePath", "string");
		$this->property("buildCommand", "string");
		$this->property("codeStandard", "string");
		$this->hasMany("builds");
		//$this->analysisPlugins[] = "Depend";
		$this->analysisPlugins[] = "LineCount";
		$this->analysisPlugins[] = "CodeSniffer";
		$this->analysisPlugins[] = "CopyPasteDetector";
	}
	
	static function findByName($name) {
		$db = StorageAdaptor::instance();
		$db->selectByKey("projects", array("name"=>$name));
		return $db->getRecord();
	}
	
	function build() {
		$build = new Build();
		// step 1. build the target
		shell_exec("cd {$this->sourcePath}; {$this->buildCommand}");
		// step 2. run tests
		// # not implemented
		// step 3. run analysis
		foreach($this->analysisPlugins as $plugin) {
			// move from lib to app?
			require_once LIB_DIR."ransack/{$plugin}.class.php";
			$analyzer = new $plugin($this->codeStandard);
			$analyzer->analyze($this->sourcePath);
			$build->addReport($analyzer->getReport());
		}
		$build->identifier = rand(999,9999);
		$build->at = MOMENT;
		$build->isComplete = true;
		$build->project = $this;
		$build->save();
	}
	
}

?>