<div class="modal fade" id="update_modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">Update Institutional Information</h3>
            </div>
            <div class="modal-body">
            <form action="javascript:void(0)" class="form-update-institution" id="form-update-institution" name="form-update-institution" enctype="multipart/form-data" method="post" novalidate>
                <div class="container">
                    <input type="hidden" id="institution-id">
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">School Name</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-update-name" id="institution-update-name" value="">
                                    <div class="invalid-feedback feedback-institution-name">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Code</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-update-code" id="institution-update-code" value="">
                                    <div class="invalid-feedback feedback-institution-code">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Institution Address</label>
                            <div class="col-2">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-update-street" id="institution-update-street" placeholder="Street name" value="">
                                    <div class="invalid-feedback feedback-street">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-update-barangay" id="institution-update-barangay" placeholder="Barangay" value="">
                                    <div class="invalid-feedback feedback-barangay">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-update-municipality-city" id="institution-update-municipality-city" placeholder="Municipality/City" value="">
                                    <div class="invalid-feedback feedback-municipality">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-update-province" id="institution-update-province" placeholder="Province" value="">
                                    <div class="invalid-feedback feedback-province">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Status</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <label class="switch">
                                        <input class="slider update-status" data-on name="status" type="checkbox" id="institution-update-inactive" value="Inactive" autocomplete="off" aria-invalid="false">
                                        <div class="slider round"></div>
                                        <input class="slider update-status" name="status" type="checkbox" id="institution-update-active" value="Active" autocomplete="off" checked>
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
                <input type="submit" name="update" value="Update" class="btn modal-edit">
            </div>
            </form>
        </div>
    </div>
</div>