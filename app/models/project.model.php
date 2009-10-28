<?php
Package::import('floe.repository.Record');
Package::import('ransack.SubversionRepository');

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
		//$this->analysisPlugins[] = "Depend";
		$this->analysisPlugins[] = "LineCount";
		//$this->analysisPlugins[] = "CodeSniffer";
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

	function getPassCountSeries() {
		$series = array();
		foreach($this->builds as $build) {
			$series[] = $build->passCount / 4;
		}
		return implode(',', array_reverse($series));
	}

	function getFailCountSeries() {
		$series = array();
		foreach($this->builds as $build) {
			$series[] = $build->failCount / 4;
		}
		return implode(',', array_reverse($series));
	}

	function getBuilds() {
		$this->storage->select("builds", "WHERE project_id='{$this->id}' ORDER BY at DESC");
		return $this->storage->getRecords();
	}

	function isBuildUpdated($revision) {
		$this->storage->select("builds", "WHERE project_id='{$this->id}' ORDER BY at DESC LIMIT 0,1");
		$build = $this->storage->getRecord();
		return ($revision > $build->identifier);
	}

	function build() {
		$build = new Build();
		$build->project = $this;
		$build->isComplete = false;	
		
		// step 1. build the target
		shell_exec("cd {$this->sourcePath}; {$this->buildCommand}");
		
		$svn = new SubversionRepository($this->sourcePath);
		$revision = $svn->getRevision();
		if (!$this->isBuildUpdated($revision)) {
			throw new Exception("No new changes to build for {$this->title}");
		}
		$build->identifier = $revision;
		$build->at = MOMENT;
		$build->save();
		
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
		
		$build->at = MOMENT;
		$build->isComplete = true;
		$build->save();
	}
	
}

?>
