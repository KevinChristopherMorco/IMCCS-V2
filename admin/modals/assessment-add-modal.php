<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="add-assessment-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">Add Assessment </h3>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="form-add-assessment" id="form-add-assessment" name="form-add-assessment" enctype="multipart/form-data" method="post" novalidate>
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
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <textarea class="form-control" name="assessment-add-description" id="assessment-add-description" placeholder="Enter Question Description" value=""></textarea>
                                    <div class="invalid-feedback feedback-description">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Difficulty</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <select class="form-control form-select" name="assessment-add-difficulty" id="assessment-add-difficulty" required>
                                        <option value="" disabled selected>Please Select</option>
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
                            <label class="col-2 col-form-label">Assessment Time</label>
                            <div class="col-5">
                                <div class="input-group has-validation">
                                <input type="datetime-local" class="form-control" id="assessment-add-deadline" name="assessment-add-deadline">
                                    <div class="invalid-feedback feedback-deadline">
                                    </div>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="input-group has-validation">
                                    <input class="form-control test" name="assessment-add-estimate-time" aria-describedby="basic-addon2" id="assessment-add-estimate-time" placeholder="Suggested Time of Completion" required>
                                    <select class="input-group-text" name="assessment-add-unit-time" id="assessment-add-unit-time">
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
                            <label class="col-2 col-form-label">Passing Rate</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="assessment-add-rate" id="assessment-add-rate" placeholder="Enter passing rate" value="">
                                    <div class="invalid-feedback feedback-rate">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Attach Cover Photo</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="file" class="form-control" name="img" id="assessment-add-pic">
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
                                    <input class="slider add-status" name="status" type="checkbox" id="assessment-add-inactive" value="Inactive" autocomplete="off">
                                        <div class="slider round"></div>
                                        <input class="slider add-status" data-on name="status" type="checkbox" id="assessment-add-active" value="Active" autocomplete="off" aria-invalid="false" checked>
                                    </label>
                                    <div class="invalid-feedback feedback-status">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Retake</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <label class="switch">
                                    <input class="slider add-retake" name="retake" type="checkbox" id="assessment-add-retake-no" value="No" autocomplete="off" >

                                        <div class="retake slider round"></div>
                                        <input class="retake slider add-retake" data-on name="retake" type="checkbox" id="assessment-add-retake-yes" value="Yes" autocomplete="off" aria-invalid="false" checked>

                                    </label>
                                    <div class="invalid-feedback feedback-retake">
                                    </div>
                                </div>
                            </div>
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
