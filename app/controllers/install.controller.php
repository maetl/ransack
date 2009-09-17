<?php

require_once LIB_DIR.'/floe/repository/store/StorageAdaptor.class.php';

class InstallController extends IdentityController {

	function index() {
		if ($this->request->isPost()) {
			
			// update configuration with DB settings
			$configFile = WEB_DIR.'/config.php';
			$configSource = file_get_contents($configFile);
			$template = "
define('DB_USER', '{$this->request->DB_USER}');
define('DB_PASS', '{$this->request->DB_PASS}');
define('DB_HOST', '{$this->request->DB_HOST}');
define('DB_NAME', '{$this->request->DB_NAME}');
			";
			$configSource = str_replace("?>", $template."\n?>", $configSource);
			file_put_contents($configFile, $configSource);
			
			define('DB_USER', $this->request->DB_USER);
			define('DB_PASS', $this->request->DB_PASS);
			define('DB_HOST', $this->request->DB_HOST);
			define('DB_NAME', $this->request->DB_NAME);
			
			// connect to database and run initial migrations
			$db = StorageAdaptor::gateway();
			
			$db->createTable("logs", array("task_id"=>"string", "description"=>"text"));
			
		}
	}

}

?>