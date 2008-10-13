<?php

require_once 'config.php';

$server = new Membrane();
$server->attach(new IdentityDispatcher);
$server->run();

?>
