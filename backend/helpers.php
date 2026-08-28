<?php

function pr(mixed $data, bool $die = false)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';

    if ($die) {
        exit();
    }
}

function throwError(int $code, string $message)
{
    http_response_code($code);

    echo "{$message}";
    exit();
}

function throwAPIError(int $code, string $message)
{

    http_response_code($code);

    echo json_encode([
        "Status" => $code,
        "message" => $message
    ]);
    exit();
}

function back()
{
    $path = $_SERVER["HTTP_REFERER"];

    header("Location: {$path}");
    exit();
}


function getError(string $key)
{
    $htmlErr = "";

    if (isset($_SESSION["_errors"][$key])) {
        $htmlErr = "<p class='alert alert-danger mt-2'>{$_SESSION["_errors"][$key][0]}</p>";
        unset($_SESSION["_errors"][$key]);
    }
    return $htmlErr;
}

function old(string $key)
{
    $inputValue = "";
    if (isset($_SESSION['_old'][$key])) {
        $inputValue = $_SESSION['_old'][$key];
        unset($_SESSION["_old"][$key]);
    }
    return $inputValue;
}

function oldSearch(string $key)
{
    $inputValue = "";
    if (isset($_SESSION[$key])) {
        $inputValue = $_SESSION[$key];
        unset($_SESSION[$key]);
    }
    return $inputValue;
}
