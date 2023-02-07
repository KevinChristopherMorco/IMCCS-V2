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

function emptyField() {
    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
}


function validLessonTime() {
    // return theNumber.match(/^\d+$/) && parseInt(theNumber) > 0;

    var time = $("#lesson-add-estimate-time").val();
    var updateTime = $("#lesson-update-estimate-time").val();


    var regex = /^[0-9]+$/;
    if (time.match(regex) || updateTime.match(regex)) {
        return true;
    }
}
$(document).ready(function () {

    jQuery(".add-lesson").click(function () {
        $('#add-lesson-modal').modal('show');

        $("#form-add-lesson").on("submit", function (event) {

            $(".form-add-lesson input").each(function (e) {

                var checkEmptyInput = $(this);
                if (checkEmptyInput.val() == "") {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });

            $(".form-add-lesson .tox-edit-area__iframe").each(function (e) {
                var checkEmptyInput = $(this);
                if (checkEmptyInput.contents().find('body').text().trim().length == 0) {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });
            if ($('#lesson-add-difficulty')[0].selectedIndex <= 0) {
                $('#lesson-add-difficulty').addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }

            if ($(".form-add-lesson input").hasClass('is-invalid') || $("iframe").hasClass('is-invalid')) {
                event.preventDefault();
                invalidInput()
            } else {

                event.preventDefault();
                var img = $('input[name=lesson-add-pic]').val();
                var title = $("#lesson-add-title").val();
                var description = $("#lesson-add-description").val();
                var difficulty = $("#lesson-add-difficulty").val();
                var estimated_time = $("#lesson-add-estimate-time").val();
                var unit_time = $("#lesson-add-unit-time").val();
                var lesson_paragraph = $("#lesson-add-paragraph").val();
                var status = $(".add-status:checked").val();


                var formData = new FormData();
                formData.append('title', title);
                formData.append('description', description);
                formData.append('difficulty', difficulty);
                formData.append('estimated_time', estimated_time);
                formData.append('unit_time', unit_time);
                formData.append('lesson_paragraph', lesson_paragraph);
                formData.append('status', status);

                formData.append('img', $('input[name=img]')[0].files[0]);
                for (var key of formData.entries()) {

                }

                $.ajax({
                    type: "POST",
                    url: 'query/lesson/lesson-add-tbl.php',
                    data: formData,


                    success: function (data) {


                        Toast.fire({
                            icon: 'success',
                            title: 'Topic added ! <br>It is now visible on the menu of users</br>',

                        }).then((result) => {
                            if (result) {
                                window.location.reload();
                            } else {
                                // something other stuff
                            }

                        })

                    },
                    contentType: false,
                    processData: false,
                    cache: false,
                    error: function (xhr, status, error) {
                        //console.error(xhr);

                    }
                });
                //}
            }
        });
    });
});

$(document).ready(function () {

    jQuery(".view-lesson").click(function () {
        var id = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: 'query/lesson/lesson-getid-view.php',
            data: {
                lesson_id: id
            },
            dataType: 'json',
            success: function (res) {
                $('#view-lesson-modal').modal('show');
                $('#lesson-view-title').val(res.title);
                $('#lesson-view-description').val(res.description);
                $("#lesson-view-difficulty").val(res.difficulty);
                $("#lesson-view-estimate-time").val(res.estimated_time);
                $("#lesson-view-paragraph").val(res.lesson_paragraph);
                $("#lesson-view-status").val(res.status);

            }
        });

    });
});

$(document).ready(function () {

    $("body").on('click', '.edit-lesson', function (e) {
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
                    url: 'query/lesson/lesson-getid-view.php',
                    data: {
                        lesson_id: id //fieldname in the database : data-id value
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#update-lesson-modal').modal('show');
                        $('#lesson-id').val(res.lesson_id); //ID IN INPUT BOX AND RES IS FIELD NAME IN DATABASE
                        $('#lesson-update-title').val(res.title);
                        tinymce.get("lesson-update-description").setContent(res.description);
                        $("#lesson-update-difficulty").val(res.difficulty);
                        $("#lesson-update-estimate-time").val(res.estimated_time);
                        tinymce.get("lesson-update-paragraph").setContent(res.lesson_paragraph);
                        $('#lesson-update-pic').val(res.lesson_img);

                    }
                });
            }
        });
    });
});

