<?php
$selTopic = $mysqli->prepare("SELECT * FROM lesson_tbl as lesson INNER JOIN topic_chosen as chosen ON lesson.lesson_id = chosen.lesson_id AND chosen.user_id = ? AND chosen.status = 'inprogress'");
$selTopic->bind_param('i', $_SESSION['user_id']);
$selTopic->execute();
$selTopicRow = $selTopic->get_result();
$countTopicRow = $selTopicRow->num_rows;
?>

<?php
$selCompleteTopic = $mysqli->prepare("SELECT * FROM lesson_tbl as lesson INNER JOIN topic_chosen as chosen ON lesson.lesson_id = chosen.lesson_id AND chosen.user_id = ? AND chosen.status = 'completed'");
$selCompleteTopic->bind_param('i', $_SESSION['user_id']);
$selCompleteTopic->execute();
$selCompleteTopicRow = $selCompleteTopic->get_result();
$countCompleteTopicRow = $selCompleteTopicRow->num_rows;
?>

<?php
$assessment = $mysqli->prepare("SELECT * FROM assessment_tbl as assessment INNER JOIN assessment_chosen as chosen ON assessment.assessment_id = chosen.assessment_id AND chosen.user_id = ?");
$assessment->bind_param('i', $_SESSION['user_id']);
$assessment->execute();
$assessmentRow = $assessment->get_result();
$countAssessmentRow = $assessmentRow->num_rows;
?>

<?php
$selRetake = $mysqli->prepare("SELECT * FROM assessment_tbl as assessment INNER JOIN retake_chosen_tbl as chosen ON assessment.assessment_id = chosen.assessment_id AND chosen.user_id = ? group by chosen.assessment_id");
$selRetake->bind_param('i', $_SESSION['user_id']);
$selRetake->execute();
$selRetakeRow = $selRetake->get_result();
$countRetakeRow = $selRetakeRow->num_rows;
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

<section class="get-started">
    <div class="intro">
        <h2> Let's Get Started! </h2>
        <p class="lead mb-4"> IMCCS is an interactive system that provides cybersecurity quiz assessments and top of that, we offer topics that are relevant on todays time </p>
    </div>
</section>

