<?php
session_start();
require_once __DIR__ . "/backend/helpers.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="Students System - A simple PHP & MySQL CRUD web app to add, edit, delete, search and manage student records with AJAX.">
    <meta name="keywords" content="students system, php, mysql, crud, student management, ajax, jquery, php project">
    <meta name="author" content="MA-reh">

    <title>Students System | PHP & MySQL Student Management</title>

    <meta property="og:type" content="website">
    <meta property="og:title" content="Students System">
    <meta property="og:description" content="A simple PHP & MySQL CRUD web app to add, edit, delete, search and manage student records with AJAX.">
    <meta property="og:image" content="http://ma-reh-system-students.atwebpages.com/assets/images/image.png">
    <meta property="og:url" content="http://ma-reh-system-students.atwebpages.com/">
    <meta property="og:site_name" content="Students System">
    <meta property="og:locale" content="en_US">

    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/index.responsive.css">

    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">

</head>

<body class="text-light">


    <div id="loadingPage">
        <div class="loader"></div>
    </div>

    <header id="StudentSystem" class="py-4">

        <div class="container-fluid px-5">

            <div class="row">
                <div class="col-xl-4 col-md-6 col-sm-7 mx-auto">
                    <div class="item">
                        <img src="assets/images/logo.png" alt="logo" class="img-fluid mx-auto d-block">
                        <h1 class="header-text h2 text-center my-4">Add New Students</h1>

                        <form action="backend/register.php" method="POST" class="px-5" id="addForm">
                            <div class="inputs mb-3">
                                <label for="firstName" class="form-label">First Name :</label>
                                <div class="input-group">
                                    <label for="firstName" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-user"></i>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter his/her First Name" name="firstName" id="firstName" value="<?= old('firstName') ?>">
                                </div>
                                <?= getError("firstName") ?>
                            </div>
                            <div class="inputs mb-3">
                                <label for="lastName" class="form-label">Last Name :</label>
                                <div class="input-group">
                                    <label for="lastName" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-user"></i>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter his/her Last Name" name="lastName" id="lastName" value="<?= old('lastName') ?>">
                                </div>
                                <?= getError("lastName") ?>
                            </div>
                            <div class="inputs mb-3">
                                <label for="Email" class="form-label">Email :</label>
                                <div class="input-group">
                                    <label for="Email" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-envelope"></i>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter his/her Email" name="email" id="Email" value="<?= old('email') ?>">
                                </div>
                                <?= getError("email") ?>
                            </div>
                            <div class="inputs mb-3">
                                <label for="Password" class="form-label">Password :</label>
                                <div class="input-group">
                                    <label for="Password" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-key"></i>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter his/her Password" name="password" id="Password" value="<?= old('password') ?>">
                                </div>
                                <?= getError("password") ?>
                            </div>
                            <div class="inputs mb-3">
                                <label for="Age" class="form-label">Age :</label>
                                <div class="input-group">
                                    <label for="Age" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-hashtag"></i>
                                    </label>
                                    <input type="number" class="form-control" min="7" placeholder="Enter his/her Age" name="age" id="Age" value="<?= old('age') ?>">
                                </div>
                                <?= getError("age") ?>
                            </div>
                            <div class="inputs mb-4">
                                <label for="Phone" class="form-label">Phone :</label>
                                <div class="input-group">
                                    <label for="Phone" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-phone"></i>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter his/her Phone" name="phone" id="Phone" value="<?= old('phone') ?>">
                                </div>
                                <?= getError("phone") ?>
                            </div>
                            <div class="d-flex">
                                <button type="submit" class="fw-semibold btn btn-success w-75 me-2">Add</button>
                                <button type="reset" class="fw-semibold btn btn-danger w-25" onclick="clearForm()">Clear</button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="col-xl-8">
                    <div class="item px-2">
                        <form action="" method="" class="mt-4 pt-5" id="formSearch">
                            <div class="mb-3">
                                <label for="Search" class="form-label">Search:</label>
                                <div class="input-group">
                                    <label for="Search" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </label>
                                    <input type="search" class="form-control" placeholder="Search..." name="search" id="Search" value="<?= oldSearch('search') ?>">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Search</button>
                        </form>
                        <div class="table-responsive mt-5 pb-2">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Password</th>
                                        <th scope="col">Age</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php include __DIR__ . "/components/trOfStudents.php" ?>

                                </tbody>
                            </table>
                            <h6 class="alert alert-warning text-center d-none">There are No Student For Your Search</h6>
                        </div>
                        <div class="table-responsive mt-2">
                            <nav>
                                <ul class="pagination justify-content-center mb-0">
                                    <?php include __DIR__ . "/components/pagination.php" ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <script src="assets/js/plugins/jquery.js"></script>
    <script src="assets/js/plugins/sweetAlert.js"></script>
    <script src="assets/js/functions.js"></script>
    <script src="assets/js/searchAJAX.js"></script>

    <script>
        <?php
        if (isset($_SESSION['alerts']['typeAlert'])) {
            echo "        function showAlertError() {
            Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 4000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            }).fire({
                icon: '{$_SESSION['alerts']['typeAlert'][0]}',
                title: '{$_SESSION['alerts']['typeAlert'][1]}'
            });
        }";


            echo "showAlertError()";
            unset($_SESSION['alerts']['typeAlert']);
        }
        ?>

        function clearForm() {
            <?php
            unset($_SESSION['_errors']);
            unset($_SESSION['_old']);
            ?>

            let alerts = document.querySelectorAll("p.alert.alert-danger");
            let form = document.querySelectorAll("#addForm input");
            form.forEach((input) => {
                input.setAttribute("value", "");
            });
            alerts.forEach(function(alert) {
                alert.classList.add("d-none");
            });

        }
    </script>




</body>

</html>