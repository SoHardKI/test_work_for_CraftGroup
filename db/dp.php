<?php

try {
    $connect = new PDO('mysql:host=localhost; dbname=tz_db; charset: utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";

    // Then actually do something about the error
    logError($e->getMessage(), __FILE__, __LINE__);
    emailErrorToAdmin($e->getMessage(), __FILE__, __LINE__);
    // etc.
    die(); // Comment this out if you want the script to continue execution
}


