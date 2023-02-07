<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="view-faq-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">View FAQ's </h3>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="fupForm" name="form1" method="post">
                    <div class="container">
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Asked Question</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="faq-view-overview" id="faq-view-overview" value="">
                                    <div class="invalid-feedback feedback-faq">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Description</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <textarea type="text" class="form-control" name="faq-view-description" id="faq-view-description" value=""></textarea>
                                    <div class="invalid-feedback feedback-description">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn modal-cancel" type="button" data-bs-dismiss="modal">Close </button>
            </div>
            </form>
        </div>
    </div>
</div>