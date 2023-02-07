<?php
$assessment_id =  mysqli_real_escape_string($mysqli, $_GET['assessment_id']);

$selRetakes = $mysqli->prepare("SELECT * FROM retake_score_tbl as retake_score  INNER JOIN retake_chosen_tbl as chosen ON retake_score.code = chosen.code INNER JOIN assessment_tbl as assessment ON assessment.assessment_id = chosen.assessment_id INNER JOIN assessment_score as score ON score.assessment_id = chosen.assessment_id AND score.user_id = chosen.user_id WHERE chosen.user_id = ? AND assessment.assessment_id = ? GROUP BY chosen.code ORDER BY chosen.user_id");
$selRetakes->bind_param('ii', $_SESSION['user_id'], $assessment_id);
$selRetakes->execute();
$selRetakeRows = $selRetakes->get_result();



//SELECT * FROM retake_score_tbl as retake_score  INNER JOIN retake_chosen_tbl as retake_chosen ON retake_score.user_id = retake_chosen.user_id WHERE retake_score.user_id = 953 GROUP BY retake_score.code
?>

<?php
//QUERY TO COMAPRE THE FIRST TAKEN ASSESSMENTS


$queryScore = $mysqli->prepare("SELECT *  FROM assessment_score WHERE user_id= ? AND assessment_id = ?");
$queryScore->bind_param('ii', $_SESSION['user_id'], $assessment_id);
$queryScore->execute();
$resultScore = $queryScore->get_result();
$rowCount = $resultScore->num_rows;

$selOver = $mysqli->prepare("SELECT SUM(point) as point  FROM answer_tbl WHERE assessment_id = ? AND user_id = ?");
$selOver->bind_param('ii', $assessment_id, $_SESSION['user_id']);
$selOver->execute();
$resultOver = $selOver->get_result();
$returnCountOver = $resultOver->fetch_assoc();

$ans = number_format($rowCount / $returnCountOver['point'] * 100);
?>


