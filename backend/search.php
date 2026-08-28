<?php

require_once __DIR__ . "/getStudents.php";
require_once __DIR__ . "/helpers.php";


header("content-type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    throwAPIError(405, "Method Not Allowed");
}

if (!isset($_POST["search"]) || !isset($_POST["page"])) {
    throwAPIError(422, "Unprocessable Entity");
}

$students = getStudents($_POST['search'],$_POST["page"]);
$total = getStudentsCount($_POST['search']);

echo json_encode([
    "search" => $students,
    "total" => $total,
]);
