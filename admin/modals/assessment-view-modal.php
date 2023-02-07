<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="view-assessment-modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">View Assessment Details </h3>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Title of Assessment</th>
                            <td><input type="text" class="form-control" name="assessment-view-title" id="assessment-view-title"></td>
                        </tr>
                        <tr>
                            <th>Assessment Description</th>
                            <td><textarea class="form-control" name="assessment-view-description" id="assessment-view-description" value=""></textarea></td>
                        </tr>
                        <tr>
                            <th>Difficulty</th>
                            <td><input type="text" class="form-control" name="assessment-view-difficulty" id="assessment-view-difficulty"></td>
                        </tr>
                        <tr>
                            <th>Assessment Deadline</th>
                            <td><input type="datetime-local" class="form-control" id="assessment-view-deadline" name="assessment-view-deadline"></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><input type="text" class="form-control" name="assessment-view-status" id="assessment-view-status" value=""></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button class="btn modal-cancel" type="button" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>