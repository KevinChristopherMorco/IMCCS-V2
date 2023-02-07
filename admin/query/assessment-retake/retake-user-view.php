<?php include_once('../../../database/config.php'); ?>
<?php
$selectedValue =   mysqli_real_escape_string($mysqli, $_POST['selected']);
$user_id =   mysqli_real_escape_string($mysqli, $_POST['user_id']);
$name =   mysqli_real_escape_string($mysqli, $_POST['name']);



//QUERY TO COMAPRE THE FIRST TAKEN ASSESSMENTS
$queryScore = "SELECT * FROM retake_score_tbl as retake_score INNER JOIN assessment_score as score ON score.assessment_id = retake_score.assessment_id WHERE retake_score.user_id = ? AND retake_score.assessment_id = ?";

$stmt = $mysqli->prepare($queryScore);
$stmt->bind_param("ss", $user_id, $selectedValue);
$stmt->execute();
$resultScore = $stmt->get_result();
$rowCount = $resultScore->fetch_assoc();

$selOver = "SELECT SUM(point) as point  FROM assessment_question_tbl WHERE assessment_id = ?";
$stmt = $mysqli->prepare($selOver);
$stmt->bind_param("s", $selectedValue);
$stmt->execute();
$resultOver = $stmt->get_result();
$rowCountOver = $resultOver->fetch_assoc();


$selRowExist = "SELECT * FROM retake_answer_tbl WHERE assessment_id = ? AND user_id = ?";
$stmt = $mysqli->prepare($selRowExist);
$stmt->bind_param("is", $selectedValue, $user_id);
$stmt->execute();
$resultRowExist = $stmt->get_result();
$checkRowExist = $resultRowExist->num_rows;

//PREVENT FATAL ERROR DIVISION BY ZERO AND CHECKS IF THERE ARE RECORDS RETURNED FROM THE SQL QUERY

if (empty($checkRowExist)) {
    $ans = number_format(0 / 1 * 100);
} else {
    $ans = number_format($rowCount['retake_score'] / $rowCountOver['point'] * 100);
}
?>

<?php
$countSummaryAssessments = "SELECT * FROM retake_score_tbl as retake_score INNER JOIN retake_chosen_tbl as chosen ON retake_score.code = chosen.code INNER JOIN assessment_tbl as assessment ON assessment.assessment_id = retake_score.assessment_id  INNER JOIN assessment_score as score ON score.assessment_id = retake_score.assessment_id AND score.user_id = chosen.user_id WHERE chosen.user_id = ? and chosen.assessment_id = ? GROUP BY chosen.code ORDER BY chosen.user_id";
$stmt = $mysqli->prepare($countSummaryAssessments);
$stmt->bind_param("is", $user_id, $selectedValue);
$stmt->execute();
$countSummaryAssessmentRows = $stmt->get_result();
$countRetakes = $countSummaryAssessmentRows->num_rows;
?>



