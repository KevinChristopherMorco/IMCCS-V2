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
    include('templates/header.php');
    ?>
    <!-- ====== Header Header Elements End ====== -->
</head>

<body>
    <!-- ====== Header Navigation Bar ====== -->
    <?php
    include_once('templates/navbar.php');
    ?>
    <?php
    //include_once('modal/register-student.php');
    ?>
    <?php
    //include_once('modal/register-institution.html');
    ?>
    <!-- PHP CODE USED FOR LOADING DYNAMICALLY PAGES WITHOUT RELOADING THE WHOLE ROUTE-->

    <?php
    @$page = $_GET['page'];
    //include('templates/footer.php');


    if ($page != '') {
        if ($page == "imccs-home") {
            include("imccs-home.php");
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

 <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/clientjs@0.1.11/dist/client.min.js"></script>
    -->
    <script src="assets/js/clientjs-master/dist/client.min.js"></script>
    <script src="assets/js/crypto-js/crypto-js.js"></script>

    <script>
        var browserFingerprint = localStorage.getItem("browserFingerprint");
        if (!browserFingerprint) {
            var client = new ClientJS();

            // Get browser fingerprint
            var browserPrint = client.getFingerprint();
/*
            // Get canvas fingerprint
            var canvasPrint = client.getCanvasPrint();

            // Get screen resolution
            var resolution = client.getCurrentResolution();

            // Get timezone
            var timezone = client.getTimeZone();

            // Get plugins
            var plugins = client.getPlugins();
            var fonts = client.getFonts(); // Get Fonts
            */

            // Combine fingerprints and other information
            var combinedPrint = browserPrint;

            // Hash the combined fingerprint to make it more secure
         //   var hashedPrint = CryptoJS.SHA256(combinedPrint).toString();

            browserFingerprint = combinedPrint;
            localStorage.setItem("browserFingerprint", browserFingerprint);
        }
        /*
        var browserFingerprint = localStorage.getItem("browserFingerprint");
        if (!browserFingerprint) {
            var client = new ClientJS();

            // Get browser fingerprint
            var browserPrint = client.getFingerprint();

            // Get canvas fingerprint
            var canvasPrint = client.getCanvasPrint();

            // Get screen resolution
            var resolution = client.getCurrentResolution();

            // Get timezone
            var timezone = client.getTimeZone();

            // Get plugins
            var plugins = client.getPlugins();
            var fonts = client.getFonts(); // Get Fonts

            // Combine fingerprints and other information
            var combinedPrint = browserPrint + canvasPrint + resolution + timezone + plugins + fonts;

            // Hash the combined fingerprint to make it more secure
            var hashedPrint = CryptoJS.SHA256(combinedPrint).toString();

            browserFingerprint = hashedPrint;
            localStorage.setItem("browserFingerprint", browserFingerprint);
        } */

        $("#code-login-form").on("submit", function(event) {

            var code = $('#code').val();
            console.log(browserFingerprint)

            if ($("#code-login-form input").hasClass('is-invalid')) {
                event.preventDefault();
                invalidInput()
            } else {


                $.ajax({
                    type: "POST",
                    url: 'query/login-registration-page/code-login.php',
                    data: {
                        code: code,
                        visitorId: browserFingerprint
                    },
                    success: function(data) {

                        var datas = data;
                        trimData = datas.trim();

                        console.log(trimData)
                        if (trimData === 'Code Exist') {
                            window.location.href = 'index.php?page=imccs-home'
                        } else if (trimData === 'Code Not Exist') {
                            Swal.fire({
                                title: 'Institution code does not exist',
                                text: 'Please input a valid institution code, or contact the administrator for further details',
                                icon: 'warning',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            });
                        } else if (trimData === 'Inactive') {
                            Swal.fire({
                                title: 'This institution is now inactive',
                                text: 'Contact the administrator for further details',
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
        /*
        var visitorId;
        // Initialize the agent at application startup.
        var fpPromise = import('https://fpjscdn.net/v3/Snaga4qAZRcoqxtY0oc6')
            .then(FingerprintJS => FingerprintJS.load())

        // Get the visitor identifier when you need it.
        fpPromise
            .then(fp => fp.get())
            .then(result => {
                // This is the visitor identifier:
                     visitorId = result.visitorId
            })
            */

        /*
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function setCookie(cname, cvalue, exdays) {
  var d = new Date();
  d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
  var expires = "expires="+d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

var uniqueID = getCookie("unique_id");
if (!uniqueID) {
  uniqueID = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
  setCookie("unique_id", uniqueID, 365);
}

console.log("Unique ID: " + uniqueID);
*/
    </script>


</body>

</html>