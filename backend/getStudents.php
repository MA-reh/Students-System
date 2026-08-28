<?php

require_once __DIR__ . "/../database/connection.php";

function getStudents(string $search = '', int $page = 1)
{


    $DB = connection();

    $search = trim($search);

    $offset = ($page * 10) - 10;

    $stmt = $DB->query("SELECT * 
                        FROM students
                        WHERE
                            concat(first_name, ' ', last_name) LIKE '%$search%'
                            OR
                            email LIKE '%$search%'
                            OR
                            age LIKE '%$search%'
                            OR
                            phone LIKE '%$search%'
                        ORDER BY id DESC
                        LIMIT 10 offset {$offset}
                        ");


    $result = $stmt->fetchAll();

    return $result;
}

function getStudentsCount($search = "")
{

    $DB = connection();

    $subQuery = "";
    
    if (!empty($search)){
        $subQuery = "
            WHERE 
             concat(first_name, ' ', last_name) LIKE '%$search%'
                            OR
                            email LIKE '%$search%'
                            OR
                            age LIKE '%$search%'
                            OR
                            phone LIKE '%$search%'
        ";
    }

    $stmt = $DB->query("SELECT count(*) AS total 
                        FROM students
                        {$subQuery}
                        ");


    $result = $stmt->fetch();

    return $result["total"];
}
