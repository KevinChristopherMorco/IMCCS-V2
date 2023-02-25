<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" id="past-result" class="welcome-help">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header modal-lg">
                <h5 class="modal-title">Past Results</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h4>Pre Assessment</h4>

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
                            FROM assessment_chosen  WHERE institution_id = '" . $_SESSION['institution_id'] . "' AND user_id =  '" . $_SESSION['user_id'] . "' ";
                        $result = mysqli_query($mysqli, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['created_at'] ?></td>
                                <td><?php echo $row['assessment_code'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-success copy-btn"><i class="fa-regular fa-clipboard"></i></button>
                                </td>
                            </tr>


                        <?php } ?>

                    </tbody>
                </table>

                <h4>Post Assessment</h4>

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
            FROM retake_chosen_tbl  WHERE institution_id = '" . $_SESSION['institution_id'] . "' AND user_id =  '" . $_SESSION['user_id'] . "' ";
                        $result = mysqli_query($mysqli, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $row['date_submitted'] ?></td>
                                <td><?php echo $row['code'] ?></td>
                                <td>
                                    <button type="button" class="btn btn-success copy-btn"><i class="fa-regular fa-clipboard"></i></button>
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
  $(document).ready(function() {
    $('.copy-btn').click(function() {
      var code = $(this).closest('tr').find('td:nth-child(2)').text();
      var temp = $("<input>");
      $("body").append(temp);
      temp.val(code).select();
      document.execCommand("copy");
      temp.remove();
      alert('Text Copied')
    });
  });
</script>



