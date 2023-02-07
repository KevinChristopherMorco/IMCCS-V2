
/* AJAX REGISTRATION PROCESS */
function validatePhoneNumber() {
    // get value of input email
    var contact = $("#user-add-contact").val();
    var updateContact = $("#user-update-contact").val();

    // use reular expression
    var reg = new RegExp("(09)\\d{9}");
    if (reg.test(contact) || reg.test(updateContact)) {
        return true;
    } else {
        return false;
    }

}

function validInteger() {
    // return theNumber.match(/^\d+$/) && parseInt(theNumber) > 0;

    var contact = $("#user-add-contact").val();

    var regex = /^[0-9]+$/;
    if (contact.match(regex)) {
        return true;
    }
}

function updatevalidInteger() {
    // return theNumber.match(/^\d+$/) && parseInt(theNumber) > 0;
    var updateContact = $("#user-update-contact").val();

    var regex = /^[0-9]+$/;
    if (updateContact.match(regex)) {
        return true;
    }
}

function validateEmail() {
    // get value of input email
    var email = $("#user-add-email").val();
    var updateEmail = $("#user-update-email").val();

    // use reular expression
  //  var reg = new RegExp("^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@(gmail|yahoo|hotmail)+\.(com|org)$");
    var reg = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.[a-zA-Z](?:[a-zA-Z0-9-]*[a-zA-Z0-9])+(?:\.[a-zA-Z]{2,})+$");

    if (reg.test(email) || reg.test(updateEmail)) {
        return true;
    } else {
        return false;
    }
}

function validatePassword() {
    // get value of input email
    var password = $("#user-add-password").val();
    // use reular expression
    var reg = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$");
    if (reg.test(password)) {
        return true;
    } else {
        return false;
    }

}

function invalidInput() {
    Swal.fire({
        title: 'Cannot proceed to next step!',
        text: "Please check your inputs if they're valid.",
        icon: 'error',
        confirmButtonColor: '#800000',
        confirmButtonText: 'OK',
        allowOutsideClick: false,

    })
}

function invalidEmpty() {
    Swal.fire({
        title: 'Some fields are invalid!',
        text: "Please check your inputs and fill up the form correctly.",
        icon: 'error',
        confirmButtonColor: '#800000',
        confirmButtonText: 'OK',
        allowOutsideClick: false,

    })
}

function invalidAnswer() {
    Swal.fire({
        title: 'Some inputs are empty!',
        text: "Please check if you've answered all the questions.",
        icon: 'error',
        confirmButtonColor: '#800000',
        confirmButtonText: 'OK',
        allowOutsideClick: false,

    })

}


