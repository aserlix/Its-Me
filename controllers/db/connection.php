<?php

// Connecting to DB
define('_DBSERVER', 'localhost');
define('_DBUSER', 'root');
define('_DBPASS', '');
define('_DB', 'accounts');

try {
    $conn = new PDO("mysql:host=" . _DBSERVER . ";dbname=" . _DB . "", _DBUSER, _DBPASS);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
