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

function validateEmail(inputElement) {
    // get value of input email
    var email = inputElement.val();

    // use regular expression
    var reg = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
    return reg.test(email);
}

function validatePhoneNumber(inputElement) {

    // get value of input email
    var contact = inputElement.val().trim();

    // use regular expression
    var reg = /^09\d{9}$/;
    return reg.test(contact);



}

function validInteger(inputElement) {

    // get value of input email
    var number = inputElement.val().trim();

    // use regular expression
    var reg = /^\d+$/;
    return reg.test(number);
}

function validatePassword() {
    // get value of input email
    var password = $("#student-add-password").val();
    // use reular expression
    var reg = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$");
    if (reg.test(password)) {
        return true;
    } else {
        return false;
    }

}

// CRUD STUDENTS ADMIN DASHBOARD
$(document).ready(function () {

    jQuery(".view-student").click(function () {
        var id = $(this).data('id');

        $('#view-student-modal').modal('show');

        $.ajax({
            type: 'POST',
            url: 'query/users/student-getid-view.php',
            data: {
                user_id: id
            },
            dataType: 'json',
            success: function (res) {
                $('#view-student-modal').modal('show');
                $('#student-view-firstname').val(res.fname);
                $('#student-view-lastname').val(res.lname);
                $('#student-view-institution').val(res.institution);
                $('#student-view-grade-level').val(res.grade_level);
                $('#student-view-email').val(res.email);
                $('#student-view-contact').val(res.contact_no);
                $('#student-view-username').val(res.username);

            }
        });
    });
});

$(document).ready(function () {

    $("body").on('click', '.edit-student', function (e) {
        var id = $(this).data('id');

        Swal.fire({
            title: 'This section is used for updating current records',
            text: "Are you sure you want to proceed?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!, Proceed',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'edit-default-button'
            },
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: 'query/users/student-getid-view.php',
                    data: {
                        user_id: id //fieldname in the database : data-id value
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#update-student-modal').modal('show');
                        $('#student-id').val(res.user_id); //ID IN INPUT BOX AND RES IS FIELD NAME IN DATABASE
                        $('#student-update-firstname').val(res.fname);
                        $('#student-update-lastname').val(res.lname);
                        $('#student-update-gender').val(res.gender);
                        $('#student-update-institution').val(res.institution);
                        $('#student-update-grade-level').val(res.grade_level);
                        $('#student-update-email').val(res.email);
                        $('#student-update-contact').val(res.contact_no);
                        $('#student-update-username').val(res.username);

                    }
                });
            }
        });
    });
});



$('#form-update-student').submit(function (event) {
    $(this).removeClass('was-validated')

    $(".form-update-student input").each(function () {
        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    if ($('#student-update-grade-level')[0].selectedIndex <= 0) {
        $('#student-update-grade-level').addClass('is-invalid')
        $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }

    if ($(".form-update-student input").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {
        event.preventDefault();
        var user_id = $('#student-id').val();
        var fname = $('#student-update-firstname').val();
        var lname = $('#student-update-lastname').val();
        var gender = $('#student-update-gender').val();

        var institution = $('#student-update-institution').val();
        var grade_level = $('#student-update-grade-level').val();
        var email = $('#student-update-email').val();
        var contact = $('#student-update-contact').val();
        var username = $('#student-update-username').val();
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
                    url: "query/users/student-update-tbl.php",
                    data: {
                        user_id: user_id, //fieldname in the database : data-id value
                        fname: fname,
                        lname: lname,
                        gender: gender,
                        institution: institution,
                        grade_level: grade_level,
                        email: email,
                        contact: contact,
                        username: username
                    },
                    dataType: 'json',

                    success: function (data) {

                        Toast.fire({
                            icon: 'success',
                            title: 'Student information updated!<br> Changes were saved </br>',

                        }).then(function () {
                            window.location.reload();
                        });
                    },
                    error: function (error) {

                    }
                });
            } else {
                Toast.fire({
                    icon: 'info',
                    title: 'Record update cancelled !<br> No changes were made </br>',
                })
            }
        });
    }

});



$(document).ready(function () {

    $("body").on('click', '.delete-student', function (e) {
        var id = [];
        id.push($(this).data('id'));


        Swal.fire({
            title: 'Are you sure you want to delete this record?',
            text: "You won't be able to retrieve this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'delete-primary-button'
            },
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: 'query/users/student-delete-tbl.php',
                    data: {
                        student_id: id
                    },

                    success: function (data) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Record successfully deleted !<br> Changes were saved </br>',

                        }).then(function () {
                            window.location.reload();
                        });
                    }
                });
            } else {
                Toast.fire({
                    icon: 'info',
                    title: 'Record deletion cancelled !<br> No changes were made </br>',
                })
            }
        });
    });
});

$(document).ready(function () {

    $(".student-section .checkbox-delete").on("click", function () {
        var checkedChbx = $('.student-section .checkbox-delete:checked');

        if (checkedChbx.length > 0) {
            $('.delete-link').show(200);
        }
        else {
            $('.delete-link').hide(100);
        }
    });

    $(".student-section .checkbox-all").click(function () {
        var checkall = $(this).is(":checked")
        var checkedChbx = $('input:checkbox').not(this).prop('checked', this.checked);
        if (checkedChbx.length > 0 && checkall == true) {
            $('.student-section .delete-link').show(200);
        }
        else {
            $('.student-section .delete-link').hide(100);
        }
    });

    $(".student-section .delete-link").on("click", function () {
        var id = [];

        $("table > tbody > tr.table-student-data").each(function () {
            if ($(this).find(".checkbox-delete").is(":checked")) {
                id.push($(this).find("a").data('id'));
            }


            Swal.fire({
                title: 'Are you sure you want to delete the selected records?',
                text: "You won't be able to retrieve this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true,
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'delete-primary-button'
                },
            }).then((result) => {

                if (result.value) {

                    $.ajax({
                        type: 'POST',
                        url: 'query/users/student-delete-tbl.php',
                        data: {
                            student_id: id
                        },

                        success: function (data) {


                            Toast.fire({
                                icon: 'success',
                                title: 'Record successfully deleted !<br> Changes were saved </br>',

                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    });
                } else {
                    Toast.fire({
                        icon: 'info',
                        title: 'Record deletion cancelled !<br> No changes were made </br>',
                    })
                }
            });
        });

    });
});

$(document).ready(function () {

    jQuery(".add-student").click(function () {
        $('#add-student-modal').modal('show');

        $("#form-add-student").on("submit", function (event) {
            $(this).removeClass('was-validated')

            $(".form-add-student input").each(function () {
                var checkEmptyInput = $(this);
                if (checkEmptyInput.val() == "") {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });

            if ($('#student-add-grade-level')[0].selectedIndex <= 0) {
                $('#student-add-grade-level').addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }

            if ($(".form-add-student input").hasClass('is-invalid')) {
                event.preventDefault();
                invalidInput()
            } else {
                event.preventDefault();
                var forms = document.querySelectorAll('.needs-validation')
                var username = $("#student-add-username").val();
                var password = $("#student-add-password").val();
                var firstname = $("#student-add-firstname").val();
                var lastname = $("#student-add-lastname").val();
                var gender = $("#student-add-gender").val();
                var institution = $("#student-add-institution").val();
                var grade_level = $("#student-add-grade-level").val();
                var email = $("#student-add-email").val();
                var contact = $("#student-add-contact").val();
                var type = $("#student-student").val();



                $.ajax({
                    type: "POST",
                    url: 'query/users/student-add-tbl.php',
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


                    },
                    dataType: "json",
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

                        if (data == 'Existing Code') {
                            Toast.fire({
                                icon: 'success',
                                title: 'Registration Complete ! <br>Account is now active</br>',

                            }).then((result) => {
                                if (result) {
                                    window.location.reload();

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
                        }
                        else if (data == 'Undeliverable') {
                            Swal.fire({
                                title: 'Registration Failed!',
                                text: "The email does not exist",
                                icon: 'error',
                                showCancelButton: true,
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK',
                                reverseButtons: true,
                                allowOutsideClick: false,
                            })
                        }
                        else {
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
                        console.log(error)
                        Swal.fire({
                            title: 'Registration Saved',
                            text: "Email/Api Server is down, you can check again later!",
                            icon: 'warning',
                            confirmButtonColor: '#800000',
                            confirmButtonText: 'OK'
                        })


                    }

                });
            }

        });


    });


});



// END CRUD STUDENTS ADMIN DASHBOARD

// CRUD FACULTY ADMIN DASHBOARD

$(document).ready(function () {

    jQuery(".view-faculty").click(function () {
        var id = $(this).data('id');

        $('#view-faculty-modal').modal('show');

        $.ajax({
            type: 'POST',
            url: 'query/users/faculty-getid-view.php',
            data: {
                user_id: id
            },
            dataType: 'json',
            success: function (res) {
                $('#view-faculty-modal').modal('show');
                $('#faculty-view-firstname').val(res.fname);
                $('#faculty-view-lastname').val(res.lname);
                $('#faculty-view-institution').val(res.institution);
                $('#faculty-view-grade-level').val(res.grade_level);
                $('#faculty-view-email').val(res.email);
                $('#faculty-view-contact').val(res.contact_no);
                $('#faculty-view-username').val(res.username);

            }
        });
    });
});



$(document).ready(function () {

    $("body").on('click', '.edit-faculty', function (e) {
        var id = $(this).data('id');

        Swal.fire({
            title: 'This section is used for updating current records',
            text: "Are you sure you want to proceed?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!, Proceed',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'edit-default-button'
            },
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: 'query/users/faculty-getid-view.php',
                    data: {
                        user_id: id //fieldname in the database : data-id value
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#update-faculty-modal').modal('show');
                        $('#faculty-id').val(res.user_id); //ID IN INPUT BOX AND RES IS FIELD NAME IN DATABASE
                        $('#faculty-update-firstname').val(res.fname);
                        $('#faculty-update-lastname').val(res.lname);
                        $('#faculty-update-gender').val(res.gender);
                        $('#faculty-update-institution').val(res.institution);
                        $('#faculty-update-grade-level').val(res.grade_level);
                        $('#faculty-update-email').val(res.email);
                        $('#faculty-update-contact').val(res.contact_no);
                        $('#faculty-update-username').val(res.username);

                    }
                });
            }
        });
    });
});



$('#form-update-faculty').submit(function (event) {

    $(this).removeClass('was-validated')

    $(".form-update-faculty input").each(function () {
        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    if ($('#faculty-update-grade-level')[0].selectedIndex <= 0) {
        $('#faculty-update-grade-level').addClass('is-invalid')
        $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }

    if ($(".form-update-faculty input").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {
        event.preventDefault();

        var user_id = $('#faculty-id').val();
        var fname = $('#faculty-update-firstname').val();
        var lname = $('#faculty-update-lastname').val();
        var gender = $('#faculty-update-gender').val();

        var institution = $('#faculty-update-institution').val();
        var grade_level = $('#faculty-update-grade-level').val();
        var email = $('#faculty-update-email').val();
        var contact = $('#faculty-update-contact').val();
        var username = $('#faculty-update-username').val();


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
                    url: "query/users/faculty-update-tbl.php",

                    data: {
                        'user_id': user_id, //fieldname in the database : data-id value
                        'fname': fname,
                        'lname': lname,
                        'gender': gender,
                        'institution': institution,
                        'grade_level': grade_level,
                        'email': email,
                        'contact': contact,
                        'username': username
                    },

                    success: function (data) {

                        Toast.fire({
                            icon: 'success',
                            title: 'Faculty information updated!<br> Changes were saved </br>',

                        }).then(function () {
                            window.location.reload();
                        });
                    },
                    error: function (error) {

                    }
                });
            } else {
                Toast.fire({
                    icon: 'info',
                    title: 'Record update cancelled !<br> No changes were made </br>',
                })
            }
        });
    }

});



