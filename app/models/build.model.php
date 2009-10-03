<?php
Package::import('floe.repository.Record');
Package::import('ransack.SubversionRepository');
//Package::import('app.models.Project');
require_once MOD_DIR.'project.model.php';

class Build extends Record {
	
	function __define() {
		$this->belongsTo("project");
		$this->property("identifier", "string");
		$this->property("at", "datetime");
		$this->property("isComplete", "boolean");
		$this->hasMany("changes");
		$this->hasMany("tests");
		$this->hasMany("reports");
	}

	static function find($id) {
		$db = StorageAdaptor::instance();
		$db->selectByKey("builds", array("identifier"=>$id));
		return $db->getRecord();
	}
	
	static function findRecent() {
		$db = StorageAdaptor::instance();
		$db->select("builds", "ORDER BY at DESC");
		return $db->getRecords();
	}
	
	function addReport($data) {
		$report = new Report();
		$report->identifier = $data->identifier;
		$report->summary = $data->summary;
		$report->report = $data->report;
		$report->warnings = $data->warnings;
		$report->errors = $data->errors;
		$this->reports = $report;
	}
	
}

class Change extends Record {
	
	function __define() {
		$this->belongsTo("build");		
		$this->property("message", "text");
		$this->property("revision", "string");
		$this->property("added", "text");
		$this->property("modified", "text");
		$this->property("deleted", "text");
	}
	
	function getRevision() {
		$svn = new SubversionRepository("http://ransack.googlecode.com/svn/trunk");
		$parser = new SubversionLogParser($svn->log());
		return $parser;		
	}
	
}

class Test extends Record {
	
	function __define() {
		$this->belongsTo("build");
		$this->property("passes", "integer");
		$this->property("fails", "integer");
		$this->property("exceptions", "integer");
		$this->property("result", "boolean");
		$this->property("output", "text");
	}
	
}

class Report extends Record {
	
	function __define() {
		$this->belongsTo("build");
		$this->property("identifier", "string");
		$this->property("data", "text");
		$this->property("errors", "integer");
		$this->property("warnings", "integer");
		$this->property("summary", "text");
		$this->property("report", "text");
	}
	
}

?>