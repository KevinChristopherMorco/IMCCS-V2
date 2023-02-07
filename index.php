<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.all.min.js"></script>
<?php include_once('database/config.php'); ?>
<?php session_start() ?>
<?php
include_once('query/login-registration-page/code-login.php');
include_once('query/login-registration-page/login-query.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#800000">

    <title>IMCCS</title>
    <!-- ====== Header Elements ====== -->
    <?php
    include_once('templates/header.php');
    ?>
    <!-- ====== Header Header Elements End ====== -->
</head>

<body>
    <!-- ====== Header Navigation Bar ====== -->
    <?php
    include_once('templates/navbar.php');
    ?>
    <?php
    include_once('modal/register-student.php');
    ?>
    <?php
    include_once('modal/register-institution.html');
    ?>
    <!-- PHP CODE USED FOR LOADING DYNAMICALLY PAGES WITHOUT RELOADING THE WHOLE ROUTE-->

    <?php
    @$page = $_GET['page'];
    //include('templates/footer.php');


    if ($page != '') {
        if ($page == "landing-page") {
            include("landing-page.php");
        } else if ($page == "login") {
            include("section-pages/login.php");
        } else if ($page == "forgot-password") {
            include("section-pages/forgot-password/forgot-password.php");
        } else if ($page == "forgot-password-change") {
            include("section-pages/forgot-password/forgot-password.php");
        }
    } else {
        include("section-pages/startup-page.php");
    }

    ?>

    <?php include("templates/footer-elements.php"); ?>





</body>

</html>