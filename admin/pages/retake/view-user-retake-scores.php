<style>
    #header {
        display: none !important;
    }

    .sidebar {
        display: none !important;
    }
</style>

<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>

<head>
    <style>
        #header {
            display: none !important;
        }

        .sidebar {
            display: none !important;
        }
    </style>
</head>


<?php


$user_id =  mysqli_real_escape_string($mysqli, $_GET['user_id']);
$assessment_id =  mysqli_real_escape_string($mysqli, $_GET['assessment_id']);
$code =  mysqli_real_escape_string($mysqli, $_GET['code']);
$name =  mysqli_real_escape_string($mysqli, $_GET['fname']);

/*
$queryChosenAssessment = "SELECT * FROM assessment_tbl WHERE assessment_id='$assessment_id' ";


$resultChosenAssessment = mysqli_query($mysqli, $queryChosenAssessment);

$returnChosenAssessment = mysqli_fetch_assoc($resultChosenAssessment);
*/


$queryChosenAssessment = $mysqli->prepare("SELECT * FROM assessment_tbl WHERE assessment_id= ?");
$queryChosenAssessment->bind_param('i', $assessment_id);
$queryChosenAssessment->execute();
$resultChosenAssessment = $queryChosenAssessment->get_result();
$returnChosenAssessment = $resultChosenAssessment->fetch_assoc();



?>




<section style="overflow: hidden;">

    <?php



    $queryRetake = $mysqli->prepare("SELECT retake_score FROM retake_score_tbl WHERE user_id= ? AND code = ?");
    $queryRetake->bind_param('is', $user_id, $code);
    $queryRetake->execute();
    $resultRetake = $queryRetake->get_result();
    $retake = $resultRetake->fetch_assoc();

    $selOver = $mysqli->prepare("SELECT SUM(point) as point  FROM retake_answer_tbl WHERE assessment_id = ? AND user_id = ? AND code = ?");
    $selOver->bind_param('iis', $assessment_id, $user_id, $code);
    $selOver->execute();
    $resultOver = $selOver->get_result();
    $returnCountOver = $resultOver->fetch_assoc();

    $ans = number_format($retake['retake_score'] / $returnCountOver['point'] * 100);

    $checkAssessmentChosen = $mysqli->prepare("SELECT * FROM assessment_question_tbl question INNER JOIN retake_answer_tbl answer ON question.question_id = answer.question_id LEFT JOIN assessment_answer_tbl assessment_answer ON question.question_id = assessment_answer.question_id AND answer.question_answer = assessment_answer.assessment_answer WHERE question.assessment_id= ? AND answer.user_id= ? AND answer.code = ? ORDER BY question.question_id ASC ");
    $checkAssessmentChosen->bind_param('iis', $assessment_id, $user_id, $code);
    $checkAssessmentChosen->execute();
    $checkAssessmentChosen->store_result();
    $rowcount = $checkAssessmentChosen->num_rows;
    ?>

<nav class="assessment-breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
    <ol class="breadcrumb mt-4">
        <li class="breadcrumb-item"><a href="home-admin.php?page=manage-users">Manage Users</a></li>
        <li class="breadcrumb-item"><a href="home-admin.php?subpage=view-user-assessment&user_id=<?php echo $user_id ?>&fname=<?php echo $name ?>"><?php echo $name ?>'s Finished Assessments</a></a></li>

        <li class="breadcrumb-item active"><a href="#"><?php echo $name ?>'s Result</a></li>
    </ol>