$(document).ready(function () {

    jQuery(".sign-in").click(function () {
        $('#add_student_modal').modal('show');
        $("#submit").attr("disabled", true);
        $('#form1 input').blur(function () {
            if (!this.value) {
                $("#submit").attr("disabled", true);
            }
        });


        $('#user-add-password, #user-add-confirmpassword').on('keyup', function () {
            var password = $('#user-add-password').val().trim();

            if (password != '') {

                var lowerCaseLetters = /[a-z]/g;
                if ($('#user-add-password').val() == $('#user-add-confirmpassword').val()) {
                    $("#submit").attr("disabled", false);
                    $('.password-feedback').show();
                    $('.password-feedback').html('<i class="fa-solid fa-circle-check"></i> Password matched');
                    $('.myCpwdClass').addClass('is-valid');
                    $('.password-feedback').addClass('valid-feedback');
                    $('#password-validation-match').addClass('valid');
                    $('.myCpwdClass').removeClass('is-invalid');
                    $('.password-feedback').removeClass('invalid-feedback');
                    $('#password-validation-match').removeClass('invalid');


                } else {
                    $("#submit").attr("disabled", true);
                    $('.password-feedback').show();
                    $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Password does not match');
                    $('.myCpwdClass').addClass('is-invalid');
                    $('.password-feedback').addClass('invalid-feedback');
                    $('#password-validation-match').addClass('invalid');
                    $('.myCpwdClass').removeClass('is-valid');
                    $('.password-feedback').removeClass('valid-feedback');
                    $('#password-validation-match').removeClass('valid');

                }

                var lowerCaseLetters = /[a-z]/g;
                if ($('#user-add-password').val().match(lowerCaseLetters)) {
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
                if ($('#user-add-password').val().match(upperCaseLetters)) {
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
                if ($('#user-add-password').val().match(numbers)) {
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
                if ($('#user-add-password').val().length >= 8) {
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
                $('#password-validation-uppercase').addClass('invalid');
                $('#password-validation-capital').addClass('invalid');
                $('#password-validation-number').addClass('invalid');
                $('#password-validation-length').addClass('invalid');
                $('#password-validation-match').addClass('invalid');
            }
        });



        $('#user-add-firstname').on('keyup', function () {
            $('.feedback-fname').hide();
            if ($('#user-add-firstname').val().length == "") {
                $('#user-add-firstname').addClass('is-invalid');
                $('.feedback-fname').show();

            }
        });

        $('#user-add-lastname').on('keyup', function () {
            $('.feedback-lname').hide();
            if ($('#user-add-lastname').val().length == "") {
                $('#user-add-lastname').addClass('is-invalid');
                $('.feedback-lname').show();

            }
        });

        $('#user-add-gender').on('change', function () {
            $('#feedback-gender').hide();
            if ($('#user-add-gender').val().length != "") {
                $('#user-add-gender').addClass('is-valid');
                $('#user-add-gender').removeClass('is-invalid');

            } else {
                $('#feedback-gender').show();
                $('#feedback-gender').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your grade level');
            }
        });
        $('.customGender').on('keyup', function () {
            $('#feedback-gender').hide();
            if ($('.customGender').val().length == "") {
                $('#user-add-gender').addClass('is-invalid');
                $('#feedback-gender').show();

            } else {
                $('#user-add-gender').removeClass('is-invalid');
                $('#user-add-gender').addClass('is-valid');
                $('#feedback-gender').hide();
            }
        });

        //ALLOW CUSTOM GENDER
        var initialText = $('.editable').val();
        $('.customGender').val(initialText);

        $('#user-add-gender').change(function () {
            var selected = $('option:selected', this).attr('class');
            var optionText = $('.editable').text();

            if (selected == "editable") {
                $('.customGender').show();


                $('.customGender').keyup(function () {
                    var editText = $('.customGender').val();
                    $('.editable').val(editText);
                    $('.editable').html(editText);
                });

            } else {
                $('.customGender').hide();
            }
        });
        // GENDER CUSTOM END


        $('#user-add-grade-level').on('change', function () {
            $('#feedback-grade-level').hide();
            if ($('#user-add-grade-level').val().length != "") {
                $('#user-add-grade-level').addClass('is-valid');
                $('#user-add-grade-level').removeClass('is-invalid');

            } else {
                $('#feedback-grade-level').show();
                $('#feedback-grade-level').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your grade level');
            }
        });


        $("#user-add-institution").keyup(function () {

            var institution = $(this).val().trim();

            if (institution != '') {


                $.ajax({
                    url: 'query/input-validation/validate-check-institution.php',
                    type: 'post',
                    data: {
                        institution: institution
                    },
                    dataType: "json",

                    success: function (response) {

                        if (response == 'Institution Exists') {
                            $('#institution-feedback').html('<i class="fa-solid fa-circle-check"></i> Institution available');
                            $('.myInstitution').addClass('is-valid');
                            $('.myInstitution').removeClass('is-invalid');
                            $('#institution-feedback').addClass('valid-feedback');
                            $('#institution-feedback').removeClass('invalid-feedback');
                        } else if (response == 'Institution Doesnt Exist') {
                            $('#institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Institution not available');
                            $('.myInstitution').removeClass('is-valid');
                            $('.myInstitution').addClass('is-invalid');
                            $('#institution-feedback').removeClass('valid-feedback');
                            $('#institution-feedback').addClass('invalid-feedback');
                        }


                    }
                });
            } else {
                $('#institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
            }

        });
        //FILTER INSTITUTION SELECT GRADE LEVEL

        var location = $('#user-add-grade-level');
        location.data('options', location.find('option'));
        $('#user-add-institution').on('change', function () {
            location.html(location.data('options'));
            if ($(this).val() == "LSPU" || $(this).val() == "ACTS") {
                location.find(".junior-high").remove();
                location.find('.junior-high:selected').remove();
            }

        });
        // FILTER INSTITUTION SELECT GRADE LEVEL END

        $("#user-add-email").keyup(function () {

            var email = $(this).val().trim();

            if (email != '') {

                $.ajax({
                    url: 'query/input-validation/validate-check-email.php',
                    type: 'post',
                    data: {
                        email: email
                    },
                    dataType: "json",

                    success: function (response) {

                        if (response == 'Email Exists') {
                            $('#email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is already taken');
                            $('#empty-field-email').hide();
                            $('.myEmail').removeClass('is-valid');
                            $('.myEmail').addClass('is-invalid');
                            $('#email-feedback').removeClass('valid-feedback');
                            $('#email-feedback').addClass('invalid-feedback');
                        } else if (!validateEmail()) {
                            $('.myEmail').removeClass('is-valid');
                            $('.myEmail').addClass('is-invalid');
                            $('#email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is invalid format');
                            $('#email-feedback').removeClass('valid-feedback');
                            $('#email-feedback').addClass('invalid-feedback');
                            $('#empty-field-email').hide();
                        } else {
                            $('.myEmail').addClass('is-valid');
                            $('.myEmail').removeClass('is-invalid');
                            $('#empty-field-email').hide();

                            $('#email-feedback').html('<i class="fa-solid fa-circle-check"></i> Email is valid');
                            $('#email-feedback').addClass('valid-feedback');
                            $('#email-feedback').removeClass('invalid-feedback');

                        }


                    }
                });
            } else {
                $('.myEmail').addClass('is-invalid');
                $('#email-feedback').addClass('invalid-feedback');
                $('#empty-field-email').show();
                $('#email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your email');


            }

        });

        $("#user-add-username").keyup(function () {

            var username = $(this).val().trim();

            if (username != '') {

                $.ajax({
                    url: 'query/input-validation/validate-check-username.php',
                    type: 'post',
                    data: {
                        username: username
                    },
                    dataType: "json",

                    success: function (response) {

                        if (response == 'Username Exist') {
                            $('#feedback-username').show();
                            $('#feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username is already taken');
                            $('.myUsername').addClass('is-invalid');
                            $('.myUsername').removeClass('is-valid');
                            $('#feedback-username').addClass('invalid-feedback');
                            $('#feedback-username').removeClass('valid-feedback');
                        } else if (username.length < 5) {
                            $('#feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username must be atleast 5 characters');
                            $('#feedback-username').show();
                            $('.myUsername').addClass('is-invalid');
                            $('.myUsername').removeClass('is-valid');
                            $('#feedback-username').addClass('invalid-feedback');
                            $('#feedback-username').removeClass('valid-feedback');
                        } else {
                            $('#feedback-username').html('<i class="fa-solid fa-circle-check"></i> Username is available');
                            $('#feedback-username').show();
                            $('.myUsername').addClass('is-valid');
                            $('.myUsername').removeClass('is-invalid');
                            $('#feedback-username').addClass('valid-feedback');
                            $('#feedback-username').removeClass('invalid-feedback');

                        }
                    }
                });
            } else {
                $('#feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your username');
                $('.myUsername').addClass('is-invalid');
                $('#feedback-username').addClass('invalid-feedback');

            }

        });

        $("#user-add-contact").keyup(function () {

            var contact = $(this).val().trim();

            if (contact != '') {

                $.ajax({
                    url: 'query/input-validation/validate-check-contact-no.php',
                    type: 'post',
                    data: {
                        contact: contact
                    },
                    dataType: "json",

                    success: function (response) {

                        if (response == 'This Number is Already Registered') {
                            $('#contact-feedback').show();
                            $('#contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number is already taken');
                            $('#empty-field-contact').hide();
                            $('.myContact').addClass('is-invalid');
                            $('.myContact').removeClass('is-valid');
                            $('#contact-feedback').removeClass('valid-feedback');
                            $('#contact-feedback').addClass('invalid-feedback');
                        } else if (!validInteger()) {
                            $('#contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format  only include numbers');
                            $('#contact-feedback').show();
                            $('#empty-field-contact').hide();
                            $('.myContact').addClass('is-invalid');
                            $('.myContact').removeClass('is-valid');
                            $('#contact-feedback').removeClass('valid-feedback');
                            $('#contact-feedback').addClass('invalid-feedback');
                        } else if (contact.length != 11) {
                            $('#contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number must be 11 numbers');
                            $('#contact-feedback').show();
                            $('#empty-field-contact').hide();
                            $('.myContact').addClass('is-invalid');
                            $('.myContact').removeClass('is-valid');
                            $('#contact-feedback').removeClass('valid-feedback');
                            $('#contact-feedback').addClass('invalid-feedback');
                        } else if (!validatePhoneNumber()) {
                            $('#contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format must include <b> 09 </b> at the beginning of contact number');
                            $('#contact-feedback').show();
                            $('#empty-field-contact').hide();
                            $('.myContact').addClass('is-invalid');
                            $('.myContact').removeClass('is-valid');
                            $('#contact-feedback').removeClass('valid-feedback');
                            $('#contact-feedback').addClass('invalid-feedback');
                        } else {
                            $('#contact-feedback').show();
                            $('#empty-field-contact').hide();
                            $('#contact-feedback').html('<i class="fa-solid fa-circle-check"></i> Contact number is valid');
                            $('#contact-feedback').addClass('valid-feedback');
                            $('#contact-feedback').removeClass('invalid-feedback');
                            $('.myContact').addClass('is-valid');
                            $('.myContact').removeClass('is-invalid');
                        }
                    }
                });
            } else {
                $('.myContact').addClass('is-invalid');
                $('#contact-feedback').addClass('invalid-feedback');

                $('#empty-field-contact').show();
                $('#contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');

            }

        });
    });
});



$("#form1").on("submit", function (e) {
    event.preventDefault();
    var forms = document.querySelectorAll('.needs-validation')
    var username = $("#user-add-username").val();
    var password = $("#user-add-password").val();
    var firstname = $("#user-add-firstname").val();
    var lastname = $("#user-add-lastname").val();
    var gender = $("#user-add-gender").val();

    var institution = $("#user-add-institution").val();
    var grade_level = $("#user-add-grade-level").val();
    var email = $("#user-add-email").val();
    var contact = $("#user-add-contact").val();
    var type = $(".type:checked").val();



    if ($('#form1')[0].checkValidity() === false) {
        event.stopPropagation();

    }
    /*
    else if (grecaptcha.getResponse() == "") {
        Swal.fire({
            title: 'Please complete the reCAPTCHA',
            icon: 'error',
            confirmButtonColor: '#800000',
            confirmButtonText: 'OK'
        })

    }*/ else {
        $.ajax({
            type: "POST",
            url: 'query/login-registration-page/registration.php',
            data: {
                username: username,
                password: password,
                usertype: type,
                fname: firstname,
                lname: lastname,
                gender: gender,
                institution: institution,
                grade_level: grade_level,
                email: email,
                contact: contact,
                //captcha: grecaptcha.getResponse()


            },
            dataType: "json",

            success: function (data) {
                console.log(data)

                if (data == 'Existing Code') {
                    Swal.fire({
                        title: 'Registration Complete!',
                        text: "You have successfully registered",
                        icon: 'success',
                        confirmButtonColor: '#800000',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result) {
                            // Do Stuff here for success
                            window.location = "index.php?page=login";
                        } else {
                            // something other stuff
                        }

                    })
                } else if (data == 'Email Exists Already') {
                    Swal.fire({
                        title: 'Registration Failed!',
                        text: "Email Already Exists, try another one",
                        icon: 'error',
                        showCancelButton: true,
                        confirmButtonColor: '#800000',
                        confirmButtonText: 'OK',
                        reverseButtons: true,
                        allowOutsideClick: false,


                    })
                } else if (data == 'Username Length is Invalid') {
                    Swal.fire({
                        title: 'Registration Failed!',
                        text: "Invalid Username, try another one",
                        icon: 'error',
                        showCancelButton: true,
                        confirmButtonColor: '#800000',
                        confirmButtonText: 'OK',
                        reverseButtons: true,
                        allowOutsideClick: false,

                    })

                } else if (data == 'Contact Number Length is Invalid') {
                    Swal.fire({
                        title: 'Registration Failed!',
                        text: "Invalid Contact Number, Must be 11 characters",
                        icon: 'error',
                        showCancelButton: true,
                        confirmButtonColor: '#800000',
                        confirmButtonText: 'OK',
                        reverseButtons: true,
                        allowOutsideClick: false,

                    })
                } else {
                    Swal.fire({
                        title: 'Registration Failed!',
                        text: "Your institution doesn't exist on our database, try again next time",
                        icon: 'error',
                        showCancelButton: true,
                        confirmButtonColor: '#800000',
                        confirmButtonText: 'OK',
                        reverseButtons: true,
                        allowOutsideClick: false,

                    })
                }
            },
            error: function (xhr, status, error) {
                //console.error(xhr);
                console.log(error)


            }
        });
    }
    //$('#form1').addClass('was-validated');
});


/* AJAX REGISTRATION PROCESS END */

/*REGISTRATION MODAL AJAX */

// Default tab
$(".tab").css("display", "none");
$("#tab-1").css("display", "block");

function run(hideTab, showTab) {
    if (hideTab < showTab) { // If not press previous button
        // Validation if press next button
        var currentTab = 0;
        var fname = document.getElementById("fname");
        x = $('#tab-' + hideTab);
        y = $(x).find("input")
        for (i = 0; i < y.length; i++) {
            if (y[i].value == "") {
                $(y[i]).css("background", "#ffdddd");
                return false;
            }

        }
    }

    // Progress bar
    for (i = 1; i < showTab; i++) {
        $("#step-" + i).css("opacity", "1");
    }

    // Switch tab
    $("#tab-" + hideTab).css("display", "none");
    $("#tab-" + showTab).css("display", "block");
    $("input").css("background", "#fff");
}

function checkFormValue1() {
    if ($('#user-add-firstname').val().length == "" && $('#user-add-lastname').val().length == "" && $('#user-add-gender')[0].selectedIndex <= 0) {
        $('#user-add-firstname').addClass('is-invalid');
        $('#user-add-lastname').addClass('is-invalid');
        $('#user-add-gender').addClass('is-invalid');
        invalidInput();

    } else if ($('#user-add-firstname').val().length == "") {
        $('.feedback-fname').show();
        $('#user-add-firstname').addClass('is-invalid');
        invalidInput();
    } else if ($('#user-add-lastname').val().length == "") {
        $('.feedback-lname').show();
        $('#user-add-lastname').addClass('is-invalid');
        invalidInput();

    } else if ($('#user-add-gender')[0].selectedIndex <= 0) {
        $('.feedback-gender').show();
        $('#user-add-gender').addClass('is-invalid');
        invalidInput();
    } else {
        run(1, 2);


    }

}

function checkFormValue2() {

    if ($('#user-add-institution').val().length == "" && $('#user-add-grade-level')[0].selectedIndex <= 0) {
        $('#user-add-institution').addClass('is-invalid');
        $('#user-add-grade-level').addClass('is-invalid');
        $('.feedback-grade-level').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your grade level');
        $('#institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
        invalidInput();
    } else if ($('#user-add-grade-level')[0].selectedIndex <= 0) {
        $('.feedback-grade-level').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your grade level');
        $('.feedback-grade-level').show();
        $('#user-add-grade-level').addClass('is-invalid');
        invalidInput();
    } else if ($('#user-add-institution').val().length == "") {
        $('#user-add-institution').addClass('is-invalid');

        invalidInput();

    } else if ($('#user-add-institution').hasClass('is-invalid') || $('#user-add-grade-level').hasClass('is-invalid')) {
        invalidInput();
    } else {
        run(2, 3);
    }

}

function checkFormValue3() {
    if ($('#user-add-email').val().length == "" && $('#user-add-contact').val().length == "") {
        $('#user-add-email').addClass('is-invalid');
        $('#user-add-contact').addClass('is-invalid');
        $('#email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your email');
        $('#contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');
        invalidInput();

    } else if ($('#user-add-email').hasClass('is-invalid') || $('#user-add-contact').hasClass('is-invalid')) {
        invalidInput();
    } else if ($('#user-add-email').val().length == "") {
        $('#user-add-email').addClass('is-invalid');

        $('#email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your email');
        invalidInput();

    } else if ($('#user-add-contact').val().length == "") {
        $('#user-add-contact').addClass('is-invalid');

        $('#contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');
        invalidInput();
    } else if (!validatePhoneNumber()) {
        invalidInput();
    } else {
        run(3, 4);
    }
}

function checkFormValue4() {
    if ($('#user-add-username').val().length == "" && $('#user-add-password').val().length == "") {
        $('#user-add-username').addClass('is-invalid');
        $('#user-add-password').addClass('is-invalid');
        $('#user-add-confirmpassword').addClass('is-invalid');
        $('#feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your username');
        $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your password');
        $('.password-feedback').show();

        invalidInput();
    } else if ($('#user-add-username').val().length == "") {
        $('#user-add-username').addClass('is-invalid');
        $('#feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your username');
        invalidInput();
    } else if ($('#user-add-password').val().length == "") {
        $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your password');
        $('#user-add-password').addClass('is-invalid');
        $('#user-add-confirmpassword').addClass('is-invalid');
        $('.password-feedback').show();

        invalidInput();
    } else if ($('#user-add-username').hasClass('is-invalid') || ($('#user-add-password').hasClass('is-invalid'))) {
        invalidInput();
    } else {
        run(4, 5);

    }
}



$('.input-tooltip').click(function () {
    $('#institution-help').modal('show')
});

/*REGISTRATION MODAL AJAX END */

/* HOME WELCOME PAGE AJAX*/

$('.view-chosen-lesson').submit(function (event) {
    event.preventDefault();

    var lesson_id = $(this).closest('form').find('input[name=lesson-id]').val();
    var title = $(this).closest('form').find('input[name=title]').val();

    $.ajax({
        type: "GET",
        data: {
            lesson_id: lesson_id,
            title: title,
        },

        success: function (data) {

            window.location = 'home-student.php?page=user-progress-topic&title=' + title;

        },
        error: function (xhr, status, error) {


        }
    });


});

$('.view-chosen-assessment').submit(function (event) {
    event.preventDefault();


    var assessment_id = $(this).closest('form').find('input[name=assessment-id]').val();

    $.ajax({
        type: "GET",
        data: {
            assessment_id: assessment_id,
        },

        success: function () {
            window.location = 'home-student.php?page=result&assessment_id=' + assessment_id;
        },
        error: function (xhr, status, error) {


        }
    });


});

$('.view-retake-assessment').submit(function (event) {
    event.preventDefault();


    var assessment_id = $(this).closest('form').find('input[name=assessment-id]').val();

    $.ajax({
        type: "GET",
        data: {
            assessment_id: assessment_id,
        },

        success: function (data) {
            window.location = 'home-student.php?page=user-view-retakes&assessment_id=' + assessment_id;
        },
        error: function (xhr, status, error) {


        }
    });


});

$('.view-retake-result-assessment').submit(function (event) {
    event.preventDefault();


    var assessment_id = $(this).closest('form').find('input[name=assessment-id]').val();
    var code = $(this).closest('form').find('input[name=retake-code]').val();

    $.ajax({
        type: "GET",
        data: {
            code: code,
        },

        success: function (data) {
            window.location = 'home-student.php?page=retake-result&code=' + code + ' &assessment_id=' + assessment_id;
        },
        error: function (xhr, status, error) {


        }
    });


});



/* HOME WELCOME PAGE AJAX END*/

/* BROWSE TOPICS */
/* WIDGETS */
/* SEARCHBARS */
$(".topic.searchbar").keyup(function () {

    // Retrieve the input field text and reset the count to zero
    var filter = $(this).val(),
        count = 0;

    // Loop through the comment list
    $('.topic-card-container .col-lg-6 .card-details .name').each(function () {


        // If the list item does not contain the text phrase fade it out
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).parents().eq(3).fadeOut()

            // Show the list item if the phrase matches and increase the count by 1
        } else {
            $(this).parents().eq(3).fadeIn()
            count++;

        }

    });

});


$(".assessment.searchbar").keyup(function () {

    // Retrieve the input field text and reset the count to zero
    var filter = $(this).val(),
        count = 0;

    // Loop through the comment list
    $('.assessment-card-container .col-lg-6 .card-details .name').each(function () {


        // If the list item does not contain the text phrase fade it out
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).parents().eq(3).fadeOut()

            // Show the list item if the phrase matches and increase the count by 1
        } else {
            $(this).parents().eq(3).fadeIn()
            count++;
        }

    });

});
/* SEARCHBARS END */

/*FILTER FUNCTIONS*/

$(document).ready(function () {

    filter_data();

    function filter_data() {
        var action = 'fetch_data';
        var difficulty = get_filter('difficulty');
        var time = get_filter('time');

        $.ajax({
            url: "query/filter-page/filter-topics.php",
            method: "POST",
            data: {
                action: action,
                difficulty: difficulty,
                time: time

            },
            success: function (data) {
                $('.topic-list').html(data);

            }
        });
    }

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }

    $('.check-filter').click(function () {
        filter_data();
    });

});

