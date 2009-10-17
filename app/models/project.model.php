<?php
Package::import('floe.repository.Record');
Using::model("Build");

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
		$this->property("testCommand", "string");
		$this->property("codeStandard", "string");
		$this->hasMany("builds");
		$this->analysisPlugins[] = "Depend";
		$this->analysisPlugins[] = "LineCount";
		$this->analysisPlugins[] = "CodeSniffer";
		$this->analysisPlugins[] = "CopyPasteDetector";
	}
	
	static function findAll() {
		$db = StorageAdaptor::instance();
		$db->selectAll("projects");
		return $db->getRecords();
	}	
	
	static function findByName($name) {
		$db = StorageAdaptor::instance();
		$db->selectByKey("projects", array("name"=>$name));
		return $db->getRecord();
	}
	
	function getBuilds() {
		$this->storage->select("builds", "WHERE project_id='{$this->id}' ORDER BY at DESC");
		return $this->storage->getRecords();
	}
	
	function build() {
		$build = new Build();
		
		// step 1. build the target
		shell_exec("cd {$this->sourcePath}; {$this->buildCommand}");
		
		// step 2. run tests
		require_once LIB_DIR."ransack/SimpleTestReport.class.php";
		$tests = new SimpleTestReport();
		$tests->analyze($this->testCommand);
		$build->addTest($tests->getReport());
		
		// step 3. run analysis
		foreach($this->analysisPlugins as $plugin) {
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