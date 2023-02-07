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

function noAnswer() {
    Swal.fire({
        title: 'Some inputs doesnt have an answer',
        text: "Please check your questions if they have an answer",
        icon: 'error',
        confirmButtonColor: '#800000',
        confirmButtonText: 'OK',
        allowOutsideClick: false,

    })
}

function emptyField() {
    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
}

/*
function validAssessmentTime() {
    // return theNumber.match(/^\d+$/) && parseInt(theNumber) > 0;

    var time = $("#assessment-add-estimate-time").val();
    var timeUpdate = $("#assessment-update-estimate-time").val();
    var regex = /^[0-9]+$/;
    if (time.match(regex) || timeUpdate.match(regex)) {
        return true;
    }
}

function validRate() {
    // return theNumber.match(/^\d+$/) && parseInt(theNumber) > 0;

    var rate = $("#assessment-add-rate").val();
    var rateUpdate = $("#assessment-update-rate").val();

    var regex = /^[0-9]+$/;

    if (rate.match(regex) || rateUpdate.match(regex)) {
        return true;
    }
}
*/
function validAssessmentTime(inputElement) {
    var assessmentTime = inputElement.val();

    var reg = /^[0-9]+$/;
    return reg.test(assessmentTime);
}


function validRate(inputElement) {
    var rate = inputElement.val();

    var reg = /^[0-9]+$/;
    return reg.test(rate);
}
/*
function validRateLimit() {
    // return theNumber.match(/^\d+$/) && parseInt(theNumber) > 0;

    var rate = $("#assessment-add-rate").val();
    var regexLimit = /^[1-9][0-9]?$|^100$/

    if (rate.match(regexLimit)) {
        return true;
    }
}
*/

function validRateLimit(inputElement) {
    // return theNumber.match(/^\d+$/) && parseInt(theNumber) > 0;

    var rateLimit = inputElement.val();

    var reg = /^[1-9][0-9]?$|^100$/;
    return reg.test(rateLimit);
}

const Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    iconColor: 'white',
    customClass: {
        popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 1000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})


$(document).ready(function () {

    jQuery(".add-assessment").click(function () {
        $('#add-assessment-modal').modal('show');

        $("#form-add-assessment").on("submit", function (event) {

            $(".form-add-assessment input").each(function (e) {

                var checkEmptyInput = $(this);
                if (checkEmptyInput.val() == "") {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });


            /*
                        $(".form-add-assessment textarea").each(function (e) {

                            var checkEmptyInput = $(this);
                            if (checkEmptyInput.val() == "") {
                                checkEmptyInput.addClass('is-invalid')
                                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                            }
                        });
                        */
            $(".form-add-assessment .tox-edit-area__iframe").each(function (e) {
                var checkEmptyInput = $(this);
                if (checkEmptyInput.contents().find('body').text().trim().length == 0) {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });
            if ($('.form-add-assessment #assessment-add-difficulty')[0].selectedIndex <= 0) {
                $('.form-add-assessment #assessment-add-difficulty').addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }

            if ($(".form-add-assessment input").hasClass('is-invalid') || $(".form-add-assessment .tox-edit-area__iframe").hasClass('is-invalid') || $(".form-add-assessment select").hasClass('is-invalid')) {
                event.preventDefault();
                invalidInput()
            } else {

                event.preventDefault();
                var img = $('input[name=assessment-add-pic]').val();
                var title = $("#assessment-add-title").val();
                var description = $("#assessment-add-description").val();
                var difficulty = $("#assessment-add-difficulty").val();
                var estimated_time = $("#assessment-add-estimate-time").val();
                var deadline = $("#assessment-add-deadline").val();
                var unit_time = $("#assessment-add-unit-time").val();
                var rate = $("#assessment-add-rate").val();
                var status = $(".add-status:checked").val();
                var retake = $(".add-retake:checked").val();


                var formData = new FormData();
                formData.append('title', title);
                formData.append('description', description);
                formData.append('difficulty', difficulty);
                formData.append('estimated_time', estimated_time);
                formData.append('deadline', deadline);
                formData.append('unit_time', unit_time);
                formData.append('rate', rate);
                formData.append('status', status);
                formData.append('retake', retake);

                formData.append('img', $('input[name=img]')[0].files[0]);
                for (var key of formData.entries()) {

                }


                $.ajax({
                    type: "POST",
                    url: 'query/assessment/assessment-add-tbl.php',
                    data: formData,


                    success: function (data) {


                        Toast.fire({
                            icon: 'success',
                            title: 'Assessment created ! <br> It is now visible on the menu of users</br>',
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
            }
            //}
        });

    });

});

$(document).ready(function () {

    jQuery(".view-assessment").click(function () {
        var id = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: 'query/assessment/assessment-getid-view.php',
            data: {
                assessment_id: id
            },
            dataType: 'json',
            success: function (res) {
                $('#view-assessment-modal').modal('show');
                $('#assessment-view-title').val(res.title);
                $('#assessment-view-description').val(res.description);
                $('#assessment-view-difficulty').val(res.difficulty);
                $('#assessment-view-estimate-time').val(res.estimated_time);
                $('#assessment-view-deadline').val(res.deadline);
                $('#assessment-view-status').val(res.status);


            }
        });

    });
});

$(document).ready(function () {

    $("body").on('click', '.edit-assessment', function (e) {
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
                    url: 'query/assessment/assessment-getid-view.php',
                    data: {
                        assessment_id: id,
                    },
                    dataType: 'json',
                    success: function (res) {

                        $('#update-assessment-modal').modal('show');
                        $('#assessment-id').val(res.assessment_id); //ID IN INPUT BOX AND RES IS FIELD NAME IN DATABASE
                        $('#assessment-update-title').val(res.title);
                        tinymce.get("assessment-update-description").setContent(res.description);
                        $('#assessment-update-difficulty').val(res.difficulty);
                        $('#assessment-update-estimate-time').val(res.estimated_time);
                        $('#assessment-update-rate').val(res.passing_rate);

                        $('#assessment-update-deadline').val(res.deadline);

                    }
                });
            }
        });
    });
});

