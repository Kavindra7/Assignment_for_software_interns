<?php

try {
    $con = new PDO("mysql:host=localhost;dbname=erp_system", "root", "");
} catch (PDOException $e) {
    echo "Database is not connected " . $e->getMessage();
}


?>