$(document).ready(function () {

    filter_data();

    function filter_data() {
        var difficulty = get_filter('difficulty');
        var time = get_filter('time');

        $.ajax({
            url: "query/assessment-page/filter-assessment.php",
            method: "POST",
            data: {
                difficulty: difficulty,
                time: time

            },
            success: function (data) {
                $('.assessment-list').html(data);

            }
        });
    }

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }

    $('.check-filter').click(function () {
        filter_data();
    });

});


$(document).ready(function () {

    filter_data();

    function filter_data() {
        var difficulty = get_filter('difficulty');
        var time = get_filter('time');

        $.ajax({
            url: "query/assessment-page/filter-retake-assessment.php",
            method: "POST",
            data: {
                difficulty: difficulty,
                time: time

            },
            success: function (data) {
                $('.retake-assessment-list').html(data);

            }
        });
    }

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }

    $('.check-filter').click(function () {
        filter_data();
    });

});

/*FILTER FUNCTIONS END*/

/*SIDEBAR FILTER*/

$(document).ready(function () {
    $(".custom-icon-difficulty").addClass('fa-circle-minus');
    $(".custom-icon-time").addClass('fa-circle-minus');


    $(".btn-filter-difficulty").click(function (e) {

        if ($('.btn-filter-difficulty').attr('aria-expanded') === 'true') {
            $(".custom-icon-difficulty").addClass('fa-circle-minus');
            $(".custom-icon-difficulty").removeClass('fa-circle-plus');

        } else {
            ($('.btn-filter-diffficulty').attr('aria-expanded') === 'false')
            $(".custom-icon-difficulty").removeClass('fa-circle-minus');
            $(".custom-icon-difficulty").addClass('fa-circle-plus');
        }

    });

    $(".btn-filter-time").click(function (e) {

        if ($('.btn-filter-time').attr('aria-expanded') === 'true') {
            $(".custom-icon-time").addClass('fa-circle-minus');
            $(".custom-icon-time").removeClass('fa-circle-plus');

        } else {
            ($('.btn-filter-diffficulty').attr('aria-expanded') === 'false')
            $(".custom-icon-time").removeClass('fa-circle-minus');
            $(".custom-icon-time").addClass('fa-circle-plus');
        }

    });
});