$(document).ready(function () {

    $("body").on('click', '.delete-faculty', function (e) {
        var id = [];
        id.push($(this).data('id'));
        Swal.fire({
            title: 'Are you sure you want to delete this record?',
            text: "You won't be able to retrieve this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'delete-primary-button'
            },
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: 'query/users/faculty-delete-tbl.php',
                    data: {
                        faculty_id: id
                    },

                    success: function (data) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Record successfully deleted !<br> Changes were saved </br>',

                        }).then(function () {
                            window.location.reload();
                        });
                    }
                });
            } else {
                Toast.fire({
                    icon: 'info',
                    title: 'Record deletion cancelled !<br> No changes were made </br>',
                })
            }
        });
    });
});


// CRUD PERSONNEL ADMIN DASHBOARD

$(document).ready(function () {

    jQuery(".add-personnel").click(function () {
        $('#add-personnel-modal').modal('show');

        $("#form-add-personnel").on("submit", function (event) {
            $(this).removeClass('was-validated')

            $(".form-add-personnel input").each(function (e) {

                var checkEmptyInput = $(this);
                if (checkEmptyInput.val() == "") {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });

            if ($('#personnel-add-grade-level')[0].selectedIndex <= 0) {
                $('#personnel-add-grade-level').addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }

            if ($(".form-add-personnel input").hasClass('is-invalid')) {
                event.preventDefault();
                invalidInput()
            } else {

                event.preventDefault();
                var forms = document.querySelectorAll('.needs-validation')
                var username = $("#personnel-add-username").val();
                var password = $("#personnel-add-password").val();
                var firstname = $("#personnel-add-firstname").val();
                var lastname = $("#personnel-add-lastname").val();
                var gender = $("#personnel-add-gender").val();
                var institution = $("#personnel-add-institution").val();
                var grade_level = $("#personnel-add-grade-level").val();
                var email = $("#personnel-add-email").val();
                var contact = $("#personnel-add-contact").val();
                var type = $("#personnel-personnel").val();


                $.ajax({
                    type: "POST",
                    url: 'query/users/personnel-add-tbl.php',
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


                    },
                    dataType: "json",
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


                        if (data == 'Existing Code') {

                            Toast.fire({
                                icon: 'success',
                                title: 'Registration Complete !<br>Account is now active</br>',

                            }).then((result) => {
                                if (result) {
                                    window.location.reload();

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
                        } else if (data == 'Undeliverable') {
                            Swal.fire({
                                title: 'Registration Failed!',
                                text: "The email does not exist",
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
                        Swal.fire({
                            title: 'Registration Saved',
                            text: "Email/Api Server is down, you can check again later!",
                            icon: 'warning',
                            confirmButtonColor: '#800000',
                            confirmButtonText: 'OK'
                        })

                    }

                });
                //}

            }
        });

    });

});

$(document).ready(function () {

    jQuery(".view-personnel").click(function () {
        var id = $(this).data('id');

        $('#view-personnel-modal').modal('show');

        $.ajax({
            type: 'POST',
            url: 'query/users/personnel-getid-view.php',
            data: {
                user_id: id
            },
            dataType: 'json',
            success: function (res) {
                $('#view-personnel-modal').modal('show');
                $('#personnel-view-firstname').val(res.fname);
                $('#personnel-view-lastname').val(res.lname);
                $('#personnel-view-institution').val(res.institution);
                $('#personnel-view-grade-level').val(res.grade_level);
                $('#personnel-view-email').val(res.email);
                $('#personnel-view-contact').val(res.contact_no);
                $('#personnel-view-username').val(res.username);

            }
        });
    });
});


$(document).ready(function () {

    $("body").on('click', '.edit-personnel', function (e) {
        var id = $(this).data('id');

        Swal.fire({
            title: 'This section is used for updating current records',
            text: "Are you sure you want to proceed?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes!, Proceed',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'edit-default-button'
            },
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: 'query/users/personnel-getid-view.php',
                    data: {
                        user_id: id //fieldname in the database : data-id value
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#update-personnel-modal').modal('show');
                        $('#personnel-id').val(res.user_id); //ID IN INPUT BOX AND RES IS FIELD NAME IN DATABASE
                        $('#personnel-update-firstname').val(res.fname);
                        $('#personnel-update-lastname').val(res.lname);
                        $('#personnel-update-gender').val(res.gender);
                        $('#personnel-update-institution').val(res.institution);
                        $('#personnel-update-grade-level').val(res.grade_level);
                        $('#personnel-update-email').val(res.email);
                        $('#personnel-update-contact').val(res.contact_no);
                        $('#personnel-update-username').val(res.username);

                    }
                });
            }
        });
    });
});


$(document).ready(function () {

    $("body").on('click', '.delete-personnel', function (e) {
        var id = [];
        id.push($(this).data('id'));
        Swal.fire({
            title: 'Are you sure you want to delete this record?',
            text: "You won't be able to retrieve this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'delete-primary-button'
            },
        }).then((result) => {
            if (result.value) {

                $.ajax({
                    type: 'POST',
                    url: 'query/users/personnel-delete-tbl.php',
                    data: {
                        personnel_id: id
                    },

                    success: function (data) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Record successfully deleted !<br> Changes were saved </br>',

                        }).then(function () {
                            window.location.reload();
                        });
                    }
                });
            } else {
                Toast.fire({
                    icon: 'info',
                    title: 'Record deletion cancelled !<br> No changes were made </br>',
                })
            }
        });
    });
});

$(document).ready(function () {

    $(".personnel-section .checkbox-delete").on("click", function () {
        var checkedChbx = $('.personnel-section .checkbox-delete:checked');

        if (checkedChbx.length > 0) {
            $('.delete-link').show(200);
        }
        else {
            $('.delete-link').hide(100);
        }
    });

    $(".personnel-section .checkbox-all").click(function () {
        var checkall = $(this).is(":checked")
        var checkedChbx = $('input:checkbox').not(this).prop('checked', this.checked);
        if (checkedChbx.length > 0 && checkall == true) {
            $('.personnel-section .delete-link').show(200);
        }
        else {
            $('.personnel-section .delete-link').hide(100);
        }
    });

    $(".personnel-section .delete-link").on("click", function () {
        var id = [];

        $("table > tbody > tr.table-personnel-data").each(function () {
            if ($(this).find(".checkbox-delete").is(":checked")) {
                id.push($(this).find("a").data('id'));
            }


            Swal.fire({
                title: 'Are you sure you want to delete the selected records?',
                text: "You won't be able to retrieve this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true,
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'delete-primary-button'
                },
            }).then((result) => {

                if (result.value) {

                    $.ajax({
                        type: 'POST',
                        url: 'query/users/personnel-delete-tbl.php',
                        data: {
                            personnel_id: id
                        },

                        success: function (data) {


                            Toast.fire({
                                icon: 'success',
                                title: 'Record successfully deleted !<br> Changes were saved </br>',

                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    });
                } else {
                    Toast.fire({
                        icon: 'info',
                        title: 'Record deletion cancelled !<br> No changes were made </br>',
                    })
                }
            });
        });

    });
});


$('#form-update-personnel').submit(function (event) {

    $(this).removeClass('was-validated')

    $(".form-update-personnel input").each(function () {
        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    if ($('#personnel-update-grade-level')[0].selectedIndex <= 0) {
        $('#personnel-update-grade-level').addClass('is-invalid')
        $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }

    if ($(".form-update-personnel input").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {
        event.preventDefault();

        var user_id = $('#personnel-id').val();
        var fname = $('#personnel-update-firstname').val();
        var lname = $('#personnel-update-lastname').val();
        var gender = $('#personnel-update-gender').val();

        var institution = $('#personnel-update-institution').val();
        var grade_level = $('#personnel-update-grade-level').val();
        var email = $('#personnel-update-email').val();
        var contact = $('#personnel-update-contact').val();
        var username = $('#personnel-update-username').val();


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
                    url: "query/users/personnel-update-tbl.php",

                    data: {
                        'user_id': user_id, //fieldname in the database : data-id value
                        'fname': fname,
                        'lname': lname,
                        'gender': gender,
                        'institution': institution,
                        'grade_level': grade_level,
                        'email': email,
                        'contact': contact,
                        'username': username
                    },

                    success: function (data) {

                        Toast.fire({
                            icon: 'success',
                            title: 'Personnel information updated!<br> Changes were saved </br>',

                        }).then(function () {
                            window.location.reload();
                        });
                    },
                    error: function (error) {

                        Toast.fire({
                            icon: 'error',
                            title: 'Something went wrong!<br> Please contact the administrator </br> ',

                        })
                    }
                });
            } else {
                Toast.fire({
                    icon: 'info',
                    title: 'Record update cancelled !<br> No changes were made </br>',
                })
            }
        });
    }

});


