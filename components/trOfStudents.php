<?php

require_once __DIR__ . "/../backend/getStudents.php";

$page = 1;
$search = "";
if (isset($_GET["page"]) && $_GET["page"] > 1) {
    $page = $_GET["page"];
}
if (isset($_GET["search"]) && !empty($_GET["search"])) {
    $search = $_GET["search"];
}



$dataOfStudents = getStudents($search, $page);

$htmlTrTable = "";

if (!empty($dataOfStudents)) {

    $students = $dataOfStudents;
    $count = 1;
    

    foreach ($students as $student) {

        $shortPass = substr($student['password'], 0, 15);

        $htmlTrTable .= "   <tr data-id='{$student['id']}'>
                                <th scope='row'>{$student['id']}</th>
                                <td>{$student['first_name']} {$student['last_name']}</td>
                                <td>{$student['email']}</td>
                                <td>{$shortPass}...</td>
                                <td>{$student['age']}</td>
                                <td>{$student['phone']}</td>
                                <td>
                                    <div class='buttons'>
                                        <a href='editStudent.php?id={$student['id']}' class='btn btn-info text-light me-1'>Edit</a>
                                        <button class='btn btn-danger' onclick='confirm(deleteStudent,{$student['id']})'>Delete</button>
                                    </div>
                                </td>
                            </tr> ";
        $count++;
    }
}

echo $htmlTrTable;
