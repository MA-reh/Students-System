<?php



function connection(): PDO
{
    $DSN = "mysql:host=localhost;dbname=register";
    $username = "root";
    $password = "";
    try {
        $DB = new PDO($DSN, $username, $password);

        $DB->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "connection Data Failed : {$e}";
        exit();
    }

    return $DB;
}
