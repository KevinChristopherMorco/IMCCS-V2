<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.all.min.js"></script>
<?php include('database/config.php'); ?>

<?php session_start() ?>
<?php
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

    <script>
        $(document).ready(function() {
            if (window.location.href.indexOf("?page=") !== -1) {} else {
                $(".navbar-header").css("background-color", "#800000");

            }
        });
    </script>



    <script>
        $("#code-login-form").on("submit", function(event) {

            var code = $('#code').val();


            if ($("#code-login-form input").hasClass('is-invalid')) {
                event.preventDefault();
                invalidInput()
            } else {


                $.ajax({
                    type: "POST",
                    url: 'query/login-registration-page/code-login.php',
                    data: {
                        code: code
                    },
                    success: function(data) {

                        var datas = data;
                        trimData = datas.trim();

                        console.log(trimData)
                        if (trimData === 'Code Exist') {
                            window.location.href = 'index.php?page=landing-page'
                        } else if (trimData === 'Code Not Exist') {
                            Swal.fire({
                                title: 'Institution code does not exist',
                                text: 'Please input a valid institution code, or contact the administrator for further details',
                                icon: 'warning',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            Swal.fire({
                                title: 'Please input an institution code',
                                text: 'Please input an institution code',
                                icon: 'error',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            });
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error(xhr);
                        console.error(error);
                    }
                });
            }
        })
    </script>


</body>

</html>