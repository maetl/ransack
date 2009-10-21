<?php
//require_once LIB_DIR.'spyc/Spyc.class.php';
require_once MOD_DIR.'build.model.php';
require_once MOD_DIR.'agent.service.php';

class IndexController extends IdentityController {
	
	function index() {
		if (!defined('DB_NAME')) {
			$this->response->assign('storage', 'MySQL');
			$this->response->render('welcome');
		} else {
			$this->response->assign('projects', Project::findAll());
			$this->response->assign('builds', Build::findRecent());
			$this->response->render('index');
		}
	}
	
	function configuration() {
		//$this->response->dump(Spyc::YAMLLoad(DEV_DIR.'/config/ransack.yml'));			
		$this->response->render('configuration');
	}
	
}

?>