$(document).ready(function () {

    $(".faculty-section .checkbox-delete").on("click", function () {
        var checkedChbx = $('.faculty-section .checkbox-delete:checked');

        if (checkedChbx.length > 0) {
            $('.delete-link').show(200);
        }
        else {
            $('.delete-link').hide(100);
        }
    });

    $(".faculty-section .checkbox-all").click(function () {
        var checkedChbx = $('input:checkbox').not(this).prop('checked', this.checked);
        if (checkedChbx.length > 0) {
            $('.faculty-section .delete-link').show(200);
        }
        else {
            $('.faculty-section .delete-link').hide(100);
        }
    });

    $(".faculty-section .delete-link").on("click", function () {
        var id = [];

        $("table > tbody > tr.table-faculty-data").each(function () {
            if ($(this).find(".checkbox-delete").is(":checked")) {
                id.push($(this).find("a").data('id'));
            }


            Swal.fire({
                title: 'Are you sure you want to delete the selected records?',
                text: "You won't be able to retrieve this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true,
                allowOutsideClick: false,
                customClass: {
                    confirmButton: 'delete-primary-button'
                },
            }).then((result) => {

                if (result.value) {

                    $.ajax({
                        type: 'POST',
                        url: 'query/users/faculty-delete-tbl.php',
                        data: {
                            faculty_id: id
                        },

                        success: function (data) {


                            Toast.fire({
                                icon: 'success',
                                title: 'Record successfully deleted !<br> Changes were saved </br>',

                            }).then(function () {
                                window.location.reload();
                            });
                        }
                    });
                } else {
                    Toast.fire({
                        icon: 'info',
                        title: 'Record deletion cancelled !<br> No changes were made </br>',
                    })
                }
            });
        });

    });
});



