<?php
require_once MOD_DIR.'agent.service.php';
require_once MOD_DIR.'project.model.php';
require_once MOD_DIR.'build.model.php';

class BuildController extends IdentityController {
	
	function index($id) {
		$this->response->assign("build", Build::find($id));
		$this->response->render("build");
	}
	
	function start($name) {
		$project = Project::findByName($name);
		AgentService::startBuild($project);
	}
	
}

?>