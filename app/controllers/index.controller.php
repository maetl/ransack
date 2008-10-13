<?php

class IndexController extends IdentityController {
	
	function index() {
		$this->response->write("<h1>Ransack</h1>");
	}
	
}

?>