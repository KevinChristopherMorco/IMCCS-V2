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
    $('.form-add-institution .invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
}


$(document).ready(function () {

    jQuery(".view").click(function () {
        var id = $(this).data('id');



        $.ajax({
            type: 'POST',
            url: 'query/institution/institution-getid-view.php',
            data: {
                institution_id: id
            },
            dataType: 'json',
            success: function (res) {
                $('#view_modal').modal('show');
                $('#institution-view-name').val(res.name);
                $('#institution-view-street').val(res.street_name);
                $('#institution-view-barangay').val(res.barangay);
                $('#institution-view-municipality-city').val(res.municipality_city);
                $('#institution-view-province').val(res.province);
                $('#institution-view-status').val(res.status);
            }
        });

    });
});

$(document).ready(function () {

    jQuery(".add").click(function () {
        $('#add_institution_modal').modal('show');

        $("#form-add-institution").on("submit", function (event) {

            $(this).removeClass('was-validated')


            var name = $("#institution-add-name").val();
            var street = $("#institution-add-street").val();
            var barangay = $("#institution-add-barangay").val();
            var municipality_city = $("#institution-add-municipality-city").val();
            var province = $("#institution-add-province").val();
            var status = $(".add-status:checked").val();



            $(".form-add-institution input").each(function (e) {

                var checkEmptyInput = $(this);
                if (checkEmptyInput.val() == "") {
                    checkEmptyInput.addClass('is-invalid')
                    $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
                }
            });

            if ($(".form-add-institution input").hasClass('is-invalid')) {
                event.preventDefault();
                invalidInput()
            } else {


                $.ajax({
                    type: "POST",
                    url: 'query/institution/institution-create-tbl.php',
                    data: {
                        name: name,
                        street_name: street,
                        barangay: barangay,
                        municipality_city: municipality_city,
                        province: province,
                        status: status
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data == "Institution Added") {
                            Toast.fire({
                                icon: 'success',
                                title: 'Institution added !',

                            }).then(function () {
                                window.location.reload();
                            });
                        }
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

    $("body").on('click', '.edit', function (e) {
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
                    url: 'query/institution/institution-getid-view.php',
                    data: {
                        institution_id: id //fieldname in the database : data-id value
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#update_modal').modal('show');
                        $('#institution-id').val(res.institution_id); //ID IN INPUT BOX AND RES IS FIELD NAME IN DATABASE
                        $('#institution-update-name').val(res.name);
                        $('#institution-update-code').val(res.code);
                        $('#institution-update-street').val(res.street_name);
                        $('#institution-update-barangay').val(res.barangay);
                        $('#institution-update-municipality-city').val(res.municipality_city);
                        $('#institution-update-province').val(res.province);
                    }
                });
            }
        });
    });
});



$('#form-update-institution').submit(function (event) {
    $(this).removeClass('was-validated')

    $(".form-update-institution input").each(function (e) {

        var checkEmptyInput = $(this);
        if (checkEmptyInput.val() == "") {
            checkEmptyInput.addClass('is-invalid')
            $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
        }
    });

    if ($(".form-update-institution input").hasClass('is-invalid')) {
        event.preventDefault();
        invalidInput()
    } else {
        var id = $("#institution-id").val();
        var name = $("#institution-update-name").val();
        var code = $("#institution-update-code").val();
        var street = $("#institution-update-street").val();
        var barangay = $("#institution-update-barangay").val();
        var municipality_city = $("#institution-update-municipality-city").val();
        var province = $("#institution-update-province").val();
        var status = $(".update-status:checked").val();


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
                    url: "query/institution/institution-update-tbl.php",
                    data: {
                        institution_id: id,
                        name: name,
                        code: code,
                        street_name: street,
                        barangay: barangay,
                        municipality_city: municipality_city,
                        province: province,
                        status: status
                    }, // get all form field value in
                    dataType: 'json',

                    success: function (data) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Institution information updated!<br> Changes were saved </br>',

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

    $("body").on('click', '.delete', function (e) {

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
                    url: 'query/institution/institution-delete-tbl.php',
                    data: {
                        institution_id: id
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
    $(".delete-link").hide();

    $(".institution-section .checkbox-delete").on("click", function () {
        var checkedChbx = $('.institution-section .checkbox-delete:checked');

        if (checkedChbx.length > 0) {
            $('.delete-link').show(200);
        }
        else {
            $('.delete-link').hide(100);
        }
    });

    $(".institution-section .checkbox-all").click(function () {
        var checkall = $(this).is(":checked")
        var checkedChbx = $('input:checkbox').not(this).prop('checked', this.checked);
        if (checkedChbx.length > 0 && checkall == true) {
            $('.institution-section .delete-link').show(200);
        }
        else {
            $('.institution-section .delete-link').hide(100);
        }
    });


    $(".institution-section .delete-link").on("click", function () {
        var id = [];

        $("table > tbody > tr.table-institution-data").each(function () {
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
                        url: 'query/institution/institution-delete-tbl.php',
                        data: {
                            institution_id: id
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



$(".form-add-institution input").keyup(function () {
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

$(".form-update-institution input").keyup(function () {
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