/*SIDEBAR FILTER END*/


/* WIDGETS END */

/* HOME PROGRESS ASSESSMENT SUBMIT */

$('#assessment-exam').submit(function (event) {
    event.preventDefault();
    $(this).removeClass('was-validated')
    var $input = $(this);
    var $parent = $input.closest('.form-group');

    $('.tf-check').filter(':checked').each(function () {
        $parent.removeClass('fg-toggled')
    });

    $(".assessment-exam input").each(function (e) {
        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }

    });

    //for every row
    jQuery(".form-group").each(function (idx, elem) {
        //checks only rows with radio inputs inside
        if ($(this).find('input[type=radio]').length) {
            //if there are no radios checked then form is not valid
            if (!$(this).find('input[type=radio]:checked').length) {
                valid = false;
                $(this).find('.radio-empty').css('display', 'block')
                $('.radio-empty').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                $('.radio-empty').addClass('is-invalid')
            }
        }
    });

    $('.tf-check').on('change', function () {
        var $input = $(this);
        var $parent = $input.closest('.form-group');

        $('.tf-check').each(function () {
            $parent.find('.radio-empty').css('display', 'none')
            $('.radio-empty').removeClass('is-invalid')


        });
    });

    if ($(".assessment-exam input").hasClass('is-invalid') || $(".radio-empty").hasClass('is-invalid')) {
        event.preventDefault();
        invalidAnswer()
    } else {

        var user_id = $('#user-id').val();
        var assessment_id = $('#assessment-id').val();
        var institution_id = $('#institution-id').val();
        var date_submit = $('#date-submit').val();
        var email = $('#user-email').val();
        var fname = $('#first-name').val();
        var assessment_title = $('#assessment-title').val();

        var date_deadline = $(this).closest('form').find('input[name=date_id]').val();


        var answer = [];
        var text_answer = [];
        var tf_answer = [];
        var question_id = [];
        var point = [];


        // Step 1: Create the question_answer array
        var question_answer = [];

        $('input[name^="question_id"]').each(function () {
            question_id.push(this.value);
        });

        $('input[name^="point"]').each(function () {
            point.push(this.value);
        });

        // Step 2: Iterate over the elements in answer, tf_answer, and text_answer
        // and add objects to the question_answer array
        $('input[name^="answer"]:checked').each(function () {
            question_answer.push({
                answer: this.value,
                question_id: $(this).data('question'),
                point: $(this).closest('.assessment-form').find('input[name^="point"]').val()
            });
        });
        $('input[name^="tf_answer"]:checked').each(function () {
            question_answer.push({
                answer: this.value,
                question_id: $(this).data('question'),
                point: $(this).closest('.assessment-form').find('input[name^="point"]').val()
            });
        });
        $('input[name^="text_answer"]').each(function () {
            question_answer.push({
                answer: this.value,
                question_id: $(this).data('question'),
                point: $(this).closest('.assessment-form').find('input[name^="point"]').val()
            });
        });

        // Step 3: Sort the elements in the question_answer array based on the question_id property
        question_answer.sort(function (a, b) {
            return a.question_id - b.question_id;
        });


        // var question_answer = $.merge($.merge([], answer), text_answer);










        Swal.fire({
            title: 'Are you sure you want to submit?',
            text: "Press CONFIRM to proceed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'CONFIRM',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'edit-primary-button'
            },

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "query/assessment-page/submit-answer.php",
                    data: {
                        user_id: user_id,
                        assessment_id: assessment_id,
                        assessment_title: assessment_title,
                        institution_id: institution_id,
                        point: point,
                        date_deadline: date_deadline,
                        date_submit: date_submit,
                        question_id: question_id,
                        answer: JSON.stringify(question_answer),
                        email: email,
                        fname: fname
                    },
                   // dataType: 'json',
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Please wait for a second...',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                            onAfterClose() {
                                Swal.hideLoading()
                            },
                        });
                    },

                    success: function (data) {
                        var data = data;
                        data = data.trim();

                        console.log(data)

                        if (data == 'Taken') {
                            Swal.fire({
                                title: 'Quiz Already Taken',
                                text: "You can only take this once",
                                icon: 'error',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            })
                        } else if (data == 'exceed') {
                            Swal.fire({
                                title: 'Test Overdue',
                                text: "You cannot take this assessment anymore",
                                icon: 'error',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            })
                        } else if (data == 'NotTaken') {
                            Swal.fire({
                                title: 'Quiz Assessment is Finished',
                                html: "Click <b>OK</b> to check the result!",
                                icon: 'success',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            }).then(function () {
                                window.location = 'home-student.php?page=result&assessment_id=' + assessment_id;
                            })
                        } else{
                            Swal.fire({
                                title: 'Quiz Assessment is Finished',
                                html: "Click <b>OK</b> to check the result.",
                                icon: 'success',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            }).then(function () {
                                window.location = 'home-student.php?page=result&assessment_id=' + assessment_id;
                            })

                        }
                    },
                    error: function (xhr, status, error, data) {

                    }
                });
            }
        });
    }

});
/* END STUDENT PROGRESS ASSESSMENT SUMBIT */

