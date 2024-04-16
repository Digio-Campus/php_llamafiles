<?php
$config = Config::singleton();
 
$config->set('controllersFolder', 'controllers/');
$config->set('modelsFolder', 'models/');
$config->set('viewsFolder', 'views/');
 
$config->set('dbhost', 'database');
$config->set('dbport', '63532');
$config->set('dbname', 'php_llamafiles_db');
$config->set('dbuser', 'lamp');
$config->set('dbpass', 'lamp');