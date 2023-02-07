<?php
$assessment_id =  mysqli_real_escape_string($mysqli, $_GET['assessment_id']);
$title =  mysqli_real_escape_string($mysqli, $_GET['title']);
?>
<?php
$countSummaryAssessment = $mysqli->prepare("SELECT count_takers.status, IF(choice1.total_choice_1 IS NULL, 0, choice1.total_choice_1) AS total_choice_1,IF(choice2.total_choice_2 IS NULL, 0, choice2.total_choice_2) AS total_choice_2,IF(choice3.total_choice_3 IS NULL, 0, choice3.total_choice_3) AS total_choice_3, IF(choice4.total_choice_4 IS NULL, 0, choice4.total_choice_4) AS total_choice_4,IF(count_right.total_right IS NULL, 0, count_right.total_right) AS total_right,count_takers.total_taker,IF(count_true.total_true IS NULL, 0, count_true.total_true) AS total_true,IF(count_false.total_false IS NULL, 0, count_false.total_false) AS total_false,count_takers.question_id,count_takers.assessment_question,count_takers.assessment_choice1,count_takers.assessment_choice2,count_takers.assessment_choice3,count_takers.assessment_choice4, count_takers.assessment_answer, count_takers.type,count_takers.question_answer FROM ( SELECT COUNT(*) as total_taker, answer.question_id,assessment_question,assessment_choice1,assessment_choice2,assessment_choice3,assessment_choice4,question_answer,assessment_answer,status,type FROM retake_chosen_tbl assessment INNER JOIN retake_answer_tbl answer ON assessment.code=answer.code INNER JOIN assessment_question_tbl question INNER JOIN assessment_tbl as lists ON lists.assessment_id =? INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id  WHERE question.question_id = answer.question_id  AND assessment.assessment_id =?  AND answer.assessment_id =?  GROUP BY answer.question_id ) as count_takers

LEFT JOIN ( SELECT COUNT(*) as total_right, answer.question_id,assessment_question,question_answer,assessment_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.question_id = answer.question_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id  WHERE BINARY assessment_answer.assessment_answer = BINARY answer.question_answer GROUP BY answer.question_id ) as count_right ON count_takers.question_id = count_right.question_id

LEFT JOIN ( SELECT COUNT(DISTINCT answer.code) as total_choice_1,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.assessment_id = answer.assessment_id INNER JOIN retake_chosen_tbl assessment ON question.assessment_id = assessment.assessment_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE question.assessment_choice1 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id =?  AND answer.assessment_id =?  GROUP BY answer.question_answer, answer.question_id ) as choice1 ON count_takers.question_id = choice1.question_id

 LEFT JOIN ( SELECT COUNT(DISTINCT answer.code) as total_choice_2,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.assessment_id = answer.assessment_id INNER JOIN retake_chosen_tbl assessment ON question.assessment_id = assessment.assessment_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE question.assessment_choice2 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id =?  AND answer.assessment_id =?  GROUP BY answer.question_answer, answer.question_id ) as choice2 ON count_takers.question_id = choice2.question_id

 LEFT JOIN ( SELECT COUNT(DISTINCT answer.code) as total_choice_3,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.assessment_id = answer.assessment_id INNER JOIN retake_chosen_tbl assessment ON question.assessment_id = assessment.assessment_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE question.assessment_choice3 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id =?  AND answer.assessment_id =?  GROUP BY answer.question_answer, answer.question_id ) as choice3 ON count_takers.question_id = choice3.question_id

 LEFT JOIN ( SELECT COUNT(DISTINCT answer.code) as total_choice_4,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.assessment_id = answer.assessment_id INNER JOIN retake_chosen_tbl assessment ON question.assessment_id = assessment.assessment_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE question.assessment_choice4 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id =?  AND answer.assessment_id =?  GROUP BY answer.question_answer, answer.question_id ) as choice4 ON count_takers.question_id = choice4.question_id

 LEFT JOIN (
  SELECT COUNT(DISTINCT answer.code) as total_true, answer.question_id
  FROM assessment_question_tbl question
  INNER JOIN retake_answer_tbl answer
    INNER JOIN retake_chosen_tbl assessment
      INNER JOIN retake_answer_tbl assessment_answer
      ON assessment_answer.question_id = question.question_id
  WHERE answer.question_answer = 'true'
    AND assessment.user_id = answer.user_id
    AND assessment.assessment_id =?
    AND answer.assessment_id =?
  GROUP BY answer.question_id
) as count_true ON count_takers.question_id = count_true.question_id

 LEFT JOIN (
  SELECT COUNT(DISTINCT answer.code) as total_false, answer.question_id
  FROM assessment_question_tbl question
  INNER JOIN retake_answer_tbl answer
    INNER JOIN retake_chosen_tbl assessment
      INNER JOIN retake_answer_tbl assessment_answer
      ON assessment_answer.question_id = question.question_id
  WHERE answer.question_answer = 'false'
    AND assessment.user_id = answer.user_id
    AND assessment.assessment_id =?
    AND answer.assessment_id =?
  GROUP BY answer.question_id
) as count_false ON count_takers.question_id = count_false.question_id

LEFT JOIN ( SELECT COUNT(*) as total_wrong, answer.question_id,assessment_question,question_answer,assessment_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.question_id = answer.question_id INNER JOIN assessment_answer_tbl assessment_answer ON assessment_answer.question_id = question.question_id WHERE assessment_answer.assessment_answer != answer.question_answer GROUP BY answer.question_id ) as count_wrong ON count_takers.question_id = count_wrong.question_id");
$countSummaryAssessment->bind_param("iiiiiiiiiiiiiii", $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id, $assessment_id);
$countSummaryAssessment->execute();
$countSummaryAssessmentRow = $countSummaryAssessment->get_result();
$countSummaryAssessment->close();

$assessmentTakerQuery = $mysqli->prepare("SELECT * from retake_score_tbl WHERE assessment_id= ?");
$assessmentTakerQuery->bind_param('s', $assessment_id);
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
$overallScoreQuery = $mysqli->prepare("SELECT SUM(retake_score) as total_score FROM retake_score_tbl WHERE assessment_id = ?");
$overallScoreQuery->bind_param('s', $assessment_id);
$overallScoreQuery->execute();
$resultScore = $overallScoreQuery->get_result();
$returnOverallScore = $resultScore->fetch_assoc();
//END

//COUNTS THE TOTAL NUMBER OF QUESTIONS PER ASSESSMENT TAKEN BY ALL ASSESSMENT TAKERS
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
    $assessmentRate = number_format($returnOverallScore['total_score'] / 1);
    $averageScore = number_format($returnOverallScore['total_score'] / 1);
} else {
   // $assessmentRate = number_format($returnOverallScore['total_score'] / $returnOverallQuestion['point'] * 100);
    $averageScore = number_format($returnOverallScore['total_score'] / $returnAssessmentTaker);
    $assessmentRate = number_format($averageScore / $returnOverallQuestion['point'] * 100);
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

$checkAssessmentChosen = $mysqli->prepare("SELECT * FROM retake_chosen_tbl WHERE assessment_id = ?");
$checkAssessmentChosen->bind_param('s', $assessment_id);
$checkAssessmentChosen->execute();
$checkAssessmentChosen->store_result();
$rowcount = $checkAssessmentChosen->num_rows;


/*
$countSummaryAssessment = "
SELECT count_takers.status, IF(choice1.total_choice_1 IS NULL, 0, choice1.total_choice_1) AS total_choice_1,IF(choice2.total_choice_2 IS NULL, 0, choice2.total_choice_2) AS total_choice_2,IF(choice3.total_choice_3 IS NULL, 0, choice3.total_choice_3) AS total_choice_3, IF(choice4.total_choice_4 IS NULL, 0, choice4.total_choice_4) AS total_choice_4,IF(count_right.total_right IS NULL, 0, count_right.total_right) AS total_right,count_takers.total_taker,IF(count_true.total_true IS NULL, 0, count_true.total_true) AS total_true,IF(count_false.total_false IS NULL, 0, count_false.total_false) AS total_false,count_takers.question_id,count_takers.assessment_question,count_takers.assessment_choice1,count_takers.assessment_choice2,count_takers.assessment_choice3,count_takers.assessment_choice4, count_takers.assessment_answer, count_takers.type,count_takers.question_answer FROM ( SELECT COUNT(*) as total_taker, answer.question_id,assessment_question,assessment_choice1,assessment_choice2,assessment_choice3,assessment_choice4,question_answer,assessment_answer,status,type FROM retake_chosen_tbl assessment INNER JOIN retake_answer_tbl answer ON assessment.code=answer.code INNER JOIN assessment_question_tbl question INNER JOIN assessment_tbl as lists ON lists.assessment_id ='$assessment_id'  WHERE question.question_id = answer.question_id  AND assessment.assessment_id ='$assessment_id'  AND answer.assessment_id ='$assessment_id'  GROUP BY answer.question_id ) as count_takers

LEFT JOIN ( SELECT COUNT(*) as total_right, answer.question_id,assessment_question,question_answer,assessment_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.question_id = answer.question_id  WHERE question.assessment_answer = answer.question_answer GROUP BY answer.question_id ) as count_right ON count_takers.question_id = count_right.question_id

LEFT JOIN ( SELECT COUNT(answer.code) as total_choice_1,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer INNER JOIN retake_chosen_tbl assessment WHERE question.assessment_choice1 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id ='$assessment_id'  AND answer.assessment_id ='$assessment_id'  GROUP BY answer.question_answer ) as choice1 ON count_takers.question_id = choice1.question_id

 LEFT JOIN ( SELECT COUNT(answer.code) as total_choice_2,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer INNER JOIN retake_chosen_tbl assessment WHERE question.assessment_choice2 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id ='$assessment_id'  AND answer.assessment_id ='$assessment_id'  GROUP BY answer.question_answer ) as choice2 ON count_takers.question_id = choice2.question_id

 LEFT JOIN ( SELECT COUNT(answer.code) as total_choice_3,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer INNER JOIN retake_chosen_tbl assessment WHERE question.assessment_choice3 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id ='$assessment_id'  AND answer.assessment_id ='$assessment_id'  GROUP BY answer.question_answer ) as choice3 ON count_takers.question_id = choice3.question_id

 LEFT JOIN ( SELECT COUNT(answer.code) as total_choice_4,answer.question_id,question.assessment_question,question.assessment_choice1,question.assessment_choice2,question.assessment_choice3,question.assessment_choice4, question_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer INNER JOIN retake_chosen_tbl assessment WHERE question.assessment_choice4 = answer.question_answer AND assessment.code = answer.code AND assessment.assessment_id ='$assessment_id'  AND answer.assessment_id ='$assessment_id'  GROUP BY answer.question_answer ) as choice4 ON count_takers.question_id = choice4.question_id

 LEFT JOIN ( SELECT COUNT(*) as total_true,answer.question_id FROM retake_answer_tbl as answer WHERE question_answer = 'true' ) as count_true ON count_takers.question_id = count_true.question_id

  LEFT JOIN ( SELECT COUNT(*) as total_false,answer.question_id FROM retake_answer_tbl as answer WHERE question_answer = 'false' ) as count_false ON count_takers.question_id = count_false.question_id

LEFT JOIN ( SELECT COUNT(*) as total_wrong, answer.question_id,assessment_question,question_answer,assessment_answer FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.question_id = answer.question_id WHERE question.assessment_answer != answer.question_answer GROUP BY answer.question_id ) as count_wrong ON count_takers.question_id = count_wrong.question_id
";

$countSummaryAssessmentRow = mysqli_query($mysqli, $countSummaryAssessment);

//COUNTS THE TOTAL OF ASSESSMENT TAKERS
$assessmentTakerQuery = "SELECT * FROM retake_score_tbl WHERE assessment_id = $assessment_id";
$resultAssessmentTaker = mysqli_query($mysqli, $assessmentTakerQuery);
$returnAssessmentTaker = mysqli_num_rows($resultAssessmentTaker);
//END


//COUNTS THE TOTAL NUMBER OF QUESTIONS PER ASSESSMENT
$questionItemQuery = "SELECT * FROM assessment_question_tbl WHERE assessment_id = '$assessment_id'";
$resultQuestionItem = mysqli_query($mysqli, $questionItemQuery);
$returnQuestionItem = mysqli_num_rows($resultQuestionItem);
//END


//COUNTS THE TOTAL OF SUM OF SCORES OF THE ASSESSMENT TAKERS
$overallScoreQuery = " SELECT SUM(retake_score) as total_score FROM retake_score_tbl WHERE assessment_id = '$assessment_id'";
$resultScore = mysqli_query($mysqli, $overallScoreQuery);
$returnOverallScore = mysqli_fetch_assoc($resultScore);
//END

//COUNTS THE TOTAL NUMBER OF QUESTIONS PER ASSESSMENT TAKEN BY ALL ASSESSMENT TAKERS
$overallQuestionQuery = "SELECT SUM(point) as point  FROM retake_answer_tbl WHERE assessment_id = '$assessment_id'";
$resultOverallQuestion = mysqli_query($mysqli, $overallQuestionQuery);
$returnOverallQuestion = mysqli_fetch_assoc($resultOverallQuestion);
//END

//SELECTS STATUS OF ASSESSMENT
$statusQuery = "SELECT status FROM assessment_tbl WHERE assessment_id = '$assessment_id'";
$resultstatus = mysqli_query($mysqli, $statusQuery);
$returnStatus = mysqli_fetch_assoc($resultstatus);
//END


// TO PREVENT FATAL ERROR DIVISION BY ZERO

if (empty($returnAssessmentTaker)) {
    $assessmentRate = number_format($returnOverallScore['total_score'] / 1);
    $averageScore = number_format($returnOverallScore['total_score'] / 1);
} else {
    $assessmentRate = number_format($returnOverallScore['total_score'] / $returnOverallQuestion['point'] * 100);
    $averageScore = number_format($returnOverallScore['total_score'] / $returnAssessmentTaker);
}
*/
?>


<?php
/*
$identificationAnswer = array();
$queryIdentificationQuestion = "SELECT *, COUNT(question_answer) as total FROM assessment_question_tbl question  JOIN retake_answer_tbl answer ON question.question_id = answer.question_id AND question.assessment_id = answer.assessment_id WHERE question.type = 'Identification Question' GROUP BY question_answer  ";
$resultIdentificationAnswer = mysqli_query($mysqli, $queryIdentificationQuestion);


$chartLabel = [];
$chartData = [];

while ($rows = mysqli_fetch_assoc($resultIdentificationAnswer)) {

    $chartLabel[] = $rows['question_answer'];
    $chartData[] =  $rows['total'];
}
$returnChatLabels = json_encode($chartLabel);
$returnChatData = json_encode($chartData);

$tfAnswer = array();
$tfAnswerQuery = "SELECT * FROM assessment_question_tbl question  JOIN retake_answer_tbl answer ON question.question_id = answer.question_id AND question.assessment_id = answer.assessment_id WHERE question.type = 'True/False' ";
$resultTfAnswer = mysqli_query($mysqli, $tfAnswerQuery);

while ($returnTfAnswer = mysqli_fetch_assoc($resultTfAnswer)) {

    $tfAnswer[] = array(
        'tfAnswer' => $returnTfAnswer['question_answer'],
    );
}
*/
?>

<?php
/*
$checkAssessmentChosen = mysqli_query($mysqli, "select * FROM assessment_chosen WHERE assessment_id = '$assessment_id'");
$rowcount = mysqli_num_rows($checkAssessmentChosen);
*/
?>




<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>

    <style>
        #header {
            display: none !important;
        }

        .sidebar {
            display: none !important;
        }
    </style>
