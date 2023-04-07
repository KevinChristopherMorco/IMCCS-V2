<style>
    .past-result-table {
        width: 100%;
        table-layout: fixed;
    }

    .past-result-table thead th {
        background-color: maroon !important;
        color: white;
    }

    .past-result-table thead th:first-child {
        border-top-left-radius: 10px;
    }

    .past-result-table thead th:last-child {
        border-top-right-radius: 10px;
    }

    .table td:nth-child(3).passed span {
  background-color: green;
  color: white;
  border-radius: 5px;
  padding: 0 10px 0 10px;
}

.table td:nth-child(3).failed span {
  background-color: red;
  color: white;
  border-radius: 5px;
  padding: 0 10px 0 10px;

}

</style>
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" id="past-result" class="welcome-help">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-lg">
            <div class="modal-header modal-lg">
                <h5 class="modal-title">Assessment Results History</h5>
            </div>
            <div class="modal-body">

                <h5 class="mb-2">Pre Assessment</h5>
                <?php
                $sql = "SELECT *
                            FROM assessment_chosen chosen INNER JOIN assessment_score score ON chosen.assessment_code = score.assessment_code  WHERE chosen.institution_id = '" . $_SESSION['institution_id'] . "' AND chosen.user_id =  '" . $_SESSION['user_id'] . "' ";
                $result = mysqli_query($mysqli, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <table class="table past-result-table">
                            <thead>
                                <tr>
                                    <th class="col-3">Date Taken</th>
                                    <th class="col-4">Assessment Code</th>
                                    <th class="col-2">Result</th>
                                    <th class="text-center col-3">Check Summary</th>

                                </tr>
                            </thead>
                            <tbody>


                                <tr>
                                    <td class="col-3"><?php echo $row['created_at'] ?></td>
                                    <td class="col-4"><?php echo $row['assessment_code'] ?></td>
                                    <td class="col-2"><span><?php echo $row['verdict'] ?></span></td>

                                    <!--
                                    <td>
                                        <button type="button" class="btn btn-success copy-btn"><i class="fa-regular fa-file-lines"></i></button>
                                    </td>
                    -->
                                    <td class="text-center col-3">
                                        <button type="button" class="btn btn-success check-assessment-btn"><i class="fa-regular fa-file-lines"></i></button>
                                    </td>
                                </tr>


                            <?php } ?>

                        <?php
                    } else { ?>
                            <div class="text-center">
                                <p class="chosen-empty-result"><img src="assets/images/icons/search-gif.gif" width="45" height="45" alt="">No Pre Assessment Taken</p>
                            </div>
                        <?php   }

                        ?>

                            </tbody>
                        </table>

                        <h5 class="mb-2">Post Assessment</h5>
                        <?php
                        $sql = "SELECT *
            FROM retake_chosen_tbl chosen INNER JOIN retake_score_tbl score ON chosen.code = score.code  WHERE chosen.institution_id = '" . $_SESSION['institution_id'] . "' AND chosen.user_id =  '" . $_SESSION['user_id'] . "' ";
                        $result = mysqli_query($mysqli, $sql);
                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <table class="table past-result-table">
                                    <thead>
                                        <tr>
                                            <th class="col-3">Date Taken</th>
                                            <th class="col-4">Assessment Code</th>
                                            <th class="col-2">Result</th>
                                            <th class="text-center col-3">Check Summary</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                        <tr>
                                            <td class="col-3"><?php echo $row['date_submitted'] ?></td>
                                            <td class="col-4"><?php echo $row['code'] ?></td>
                                            <td class="col-2"><span><?php echo $row['verdict'] ?></span></td>

                                            <!--
                                            <td>
                                                <button type="button" class="btn btn-success copy-btn"><i class="fa-regular fa-file-lines"></i></button>
                                            </td>
                            -->
                                            <td class="text-center col-3">
                                                <button type="button" class="btn btn-success check-retake-btn"><i class="fa-regular fa-file-lines"></i></button>
                                            </td>
                                        </tr>


                                    <?php } ?>
                                <?php
                            } else { ?>
                                    <div class="text-center">
                                        <p class="chosen-empty-result"><img src="assets/images/icons/search-gif.gif" width="45" height="45" alt="">No Post Assessment Taken</p>
                                    </div>
                                <?php   }

                                ?>
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
        $('.copy-btn').click(async function() {
            const button = event.target;
            const row = button.closest('tr');
            const cell = row.cells[1];
            const textToCopy = cell.textContent.trim();
            try {
                await navigator.clipboard.writeText(textToCopy);
                alert('Text Copied')
            } catch (error) {
                console.error('Failed to copy text: ', error);
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.check-assessment-btn').click(async function() {
            const button = event.target;
            const row = button.closest('tr');
            const cell = row.cells[1];
            const textToCopy = cell.textContent.trim();

            window.location = 'home-page.php?page=result&assessment_code=' + textToCopy;

        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.check-retake-btn').click(async function() {
            const button = event.target;
            const row = button.closest('tr');
            const cell = row.cells[1];
            const textToCopy = cell.textContent.trim();

            window.location = 'home-page.php?page=retake-result&code=' + textToCopy;

        });
    });

    $(document).ready(function() {
  $('.table td:nth-child(3)').each(function() {
    var text = $(this).text().toLowerCase();
    if (text == 'passed') {
      $(this).addClass('passed');
    } else if (text == 'failed') {
      $(this).addClass('failed');
    }
  });
});

</script>