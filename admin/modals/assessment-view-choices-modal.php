<script>
    function check() {
        document.getElementById("assessment-choice-id").value = document.getElementById("assessment-choice-add-title").value;
    }
</script>

<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="view-assessment-choice-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">View Assessment Choices Details </h3>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Title of Assessment</th>
                            <td><input type="text" class="form-control" name="assessment-choice-view-title" id="assessment-choice-view-title"></td>

                        </tr>
                        <tr>
                            <th>Assessment Question</th>
                            <td><textarea class="form-control" name="assessment-choice-view-question" id="assessment-choice-view-question" value=""></textarea></td>
                        </tr>
                        <tr>
                            <th>Question Type</th>
                            <td><input type="text" class="form-control" name="assessment-choice-view-type-question" id="assessment-choice-view-type-question"></td>

                        </tr>
                        <tr class="mcq-view-item">
                            <th>Choice 1</th>
                            <td><input type="text" class="form-control mcq-item" name="assessment-choice-view-ch1" id="assessment-choice-view-ch1" value=""></td>

                        </tr>
                        <tr class="mcq-view-item">
                            <th>Choice 2</th>
                            <td><input type="text" class="form-control mcq-item" name="assessment-choice-view-ch2" id="assessment-choice-view-ch2" value=""></td>

                        </tr>
                        <tr class="mcq-view-item">
                            <th>Choice 3</th>
                            <td><input type="text" class="form-control mcq-item" name="assessment-choice-view-ch3" id="assessment-choice-view-ch3" value=""></td>

                        </tr>
                        <tr class="mcq-view-item">
                            <th>Choice 4</th>
                            <td><input type="text" class="form-control mcq-item" name="assessment-choice-view-ch4" id="assessment-choice-view-ch4" value=""></td>

                        </tr>
                        <tr>
                            <th>Correct Answer</th>
                            <td><input class="form-control" name="assessment-choice-view-answer" id="assessment-choice-view-answer" value=""></textarea></td>

                        </tr>
                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <button class="btn modal-cancel" type="button" data-bs-dismiss="modal">Close</button>
                <input type="submit" id="save-assessment" name="save-assessment" value="Save" class="btn modal-edit">
            </div>
        </div>
    </div>
</div>
