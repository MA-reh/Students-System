<?php

require_once __DIR__ . "/../database/connection.php";
require_once __DIR__ . "/helpers.php";

header("content-type: application/json; charset=UTF-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    throwAPIError(405, "Method Not Allowed");
}

$allowedData = ["tableName", "id"];

foreach ($_POST as $field => $value) {
    if (count($_POST) !== count($allowedData) || !in_array($field, $allowedData)) {
        throwAPIError(412, "Precondition failed is used for conditional requests when using last-modified date and ETags.");
    }
}



$tableName = $_POST["tableName"];
$studentId = $_POST["id"];

$DB = connection();

$DB->exec("DELETE FROM {$tableName} WHERE id = '{$studentId}';");

echo json_encode([
    "statue" => 200,
    "message" => "Deleting is Successfully",
]);