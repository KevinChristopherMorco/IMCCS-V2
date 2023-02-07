<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="add-question-choice" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">Add Question Choices</h3>
            </div>
            <div class="modal-body">
                <form id="assessment-question-choice-add" name="assessment-question-choice-add" method="post">

                    <div class="container">
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Title</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="assessment-add-title" id="assessment-add-title" placeholder="Enter Question Title" value="">
                                    <div class="invalid-feedback feedback-title">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row datatable">
                        <div class="col-12">
                            <?php
                            $selQuestion = "SELECT *
                            FROM assessment_tbl";
                            $selQuestionRow = mysqli_query($mysqli, $selQuestion);
                            ?>

                            <label for="name">Title of Assessment</label>
                            <select class="form-select" aria-label="Default select example" name="assessment-question-choice-add-title" id="assessment-question-choice-add-title">
                                <?php while ($row = mysqli_fetch_assoc($selQuestionRow)) {
                                ?>
                                    <option value="<?php echo  $row['assessment_id'] . '|' . $row['title']; ?>"><?php echo $row['title'] ?></option> <?php } ?>

                            </select>

                        </div>
                        <div class="col-12">
                            <label for="name">Assessment Question</label>
                            <textarea class="form-control" name="assessment-question-choice-add-question" id="assessment-question-choice-add-question" value=""></textarea>
                        </div>
                        <div class="col-12">
                            <label for="name">Choice 1</label>
                            <input type="text" class="form-control" name="assessment-question-choice-add-ch1" id="assessment-question-choice-add-ch1" value="">
                        </div>
                        <div class="col-12">
                            <label for="name">Choice 2</label>
                            <input class="form-control" name="assessment-question-choice-add-ch2" id="assessment-question-choice-add-ch2" value=""></textarea>
                        </div>
                        <div class="col-12">
                            <label for="name">Choice 3</label>
                            <input type="text" class="form-control" name="assessment-question-choice-add-ch3" id="assessment-question-choice-add-ch3" value="">
                        </div>
                        <div class="col-12">
                            <label for="name">Choice 4</label>
                            <input class="form-control" name="assessment-question-choice-add-ch4" id="assessment-question-choice-add-ch4" value=""></textarea>
                        </div>
                        <div class="col-12">
                            <label for="name">Correct Answer</label>
                            <input class="form-control" name="assessment-question-choice-add-answer" id="assessment-question-choice-add-answer" value=""></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn modal-cancel" type="button" data-bs-dismiss="modal">Close</button>
                <input type="submit" id="save-assessment-question" name="save-assessment-question" value="Save" class="btn modal-edit">

            </div>
            </form>

        </div>
    </div>
</div>