<?php
require_once MOD_DIR.'agent.service.php';
require_once MOD_DIR.'project.model.php';
require_once MOD_DIR.'build.model.php';

class AnalysisController extends IdentityController {
	
	function index($id) {
		$this->response->assign("build", Build::find($id));
		$this->response->render("analysis");
	}
	
	function chart() {
		$this->response->header("Content-Type", "image/svg+xml");
		echo file_get_contents(TMP_DIR.'pmd.chart.svg');
	}
	
	function pyramid() {
		$this->response->header("Content-Type", "image/svg+xml");
		echo file_get_contents(TMP_DIR.'depend.pyramid.svg');
	}
	
	
	function depend() {
		$this->response->header("Content-Type", "text/xml");
		echo file_get_contents(TMP_DIR.'depend.chart.svg');
	}
	
}

?>