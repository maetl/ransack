<?php

class IndexController extends IdentityController {
	
	function index() {
		$this->response->render('index');
	}
	
}

?>