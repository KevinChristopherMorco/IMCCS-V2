<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('location: index.php');
}
?>

<?php include_once('database/config.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0">-->
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />

    <title>IMCCS</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.all.min.js"></script>
    <?php include('templates/header.php') ?>


    <style>
        #loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('assets/front-page-assets/loader/loader.gif') 50% 50% no-repeat rgb(249, 249, 249);
        }
    </style>


</head>

<body id="body">
    <a href="javascript:void(0)" class="help-link">
        <i class="fa-solid fa-circle-question help-icon"></i></a>
    <!--
        <a href="javascript:void(0)" class="exit-fullscreen">
        <i class="fa-solid fa-minimize"></i></a>
    -->
    <?php
    //include('student-sidebar.php')

    $arrNew = include('templates/navbar.php')

    ?>


    <?php
    @$page = $_GET['page'];
    if ($page != '') {
        if ($page == "user-home") {
            include("section-pages/user-home.php");
            include("section-pages/help-pages/test-help.php");
        } else if ($page == "user-browse-topics") {
            include("section-pages/topic-page/user-browse-topics.php");
            include("section-pages/help-pages/test-help2.php");
        } else if ($page == "user-browse-assessment") {
            include("section-pages/assessment-page/user-browse-assessment.php");
        } else if ($page == "user-update-profile-password") {
            include("section-pages/account-setting/user-update-profile-password.php");
        } else if ($page == "user-preview-topic") {
            include("section-pages/topic-page/user-preview-topic.php");
        } else if ($page == "user-progress-topic") {
            include("section-pages/topic-page/user-progress-topic.php");
        } else if ($page == "user-progress-assessment") {
            include("section-pages/assessment-page/user-progress-assessment.php");
        } else if ($page == "user-retake-assessment") {
            include("section-pages/retake-page/user-retake-assessment.php");
        } else if ($page == "result") {
            include("section-pages/assessment-page/result.php");
        } else if ($page == "retake-result") {
            include("section-pages/retake-page/retake-result.php");
        } else if ($page == "user-view-retakes") {
            include("section-pages/retake-page/user-view-retakes.php");
        } else {
            include("assets/404/404.html");
        }
    }
    ?>



    <?php
    @$subpage = $_GET['subpage'];
    if ($subpage != '') {
        if ($subpage == "change-password") {
            include("section-pages/account-setting/change-password.php");
        } else if ($subpage == "personal-info") {
            include("section-pages/account-setting/user-personal-info.php");
        } else if ($subpage == "user-browse-assessment") {
            include("section-pages/user-browse-assessment.php");
        } else if ($subpage == "user-update-profile-password") {
            include("section-pages/user-update-profile-password.php");
        } else if ($subpage == "user-preview-topic") {
            include("section-pages/user-preview-topic.php");
        } else {
            include("assets/404/404.html");
        }
    }
    ?>
<?php
//INCLUDE HELP LINK MODAL
 include_once('section-pages/help-pages/test-help.php');
?>


    <?php
    @$lesson_id = $_GET['title'];
    if ($lesson_id != '') {
        /*
        if ($lesson_id == "Phishing Attacks") {
            include("section-pages/topic-pages/phishing-attacks.php");
        }else if ($lesson_id == "Physical Security") {
            include("section-pages/topic-pages/physical-security.php");
        } else {
            include("assets/404/404.html");
        }*/
        include("section-pages/topic-pages/view-topic-page.php");
    }
    ?>


    <?php include('templates/footer-elements.php') ?>

    <script>
        $(document).ready(function() {

            document.onreadystatechange = function() {
                // page fully load
                if (document.readyState == "complete") {
                    // hide loader after 2 seconds
                    $("#loader").fadeOut(1000, function() {});
                }
            }
        });
    </script>

    <script>
        $(function($) {
            let url = window.location.href;
            $('ul > li a').each(function() {
                if (this.href === url) {
                    $(this).closest('a').addClass('active');
                }
            });
        });
    </script>

    <script>
        $(function($) {
            let url = window.location.href;
            $('ul.navbar-nav > li.nav-item a.ud-menu').each(function() {
                if (this.href === url) {
                    $(this).closest('a.ud-menu').addClass('active');
                }
            });
        });
    </script>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.help-link', function() {

                <?php /*
            @$page = $_GET['page'];
            @$help = $_GET['help'];

            if ($help != '') {
                if ($page == "user-home"  && $help == "help-user") { ?>
                    window.location = 'home-student.php?page=user-home&help=help-user';
            <?php     } else {
                    include("assets/404/404.html");
                }
            }
            ?>
            // window.location = 'home-student.php?page=user-home&help=help-user';

            <?php
            @$page = $_GET['page'];

            if ($page == "user-home") { ?>
                $('#welcome-help').modal("show");
                // window.location.href = 'home-student.php?help=help-user';
            <?php  } else if ($page == "user-browse-topics") { ?>
                $('#topic-help').modal("show");

            <?php   } else {
                include("assets/404/404.html");
            }
           */ ?>

                console.log($('#welcome-help'))
                $('#welcome-help').modal("show");
            });
        });


        $(function() {
            $('#welcome-help').modal({
                show: false
            }).on('hidden.bs.modal', function() {
                $(this).find('video')[0].pause();
            });
        });
    </script>

    <script>
        $(document).ready(function($) {
            $('#playButton').click(function() {
                $('#myVideo')[0].paused ? $('#myVideo')[0].play() : $('#myVideo')[0].pause();
            });
        });
    </script>
</body>

</html>