<section class="my-chosen-topic">
    <div class="chosen-topic-title">
        <p class="chosen-title mb-4"> My Chosen Topics </p>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" aria-current="page" href="#topic-progress">In-progress</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#topic-complete">Completed</a>
            </li>
        </ul>
    </div>
    <div class="my-chosen-content">
        <div class="tab-content">
            <div id="topic-progress" class="tab-pane main-topic-section fade in active show">
                <?php if ($countTopicRow != 0) { ?>

                    <div class="paginate 1">
                        <div class="row items">
                            <?php while ($row = $selTopicRow->fetch_assoc()) { ?>
                                <div class="col-md-12 col-lg-4">
                                    <div class="topic-assessment-container mb-4" id="">
                                        <div class="topic-assessment-card">
                                            <img src="admin/assets/img/<?php echo $row['lesson_img'] ?>" onerror="this.src='assets/images/card/no-img.png'" />

                                            <div class="card-details">
                                                <div class="">
                                                    <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> <?php echo $row['difficulty'] ?></span>
                                                    <span title="Recommended Completion Time" class="tag"><i class="fa-solid fa-clock"></i> <?php echo $row['estimated_time'] ?> <?php echo $row['unit_time'] ?></span>
                                                </div>
                                                <!-- A div with name class for the name of the card -->
                                                <div class="name"><?php echo $row['title'] ?></div>

                                                <p class="mt-4 mb-4"><?php echo $row['description'] ?></p>

                                                <form id="view-chosen-lesson" class="view-chosen-lesson" method="GET">
                                                    <input type="hidden" name="title" class="title" id="title" value="<?php echo $row['title'] ?>">
                                                    <input type="hidden" name="lesson-id" class="lesson-id" id="lesson-id" value="<?php echo $row['lesson_id'] ?>">
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
                        <div class="pager-container" style="background-color: #F2F2F2;">
                            <div class="pager">
                                <div class="lastPage pagination"><i class="fa-solid fa-angles-right"></i></div>
                                <div class="nextPage pagination"><i class="fa-solid fa-angle-right"></i></div>

                                <div class="pageNumbers"></div>
                                <div class="previousPage pagination"><i class="fa-solid fa-angle-left"></i></div>
                                <div class="firstPage pagination"><i class="fa-solid fa-angles-left"></i></div>


                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="text-center mt-4">
                    <p class="chosen-empty"><img src="assets/images/icons/search-gif.gif" width="50" height="50" alt=""> Looks like you haven't started any topics yet!</p>
                        <p class="chosen-suggestion mt-2">Choose now from our topic catalog!</p>
                        <a href="home-student.php?page=user-browse-topics" class="btn btn-custom-primary mt-4" style="border-radius: 20px;">Browse Topics</a>
                    </div>
                <?php } ?>
            </div>

            <div id="topic-complete" class="tab-pane main-topic-section fade in">
                <?php if ($countCompleteTopicRow != 0) { ?>

                    <div class="paginate 1">
                        <div class="row items">
                            <?php while ($row = $selCompleteTopicRow->fetch_assoc()) { ?>
                                <div class="col-lg-4">
                                    <div class="topic-assessment-container mb-4" id="">
                                        <div class="topic-assessment-card">
                                            <img src="admin/assets/img/<?php echo $row['lesson_img'] ?>" onerror="this.src='assets/images/card/no-img.png'" />

                                            <div class="card-details">
                                                <div class="">
                                                    <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> <?php echo $row['difficulty'] ?></span>
                                                    <span title="Recommended Completion Time" class="tag"><i class="fa-solid fa-clock"></i> <?php echo $row['estimated_time'] ?> <?php echo $row['unit_time'] ?></span>
                                                </div>
                                                <!-- A div with name class for the name of the card -->
                                                <div class="name"><?php echo $row['title'] ?></div>

                                                <p class="mt-4 mb-4"><?php echo $row['description'] ?></p>

                                                <form id="view-chosen-lesson" class="view-chosen-lesson" method="GET">
                                                    <input type="hidden" name="title" class="title" id="title" value="<?php echo $row['title'] ?>">
                                                    <input type="hidden" name="lesson-id" class="lesson-id" id="lesson-id" value="<?php echo $row['lesson_id'] ?>">
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
                        <div class="pager-container" style="background-color: #F2F2F2;">
                            <div class="pager">
                                <div class="lastPage pagination"><i class="fa-solid fa-angles-right"></i></div>
                                <div class="nextPage pagination"><i class="fa-solid fa-angle-right"></i></div>

                                <div class="pageNumbers"></div>
                                <div class="previousPage pagination"><i class="fa-solid fa-angle-left"></i></div>
                                <div class="firstPage pagination"><i class="fa-solid fa-angles-left"></i></div>


                            </div>
                        </div>
                    </div>
            </div>
        <?php } else { ?>
            <div class="text-center mt-4">
                <p class="chosen-empty"><img src="assets/images/icons/search-gif.gif" width="50" height="50" alt=""> Looks like you haven't completed any topics yet</p>
                <p class="chosen-suggestion mt-2">Just take your time and learn at your own pace!</p>
            </div>
        <?php } ?>
        </div>
    </div>

    </div>


</section>

<section class="my-chosen-assessment">
    <div class="chosen-assessment-title">
        <p class="chosen-title mb-4"> My Chosen Assessments </p>

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" aria-current="page" href="#assessment-progress">Completed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#assessment-complete">Post Assessment</a>
            </li>
        </ul>
    </div>

    <div class="my-chosen-content">
        <div class="tab-content">
            <div id="assessment-progress" class="tab-pane main-topic-section fade in active show">
                <?php if ($countAssessmentRow != 0) { ?>

                    <div class="paginate 2">
                        <div class="row items">
                            <?php while ($row = $assessmentRow->fetch_assoc()) { ?>

                                <?php
                                date_default_timezone_set('Asia/Manila');
                                $dateDeadline =  $row['deadline'];
                                //Date for database
                                $returnDateDeadline = date('Y-m-d H:i:s', strtotime($dateDeadline));

                                $dateDeadlineDisplay =  $row['deadline'];
                                //Date for database
                                $returnDateDeadlineDisplay = date('M j Y h:i A', strtotime($dateDeadlineDisplay));
                                ?>
                                <div class="col-lg-4">
                                    <div class="topic-assessment-container mb-4">
                                        <div class="topic-assessment-card">
                                            <img src="admin/assets/img/<?php echo $row['question_img'] ?>" onerror="this.src='assets/images/card/no-img.png'" />

                                            <div class="card-details">
                                                <div class="">
                                                    <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> <?php echo $row['difficulty'] ?></span>
                                                    <span title="Recommended Completion Time" class="tag"><i class="fa-solid fa-clock"></i> <?php echo $row['estimated_time'] ?> <?php echo $row['unit_time'] ?></span>
                                                    <span title="Due Date" class="tag"><i class="fa-solid fa-calendar-days"></i> <?php echo $returnDateDeadlineDisplay ?></span>
                                                </div>
                                                <!-- A div with name class for the name of the card -->
                                                <div class="name"><?php echo $row['title'] ?></div>

                                                <p class="mt-4 mb-4"><?php echo $row['description'] ?></p>

                                                <form id="view-chosen-assessment" class="view-chosen-assessment" method="GET">
                                                    <input type="hidden" name="assessment-id" id="assessment-id" value="<?php echo $row['assessment_id'] ?>">
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
                        <div class="pager-container" style="background-color: #F2F2F2;">
                            <div class="pager">
                                <div class="lastPage pagination"><i class="fa-solid fa-angles-right"></i></div>
                                <div class="nextPage pagination"><i class="fa-solid fa-angle-right"></i></div>

                                <div class="pageNumbers"></div>
                                <div class="previousPage pagination"><i class="fa-solid fa-angle-left"></i></div>
                                <div class="firstPage pagination"><i class="fa-solid fa-angles-left"></i></div>


                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="text-center mt-4">
                        <p class="chosen-empty"><img src="assets/images/icons/search-gif.gif" width="50" height="50" alt=""> Looks like you haven't taken any assessments yet</p>
                        <p class="chosen-suggestion mt-2">Choose now from our assessments page!</p>
                        <a href="home-student.php?page=user-browse-assessment" class="btn btn-custom-primary mt-4" style="border-radius: 20px;">Browse Assessments</a>
                    </div>
                <?php } ?>
            </div>
            <div id="assessment-complete" class="tab-pane main-topic-section fade in">
                <?php if ($countRetakeRow != 0) { ?>
                    <div class="paginate 3">
                        <div class="row items">

                            <?php while ($row2 = $selRetakeRow->fetch_assoc()) { ?>

                                <div class="col-lg-4">
                                    <div class="topic-assessment-container mb-4" id="">
                                        <div class="topic-assessment-card">
                                            <img src="admin/assets/img/<?php echo $row2['question_img'] ?>" onerror="this.src='assets/images/card/no-img.png'" />

                                            <div class="card-details">
                                                <div class="">
                                                    <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> <?php echo $row2['difficulty'] ?></span>
                                                    <span title="Recommended Completion Time" class="tag"><i class="fa-solid fa-clock"></i> <?php echo $row2['estimated_time'] ?> <?php echo $row2['unit_time'] ?></span>
                                                    <span title="Due Date" class="tag"><i class="fa-solid fa-calendar-days"></i> <?php echo $returnDateDeadlineDisplay ?></span>
                                                </div>
                                                <!-- A div with name class for the name of the card -->
                                                <div class="name"><?php echo $row2['title'] ?></div>

                                                <p class="mt-4 mb-4"><?php echo $row2['description'] ?></p>

                                                <form id="view-retake-assessment" class="view-retake-assessment" method="GET">
                                                    <input type="hidden" name="assessment-id" id="assessment-id" value="<?php echo $row2['assessment_id'] ?>">
                                                    <input type="hidden" name="retake-code" id="retake-code" value="<?php echo $row2['code'] ?>">

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
                        <div class="pager-container" style="background-color: #F2F2F2;">
                            <div class="pager">
                                <div class="lastPage pagination"><i class="fa-solid fa-angles-right"></i></div>
                                <div class="nextPage pagination"><i class="fa-solid fa-angle-right"></i></div>

                                <div class="pageNumbers"></div>
                                <div class="previousPage pagination"><i class="fa-solid fa-angle-left"></i></div>
                                <div class="firstPage pagination"><i class="fa-solid fa-angles-left"></i></div>


                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="text-center mt-4">
                        <p class="chosen-empty"><img src="assets/images/icons/search-gif.gif" width="50" height="50" alt=""> Looks like you haven't taken any retake assessments yet</p>
                        <p class="chosen-suggestion mt-2"><b>Note:</b> You can only take retakes if your chosen assessments are available for retakes!</p>
                    </div>
                <?php } ?>
            </div>
        </div>

</section>
<script>
    $(function() {
        $(".paginate").paginga({
            // use default options
        });

        $(".paginate-page-2").paginga({
            page: 2
        });

        $(".paginate-no-scroll").paginga({
            scrollToTop: false
        });
    });
</script>