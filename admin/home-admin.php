<!DOCTYPE html>
<html lang="en">
<!-- DATABASE CONFIGURATION -->
<?php include_once('../database/config.php'); ?>

<!-- SESSION START USED FOR STORING DATABASE VALUES AND VIEWING THEM VIA ECHO-->
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('location: ../index.php');
}
?>



<!-- HEADER ELEMENTS-->

<head>
    <?php include('templates/header.php') ?>
    <style>
        #loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('assets/loader/hourglass.gif') 50% 50% no-repeat rgb(249, 249, 249);

        }
    </style>

</head>

<body id="body">
    <?php /*
    <div id="loader"> </div>

    <script>
        var $loading = $('#loader').hide();
        $(document)
            .ajaxStart(function() {
                $loading.slideDown(1);

            })
            .ajaxStop(function() {
                $loading.slideDown(1);


            });
    </script>
    */?>
    <!-- PHP CODE USED FOR LOADING DYNAMICALLY PAGES WITHOUT RELOADING THE WHOLE ROUTE-->
    <?php
    @$page = $_GET['page'];
    if ($page != '') {
        if ($page == "admin-dashboard") {
            include("pages/admin-dashboard.php");
        } else if ($page == "manage-institution") {
            include("pages/manage-institution.php");
        } else if ($page == "manage-student") {
            include("pages/manage-student.php");
        } else if ($page == "manage-users") {
            include("pages/manage-user.php");
        } else if ($page == "manage-faculty") {
            include("pages/manage-faculty.php");
        } else if ($page == "manage-question") {
            include("pages/manage-question.php");
        } else if ($page == "manage-lesson") {
            include("pages/manage-lesson.php");
        } else if ($page == "manage-faq") {
            include("pages/manage-faq.php");
        }else if ($page == "manage-feedback") {
            include("pages/manage-feedback.php");
        } else if ($page == "manage-assessment") {
            include("pages/manage-assessment.php");
        } else if ($page == "admin-account-setting") {
            include("pages/account-setting/admin-account-setting.php");
        } else {
            include("assets/404/404.html");
        }
    }

    @$subpage = $_GET['subpage'];
    if ($subpage != '') {
        if ($subpage == "view-user-assessment") {
            include("pages/assessment/view-user-assessment.php");
        } else if ($subpage == "view-user-assessment-scores") {
            include("pages/assessment/view-user-assessment-scores.php");
        } else if ($subpage == "view-assessment-summarys") {
            include("pages/assessment/view-assessment-summary.php");
        } else if ($subpage == "view-institution-scores") {
            include("pages/view-institution-scores.php");
        } else if ($subpage == "view-user-retake-scores") {
            include("pages/retake/view-user-retake-scores.php");
        }else if ($subpage == "view-retake-summary") {
            include("pages/retake/view-retake-summary.php");
        } else if ($subpage == "admin-personal-info") {
            include("pages/account-setting/admin-personal-info.php");
        } else if ($subpage == "admin-change-password") {
            include("pages/account-setting/admin-change-password.php");
        }  else {
            include("assets/404/404.html");
        }
    }
    ?>
    <!-- ADMIN SIDEBAR-->
    <?php include('admin-sidebar.php') ?>

    <!-- FOOTER ELEMENTS-->
    <?php include('templates/footer.php') ?>

    <script>
        $(document).ready(function() {

            document.onreadystatechange = function() {
                // page fully load
                if (document.readyState) {
                    // hide loader after 2 seconds
                    $("#loader").fadeOut(2000, function() {});
                }
            }



        });
    </script>

</body>

</html>