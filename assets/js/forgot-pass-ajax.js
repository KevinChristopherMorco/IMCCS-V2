function forgotPassEmailRegex() {
    // get value of input email
    var email = $("#forgot-email").val();
    // use reular expression
    var reg = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.[a-zA-Z](?:[a-zA-Z0-9-]*[a-zA-Z0-9])+(?:\.[a-zA-Z]{2,})+$");
    if (reg.test(email)) {
        return true;
    } else {
        return false;
    }
}
$("#forgot-email").keyup(function () {
    var email = $(this).val().trim();

    if (email != '') {
        if (!forgotPassEmailRegex()) {
            $('.email-input').removeClass('is-valid');
            $('.email-input').addClass('is-invalid');
            $('.email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is invalid format');
            $('.email-feedback').removeClass('valid-feedback');
            $('.email-feedback').addClass('invalid-feedback');
            $('.empty-field-email').hide();
        } else {
            $('.email-input').addClass('is-valid');
            $('.email-input').removeClass('is-invalid');
            $('.email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is valid');
            $('.email-feedback').addClass('valid-feedback');
            $('.email-feedback').removeClass('invalid-feedback');
            $('.empty-field-email').hide();
        }
    } else {
        $('.myEmail').addClass('is-invalid');
        $('.email-feedback').addClass('invalid-feedback');
        $('.empty-field-email').show();
        $('.email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your email');
    }
})
$('#forgot-pass').submit(function (event) {
    event.preventDefault();

    var email = $('#forgot-email').val();

    $(this).removeClass('was-validated')
    $(".forgot-pass input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });
    if ($(".forgot-pass input").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {
        $.ajax({
            type: "POST",
            url: "query/mailer.php",
            data: {
                email: email

            },
            beforeSend: function () {
                Swal.fire({
                    title: 'Please wait for a second...',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                });
            },
            success: function (data) {
                var datas = data;
                trimData = datas.trim();

                console.log(trimData)

                if (trimData === "No Account") {
                    Swal.fire({
                        title: 'Account does not exist!',
                        text: "Please put your existing account",
                        icon: 'error',
                        confirmButtonColor: '#800000',
                        confirmButtonText: 'OK'
                    })
                } else if (trimData === "Account") {
                    Swal.fire({
                        title: 'Password reset link sent!',
                        text: "Please check your email",
                        icon: 'success',
                        confirmButtonColor: '#800000',
                        confirmButtonText: 'OK'
                    })
                } else if (trimData === "Undeliverable") {
                    Swal.fire({
                        title: 'Email does not exist!',
                        text: "Please register your existing email account",
                        icon: 'error',
                        confirmButtonColor: '#800000',
                        confirmButtonText: 'OK'
                    })
                } else {
                    Swal.fire({
                        title: 'Cannot proceed to your request!',
                        text: "Email Server is down, you can check again later!",
                        icon: 'error',
                        confirmButtonColor: '#800000',
                        confirmButtonText: 'OK'
                    })
                }

            },
            error: function (xhr, status, error) {


            }
        });
    }

});

/*FORGOT PASS AFTER CLICK EMAIL */
function invalidInput() {
    Swal.fire({
        title: 'Some inputs are invalid!',
        text: "Please check your inputs if they're valid.",
        icon: 'error',
        confirmButtonColor: '#800000',
        confirmButtonText: 'OK',
        allowOutsideClick: false,

    })

}

$('#user-forgot-password, #user-forgot-confirmpassword').on('keyup', function () {
    var password = $('#user-forgot-password').val().trim();
    if (password != '') {

        if ($('#user-forgot-password').val() == $('#user-forgot-confirmpassword').val()) {
            $('.password-feedback').show();
            $('.password-feedback').html('<i class="fa-solid fa-circle-check"></i> Password matched');
            $('.myCpwdClass').addClass('is-valid');
            $('.password-feedback').addClass('valid-feedback');
            $('.myCpwdClass').removeClass('is-invalid');
            $('.password-feedback').removeClass('invalid-feedback');
            $('#password-validation-match').addClass('valid');
            $('#password-validation-match').removeClass('invalid');



        } else {
            $('.password-feedback').show();
            $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Password does not match');
            $('.myCpwdClass').addClass('is-invalid');
            $('.password-feedback').addClass('invalid-feedback');
            $('.myCpwdClass').removeClass('is-valid');
            $('.password-feedback').removeClass('valid-feedback');
            $('#password-validation-match').addClass('invalid');
            $('#password-validation-match').removeClass('valid');


        }

        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if ($('#user-forgot-password').val().match(lowerCaseLetters)) {
            $('#password-validation-lowercase').addClass('valid');
            $('#password-validation-lowercase').removeClass('invalid');
        } else {
            $('#password-validation-lowercase').addClass('invalid');
            $('#password-validation-lowercase').removeClass('valid');
            $('.myCpwdClass').addClass('is-invalid');
            $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Password validation is not met');
            $('.password-feedback').addClass('invalid-feedback');
        }


        // Validate capital letters
        var upperCaseLetters = /[A-Z]/g;
        if ($('#user-forgot-password').val().match(upperCaseLetters)) {
            $('#password-validation-uppercase').addClass('valid');
            $('#password-validation-uppercase').removeClass('invalid');
        } else {
            $('#password-validation-uppercase').addClass('invalid');
            $('#password-validation-uppercase').removeClass('valid');
            $('.myCpwdClass').addClass('is-invalid');
            $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Password validation is not met');
            $('.password-feedback').addClass('invalid-feedback');
        }

        // Validate numbers
        var numbers = /[0-9]/g;
        if ($('#user-forgot-password').val().match(numbers)) {
            $('#password-validation-number').addClass('valid');
            $('#password-validation-number').removeClass('invalid');
        } else {
            $('#password-validation-number').addClass('invalid');
            $('#password-validation-number').removeClass('valid');
            $('.myCpwdClass').addClass('is-invalid');
            $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Password validation is not met');
            $('.password-feedback').addClass('invalid-feedback');
        }

        // Validate length
        if ($('#user-forgot-password').val().length >= 8) {
            $('#password-validation-length').addClass('valid');
            $('#password-validation-length').removeClass('invalid');
        } else {
            $('#password-validation-length').addClass('invalid');
            $('#password-validation-length').removeClass('valid');
            $('.myCpwdClass').addClass('is-invalid');
            $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Password validation is not met');
            $('.password-feedback').addClass('invalid-feedback');
        }
    } else {
        $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your password');
        $('.myCpwdClass').addClass('is-invalid');
        $('.password-feedback').addClass('invalid-feedback');
        $('.password-feedback').show();
        $('#password-validation-lowercase').addClass('invalid');
        $('#password-validation-capital').addClass('invalid');
        $('#password-validation-number').addClass('invalid');
        $('#password-validation-length').addClass('invalid');
        $('#password-validation-lowercase').removeClass('valid');
        $('#password-validation-capital').removeClass('valid');
        $('#password-validation-number').removeClass('valid');
        $('#password-validation-length').removeClass('valid');

    }
})

$(".form-submit-forgotpass").on("submit", function (event) {

    var password = $('#user-forgot-password').val();
    var token = $('#forgotpass-token').val();
    $(this).removeClass('was-validated')
    $(".form-submit-forgotpass input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });
    if ($(".form-submit-forgotpass input").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {


        $.ajax({
            type: "POST",
            url: '../../query/change-password.php',
            data: {
                newpassword: password,
                token: token
            },
            success: function (data) {

                Swal.fire({
                    title: 'Password Changed!',
                    text: "Click OK to redirect to the homepage",
                    icon: 'success',
                    confirmButtonColor: '#800000',
                    confirmButtonText: 'OK'
                }).then(function () {
                    window.location.href = 'https://imccs.online'
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr);
            }
        });
    }
})
/*FORGOT PASS END */