<?php
try {
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    
    $db = new PDO("mysql:host=$servername;dbname=crud-app", $username, $password); // setting up new object with PDO class, Use of Magic costant to get the directory of database
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo $e->getMessage();
    exit;
}