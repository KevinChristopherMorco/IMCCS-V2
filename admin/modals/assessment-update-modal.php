<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="update-assessment-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">Update Assessment</h3>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="form-update-assessment" id="form-update-assessment" name="form-update-assessment" enctype="multipart/form-data" method="post" novalidate>
                    <input type="hidden" name="assessment_id" id="assessment-id">

                    <div class="container">
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Title</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="assessment-update-title" id="assessment-update-title" placeholder="Enter Question Title" value="">
                                    <div class="invalid-feedback feedback-title">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <textarea class="form-control" name="assessment-update-description" id="assessment-update-description" placeholder="Enter Question Description" value=""></textarea>
                                    <div class="invalid-feedback feedback-description">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Difficulty</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <select class="form-control form-select" name="assessment-update-difficulty" id="assessment-update-difficulty" required>
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
                                    <input type="datetime-local" class="form-control" id="assessment-update-deadline" name="assessment-update-deadline">
                                    <div class="invalid-feedback feedback-deadline">
                                    </div>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="input-group has-validation">
                                    <input class="form-control test" name="assessment-update-estimate-time" aria-describedby="basic-addon2" id="assessment-update-estimate-time" placeholder="Suggested Time of Completion" required>
                                    <select class="input-group-text" name="assessment-update-unit-time" id="assessment-update-unit-time">
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
                                    <input type="text" class="form-control" name="assessment-update-rate" id="assessment-update-rate" placeholder="Enter passing rate" value="">
                                    <div class="invalid-feedback feedback-rate">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Attach Cover Photo</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="file" class="form-control" name="assessment-update-pic" id="assessment-update-pic">
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
                                    <input class="slider update-status" name="status" type="checkbox" id="assessment-update-inactive" value="Inactive" autocomplete="off">

                                        <div class="slider round"></div>
                                        <input class="slider update-status" data-on name="status" type="checkbox" id="assessment-update-active" value="Active" autocomplete="off" aria-invalid="false" checked>

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
                                    <input class="slider update-retake" name="retake" type="checkbox" id="assessment-add-retake-no" value="No" autocomplete="off" >

                                        <div class="retake slider round"></div>
                                        <input class="retake slider update-retake" data-on name="retake" type="checkbox" id="assessment-add-retake-yes" value="Yes" autocomplete="off" aria-invalid="false" checked>

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
                <input type="submit" id="update-assessment-question" name="update-assessment-question" value="Save" class="btn modal-edit">

            </div>
            </form>
        </div>
    </div>
</div>