<?php

require_once __DIR__ . "/helpers.php";
require_once __DIR__ . "/../database/connection.php";


function validate()
{
    /* 
    firstName: required,
    lastName: required,
    email: required, email, unique
    password: required,
    age: required,
    phone: required, unique, EGPhone
    */

    $allowedInputs = ["firstName", "lastName", "email", "password", "age", "phone"];

    foreach ($_POST as $field => $value) {

        $flag = false;
        if (count($_POST) !== count($allowedInputs) || !in_array($field, $allowedInputs)) {
            addError("typeAlert", "error", "alerts");
            addError("typeAlert", "Unprocessable Entity, You Are Forbidden Because you play an inputs Form", "alerts");
            $flag = true;
        }

        if ($flag) {

            unset($_SESSION["_errors"]);
            back();
        }

        validateRequired($field, $value);
        if ($field == "email") {
            validateEmail($field, $value);
            validateUnique($field, $value, "students");
        } else if ($field == "phone") {
            validateEGPhone($field, $value);
            validateUnique($field, $value, "students");
        } else if ($field == "age") {
            validateAge($field, $value);
        }
    }

    if (!empty($_SESSION["_errors"])) {
        back();
    }
}

function editValidate()
{

    $allowedInputs = ["id", "firstName", "lastName", "email", "password", "age", "phone"];

    foreach ($_POST as $field => $value) {

        $flag = false;
        if (count($_POST) !== count($allowedInputs) || !in_array($field, $allowedInputs)) {
            addError("typeAlert", "error", "alerts");
            addError("typeAlert", "Unprocessable Entity, You Are Forbidden Because you play an inputs Form", "alerts");
            $flag = true;
        }

        if ($flag) {
            unset($_SESSION["_errors"]);
            back();
        }

        if ($field != "password") {
            validateRequired($field, $value);
        }

        if ($field == "email") {
            validateEmail($field, $value);
            validateUnique($field, $value, "students", $_POST["id"]);
        } else if ($field == "phone") {
            validateEGPhone($field, $value);
            validateUnique($field, $value, "students", $_POST["id"]);
        } else if ($field == "age") {
            validateAge($field, $value);
        }
    }

    if (!empty($_SESSION["_errors"])) {
        back();
    }
}

function validateRequired(string $field, mixed $value)
{
    if ($value === null || trim($value) == "") {
        addError($field, "{$field} is Required");
    }
}

function validateEmail(string $field, mixed $value)
{

    if (empty($value)) {
        return;
    }

    $regex = "/^[A-Za-z][A-Za-z0-9\.\-]+@gmail.com$/";

    if (!preg_match($regex, $value)) {
        addError($field, "{$field} is must be to End 'gmail.com' Email.");
    }
}

function validateAge(string $field, mixed $value)
{

    if (empty($value)) {
        return;
    }

    $regex = "/^([0-9])?[0-9]$/";

    if (!preg_match($regex, $value)) {
        addError($field, "{$field} is must be between 7 to 60 years");
    }
}

function validateEGPhone(string $field, mixed $value)
{

    if (empty($value)) {
        return;
    }

    $regex = "/^(02)?01(0|1|2|5)[0-9]{8}$/";

    if (!preg_match($regex, $value)) {
        addError($field, "{$field} is must be to Egyptian Phone.");
    }
}

function validateUnique(string $field, mixed $value, string $tableName, ?int $exceptId = null)
{

    if (empty($value)) {
        return;
    }

    $DB = connection();

    $subQuery = "";

    if ($exceptId !== null) {
        $subQuery = "AND id != '{$exceptId}'";
    }

    $stmt = $DB->query("SELECT * 
                        FROM {$tableName} 
                        WHERE $field = '{$value}'
                        {$subQuery}
                        ;");

    $result = $stmt->fetchAll();

    if (!empty($result)) {
        addError($field, "{$field} already Exists.");
    }
}

function addError(string $field, string $msg, string $typeOfSession = "_errors")
{
    $_SESSION[$typeOfSession][$field][] = $msg;
}
