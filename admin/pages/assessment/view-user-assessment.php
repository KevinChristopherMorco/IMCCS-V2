<?php $user_id =  mysqli_real_escape_string($mysqli, $_GET['user_id']); ?>
<?php $name =  mysqli_real_escape_string($mysqli, $_GET['fname']); ?>

<?php
/*
$checkAssessmentChosen = mysqli_query($mysqli, "select * FROM assessment_chosen WHERE user_id = '$user_id'");
$rowcount = mysqli_num_rows($checkAssessmentChosen);
*/

$checkAssessmentChosen = $mysqli->prepare("SELECT * FROM assessment_chosen WHERE user_id = ?");
$checkAssessmentChosen->bind_param('i', $user_id);
$checkAssessmentChosen->execute();
$checkAssessmentChosen->store_result();
$rowcount = $checkAssessmentChosen->num_rows;

if ($rowcount > 0) {



    $queryScore = $mysqli->prepare("SELECT * FROM assessment_score WHERE user_id= ?");
    $queryScore->bind_param('i', $user_id);
    $queryScore->execute();
    $resultScore = $queryScore->get_result();
    $score = $resultScore->fetch_assoc();

    $selOver = $mysqli->prepare("SELECT SUM(answer.point) as point  FROM assessment_question_tbl question INNER JOIN answer_tbl answer ON question.question_id = answer.question_id  WHERE question.assessment_id= answer.assessment_id AND answer.user_id= ? ");
    $selOver->bind_param('i', $user_id);
    $selOver->execute();
    $resultOver = $selOver->get_result();
    $returnCountOver = $resultOver->fetch_assoc();

    $ans = number_format($score['assessment_score'] / $returnCountOver['point'] * 100, 2);
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
    </style>
</head>

<body>
    <?php if ($rowcount > 0) { ?>
        <input type="hidden" id="assessment-retake-view" value="<?php echo $user_id ?>">
        <input type="hidden" id="assessment-name-view" value="<?php echo $name ?>">

        <div class="container mt-5 mb-3">
        <nav class="assessment-breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb mt-4">
                <li class="breadcrumb-item"><a href="home-admin.php?page=manage-users">Manage Users</a></li>
                <li class="breadcrumb-item active"><a href="#"><?php echo $name ?>'s Finished Assessments</a></li>
            </ol>
        </nav>

            <ul class="nav nav-pills nav-fill pb-4">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="pill" aria-current="page" href="#user-assessment"><i class="fa-solid fa-file-circle-check"></i>Pre Assessments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="pill" href="#user-retake"><i class="fa-solid fa-clipboard-question"></i>Post Assessments</a>
                </li>
            </ul>

            <div class="tab-content">
                <div id="user-assessment" class="tab-pane assessment-section fade in active show">
                    <div class="row">
                        <?php

                        $selUserAssessment = $mysqli->prepare("SELECT * FROM  assessment_chosen chosen WHERE  chosen.user_id = ? ");
                        $selUserAssessment->bind_param('i', $user_id);
                        $selUserAssessment->execute();
                        $getUserAssessment = $selUserAssessment->get_result();

                        while ($returnUserAssessment = $getUserAssessment->fetch_assoc()) { ?>
                            <?php
                            $userID = $returnUserAssessment['user_id'];
                            $assessmentID = $returnUserAssessment['assessment_id'];

                            $selAssessment = $mysqli->prepare("SELECT * FROM assessment_tbl assessment INNER JOIN assessment_chosen answer ON assessment.assessment_id=answer.assessment_id  INNER JOIN user_tbl user  ON user.user_id=answer.user_id INNER JOIN student_faculty_profile_tbl prfl ON user.user_id=prfl.user_id WHERE  answer.user_id= ? AND assessment.assessment_id= ?");
                            $selAssessment->bind_param('ii', $userID, $assessmentID);
                            $selAssessment->execute();
                            $getAssessment = $selAssessment->get_result();
                            $returnAssessment = $getAssessment->fetch_assoc();

                            $selQueryScore = $mysqli->prepare("SELECT * FROM assessment_score WHERE user_id= ? AND assessment_id = ?");
                            $selQueryScore->bind_param('ii', $userID, $assessmentID);
                            $selQueryScore->execute();
                            $getQueryScore = $selQueryScore->get_result();
                            $returnRowScore = $getQueryScore->fetch_assoc();


                            $selScoreOver = $mysqli->prepare("SELECT SUM(point) as point FROM answer_tbl WHERE  assessment_id = ? AND user_id = ?");
                            $selScoreOver->bind_param('ii', $assessmentID, $user_id);
                            $selScoreOver->execute();
                            $getScoreOver = $selScoreOver->get_result();
                            $returnScoreOver = $getScoreOver->fetch_assoc();
                            ?>


                            <div class="col-lg-4">
                                <div class="topic-assessment-container mb-4" id="">
                                    <div class="topic-assessment-card">
                                        <img src="assets/img/<?php echo $returnAssessment['question_img'] ?>" onerror="this.src='assets/images/card/no-img.png'" />
                                        <div class="card-details">
                                            <div class="tags">
                                                <span title="Total Score" class="tag due"><i class="fa-solid fa-star"></i> <?php echo $returnRowScore['assessment_score'] ?>
                                                    /
                                                    <?php echo $returnScoreOver['point'] ?></span>
                                                <span title="Score Percentage" class="tag percent"><i class="fa-solid fa-percent"></i><?php echo $ans = number_format($returnRowScore['assessment_score'] / $returnScoreOver['point'] * 100, 2); ?></span>

                                            </div>
                                            <!-- A div with name class for the name of the card -->
                                            <div class="name"><?php echo $returnAssessment['title'] ?></div>
                                            <p class="mt-4 mb-4"><?php echo $returnAssessment['description'] ?></p>
                                            <form class="view-user-score" action="javascript:void(0)" method="GET">
                                                <input type="hidden" id="assessment-id" class="assessment-id" name="assessment_id" value="<?php echo $returnAssessment['assessment_id']; ?>">
                                                <input type="hidden" id="user-name" class="user-name" name="user_name" value="<?php echo $returnAssessment['username']; ?>">
                                                <input type="hidden" id="assessment-title" class="assessment-title" name="assessment_title" value="<?php echo $returnAssessment['title']; ?>">
                                                <input type="hidden" id="assessment-rate" class="assessment-rate" name="assessment_rate" value="<?php echo $ans = number_format($returnRowScore['assessment_score'] / $returnScoreOver['point']  * 100, 2); ?>">
                                                <input type="hidden" id="fname" class="assessment-fname" name="fname" value="<?php echo $name?>">

                                                <div class="btn-topic-assessment-container">
                                                    <input type="submit" class="ch-topic-assessment-btn" value="View">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        <?php } ?>

                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#retake-user-view').on('change', function() {
                            var conceptName = $('#retake-user-view').find(":selected").val();
                            var user_id = $('#assessment-retake-view').val();
                            var name = $('#assessment-name-view').val();


                            $.ajax({
                                type: "POST",
                                url: "query/assessment-retake/retake-user-view.php",
                                data: {
                                    selected: conceptName,
                                    user_id: user_id,
                                    name: name
                                },
                                success: function(data) {

                                    $('.response-holder').html(data);
                                },
                                error: function(data) {

                                }
                            });
                        });
                    });
                </script>

                <div id="user-retake" class="tab-pane retake-section fade in">
                    <?php
                    $selQuestion = "SELECT * FROM assessment_tbl as assessment ";
                    $selQuestionRow = mysqli_query($mysqli, $selQuestion);
                    ?>
                    <select class="form-select mb-4" name="retake-user-view" id="retake-user-view">
                        <option value="" disabled selected>Please select an assessment</option>

                        <?php while ($row = mysqli_fetch_assoc($selQuestionRow)) { ?>
                            <option value="<?php echo  $row['assessment_id'] ?>"><?php echo $row['title'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="response-holder">

                        <div class="not-found">
                            <p> <img src="assets/img/icons/find.png" alt="" height="50%">Choose an assessment</p>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    <?php } else { ?>
        <nav class="assessment-breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb mt-4">
                <li class="breadcrumb-item"><a href="home-admin.php?page=manage-users">Manage Users</a></li>
                <li class="breadcrumb-item active"><a href="#"><?php echo $name ?>'s Finished Assessments</a></li>
            </ol>
        </nav>

        <div class="not-found">
            <p> <img src="assets/img/icons/no-data.png" alt="" height="50%"> No Assessment Taken</p>
        </div>
    <?php } ?>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '.view-user-score', function() {

                //  var user_id = $(this).find('input[name=users-id]').val();
                var user_id = '<?php echo ($user_id); ?>'
                var assessment_id = $(this).find('.assessment-id').val();
                var name = $(this).find('.user-name').val();
                var title = $(this).find('.assessment-title').val();
                var rate = $(this).find('.assessment-rate').val();
                var fname = $(this).find('.assessment-fname').val();




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
                                window.location = 'home-admin.php?subpage=view-user-assessment-scores&user_id=' + user_id + '&assessment_id=' + assessment_id + '&rate=' + rate + '&assessment_title=' + title + '&fname=' + fname
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