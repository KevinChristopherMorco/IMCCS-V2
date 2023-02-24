<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" id="past-result" class="welcome-help">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header modal-lg">
                <h5 class="modal-title">Past Results</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT *
                            FROM assessment_chosen  WHERE institution_id = '" .$_SESSION['institution_id']."' AND user_id =  '" .$_SESSION['user_id']."' ";
                        $result = mysqli_query($mysqli, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['created_at'] ?></td>
                                <td><?php echo $row['assessment_code'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-success" onclick="copyToClipboard(event)"><i class="fa-regular fa-clipboard"></i></button>
                                </td>
                            </tr>


                        <?php } ?>

                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(event) {
        const button = event.target;
        const cell = button.parentNode.previousElementSibling;
        const textToCopy = cell.textContent;
        navigator.clipboard.writeText(textToCopy);
        alert('Text Copied')
    }
</script>