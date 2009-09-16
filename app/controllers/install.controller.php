<?php

class InstallController extends IdentityController {

	function index() {
		if ($this->request->isPost()) {
			$configFile = WEB_DIR.'config.php';
			//chmod(WEB_DIR.'config.php');
			$configSource = file_get_contents($configFile);
			$template = "
				define('DB_USER', '{$this->request->DB_USER}');
				define('DB_PASS', '{$this->request->DB_PASS}');
				define('DB_HOST', '{$this->request->DB_HOST}');
				define('DB_NAME', '{$this->request->DB_NAME}');
			";
			$configSource = str_replace("?>", $template."\n?>", $configSource);
			file_put_contents($configFile, $configSource);
		}
	}

}

?>