/* STUDENT RETAKE ASSESSMENT */

$('#retake-assessment-exam').submit(function (event) {
    event.preventDefault();
    $(this).removeClass('was-validated')

    $(".retake-assessment-exam input").each(function (e) {
        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    //for every row
    jQuery(".form-group").each(function (idx, elem) {

        //checks only rows with radio inputs inside
        if ($(this).find('input[type=radio]').length) {
            //if there are no radios checked then form is not valid
            if (!$(this).find('input[type=radio]:checked').length) {
                valid = false;
                $(this).find('.radio-empty').css('display', 'block')
                $('.radio-empty').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                $('.radio-empty').addClass('is-invalid')
            }
        }
    });

    $('.tf-check').on('change', function () {
        var $input = $(this);
        var $parent = $input.closest('.form-group');

        $('.tf-check').each(function () {
            $parent.find('.radio-empty').css('display', 'none')
            $('.radio-empty').removeClass('is-invalid')


        });
    });

    if ($(".retake-assessment-exam input").hasClass('is-invalid') || $(".radio-empty").hasClass('is-invalid')) {
        event.preventDefault();
        invalidAnswer()
    } else {

        var user_id = $('#user-id').val();
        var code = $('#retake-code').val();

        var assessment_id = $('#assessment-id').val();
        var institution_id = $('#institution-id').val();
        var date_submit = $('#date-submit').val();
        var email = $('#user-email').val();
        var fname = $('#first-name').val();
        var assessment_title = $('#assessment-title').val();

        var date_deadline = $(this).closest('form').find('input[name=date_id]').val();

        var answer = [];
        var text_answer = [];
        var tf_answer = [];
        var question_id = [];
        var point = [];
        var answers = {};

        // Step 1: Create the question_answer array
        var question_answer = [];

        $('input[name^="question_id"]').each(function () {
            question_id.push(this.value);
        });

        $('input[name^="point"]').each(function () {
            point.push(this.value);
        });

        // Step 2: Iterate over the elements in answer, tf_answer, and text_answer
        // and add objects to the question_answer array
        $('input[name^="answer"]:checked').each(function () {
            question_answer.push({
                answer: this.value,
                question_id: $(this).data('question'),
                point: $(this).closest('.assessment-form').find('input[name^="point"]').val()
            });
        });
        $('input[name^="tf_answer"]:checked').each(function () {
            question_answer.push({
                answer: this.value,
                question_id: $(this).data('question'),
                point: $(this).closest('.assessment-form').find('input[name^="point"]').val()
            });
        });
        $('input[name^="text_answer"]').each(function () {
            question_answer.push({
                answer: this.value,
                question_id: $(this).data('question'),
                point: $(this).closest('.assessment-form').find('input[name^="point"]').val()
            });
        });

        // Step 3: Sort the elements in the question_answer array based on the question_id property
        question_answer.sort(function (a, b) {
            return a.question_id - b.question_id;
        });









        Swal.fire({
            title: 'Are you sure you want to submit?',
            text: "Press CONFIRM to proceed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'CONFIRM',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'edit-primary-button'
            },

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "query/retake-page/submit-retake-answer.php",
                    data: {
                        user_id: user_id,
                        code: code,
                        assessment_id: assessment_id,
                        assessment_title, assessment_title,
                        institution_id: institution_id,
                        point: point,
                        date_deadline: date_deadline,
                        date_submit: date_submit,
                        question_id: question_id,
                        answer: JSON.stringify(question_answer),
                        email: email,
                        fname: fname

                    },
                   // dataType: 'json',
                    beforeSend: function () {
                        Swal.fire({
                            title: 'Please wait for a second...',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            onBeforeOpen: () => {
                                Swal.showLoading()
                            },
                            onAfterClose() {
                                Swal.hideLoading()
                            },
                        });
                    },

                    success: function (data) {
                        var data = data;
                        data = data.trim();

                        console.log(data)
                        if (data == 'Taken') {
                            Swal.fire({
                                title: 'Quiz Already Taken',
                                text: "You can only take this once",
                                icon: 'error',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            })
                        } else if (data == 'exceed') {
                            Swal.fire({
                                title: 'Test Overdue',
                                text: "You cannot take this assessment anymore",
                                icon: 'error',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            })
                        } else if (data == 'NotTaken') {

                            Swal.fire({
                                title: 'Quiz Assessment is Finished!',
                                html: "Click <b>OK</b> to check the result!",
                                icon: 'success',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            }).then(function () {
                                window.location = 'home-student.php?page=retake-result&assessment_id=' + assessment_id + 't&code=' + code;
                            })
                        }
                        else{
                            Swal.fire({
                                title: 'Quiz Assessment is Finished',
                                html: "Click <b>OK</b> to check the result.",
                                icon: 'success',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            }).then(function () {
                                window.location = 'home-student.php?page=retake-result&assessment_id=' + assessment_id + 't&code=' + code;
                            })

                        }
                    },
                    error: function (xhr, status, error, data) {
                        /*
                        Swal.fire({
                            title: 'Quiz Assessment is Finished',
                            html: "Click <b>OK</b> to check the result.",
                            icon: 'success',
                            confirmButtonColor: '#800000',
                            confirmButtonText: 'OK'
                        }).then(function () {
                            window.location = 'home-student.php?page=retake-result&assessment_id=' + assessment_id;
                        })
*/


                    }
                });
            }
        });
    }

});
/* END STUDENT RETAKE ASSESSMENT */