$('#form-update-assessment').submit(function (event) {
    $(".form-update-assessment input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });
    /*
        $(".form-update-assessment textarea").each(function (e) {

            var checkEmptyInput = $(this);
            if (checkEmptyInput.val() == "") {
                checkEmptyInput.addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }
        });
        */
    $(".form-update-assessment .tox-edit-area__iframe").each(function (e) {
        var checkEmptyInput = $(this);
        if (checkEmptyInput.contents().find('body').text().trim().length == 0) {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });
    if ($('#assessment-update-difficulty')[0].selectedIndex <= 0) {
        $('#assessment-update-difficulty').addClass('is-invalid')
        $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }

    if ($(".form-update-assessment input").hasClass('is-invalid') || $(".form-update-assessment .tox-edit-area__iframe").hasClass('is-invalid') || $(".form-update-assessment select").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {
        event.preventDefault();
        var assessment_id = $('#assessment-id').val();

        var update_img = $('input[name=assessment-update-pic]').val();
        var title = $('#assessment-update-title').val();
        var description = tinymce.get('assessment-update-description').getContent();
        var difficulty = $('#assessment-update-difficulty').val();
        var estimate = $('#assessment-update-estimate-time').val();
        var deadline = $("#assessment-update-deadline").val();
        var unit_time = $('#assessment-update-unit-time').val();
        var rate = $("#assessment-update-rate").val();
        var status = $(".update-status:checked").val();
        var retake = $(".update-retake:checked").val();



        var formData = new FormData();
        formData.append('assessment_id', assessment_id);

        formData.append('title', title);
        formData.append('description', description);
        formData.append('difficulty', difficulty);
        formData.append('estimated_time', estimate);
        formData.append('deadline', deadline);
        formData.append('unit_time', unit_time);
        formData.append('rate', rate);
        formData.append('status', status);
        formData.append('retake', retake);

        formData.append('update_img', $('input[name=assessment-update-pic]')[0].files[0]);
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
                    url: "query/assessment/assessment-update-tbl.php",
                    data: formData,

                    success: function (data) {


                        Toast.fire({
                            icon: 'success',
                            title: 'Assessment information updated !<br> Changes were saved </br>',

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

    $("body").on('click', '.delete-assessment', function (e) {
        var id = [];
        id.push($(this).data('id'));

        Swal.fire({
            title: 'Are you sure you want to delete this record?',
            text: "All questions and answers to this assessment would be deleted, You won't be able to retrieve this!",
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
                    url: 'query/assessment/assessment-delete-tbl.php',
                    data: {
                        assessment_id: id
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

    $(".assessment-section .checkbox-delete").on("click", function () {
        var checkedChbx = $('.assessment-section .checkbox-delete:checked');

        if (checkedChbx.length > 0) {
            $('.delete-link').show(200);
        }
        else {
            $('.delete-link').hide(100);
        }
    });

    $(".assessment-section .checkbox-all").click(function () {
        var checkall = $(this).is(":checked")
        var checkedChbx = $('input:checkbox').not(this).prop('checked', this.checked);
        if (checkedChbx.length > 0 && checkall == true) {
            $('.assessment-section .delete-link').show(200);
        }
        else {
            $('.assessment-section .delete-link').hide(100);
        }
    });

    $(".assessment-section .delete-link").on("click", function () {
        var id = [];

        $("table > tbody > tr.table-assessment-data").each(function () {
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
                        url: 'query/assessment/assessment-delete-tbl.php',
                        data: {
                            assessment_id: id
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
    jQuery(".add-assessment-choice").click(function () {
        var name = $(this).data('name');

        var id = $(this).data('id');


        //PRE DEFINED VALUES
        $("#assessment-choice-add-title").val(name);
        $("#assessment-choice-add-id").val(id);


        $('#add-assessment-choice-modal').modal('show');
        $(document).on("submit", "#form-add-assessment-choice", function (event) {

            console.log($(".form-add-assessment-choice input").hasClass('is-invalid'));

            $(".form-add-assessment-choice input:visible").each(function (e) {
                //console.log(e)
                var checkEmptyInput = $(this);
                if (checkEmptyInput.val() == "") {
                    if ($('.form-add-assessment-choice #assessment-choice-add-type-question').val() === 'Identification Question') {
                        $('.form-add-assessment-choice .mcq-item').removeClass('is-invalid')
                    } else {
                        checkEmptyInput.addClass('is-invalid')
                        $('.form-add-assessment-choice .invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                    }
                }
            });

            $(".form-add-assessment-choice .tox-edit-area__iframe").each(function (e) {
                var checkEmptyInput = $(this);
                if (checkEmptyInput.contents().find('body').text().trim().length == 0) {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });

            if ($('.form-add-assessment-choice #assessment-choice-add-title')[0].selectedIndex <= 0) {
                $('.form-add-assessment-choice #assessment-choice-add-title').addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }

            if ($('.form-add-assessment-choice #assessment-choice-add-type-question')[0].selectedIndex <= 0) {
                $('.form-add-assessment-choice #assessment-choice-add-type-question').addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }

            else if ($(".form-add-assessment-choice input:visible").hasClass('is-invalid') || $("iframe").hasClass('is-invalid')) {
                event.preventDefault();
                invalidInput()

            }
            else if ($(".form-add-assessment-choice .btn-answer-key").hasClass('no-answer')) {
                event.preventDefault();
                noAnswer();
            }


            else {
                var assessment_question = [];

                var answer = [];
                var point = [];
                var type = [];
                var ch1 = [];
                var ch2 = [];
                var ch3 = [];
                var ch4 = [];
                var length = [];

                $('.text-choice-option').each(function () {
                    var count = $(this).find('.text-answer').length;
                    length.push(count);
                });

                $('[name^="assessment-choice-question"]').each(function () {
                    assessment_question.push(this.value);
                });

                $('[name^="assessment-choice-add-answer"]').each(function () {
                    answer.push(this.value);
                });

                $('[name^="assessment-choice-add-point"]').each(function () {
                    point.push(this.value);
                });

                $('[name^="assessment-choice-add-ch1"]').each(function () {
                    ch1.push(this.value);
                });
                $('[name^="assessment-choice-add-ch2"]').each(function () {
                    ch2.push(this.value);
                });
                $('[name^="assessment-choice-add-ch3"]').each(function () {
                    ch3.push(this.value);
                });
                $('[name^="assessment-choice-add-ch4"]').each(function () {
                    ch4.push(this.value);
                });
                $('[name^="assessment-choice-add-type-question"]').each(function () {
                    type.push(this.value);
                });

                assessment_question = assessment_question.filter((item) => item);

                event.preventDefault();
                var forms = document.querySelectorAll('.needs-validation')
                var assessment_id = $("#assessment-choice-add-id").val();
                var title = $('input[name^="assessment-choice-add-title"]').val();

                $.ajax({
                    type: "POST",
                    url: 'query/assessment-choices/assessment-question-choices-add-tbl.php',
                    data: {
                        assessment_id: assessment_id,
                        title: title,
                        assessment_question: assessment_question,
                        type: type,
                        point: point,
                        assessment_choice1: ch1,
                        assessment_choice2: ch2,
                        assessment_choice3: ch3,
                        assessment_choice4: ch4,
                        assessment_answer: answer,
                        length: length
                    },

                    success: function (data) {

                        Toast.fire({
                            icon: 'success',
                            title: 'Question added to: <br>' + title + '</br>',

                        }).then((result) => {

                            window.location.reload();


                        })

                    },
                    error: function (xhr, status, error) {
                        //console.error(xhr);


                    }

                });
            }
            //}
        });

    });


});

$(document).ready(function () {

    jQuery(".view-question").click(function () {

        var id = $(this).data('id');


        $.ajax({
            type: 'POST',
            url: 'query/assessment-choices/assessment-question-choices-getid-view.php',
            data: {
                question_id: id
            },
            dataType: 'json',
            success: function (res) {
                res.forEach(function (row) {
                    $('#view-assessment-choice-modal').modal('show');
                    $("#assessment-choice-view-title").val(row.assessment_title);
                    $("#assessment-choice-view-question").val(row.assessment_question);
                    $("#assessment-choice-view-type-question").val(row.type);
                    $("#assessment-choice-view-ch1").val(row.assessment_choice1);
                    $("#assessment-choice-view-ch2").val(row.assessment_choice2);
                    $("#assessment-choice-view-ch3").val(row.assessment_choice3);
                    $("#assessment-choice-view-ch4").val(row.assessment_choice4);
                    $("#assessment-choice-view-answer").val(row.assessment_answer);
                });
                if ($("#assessment-choice-view-type-question").val() === 'Multiple Choice Question') {
                    $('.mcq-view-item').show()
                } else {
                    $('.mcq-view-item').hide()
                }

            }
        });



    });


});

$(document).ready(function () {

    $("body").on('click', '.edit-question', function (e) {
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
                    url: 'query/assessment-choices/assessment-question-choices-getid-view.php',
                    data: {
                        question_id: id //fieldname in the database : data-id value
                    },
                    dataType: 'json',
                    success: function (results) {
                        $('#update-assessment-choice-modal').modal('show');


                        results.forEach(function (row) {

                            $("#assessment-choice-update-id").val(row.assessment_id);
                            $("#assessment-choice-question-id").val(row.question_id);
                            //$("#assessment-choice-update-title option:selected").val(row.assessment_title);
                            tinymce.get("assessment-choice-update-question").setContent(row.assessment_question);
                            $("#assessment-choice-update-type-question").val(row.type);
                            $("#assessment-choice-update-ch1").val(row.assessment_choice1);
                            $("#assessment-choice-update-ch2").val(row.assessment_choice2);
                            $("#assessment-choice-update-ch3").val(row.assessment_choice3);
                            $("#assessment-choice-update-ch4").val(row.assessment_choice4);
                            $("#mcq-point").val(row.point);
                            $("#text-point-update").val(row.point);
                            $(".tf-text-point-update").val(row.point);

                            $(".choice-1-update").val(row.assessment_choice1);
                            $(".choice-2-update").val(row.assessment_choice2);
                            $(".choice-3-update").val(row.assessment_choice3);
                            $(".choice-4-update").val(row.assessment_choice4);

                            // $(".tf-text-answer-update").val(row.assessment_answer);
                            $(".tf-text-answer-update option[value='" + row.assessment_answer + "']").prop("selected", true);

                            // Clear the previous answers
                            $('.text-answer-update').remove();

                            // Loop over the answers and append them to the element
                            results.forEach(function (row) {
                                // Append a new textbox for each answer
                                $('#answer-container').append('<input type="text" class="form-control text-answer-update" value="' + row.assessment_answer + '">');
                            });
                            /*
                                                        results.forEach(function (row) {
                                                            // Append a new textbox for each answer
                                                            $('#answer-container').append('<input type="hidden" class="form-control text-answer-id" value="' + row.assessment_answer_id + '">');
                                                        });
                                                        */
                            results.forEach(function (row) {
                                // Append a new textbox for each answer
                                $('.list-question').append('<input type="hidden" name="answer_id[]" class="form-control text-answer-id" value="' + row.assessment_answer_id + '">');
                            });
                        });
                        if ($("#assessment-choice-update-type-question").val() === 'Multiple Choice Question') {
                            $('.mcq-class-update').show()
                        } else {
                            $('.mcq-class-update').hide()
                        }

                    }, error: function (xhr, status, error) {



                    }
                });
            }
        });
    });
});



$('#form-update-assessment-choice').submit(function (event) {

    $(".form-update-assessment-choice input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            if ($('.form-update-assessment-choice #assessment-choice-update-type-question').val() === 'Identification Question') {
                $('.form-update-assessment-choice .mcq-item').removeClass('is-invalid')
            } else if ($('.form-update-assessment-choice #assessment-choice-update-type-question').val() === 'True/False') {
                $('.form-update-assessment-choice .mcq-item').removeClass('is-invalid')
                $('.form-update-assessment-choice .mcq-item').val('N/A')

            } else {
                checkEmptyInput.addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }
        }
    });
    /*
        $(".form-update-assessment-choice textarea").each(function (e) {

            var checkEmptyInput = $(this);
            if (checkEmptyInput.val() == "") {
                checkEmptyInput.addClass('is-invalid')
                $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
            }
        });
    */
    $(".form-update-assessment-choice .tox-edit-area__iframe").each(function (e) {
        var checkEmptyInput = $(this);
        if (checkEmptyInput.contents().find('body').text().trim().length == 0) {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });
    if ($('.form-update-assessment-choice #assessment-choice-update-title')[0].selectedIndex <= 0) {
        $('.form-update-assessment-choice #assessment-choice-update-title').addClass('is-invalid')
        $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }

    if ($('.form-update-assessment-choice #assessment-choice-update-type-question')[0].selectedIndex <= 0) {
        $('.form-update-assessment-choice #assessment-choice-update-type-question').addClass('is-invalid')
        $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }
    console.log($(".form-update-assessment-choice input"));

    if ($(".form-update-assessment-choice input:visible").hasClass('is-invalid') || $(".form-update-assessment-choice .tox-edit-area__iframe").hasClass('is-invalid') || $(".form-update-assessment-choice select").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput();
        console.log($(".form-update-assessment-choice input").hasClass('is-invalid'))
    } else {
        event.preventDefault();
        var question_id = $("#assessment-choice-question-id").val();
        var assessment_id = $("#assessment-choice-update-id").val();
        var title = $("#assessment-choice-update-title").val();
        var question = tinymce.get("assessment-choice-update-question").getContent();
        var type = $("#assessment-choice-update-type-question").val();
        var ch1 = $("#assessment-choice-update-ch1").val();
        var ch2 = $("#assessment-choice-update-ch2").val();
        var ch3 = $("#assessment-choice-update-ch3").val();
        var ch4 = $("#assessment-choice-update-ch4").val();
        //var answer = $('[name="assessment-choice-add-answer"]').val();
        var answer_id = [];
        $('[name^="answer_id"]').each(function () {
            answer_id.push(this.value);
        });

        var text_answer = [];
        $('[name^="assessment-choice-add-answer"]').each(function () {
            text_answer.push(this.value);
        });
        var point = $('[name^="assessment-choice-add-point"]').val();





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
                    url: "query/assessment-choices/assessment-question-choices-update-tbl.php",
                    data: {
                        assessment_id: assessment_id,
                        question_id: question_id,
                        assessment_title: title,
                        assessment_question: question,
                        type: type,
                        assessment_choice1: ch1,
                        assessment_choice2: ch2,
                        assessment_choice3: ch3,
                        assessment_choice4: ch4,
                        answer_id: answer_id,
                        // assessment_answer: answer,
                        assessment_answer: text_answer,
                        point: point
                    },
                    // dataType: 'json',

                    success: function (data) {
                        console.log(data)
                        Toast.fire({
                            icon: 'success',
                            title: 'Question choices updated !<br> Changes were saved </br>',

                        }).then(function () {
                            //window.location.reload();
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

    $("body").on('click', '.delete-question', function (e) {
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
                    url: 'query/assessment-choices/assessment-question-choices-delete-tbl.php',
                    data: {
                        question_id: id
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

    $(".assessment-question-section .checkbox-delete").on("click", function () {
        var checkedChbx = $('.assessment-question-section .checkbox-delete:checked');

        if (checkedChbx.length > 0) {
            $('.delete-link').show(200);
        }
        else {
            $('.delete-link').hide(100);
        }
    });

    $(".assessment-question-section .checkbox-all").click(function () {
        var checkall = $(this).is(":checked")
        var checkedChbx = $('input:checkbox').not(this).prop('checked', this.checked);
        if (checkedChbx.length > 0 && checkall == true) {
            $('.assessment-question-section .delete-link').show(200);
        }
        else {
            $('.assessment-question-section .delete-link').hide(100);
        }
    });

    $(".assessment-question-section .delete-link").on("click", function () {
        var id = [];

        $("table > tbody > tr.table-assessment-question-data").each(function () {
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
                        url: 'query/assessment-choices/assessment-question-choices-delete-tbl.php',
                        data: {
                            question_id: id
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


/* REFRESHER */

$('#add-assessment-choice-modal').on('hidden.bs.modal', function () {
    window.location.reload();
});

$('#update-assessment-choice-modal').on('hidden.bs.modal', function () {
    window.location.reload();
});

/* KEYUP EVENT */


$(".form-add-assessment input").keyup(function () {
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

$(".form-add-assessment textarea").keyup(function () {
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

$(".form-add-assessment #assessment-add-estimate-time").keyup(function () {
    var input = $(this).val().trim();
    if (input != '') {
        if (!validAssessmentTime($("#assessment-add-estimate-time"))) {
            $('.form-add-assessment .feedback-time').html('<i class="fa-solid fa-triangle-exclamation"></i> Only numbers are allowed.');
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');

        }
    }

})

$(".form-add-assessment #assessment-add-rate").keyup(function () {
    var input = $(this).val().trim();
    if (input != '') {
        if (!validRate($("#assessment-add-rate"))) {
            $('.form-add-assessment .feedback-rate').html('<i class="fa-solid fa-triangle-exclamation"></i> Only numbers are allowed.');
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else if (!validRateLimit($('#assessment-add-rate'))) {
            $('.form-add-assessment .feedback-rate').html('<i class="fa-solid fa-triangle-exclamation"></i> Only rates 1-100 is allowed.');
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');

        }
    }

})

$('.form-add-assessment #assessment-add-difficulty').on('change', function () {
    if ($('.form-add-assessment #assessment-add-difficulty').val().length != "") {
        $('.form-add-assessment #assessment-add-difficulty').addClass('is-valid');
        $('.form-add-assessment #assessment-add-difficulty').removeClass('is-invalid');

    }
});

$('.form-add-assessment #assessment-add-deadline').on('change', function () {
    if ($('.form-add-assessment #assessment-add-deadline').val().length != "") {
        $('.form-add-assessment #assessment-add-deadline').addClass('is-valid');
        $('.form-add-assessment #assessment-add-deadline').removeClass('is-invalid');

    }
});


$("#assessment-add-pic").change(function () {

    var validExtensions = ["jpg", "jpeg", "png"]
    var file = $(this).val().split('.').pop();
    if (validExtensions.indexOf(file) == -1) {
        $(this).addClass('is-invalid')
        $('.form-add-assessment .feedback-photo').html('<i class="fa-solid fa-triangle-exclamation"></i> Only extension of jpg, jpeg and png are allowed.');
    } else {
        $(this).removeClass('is-invalid')
        $(this).addClass('is-valid')

    }

});



$(".form-update-assessment input").keyup(function () {
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

$(".form-update-assessment textarea").keyup(function () {
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

$(".form-update-assessment #assessment-update-estimate-time").keyup(function () {
    var input = $(this).val().trim();
    if (input != '') {
        if (!validAssessmentTime($("#assessment-update-estimate-time"))) {

            $('.form-update-assessment .feedback-time').html('<i class="fa-solid fa-triangle-exclamation"></i> Only numbers are allowed.');
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');

        }
    }

})

$(".form-update-assessment #assessment-update-rate").keyup(function () {
    var input = $(this).val().trim();
    if (input != '') {
        if (!validRate($("#assessment-update-rate"))) {
            $('.form-update-assessment .feedback-rate').html('<i class="fa-solid fa-triangle-exclamation"></i> Only numbers are allowed.');
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else if (!validRateLimit($("#assessment-update-rate"))) {
            $('.form-update-assessment .feedback-rate').html('<i class="fa-solid fa-triangle-exclamation"></i> Only rates 1-100 is allowed.');
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');

        }
    }

})

$('.form-update-assessment #assessment-update-difficulty').on('change', function () {
    if ($('.form-update-assessment #assessment-update-difficulty').val().length != "") {
        $('.form-update-assessment #assessment-update-difficulty').addClass('is-valid');
        $('.form-update-assessment #assessment-update-difficulty').removeClass('is-invalid');

    }
});

$('.form-update-assessment #assessment-update-deadline').on('change', function () {
    if ($('.form-update-assessment #assessment-update-deadline').val().length != "") {
        $('.form-update-assessment #assessment-update-deadline').addClass('is-valid');
        $('.form-update-assessment #assessment-update-deadline').removeClass('is-invalid');

    }
});


$("#assessment-update-pic").change(function () {

    var validExtensions = ["jpg", "jpeg", "png"]
    var file = $(this).val().split('.').pop();
    if (validExtensions.indexOf(file) == -1) {
        $(this).addClass('is-invalid')
        $('.form-update-assessment .feedback-photo').html('<i class="fa-solid fa-triangle-exclamation"></i> Only extension of jpg, jpeg and png are allowed.');
    } else {
        $(this).removeClass('is-invalid')
        $(this).addClass('is-valid')

    }

});

$('body').on('keyup', '.form-add-assessment-choice input', function () {
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

$('body').on('keyup', '.form-add-assessment-choice textarea', function () {
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



$('.form-add-assessment-choice #assessment-choice-add-title').on('change', function () {
    if ($('.form-add-assessment-choice #assessment-choice-add-title').val().length != "") {
        $('.form-add-assessment-choice #assessment-choice-add-title').addClass('is-valid');
        $('.form-add-assessment-choice #assessment-choice-add-title').removeClass('is-invalid');

    }
});

$('.form-add-assessment-choice #assessment-choice-add-type-question').on('change', function () {
    if ($('.form-add-assessment-choice #assessment-choice-add-type-question').val().length != "") {
        $('.form-add-assessment-choice #assessment-choice-add-type-question').addClass('is-valid');
        $('.form-add-assessment-choice #assessment-choice-add-type-question').removeClass('is-invalid');

    }
});


$('body').on('change', '.form-add-assessment-choice .assessment-choice-add-type-question', function () {

    if ($(this).val() === 'Multiple Choice Question') {
        $(this).closest('.question-type-choices').find('.mcq-class').show();
        $(this).closest('.question-type-choices').find('.mcq-item').val("");
        $(this).closest('.duplicate-container').find('.text-answer-key').hide().find('*').hide();
        $(this).closest('.duplicate-container').find('.text-answer-key .clone-input').remove();
        $(this).closest('.duplicate-container').find('.text-answer-key .text-answer').val("")
        $(this).closest('.duplicate-container').find('.text-answer-key .text-answer').removeClass('is-valid')

    } else if ($(this).val() === 'True/False') {
        $(this).closest('.question-type-choices').find('.mcq-class').hide();
        $(this).closest('.question-type-choices').find('.mcq-item').removeClass('is-invalid');
        $(this).closest('.question-type-choices').find('.mcq-item').removeClass('is-valid');
        $(this).closest('.question-type-choices').find('.mcq-item').val("N/A");
        $(this).closest('.duplicate-container').find('.text-answer-key').hide().find('*').hide();
        $(this).closest('.duplicate-container').find('.text-answer-key .clone-input').remove();
        $(this).closest('.duplicate-container').find('.text-answer-key .text-answer').val("")
        $(this).closest('.duplicate-container').find('.text-answer-key .text-answer').removeClass('is-valid')

    } else {
        $(this).closest('.question-type-choices').find('.mcq-class').hide();
        $(this).closest('.question-type-choices').find('.mcq-item').removeClass('is-invalid');
        $(this).closest('.question-type-choices').find('.mcq-item').removeClass('is-valid');
        $(this).closest('.question-type-choices').find('.mcq-item').val("N/A");

    }
});





$(".form-update-assessment-choice input").keyup(function () {
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

$(".form-update-assessment-choice textarea").keyup(function () {
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

$('.form-update-assessment-choice #assessment-choice-update-title').on('change', function () {
    if ($('.form-update-assessment-choice #assessment-choice-update-title').val().length != "") {
        $('.form-update-assessment-choice #assessment-choice-update-title').addClass('is-valid');
        $('.form-update-assessment-choice #assessment-choice-update-title').removeClass('is-invalid');

    }
});

$('.form-update-assessment-choice #assessment-choice-update-type-question').on('change', function () {
    if ($(this).val() === 'Multiple Choice Question') {
        $('.mcq').show();
        $('.mcq-class-update').show()
    } else {
        $('.mcq').hide();
        $(".mcq-item").val("");
        $('.mcq-item').removeClass('is-invalid')
        $('.mcq-class-update').hide()
    }
});





/* TESTING PAGE */
$(document).ready(function () {

    $('.answer-key').hide()
    $('.modal-done').hide()
    $('.modal-done-update').hide()

    $('.mcq-answer-class').hide()
    $('.text-answer-key').hide()
    $('.tf-text-answer-key').hide()

    $('.mcq-answer-class-update').hide()
    $('.btn-answer-key').addClass('no-answer')




})

$("body").on('keyup', '.choice-1', function () {
    $(".choice-1").removeClass('is-invalid')
    $(this).closest('.duplicate-container').find(".choice-1").val($(this).val())
});
$("body").on('keyup', '.choice-2', function () {
    $(".choice-2").removeClass('is-invalid')

    $(this).closest('.duplicate-container').find(".choice-2").val($(this).val())
});
$("body").on('keyup', '.choice-3', function () {
    $(".choice-3").removeClass('is-invalid')

    $(this).closest('.duplicate-container').find(".choice-3").val($(this).val())
});
$("body").on('keyup', '.choice-4', function () {
    $(".choice-4").removeClass('is-invalid')

    $(this).closest('.duplicate-container').find(".choice-4").val($(this).val())
});


$('body').on('click', '.btn-answer-key', function () {
    $('.submit-container').hide()
    $(this).closest('.duplicate-container').find('.form-action').hide()

    if ($(this).closest('.duplicate-container').find('.assessment-choice-add-type-question').val() === 'Multiple Choice Question') {
        $(this).closest('.duplicate-container').find('.question-type').hide()
        $(this).closest('.duplicate-container').find('.list-question').show()
        $(this).closest('.duplicate-container').find('.mcq-class').hide()
        $(this).closest('.duplicate-container').find('.submit-container').hide()
        //$('.appended').hide()
        $(this).closest('.duplicate-container').find('.btn-answer-key').hide()
        $(this).closest('.duplicate-container').find('.modal-done').show()
        $(this).closest('.duplicate-container').find('.mcq-answer-class').show();
        $(this).closest('.duplicate-container').find('.text-answer-key').hide()
        $(this).closest('.duplicate-container').find('.mcq-point').attr('name', 'assessment-choice-add-point');


    } else if ($(this).closest('.duplicate-container').find('.assessment-choice-add-type-question').val() === 'True/False') {
        $(this).closest('.duplicate-container').find('.question-type').hide()

        $(this).closest('.duplicate-container').find('.tf-text-answer-key').show();
        $(this).closest('.duplicate-container').find('.modal-done').show()
        $(this).closest('.duplicate-container').find('.btn-answer-key').hide()
        $(this).closest('.duplicate-container').find('.tf-text-answer-key').show()
        $(this).closest('.duplicate-container').find('.tf-text-point').attr('name', 'assessment-choice-add-point');
        $(this).closest('.duplicate-container').find('.tf-text-answer').attr('name', 'assessment-choice-add-answer');
    } else {
        // $(this).closest('.duplicate-container').find('.mcq-answer-class').hide();
        $(this).closest('.duplicate-container').find('.question-type').hide()

        $(this).closest('.duplicate-container').find('.text-answer-key').show();
        $(this).closest('.duplicate-container').find('.modal-done').show()
        $(this).closest('.duplicate-container').find('.btn-answer-key').hide()
        $(this).closest('.duplicate-container').find('.text-answer-key').show()
        $(this).closest('.duplicate-container').find('.text-point').attr('name', 'assessment-choice-add-point');
        // $(this).closest('.duplicate-container').find('.text-answer').attr('name', 'assessment-choice-add-answer');

        //  $(this).closest('.duplicate-container').find('.text-answer-key').html('<label class="col-2 col-form-label">Correct Answer</label> <div class="col-10"> <div class="input-group has-validation"> <input class="form-control" name="assessment-choice-add-answer" id="assessment-choice-add-answer" value=""></textarea> <div class="invalid-feedback feedback-answer"> </div> </div> </div>')
        $(this).closest('.duplicate-container').find('.text-answer-key').show().find('*').not('.invalid-feedback').show();

    }
});
/*
$('body').on('click', '.text-answer', function () {
    $(this).attr('name', 'assessment-choice-add-answer')
})
*/
$('body').on('keyup', '.text-answer', function () {
    if ($(this).val() === "") {
        $(this).removeAttr('name');
    } else {
        $(this).attr('name', 'assessment-choice-add-answer');
    }
});


$('body').on('click', '.btn-updateanswer-key', function () {
    $('.submit-container').hide()
    $('.form-action').hide()

    if ($('#assessment-choice-update-type-question').val() === 'Multiple Choice Question') {
        $('.question-type').hide()
        $('.list-question').show()
        $('.mcq-class-update').hide()
        $('.submit-container').hide()
        //$('.appended').hide()
        $('.btn-answer-key-update').hide()
        $('.modal-done-update').show()
        $('.mcq-answer-class-update').show();
        $('.text-answer-key').hide()
        $('.text-answer-update').val('N/A')

        $('.mcq-point').attr('name', 'assessment-choice-add-point');


    } else if ($('#assessment-choice-update-type-question').val() === 'True/False') {
        $('.mcq-class-update').hide()

        $('.question-type').hide()
        $('.modal-done-update').show()
        $('.btn-answer-key').hide()
        $('.tf-text-answer-key').show()
        $('.point-container').show()

        $('.tf-text-point-update').attr('name', 'assessment-choice-add-point');
        $('.tf-text-answer-update').attr('name', 'assessment-choice-add-answer');

    }
    else {
        // $('.mcq-answer-class').hide();
        $('.mcq-class-update').hide()

        $('.question-type').hide()
        $('.modal-done-update').show()
        $('.btn-answer-key').hide()
        $('.text-answer-key').show()
        $('.point-container').show()

        $('.text-point-update').attr('name', 'assessment-choice-add-point');
        $('.text-answer-update').attr('name', 'assessment-choice-add-answer');

        //  $('.text-answer-key').html('<label class="col-2 col-form-label">Correct Answer</label> <div class="col-10"> <div class="input-group has-validation"> <input class="form-control" name="assessment-choice-add-answer" id="assessment-choice-add-answer" value=""></textarea> <div class="invalid-feedback feedback-answer"> </div> </div> </div>')


    }
});


$(document).on('click', '.modal-done-update', function () {
    $('.remove').show()
    $('.form-action').show()

    $('.question-type').show()
    $('.list-question').show()
    $('.submit-container').show()
    $('.modal-done-update').hide()
    $('.btn-answer-key').show()
    $('.mcq-answer-class-update').hide()
    $('.text-answer-key').hide()

    if ($('#assessment-choice-update-type-question').val() === 'Multiple Choice Question') {

        $('.mcq-class-update').show()
        //$('.appended').hide()
        $('.text-answer-key').hide()


    } else {
        $('.mcq-class-update').hide()

        $('.mcq-answer-class-update').hide();
        $('.tf-text-answer-key').hide()

    }
});


$(document).on('click', '.mcq-item-answer-update', function () {
    $(this).attr('name', 'assessment-choice-add-answer');
    $('.mcq-item-answer-update').removeClass("is-valid");
    $(this).addClass('is-valid')


});


$("body").on('keyup', '.choice-1-update', function () {
    $(".choice-1-update").removeClass('is-invalid')
    $(".choice-1-update").val($(this).val())
});
$("body").on('keyup', '.choice-2-update', function () {
    $(".choice-2-update").removeClass('is-invalid')

    $(".choice-2-update").val($(this).val())
});
$("body").on('keyup', '.choice-3-update', function () {
    $(".choice-3-update").removeClass('is-invalid')

    $(".choice-3-update").val($(this).val())
});
$("body").on('keyup', '.choice-4-update', function () {
    $(".choice-4-update").removeClass('is-invalid')

    $(".choice-4-update").val($(this).val())
});






$(document).on('click', '.modal-done', function () {
    $('.remove').show()
    $(this).closest('.duplicate-container').find('.form-action').show()

    $(this).closest('.duplicate-container').find('.question-type').show()
    $(this).closest('.duplicate-container').find('.list-question').show()
    $('.submit-container').show()
    $(this).closest('.duplicate-container').find('.modal-done').hide()
    $(this).closest('.duplicate-container').find('.btn-answer-key').show()
    $(this).closest('.duplicate-container').find('.mcq-answer-class').hide()
    $(this).closest('.duplicate-container').find('.text-answer-key').hide()

    if ($(this).closest('.duplicate-container').find('.assessment-choice-add-type-question').val() === 'Multiple Choice Question') {

        $(this).closest('.duplicate-container').find('.mcq-class').show()
        //$('.appended').hide()
        $(this).closest('.duplicate-container').find('.text-answer-key').hide()

        if ($(this).closest('.duplicate-container').find('.mcq-answer-class .mcq-item-answer[name]').length == 0) {
            $(this).closest('.duplicate-container').find('.btn-answer-key').css('color', 'red');
        } else {
            $(this).closest('.duplicate-container').find('.btn-answer-key').css('color', 'green');
            $(this).closest('.duplicate-container').find('.btn-answer-key').removeClass('no-answer')

        }


    } else if ($(this).closest('.duplicate-container').find('.assessment-choice-add-type-question').val() === 'Identification Question') {

        var allInputsValid = true;
        $(this).closest('.duplicate-container').find('.text-answer-key .text-choice-option .text-answer').each(function () {
            if ($(this).val() === "") {
                allInputsValid = false;
            }
        });

        if (allInputsValid) {
            $(this).closest('.duplicate-container').find('.btn-answer-key').css('color', 'green');
            $(this).closest('.duplicate-container').find('.btn-answer-key').removeClass('no-answer');
        } else {
            $(this).closest('.duplicate-container').find('.btn-answer-key').css('color', 'red');
            $(this).closest('.duplicate-container').find('.btn-answer-key').addClass('no-answer')

        }
    } else if ($(this).closest('.duplicate-container').find('.assessment-choice-add-type-question').val() === 'True/False') {
        $(this).closest('.duplicate-container').find('.tf-text-answer-key').hide();


        if ($(this).closest('.duplicate-container').find('.tf-text-answer-key .tf-text-answer').val() == null) {
            $(this).closest('.duplicate-container').find('.btn-answer-key').css('color', 'red');

        } else {
            $(this).closest('.duplicate-container').find('.btn-answer-key').css('color', 'green');
            $(this).closest('.duplicate-container').find('.btn-answer-key').removeClass('no-answer')


        }
    }

    else {
        $(this).closest('.duplicate-container').find('.mcq-answer-class').hide();
    }
});

/*$(document).on('click', '.mcq-item-answer', function () {
    $(this).attr('name', 'assessment-choice-add-answer');
    $('.mcq-item-answer').removeClass("is-valid");
    $(this).addClass('is-valid')

}); */
$(document).on('click', '.mcq-item-answer', function () {
    $(this).closest('.mcq-answer-class').find('.mcq-item-answer').removeAttr('name');

    // Add the name attribute to the clicked input element
    $(this).attr('name', 'assessment-choice-add-answer');

    // Remove the is-valid class from all input elements
    $(this).closest('.mcq-answer-class').find('.mcq-item-answer').removeClass('is-valid');

    // Add the is-valid class to the clicked input element
    $(this).addClass('is-valid');


});

















