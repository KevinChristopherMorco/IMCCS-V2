<script>
    function check() {
        document.getElementById("assessment-choice-id").value = document.getElementById("assessment-choice-add-title").value;
    }
</script>

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="update-assessment-choice-modal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg ">
            <div class="modal-header modal-lg ">
                <h3 class="modal-title">Update Assessment Choices</h3>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="form-update-assessment-choice" id="form-update-assessment-choice" name="form-update-assessment-choice" enctype="multipart/form-data" method="post" novalidate>
                    <input type="hidden" name="assessment_id" id="assessment-choice-update-id" />
                    <input type="hidden" name="question_id" id="assessment-choice-question-id" />
                    <div class="question-add-container row">
                        <div class="question col-12">
                            <div class="lol col-12 mb-4">
                                <div class="duplicate-container mt-4" style="border:2px solid #EAE6E2;position:relative; padding:4rem">
                                    <div class="list-question">
                                        <div class="row mb-3"> <label class="col-2 col-form-label">Title of Assessment</label>

                                            <div class="col-10">
                                                <div class="input-group has-validation">
                                                    <?php
                                                    $selQuestion = "SELECT * FROM assessment_tbl";
                                                    $selQuestionRow = mysqli_query($mysqli, $selQuestion);
                                                    ?>
                                                    <select class="form-select" name="assessment-choice-update-title" id="assessment-choice-update-title">
                                                        <option value="" disabled selected>Please select an assessment</option>

                                                        <?php while ($row = mysqli_fetch_assoc($selQuestionRow)) {
                                                        ?>
                                                            <option value="<?php echo  $row['assessment_id'] . '|' . $row['title']; ?>"><?php echo $row['title'] ?></option>

                                                        <?php } ?>

                                                    </select>
                                                    <div class="invalid-feedback feedback-title">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3"> <label class="col-2 col-form-label">Assessment Question</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation"> <textarea class="form-control" name="assessment-choice-update-question" id="assessment-choice-update-question" value=""></textarea>

                                                    <div class="invalid-feedback feedback-question"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="question-type-choices">
                                        <div class="question-type row mb-3"> <label class="col-2 col-form-label">Question Type</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation"> <select class="form-control form-select" name="assessment-choice-update-type-question" id="assessment-choice-update-type-question" required>
                                                        <option value="" disabled selected>Please Select Question Type</option>
                                                        <option value="Multiple Choice Question" selected>Multiple Choice Question</option>
                                                        <option value="Identification Question">Identification Question</option>
                                                        <option value="True/False">True/False Question</option>
                                                    </select>
                                                    <div class="invalid-feedback feedback-type-question"> </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mcq-class-update">
                                            <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 1</label>
                                                <div class="col-10">
                                                    <div class="input-group has-validation"> <input type="text" class="form-control mcq-item choice-1-update" name="assessment-choice-update-ch1" id="assessment-choice-update-ch1" value="">
                                                        <div class="invalid-feedback feedback-ch1"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 2</label>
                                                <div class="col-10">
                                                    <div class="input-group has-validation"> <input type="text" class="form-control mcq-item choice-2-update" name="assessment-choice-update-ch2" id="assessment-choice-update-ch2" value=""></textarea>
                                                        <div class="invalid-feedback feedback-ch2"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 3</label>
                                                <div class="col-10">
                                                    <div class="input-group has-validation"> <input type="text" class="form-control mcq-item choice-3-update" name="assessment-choice-update-ch3" id="assessment-choice-update-ch3" value="">
                                                        <div class="invalid-feedback feedback-ch3"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3 mcq"> <label class="col-2 col-form-label">Choice 4</label>
                                                <div class="col-10">
                                                    <div class="input-group has-validation"> <input class="form-control mcq-item choice-4-update" name="assessment-choice-update-ch4" id="assessment-choice-update-ch4" value=""></textarea>
                                                        <div class="invalid-feedback feedback-ch4"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mcq-answer-class-update">

                                        <div class="row mb-3 mcq">
                                            <label class="col-2 col-form-label">Choice 1</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control mcq-item-answer-update choice-1-update" value="" readonly>
                                                    <div class="invalid-feedback feedback-ch1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3 mcq">
                                            <label class="col-2 col-form-label">Choice 2</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control mcq-item-answer-update choice-2-update" value="" readonly>
                                                    <div class="invalid-feedback feedback-ch2">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3 mcq">
                                            <label class="col-2 col-form-label">Choice 3</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control mcq-item-answer-update choice-3-update" value="" readonly>
                                                    <div class="invalid-feedback feedback-ch3">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3 mcq">
                                            <label class="col-2 col-form-label">Choice 4</label>
                                            <div class="col-10">
                                                <div class="input-group has-validation">
                                                    <input class="form-control mcq-item-answer-update choice-4-update" value="" readonly>
                                                    <div class="invalid-feedback feedback-ch4">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label class="col-9 col-form-label" style="display: flex; justify-content: flex-end">Points</label>
                                            <div class="col-3 mb-4">
                                                <div class="input-group has-validation">
                                                    <input type="number" class="form-control mcq-point" id="mcq-point" value="1" min="1">
                                                    <div class="invalid-feedback feedback-points">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-answer-key">
                                        <div class="row mb-3 mcq point-container">
                                            <label class="col-3 col-form-label">Correct Answer</label>
                                            <div class="col-5" id="answer-container">
                                                <div class="input-group has-validation"> <input type="text" class="form-control text-answer-update" id="assessment-choice-update-answer" value="">
                                                    <div class="invalid-feedback feedback-answer"> </div>
                                                </div>
                                            </div>

                                            <label class="col-1 col-form-label">Points</label>
                                            <div class="col-3 mb-4">
                                                <div class="input-group has-validation"> <input type="number" class="form-control text-point-update" id="text-point-update" value="1" min="1">
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
                                                    <select class="form-select tf-text-answer-update">
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
                                                    <input type="number" class="form-control tf-text-point-update" value="1" min="1">
                                                    <div class="invalid-feedback feedback-points"> </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-action">
                                        <a href="javascript:void(0)" class="btn-updateanswer-key"> <i class="fa-solid fa-clipboard"></i> Answer Key </a>
                                    </div>
                                    <div class="col-12" style="display: flex; justify-content: flex-end"> <button class="btn modal-done-update" type="button">Done</button>
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