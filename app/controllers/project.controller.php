<?php

/**
 * Prototype, doesn't work for multiple projects.
 */
class ProjectController extends IdentityController {
	
	function index($project) {
		$this->response->assign('project', Project::findByName($project));
		$this->response->render('project');
	}

}

?>