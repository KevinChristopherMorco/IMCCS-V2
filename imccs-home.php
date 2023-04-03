<?php

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
   header('Location: index.php');
   exit();
}
?>
<?php
include_once('modal/register-user.php');
?>
<div class="imccs-home" id="imccs-home">
    <?php
    include_once('query/login-registration-page/login-query.php');

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
    include('templates/footer.php');
    ?>


    <script>
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
    </script>

    <script>
        $('.home-item').show()


        <?php @$page = $_GET['page']; ?>
        <?php if ($page == "forgot-password") { ?>
            $('.home-item').hide()
        <?php } ?>
    </script>


</div>
<script>
    var date = new Date(2020, 11, 31);
    var dd = String(date.getDate()).padStart(2, '0');
    var mm = String(date.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = date.getFullYear();
    var today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("user-bdate").setAttribute("max", today);
</script>

<script>
    $("#user-registration").on("submit", function(event) {
        $("#user-registration input").each(function(e) {

            var checkEmptyInput = $(this);
            if (checkEmptyInput.val() == "") {
                checkEmptyInput.addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }

            if ($('#user-registration #user-add-genders')[0].selectedIndex <= 0) {
                $('#user-registration #user-add-genders').addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }

        });
        var id = $('#user-idsession').val();
        var bdate = $('#user-bdate').val();
        var gender = $('#user-add-genders').val();
        var institution_id = $('#user-institution-id').val();

        console.log(gender)
        if ($("#user-registration input").hasClass('is-invalid') || $("#user-registration select").hasClass('is-invalid')) {
            event.preventDefault();
            invalidInput()
        } else {
            $.ajax({
                type: "POST",
                url: 'query/login-registration-page/new-registration.php',
                data: {
                    id: id,
                    bdate: bdate,
                    gender: gender,
                    institution_id: institution_id
                },
                success: function(data) {
                    $('#myModalss').modal("hide");

                    var datas = data;
                    trimData = datas.trim();

                    console.log(trimData)
                    if (trimData === 'Registered') {
                        Swal.fire({
                                title: 'Welcome to IMCCS',
                                text: 'You can now browse topics and assessments',
                                icon: 'success',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'Get Started'
                            })
                            .then((willRefresh) => {
                                if (willRefresh) {
                                    location.reload();
                                }
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

<script>
    $(document).ready(function() {
        var id = $('#user-idsession').val();
        var institution_id = $('#user-institution-id').val();

        $.ajax({
            url: 'query/input-validation/validate-check-id.php',
            type: 'post',
            data: {
                id: id,
                institution_id: institution_id

            },
            dataType: "json",

            success: function(response) {
                console.log(response)

                if (response == 'ID Exists') {
                    $('#myModalss').modal("hide");
                    $("#imccs-home").css("filter", "none");
                    $(".navbar-header").css("filter", "none");
                } else {
                    $("#imccs-home").css("filter", "blur(5px)");
                    $(".navbar-header").css("filter", "blur(5px)");
                    $('#myModalss').modal("show");

                }


            }
        });
    });

    $('#user-registration #user-add-genders').on('change', function() {
        if ($('#user-registration #user-add-genders').val().length != "") {
            $('#user-registration #user-add-genders').addClass('is-valid');
            $('#user-registration #user-add-genders').removeClass('is-invalid');

        }
    });

    $('#user-registration #user-bdate').on('change', function() {
        if ($('#user-registration #user-bdate').val().length != "") {
            $('#user-registration #user-bdate').addClass('is-valid');
            $('#user-registration #user-bdate').removeClass('is-invalid');

        }
    });
</script>

</body>

</html>