</nav>
    <?php if ($ans >= $returnChosenAssessment['passing_rate']) { ?>

        <div class="container mb-4">
            <div class="row">
                <div class="col-lg-4">
                    <div class="score-container mt-4">
                        <h3 class="pt-4 px-4">Score</h3>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center"> <i class="fa-solid fa-medal medal-pass fa-5x pt-4 px-4"></i>
                                <h1><?php echo  $retake['retake_score'] ?> / <?php echo $returnCountOver['point'] ?> </h1>

                            </div>
                        </div>
                    </div>
                    <div class="score-container mt-4">
                        <h3 class="pt-4 px-4">Remarks</h3>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center"> <i class="fa-solid fa-rectangle-list rectangle-pass fa-5x pt-4 px-4"></i>
                                <h5><b>You've Passed </b> <br> <span class="mt-2"> You are Certified Cyber Secured </span></br></h5>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">

                    <div class="animated-container mt-4">
                        <h3>Score Percentage</h3>
                        <div class="circular-progress">
                            <div class="value-container">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } else { ?>

        <div class="container mb-4">
            <div class="row">
                <div class="col-lg-4">
                    <div class="score-container mt-4">
                        <h3 class="pt-4 px-4">Score</h3>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center"> <i class="fa-solid fa-medal medal-fail fa-5x pt-4 px-4"></i>
                                <h1><?php echo  $retake['retake_score'] ?> / <?php echo $returnCountOver['point'] ?> </h1>
                            </div>
                        </div>
                    </div>
                    <div class="score-container mt-4">
                        <h3 class="pt-4 px-4">Remarks</h3>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex flex-row align-items-center"> <i class="fa-solid fa-rectangle-list rectangle-fail fa-5x pt-4 px-4"></i>
                                <h5> <b>You've Failed</b> <br> <span class="mt-2"> You can always take time in reading topics to be better </span></br></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="animated-container mt-4">
                        <h3>Score Percentage</h3>
                        <div class="circular-progress">
                            <div class="value-container">0%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="container page-container mt-4">
        <?php $count = 1; ?>

        <?php
        $selQuestion = $mysqli->prepare("SELECT question.*, answer.*, assessment_answer.*, subquery.assessment_answer_cmp AS assessment_answer_cmp
         FROM assessment_question_tbl question
         INNER JOIN retake_answer_tbl answer ON question.question_id = answer.question_id
         INNER JOIN
         (
           SELECT COUNT(*) AS count, question_id, assessment_answer as assessment_answer_cmp
           FROM assessment_answer_tbl
           GROUP BY question_id
         ) AS subquery ON subquery.question_id = question.question_id
         LEFT JOIN assessment_answer_tbl assessment_answer ON question.question_id = assessment_answer.question_id AND answer.question_answer = assessment_answer.assessment_answer
         WHERE question.assessment_id=? AND answer.user_id=? AND answer.code = ?
         ORDER BY question.question_id ASC");
        $selQuestion->bind_param('iis', $assessment_id, $user_id, $code);
        $selQuestion->execute();
        $selQuestionRow = $selQuestion->get_result();
        while ($row = $selQuestionRow->fetch_assoc()) { ?>

            <div class="assessment-form mb-5">
                <div class="row">
                    <div class="col-12">
                        <div class="question-header px-4 py-4">
                            <span>Question <?php echo $count++ ?></span>
                            <span class="question-point"><?php echo $row['point'] ?> Points</span>
                        </div>
                        <?php if ($row['type'] == "Multiple Choice Question") { ?>
                            <?php if ($row['question_answer'] != $row['assessment_answer_cmp']) { ?>

                                <p class=" assessment-question px-4 py-4" style="color: #F70500"><i class="fa-solid fa-square-xmark"></i> <?php echo $row['assessment_question']; ?></p>
                                <div class="assessment-choices-container">
                                    <?php if ($row['assessment_choice1'] != $row['assessment_answer_cmp']) { ?>
                                        <h5 class="wrong-answer">
                                            <div class="choices-container mb-3">A. <?php echo $row['assessment_choice1']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="right-answer">
                                            <div class="choices-container mb-3">A. <?php echo $row['assessment_choice1']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } ?>
                                    <?php if ($row['assessment_choice2'] != $row['assessment_answer_cmp']) { ?>
                                        <h5 class="wrong-answer">
                                            <div class="choices-container mb-3">B. <?php echo $row['assessment_choice2']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="right-answer">
                                            <div class="choices-container mb-3">B. <?php echo $row['assessment_choice2']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } ?>


                                    <?php if ($row['assessment_choice3'] != $row['assessment_answer_cmp']) { ?>
                                        <h5 class="wrong-answer">
                                            <div class="choices-container mb-3">C. <?php echo $row['assessment_choice3']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="right-answer">
                                            <div class="choices-container mb-3">C. <?php echo $row['assessment_choice3']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } ?>

                                    <?php if ($row['assessment_choice4'] != $row['assessment_answer_cmp']) { ?>
                                        <h5 class="wrong-answer">
                                            <div class="choices-container mb-3">D. <?php echo $row['assessment_choice4']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="right-answer">
                                            <div class="choices-container mb-3">D. <?php echo $row['assessment_choice4']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } ?>
                                    <h5 class="user-wrong-answer">
                                        <div class="user-answer-container mb-3"><b> Chosen Answer: </b> <span><?php echo $row['question_answer']; ?></span><i class="fa-solid fa-square-xmark"></i></div>
                                    </h5>
                                </div>
                            <?php } else { ?>
                                <p class=" assessment-question px-4 py-4" style="color: #008000"><i class="fa-solid fa-square-check"></i> <?php echo $row['assessment_question']; ?></p>
                                <div class="assessment-choices-container">
                                    <?php if ($row['assessment_choice1'] != $row['assessment_answer_cmp']) { ?>
                                        <h5 class="wrong-answer">
                                            <div class="choices-container mb-3">A. <?php echo $row['assessment_choice1']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="right-answer">
                                            <div class="choices-container mb-3">A. <?php echo $row['assessment_choice1']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } ?>
                                    <?php if ($row['assessment_choice2'] != $row['assessment_answer_cmp']) { ?>
                                        <h5 class="wrong-answer">
                                            <div class="choices-container mb-3">B. <?php echo $row['assessment_choice2']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="right-answer">
                                            <div class="choices-container mb-3">B. <?php echo $row['assessment_choice2']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } ?>
                                    <?php if ($row['assessment_choice3'] != $row['assessment_answer_cmp']) { ?>
                                        <h5 class="wrong-answer">
                                            <div class="choices-container mb-3">C. <?php echo $row['assessment_choice3']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="right-answer">
                                            <div class="choices-container mb-3">C. <?php echo $row['assessment_choice3']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } ?>
                                    <?php if ($row['assessment_choice4'] != $row['assessment_answer_cmp']) { ?>
                                        <h5 class="wrong-answer">
                                            <div class="choices-container mb-3">D. <?php echo $row['assessment_choice4']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } else { ?>
                                        <h5 class="right-answer">
                                            <div class="choices-container mb-3">D. <?php echo $row['assessment_choice4']; ?><i class="fa-solid fa-square-check"></i></div>
                                        </h5>
                                    <?php } ?>
                                </div>

                            <?php } ?>
                        <?php } else { ?>
                            <?php if ($row['question_answer'] != $row['assessment_answer']) { ?>
                                <p class=" assessment-question px-4 py-4" style="color: #F70500;"><i class="fa-solid fa-square-xmark"></i> <?php echo $row['assessment_question']; ?></p>
                            <?php } else { ?>
                                <p class=" assessment-question px-4 py-4" style="color: #008000;"><i class="fa-solid fa-square-check"></i> <?php echo $row['assessment_question']; ?></p>
                            <?php } ?>
                            <div class="assessment-choices-container">
                                <?php if ($row['question_answer'] == $row['assessment_answer']) { ?>
                                    <div class="text-answer-container mb-3"><?php echo $row['assessment_answer']; ?><i class="fa-solid fa-square-check"></i></div>
                                <?php }  ?>
                                <?php if ($row['question_answer'] != $row['assessment_answer']) { ?>
                                    <h5 class="user-wrong-answer">
                                        <div class="user-answer-container mb-3"><b> Chosen Answer: </b> <?php echo $row['question_answer']; ?><i class="fa-solid fa-square-xmark"></i></div>
                                    </h5>
                                <?php } ?>

                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        <?php }
        ?>

    </div>
</section>

<script>
    let progressBar = document.querySelector(".circular-progress");
    let valueContainer = document.querySelector(".value-container");

    let progressValue = 0;
    let progressEndValue = <?php echo $ans ?>;
    let speed = 5;

    let progress = setInterval(() => {
        if (progressEndValue == 0) {
            clearInterval(progress);
            progressBar.style.background = `conic-gradient(
      #F78080 ${progressValue * 3.6}deg,
      #443E3E ${progressValue * 3.6}deg
  )`;
        } else {
            <?php if ($ans >= $returnChosenAssessment['passing_rate']) { ?>
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