<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="subtopic-update-modal" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content modal-full">
            <div class="modal-header modal-full">
                <h3 class="modal-title">Update Subtopic Details </h3>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" class="form-update-subtopic" id="form-update-subtopic" name="form-update-subtopic" enctype="multipart/form-data" method="post" novalidate>
                    <input type="hidden" class="form-control" name="subtopic-update-title" id="subtopic-update-title" placeholder="Enter Topic Title" value="" required>
                    <input type="hidden" name="subtopic-id" id="subtopic-id">

                    <div class="container">
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Update Module</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="subtopic-update-bullet" id="subtopic-update-bullet" placeholder="Enter Subtopic" value="" required>
                                    <div class="invalid-feedback feedback-bullet">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Update Subtopic Title</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" name="subtopic-update-sub" id="subtopic-update-sub" placeholder="Enter Subtopic" value="" required>
                                    <div class="invalid-feedback feedback-subitle">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Update Subtopic Content</label>
                            <div class="col-12">
                                <div class="input-group has-validation">
                                    <textarea class="form-control" name="subtopic-update-content" id="subtopic-update-content" placeholder="Enter Topic Description" value="" required></textarea>
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
<script>
    /* // THIS CONSTANT REPRESENTS THE <select> ELEMENT
    const theSelect = document.getElementById('basic-updateon2')

    // THIS LINE BINDS THE input EVENT TO THE ABOVE select ELEMENT
    // IT WILL BE EXECUTED EVERYTIME THE USER SELECTS AN OPTION
    theSelect.updateEventListener('input', function() {


        sel1 = document.getElementById("basic-updateon2");
        var selected = sel1.options[sel1.selectedIndex].value;
        input = document.getElementById("lesson-update-estimate-time");
        input.value = input.value +" "+ selected;

    })*/
</script>