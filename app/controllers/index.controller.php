<?php

require_once MOD_DIR.'/projects.finder.php';

class IndexController extends IdentityController {
	
	function index() {
		if (!defined('DB_NAME')) {
			$this->response->assign('storage', 'MySQL');
			$this->response->render('welcome');
		} else {
		
			$projects = new ProjectsFinder();
			$this->response->assign('projects', $projects->findAll());
			$this->response->render('index');
		}
	}
	
}

?>