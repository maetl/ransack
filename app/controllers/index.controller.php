<?php

class IndexController extends IdentityController {
	
	function index() {
		if (!defined('DB_NAME')) {
			$this->response->assign('storage', 'MySQL');
			$this->response->render('welcome');
		} else {
			$this->response->render('index');
		}
	}
	
}

?>