/* ACCOUNT SETTINGS */

$(document).ready(function () {
    var id = $('#get-user-id').val()

    $.ajax({
        type: 'POST',
        url: 'query/account-setting/user-getid-view.php',
        data: {
            user_id: id
        },
        dataType: 'json',
        success: function (res) {
            $('#user-id').val(res.user_id);
            $('#user-update-fname').val(res.fname);
            $('#user-update-lname').val(res.lname);
            $('#user-update-institution').val(res.institution);
            $('#user-update-grade-level').val(res.grade_level);
            $('#user-update-email').val(res.email);
            $('#user-update-contact').val(res.contact_no);
        }
    });

});


$('#update-user-personal-info').submit(function (event) {
    $("#update-user-personal-info input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    if ($("#update-user-personal-info input").hasClass('is-invalid')) {
        event.preventDefault();
        invalidEmpty()
    } else {
        var user_id = $('#user-id').val();
        var fname = $('#user-update-fname').val();
        var lname = $('#user-update-lname').val();

        Swal.fire({
            title: 'Are you sure you want to update this record?',
            text: "This action cannot be reverted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Update!',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'edit-primary-button'
            },

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "query/account-setting/user-update-personal-info.php",
                    data: {
                        user_id: user_id, //fieldname in the database : data-id value
                        fname: fname,
                        lname: lname,
                    },
                    dataType: 'json',

                    success: function (data) {

                        Swal.fire({
                            title: 'Record Updated!',
                            text: "You have succesfully modified this record",
                            icon: 'success',
                        }).then(function () {
                            window.location.reload();
                        });
                    },
                    error: function (xhr, status, error) {


                    }
                });
            } else {
                Swal.fire({
                    title: "No Changes Were Saved!",
                    text: "Your Information is just same as  the last time!",
                    icon: 'warning',
                })
            }
        });
    }

});

$('#update-user-academic-info').submit(function (event) {
    $("#update-user-academic-info input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    if ($("#update-user-academic-info input").hasClass('is-invalid')) {
        event.preventDefault();
        invalidEmpty()
    } else {
        var user_id = $('#user-id').val();
        var institution = $('#user-update-institution').val();
        var grade_level = $('#user-update-grade-level').val();

        Swal.fire({
            title: 'Are you sure you want to update this record?',
            text: "This action cannot be reverted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Update!',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'edit-primary-button'
            },

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "query/account-setting/user-update-academic-info.php",
                    data: {
                        user_id: user_id, //fieldname in the database : data-id value
                        institution: institution,
                        grade_level: grade_level,
                    },
                    dataType: 'json',

                    success: function (data) {

                        Swal.fire({
                            title: 'Record Updated!',
                            text: "You have succesfully modified this record",
                            icon: 'success',
                        }).then(function () {
                            window.location.reload();
                        });
                    },
                    error: function (xhr, status, error) {


                    }
                });
            } else {
                Swal.fire({
                    title: "No Changes Were Saved!",
                    text: "Your Information is just same as  the last time!",
                    icon: 'warning',
                })
            }
        });
    }

});

