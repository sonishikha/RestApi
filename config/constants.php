<?php
define('ROOT', dirname(__DIR__).DIRECTORY_SEPARATOR);
define('APP', ROOT.'app'.DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT.'app'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR);
define('MODEL', ROOT.'app'.DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR);
define('CONFIG', ROOT.'config');
define('DB', ROOT.'config'.DIRECTORY_SEPARATOR.'DBConnect.php');

define('ERROR_CODE', array('OK'=>200, 'RESOURCE_CREATED'=>201, 'BAD_REQUEST'=>400, 'PAGE_NOT_FOUND'=>404, 'INVALID_METHOD'=>405, 'INTERNAL_SERVER_ERROR'=>500));
?>