<section class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h1>Welcome to IMCCS <?php echo  $_SESSION["username"] ?></h1>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="my-chosen-assessment">
    <?php /*
    <div class="chosen-assessment-title mb-4">
        <h2> My Post Assessments </h2>
    </div>
    <?php $count = 1 ?>

    <div class="my-retakes">
        <div class="row">
            <?php while ($row3 = $selRetakeRows->fetch_assoc()) { ?>
                <?php
                date_default_timezone_set('Asia/Manila');
                $returnDateSubmit = date('F j, Y h:i A ', strtotime($row3['date_submitted']));
                $retakePercent = number_format($row3['retake_score'] / $returnCountOver['point'] * 100);

                $increase = $row3['retake_score'] - $rowCount;


                //AVOID FATAL ERROR DIVISION BY ZERO
                if ($rowCount == 0) {
                    $retakeCompare = number_format($increase / 1 * 100, 2);
                } else {
                    $retakeCompare = number_format($increase / $rowCount * 100, 2);
                }

                ?>
                <div class="col-sm-12 col-lg-6">
                    <div class="retake-assessment-container mb-4" id="">
                        <div class="retake-assessment-card">
                            <div class="card-details">
                                <!-- A div with name class for the name of the card -->
                                <span title="Due Date" class="tag" style="float:right"><i class="fa-solid fa-calendar-days"></i> Submitted: <?php echo $returnDateSubmit  ?></span></br>
                                <div class="name">Post Assessment No. #<?php echo $count++ ?> </div>

                                <div class="span-container pt-2 text-center">
                                    <span title="Percentage Comparison" class="tag"><i class="fa-solid fa-arrow-trend-down"></i> Pre Assessment Score: <?php echo $row3['assessment_score'] ?> / <?php echo $returnCountOver['point'] ?> </span>
                                    <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> Post Score: <?php echo $row3['retake_score'] ?> / <?php echo $returnCountOver['point'] ?></span>

                                    <?php if ( $row3['retake_score'] < $row3['assessment_score']) { ?>
                                        <span title="Percentage Comparison" class="tag fail"><i class="fa-solid fa-arrow-trend-down"></i> Result: Lower Result </span></br>

                                    <?php } else if ( $row3['retake_score'] > $row3['assessment_score']) { ?>
                                        <span title="Percentage Comparison" class="tag pass"><i class="fa-solid fa-arrow-trend-up"></i> Result: Higher Result </span></br>

                                    <?php } else { ?>
                                        <span title="Percentage Comparison" class="tag equal">Result: Same Result </span></br>

                                    <?php } ?>

                                    <?php if ($retakePercent < $row3['passing_rate']) { ?>
                                        <span title="Difficulty" class="tag fail">Percentage: <?php echo $retakePercent ?> %</span>
                                        <span title="Percentage Comparison" class="tag fail"><i class="fa-solid fa-arrow-trend-down"></i> Remark: Failed</span>
                                    <?php } else if ($retakePercent > $row3['passing_rate'] || $retakePercent == $row3['passing_rate']) { ?>
                                        <span title="Difficulty" class="tag pass">Percentage: <?php echo $retakePercent ?> %</span>
                                        <span title="Percentage Comparison" class="tag pass"><i class="fa-solid fa-arrow-trend-up"></i> Remark: Passed</span>
                                    <?php } else { ?>
                                        <span title="Difficulty" class="tag equal">Remark: Same Result</span>
                                    <?php } ?>
                                </div>

                                <form id="view-retake-result-assessment" class="view-retake-result-assessment" method="GET">
                                    <input type="hidden" name="assessment-id" id="assessment-id" value="<?php echo $row3['assessment_id'] ?>">
                                    <input type="hidden" name="retake-code" id="retake-code" value="<?php echo $row3['code'] ?>">

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
    </div>
    */ ?>
    <?php $count = 1 ?>

    <div class="row">
        <?php while ($row3 = $selRetakeRows->fetch_assoc()) { ?>
            <?php
            date_default_timezone_set('Asia/Manila');
            $returnDateSubmit = date('F j, Y h:i A ', strtotime($row3['date_submitted']));
            $retakePercent = number_format($row3['retake_score'] / $returnCountOver['point'] * 100);

            $increase = $row3['retake_score'] - $rowCount;


            //AVOID FATAL ERROR DIVISION BY ZERO
            if ($rowCount == 0) {
                $retakeCompare = number_format($increase / 1 * 100, 2);
            } else {
                $retakeCompare = number_format($increase / $rowCount * 100, 2);
            }

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
                        <div class="invoice-date"><span title="Percentage Comparison" class="tag"><i class="fa-solid fa-star"></i> Pre Assessment Score: <?php echo $row3['assessment_score'] ?> / <?php echo $returnCountOver['point'] ?> </span></div>
                        <div class="invoice-due-date"> <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> Post Score: <?php echo $row3['retake_score'] ?> / <?php echo $returnCountOver['point'] ?></span>
                        </div>
                    </div>
                    <div class="invoice-info2">
                        <?php if ($row3['retake_score'] < $row3['assessment_score']) { ?>
                            <div class="invoice-date"> <span title="Percentage Comparison" class="tag fail"><i class="fa-solid fa-arrow-trend-down"></i> Result: Lower Result </span></br></div>

                        <?php } else if ($row3['retake_score'] > $row3['assessment_score']) { ?>
                            <div class="invoice-date"> <span title="Percentage Comparison" class="tag pass"><i class="fa-solid fa-arrow-trend-up"></i> Result: Higher Result </span></br></div>

                        <?php } else { ?>
                            <div class="invoice-date"> <span title="Percentage Comparison" class="tag equal">Result: Same Result </span></br> </div>

                        <?php } ?>

                        <?php if ($retakePercent < $row3['passing_rate']) { ?>
                            <div class="invoice-date"> <span title="Difficulty" class="tag fail">Percentage: <?php echo $retakePercent ?> %</span> </div>
                            <div class="invoice-date"> <span title="Percentage Comparison" class="tag fail"><i class="fa-solid fa-arrow-trend-down"></i> Remark: Failed</span> </div>
                        <?php } else if ($retakePercent > $row3['passing_rate'] || $retakePercent == $row3['passing_rate']) { ?>
                            <div class="invoice-date"> <span title="Difficulty" class="tag pass">Percentage: <?php echo $retakePercent ?> %</span> </div>
                            <div class="invoice-date"> <span title="Percentage Comparison" class="tag pass"><i class="fa-solid fa-arrow-trend-up"></i> Remark: Passed</span> </div>
                        <?php } else { ?>
                            <div class="invoice-date"> <span title="Difficulty" class="tag equal">Remark: Same Result</span> </div>
                        <?php } ?>
                    </div>
                    <div class="invoice-body">
                        <form id="view-retake-result-assessment" class="view-retake-result-assessment" method="GET">
                            <input type="hidden" name="assessment-id" id="assessment-id" value="<?php echo $row3['assessment_id'] ?>">
                            <input type="hidden" name="retake-code" id="retake-code" value="<?php echo $row3['code'] ?>">
                            <div class="text-center">
                                <input type="submit" class="ch-retake-assessment-btn text-center" value="View">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>
</div>