$(document).ready(function () {

    jQuery(".add-faculty").click(function () {
        $('#add-faculty-modal').modal('show');

        $("#form-add-faculty").on("submit", function (event) {
            $(this).removeClass('was-validated')

            $(".form-add-faculty input").each(function (e) {

                var checkEmptyInput = $(this);
                if (checkEmptyInput.val() == "") {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });

            if ($('#faculty-add-grade-level')[0].selectedIndex <= 0) {
                $('#faculty-add-grade-level').addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }

            if ($(".form-add-faculty input").hasClass('is-invalid')) {
                event.preventDefault();
                invalidInput()
            } else {

                event.preventDefault();
                var forms = document.querySelectorAll('.needs-validation')
                var username = $("#faculty-add-username").val();
                var password = $("#faculty-add-password").val();
                var firstname = $("#faculty-add-firstname").val();
                var lastname = $("#faculty-add-lastname").val();
                var gender = $("#faculty-add-gender").val();
                var institution = $("#faculty-add-institution").val();
                var grade_level = $("#faculty-add-grade-level").val();
                var email = $("#faculty-add-email").val();
                var contact = $("#faculty-add-contact").val();
                var type = $("#faculty-faculty").val();


                $.ajax({
                    type: "POST",
                    url: 'query/users/faculty-add-tbl.php',
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


                    },
                    dataType: "json",
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
                        if (data == 'Existing Code') {

                            Toast.fire({
                                icon: 'success',
                                title: 'Registration Complete !<br>Account is now active</br>',

                            }).then((result) => {
                                if (result) {
                                    window.location.reload();

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
                        } else if (data == 'Undeliverable') {
                            Swal.fire({
                                title: 'Registration Failed!',
                                text: "The email does not exist",
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
                        console.log(xhr)

                        Swal.fire({
                            title: 'Registration Saved',
                            text: "Email/Api Server is down, you can check again later!",
                            icon: 'warning',
                            confirmButtonColor: '#800000',
                            confirmButtonText: 'OK'
                        })

                    }

                });
                //}

            }
        });

    });

});



// END FACULTY ADMIN DASHBOARD


/* KEYUP EVENTS */


$(document).ready(function () {
    $('.form-add-student #student-add-firstname').on('keyup', function () {
        $('.feedback-fname').hide();
        if ($('.form-add-student #student-add-firstname').val().length == "") {
            $('.form-add-student #student-add-firstname').addClass('is-invalid');
            $('.form-add-student .feedback-fname').show();

        } else {
            $('.form-add-student #student-add-firstname').addClass('is-valid');
            $('.form-add-student #student-add-firstname').removeClass('is-invalid');
        }
    });

    $('.form-add-student #student-add-lastname').on('keyup', function () {
        $('.form-add-student .feedback-lname').hide();
        if ($('.form-add-student #student-add-lastname').val().length == "") {
            $('.form-add-student #student-add-lastname').addClass('is-invalid');
            $('.form-add-student .feedback-lname').show();

        } else {
            $('.form-add-student #student-add-lastname').addClass('is-valid');
            $('.form-add-student #student-add-lastname').removeClass('is-invalid');
        }
    });

    $('.form-add-student #student-add-gender').on('keyup', function () {
        $('.form-add-student .feedback-gender').hide();
        if ($('.form-add-student #student-add-gender').val().length == "") {
            $('.form-add-student #student-add-gender').addClass('is-invalid');
            $('.form-add-student .feedback-gender').show();

        } else {
            $('.form-add-student #student-add-gender').addClass('is-valid');
            $('.form-add-student #student-add-gender').removeClass('is-invalid');
        }
    });

    $('.form-add-student #student-add-grade-level').on('change', function () {
        $('.form-add-student #feedback-grade-level').hide();
        if ($('.form-add-student #student-add-grade-level').val().length != "") {
            $('.form-add-student #student-add-grade-level').addClass('is-valid');
            $('.form-add-student #student-add-grade-level').removeClass('is-invalid');

        } else {
            $('.feedback-grade-level').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your grade level');
            $('.feedback-grade-level').show();
        }
    });


    $(".form-add-student #student-add-institution").keyup(function () {

        var institution = $(this).val().trim();

        if (institution != '') {

            $.ajax({
                url: 'query/validate-check-institution.php',
                type: 'post',
                data: {
                    institution: institution
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Institution Exist') {
                        $('.form-add-student .institution-feedback').html('<i class="fa-solid fa-circle-check"></i> Institution available');
                        $('.form-add-student .myInstitution').addClass('is-valid');
                        $('.form-add-student .myInstitution').removeClass('is-invalid');
                        $('.form-add-student .institution-feedback').addClass('valid-feedback');
                        $('.form-add-student .institution-feedback').removeClass('invalid-feedback');
                    } else if (response == 'Institution Doesnt Exist') {
                        $('.form-add-student .institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Institution not available');
                        $('.form-add-student .myInstitution').removeClass('is-valid');
                        $('.form-add-student .myInstitution').addClass('is-invalid');
                        $('.form-add-student .institution-feedback').removeClass('valid-feedback');
                        $('.form-add-student .institution-feedback').addClass('invalid-feedback');
                    }


                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('.institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
        }

    });

    $(".form-add-student #student-add-email").keyup(function () {

        var email = $(this).val().trim();

        if (email != '') {

            $.ajax({
                url: 'query/validate-check-email.php',
                type: 'post',
                data: {
                    email: email
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Email Exists') {
                        $('.form-add-student .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is already taken');
                        $('.form-add-student .myEmail').removeClass('is-valid');
                        $('.form-add-student .myEmail').addClass('is-invalid');
                        $('.form-add-student .email-feedback').removeClass('valid-feedback');
                        $('.form-add-student .email-feedback').addClass('invalid-feedback');
                    } else if (!validateEmail($(".form-add-student #student-add-email"))) {
                        $('.form-add-student .myEmail').removeClass('is-valid');
                        $('.form-add-student .myEmail').addClass('is-invalid');
                        $('.form-add-student .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is invalid format');
                        $('.form-add-student .email-feedback').removeClass('valid-feedback');
                        $('.form-add-student .email-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-add-student .myEmail').addClass('is-valid');
                        $('.form-add-student .myEmail').removeClass('is-invalid');

                        $('.form-add-student .email-feedback').html('<i class="fa-solid fa-circle-check"></i> Email is valid');
                        $('.form-add-student .email-feedback').addClass('valid-feedback');
                        $('.form-add-student .email-feedback').removeClass('invalid-feedback');

                    }
                }
            });
        } else {
            $('.form-add-student .myEmail').addClass('is-invalid');
            $('.form-add-student .email-feedback').addClass('invalid-feedback');
            $('.form-add-student .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your email');


        }

    });

    $(".form-add-student #student-add-username").keyup(function () {

        var username = $(this).val().trim();

        if (username != '') {

            $.ajax({
                url: 'query/validate-check-username.php',
                type: 'post',
                data: {
                    username: username
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Username Exist') {
                        $('.form-add-student .feedback-username').show();
                        $('.form-add-student .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username is already taken');
                        $('.form-add-student .myUsername').addClass('is-invalid');
                        $('.form-add-student .myUsername').removeClass('is-valid');
                        $('.form-add-student .feedback-username').addClass('invalid-feedback');
                        $('.form-add-student .feedback-username').removeClass('valid-feedback');
                    } else if (username.length < 5) {
                        $('.form-add-student .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username must be atleast 5 characters');
                        $('.form-add-student .feedback-username').show();
                        $('.form-add-student .myUsername').addClass('is-invalid');
                        $('.form-add-student .myUsername').removeClass('is-valid');
                        $('.form-add-student .feedback-username').addClass('invalid-feedback');
                        $('.form-add-student .feedback-username').removeClass('valid-feedback');
                    } else {
                        $('.form-add-student .feedback-username').html('<i class="fa-solid fa-circle-check"></i> Username is available');
                        $('.form-add-student .feedback-username').show();
                        $('.form-add-student .myUsername').addClass('is-valid');
                        $('.form-add-student .myUsername').removeClass('is-invalid');
                        $('.form-add-student .feedback-username').addClass('valid-feedback');
                        $('.form-add-student .feedback-username').removeClass('invalid-feedback');

                    }
                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('.form-add-student .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your username');
            $('.form-add-student .myUsername').addClass('is-invalid');
            $('.form-add-student .feedback-username').addClass('invalid-feedback');

        }

    });

    $(".form-add-student #student-add-contact").keyup(function () {

        var contact = $(this).val().trim();

        if (contact != '') {

            $.ajax({
                url: 'query/validate-check-contact-no.php',
                type: 'post',
                data: {
                    contact: contact
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'This Number is Already Registered') {
                        $('.form-add-student .contact-feedback').show();
                        $('.form-add-student .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number is already taken');
                        $('.form-add-student .myContact').addClass('is-invalid');
                        $('.form-add-student .myContact').removeClass('is-valid');
                        $('.form-add-student .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-student .contact-feedback').addClass('invalid-feedback');
                    } else if (!validInteger($(".form-add-student #student-add-contact"))) {
                        $('.form-add-student .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format  only include numbers');
                        $('.form-add-student .contact-feedback').show();
                        $('.form-add-student .myContact').addClass('is-invalid');
                        $('.form-add-student .myContact').removeClass('is-valid');
                        $('.form-add-student .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-student .contact-feedback').addClass('invalid-feedback');
                    } else if (contact.length != 11) {
                        $('.form-add-student .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number must be 11 numbers');
                        $('.form-add-student .contact-feedback').show();
                        $('.form-add-student .myContact').addClass('is-invalid');
                        $('.form-add-student .myContact').removeClass('is-valid');
                        $('.form-add-student .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-student .contact-feedback').addClass('invalid-feedback');
                    } else if (!validatePhoneNumber($(".form-add-student #student-add-contact"))) {
                        $('.form-add-student .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format must include <b> 09 </b> at the beginning of contact number');
                        $('.form-add-student .contact-feedback').show();
                        $('.form-add-student .myContact').addClass('is-invalid');
                        $('.form-add-student .myContact').removeClass('is-valid');
                        $('.form-add-student .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-student .contact-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-add-student .contact-feedback').show();
                        $('.form-add-student .contact-feedback').html('<i class="fa-solid fa-circle-check"></i> Contact number is valid');
                        $('.form-add-student .contact-feedback').addClass('valid-feedback');
                        $('.form-add-student .contact-feedback').removeClass('invalid-feedback');
                        $('.form-add-student .myContact').addClass('is-valid');
                        $('.form-add-student .myContact').removeClass('is-invalid');
                    }
                }
            });
        } else {
            $('.form-add-student .myContact').addClass('is-invalid');
            $('.form-add-student .contact-feedback').addClass('invalid-feedback');
            $('.form-add-student .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');

        }

    });
});



$(document).ready(function () {
    $('.form-add-faculty #faculty-add-firstname').on('keyup', function () {
        $('.feedback-fname').hide();
        if ($('.form-add-faculty #faculty-add-firstname').val().length == "") {
            $('.form-add-faculty #faculty-add-firstname').addClass('is-invalid');
            $('.form-add-faculty .feedback-fname').show();

        } else {
            $('.form-add-faculty #faculty-add-firstname').addClass('is-valid');
            $('.form-add-faculty #faculty-add-firstname').removeClass('is-invalid');
        }
    });

    $('.form-add-faculty #faculty-add-lastname').on('keyup', function () {
        $('.feedback-lname').hide();
        if ($('.form-add-faculty #faculty-add-lastname').val().length == "") {
            $('.form-add-faculty #faculty-add-lastname').addClass('is-invalid');
            $('.feedback-lname').show();

        } else {
            $('.form-add-faculty #faculty-add-lastname').addClass('is-valid');
            $('.form-add-faculty #faculty-add-lastname').removeClass('is-invalid');
        }
    });

    $('.form-add-faculty #faculty-add-gender').on('keyup', function () {
        $('.feedback-gender').hide();
        if ($('.form-add-faculty #faculty-add-gender').val().length == "") {
            $('.form-add-faculty #faculty-add-gender').addClass('is-invalid');
            $('.feedback-gender').show();

        } else {
            $('.form-add-faculty #faculty-add-gender').addClass('is-valid');
            $('.form-add-faculty #faculty-add-gender').removeClass('is-invalid');
        }
    });

    $('.form-add-faculty #faculty-add-grade-level').on('change', function () {
        $('.form-add-faculty .feedback-grade-level').hide();
        if ($('.form-add-faculty #faculty-add-grade-level').val().length != "") {
            $('.form-add-faculty #faculty-add-grade-level').addClass('is-valid');
            $('.form-add-faculty #faculty-add-grade-level').removeClass('is-invalid');

        } else {
            $('.form-add-faculty .feedback-grade-level').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your grade level');
            $('.form-add-faculty .feedback-grade-level').show();
        }
    });


    $(".form-add-faculty #faculty-add-institution").keyup(function () {

        var institution = $(this).val().trim();

        if (institution != '') {

            $.ajax({
                url: 'query/validate-check-institution.php',
                type: 'post',
                data: {
                    institution: institution
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Institution Exist') {
                        $('.form-add-faculty .institution-feedback').html('<i class="fa-solid fa-circle-check"></i> Institution available');
                        $('.form-add-faculty .myInstitution').addClass('is-valid');
                        $('.form-add-faculty .myInstitution').removeClass('is-invalid');
                        $('.form-add-faculty .institution-feedback').addClass('valid-feedback');
                        $('.form-add-faculty .institution-feedback').removeClass('invalid-feedback');
                    } else if (response == 'Institution Doesnt Exist') {
                        $('.form-add-faculty .institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Institution not available');
                        $('.form-add-faculty .myInstitution').removeClass('is-valid');
                        $('.form-add-faculty .myInstitution').addClass('is-invalid');
                        $('.form-add-faculty .institution-feedback').removeClass('valid-feedback');
                        $('.form-add-faculty .institution-feedback').addClass('invalid-feedback');
                    }


                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('#institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
        }

    });

    $(".form-add-faculty #faculty-add-email").keyup(function () {

        var email = $(this).val().trim();

        if (email != '') {

            $.ajax({
                url: 'query/validate-check-email.php',
                type: 'post',
                data: {
                    email: email
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Email Exists') {
                        $('.form-add-faculty .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is already taken');
                        $('.form-add-faculty .myEmail').removeClass('is-valid');
                        $('.form-add-faculty .myEmail').addClass('is-invalid');
                        $('.form-add-faculty .email-feedback').removeClass('valid-feedback');
                        $('.form-add-faculty .email-feedback').addClass('invalid-feedback');
                    } else if (!validateEmail($(".form-add-faculty #faculty-add-email"))) {
                        $('.form-add-faculty .myEmail').removeClass('is-valid');
                        $('.form-add-faculty .myEmail').addClass('is-invalid');
                        $('.form-add-faculty .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is invalid format');
                        $('.form-add-faculty .email-feedback').removeClass('valid-feedback');
                        $('.form-add-faculty .email-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-add-faculty .myEmail').addClass('is-valid');
                        $('.form-add-faculty .myEmail').removeClass('is-invalid');

                        $('.form-add-faculty .email-feedback').html('<i class="fa-solid fa-circle-check"></i> Email is valid');
                        $('.form-add-faculty .email-feedback').addClass('valid-feedback');
                        $('.form-add-faculty .email-feedback').removeClass('invalid-feedback');

                    }
                }
            });
        } else {
            $('.form-add-faculty .myEmail').addClass('is-invalid');
            $('.form-add-faculty .email-feedback').addClass('invalid-feedback');
            $('.form-add-faculty .empty-field-email').show();
            $('.form-add-faculty .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your email');


        }

    });

    $(".form-add-faculty #faculty-add-username").keyup(function () {

        var username = $(this).val().trim();

        if (username != '') {

            $.ajax({
                url: 'query/validate-check-username.php',
                type: 'post',
                data: {
                    username: username
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Username Exist') {
                        $('.form-add-faculty .feedback-username').show();
                        $('.form-add-faculty .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username is already taken');
                        $('.form-add-faculty .myUsername').addClass('is-invalid');
                        $('.form-add-faculty .myUsername').removeClass('is-valid');
                        $('.form-add-faculty .feedback-username').addClass('invalid-feedback');
                        $('.form-add-faculty .feedback-username').removeClass('valid-feedback');
                    } else if (username.length < 5) {
                        $('.form-add-faculty .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username must be atleast 5 characters');
                        $('.form-add-faculty .feedback-username').show();
                        $('.form-add-faculty .myUsername').addClass('is-invalid');
                        $('.form-add-faculty .myUsername').removeClass('is-valid');
                        $('.form-add-faculty .feedback-username').addClass('invalid-feedback');
                        $('.form-add-faculty .feedback-username').removeClass('valid-feedback');
                    } else {
                        $('.form-add-faculty .feedback-username').html('<i class="fa-solid fa-circle-check"></i> Username is available');
                        $('.form-add-faculty .feedback-username').show();
                        $('.form-add-faculty .myUsername').addClass('is-valid');
                        $('.form-add-faculty .myUsername').removeClass('is-invalid');
                        $('.form-add-faculty .feedback-username').addClass('valid-feedback');
                        $('.form-add-faculty .feedback-username').removeClass('invalid-feedback');

                    }
                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('.form-add-faculty .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your username');
            $('.form-add-faculty .myUsername').addClass('is-invalid');
            $('.form-add-faculty .feedback-username').addClass('invalid-feedback');

        }

    });

    $(".form-add-faculty #faculty-add-contact").keyup(function () {

        var contact = $(this).val().trim();

        if (contact != '') {

            $.ajax({
                url: 'query/validate-check-contact-no.php',
                type: 'post',
                data: {
                    contact: contact
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'This Number is Already Registered') {
                        $('.form-add-faculty .contact-feedback').show();
                        $('.form-add-faculty .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number is already taken');
                        $('.form-add-faculty .myContact').addClass('is-invalid');
                        $('.form-add-faculty .myContact').removeClass('is-valid');
                        $('.form-add-faculty .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-faculty .contact-feedback').addClass('invalid-feedback');
                    } else if (!validInteger($(".form-add-faculty #faculty-add-contact"))) {
                        $('.form-add-faculty .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format  only include numbers');
                        $('.form-add-faculty .contact-feedback').show();
                        $('.form-add-faculty .myContact').addClass('is-invalid');
                        $('.form-add-faculty .myContact').removeClass('is-valid');
                        $('.form-add-faculty .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-faculty .contact-feedback').addClass('invalid-feedback');
                    } else if (contact.length != 11) {
                        $('.form-add-faculty .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number must be 11 numbers');
                        $('.form-add-faculty .contact-feedback').show();
                        $('.form-add-faculty .myContact').addClass('is-invalid');
                        $('.form-add-faculty .myContact').removeClass('is-valid');
                        $('.form-add-faculty .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-faculty .contact-feedback').addClass('invalid-feedback');
                    } else if (!validatePhoneNumber($(".form-add-faculty #faculty-add-contact"))) {
                        $('.form-add-faculty .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format must include <b> 09 </b> at the beginning of contact number');
                        $('.form-add-faculty .contact-feedback').show();
                        $('.form-add-faculty .myContact').addClass('is-invalid');
                        $('.form-add-faculty .myContact').removeClass('is-valid');
                        $('.form-add-faculty .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-faculty .contact-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-add-faculty .contact-feedback').show();
                        $('.form-add-faculty .contact-feedback').html('<i class="fa-solid fa-circle-check"></i> Contact number is valid');
                        $('.form-add-faculty .contact-feedback').addClass('valid-feedback');
                        $('.form-add-faculty .contact-feedback').removeClass('invalid-feedback');
                        $('.form-add-faculty .myContact').addClass('is-valid');
                        $('.form-add-faculty .myContact').removeClass('is-invalid');
                    }
                }
            });
        } else {
            $('.form-add-faculty .myContact').addClass('is-invalid');
            $('.form-add-faculty .contact-feedback').addClass('invalid-feedback');
            $('.form-add-faculty .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');

        }

    });
});



$(document).ready(function () {
    $('.form-update-faculty #faculty-update-firstname').on('keyup', function () {
        $('.feedback-fname').hide();
        if ($('.form-update-faculty #faculty-update-firstname').val().length == "") {
            $('.form-update-faculty #faculty-update-firstname').addClass('is-invalid');
            $('.form-update-faculty .feedback-fname').show();

        } else {
            $('.form-update-faculty #faculty-update-firstname').addClass('is-valid');
            $('.form-update-faculty #faculty-update-firstname').removeClass('is-invalid');
        }
    });

    $('.form-update-faculty #faculty-update-lastname').on('keyup', function () {
        $('.feedback-lname').hide();
        if ($('.form-update-faculty #faculty-update-lastname').val().length == "") {
            $('.form-update-faculty #faculty-update-lastname').addClass('is-invalid');
            $('.feedback-lname').show();

        } else {
            $('.form-update-faculty #faculty-update-lastname').addClass('is-valid');
            $('.form-update-faculty #faculty-update-lastname').removeClass('is-invalid');
        }
    });

    $('.form-update-faculty #faculty-update-gender').on('keyup', function () {
        $('.feedback-gender').hide();
        if ($('.form-update-faculty #faculty-update-gender').val().length == "") {
            $('.form-update-faculty #faculty-update-gender').addClass('is-invalid');
            $('.feedback-gender').show();

        } else {
            $('.form-update-faculty #faculty-update-gender').addClass('is-valid');
            $('.form-update-faculty #faculty-update-gender').removeClass('is-invalid');
        }
    });

    $('.form-update-faculty #faculty-update-grade-level').on('change', function () {
        $('.form-update-faculty .feedback-grade-level').hide();
        if ($('.form-update-faculty #faculty-update-grade-level').val().length != "") {
            $('.form-update-faculty #faculty-update-grade-level').addClass('is-valid');
            $('.form-update-faculty #faculty-update-grade-level').removeClass('is-invalid');

        } else {
            $('.form-update-faculty .feedback-grade-level').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your grade level');
            $('.form-update-faculty .feedback-grade-level').show();
        }
    });


    $(".form-update-faculty #faculty-update-institution").keyup(function () {

        var institution = $(this).val().trim();

        if (institution != '') {

            $.ajax({
                url: 'query/validate-check-institution.php',
                type: 'post',
                data: {
                    institution: institution
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Institution Exist') {
                        $('.form-update-faculty .institution-feedback').html('<i class="fa-solid fa-circle-check"></i> Institution available');
                        $('.form-update-faculty .myInstitution').addClass('is-valid');
                        $('.form-update-faculty .myInstitution').removeClass('is-invalid');
                        $('.form-update-faculty .institution-feedback').addClass('valid-feedback');
                        $('.form-update-faculty .institution-feedback').removeClass('invalid-feedback');
                    } else if (response == 'Institution Doesnt Exist') {
                        $('.form-update-faculty .institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Institution not available');
                        $('.form-update-faculty .myInstitution').removeClass('is-valid');
                        $('.form-update-faculty .myInstitution').addClass('is-invalid');
                        $('.form-update-faculty .institution-feedback').removeClass('valid-feedback');
                        $('.form-update-faculty .institution-feedback').addClass('invalid-feedback');
                    }


                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('#institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
        }

    });

    $(".form-update-faculty #faculty-update-email").keyup(function () {

        var email = $(this).val().trim();

        if (email != '') {

            $.ajax({
                url: 'query/validate-check-email.php',
                type: 'post',
                data: {
                    email: email
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Email Exists') {
                        $('.form-update-faculty .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is already taken');
                        $('.form-update-faculty .myEmail').removeClass('is-valid');
                        $('.form-update-faculty .myEmail').addClass('is-invalid');
                        $('.form-update-faculty .email-feedback').removeClass('valid-feedback');
                        $('.form-update-faculty .email-feedback').addClass('invalid-feedback');
                    } else if (!validateEmail($(".form-update-faculty #faculty-update-email"))) {
                        $('.form-update-faculty .myEmail').removeClass('is-valid');
                        $('.form-update-faculty .myEmail').addClass('is-invalid');
                        $('.form-update-faculty .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is invalid format');
                        $('.form-update-faculty .email-feedback').removeClass('valid-feedback');
                        $('.form-update-faculty .email-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-update-faculty .myEmail').addClass('is-valid');
                        $('.form-update-faculty .myEmail').removeClass('is-invalid');

                        $('.form-update-faculty .email-feedback').html('<i class="fa-solid fa-circle-check"></i> Email is valid');
                        $('.form-update-faculty .email-feedback').addClass('valid-feedback');
                        $('.form-update-faculty .email-feedback').removeClass('invalid-feedback');

                    }
                }
            });
        } else {
            $('.form-update-faculty .myEmail').addClass('is-invalid');
            $('.form-update-faculty .email-feedback').addClass('invalid-feedback');
            $('.form-update-faculty .empty-field-email').show();
            $('.form-update-faculty .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your email');


        }

    });

    $(".form-update-faculty #faculty-update-username").keyup(function () {

        var username = $(this).val().trim();

        if (username != '') {

            $.ajax({
                url: 'query/validate-check-username.php',
                type: 'post',
                data: {
                    username: username
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Username Exist') {
                        $('.form-update-faculty .feedback-username').show();
                        $('.form-update-faculty .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username is already taken');
                        $('.form-update-faculty .myUsername').addClass('is-invalid');
                        $('.form-update-faculty .myUsername').removeClass('is-valid');
                        $('.form-update-faculty .feedback-username').addClass('invalid-feedback');
                        $('.form-update-faculty .feedback-username').removeClass('valid-feedback');
                    } else if (username.length < 5) {
                        $('.form-update-faculty .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username must be atleast 5 characters');
                        $('.form-update-faculty .feedback-username').show();
                        $('.form-update-faculty .myUsername').addClass('is-invalid');
                        $('.form-update-faculty .myUsername').removeClass('is-valid');
                        $('.form-update-faculty .feedback-username').addClass('invalid-feedback');
                        $('.form-update-faculty .feedback-username').removeClass('valid-feedback');
                    } else {
                        $('.form-update-faculty .feedback-username').html('<i class="fa-solid fa-circle-check"></i> Username is available');
                        $('.form-update-faculty .feedback-username').show();
                        $('.form-update-faculty .myUsername').addClass('is-valid');
                        $('.form-update-faculty .myUsername').removeClass('is-invalid');
                        $('.form-update-faculty .feedback-username').addClass('valid-feedback');
                        $('.form-update-faculty .feedback-username').removeClass('invalid-feedback');

                    }
                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('.form-update-faculty .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your username');
            $('.form-update-faculty .myUsername').addClass('is-invalid');
            $('.form-update-faculty .feedback-username').addClass('invalid-feedback');

        }

    });

    $(".form-update-faculty #faculty-update-contact").keyup(function () {

        var contact = $(this).val().trim();

        if (contact != '') {

            $.ajax({
                url: 'query/validate-check-contact-no.php',
                type: 'post',
                data: {
                    contact: contact
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'This Number is Already Registered') {
                        $('.form-update-faculty .contact-feedback').show();
                        $('.form-update-faculty .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number is already taken');
                        $('.form-update-faculty .myContact').addClass('is-invalid');
                        $('.form-update-faculty .myContact').removeClass('is-valid');
                        $('.form-update-faculty .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-faculty .contact-feedback').addClass('invalid-feedback');
                    } else if (!validInteger($(".form-update-faculty #faculty-update-contact"))) {
                        $('.form-update-faculty .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format  only include numbers');
                        $('.form-update-faculty .contact-feedback').show();
                        $('.form-update-faculty .myContact').addClass('is-invalid');
                        $('.form-update-faculty .myContact').removeClass('is-valid');
                        $('.form-update-faculty .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-faculty .contact-feedback').addClass('invalid-feedback');
                    } else if (contact.length != 11) {
                        $('.form-update-faculty .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number must be 11 numbers');
                        $('.form-update-faculty .contact-feedback').show();
                        $('.form-update-faculty .myContact').addClass('is-invalid');
                        $('.form-update-faculty .myContact').removeClass('is-valid');
                        $('.form-update-faculty .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-faculty .contact-feedback').addClass('invalid-feedback');
                    } else if (!validatePhoneNumber($(".form-update-faculty #faculty-update-contact"))) {
                        $('.form-update-faculty .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format must include <b> 09 </b> at the beginning of contact number');
                        $('.form-update-faculty .contact-feedback').show();
                        $('.form-update-faculty .myContact').addClass('is-invalid');
                        $('.form-update-faculty .myContact').removeClass('is-valid');
                        $('.form-update-faculty .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-faculty .contact-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-update-faculty .contact-feedback').show();
                        $('.form-update-faculty .contact-feedback').html('<i class="fa-solid fa-circle-check"></i> Contact number is valid');
                        $('.form-update-faculty .contact-feedback').addClass('valid-feedback');
                        $('.form-update-faculty .contact-feedback').removeClass('invalid-feedback');
                        $('.form-update-faculty .myContact').addClass('is-valid');
                        $('.form-update-faculty .myContact').removeClass('is-invalid');
                    }
                }
            });
        } else {
            $('.form-update-faculty .myContact').addClass('is-invalid');
            $('.form-update-faculty .contact-feedback').addClass('invalid-feedback');
            $('.form-update-faculty .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');

        }

    });
});


$(document).ready(function () {
    $('.form-update-student #student-update-firstname').on('keyup', function () {
        $('.feedback-fname').hide();
        if ($('.form-update-student #student-update-firstname').val().length == "") {
            $('.form-update-student #student-update-firstname').addClass('is-invalid');
            $('.form-update-student .feedback-fname').show();

        } else {
            $('.form-update-student #student-update-firstname').addClass('is-valid');
            $('.form-update-student #student-update-firstname').removeClass('is-invalid');
        }
    });

    $('.form-update-student #student-update-lastname').on('keyup', function () {
        $('.feedback-lname').hide();
        if ($('.form-update-student #student-update-lastname').val().length == "") {
            $('.form-update-student #student-update-lastname').addClass('is-invalid');
            $('.feedback-lname').show();

        } else {
            $('.form-update-student #student-update-lastname').addClass('is-valid');
            $('.form-update-student #student-update-lastname').removeClass('is-invalid');
        }
    });

    $('.form-update-student #student-update-gender').on('keyup', function () {
        $('.feedback-gender').hide();
        if ($('.form-update-student #student-update-gender').val().length == "") {
            $('.form-update-student #student-update-gender').addClass('is-invalid');
            $('.feedback-gender').show();

        } else {
            $('.form-update-student #student-update-gender').addClass('is-valid');
            $('.form-update-student #student-update-gender').removeClass('is-invalid');
        }
    });

    $('.form-update-student #student-update-grade-level').on('change', function () {
        $('.form-update-student .feedback-grade-level').hide();
        if ($('.form-update-student #student-update-grade-level').val().length != "") {
            $('.form-update-student #student-update-grade-level').addClass('is-valid');
            $('.form-update-student #student-update-grade-level').removeClass('is-invalid');

        } else {
            $('.form-update-student .feedback-grade-level').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your grade level');
            $('.form-update-student .feedback-grade-level').show();
        }
    });


    $(".form-update-student #student-update-institution").keyup(function () {

        var institution = $(this).val().trim();

        if (institution != '') {

            $.ajax({
                url: 'query/validate-check-institution.php',
                type: 'post',
                data: {
                    institution: institution
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Institution Exist') {
                        $('.form-update-student .institution-feedback').html('<i class="fa-solid fa-circle-check"></i> Institution available');
                        $('.form-update-student .myInstitution').addClass('is-valid');
                        $('.form-update-student .myInstitution').removeClass('is-invalid');
                        $('.form-update-student .institution-feedback').addClass('valid-feedback');
                        $('.form-update-student .institution-feedback').removeClass('invalid-feedback');
                    } else if (response == 'Institution Doesnt Exist') {
                        $('.form-update-student .institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Institution not available');
                        $('.form-update-student .myInstitution').removeClass('is-valid');
                        $('.form-update-student .myInstitution').addClass('is-invalid');
                        $('.form-update-student .institution-feedback').removeClass('valid-feedback');
                        $('.form-update-student .institution-feedback').addClass('invalid-feedback');
                    }


                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('#institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
        }

    });

    $(".form-update-student #student-update-email").keyup(function () {

        var email = $(this).val().trim();

        if (email != '') {

            $.ajax({
                url: 'query/validate-check-email.php',
                type: 'post',
                data: {
                    email: email
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Email Exists') {
                        $('.form-update-student .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is already taken');
                        $('.form-update-student .myEmail').removeClass('is-valid');
                        $('.form-update-student .myEmail').addClass('is-invalid');
                        $('.form-update-student .email-feedback').removeClass('valid-feedback');
                        $('.form-update-student .email-feedback').addClass('invalid-feedback');
                    } else if (!validateEmail($(".form-update-student #student-update-email"))) {
                        $('.form-update-student .myEmail').removeClass('is-valid');
                        $('.form-update-student .myEmail').addClass('is-invalid');
                        $('.form-update-student .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is invalid format');
                        $('.form-update-student .email-feedback').removeClass('valid-feedback');
                        $('.form-update-student .email-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-update-student .myEmail').addClass('is-valid');
                        $('.form-update-student .myEmail').removeClass('is-invalid');

                        $('.form-update-student .email-feedback').html('<i class="fa-solid fa-circle-check"></i> Email is valid');
                        $('.form-update-student .email-feedback').addClass('valid-feedback');
                        $('.form-update-student .email-feedback').removeClass('invalid-feedback');

                    }
                }
            });
        } else {
            $('.form-update-student .myEmail').addClass('is-invalid');
            $('.form-update-student .email-feedback').addClass('invalid-feedback');
            $('.form-update-student .empty-field-email').show();
            $('.form-update-student .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your email');


        }

    });

    $(".form-update-student #student-update-username").keyup(function () {

        var username = $(this).val().trim();

        if (username != '') {

            $.ajax({
                url: 'query/validate-check-username.php',
                type: 'post',
                data: {
                    username: username
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Username Exist') {
                        $('.form-update-student .feedback-username').show();
                        $('.form-update-student .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username is already taken');
                        $('.form-update-student .myUsername').addClass('is-invalid');
                        $('.form-update-student .myUsername').removeClass('is-valid');
                        $('.form-update-student .feedback-username').addClass('invalid-feedback');
                        $('.form-update-student .feedback-username').removeClass('valid-feedback');
                    } else if (username.length < 5) {
                        $('.form-update-student .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username must be atleast 5 characters');
                        $('.form-update-student .feedback-username').show();
                        $('.form-update-student .myUsername').addClass('is-invalid');
                        $('.form-update-student .myUsername').removeClass('is-valid');
                        $('.form-update-student .feedback-username').addClass('invalid-feedback');
                        $('.form-update-student .feedback-username').removeClass('valid-feedback');
                    } else {
                        $('.form-update-student .feedback-username').html('<i class="fa-solid fa-circle-check"></i> Username is available');
                        $('.form-update-student .feedback-username').show();
                        $('.form-update-student .myUsername').addClass('is-valid');
                        $('.form-update-student .myUsername').removeClass('is-invalid');
                        $('.form-update-student .feedback-username').addClass('valid-feedback');
                        $('.form-update-student .feedback-username').removeClass('invalid-feedback');

                    }
                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('.form-update-student .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your username');
            $('.form-update-student .myUsername').addClass('is-invalid');
            $('.form-update-student .feedback-username').addClass('invalid-feedback');

        }

    });

    $(".form-update-student #student-update-contact").keyup(function () {

        var contact = $(this).val().trim();

        if (contact != '') {

            $.ajax({
                url: 'query/validate-check-contact-no.php',
                type: 'post',
                data: {
                    contact: contact
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'This Number is Already Registered') {
                        $('.form-update-student .contact-feedback').show();
                        $('.form-update-student .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number is already taken');
                        $('.form-update-student .myContact').addClass('is-invalid');
                        $('.form-update-student .myContact').removeClass('is-valid');
                        $('.form-update-student .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-student .contact-feedback').addClass('invalid-feedback');
                    } else if (!validInteger($(".form-update-student #student-update-contact"))) {
                        $('.form-update-student .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format  only include numbers');
                        $('.form-update-student .contact-feedback').show();
                        $('.form-update-student .myContact').addClass('is-invalid');
                        $('.form-update-student .myContact').removeClass('is-valid');
                        $('.form-update-student .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-student .contact-feedback').addClass('invalid-feedback');
                    } else if (contact.length != 11) {
                        $('.form-update-student .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number must be 11 numbers');
                        $('.form-update-student .contact-feedback').show();
                        $('.form-update-student .myContact').addClass('is-invalid');
                        $('.form-update-student .myContact').removeClass('is-valid');
                        $('.form-update-student .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-student .contact-feedback').addClass('invalid-feedback');
                    } else if (!validatePhoneNumber($(".form-update-student #student-update-contact"))) {
                        $('.form-update-student .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format must include <b> 09 </b> at the beginning of contact number');
                        $('.form-update-student .contact-feedback').show();
                        $('.form-update-student .myContact').addClass('is-invalid');
                        $('.form-update-student .myContact').removeClass('is-valid');
                        $('.form-update-student .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-student .contact-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-update-student .contact-feedback').show();
                        $('.form-update-student .contact-feedback').html('<i class="fa-solid fa-circle-check"></i> Contact number is valid');
                        $('.form-update-student .contact-feedback').addClass('valid-feedback');
                        $('.form-update-student .contact-feedback').removeClass('invalid-feedback');
                        $('.form-update-student .myContact').addClass('is-valid');
                        $('.form-update-student .myContact').removeClass('is-invalid');
                    }
                }
            });
        } else {
            $('.form-update-student .myContact').addClass('is-invalid');
            $('.form-update-student .contact-feedback').addClass('invalid-feedback');
            $('.form-update-student .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');

        }

    });
});



$(document).ready(function () {
    $('.form-add-personnel #personnel-add-firstname').on('keyup', function () {
        $('.feedback-fname').hide();
        if ($('.form-add-personnel #personnel-add-firstname').val().length == "") {
            $('.form-add-personnel #personnel-add-firstname').addClass('is-invalid');
            $('.form-add-personnel .feedback-fname').show();

        } else {
            $('.form-add-personnel #personnel-add-firstname').addClass('is-valid');
            $('.form-add-personnel #personnel-add-firstname').removeClass('is-invalid');
        }
    });

    $('.form-add-personnel #personnel-add-lastname').on('keyup', function () {
        $('.feedback-lname').hide();
        if ($('.form-add-personnel #personnel-add-lastname').val().length == "") {
            $('.form-add-personnel #personnel-add-lastname').addClass('is-invalid');
            $('.feedback-lname').show();

        } else {
            $('.form-add-personnel #personnel-add-lastname').addClass('is-valid');
            $('.form-add-personnel #personnel-add-lastname').removeClass('is-invalid');
        }
    });

    $('.form-add-personnel #personnel-add-gender').on('keyup', function () {
        $('.feedback-gender').hide();
        if ($('.form-add-personnel #personnel-add-gender').val().length == "") {
            $('.form-add-personnel #personnel-add-gender').addClass('is-invalid');
            $('.feedback-gender').show();

        } else {
            $('.form-add-personnel #personnel-add-gender').addClass('is-valid');
            $('.form-add-personnel #personnel-add-gender').removeClass('is-invalid');
        }
    });

    $('.form-add-personnel #personnel-add-grade-level').on('change', function () {
        $('.form-add-personnel .feedback-grade-level').hide();
        if ($('.form-add-personnel #personnel-add-grade-level').val().length != "") {
            $('.form-add-personnel #personnel-add-grade-level').addClass('is-valid');
            $('.form-add-personnel #personnel-add-grade-level').removeClass('is-invalid');

        } else {
            $('.form-add-personnel .feedback-grade-level').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your grade level');
            $('.form-add-personnel .feedback-grade-level').show();
        }
    });


    $(".form-add-personnel #personnel-add-institution").keyup(function () {

        var institution = $(this).val().trim();

        if (institution != '') {

            $.ajax({
                url: 'query/validate-check-institution.php',
                type: 'post',
                data: {
                    institution: institution
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Institution Exist') {
                        $('.form-add-personnel .institution-feedback').html('<i class="fa-solid fa-circle-check"></i> Institution available');
                        $('.form-add-personnel .myInstitution').addClass('is-valid');
                        $('.form-add-personnel .myInstitution').removeClass('is-invalid');
                        $('.form-add-personnel .institution-feedback').addClass('valid-feedback');
                        $('.form-add-personnel .institution-feedback').removeClass('invalid-feedback');
                    } else if (response == 'Institution Doesnt Exist') {
                        $('.form-add-personnel .institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Institution not available');
                        $('.form-add-personnel .myInstitution').removeClass('is-valid');
                        $('.form-add-personnel .myInstitution').addClass('is-invalid');
                        $('.form-add-personnel .institution-feedback').removeClass('valid-feedback');
                        $('.form-add-personnel .institution-feedback').addClass('invalid-feedback');
                    }


                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('#institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
        }

    });

    $(".form-add-personnel #personnel-add-email").keyup(function () {

        var email = $(this).val().trim();

        if (email != '') {

            $.ajax({
                url: 'query/validate-check-email.php',
                type: 'post',
                data: {
                    email: email
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Email Exists') {
                        $('.form-add-personnel .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is already taken');
                        $('.form-add-personnel .myEmail').removeClass('is-valid');
                        $('.form-add-personnel .myEmail').addClass('is-invalid');
                        $('.form-add-personnel .email-feedback').removeClass('valid-feedback');
                        $('.form-add-personnel .email-feedback').addClass('invalid-feedback');
                    } else if (!validateEmail($(".form-add-personnel #personnel-add-email"))) {
                        $('.form-add-personnel .myEmail').removeClass('is-valid');
                        $('.form-add-personnel .myEmail').addClass('is-invalid');
                        $('.form-add-personnel .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is invalid format');
                        $('.form-add-personnel .email-feedback').removeClass('valid-feedback');
                        $('.form-add-personnel .email-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-add-personnel .myEmail').addClass('is-valid');
                        $('.form-add-personnel .myEmail').removeClass('is-invalid');

                        $('.form-add-personnel .email-feedback').html('<i class="fa-solid fa-circle-check"></i> Email is valid');
                        $('.form-add-personnel .email-feedback').addClass('valid-feedback');
                        $('.form-add-personnel .email-feedback').removeClass('invalid-feedback');

                    }
                }
            });
        } else {
            $('.form-add-personnel .myEmail').addClass('is-invalid');
            $('.form-add-personnel .email-feedback').addClass('invalid-feedback');
            $('.form-add-personnel .empty-field-email').show();
            $('.form-add-personnel .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your email');


        }

    });

    $(".form-add-personnel #personnel-add-username").keyup(function () {

        var username = $(this).val().trim();

        if (username != '') {

            $.ajax({
                url: 'query/validate-check-username.php',
                type: 'post',
                data: {
                    username: username
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Username Exist') {
                        $('.form-add-personnel .feedback-username').show();
                        $('.form-add-personnel .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username is already taken');
                        $('.form-add-personnel .myUsername').addClass('is-invalid');
                        $('.form-add-personnel .myUsername').removeClass('is-valid');
                        $('.form-add-personnel .feedback-username').addClass('invalid-feedback');
                        $('.form-add-personnel .feedback-username').removeClass('valid-feedback');
                    } else if (username.length < 5) {
                        $('.form-add-personnel .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username must be atleast 5 characters');
                        $('.form-add-personnel .feedback-username').show();
                        $('.form-add-personnel .myUsername').addClass('is-invalid');
                        $('.form-add-personnel .myUsername').removeClass('is-valid');
                        $('.form-add-personnel .feedback-username').addClass('invalid-feedback');
                        $('.form-add-personnel .feedback-username').removeClass('valid-feedback');
                    } else {
                        $('.form-add-personnel .feedback-username').html('<i class="fa-solid fa-circle-check"></i> Username is available');
                        $('.form-add-personnel .feedback-username').show();
                        $('.form-add-personnel .myUsername').addClass('is-valid');
                        $('.form-add-personnel .myUsername').removeClass('is-invalid');
                        $('.form-add-personnel .feedback-username').addClass('valid-feedback');
                        $('.form-add-personnel .feedback-username').removeClass('invalid-feedback');

                    }
                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('.form-add-personnel .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your username');
            $('.form-add-personnel .myUsername').addClass('is-invalid');
            $('.form-add-personnel .feedback-username').addClass('invalid-feedback');

        }

    });

    $(".form-add-personnel #personnel-add-contact").keyup(function () {

        var contact = $(this).val().trim();

        if (contact != '') {

            $.ajax({
                url: 'query/validate-check-contact-no.php',
                type: 'post',
                data: {
                    contact: contact
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'This Number is Already Registered') {
                        $('.form-add-personnel .contact-feedback').show();
                        $('.form-add-personnel .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number is already taken');
                        $('.form-add-personnel .myContact').addClass('is-invalid');
                        $('.form-add-personnel .myContact').removeClass('is-valid');
                        $('.form-add-personnel .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-personnel .contact-feedback').addClass('invalid-feedback');
                    } else if (!validInteger($(".form-add-personnel #personnel-add-contact"))) {
                        $('.form-add-personnel .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format  only include numbers');
                        $('.form-add-personnel .contact-feedback').show();
                        $('.form-add-personnel .myContact').addClass('is-invalid');
                        $('.form-add-personnel .myContact').removeClass('is-valid');
                        $('.form-add-personnel .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-personnel .contact-feedback').addClass('invalid-feedback');
                    } else if (contact.length != 11) {
                        $('.form-add-personnel .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number must be 11 numbers');
                        $('.form-add-personnel .contact-feedback').show();
                        $('.form-add-personnel .myContact').addClass('is-invalid');
                        $('.form-add-personnel .myContact').removeClass('is-valid');
                        $('.form-add-personnel .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-personnel .contact-feedback').addClass('invalid-feedback');
                    } else if (!validatePhoneNumber($(".form-add-personnel #personnel-add-contact"))) {
                        $('.form-add-personnel .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format must include <b> 09 </b> at the beginning of contact number');
                        $('.form-add-personnel .contact-feedback').show();
                        $('.form-add-personnel .myContact').addClass('is-invalid');
                        $('.form-add-personnel .myContact').removeClass('is-valid');
                        $('.form-add-personnel .contact-feedback').removeClass('valid-feedback');
                        $('.form-add-personnel .contact-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-add-personnel .contact-feedback').show();
                        $('.form-add-personnel .contact-feedback').html('<i class="fa-solid fa-circle-check"></i> Contact number is valid');
                        $('.form-add-personnel .contact-feedback').addClass('valid-feedback');
                        $('.form-add-personnel .contact-feedback').removeClass('invalid-feedback');
                        $('.form-add-personnel .myContact').addClass('is-valid');
                        $('.form-add-personnel .myContact').removeClass('is-invalid');
                    }
                }
            });
        } else {
            $('.form-add-personnel .myContact').addClass('is-invalid');
            $('.form-add-personnel .contact-feedback').addClass('invalid-feedback');
            $('.form-add-personnel .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');

        }

    });
});





$(document).ready(function () {
    $('.form-update-personnel #personnel-update-firstname').on('keyup', function () {
        $('.feedback-fname').hide();
        if ($('.form-update-personnel #personnel-update-firstname').val().length == "") {
            $('.form-update-personnel #personnel-update-firstname').addClass('is-invalid');
            $('.form-update-personnel .feedback-fname').show();

        } else {
            $('.form-update-personnel #personnel-update-firstname').addClass('is-valid');
            $('.form-update-personnel #personnel-update-firstname').removeClass('is-invalid');
        }
    });

    $('.form-update-personnel #personnel-update-lastname').on('keyup', function () {
        $('.feedback-lname').hide();
        if ($('.form-update-personnel #personnel-update-lastname').val().length == "") {
            $('.form-update-personnel #personnel-update-lastname').addClass('is-invalid');
            $('.feedback-lname').show();

        } else {
            $('.form-update-personnel #personnel-update-lastname').addClass('is-valid');
            $('.form-update-personnel #personnel-update-lastname').removeClass('is-invalid');
        }
    });

    $('.form-update-personnel #personnel-update-gender').on('keyup', function () {
        $('.feedback-gender').hide();
        if ($('.form-update-personnel #personnel-update-gender').val().length == "") {
            $('.form-update-personnel #personnel-update-gender').addClass('is-invalid');
            $('.feedback-gender').show();

        } else {
            $('.form-update-personnel #personnel-update-gender').addClass('is-valid');
            $('.form-update-personnel #personnel-update-gender').removeClass('is-invalid');
        }
    });

    $('.form-update-personnel #personnel-update-grade-level').on('change', function () {
        $('.form-update-personnel .feedback-grade-level').hide();
        if ($('.form-update-personnel #personnel-update-grade-level').val().length != "") {
            $('.form-update-personnel #personnel-update-grade-level').addClass('is-valid');
            $('.form-update-personnel #personnel-update-grade-level').removeClass('is-invalid');

        } else {
            $('.form-update-personnel .feedback-grade-level').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your grade level');
            $('.form-update-personnel .feedback-grade-level').show();
        }
    });


    $(".form-update-personnel #personnel-update-institution").keyup(function () {

        var institution = $(this).val().trim();

        if (institution != '') {

            $.ajax({
                url: 'query/validate-check-institution.php',
                type: 'post',
                data: {
                    institution: institution
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Institution Exist') {
                        $('.form-update-personnel .institution-feedback').html('<i class="fa-solid fa-circle-check"></i> Institution available');
                        $('.form-update-personnel .myInstitution').addClass('is-valid');
                        $('.form-update-personnel .myInstitution').removeClass('is-invalid');
                        $('.form-update-personnel .institution-feedback').addClass('valid-feedback');
                        $('.form-update-personnel .institution-feedback').removeClass('invalid-feedback');
                    } else if (response == 'Institution Doesnt Exist') {
                        $('.form-update-personnel .institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Institution not available');
                        $('.form-update-personnel .myInstitution').removeClass('is-valid');
                        $('.form-update-personnel .myInstitution').addClass('is-invalid');
                        $('.form-update-personnel .institution-feedback').removeClass('valid-feedback');
                        $('.form-update-personnel .institution-feedback').addClass('invalid-feedback');
                    }


                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('#institution-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
        }

    });

    $(".form-update-personnel #personnel-update-email").keyup(function () {

        var email = $(this).val().trim();

        if (email != '') {

            $.ajax({
                url: 'query/validate-check-email.php',
                type: 'post',
                data: {
                    email: email
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Email Exists') {
                        $('.form-update-personnel .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is already taken');
                        $('.form-update-personnel .myEmail').removeClass('is-valid');
                        $('.form-update-personnel .myEmail').addClass('is-invalid');
                        $('.form-update-personnel .email-feedback').removeClass('valid-feedback');
                        $('.form-update-personnel .email-feedback').addClass('invalid-feedback');
                    } else if (!validateEmail($(".form-update-personnel #personnel-update-email"))) {
                        $('.form-update-personnel .myEmail').removeClass('is-valid');
                        $('.form-update-personnel .myEmail').addClass('is-invalid');
                        $('.form-update-personnel .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is invalid format');
                        $('.form-update-personnel .email-feedback').removeClass('valid-feedback');
                        $('.form-update-personnel .email-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-update-personnel .myEmail').addClass('is-valid');
                        $('.form-update-personnel .myEmail').removeClass('is-invalid');

                        $('.form-update-personnel .email-feedback').html('<i class="fa-solid fa-circle-check"></i> Email is valid');
                        $('.form-update-personnel .email-feedback').addClass('valid-feedback');
                        $('.form-update-personnel .email-feedback').removeClass('invalid-feedback');

                    }
                }
            });
        } else {
            $('.form-update-personnel .myEmail').addClass('is-invalid');
            $('.form-update-personnel .email-feedback').addClass('invalid-feedback');
            $('.form-update-personnel .empty-field-email').show();
            $('.form-update-personnel .email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your email');


        }

    });

    $(".form-update-personnel #personnel-update-username").keyup(function () {

        var username = $(this).val().trim();

        if (username != '') {

            $.ajax({
                url: 'query/validate-check-username.php',
                type: 'post',
                data: {
                    username: username
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'Username Exist') {
                        $('.form-update-personnel .feedback-username').show();
                        $('.form-update-personnel .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username is already taken');
                        $('.form-update-personnel .myUsername').addClass('is-invalid');
                        $('.form-update-personnel .myUsername').removeClass('is-valid');
                        $('.form-update-personnel .feedback-username').addClass('invalid-feedback');
                        $('.form-update-personnel .feedback-username').removeClass('valid-feedback');
                    } else if (username.length < 5) {
                        $('.form-update-personnel .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Username must be atleast 5 characters');
                        $('.form-update-personnel .feedback-username').show();
                        $('.form-update-personnel .myUsername').addClass('is-invalid');
                        $('.form-update-personnel .myUsername').removeClass('is-valid');
                        $('.form-update-personnel .feedback-username').addClass('invalid-feedback');
                        $('.form-update-personnel .feedback-username').removeClass('valid-feedback');
                    } else {
                        $('.form-update-personnel .feedback-username').html('<i class="fa-solid fa-circle-check"></i> Username is available');
                        $('.form-update-personnel .feedback-username').show();
                        $('.form-update-personnel .myUsername').addClass('is-valid');
                        $('.form-update-personnel .myUsername').removeClass('is-invalid');
                        $('.form-update-personnel .feedback-username').addClass('valid-feedback');
                        $('.form-update-personnel .feedback-username').removeClass('invalid-feedback');

                    }
                },
                error: function (xhr, status, error) {
                    //console.error(xhr);


                }
            });
        } else {
            $('.form-update-personnel .feedback-username').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your username');
            $('.form-update-personnel .myUsername').addClass('is-invalid');
            $('.form-update-personnel .feedback-username').addClass('invalid-feedback');

        }

    });

    $(".form-update-personnel #personnel-update-contact").keyup(function () {

        var contact = $(this).val().trim();

        if (contact != '') {

            $.ajax({
                url: 'query/validate-check-contact-no.php',
                type: 'post',
                data: {
                    contact: contact
                },
                dataType: "json",

                success: function (response) {

                    if (response == 'This Number is Already Registered') {
                        $('.form-update-personnel .contact-feedback').show();
                        $('.form-update-personnel .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number is already taken');
                        $('.form-update-personnel .myContact').addClass('is-invalid');
                        $('.form-update-personnel .myContact').removeClass('is-valid');
                        $('.form-update-personnel .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-personnel .contact-feedback').addClass('invalid-feedback');
                    } else if (!validInteger($(".form-update-personnel #personnel-update-contact"))) {
                        $('.form-update-personnel .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format  only include numbers');
                        $('.form-update-personnel .contact-feedback').show();
                        $('.form-update-personnel .myContact').addClass('is-invalid');
                        $('.form-update-personnel .myContact').removeClass('is-valid');
                        $('.form-update-personnel .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-personnel .contact-feedback').addClass('invalid-feedback');
                    } else if (contact.length != 11) {
                        $('.form-update-personnel .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number must be 11 numbers');
                        $('.form-update-personnel .contact-feedback').show();
                        $('.form-update-personnel .myContact').addClass('is-invalid');
                        $('.form-update-personnel .myContact').removeClass('is-valid');
                        $('.form-update-personnel .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-personnel .contact-feedback').addClass('invalid-feedback');
                    } else if (!validatePhoneNumber($(".form-update-personnel #personnel-update-contact"))) {
                        $('.form-update-personnel .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format must include <b> 09 </b> at the beginning of contact number');
                        $('.form-update-personnel .contact-feedback').show();
                        $('.form-update-personnel .myContact').addClass('is-invalid');
                        $('.form-update-personnel .myContact').removeClass('is-valid');
                        $('.form-update-personnel .contact-feedback').removeClass('valid-feedback');
                        $('.form-update-personnel .contact-feedback').addClass('invalid-feedback');
                    } else {
                        $('.form-update-personnel .contact-feedback').show();
                        $('.form-update-personnel .contact-feedback').html('<i class="fa-solid fa-circle-check"></i> Contact number is valid');
                        $('.form-update-personnel .contact-feedback').addClass('valid-feedback');
                        $('.form-update-personnel .contact-feedback').removeClass('invalid-feedback');
                        $('.form-update-personnel .myContact').addClass('is-valid');
                        $('.form-update-personnel .myContact').removeClass('is-invalid');
                    }
                }
            });
        } else {
            $('.form-update-personnel .myContact').addClass('is-invalid');
            $('.form-update-personnel .contact-feedback').addClass('invalid-feedback');
            $('.form-update-personnel .contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');

        }

    });
});

