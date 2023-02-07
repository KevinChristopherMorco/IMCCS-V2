<?php include_once('../../../database/config.php'); ?>
<?php
$selectedValue =   mysqli_real_escape_string($mysqli, $_POST['selected']);
$assessment_id =   mysqli_real_escape_string($mysqli, $_POST['assessment_id']);
?>
<?php
$countSummaryAssessment = $mysqli->prepare("SELECT IF(count_true.total_true IS NULL, 0, count_true.total_true) AS total_true, IF(count_false.total_false IS NULL, 0, count_false.total_false) AS total_false,  count_takers.status, IF(choice1.total_choice_1 IS NULL, 0, choice1.total_choice_1) AS total_choice_1,IF(choice2.total_choice_2 IS NULL, 0, choice2.total_choice_2) AS total_choice_2,IF(choice3.total_choice_3 IS NULL, 0, choice3.total_choice_3) AS total_choice_3, IF(choice4.total_choice_4 IS NULL, 0, choice4.total_choice_4) AS total_choice_4,IF(count_right.total_right IS NULL, 0, count_right.total_right) AS total_right,count_takers.total_taker,IF(count_wrong.total_wrong IS NULL, 0, count_wrong.total_wrong) AS total_wrong,count_takers.question_id,count_takers.assessment_question,count_takers.assessment_choice1,count_takers.assessment_choice2,count_takers.assessment_choice3,count_takers.assessment_choice4, count_takers.assessment_answer, count_takers.type,count_takers.question_answer FROM ( SELECT COUNT(*) as total_taker, answer.question_id,assessment_question,assessment_choice1,assessment_choice2,assessment_choice3,assessment_choice4,question_answer,assessment_answer,status,type FROM retake_chosen_tbl assessment INNER JOIN retake_answer_tbl answer ON assessment.code=answer.code INNER JOIN assessment_question_tbl question INNER JOIN assessment_tbl as lists ON lists.assessment_id =? INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE question.question_id = answer.question_id  AND assessment.assessment_id =?  AND answer.assessment_id =? AND answer.institution_id = ? AND assessment.institution_id = ?  GROUP BY answer.question_id ) as count_takers

LEFT JOIN ( SELECT COUNT(*) as total_right, answer.question_id,assessment_question,question_answer,assessment_answer,answer.institution_id FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.question_id = answer.question_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id  WHERE BINARY assessment_answer.assessment_answer = BINARY answer.question_answer AND answer.institution_id = ? GROUP BY answer.question_id ) as count_right ON count_takers.question_id = count_right.question_id

LEFT JOIN ( SELECT COUNT(DISTINCT answer.code) as total_choice_1,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.assessment_id = answer.assessment_id INNER JOIN retake_chosen_tbl assessment ON question.assessment_id = assessment.assessment_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE question.assessment_choice1 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id =?  AND answer.assessment_id =? AND answer.institution_id = ? AND assessment.institution_id = ?  GROUP BY answer.question_answer, answer.question_id ) as choice1 ON count_takers.question_id = choice1.question_id

 LEFT JOIN ( SELECT COUNT(DISTINCT answer.code) as total_choice_2,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.assessment_id = answer.assessment_id INNER JOIN retake_chosen_tbl assessment ON question.assessment_id = assessment.assessment_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE question.assessment_choice2 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id =?  AND answer.assessment_id =? AND answer.institution_id = ? AND assessment.institution_id = ?  GROUP BY answer.question_answer, answer.question_id ) as choice2 ON count_takers.question_id = choice2.question_id

 LEFT JOIN ( SELECT COUNT(DISTINCT answer.code) as total_choice_3,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.assessment_id = answer.assessment_id INNER JOIN retake_chosen_tbl assessment ON question.assessment_id = assessment.assessment_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE question.assessment_choice3 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id =?  AND answer.assessment_id =? AND answer.institution_id = ? AND assessment.institution_id = ?  GROUP BY answer.question_answer, answer.question_id ) as choice3 ON count_takers.question_id = choice3.question_id

 LEFT JOIN ( SELECT COUNT(DISTINCT answer.code) as total_choice_4,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.assessment_id = answer.assessment_id INNER JOIN retake_chosen_tbl assessment ON question.assessment_id = assessment.assessment_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE question.assessment_choice4 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id =?  AND answer.assessment_id =? AND answer.institution_id = ? AND assessment.institution_id = ?   GROUP BY answer.question_answer, answer.question_id ) as choice4 ON count_takers.question_id = choice4.question_id

 LEFT JOIN (
  SELECT COUNT(DISTINCT answer.code) as total_true, answer.question_id
  FROM assessment_question_tbl question
  INNER JOIN retake_answer_tbl answer
    INNER JOIN assessment_chosen assessment
      INNER JOIN assessment_answer_tbl assessment_answer
      ON assessment_answer.question_id = question.question_id
  WHERE answer.question_answer = 'true'
    AND assessment.user_id = answer.user_id
    AND assessment.assessment_id =?
    AND answer.assessment_id =?
    AND answer.institution_id = ?
  GROUP BY answer.question_id
) as count_true ON count_takers.question_id = count_true.question_id

LEFT JOIN (
  SELECT COUNT(DISTINCT answer.code) as total_false, answer.question_id
  FROM assessment_question_tbl question
  INNER JOIN retake_answer_tbl answer
    INNER JOIN assessment_chosen assessment
      INNER JOIN assessment_answer_tbl assessment_answer
      ON assessment_answer.question_id = question.question_id
  WHERE answer.question_answer = 'false'
    AND assessment.user_id = answer.user_id
    AND assessment.assessment_id =?
    AND answer.assessment_id =?
    AND answer.institution_id = ?
  GROUP BY answer.question_id
) as count_false ON count_takers.question_id = count_false.question_id

LEFT JOIN ( SELECT COUNT(*) as total_wrong, answer.question_id,assessment_question,question_answer,assessment_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.question_id = answer.question_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE assessment_answer.assessment_answer != answer.question_answer AND answer.institution_id = ? GROUP BY answer.question_id ) as count_wrong ON count_takers.question_id = count_wrong.question_id");
$countSummaryAssessment->bind_param("iiiiiiiiiiiiiiiiiiiiiiiiiiiii", $assessment_id, $assessment_id, $assessment_id, $selectedValue, $selectedValue, $selectedValue, $assessment_id, $assessment_id, $selectedValue, $selectedValue, $assessment_id, $assessment_id, $selectedValue, $selectedValue, $assessment_id, $assessment_id, $selectedValue, $selectedValue, $assessment_id, $assessment_id, $selectedValue, $selectedValue, $assessment_id, $assessment_id, $selectedValue, $assessment_id, $assessment_id, $selectedValue, $selectedValue);
$countSummaryAssessment->execute();
$returnSummaryAssessmentRow = $countSummaryAssessment->get_result();


//$countSummaryAssessmentRow = $countSummaryAssessment->get_result();


$assessmentTakerQuery = $mysqli->prepare("SELECT * from retake_score_tbl WHERE assessment_id= ? AND institution_id = ?");
$assessmentTakerQuery->bind_param('ss', $assessment_id,$selectedValue);
$assessmentTakerQuery->execute();
$assessmentTakerQuery->store_result();
$returnAssessmentTaker = $assessmentTakerQuery->num_rows;

//COUNTS THE TOTAL OF SUM OF SCORES OF THE ASSESSMENT
$totalScoreQuery = $mysqli->prepare("SELECT SUM(point) as total_point FROM assessment_question_tbl WHERE assessment_id = ?");
$totalScoreQuery->bind_param('s', $assessment_id);
$totalScoreQuery->execute();
$totalResultScore = $totalScoreQuery->get_result();
$returnTotalScore = $totalResultScore->fetch_assoc();
//END

//COUNTS THE TOTAL NUMBER OF QUESTIONS PER ASSESSMENT
$questionItemQuery = $mysqli->prepare("SELECT * from assessment_question_tbl WHERE assessment_id= ?");
$questionItemQuery->bind_param('s', $assessment_id);
$questionItemQuery->execute();
$questionItemQuery->store_result();
$returnQuestionItem = $questionItemQuery->num_rows;
//END

//COUNTS THE TOTAL OF SUM OF SCORES OF THE ASSESSMENT TAKERS
$overallScoreQuery = $mysqli->prepare("SELECT SUM(retake_score) as total_score FROM retake_score_tbl WHERE assessment_id = ? AND institution_id = ?");
$overallScoreQuery->bind_param('ss', $assessment_id, $selectedValue);
$overallScoreQuery->execute();
$resultScore = $overallScoreQuery->get_result();
$returnOverallScore = $resultScore->fetch_assoc();
//END

//COUNTS THE TOTAL NUMBER OF QUESTIONS PER ASSESSMENT TAKEN BY ALL ASSESSMENT TAKERS
//$overallQuestionQuery = $mysqli->prepare("SELECT SUM(point) as point  FROM retake_answer_tbl WHERE assessment_id = ? AND institution_id = ?");
//$overallQuestionQuery->bind_param('ss', $assessment_id,$selectedValue);
$overallQuestionQuery = $mysqli->prepare("SELECT SUM(point) as point  FROM assessment_question_tbl WHERE assessment_id = ?");
$overallQuestionQuery->bind_param('s', $assessment_id);
$overallQuestionQuery->execute();
$resultOverallQuestion = $overallQuestionQuery->get_result();
$returnOverallQuestion = $resultOverallQuestion->fetch_assoc();
//END

//SELECTS STATUS OF ASSESSMENT
$statusQuery = $mysqli->prepare("SELECT * FROM assessment_tbl WHERE assessment_id = ?");
$statusQuery->bind_param('s', $assessment_id);
$statusQuery->execute();
$resultstatus = $statusQuery->get_result();
$returnStatus = $resultstatus->fetch_assoc();
//END

if (empty($returnAssessmentTaker)) {
    $averageInstitutionScore = $returnOverallScore['total_score'] / 1;
    $institutionAssessmentRate = number_format($returnOverallScore['total_score'] / 1 * 100);
} else {
    $averageInstitutionScore = number_format($returnOverallScore['total_score'] / $returnAssessmentTaker);
    //$institutionAssessmentRate = number_format($returnOverallScore['total_score'] / $returnOverallQuestion['point']  * 100);
    $institutionAssessmentRate = number_format($averageInstitutionScore / $returnOverallQuestion['point']  * 100);
}


$identificationAnswer = array();
$queryIdentificationQuestion = "SELECT *, COUNT(question_answer) as total FROM assessment_question_tbl question  JOIN retake_answer_tbl answer ON question.question_id = answer.question_id AND question.assessment_id = answer.assessment_id WHERE question.type = 'Identification Question' GROUP BY question_answer ";
$resultIdentificationAnswer = $mysqli->query($queryIdentificationQuestion);

$chartLabel = [];
$chartData = [];

while ($rows = $resultIdentificationAnswer->fetch_assoc()) {

    $chartLabel[] = $rows['question_answer'];
    $chartData[] =  $rows['total'];
}
$returnChatLabels = json_encode($chartLabel);
$returnChatData = json_encode($chartData);

$tfAnswerQuery = "SELECT * FROM assessment_question_tbl question  JOIN retake_answer_tbl answer ON question.question_id = answer.question_id AND question.assessment_id = answer.assessment_id WHERE question.type = 'True/False' ";
$resultTfAnswer = $mysqli->query($tfAnswerQuery);
while ($returnTfAnswer = $resultTfAnswer->fetch_assoc()) {

    $tfAnswer[] = array(
        'tfAnswer' => $returnTfAnswer['question_answer'],
    );
}
?>

<?php
if ($returnSummaryAssessmentRow->num_rows != 0) { ?>

    <div class="statistics-container d-flex justify-content-around mb-5">
        <div class="statistics-item">
            <h1><?php echo $returnAssessmentTaker ?></h1>
            <h4>Assessment Takers</h4>
        </div>

        <div class="statistics-item">
            <h1><?php echo $returnStatus['passing_rate'] ?>%</h1>
            <h4>Passing Rate</h4>
        </div>

        <div class="statistics-item">
            <h1><?php echo $returnTotalScore['total_point'] ?></h1>
            <h4>Total Score</h4>
        </div>

        <div class="statistics-item">
            <h1><?php echo $averageInstitutionScore  ?></h1>
            <h4>Average Score</h4>
        </div>

        <div class="statistics-item">
            <h1><?php echo $returnStatus['status'] ?></h1>
            <h4>Assessment Status</h4>
        </div>

    </div>

    <div class="animated-container mb-5">
        <h4>Assessment Average Percentage</h4>
        <div id="institution-progress" class="circular-progress">
            <div id="institution-value-container" class="value-container">0%</div>
        </div>
    </div>
    <?php $count = 1; ?>

    <?php
    while ($returnChoiceRow = $returnSummaryAssessmentRow->fetch_assoc()) { ?>
        <?php $ans = number_format($returnChoiceRow['total_right'] / $returnAssessmentTaker * 100);

        ?>
        <?php $pass = number_format($returnChoiceRow['total_right'] / $returnAssessmentTaker * 100); ?>

        <script type="text/javascript">
            google.charts.load("current", {
                packages: ["corechart"]
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                    ['Question1', 'Number1'],
                    <?php
                    if ($returnChoiceRow['type'] == 'Multiple Choice Question') {
                        echo "['" . $returnChoiceRow["assessment_choice1"] . "', " . $returnChoiceRow["total_choice_1"] . "],", "['" . $returnChoiceRow["assessment_choice2"] . "', " . $returnChoiceRow["total_choice_2"] . "],", "['" . $returnChoiceRow["assessment_choice3"] . "', " . $returnChoiceRow["total_choice_3"] . "],", "['" . $returnChoiceRow["assessment_choice4"] . "', " . $returnChoiceRow["total_choice_4"] . "],";
                    } else if ($returnChoiceRow['type'] == 'Identification Question') {
                        foreach ($identificationAnswer as $answer) {
                            echo "['" . $answer['answer'] . "', " . $returnChoiceRow["total_right"] . "],";
                        }
                    } else {
                        foreach ($tfAnswer as $answer) {

                            echo "['" . $answer['tfAnswer'] . "', " . $returnChoiceRow["total_right"] . "],";
                        }
                    }
                    ?>

                ]);
                var options = {
                    title: 'Assessment Average Percentage',
                    sliceVisibilityThreshold: 0,
                    //is3D:true,
                    pieHole: 0.3,
                    animation: {
                        duration: 1000,
                        easing: 'out',
                    },
                    colors: ['#990099', '#109618', '#FF9900', '#DC3912', getRandomColor()],

                    'backgroundColor': 'white',
                    'is3D': true

                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart_institution<?php echo $returnChoiceRow['question_id']; ?>'));
                chart.draw(data, options);

            }
        </script>

        <div class="assessment-container mb-2">
            <div class="row">
                <h6>Question <?php echo $count++ ?></h6>

                <div class="col-6">

                    <?php if ($returnChoiceRow['type'] == 'Multiple Choice Question') { ?>

                        <h4><?php echo $returnChoiceRow['assessment_question']; ?></h4>
                        <p><b><?php echo $ans ?>%</b> of the respondents ( <b><?php echo $returnChoiceRow['total_right']; ?> of <?php echo $returnAssessmentTaker ?> </b>) answered this question correctly.</p>
                        <div class="choice-container"><span class="dot-indentifier choice1 mx-3"></span>
                            <?php if ($returnChoiceRow['assessment_choice1'] != $returnChoiceRow['assessment_answer']) { ?>
                                <span class="wrong-answer"> <?php echo $returnChoiceRow['assessment_choice1']; ?></span>
                            <?php } else { ?>
                                <span class="right-answer"><?php echo $returnChoiceRow['assessment_choice1']; ?></span>
                            <?php } ?>
                        </div>

                        <div class="choice-container"><span class="dot-indentifier choice2 mx-3"></span>
                            <?php if ($returnChoiceRow['assessment_choice2'] != $returnChoiceRow['assessment_answer']) { ?>
                                <span class="wrong-answer"> <?php echo $returnChoiceRow['assessment_choice2']; ?></span>
                            <?php } else { ?>
                                <span class="right-answer"><?php echo $returnChoiceRow['assessment_choice2']; ?></span>
                            <?php } ?>
                        </div>

                        <div class="choice-container"><span class="dot-indentifier choice3 mx-3"></span>
                            <?php if ($returnChoiceRow['assessment_choice3'] != $returnChoiceRow['assessment_answer']) { ?>
                                <span class="wrong-answer"> <?php echo $returnChoiceRow['assessment_choice3']; ?></span>
                            <?php } else { ?>
                                <span class="right-answer"><?php echo $returnChoiceRow['assessment_choice3']; ?></span>
                            <?php } ?>
                        </div>

                        <div class="choice-container"><span class="dot-indentifier choice4 mx-3"></span>
                            <?php if ($returnChoiceRow['assessment_choice4'] != $returnChoiceRow['assessment_answer']) { ?>
                                <span class="wrong-answer"> <?php echo $returnChoiceRow['assessment_choice4']; ?></span>
                            <?php } else { ?>
                                <span class="right-answer"><?php echo $returnChoiceRow['assessment_choice4']; ?></span>
                            <?php } ?>
                        </div>
                    <?php } else if ($returnChoiceRow['type'] == 'Identification Question') { ?>
                        <h4><?php echo $returnChoiceRow['assessment_question']; ?></h4>
                        <p><b><?php echo $ans ?>%</b> of the respondents ( <b><?php echo $returnChoiceRow['total_right']; ?> of <?php echo $returnAssessmentTaker ?> </b>) answered this question correctly.</p>
                        <?php
                        $answers = array();
                        //retrieve answers from database
                        $query = "SELECT *, answer.question_id, BINARY answer.assessment_answer, COUNT(assessment_answer) as total
                                        FROM assessment_question_tbl question
                                        JOIN assessment_answer_tbl answer ON question.question_id = answer.question_id AND question.assessment_id = '$assessment_id'
                                        WHERE question.type = 'Identification Question'
                                        AND question.question_id = " . $returnChoiceRow['question_id'] . "
                                        GROUP BY answer.question_id,BINARY answer.assessment_answer";
                        $result = mysqli_query($mysqli, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            array_push($answers, $row['assessment_answer']);
                        }
                        ?>
                        <?php foreach ($answers as $answer) { ?>
                            <div class="choice-container identification-choice"><span class="dot-indentifier mx-3"></span>
                                <span class="right-answer"><?php echo $answer; ?></span>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <h4><?php echo $returnChoiceRow['assessment_question']; ?></h4>
                        <p><b><?php echo $ans ?>%</b> of the respondents ( <b><?php echo $returnChoiceRow['total_right']; ?> of <?php echo $returnAssessmentTaker ?> </b>) answered this question correctly.</p>
                        <div class="choice-container"><span class="dot-indentifier choice1 mx-3"></span>
                            <span class="right-answer"><?php echo $returnChoiceRow['assessment_answer']; ?></span>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-6">
                    <canvas id="piechart_questions<?php echo $returnChoiceRow['question_id'] ?>" style="width:100%;max-width:600px"></canvas>
                </div>
            </div>
        </div>

        <script>
            <?php
            if ($returnChoiceRow['type'] == 'Multiple Choice Question') { ?>
                var xValues = ["<?php echo $returnChoiceRow["assessment_choice1"] ?>", "<?php echo $returnChoiceRow["assessment_choice2"] ?>", "<?php echo $returnChoiceRow["assessment_choice3"] ?>", "<?php echo $returnChoiceRow["assessment_choice4"] ?>"];
                var yValues = ["<?php echo $returnChoiceRow["total_choice_1"] ?>", "<?php echo $returnChoiceRow["total_choice_2"] ?>", "<?php echo $returnChoiceRow["total_choice_3"] ?>", "<?php echo $returnChoiceRow["total_choice_4"] ?>"];
                var barColors = [
                    "#990099", "#109618", "#FF9900", "#DC3912"
                ];

                new Chart("piechart_questions<?php echo $returnChoiceRow['question_id'] ?>", {
                    type: "pie",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Overall Question Statistics"
                        }
                    }
                });
            <?php } else if ($returnChoiceRow['type'] == 'Identification Question') { ?>

                <?php

                // Select all of the questions
                $queryQuestions = "SELECT * FROM assessment_question_tbl WHERE type = 'Identification Question' AND assessment_id = '$assessment_id'";
                $resultQuestions = $mysqli->query($queryQuestions);

                // Initialize the chart colors array
               // $chartColors = ["#990099", "#109618", "#FF9900", "#DC3912"];
               $randomColor = '#'.dechex(mt_rand(0x000000, 0xFFFFFF));
               $chartColors[] = $randomColor;

                // Loop through the questions
                while ($question = $resultQuestions->fetch_assoc()) {
                    // Get the question ID
                    $questionId = $question['question_id'];

                    // Select the answers for the current question
                    $queryAnswers = "SELECT *, answer.question_id, BINARY answer.question_answer, COUNT(question_answer) as total
    FROM assessment_question_tbl question
    JOIN retake_answer_tbl answer ON question.question_id = answer.question_id AND question.assessment_id = '$assessment_id'
    WHERE question.type = 'Identification Question'
    AND question.question_id = $questionId
    AND answer.institution_id = $selectedValue
    GROUP BY answer.question_id, BINARY answer.question_answer ";
                    $resultAnswers = $mysqli->query($queryAnswers);

                    // Initialize the chart labels and data arrays
                    $chartLabels = [];
                    $chartData = [];

                    // Loop through the answers and add them to the arrays
                    while ($answer = $resultAnswers->fetch_assoc()) {
                        $chartLabels[] = $answer['question_answer'];
                        $chartData[] = $answer['total'];
                    }

                    // Encode the arrays as JSON
                    $returnChartLabels = json_encode($chartLabels);
                    $returnChartData = json_encode($chartData);

                    // Create the pie chart

                ?>

                    new Chart("piechart_questions<?php echo $questionId ?>", {
                        type: "pie",
                        data: {
                            labels: <?php echo $returnChartLabels ?>,
                            datasets: [{
                                backgroundColor: <?php echo json_encode($chartColors); ?>,
                                data: <?php echo $returnChartData ?>
                            }]
                        },
                        options: {
                            title: {
                                display: true,
                                text: "Overall Question Statistics"
                            }
                        }
                    });
                <?php
                }
                ?>
            <?php } else { ?>
                var xValues = ["True", "False"];
                var yValues = ["<?php echo $returnChoiceRow["total_true"] ?>", "<?php echo $returnChoiceRow["total_false"] ?>"];
                var barColors = [
                    "#990099", "#109618", "#FF9900", "#DC3912"
                ];

                new Chart("piechart_questions<?php echo $returnChoiceRow['question_id'] ?>", {
                    type: "pie",
                    data: {
                        labels: xValues,
                        datasets: [{
                            backgroundColor: barColors,
                            data: yValues
                        }]
                    },
                    options: {
                        title: {
                            display: true,
                            text: "Overall Question Statistics"
                        }
                    }
                });
            <?php } ?>
        </script>

    <?php }   ?>

<?php } else { ?>
    <div class="not-found">
        <p> <img src="assets/img/icons/no-data.png" alt="" height="50%"> No Records Found</p>
    </div><?php } ?>

<script>
    $(document).ready(function() {

        var progressBar = document.getElementById("institution-progress");
        var valueContainer = document.getElementById("institution-value-container");

        var progressValue = 0;
        var institutionEndValue = <?php echo $institutionAssessmentRate ?>;
        var speed = 5;

        var progress = setInterval(() => {
            if (institutionEndValue == 0) {
                clearInterval(progress);
                progressBar.style.background = `conic-gradient(
#F78080 ${progressValue * 3.6}deg,
  #443E3E ${progressValue * 3.6}deg
)`;
            } else {
                <?php if ($institutionAssessmentRate >= $returnStatus['passing_rate']) { ?>
                    progressValue++;
                    valueContainer.textContent = `${progressValue}%`;
                    progressBar.style.background = `conic-gradient(
      #36F213 ${progressValue * 3.6}deg,
      #443E3E ${progressValue * 3.6}deg
  )`;
                <?php  } else { ?>
                    progressValue++;
                    valueContainer.textContent = `${progressValue}%`;
                    progressBar.style.background = `conic-gradient(
      #F70000 ${progressValue * 3.6}deg,
      #443E3E ${progressValue * 3.6}deg )`;
                <?php } ?>
            }
            if (progressValue == institutionEndValue) {
                clearInterval(progress);
            }
        }, speed);
    })
</script>

<script>
        $(document).ready(function() {
            $('.right-answer').each(function() {
                if ($(this).text() == 'True') {
                    $(this).closest('.choice-container').find('.dot-indentifier').css('background-color', '#8A008A');
                } else if ($(this).text() == 'False') {
                    $(this).closest('.choice-container').find('.dot-indentifier').css('background-color', '#00990A');

                }
            });
        });
    </script>