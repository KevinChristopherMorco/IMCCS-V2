<?php $user_id =  mysqli_real_escape_string($mysqli, $_GET['user_id']); ?>
<?php $name =  mysqli_real_escape_string($mysqli, $_GET['fname']); ?>
<?php
$checkAssessmentChosen = mysqli_query($mysqli, "select * FROM assessment_chosen WHERE user_id = '$user_id'");
$rowcount = mysqli_num_rows($checkAssessmentChosen);
if ($rowcount > 0) {

    $queryScore = "SELECT * FROM assessment_question_tbl question INNER JOIN answer_tbl answer ON question.question_id = answer.question_id  AND question.assessment_answer = answer.question_answer  WHERE question.assessment_id= answer.assessment_id AND answer.user_id='$user_id'";
    $resultScore = mysqli_query($mysqli, $queryScore);
    $rowCount = mysqli_num_rows($resultScore);
    $selOver = "SELECT * FROM assessment_question_tbl question INNER JOIN answer_tbl answer ON question.question_id = answer.question_id  WHERE question.assessment_id= answer.assessment_id AND answer.user_id='$user_id'";
    $resultOver = mysqli_query($mysqli, $selOver);
    $rowCountOver = mysqli_num_rows($resultOver);

    $ans = number_format($rowCount / $rowCountOver * 100, 2);
}

?>



<head>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <style>
        #header {
            display: none !important;
        }

        .sidebar {
            display: none !important;
        }

        .pass {
            background-color: #009215 !important;
            color: #fff !important;
            padding: 5px 15px 5px 15px;
            border-radius: 20px;
        }

        .fail {
            background-color: red !important;
            color: #fff !important;
            padding: 5px 15px 5px 15px;
            border-radius: 20px;

        }

        .card {
            border: none;
            border-radius: 10px;
            background-color: #FEE3AA;
            min-height: 300px;
            box-shadow: 5px 5px 25px rgba(0, 0, 0, 0.2);


        }

        .view-card-title {
            font-weight: bolder;
        }

        .c-details span {
            font-weight: 300;
            font-size: 13px
        }

        .icon {
            width: 50px;
            height: 50px;
            background-color: #eee;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 39px
        }

        .title {
            font-weight: bolder;
        }

        .badge {
            margin: 0px 40px;
        }

        .description-heading {
            color: gray;
        }

        .description-body {
            color: #000;
            font-size: 16px;
        }



        .progress {
            height: 10px;
            border-radius: 10px
        }

        .progress div {
            background-color: red
        }

        .text1 {
            font-size: 14px;
            font-weight: 600
        }

        .text2 {
            color: #a5aec0
        }

        .assessment-view-title {
            display: flex;
            align-items: center;
        }

        .assessment-view-title p {
            color: #800000;
            cursor: pointer;
        }

        .not-found {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            min-height: 100vh;
            font-weight: bold;
            font-size: 60px;
        }

        .not-found img {
            height: 150px;
        }
    </style>
</head>