</head>
<?php if ($rowcount > 0) { ?>

    <input type="hidden" id="institution-assessment-view" value="<?php echo $assessment_id ?>">
    <div class="container mt-5 mb-3">
        <nav class="assessment-breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb mt-4">
                <li class="breadcrumb-item"><a href="home-admin.php?page=manage-question">Manage Assessment</a></li>
                <li class="breadcrumb-item active"><a href="#"><?php echo $title ?> Post Assessment Summary</a></li>
            </ol>
        </nav>
        <ul class="nav nav-pills nav-fill mt-4 pb-4">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="pill" aria-current="page" href="#assessment-statistics"><i class="fa-solid fa-chart-pie"></i>Overall Post Assessment Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#institution-statistics"><i class="fa-solid fa-chart-area"></i>Institution Post Assessment Overview</a>
            </li>
        </ul>
    </div>

    <div class="tab-content">
        <div id="assessment-statistics" class="tab-pane fade in active show">
            <div class="assessment-statistics jumbotron pb-5" style="background-color: #F4F6F7;">

                <div class="container mt-5 mb-3">
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
                            <h1><?php echo $returnTotalScore['total_point']  ?></h1>
                            <h4>Total Score</h4>
                        </div>

                        <div class="statistics-item">
                            <h1><?php echo $averageScore  ?></h1>
                            <h4>Average Score</h4>
                        </div>

                        <div class="statistics-item">
                            <h1><?php echo $returnStatus['status'] ?></h1>
                            <h4>Assessment Status</h4>
                        </div>

                    </div>
                    <div class="animated-container mb-5">
                        <h4>Assessment Average Percentage</h4>
                        <div class="circular-progress">
                            <div class="value-container">0%</div>
                        </div>
                    </div>


                    <?php $count = 1; ?>

                    <?php
                    while ($returnChoiceRow = $countSummaryAssessmentRow->fetch_assoc()) { ?>
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
                                        echo "['True'," . $returnChoiceRow["total_true"] . "],", "['False'," . $returnChoiceRow["total_false"] . "],";
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

                                var chart = new google.visualization.PieChart(document.getElementById('piechart_question<?php echo $returnChoiceRow['question_id']; ?>'));
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
                                    <canvas id="piechart_question<?php echo $returnChoiceRow['question_id'] ?>" style="width:100%;max-width:600px"></canvas>
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

                                new Chart("piechart_question<?php echo $returnChoiceRow['question_id'] ?>", {
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
                              //  $chartColors = ["#990099", "#109618", "#FF9900", "#DC3912"];
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
    GROUP BY answer.question_id,BINARY answer.question_answer ";
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

                                    new Chart("piechart_question<?php echo $questionId ?>", {
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
                                    "#8A008A",
                                    "#00990A",
                                    "#2b5797",
                                    "#e8c3b9"
                                ];

                                new Chart("piechart_question<?php echo $returnChoiceRow['question_id'] ?>", {
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

                    <?php } ?>
                <?php } else { ?>
                    <div class="container mt-5 mb-3">
                        <nav class="assessment-breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                            <ol class="breadcrumb mt-4">
                                <li class="breadcrumb-item"><a href="home-admin.php?page=manage-question">Manage Assessment</a></li>
                                <li class="breadcrumb-item active"><a href="#"><?php echo $title ?> Post Assessment Summary</a></li>
                            </ol>
                        </nav>
                        <div class="not-found">
                            <p> <img src="assets/img/icons/no-data.png" alt="" height="50%"> No Records Found</p>
                        </div>
                    </div>
                <?php } ?>


                <script>
                    let progressBar = document.querySelector(".circular-progress");
                    let valueContainer = document.querySelector(".value-container");

                    let progressValue = 0;
                    let progressEndValue = <?php echo $assessmentRate ?>;
                    let speed = 5;

                    let progress = setInterval(() => {
                        if (progressEndValue == 0) {
                            clearInterval(progress);
                            progressBar.style.background = `conic-gradient(
#F78080 ${progressValue * 3.6}deg,
  #443E3E ${progressValue * 3.6}deg
)`;
                        } else {
                            <?php if ($assessmentRate >= $returnStatus['passing_rate']) { ?>
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
                        if (progressValue == progressEndValue) {
                            clearInterval(progress);
                        }
                    }, speed);
                </script>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#institution-view-summary').on('change', function() {
                var conceptName = $('#institution-view-summary').find(":selected").val();
                var assessment_id = $('#institution-assessment-view').val();

                $.ajax({
                    type: "POST",
                    url: "query/assessment-retake/institution-view-retake-summary.php",
                    data: {
                        selected: conceptName,
                        assessment_id: assessment_id,

                    },
                    success: function(data) {
                        someFunction(data);
                        $('.response-holder').html(data);

                        // Stuff
                    },
                    error: function(data) {

                        // Stuff
                    }
                });
            });
        });

        function someFunction(data) {
            <?php ?>
            $institution = data;


        }
    </script>





    <div class="tab-content">
        <div id="institution-statistics" class="tab-pane fade in">
            <div class="assessment-statistics jumbotron pb-5" style="background-color: #F4F6F7;">
                <div class="container mb-3">

                    <?php
                    $selQuestion = "SELECT * FROM institution_tbl";
                    $selQuestionRow = mysqli_query($mysqli, $selQuestion);
                    ?>
                    <select class="form-select" name="institution-view-summary" id="institution-view-summary">
                        <option value="" disabled selected>Please select an institution</option>

                        <?php while ($row = mysqli_fetch_assoc($selQuestionRow)) {
                        ?>
                            <option value="<?php echo  $row['institution_id'] ?>"><?php echo $row['name'] ?></option>

                        <?php } ?>

                    </select>
                </div>




                <div class="container mt-5 mb-3">
                    <div class="response-holder">
                        <div class="not-found">
                            <p> <img src="assets/img/icons/find.png" alt="" height="50%">Choose an institution</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                    echo "['True'," . $returnChoiceRow["total_true"] . "],", "['False'," . $returnChoiceRow["total_false"] . "],";
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

            var chart = new google.visualization.PieChart(document.getElementById('piechart_question<?php echo $returnChoiceRow['question_id']; ?>'));
            chart.draw(data, options);

        }
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