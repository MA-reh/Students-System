<?php
session_start();

require_once __DIR__ . "/../database/connection.php";


if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    throwError(403, "Method not Allowed");
}
if (!isset($_GET['id'])) {
    throwError(422, "data invalid");
}

if (!isset($_SESSION['_errors'])) {
    $DB = connection();

    $stmt = $DB->query("SELECT id, email, password, phone, age, first_name AS firstName, last_name AS lastName
                        FROM students 
                        WHERE id = '{$_GET['id']}'
                        ");



    $student = $stmt->fetch();

    if (empty($student)) {
        throwError(422, "invalid id");
    }

    $_SESSION["_old"] = $student;
}