$('#update-user-contact-info').submit(function (event) {
    $("#update-user-contact-info input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    if ($("#update-user-contact-info input").hasClass('is-invalid')) {
        event.preventDefault();
        invalidEmpty()
    } else {
        var user_id = $('#user-id').val();
        var email = $('#user-update-email').val();
        var contact = $('#user-update-contact').val();


        Swal.fire({
            title: 'Are you sure you want to update this record?',
            text: "This action cannot be reverted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Update!',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'edit-primary-button'
            },

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "query/account-setting/user-update-contact-info.php",
                    data: {
                        user_id: user_id, //fieldname in the database : data-id value
                        email: email,
                        contact_no: contact,
                    },
                    dataType: 'json',

                    success: function (data) {

                        Swal.fire({
                            title: 'Record Updated!',
                            text: "You have succesfully modified this record",
                            icon: 'success',
                        }).then(function () {
                            window.location.reload();
                        });
                    },
                    error: function (xhr, status, error) {


                    }
                });
            } else {
                Swal.fire({
                    title: "No Changes Were Saved!",
                    text: "Your Information is just same as  the last time!",
                    icon: 'warning',
                })
            }
        });
    }

});

/*CHANGE PASSWORD*/

$('#student-oldpassword').on('keyup', function () {
    var password = $('#student-oldpassword').val().trim();
    if (password != '') {
        $('.old-password-feedback').hide()

        $('#student-oldpassword').addClass('is-valid')
        $('#student-oldpassword').removeClass('is-invalid')


    } else {
        $('.old-password-feedback').show()
        $('.old-password-feedback').addClass('invalid-feedback')
        $('.old-password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty!');

        $('#student-oldpassword').addClass('is-invalid')
        $('#student-oldpassword').removeClass('is-valid')
    }



})

