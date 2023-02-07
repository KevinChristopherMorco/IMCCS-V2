<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="subtopic-add-modal" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content ">
            <div class="modal-header ">
                <h3 class="modal-title">Add Subtopic Details </h3>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="form-add-subtopic" id="form-add-subtopic" name="form-add-subtopic" enctype="multipart/form-data" method="post" novalidate>
                    <input type="hidden" class="form-control" name="subtopic-add-title" id="subtopic-add-title" placeholder="Enter Topic Title" value="" required>
                    <input type="hidden" class="form-control" name="subtopic-add-id" id="subtopic-add-id" placeholder="Enter Topic ID" value="" required>

                    <div class="container">
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Add Module</label>
                            <div class="col-10">
                                <div class="input-group select-filter has-validation">


                                    <div class="invalid-feedback feedback-bullet">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Add Subtopic Title</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="subtopic-add-sub" id="subtopic-add-sub" placeholder="Enter Subtopic" value="" required>
                                    <div class="invalid-feedback feedback-subitle">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Add Subtopic Content</label>
                            <div class="col-12">
                                <div class="input-group has-validation">
                                    <textarea class="form-control" name="subtopic-add-content" class="subtopic-add-content" id="subtopic-add-content" placeholder="Enter Topic Description" value="" required></textarea>
                                    <div class="invalid-feedback feedback-content">
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
</div>