$('#form-update-lesson').submit(function (event) {
    $(".form-update-lesson input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    $(".form-update-lesson .tox-edit-area__iframe").each(function (e) {
        var checkEmptyInput = $(this);
        if (checkEmptyInput.contents().find('body').text().trim().length == 0) {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });


    if ($('#lesson-update-difficulty')[0].selectedIndex <= 0) {
        $('#lesson-update-difficulty').addClass('is-invalid')
        $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }

    if ($(".form-update-lesson input").hasClass('is-invalid') || $(".form-update-lesson textarea").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {
        var lesson_id = $('#lesson-id').val();
        var title = $('#lesson-update-title').val();

        var description = tinymce.get("lesson-update-description").getContent();
        var difficulty = $("#lesson-update-difficulty").val();
        var estimated_time = $("#lesson-update-estimate-time").val();
        var unit_time = $("#lesson-update-unit-time").val();
        var lesson_paragraph = tinymce.get("lesson-update-paragraph").getContent();
        var status = $(".update-status:checked").val();

        var formData = new FormData();
        formData.append('lesson_id', lesson_id);

        formData.append('title', title);
        formData.append('description', description);
        formData.append('difficulty', difficulty);
        formData.append('estimated_time', estimated_time);
        formData.append('unit_time', unit_time);
        formData.append('lesson_paragraph', lesson_paragraph);
        formData.append('status', status);


        formData.append('lesson-update-pic', $('input[name=lesson-update-pic]')[0].files[0]);
        for (var key of formData.entries()) {

        }

        Swal.fire({
            title: 'Are you sure you want to update this record?',
            text: "This action cannot be reverted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Update!',
            reverseButtons: true,
            allowOutsideClick: false,


        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: "query/lesson/lesson-update-tbl.php",
                    data: formData,

                    success: function (data) {

                        Toast.fire({
                            icon: 'success',
                            title: 'Topic information updated !<br> Changes were saved </br>',

                        }).then(function () {
                            window.location.reload();
                        });
                    },
                    contentType: false,
                    processData: false,
                    cache: false,
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

    $("body").on('click', '.delete-lesson', function (e) {
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
                    url: 'query/lesson/lesson-delete-tbl.php',
                    data: {
                        lesson_id: id
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

    $(".topic-section .checkbox-delete").on("click", function () {
        var checkedChbx = $('.topic-section .checkbox-delete:checked');

        if (checkedChbx.length > 0) {
            $('.topic-section .delete-link').show(200);
        }
        else {
            $('.topic-section .delete-link').hide(100);
        }
    });
    $(".topic-section .checkbox-all").click(function () {
        var checkall = $(this).is(":checked")
        var checkedChbx = $('input:checkbox').not(this).prop('checked', this.checked);
        if (checkedChbx.length > 0 && checkall == true) {
            $('.topic-section .delete-link').show(200);
        }
        else {
            $('.topic-section .delete-link').hide(100);
        }
    });

    $(".topic-section .delete-link").on("click", function () {
        var id = [];

        $("table > tbody > tr.table-topic-data").each(function () {
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
                        url: 'query/lesson/lesson-delete-tbl.php',
                        data: {
                            lesson_id: id
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



jQuery(".add-subtopic").click(function () {
    var title = $(this).data('title');
    var id = $(this).data('id');

    $('#subtopic-add-title').val(title)
    $('#subtopic-add-id').val(id)


    $('#subtopic-add-modal').modal('show');

    $.ajax({
        type: "POST",
        url: 'query/filter-subtopic.php',
        data: {
            title: title,
            id: id,
        },
        success: function (data) {

            $('.select-filter').html(data);

        },
        error: function (xhr, status, error) {
            console.error(xhr);
            console.error(status);
            console.error(error);

        }
    });

});

$('#form-add-subtopic').submit(function (event) {
    var title = $("#subtopic-add-title").val();
    var id = $("#subtopic-add-id").val();

    var bullet = $("#subtopic-add-bullet").val();
    var subTitle = $("#subtopic-add-sub").val();
    var content = tinymce.get("subtopic-add-content").getContent();

    $('.newModule').removeClass('is-invalid')



    $("#form-add-subtopic input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    $("#form-add-subtopic .tox-edit-area__iframe").each(function (e) {
        var checkEmptyInput = $(this);
        if (checkEmptyInput.contents().find('body').text().trim().length == 0) {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });


    if ($('#subtopic-add-bullet')[0].selectedIndex <= 0) {
        $('#subtopic-add-bullet').addClass('is-invalid')
        $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    } else {
        $('#subtopic-add-bullet').removeClass('is-invalid')

    }

    if ($("#form-add-subtopic input").hasClass('is-invalid') || $("iframe").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {

        $.ajax({
            type: "POST",
            url: 'query/subtopic/subtopic-add-tbl.php',
            data: {
                title: title,
                lesson_id: id,
                module: bullet,
                subTitle: subTitle,
                content: content

            },
           // dataType: 'json',
            success: function (data) {

                Toast.fire({
                    icon: 'success',
                    title: 'Subtopic added !',

                }).then(function () {
                    window.location.reload();
                });

            },
            error: function (xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);

            }
        });
    }
})

$(document).ready(function () {

    jQuery(".view-subtopic").click(function () {
        var id = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: 'query/subtopic/subtopic-getid-view.php',
            data: {
                subtopic_id: id //fieldname in the database : data-id value
            },
            dataType: 'json',
            success: function (res) {

                $('#subtopic-view-modal').modal('show');
                $("#subtopic-view-title").val(res.title);

                $('#subtopic-id').val(res.subtopic_id); //ID IN INPUT BOX AND RES IS FIELD NAME IN DATABASE
                $('#subtopic-view-bullet').val(res.module);
                $("#subtopic-view-sub").val(res.subtopic);
                tinymce.get("subtopic-view-content").setContent(res.content);
            }
        });

    });
});

jQuery(".edit-subtopic").click(function () {

    var title = $(this).data('title');
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
                url: 'query/subtopic/subtopic-getid-view.php',
                data: {
                    subtopic_id: id //fieldname in the database : data-id value
                },
                dataType: 'json',
                success: function (res) {

                    $('#subtopic-update-modal').modal('show');
                    $("#subtopic-update-title").val(res.title);

                    $('#subtopic-id').val(res.subtopic_id); //ID IN INPUT BOX AND RES IS FIELD NAME IN DATABASE
                    $('#subtopic-update-bullet').val(res.module);
                    $("#subtopic-update-sub").val(res.subtopic);
                    tinymce.get("subtopic-update-content").setContent(res.content);
                    /*$("#lesson-update-difficulty").val(res.difficulty);
                    $("#lesson-update-estimate-time").val(res.estimated_time);
                    tinymce.get("lesson-update-paragraph").setContent(res.lesson_paragraph);
                    $('#lesson-update-pic').val(res.lesson_img); */

                }
            });
        }

    });

});

$('#form-update-subtopic').submit(function (event) {
    $(this).removeClass('was-validated')

    $("#form-update-subtopic input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    $("#form-update-subtopic .tox-edit-area__iframe").each(function (e) {
        var checkEmptyInput = $(this);
        if (checkEmptyInput.contents().find('body').text().trim().length == 0) {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });


    if ($('#subtopic-update-bullet')[0].selectedIndex <= 0) {
        $('#subtopic-update-bullet').addClass('is-invalid')
        $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }

    if ($("#form-update-subtopic input").hasClass('is-invalid') || $("iframe").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {
        var id = $("#subtopic-id").val();
        var title = $("#subtopic-update-title").val();
        var module = $("#subtopic-update-bullet").val();
        var subtopic = $("#subtopic-update-sub").val();
        var content = tinymce.get("subtopic-update-content").getContent();


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
                    url: "query/subtopic/subtopic-update-tbl.php",
                    data: {
                        subtopic_id: id,
                        title: title,
                        module: module,
                        subtopic: subtopic,
                        content: content

                    }, // get all form field value in
                    dataType: 'json',

                    success: function (data) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Subtopic information updated!<br> Changes were saved </br>',

                        }).then(function () {
                            window.location.reload();
                        });
                    }, error: function (error) {

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

    $("body").on('click', '.delete-subtopic', function (e) {
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
                    url: 'query/subtopic/subtopic-delete-tbl.php',
                    data: {
                        subtopic_id: id
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

    $(".subtopic-section .checkbox-delete").on("click", function () {
        var checkedChbx = $('.subtopic-section .checkbox-delete:checked');

        if (checkedChbx.length > 0) {
            $('.subtopic-section .delete-link').show(200);
        }
        else {
            $('.subtopic-section .delete-link').hide(100);
        }
    });
    $(".subtopic-section .checkbox-all").click(function () {
        var checkall = $(this).is(":checked")
        var checkedChbx = $('input:checkbox').not(this).prop('checked', this.checked);
        if (checkedChbx.length > 0 && checkall == true) {
            $('.subtopic-section .delete-link').show(200);
        }
        else {
            $('.subtopic-section .delete-link').hide(100);
        }
    });

    $(".subtopic-section .delete-link").on("click", function () {
        var id = [];

        $("table > tbody > tr.table-subtopic-data").each(function () {
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
                        url: 'query/subtopic/subtopic-delete-tbl.php',
                        data: {
                            subtopic_id: id
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



$(".form-add-lesson input").keyup(function () {
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
$(".form-add-subtopic input").keyup(function () {
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




$(".form-update-subtopic input").keyup(function () {
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

$(".form-add-lesson #lesson-add-estimate-time").keyup(function () {
    var input = $(this).val().trim();
    if (input != '') {
        if (!validLessonTime()) {
            $('.form-add-lesson .feedback-time').html('<i class="fa-solid fa-triangle-exclamation"></i> Only numbers are allowed.');
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');

        }
    }

})

$('.form-add-lesson #lesson-add-difficulty').on('change', function () {
    $('.form-add-lesson #feedback-grade-level').hide();
    if ($('.form-add-lesson #lesson-add-difficulty').val().length != "") {
        $('.form-add-lesson #lesson-add-difficulty').addClass('is-valid');
        $('.form-add-lesson #lesson-add-difficulty').removeClass('is-invalid');

    }
});

$("#lesson-add-pic").change(function () {

    var validExtensions = ["jpg", "jpeg", "png"]
    var file = $(this).val().split('.').pop();
    if (validExtensions.indexOf(file) == -1) {
        $(this).addClass('is-invalid')
        $('.form-add-lesson .feedback-photo').html('<i class="fa-solid fa-triangle-exclamation"></i> Only extension of jpg, jpeg and png are allowed.');
    } else {
        $(this).removeClass('is-invalid')
        $(this).addClass('is-valid')

    }

});


$(".form-update-lesson input").keyup(function () {
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

/*

$(".form-update-lesson textarea").keyup(function () {
    var input = $(this).val().trim();
    if (input != '') {
        $(this).addClass('is-valid');
        $(this).removeClass('is-invalid');
    } else {
        $(this).addClass('is-invalid');
        $(this).removeClass('is-valid');
        emptyField();

    }

}) */


$(".form-update-lesson #lesson-update-estimate-time").keyup(function () {
    var input = $(this).val().trim();
    if (input != '') {
        if (!validLessonTime()) {
            $('.form-update-lesson .feedback-time').html('<i class="fa-solid fa-triangle-exclamation"></i> Only numbers are allowed.');
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');

        }
    }

})

$('.form-update-lesson #lesson-update-difficulty').on('change', function () {
    $('.form-update-lesson #feedback-grade-level').hide();
    if ($('.form-update-lesson #lesson-update-difficulty').val().length != "") {
        $('.form-update-lesson #lesson-update-difficulty').addClass('is-valid');
        $('.form-update-lesson #lesson-update-difficulty').removeClass('is-invalid');

    }
});

$("#lesson-update-pic").change(function () {

    var validExtensions = ["jpg", "jpeg", "png"]
    var file = $(this).val().split('.').pop();
    if (validExtensions.indexOf(file) == -1) {
        $(this).addClass('is-invalid')
        $('.form-update-lesson .feedback-photo').html('<i class="fa-solid fa-triangle-exclamation"></i> Only extension of jpg, jpeg and png are allowed.');
    } else {
        $(this).removeClass('is-invalid')
        $(this).addClass('is-valid')

    }

});






