<!-- Modal -->
<div class="modal landing-page-modal fade" id="myModalss" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">IMCCS form</h5>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="user-registration">
                    <h5 class="mb-4">Please provide the correct details:</h5>
                    <input type="text" class="form-control" id="user-bdate" placeholder="Choose your birthdate" onfocus="(this.type='date')">

                    <select class="form-select" id="user-add-genders">
                        <option selected disabled>Select your gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Gay">Gay</option>
                        <option value="Lesbian">Lesbian</option>
                        <option value="Bisexual">Bisexual</option>
                        <option value="Asexual">Asexual</option>
                        <option value="Transgender Male">Transgender Male</option>
                        <option value="Transgender Female">Transgender Female</option>
                    </select>

                    <input type="hidden" class="form-control" id="user-idsession" value=<?php echo $_SESSION['user_id']; ?>>

            </div>
            <div class="modal-footer">
                <!--
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    -->
                <a href="logout.php"  class="btn btn-secondary">Go back</a>
                <input type="submit" id="submit" name="save" value="Done" class="btn btn-submit">
            </div>
            </form>
        </div>
    </div>
</div>

<div class="landing-page" id="landing-page">
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
                    gender: gender
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
        $.ajax({
            url: 'query/input-validation/validate-check-id.php',
            type: 'post',
            data: {
                id: id
            },
            dataType: "json",

            success: function(response) {
                console.log(response)

                if (response == 'ID Exists') {
                    $('#myModalss').modal("hide");
                    $("#landing-page").css("filter", "none");
                    $(".navbar-header").css("filter", "none");
                } else {
                    $("#landing-page").css("filter", "blur(5px)");
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