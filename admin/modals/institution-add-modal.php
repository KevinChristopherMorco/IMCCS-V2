<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="add_institution_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">Add Educational Institution </h3>
            </div>
            <div class="modal-body">
                <form class="form-add-institution" id="form-add-institution" action="javascript:void(0)" name="form1" method="post">
                    <div class="container">
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">School Name</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-add-name" id="institution-add-name" value="">
                                    <div class="invalid-feedback feedback-institution-name">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Institution Address</label>
                            <div class="col-2">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-add-street" id="institution-add-street" placeholder="Street name" value="">
                                    <div class="invalid-feedback feedback-street">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-add-barangay" id="institution-add-barangay" placeholder="Barangay" value="">
                                    <div class="invalid-feedback feedback-barangay">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-add-municipality-city" id="institution-add-municipality-city" placeholder="Municipality/City" value="">
                                    <div class="invalid-feedback feedback-municipality">
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="institution-add-province" id="institution-add-province" placeholder="Province" value="">
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
                                        <input class="slider add-status" data-on name="status" type="checkbox" id="institution-add-inactive" value="Inactivr" autocomplete="off" aria-invalid="false">
                                        <div class="slider round"></div>

                                        <input class="slider add-status" name="status" type="checkbox" id="institution-add-active" value="Active" autocomplete="off" checked>
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
                <input type="submit" id="save-institution" name="save" value="Save" class="btn modal-edit">
            </div>
            </form>
        </div>
    </div>
</div>