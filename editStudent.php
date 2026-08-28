<?php


require_once __DIR__ . "/backend/helpers.php";
require_once __DIR__ . "/backend/getStudent.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Students System</title>
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
                        <h1 class="header-text h2 text-center my-4">Edit Student Data</h1>

                        <form action="backend/editStudentProcess.php" method="POST" class="px-5" id="addForm">
                            <input type="hidden" name="id" value="<?= old('id') ?>">

                            <div class="inputs mb-3">
                                <label for="firstName" class="form-label">First Name :</label>
                                <div class="input-group">
                                    <label for="firstName" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-user"></i>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Edit his/her First Name" name="firstName" id="firstName" value="<?= old('firstName') ?>">
                                </div>
                                <?= getError("firstName") ?>
                            </div>
                            <div class="inputs mb-3">
                                <label for="lastName" class="form-label">Last Name :</label>
                                <div class="input-group">
                                    <label for="lastName" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-user"></i>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Edit his/her Last Name" name="lastName" id="lastName" value="<?= old('lastName') ?>">
                                </div>
                                <?= getError("lastName") ?>
                            </div>
                            <div class="inputs mb-3">
                                <label for="Email" class="form-label">Email :</label>
                                <div class="input-group">
                                    <label for="Email" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-envelope"></i>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Edit his/her Email" name="email" id="Email" value="<?= old('email') ?>">
                                </div>
                                <?= getError("email") ?>
                            </div>
                            <div class="inputs mb-3">
                                <label for="Password" class="form-label">Password :</label>
                                <div class="input-group">
                                    <label for="Password" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-key"></i>
                                    </label>
                                    <input type="text" class="form-control" placeholder="" name="password" id="Password" value="<?= old('password') ?>">
                                </div>
                                <?= getError("password") ?>
                            </div>
                            <div class="inputs mb-3">
                                <label for="Age" class="form-label">Age :</label>
                                <div class="input-group">
                                    <label for="Age" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-hashtag"></i>
                                    </label>
                                    <input type="number" class="form-control" placeholder="Edit his/her Age" name="age" id="Age" value="<?= old('age') ?>">
                                </div>
                                <?= getError("age") ?>
                            </div>
                            <div class="inputs mb-4">
                                <label for="Phone" class="form-label">Phone :</label>
                                <div class="input-group">
                                    <label for="Phone" class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-phone"></i>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Edit his/her Phone" name="phone" id="Phone" value="<?= old('phone') ?>">
                                </div>
                                <?= getError("phone") ?>
                            </div>
                            <div class="d-flex">
                                <button type="submit" class="fw-semibold btn btn-info text-light w-75 me-2">Edit</button>
                                <button type="reset" class="fw-semibold btn btn-danger w-25" onclick="clearForm()">Clear</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </header>

    <script src="assets/js/plugins/jquery.js"></script>
    <script src="assets/js/plugins/sweetAlert.js"></script>
    <script src="assets/js/plugins/wow.min.js"></script>
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