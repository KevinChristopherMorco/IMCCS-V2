<?php
include_once('query/login-registration-page/login-query.php');
include_once('templates/header.php');

?>
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
include("section-pages/start-page.php");

/*

    if ($page != '') {
        if ($page == "login") {
            include("section-pages/login.php");
        } else if ($page == "forgot-password") {
            include("section-pages/forgot-password/forgot-password.php");
        } else if ($page == "forgot-password-change") {
            include("section-pages/forgot-password/forgot-password.php");
        }
    } else {
        include("section-pages/start-page.php");
        include('templates/footer.php');
    }
    */
?>

<?php
include("templates/footer-elements.php");
include('templates/footer.php');
?>


<SCript>
    $(document).ready(function() {
        $('#check').click(function() {
            $(this).is(':checked') ? $('#user-add-password').attr('type', 'text') : $('#user-add-password').attr('type', 'password');
        });
    });

    var togglePassword = document.querySelector("#toggle-password");
    var toggleConfirmPassword = document.querySelector("#toggle-confirm-password");
    var password = document.querySelector("#user-add-password");
    var confirmPassword = document.querySelector("#user-add-confirmpassword");

    togglePassword.addEventListener("click", function() {
        // toggle the type attribute
        var type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // toggle the icon
        this.classList.toggle("fa-eye");
    });

    toggleConfirmPassword.addEventListener("click", function() {
        // toggle the type attribute
        var type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
        confirmPassword.setAttribute("type", type);

        // toggle the icon
        this.classList.toggle("fa-eye");
    });
</SCript>

<script>
    <?php @$page = $_GET['page']; ?>
    <?php if ($page == "forgot-password") { ?>
        $('.home-item').hide()

    <?php } ?>
</script>


</body>

</html>