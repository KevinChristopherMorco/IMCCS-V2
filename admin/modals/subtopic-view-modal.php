<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="subtopic-view-modal" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content modal-full">
            <div class="modal-header modal-full">
                <h3 class="modal-title">View Subtopic Details </h3>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="form-view-subtopic" id="form-view-subtopic" name="form-view-subtopic" enctype="multipart/form-data" method="post" novalidate>
                    <input type="hidden" class="form-control" name="subtopic-view-title" id="subtopic-view-title" placeholder="Enter Topic Title" value="" required>
                    <input type="hidden" name="subtopic-id" id="subtopic-id">

                    <div class="container">
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">View Module</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="subtopic-view-bullet" id="subtopic-view-bullet" placeholder="Enter Subtopic" value="" required>
                                    <div class="invalid-feedback feedback-bullet">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">View Subtopic Title</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="subtopic-view-sub" id="subtopic-view-sub" placeholder="Enter Subtopic" value="" required>
                                    <div class="invalid-feedback feedback-subitle">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">View Subtopic Content</label>
                            <div class="col-12">
                                <div class="input-group has-validation">
                                    <textarea class="form-control" name="subtopic-view-content" id="subtopic-view-content" placeholder="Enter Topic Description" value="" required></textarea>
                                    <div class="invalid-feedback feedback-content">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn modal-cancel" type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    /* // THIS CONSTANT REPRESENTS THE <select> ELEMENT
    const theSelect = document.getElementById('basic-viewon2')

    // THIS LINE BINDS THE input EVENT TO THE ABOVE select ELEMENT
    // IT WILL BE EXECUTED EVERYTIME THE USER SELECTS AN OPTION
    theSelect.viewEventListener('input', function() {


        sel1 = document.getElementById("basic-viewon2");
        var selected = sel1.options[sel1.selectedIndex].value;
        input = document.getElementById("lesson-view-estimate-time");
        input.value = input.value +" "+ selected;

    })*/
</script>