<body>
    <?php if ($rowcount > 0) { ?>
        <div class="jumbotron pt-5 pb-5" style="background-color: #F4F6F7;">

            <div class="container mt-5 mb-3">

                <div class="assessment-view-title mt-5 mb-3">
                    <p onclick="history.back()"><i class="fa-solid fa-arrow-left fa-2x"></i></p>
                    <h1 class="title mb-3 text-center"><?php echo $name ?>'s Finished Assessments</h1>
                </div>

                <div class="row">
                    <?php
                    $view = "SELECT * FROM  assessment_chosen answer WHERE  answer.user_id = '$user_id'";
                    $getView = mysqli_query($mysqli, $view);

                    while ($getRow2 = mysqli_fetch_assoc($getView)) { ?>

                        <?php
                        $userID = $getRow2['user_id'];
                        $assessmentID = $getRow2['assessment_id'];

                        $view2 = "SELECT * FROM assessment_tbl assessment INNER JOIN assessment_chosen answer ON assessment.assessment_id=answer.assessment_id  INNER JOIN user_tbl user  ON user.user_id=answer.user_id INNER JOIN student_faculty_profile_tbl prfl ON user.user_id=prfl.user_id WHERE  answer.user_id='$userID' AND assessment.assessment_id='$assessmentID'";
                        $getView2 = mysqli_query($mysqli, $view2);
                        $getRow3 = mysqli_fetch_assoc($getView2); ?>

                        <?php $queryScore = "SELECT * FROM assessment_question_tbl question INNER JOIN answer_tbl answer ON question.question_id = answer.question_id AND question.assessment_answer = answer.question_answer INNER JOIN user_tbl user ON user.user_id=answer.user_id  WHERE answer.user_id='$userID' AND answer.assessment_id='$assessmentID'";

                        $resultScore = mysqli_query($mysqli, $queryScore);
                        $rowCount = mysqli_num_rows($resultScore);

                        $selOver = "SELECT * FROM assessment_question_tbl question INNER JOIN answer_tbl answer ON question.question_id = answer.question_id  WHERE question.assessment_id=answer.assessment_id AND answer.user_id='$userID' AND answer.assessment_id='$assessmentID'";
                        $resultOver = mysqli_query($mysqli, $selOver);
                        $rowCountOver = mysqli_num_rows($resultOver); ?>



                        <div class="view-score-card col-lg-4">
                            <div class="card p-3 mb-2">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <img class="icon" src="assets/img/<?php echo $getRow3['question_img'] ?>">
                                        <div class="ms-2 c-details">
                                            <h6 class="view-card-title mb-0"> <?php echo $getRow3['title']; ?></h6>
                                            <span><?php /* echo $getRow3['title']; */ ?></span>
                                        </div>
                                    </div>


                                </div>
                                <div class="badge">
                                    <span class="score">
                                        <i class="fa-solid fa-star"></i> Score:
                                        <?php echo $rowCount ?>

                                        /
                                        <?php echo $rowCountOver ?>
                                    </span>
                                    <span class="view">
                                        <i class="fa-solid fa-percent"></i> Rate:
                                        <?php echo $ans = number_format($rowCount / $rowCountOver * 100, 2); ?>%
                                    </span>
                                    <span class="percent" style="display: none;">
                                        <?php echo $ans = number_format($rowCount / $rowCountOver * 100, 2); ?>
                                    </span>
                                </div>
                                <div class="mt-5">
                                    <p class="description-heading">Assessment Description</p>
                                    <p class="description-body"><?php echo $getRow3['description']; ?></p>
                                    <div class="d-flex justify-content-between">
                                        <p class="description-heading">Difficulty</p>
                                        <p class="description-heading">Estimated Time</p>

                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <p class="description-body"><i class="fa-solid fa-star-half-stroke"></i><?php echo $getRow3['difficulty']; ?></p>
                                        <p class="description-body"><i class="fa-solid fa-clock"></i><?php echo $getRow3['estimated_time']; ?><?php echo $getRow3['unit_time']; ?></p>

                                    </div>


                                    <div class="mt-5">
                                        <form class="view-user-score" action="javascript:void(0)" method="GET">
                                            <input type="hidden" id="user-id" class="user-id" name="user_id" value="<?php echo $getRow3['user_id']; ?>">
                                            <input type="hidden" id="assessment-id" class="assessment-id" name="assessment_id" value="<?php echo $getRow3['assessment_id']; ?>">
                                            <input type="hidden" id="user-name" class="user-name" name="user_name" value="<?php echo $getRow3['username']; ?>">
                                            <input type="hidden" id="assessment-title" class="assessment-title" name="assessment_title" value="<?php echo $getRow3['title']; ?>">
                                            <input type="hidden" id="assessment-rate" class="assessment-rate" name="assessment_rate" value="<?php echo $ans = number_format($rowCount / $rowCountOver * 100, 2); ?>">

                                            <!--<div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="mt-3"> <span class="text1">42 Applied <span class="text2">of 70 capacity</span></span> </div> -->
                                            <div class="text-center">
                                                <input type="submit" class="btn btn-custom-primary " value="View Answers">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="assessment-view-title mx-3 mt-2">
            <p onclick="history.back()"><i class="fa-solid fa-arrow-left mt-2"></i></p>
            <h2 class="title text-center">Go Back</h2>
        </div>
        <div class="not-found">
            <p> <img src="assets/img/icons/not-found.png" alt="" height="50%"> No Assessment Taken</p>
        </div>
    <?php } ?>

    <script>
        $(document).ready(function() {

            $(".view-score-card .badge span.percent").each(function() {
                if ($(this).text() > 75.00) {
                    $(this).closest('.badge').find('span:eq(0)').addClass('pass');
                    $(this).closest('.badge').find('span:eq(1)').addClass('pass');
                    $(this).closest('.badge').find('span:eq(2)').addClass('pass');

                } else {
                    $(this).closest('.badge').find('span:eq(0)').addClass('fail');
                    $(this).closest('.badge').find('span:eq(1)').addClass('fail');
                    $(this).closest('.badge').find('span:eq(2)').addClass('fail');


                }
            });
        })
    </script>

    <script>
        $(document).ready(function() {

            $('.view-user-score').submit(function() {

                var user_id = $(this).find('.user-id').val();
                var assessment_id = $(this).find('.assessment-id').val();
                var name = $(this).find('.user-name').val();
                var title = $(this).find('.assessment-title').val();
                var rate = $(this).find('.assessment-rate').val();







                event.preventDefault();


                Swal.fire({
                    title: 'View the answers of ' + name + ' in: <br><b>' + title + '</b>',
                    text: "Do you want to proceed?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, proceed',
                    reverseButtons: true,
                    allowOutsideClick: false,
                    customClass: {
                        confirmButton: 'edit-primary-button'
                    },

                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "GET",
                            data: {
                                user_id: user_id,
                                assessment_id: assessment_id,
                                assessment_title: title
                            },

                            success: function(data) {
                                window.location = 'home-admin.php?subpage=view-user-assessment-scores&user_id=' + user_id + '&assessment_id=' + assessment_id + '&rate=' + rate + '&assessment_title=' + title
                            },
                            error: function(xhr, status, error, data) {




                            }
                        });
                    }
                });

            });
        })
    </script>
</body>

</html>