<script>
    function check() {
        document.getElementById("assessment-choice-id").value = document.getElementById("assessment-choice-add-title").value;
    }
</script>

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="add-assessment-choice-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl ">
            <div class="modal-header modal-xl ">
                <h3 class="modal-title">Add Assessment Choices</h3>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="form-add-assessment-choice" id="form-add-assessment-choice" name="form-add-assessment-choice" enctype="multipart/form-data" method="post" novalidate>
                    <div class="question-add-container row">
                        <div class="question col-12">
                            <div class="lol col-12 mb-4">
                                <div class="duplicate-container mt-4" style="border:2px solid #EAE6E2;position:relative; padding:4rem">
                                    <div class="list-question">
                                        <div class="row mb-3" style="display: none;"> <label class="col-2 col-form-label">Title of Assessment</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation"> <input type="hidden" class="form-control" name="assessment-choice-add-title" class="assessment-choice-add-title" id="assessment-choice-add-title" disabled> <input type="hidden" class="form-control" name="assessment-choice-add-id" id="assessment-choice-add-id" disabled>
                                                    <div class="invalid-feedback feedback-title"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="question-number mb-4"> </h3>
                                        <div class="row mb-3"> <label class="col-2 col-form-label">Assessment Question</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation"> <textarea class="form-control assessment-question-container" name="assessment-choice-question" value=""></textarea>
                                                    <div class="invalid-feedback feedback-question"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question-type-choices">
                                        <div class="question-type row mb-3"> <label class="col-2 col-form-label">Question Type</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation"> <select class="form-control form-select assessment-choice-add-type-question" name="assessment-choice-add-type-question" id="assessment-choice-add-type-question" required>
                                                        <option value="" disabled selected>Please Select Question Type</option>
                                                        <option value="Multiple Choice Question" selected>Multiple Choice Question</option>
                                                        <option value="Identification Question">Identification Question</option>
                                                        <option value="True/False">True/False Question</option>
                                                    </select>
                                                    <div class="invalid-feedback feedback-type-question"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mcq-class">
                                            <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 1</label>
                                                <div class="col-10">
                                                    <div class="input-group has-validation"> <input type="text" class="form-control mcq-item choice-1" name="assessment-choice-add-ch1" id="assessment-choice-add-ch1" value="">
                                                        <div class="invalid-feedback feedback-ch1"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 2</label>
                                                <div class="col-10">
                                                    <div class="input-group has-validation"> <input type="text" class="form-control mcq-item choice-2" name="assessment-choice-add-ch2" id="assessment-choice-add-ch2" value=""></textarea>
                                                        <div class="invalid-feedback feedback-ch2"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 3</label>
                                                <div class="col-10">
                                                    <div class="input-group has-validation"> <input type="text" class="form-control mcq-item choice-3" name="assessment-choice-add-ch3" id="assessment-choice-add-ch3" value="">
                                                        <div class="invalid-feedback feedback-ch3"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 4</label>
                                                <div class="col-10">
                                                    <div class="input-group has-validation"> <input class="form-control mcq-item choice-4" name="assessment-choice-add-ch4" id="assessment-choice-add-ch4" value=""></textarea>
                                                        <div class="invalid-feedback feedback-ch4"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mcq-answer-class">
                                        <div class="row mb-3 mcq">
                                            <label class="col-2 col-form-label">Choice 1</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control mcq-item-answer choice-1" value="" readonly>
                                                    <div class="invalid-feedback feedback-ch1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3 mcq">
                                            <label class="col-2 col-form-label">Choice 2</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control mcq-item-answer choice-2" value="" readonly>
                                                    <div class="invalid-feedback feedback-ch2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3 mcq">
                                            <label class="col-2 col-form-label">Choice 3</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control mcq-item-answer choice-3" value="" readonly>
                                                    <div class="invalid-feedback feedback-ch3">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3 mcq">
                                            <label class="col-2 col-form-label">Choice 4</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation">
                                                    <input class="form-control mcq-item-answer choice-4" value="" readonly>
                                                    <div class="invalid-feedback feedback-ch4">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-9 col-form-label" style="display: flex; justify-content: flex-end">Points</label>
                                            <div class="col-3 mb-4">
                                                <div class="input-group has-validation">
                                                    <input type="number" class="form-control mcq-point" value="1" min="1">
                                                    <div class="invalid-feedback feedback-points">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-answer-key">
                                        <div class="row mb-3 mcq point-container">
                                            <label class="col-3 col-form-label">Correct Answer</label>
                                            <div class="col-5 text-choice-option">
                                                <div class="input-group has-validation"> <input type="text" class="form-control text-answer" placeholder="Enter Answer Option" value="">
                                                    <i class="fa-solid fa-circle-plus add-choice-option px-2 mt-2"></i>
                                                    <div class="invalid-feedback feedback-answer"> </div>
                                                </div>
                                            </div>
                                            <label class="col-1 col-form-label">Points</label>
                                            <div class="col-3 mb-4">
                                                <div class="input-group has-validation"> <input type="number" class="form-control text-point" value="1" min="1">
                                                    <div class="invalid-feedback feedback-points"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tf-text-answer-key">
                                        <div class="row mb-3 mcq point-container">
                                            <label class="col-3 col-form-label">Correct Answer</label>
                                            <div class="col-5 tf-text-choice-option">
                                                <div class="input-group has-validation">
                                                    <select class="form-select tf-text-answer">
                                                        <option value="" selected disabled>Select an Option</option>
                                                        <option value="True">True</option>
                                                        <option value="False">False</option>
                                                    </select>
                                                    <div class="invalid-feedback feedback-answer"> </div>
                                                </div>
                                            </div>
                                            <label class="col-1 col-form-label">Points</label>
                                            <div class="col-3 mb-4">
                                                <div class="input-group has-validation">
                                                    <input type="number" class="form-control tf-text-point" value="1" min="1">
                                                    <div class="invalid-feedback feedback-points"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-action">
                                        <a href="javascript:void(0)" class="btn-answer-key"> <i class="fa-regular fa-clipboard"></i> Answer Key </a>
                                    </div>
                                    <div class="col-12" style="display: flex; justify-content: flex-end"> <button class="btn modal-done" type="button">Done</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <div class="submit-container">
                    <button class="btn modal-cancel" type="button" data-bs-dismiss="modal">Close</button>
                    <input type="submit" id="save-assessment" name="save-assessment" value="Save" class="btn modal-edit">
                </div>
            </div>
            </form>
        </div>
    </div>
    <a href="javascript:void(0)" class="help-link">
        <i class="fa-solid fa-circle-plus help-icon"></i> </a>
