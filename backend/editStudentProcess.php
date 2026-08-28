<?php

session_start();

require_once __DIR__ . "/validation.php";
require_once __DIR__ . "/helpers.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    throwError(403, "Method not Allowed");
}
$_SESSION["_old"] = $_POST;
$_SESSION["_errors"] = [];


editValidate();

$passEdit = "";

if (isset($_POST['password']) && !empty($_POST['password'])) {
    $hashPass =  password_hash($_POST['password'], PASSWORD_DEFAULT);
    $passEdit = "password = '{$hashPass}',";
}

$DB = connection();

$DB->exec("UPDATE students 
            SET 
            first_name = '{$_POST['firstName']}',
            last_name = '{$_POST['lastName']}',
            email = '{$_POST['email']}',
            {$passEdit}
            age = '{$_POST['age']}',
            phone = '{$_POST['phone']}'
            WHERE id = '{$_POST['id']}'
            ");

unset($_SESSION["_old"]);
header("Location: ../index.php");
