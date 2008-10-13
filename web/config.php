<?php
// ------------------------------------------------------------------
// Main app configuration settings
// ------------------------------------------------------------------

define('WEB_HOST', $_SERVER['HTTP_HOST']);

define('APP_DIR', dirname(__FILE__)."/../app/");
define('DEV_DIR', dirname(__FILE__)."/../dev/");
define('LIB_DIR', dirname(__FILE__)."/../lib/");
define('TMP_DIR', dirname(__FILE__)."/../tmp/");
define('CTR_DIR', dirname(__FILE__)."/../app/controllers/");
define('TPL_DIR', dirname(__FILE__)."/../app/templates/");
define('MOD_DIR', dirname(__FILE__)."/../app/models/");
define('WEB_DIR', dirname(__FILE__));

define('MOMENT', date('Y-n-d H:i:s', mktime()));

require_once LIB_DIR .'floe/framework/Package.class.php';
require_once LIB_DIR .'floe/server/Membrane.class.php';
require_once LIB_DIR .'floe/server/receptors/IdentityDispatcher.class.php';

?>