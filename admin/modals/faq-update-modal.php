<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="update-faq-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">Add FAQ's </h3>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="form-update-faq" id="form-update-faq" name="form-update-faq" enctype="multipart/form-data" method="post" novalidate>
                    <input type="hidden" id="faq-id">

                    <div class="container">
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Asked Question</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="faq-update-overview" id="faq-update-overview" value="">
                                    <div class="invalid-feedback feedback-faq">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <textarea class="form-control" name="faq-update-description" id="faq-update-description" value=""></textarea>
                                    <div class="invalid-feedback feedback-description">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn modal-cancel" type="button" data-bs-dismiss="modal">Close</button>
                <input type="submit" id="save-faq" name="save" value="Save" class="btn modal-edit">

            </div>
            </form>
        </div>
    </div>
</div>