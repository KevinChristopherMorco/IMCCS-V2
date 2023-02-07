<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="add-lesson-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">Add Topic </h3>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="form-add-lesson" id="form-add-lesson" name="form-add-lesson" enctype="multipart/form-data" method="post" novalidate>
                    <div class="container">
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Title</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="lesson-add-title" id="lesson-add-title" placeholder="Enter Topic Title" value="" required>
                                    <div class="invalid-feedback feedback-title">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <textarea class="form-control" name="lesson-add-description" id="lesson-add-description" placeholder="Enter Topic Description" value="" required></textarea>
                                    <div class="invalid-feedback feedback-description">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Difficulty</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <select class="form-control form-select" name="lesson-add-difficulty" id="lesson-add-difficulty" required>
                                        <option value="" disabled selected>Please Select Difficulty</option>
                                        <option value="Beginner">Beginner</option>
                                        <option value="Intermediate">Intermediate</option>
                                        <option value="Expert">Expert</option>
                                    </select>
                                    <div class="invalid-feedback feedback-difficulty">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Estimated Completion Time</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input class="form-control test" name="lesson-add-estimate-time" aria-describedby="basic-addon2" id="lesson-add-estimate-time" placeholder="Enter Estimated Time" required>
                                    <select class="input-group-text" name="lesson-add-unit-time" id="lesson-add-unit-time">
                                        <option value="Minutes">Minutes</option>
                                        <option value="Hours">Hours</option>
                                        <option value="Days">Days</option>
                                        <option value="Weeks">Weeks</option>
                                        <option value="Months">Months</option>

                                    </select>
                                    <div class="invalid-feedback feedback-time">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Lesson Summary</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <textarea class="form-control" name="lesson-add-paragraph" id="lesson-add-paragraph" placeholder="Enter Brief Summary" value="" required></textarea>
                                    <div class="invalid-feedback feedback-summary">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Attach Cover Photo</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="file" class="form-control" name="img" id="lesson-add-pic">
                                    <div class="invalid-feedback feedback-photo">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Set Status</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <label class="switch">
                                        <input class="slider add-status" name="status" type="checkbox" id="institution-add-inactive" value="Inactive" autocomplete="off">
                                        <div class="slider round"></div>
                                        <input class="slider add-status" data-on name="status" type="checkbox" id="add-status" value="Active" autocomplete="off" aria-invalid="false" checked>
                                    </label>
                                    <div class="invalid-feedback feedback-status">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn modal-cancel" type="button" data-bs-dismiss="modal">Close</button>
                <input type="submit" id="save-lesson" name="save-lesson" value="Save" class="btn modal-edit">

            </div>
            </form>
        </div>
    </div>
</div>
<script>
    /* // THIS CONSTANT REPRESENTS THE <select> ELEMENT
    const theSelect = document.getElementById('basic-addon2')

    // THIS LINE BINDS THE input EVENT TO THE ABOVE select ELEMENT
    // IT WILL BE EXECUTED EVERYTIME THE USER SELECTS AN OPTION
    theSelect.addEventListener('input', function() {


        sel1 = document.getElementById("basic-addon2");
        var selected = sel1.options[sel1.selectedIndex].value;
        input = document.getElementById("lesson-add-estimate-time");
        input.value = input.value +" "+ selected;

    })*/
</script>