$('#user-update-password, #student-update-confirmpassword').on('keyup', function () {
    var password = $('#user-update-password').val().trim();
    if (password != '') {
        if ($('#user-update-password').val() != $('#student-update-confirmpassword').val() || $('#user-update-password').val().length < 7 && $('#student-update-confirmpassword').val().length < 7) {
            $('.password-feedback').addClass('invalid-feedback');
            $('.password-feedback').removeClass('valid-feedback');

            $('.password-feedback').show();

            $('.myCpwdClass').addClass('is-invalid');
            $('.myCpwdClass').removeClass('is-valid');
            $('#user-update-password').addClass('is-invalid');
            $('#student-update-confirmpassword').addClass('is-invalid');
            $('#user-update-password').removeClass('is-valid');
            $('#student-update-confirmpassword').removeClass('is-valid');

            $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Pasword does not match!');
            $('#password-validation-match').addClass('invalid');
            $('#password-validation-match').removeClass('valid');

        } else {
            $('.password-feedback').addClass('valid-feedback');
            $('.password-feedback').removeClass('invalid-feedback');

            $('.password-feedback').show();

            $('.myCpwdClass').addClass('is-valid');
            $('.myCpwdClass').removeClass('is-invalid');

            $('#user-update-password').addClass('is-valid');
            $('#student-update-confirmpassword').addClass('is-valid');
            $('#user-update-password').removeClass('is-invalid');
            $('#student-update-confirmpassword').removeClass('is-invalid');

            $('.password-feedback').html('<i class="fa-solid fa-circle-check"></i> Pasword matched!');
            $('#password-validation-match').removeClass('invalid');
            $('#password-validation-match').addClass('valid');

        }

        // Validate lowercase letters
        var lowerCaseLetters = /[a-z]/g;
        if ($('#user-update-password').val().match(lowerCaseLetters)) {
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
        if ($('#user-update-password').val().match(upperCaseLetters)) {
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
        if ($('#user-update-password').val().match(numbers)) {
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
        if ($('#user-update-password').val().length >= 8) {
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
        $('#user-update-password').addClass('is-invalid');
        $('#student-update-confirmpassword').addClass('is-invalid');
        $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your password');
        $('.myCpwdClass').addClass('is-invalid');
        $('.password-feedback').addClass('invalid-feedback');
        $('.password-feedback').show();
        $('#password-validation-lowercase').addClass('invalid');
        $('#password-validation-uppercase').addClass('invalid');

        $('#password-validation-match').addClass('invalid');
        $('#password-validation-number').addClass('invalid');
        $('#password-validation-length').addClass('invalid');
        $('#password-validation-lowercase').removeClass('valid');
        $('#password-validation-uppercase').removeClass('valid');

        $('#password-validation-match').removeClass('valid');
        $('#password-validation-number').removeClass('valid');
        $('#password-validation-length').removeClass('valid');

    }


});



$(document).ready(function () {
    var id = $('#get-password-user-id').val()

    $.ajax({
        type: 'POST',
        url: 'query/account-setting/user-getid-view.php',
        data: {
            user_id: id
        },
        dataType: 'json',
        success: function (res) {
            $('#student-id').val(res.user_id);
            $('#student-update-fname').val(res.fname);
            $('#student-password').val(res.password);
            $('#student-update-lname').val(res.lname);
            $('#student-update-email').val(res.email);
            $('#student-update-contact').val(res.contact_no);
        }
    });

});



$('#update-student-password').submit(function (event) {

    if ($('#update-student-password #student-oldpassword').val() == "") {
        $('.old-password-feedback').addClass('invalid-feedback');
        $('.old-password-feedback').show();
        $('.old-password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        $('#student-oldpassword').addClass('is-invalid');
        event.preventDefault();
        invalidEmpty()
    }

    if ($('#user-update-password, #student-update-confirmpassword').val() == "") {
        $('.password-feedback').addClass('invalid-feedback');
        $('.password-feedback').show();
        $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        $('#user-update-password').addClass('is-invalid');
        $('#student-update-confirmpassword').addClass('is-invalid');
        event.preventDefault();
        invalidEmpty()
    }

    if ($("#update-student-password input").hasClass('is-invalid')) {
        event.preventDefault();
        invalidEmpty()
    } else {
        var user_id = $('#student-id').val();
        var old_password = $('#student-oldpassword').val();

        var password = $('#user-update-password').val();

        Swal.fire({
            title: 'Are you sure you want to change your password?',
            text: "This action cannot be reverted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Save Changes',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'edit-primary-button'
            },

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "query/account-setting/user-update-password.php",
                    data: {
                        user_id: user_id, //fieldname in the database : data-id value
                        old_password: old_password,
                        password: password
                    },
                    dataType: 'json',

                    success: function (data) {
                        if (data == 'Password Matched') {
                            Swal.fire({
                                title: 'Password Changed!',
                                text: "You have succesfully change your password",
                                icon: 'success',
                            }).then(function () {
                                window.location.reload();
                            });
                        } else if (data == 'WRONG') {
                            Swal.fire({
                                title: 'Wrong Password Credentials!',
                                html: "Your current password does not match to our database.<br> We cannot update your password, Please try again!",
                                icon: 'error',
                            }).then(function () {
                                window.location.reload();
                            });
                        }


                    },
                    error: function (xhr, status, error) {


                    }
                });
            } else {
                Swal.fire({
                    title: "No Changes Were Saved!",
                    text: "Your password is just same as the last time!",
                    icon: 'warning',
                })
            }
        });
    }

});

/*CHANGE PASSWORD END*/

/* ACCOUNT SETTINGS END */

/* VIEW TOPIC */
$.get("query/input-validation/validate-topic.php", function (data) {
    if (data == 'taken') {
        $('.btn-chose-topic').val('Resume')
    }
    else {
        $('.btn-chose-topic').val('Get Started')
    }
});

$('#insert-chosen').submit(function () {

    event.preventDefault();

    var user_id = $('#user-id').val();
    var lesson_id = $('#lesson-id').val();
    var title = $('#title').val();
    var status = $('#status').val();




    window.location = 'home-student.php?page=user-progress-topic&title=' + title;

});

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

/* END VIEW TOPIC */

/*KEYUPS*/
$("#retake-assessment-exam input").keyup(function () {
    var input = $(this).val().trim();
    if (input != '') {
        $(this).addClass('is-valid');
        $(this).removeClass('is-invalid');
    } else {
        $(this).addClass('is-invalid');
        $(this).removeClass('is-valid');
        emptyField();

    }

})

$("#assessment-exam input").keyup(function () {
    var input = $(this).val().trim();
    if (input != '') {
        $(this).addClass('is-valid');
        $(this).removeClass('is-invalid');
    } else {
        $(this).addClass('is-invalid');
        $(this).removeClass('is-valid');
        emptyField();

    }

})
/*KEYUP END*/

var url = window.location.href;
var index = url.lastIndexOf("/") + 1;
var filename = url.substr(index);
if (filename == "index.php?page=login") {
    $("nav").hide();
};


$("#user-update-institution").keyup(function () {

    var institution = $(this).val().trim();

    if (institution != '') {


        $.ajax({
            url: 'query/input-validation/validate-check-institution.php',
            type: 'post',
            data: {
                institution: institution
            },
            dataType: "json",

            success: function (response) {

                if (response == 'Institution Exists') {
                    $('.personal-feedback').html('<i class="fa-solid fa-circle-check"></i> Institution available');
                    $('#user-update-institution').addClass('is-valid');
                    $('#user-update-institution').removeClass('is-invalid');
                    $('.personal-feedback').addClass('valid-feedback');
                    $('.personal-feedback').removeClass('invalid-feedback');
                    $('.personal-feedback').hide();

                } else if (response == 'Institution Doesnt Exist') {
                    $('.personal-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Institution not available');
                    $('#user-update-institution').removeClass('is-valid');
                    $('#user-update-institution').addClass('is-invalid');
                    $('.personal-feedback').removeClass('valid-feedback');
                    $('.personal-feedback').addClass('invalid-feedback');
                    $('.personal-feedback').show();

                }


            }
        });
    } else {
        $('.personal-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
    }

});


$("#user-update-email").keyup(function () {

    var email = $(this).val().trim();

    if (email != '') {


        $.ajax({
            url: 'query/input-validation/validate-check-email.php',
            type: 'post',
            data: {
                email: email
            },
            dataType: "json",

            success: function (response) {

                if (response == 'Email Exists') {
                    $('.email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is already taken');
                    $('#empty-field-email').hide();
                    $('#user-update-email').removeClass('is-valid');
                    $('#user-update-email').addClass('is-invalid');
                    $('.email-feedback').removeClass('valid-feedback');
                    $('.email-feedback').addClass('invalid-feedback');
                    $('.email-feedback').show();

                } else if (!validateEmail()) {
                    $('#user-update-email').removeClass('is-valid');
                    $('#user-update-email').addClass('is-invalid');
                    $('.email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is invalid format');
                    $('.email-feedback').removeClass('valid-feedback');
                    $('.email-feedback').addClass('invalid-feedback');
                    $('.email-feedback').show();
                } else {
                    $('#user-update-email').addClass('is-valid');
                    $('#user-update-email').removeClass('is-invalid');
                    $('.email-feedback').hide();

                    $('.email-feedback').html('<i class="fa-solid fa-circle-check"></i> Email is valid');
                    $('.email-feedback').addClass('valid-feedback');
                    $('.email-feedback').removeClass('invalid-feedback');

                }


            }
        });
    } else {
        $('.email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
    }

});


$("#user-update-contact").keyup(function () {

    var contact = $(this).val().trim();

    if (contact != '') {

        $.ajax({
            url: 'query/input-validation/validate-check-contact-no.php',
            type: 'post',
            data: {
                contact: contact
            },
            dataType: "json",

            success: function (response) {

                if (response == 'This Number is Already Registered') {
                    $('.contact-feedback').show();
                    $('.contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number is already taken');
                    $('#empty-field-contact').hide();
                    $('#user-update-contact').addClass('is-invalid');
                    $('#user-update-contact').removeClass('is-valid');
                    $('.contact-feedback').removeClass('valid-feedback');
                    $('.contact-feedback').addClass('invalid-feedback');
                } else if (!updatevalidInteger()) {
                    $('.contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format  only include numbers');
                    $('.contact-feedback').show();
                    $('#empty-field-contact').hide();
                    $('#user-update-contact').addClass('is-invalid');
                    $('#user-update-contact').removeClass('is-valid');
                    $('.contact-feedback').removeClass('valid-feedback');
                    $('.contact-feedback').addClass('invalid-feedback');
                } else if (contact.length != 11) {
                    $('.contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number must be 11 numbers');
                    $('.contact-feedback').show();
                    $('#empty-field-contact').hide();
                    $('#user-update-contact').addClass('is-invalid');
                    $('#user-update-contact').removeClass('is-valid');
                    $('.contact-feedback').removeClass('valid-feedback');
                    $('.contact-feedback').addClass('invalid-feedback');
                } else if (!validatePhoneNumber()) {
                    $('.contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format must include <b> 09 </b> at the beginning of contact number');
                    $('.contact-feedback').show();
                    $('#empty-field-contact').hide();
                    $('#user-update-contact').addClass('is-invalid');
                    $('#user-update-contact').removeClass('is-valid');
                    $('.contact-feedback').removeClass('valid-feedback');
                    $('.contact-feedback').addClass('invalid-feedback');
                } else {
                    $('.contact-feedback').show();
                    $('#empty-field-contact').hide();
                    $('.contact-feedback').html('<i class="fa-solid fa-circle-check"></i> Contact number is valid');
                    $('.contact-feedback').addClass('valid-feedback');
                    $('.contact-feedback').removeClass('invalid-feedback');
                    $('#user-update-contact').addClass('is-valid');
                    $('#user-update-contact').removeClass('is-invalid');
                }
            }
        });
    } else {
        $('#user-update-contact').addClass('is-invalid');
        $('.contact-feedback').addClass('invalid-feedback');

        $('#empty-field-contact').show();
        $('.contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');

    }

});






