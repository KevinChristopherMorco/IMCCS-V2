<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="update-lesson-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">Update Topic</h3>
            </div>
            <div class="modal-body">
            <form action="javascript:void(0)" class="form-update-lesson" id="form-update-lesson" name="form-update-lesson" enctype="multipart/form-data" method="post" novalidate>
                <div class="container">
                <input type="hidden" name="lesson_id" id="lesson-id">

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Title</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="lesson-update-title" id="lesson-update-title" placeholder="Enter Topic Title" value="" required>
                                    <div class="invalid-feedback feedback-title">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <textarea class="form-control" name="lesson-update-description" id="lesson-update-description" placeholder="Enter Topic Description" value="" required></textarea>
                                    <div class="invalid-feedback feedback-description">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Difficulty</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <select class="form-control form-select" name="lesson-update-difficulty" id="lesson-update-difficulty" required>
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
                                    <input class="form-control test" name="lesson-update-estimate-time" aria-describedby="basic-addon2" id="lesson-update-estimate-time" placeholder="Enter Estimated Time" required>
                                    <select class="input-group-text" name="lesson-update-unit-time" id="lesson-update-unit-time">
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
                                    <textarea class="form-control" name="lesson-update-paragraph" id="lesson-update-paragraph" placeholder="Enter Brief Summary" value="" required></textarea>
                                    <div class="invalid-feedback feedback-summary">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Attach Cover Photo</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="file" class="form-control" name="lesson-update-pic" id="lesson-update-pic">
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
                                        <input class="slider update-status" data-on name="status" type="checkbox" id="update-status" value="Active" autocomplete="off" aria-invalid="false">
                                        <div class="slider round"></div>

                                        <input class="slider update-status" name="status" type="checkbox" id="institution-update-inactive" value="Inactive" autocomplete="off" checked>
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
                <input type="submit" id="update-lesson" name="update-lesson" value="Save" class="btn modal-edit">
            </div>
            </form>
        </div>
    </div>
</div>