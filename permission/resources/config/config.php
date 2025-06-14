<?php

require __DIR__ . '/../../../vendor/autoload.php'; // Use __DIR__ for absolute paths
require __DIR__ . '/../../../config/bootstrap.php';

use Cake\Datasource\ConnectionManager;

// Get the default connection configuration
$config = ConnectionManager::getConfig('default');

// Access values directly
$host = $config['host']; // e.g., 'localhost'
$username = $config['username'];
$database = $config['database'];
$password = $config['password'];

if (!defined('DB_SERVER')) define('DB_SERVER',$host);
if (!defined('DB_USER')) define('DB_USER',$username);
if (!defined('DB_PWD')) define('DB_PWD',$password);
if (!defined('DB_NAME')) define('DB_NAME',$database);
if (!defined('DSN')) define('DSN','mysql:host='.DB_SERVER.'; dbname='.DB_NAME);
