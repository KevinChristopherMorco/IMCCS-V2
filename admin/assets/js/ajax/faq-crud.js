$(document).ready(function () {

    jQuery(".add-faq").click(function (event) {
        $('#add-faq-modal').modal('show');

        $("#form-add-faq").submit(function () {

            $(this).removeClass('was-validated')

            $(".form-add-faq input").each(function (e) {

                var checkEmptyInput = $(this);
                if (checkEmptyInput.val() == "") {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });

            $(".form-add-faq textarea").each(function (e) {

                var checkEmptyInput = $(this);
                if (checkEmptyInput.val() == "") {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });

            if ($(".form-add-faq input").hasClass('is-invalid') || $(".form-add-faq textarea").hasClass('is-invalid')) {
                event.preventDefault();
                invalidInput()
            } else {

                var overview = $("#faq-add-overview").val();
                var description = $("#faq-add-description").val();

                $.ajax({
                    type: "POST",
                    url: 'query/faq/faq-add-tbl.php',
                    data: {
                        title: overview,
                        description: description
                    },
                    cache: false,
                    success: function (data) {
                        Toast.fire({
                            icon: 'success',
                            title: 'FAQ added !<br>Users can now see this on the landing page.</br>',

                        }).then(function () {
                            window.location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr);
                    }
                });
            }
        });
    });
})


$(document).ready(function () {

    $("body").on('click', '.edit-faq', function (event) {
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
                    url: 'query/faq/faq-getid-view.php',
                    data: {
                        id: id //fieldname in the database : data-id value
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#update-faq-modal').modal('show');
                        $('#faq-id').val(res.id); //ID IN INPUT BOX AND RES IS FIELD NAME IN DATABASE
                        var overview = $("#faq-update-overview").val(res.title);
                        var description = $("#faq-update-description").val(res.description);

                    }
                });
            }
        });
    });
});


$("#form-update-faq").submit(function (event) {

    $(this).removeClass('was-validated')

    $(".form-update-faq input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    $(".form-update-faq textarea").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    if ($(".form-update-faq input").hasClass('is-invalid') || $(".form-update-faq textarea").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {


    var id = $('#faq-id').val();;
    var overview = $("#faq-update-overview").val();
    var description = $("#faq-update-description").val();

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
                url: "query/faq/faq-update-tbl.php",
                data: {
                    id: id,
                    title: overview,
                    description: description


                }, // get all form field value in
                dataType: 'json',

                success: function (data) {

                    Toast.fire({
                        icon: 'success',
                        title: 'FAQ updated!<br> Changes were saved </br>',

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

    jQuery(".view-faq").click(function () {
        var id = $(this).data('id');

        $.ajax({
            type: 'POST',
            url: 'query/faq/faq-getid-view.php',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (res) {
                $('#view-faq-modal').modal('show');
                var overview = $("#faq-view-overview").val(res.title);
                var description = $("#faq-view-description").val(res.description);

            }
        });

    });
});



$(document).ready(function () {

    $("body").on('click', '.delete-faq', function (e) {
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
                    url: 'query/faq/faq-delete-tbl.php',
                    data: {
                        faq_id: id
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

    $(".faq-section .checkbox-delete").on("click", function () {
        var checkedChbx = $('.faq-section .checkbox-delete:checked');

        if (checkedChbx.length > 0) {
            $('.delete-link').show(200);
        }
        else {
            $('.delete-link').hide(100);
        }
    });

    $(".faq-section .checkbox-all").click(function () {
        var checkall = $(this).is(":checked")
        var checkedChbx = $('input:checkbox').not(this).prop('checked', this.checked);
        if (checkedChbx.length > 0 && checkall == true) {
            $('.faq-section .delete-link').show(200);
        }
        else {
            $('.faq-section .delete-link').hide(100);
        }
    });

    $(".faq-section .delete-link").on("click", function () {
        var id = [];

        $("table > tbody > tr.table-faq-data").each(function () {
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
                        url: 'query/faq/faq-delete-tbl.php',
                        data: {
                            faq_id: id
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

$(".form-add-faq input").keyup(function () {
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

$(".form-add-faq textarea").keyup(function () {
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

$(".form-update-faq input").keyup(function () {
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

$(".form-update-faq textarea").keyup(function () {
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
