<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="view-lesson-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">View Topic Details </h3>
            </div>
            <div class="modal-body">

                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Title</th>
                            <td><input type="text" class="form-control" name="lesson-view-title" id="lesson-view-title" placeholder="Enter Topic Title" value="" required></td>
                        </tr>
                        <tr>
                            <th>Topic Description</th>
                            <td>
                                <textarea class="form-control" name="lesson-view-description" id="lesson-view-description" placeholder="Enter Topic Description" value="" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Difficulty</th>
                            <td>
                                <input type="text" class="form-control" name="lesson-view-difficulty" id="lesson-view-difficulty" placeholder="Enter Topic Difficulty" required />
                            </td>
                        </tr>
                        <tr>
                            <th>Topic Summary</th>
                            <td>
                                <textarea class="form-control" name="lesson-view-paragraph" id="lesson-view-paragraph" placeholder="Enter Brief Summary" value="" required></textarea>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <input type="text" class="form-control myEmail" id="lesson-view-status" name="status" placeholder="Enter Status" required />
                            </td>
                        </tr>
                    </tbody>
                </table>



            </div>
            <div class="modal-footer">
                <button class="btn modal-cancel" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>