<?php if ($countRetakes != 0) { ?>
    <?php /*
<?php $count = 1 ?>
    <div class="row">

        <?php while ($returnChoiceRow = $countSummaryAssessmentRows->fetch_assoc()) { ?>
            <?php
            $returnDateSubmit = date('F j, Y h:i A ', strtotime($returnChoiceRow['date_submitted']));
            $retakePercent = number_format($returnChoiceRow['retake_score'] / $rowCountOver['point'] * 100);
            ?>

            <div class="col-sm-12 col-lg-6">
                <div class="retake-assessment-container mb-4" id="">
                    <div class="retake-assessment-card">
                        <div class="card-details">
                            <!-- A div with name class for the name of the card -->
                            <span title="Due Date" class="tag" style="float:right"><i class="fa-solid fa-calendar-days"></i> Submitted: <?php echo $returnDateSubmit  ?></span></br>
                            <div class="name">Post Assessment No. #<?php echo $count++ ?> </div>
                            <div class="span-container tag-container pt-2 text-center">
                                <span title="Percentage Comparison" class="tag"><i class="fa-solid fa-arrow-trend-down"></i> Pre Assessment Score: <?php echo $returnChoiceRow['assessment_score'] ?> / <?php echo $rowCountOver['point'] ?> </span>
                                <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> Post Score: <?php echo $returnChoiceRow['retake_score'] ?> / <?php echo $rowCountOver['point'] ?></span></br>

                                <?php if ($returnChoiceRow['retake_score'] < $returnChoiceRow['assessment_score']) { ?>
                                    <span title="Percentage Comparison" class="tag fail"><i class="fa-solid fa-arrow-trend-down"></i> Result: Lower Result </span></br>

                                <?php } else if ($returnChoiceRow['retake_score'] > $returnChoiceRow['assessment_score']) { ?>
                                    <span title="Percentage Comparison" class="tag pass"><i class="fa-solid fa-arrow-trend-up"></i> Result: Higher Result </span></br>

                                <?php } else { ?>
                                    <span title="Percentage Comparison" class="tag equal">Result: Same Result </span></br>

                                <?php } ?>

                                <?php if ($retakePercent < $returnChoiceRow['passing_rate']) { ?>
                                    <span title="Difficulty" class="tag fail">Percentage: <?php echo $retakePercent ?> %</span>
                                    <span title="Percentage Comparison" class="tag fail"><i class="fa-solid fa-arrow-trend-down"></i> Remark: Failed</span>
                                <?php } else if ($retakePercent > $returnChoiceRow['passing_rate'] || $retakePercent == $returnChoiceRow['passing_rate']) { ?>
                                    <span title="Difficulty" class="tag pass">Percentage: <?php echo $retakePercent ?> %</span>
                                    <span title="Percentage Comparison" class="tag pass"><i class="fa-solid fa-arrow-trend-up"></i> Remark: Passed</span>
                                <?php } else { ?>
                                    <span title="Difficulty" class="tag equal">Remark: Same Result</span>
                                <?php } ?>
                            </div>

                            <form id="view-retake-result-assessment" class="view-retake-result-assessment" method="POST">
                                <input type="hidden" name="assessment-id" id="assessment-id" value="<?php echo $returnChoiceRow['assessment_id'] ?>">
                                <input type="hidden" name="retake-code" id="retake-code" value="<?php echo $returnChoiceRow['code'] ?>">
                                <input type="hidden" name="user-id" id="user-id" value="<?php echo $returnChoiceRow['user_id'] ?>">

                                <div class="btn-retake-assessment-container">
                                    <input type="submit" class="ch-retake-assessment-btn" value="View">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    */ ?>
    <?php $count = 1 ?>

    <div class="row">
        <?php while ($returnChoiceRow = $countSummaryAssessmentRows->fetch_assoc()) { ?>
            <?php
            date_default_timezone_set('Asia/Manila');
            $returnDateSubmit = date('F j, Y h:i A ', strtotime($returnChoiceRow['date_submitted']));
            $retakePercent = number_format($returnChoiceRow['retake_score'] / $rowCountOver['point'] * 100);


            ?>
            <div class="col-sm-12 col-lg-6">

                <div class="invoice-card">
                    <div class="invoice-header">
                        <div class="invoice-title">Post Assessment</div>
                        <div class="invoice-number">#<?php echo $count++ ?></div>
                    </div>
                    <div class="invoice-info">
                        <div class="invoice-date"><span title="Due Date" class="tag" style="float:right"><i class="fa-solid fa-calendar-days"></i> Submitted: <?php echo $returnDateSubmit  ?></span></br></div>
                    </div>
                    <div class="invoice-info">
                        <div class="invoice-date"><span title="Percentage Comparison" class="tag"><i class="fa-solid fa-star"></i> Pre Assessment Score: <?php echo $returnChoiceRow['assessment_score'] ?> / <?php echo $rowCountOver['point'] ?> </span></div>
                        <div class="invoice-due-date"> <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> Post Score: <?php echo $returnChoiceRow['retake_score'] ?> / <?php echo $rowCountOver['point'] ?></span>
                        </div>
                    </div>
                    <div class="invoice-info2">
                        <?php if ($returnChoiceRow['retake_score'] < $returnChoiceRow['assessment_score']) { ?>
                            <div class="invoice-date"> <span title="Percentage Comparison" class="tag fail"><i class="fa-solid fa-arrow-trend-down"></i> Result: Lower Result </span></br></div>

                        <?php } else if ($returnChoiceRow['retake_score'] > $returnChoiceRow['assessment_score']) { ?>
                            <div class="invoice-date"> <span title="Percentage Comparison" class="tag pass"><i class="fa-solid fa-arrow-trend-up"></i> Result: Higher Result </span></br></div>

                        <?php } else { ?>
                            <div class="invoice-date"> <span title="Percentage Comparison" class="tag equal">Result: Same Result </span></br> </div>

                        <?php } ?>

                        <?php if ($retakePercent < $returnChoiceRow['passing_rate']) { ?>
                            <div class="invoice-date"> <span title="Difficulty" class="tag fail">Percentage: <?php echo $retakePercent ?> %</span> </div>
                            <div class="invoice-date"> <span title="Percentage Comparison" class="tag fail"><i class="fa-solid fa-arrow-trend-down"></i> Remark: Failed</span> </div>
                        <?php } else if ($retakePercent > $returnChoiceRow['passing_rate'] || $retakePercent == $returnChoiceRow['passing_rate']) { ?>
                            <div class="invoice-date"> <span title="Difficulty" class="tag pass">Percentage: <?php echo $retakePercent ?> %</span> </div>
                            <div class="invoice-date"> <span title="Percentage Comparison" class="tag pass"><i class="fa-solid fa-arrow-trend-up"></i> Remark: Passed</span> </div>
                        <?php } else { ?>
                            <div class="invoice-date"> <span title="Difficulty" class="tag equal">Remark: Same Result</span> </div>
                        <?php } ?>
                    </div>
                    <div class="invoice-body">
                        <form id="view-retake-result-assessment" class="view-retake-result-assessment" method="GET">
                        <input type="hidden" name="assessment-id" id="assessment-id" value="<?php echo $returnChoiceRow['assessment_id'] ?>">
                                <input type="hidden" name="retake-code" id="retake-code" value="<?php echo $returnChoiceRow['code'] ?>">
                                <input type="hidden" name="user-id" id="user-id" value="<?php echo $user_id ?>">
                                <input type="hidden" name="retake-fname" id="retake-fname" value="<?php echo $name ?>">

                            <div class="text-center">
                                <input type="submit" class="ch-retake-assessment-btn text-center" value="View">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } else { ?>
    <div class="not-found">
        <p> <img src="assets/img/icons/no-data.png" alt="" height="50%"> No Records Found</p>
    </div>
<?php } ?>

<script>
    $('.view-retake-result-assessment').submit(function(event) {
        event.preventDefault();


        var assessment_id = $(this).closest('form').find('input[name=assessment-id]').val();
        var code = $(this).closest('form').find('input[name=retake-code]').val();
        var user_id = $(this).closest('form').find('input[name=user-id]').val();
        var fname = $(this).closest('form').find('input[name=retake-fname]').val();

        $.ajax({
            type: "GET",
            data: {
                code: code,
                assessment_id: assessment_id,
                user_id: user_id,
                fname: fname
            },

            success: function(data) {
                window.location = 'home-admin.php?subpage=view-user-retake-scores&code=' + code + ' &assessment_id=' + assessment_id + ' &user_id=' + user_id + ' &fname=' + fname;
            },
            error: function(xhr, status, error) {


            }
        });


    });
</script>