</div>

<script>
    // THIS CONSTANT REPRESENTS THE <select> ELEMENT
    const theSelect = document.getElementById('basic-addon2')

    // THIS LINE BINDS THE input EVENT TO THE ABOVE select ELEMENT
    // IT WILL BE EXECUTED EVERYTIME THE USER SELECTS AN OPTION
    theSelect.addEventListener('input', function() {


        sel1 = document.getElementById("basic-addon2");
        var selected = sel1.options[sel1.selectedIndex].value;
        input = document.getElementById("assessment-add-estimate-time");
        input.value = input.value + " " + selected;

    })
</script>

<script>
    var count = 0
    $(".help-link").on('click', function(event) {
        count++;
        $('<div class="duplicate-container mt-4" style="border:2px solid #EAE6E2;position:relative; padding:4rem"> <div class="list-question"> <div class="row mb-3" style="display: none;"> <label class="col-2 col-form-label">Title of Assessment</label> <div class="col-10"> <div class="input-group has-validation"> <input type="hidden" class="form-control" name="assessment-choice-add-title" class="assessment-choice-add-title" id="assessment-choice-add-title" disabled> <input type="hidden" class="form-control" name="assessment-choice-add-id" id="assessment-choice-add-id" disabled> <div class="invalid-feedback feedback-title"> </div> </div> </div> </div> <h3 class="question-number mb-4"> </h3> <div class="row mb-3"> <label class="col-2 col-form-label">Assessment Question</label> <div class="col-10"> <div class="input-group has-validation"> <textarea class="form-control assessment-question-container" name="assessment-choice-question" value=""></textarea> <div class="invalid-feedback feedback-question"> </div> </div> </div> </div> </div> <div class="question-type-choices"> <div class="question-type row mb-3"> <label class="col-2 col-form-label">Question Type</label> <div class="col-10"> <div class="input-group has-validation"> <select class="form-control form-select assessment-choice-add-type-question" name="assessment-choice-add-type-question" id="assessment-choice-add-type-question" required> <option value="" disabled selected>Please Select Question Type</option> <option value="Multiple Choice Question" selected>Multiple Choice Question</option> <option value="Identification Question">Identification Question</option> <option value="True/False">True/False Question</option> </select> <div class="invalid-feedback feedback-type-question"> </div> </div> </div> </div> <div class="mcq-class"> <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 1</label> <div class="col-10"> <div class="input-group has-validation"> <input type="text" class="form-control mcq-item choice-1" name="assessment-choice-add-ch1" id="assessment-choice-add-ch1" value=""> <div class="invalid-feedback feedback-ch1"> </div> </div> </div> </div> <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 2</label> <div class="col-10"> <div class="input-group has-validation"> <input type="text" class="form-control mcq-item choice-2" name="assessment-choice-add-ch2" id="assessment-choice-add-ch2" value=""></textarea> <div class="invalid-feedback feedback-ch2"> </div> </div> </div> </div> <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 3</label> <div class="col-10"> <div class="input-group has-validation"> <input type="text" class="form-control mcq-item choice-3" name="assessment-choice-add-ch3" id="assessment-choice-add-ch3" value=""> <div class="invalid-feedback feedback-ch3"> </div> </div> </div> </div> <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 4</label> <div class="col-10"> <div class="input-group has-validation"> <input class="form-control mcq-item choice-4" name="assessment-choice-add-ch4" id="assessment-choice-add-ch4" value=""></textarea> <div class="invalid-feedback feedback-ch4"> </div> </div> </div> </div> </div> </div> <div class="mcq-answer-class"> <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 1</label> <div class="col-10"> <div class="input-group has-validation"> <input type="text" class="form-control mcq-item-answer choice-1" value="" readonly> <div class="invalid-feedback feedback-ch1"> </div> </div> </div> </div> <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 2</label> <div class="col-10"> <div class="input-group has-validation"> <input type="text" class="form-control mcq-item-answer choice-2" value="" readonly> <div class="invalid-feedback feedback-ch2"> </div> </div> </div> </div> <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 3</label> <div class="col-10"> <div class="input-group has-validation"> <input type="text" class="form-control mcq-item-answer choice-3" value="" readonly> <div class="invalid-feedback feedback-ch3"> </div> </div> </div> </div> <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 4</label> <div class="col-10"> <div class="input-group has-validation"> <input class="form-control mcq-item-answer choice-4" value="" readonly> <div class="invalid-feedback feedback-ch4"> </div> </div> </div> </div> <div class="row mb-3"> <label class="col-9 col-form-label" style="display: flex; justify-content: flex-end">Points</label> <div class="col-3 mb-4"> <div class="input-group has-validation"> <input type="number" class="form-control mcq-point" value="1" min="1"> <div class="invalid-feedback feedback-points"> </div> </div> </div> </div> </div> <div class="text-answer-key"> <div class="row mb-3 mcq point-container"> <label class="col-3 col-form-label">Correct Answer</label> <div class="col-5 text-choice-option"> <div class="input-group has-validation"> <input type="text" class="form-control text-answer" value=""> <i class="fa-solid fa-circle-plus add-choice-option px-2 mt-2"></i> <div class="invalid-feedback feedback-answer"> </div> </div> </div> <label class="col-1 col-form-label">Points</label> <div class="col-3 mb-4"> <div class="input-group has-validation"> <input type="number" class="form-control text-point" value="1" min="1"> <div class="invalid-feedback feedback-points"> </div> </div> </div> </div> </div> <div class="tf-text-answer-key"> <div class="row mb-3 mcq point-container"> <label class="col-3 col-form-label">Correct Answer</label> <div class="col-5 tf-text-choice-option"> <div class="input-group has-validation"> <select class="form-select tf-text-answer"> <option value="" selected disabled>Select an Option</option> <option value="True">True</option> <option value="False">False</option> </select> <div class="invalid-feedback feedback-answer"> </div> </div> </div> <label class="col-1 col-form-label">Points</label> <div class="col-3 mb-4"> <div class="input-group has-validation"> <input type="number" class="form-control tf-text-point" value="1" min="1"> <div class="invalid-feedback feedback-points"> </div> </div> </div> </div> </div> <div class="form-action"> <a href="javascript:void(0)" class="btn-answer-key no-answer"> <i class="fa-regular fa-clipboard"></i> Answer Key </a> <div class="remove" title="Delete"> <i class="fa-regular fa-trash-can"></i> </div> </div> <div class="col-12" style="display: flex; justify-content: flex-end"> <button class="btn modal-done" type="button">Done</button> </div> </div>').appendTo('.lol').hide().slideDown().ready(function() {
            $('.answer-key').hide()
            $('.modal-done').hide()
            $('.mcq-answer-class').hide()
            $('.text-answer-key').hide()
            $('.tf-text-answer-key').hide()


        });

        tinymce.init({
            selector: '.form-add-assessment-choice  textarea',
            setup: function(eds) {
                eds.on('keyup', function(e) {
                    var input = $('.form-add-assessment-choice  tox-edit-area__iframe');
                    if ($(eds.getBody()).text().length == 0) {
                        $('.form-add-assessment-choice  .tox-edit-area__iframe').addClass('is-invalid');
                        $('.form-add-assessment-choice  .tox-edit-area__iframe').removeClass('is-valid');

                    } else {
                        $('.form-add-assessment-choice  .tox-edit-area__iframe').addClass('is-valid');
                        $('.form-add-assessment-choice  .tox-edit-area__iframe').removeClass('is-invalid');
                        emptyField();

                    }
                    eds.on('change', function() {
                        tinymce.triggerSave();
                    });
                });
            }
        });

    })




    $('.question').on('click', '.remove', function() {
        count--;
        $(this).parent().parent().remove()
    });

    $(document).on('click', '.add-choice-option', function() {

        var newTextbox = $('<div class="input-group has-validation clone-input mt-4"> <input type="text" class="form-control text-answer"  placeholder="Enter Answer Option" value=""><i class="fa-solid fa-square-minus delete-choice-option mt-2 px-2"></i><div class="invalid-feedback feedback-answer"> </div> </div>');
        $(this).before(newTextbox).hide().slideDown().ready(function() {});
    });

    $(document).on('click', '.delete-choice-option', function() {
        $(this).closest('.input-group').remove()
    });
</script>