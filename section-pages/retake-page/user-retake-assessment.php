<?php
if (isset($_GET['assessment_id'])) {

    $user_id =  mysqli_real_escape_string($mysqli, $_SESSION['user_id']);
    $assessment_id =  mysqli_real_escape_string($mysqli, $_GET['assessment_id']);

    $selQuestion = $mysqli->prepare("SELECT * FROM assessment_question_tbl WHERE assessment_id = ?");
    $selQuestion->bind_param('i', $assessment_id);
    $selQuestion->execute();
    $selQuestionRow = $selQuestion->get_result();

    $selDate = $mysqli->prepare("SELECT * FROM assessment_tbl WHERE assessment_id = ?");
    $selDate->bind_param('i', $assessment_id);
    $selDate->execute();
    $selDateRow = $selDate->get_result();

    date_default_timezone_set('Asia/Manila');
    date_default_timezone_set("Asia/Manila");

    $date = null;

    function header_callback($curl, $header)
    {
        global $date;

        if (preg_match('/^Date:/', $header)) {
            $date = trim(substr($header, 5));
        }

        return strlen($header);
    }

    $curl = curl_init("http://www.google.com/");

    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADERFUNCTION, 'header_callback');

    curl_exec($curl);

    curl_close($curl);

    if ($date != NULL) {
        $returnDateSubmit = date("Y-m-d H:i:s",strtotime($date));

    }

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $code = substr(str_shuffle($chars), 0, 8);
}

?>



<section class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h1>Take your Assessment</h1>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container page-container mt-4">

        <form id="retake-assessment-exam" action="javascript:void(0)" class="retake-assessment-exam submit-answer" method="post" novalidate>
            <?php $count = 0; ?>
            <?php $returnDateRow = $selDateRow->fetch_assoc() ?>
            <input type="hidden" name="date_id" id="date-id" value="<?php echo $returnDateRow['deadline']; ?>">
            <input type="hidden" name="date_submit" id="date-submit" value="<?php echo $returnDateSubmit ?>">
            <input type="hidden" name="user-email" id="user-email" value="<?php echo $_SESSION['email'] ?>">
            <input type="hidden" name="first-name" id="first-name" value="<?php echo $_SESSION['fname'] ?>">
            <input type="hidden" name="assessment-title" id="assessment-title" value="<?php echo $returnDateRow['title'] ?>">

            <?php while ($row = $selQuestionRow->fetch_assoc()) { ?>
                <?php $question_id = $row['question_id']; ?>
                <?php $count++ ?>

                <div class="assessment-form mb-5">
                    <div class="row">
                        <div class="col-12">

                            <div class="question-header px-4 py-4">
                                <span>Question <?php echo $count ?></span>
                                <span class="question-point"><?php echo $row['point'] ?> Points</span>
                            </div>
                            <p class=" assessment-question px-4 py-4"><?php echo $row['assessment_question']; ?></p>
                            <div>
                                <?php if ($row['type'] == "Multiple Choice Question") { ?>
                                    <div class="form-group">

                                        <input type="radio" class="one tf-check" name="answer[<?php echo $question_id; ?>] [correct]" id="<?php echo $row['assessment_choice1']; ?> <?php echo $row['question_id']; ?>" value="<?php echo $row['assessment_choice1']; ?>" data-question="<?php echo $row['question_id']; ?>" required>
                                        <label for="<?php echo $row['assessment_choice1']; ?> <?php echo $row['question_id']; ?>" class="answer first">
                                            <div class="course"> <span class="circle"></span> <span class="subject"> <?php echo $row['assessment_choice1']; ?> </span> </div>
                                        </label>

                                        <input type="radio" class="two tf-check" name="answer[<?php echo $question_id; ?>] [correct]" id="<?php echo $row['assessment_choice2']; ?> <?php echo $row['question_id']; ?>" value="<?php echo $row['assessment_choice2']; ?>" data-question="<?php echo $row['question_id']; ?>">
                                        <label for="<?php echo $row['assessment_choice2']; ?> <?php echo $row['question_id']; ?>" class="answer second">
                                            <div class="course"> <span class="circle"></span>
                                                <span class="subject"> <?php echo $row['assessment_choice2']; ?> </span>
                                            </div>
                                        </label>

                                        <input type="radio" class="three tf-check" name="answer[<?php echo $question_id; ?>] [correct]" id="<?php echo $row['assessment_choice3']; ?> <?php echo $row['question_id']; ?>" value="<?php echo $row['assessment_choice3']; ?>" data-question="<?php echo $row['question_id']; ?>">
                                        <label for="<?php echo $row['assessment_choice3']; ?> <?php echo $row['question_id']; ?>" class="answer third">
                                            <div class="course"> <span class="circle"></span> <span class="subject"> <?php echo $row['assessment_choice3']; ?> </span>
                                            </div>
                                        </label>

                                        <input type="radio" class="four tf-check" name="answer[<?php echo $question_id; ?>] [correct]" id="<?php echo $row['assessment_choice4']; ?> <?php echo $row['question_id']; ?>" value="<?php echo $row['assessment_choice4']; ?>" data-question="<?php echo $row['question_id']; ?>">
                                        <label for="<?php echo $row['assessment_choice4']; ?> <?php echo $row['question_id']; ?>" class="answer forth">
                                            <div class="course"> <span class="circle"></span> <span class="subject"> <?php echo $row['assessment_choice4']; ?> </span>
                                            </div>
                                        </label>
                                        <div class="radio-empty pt-4 px-4"></div>
                                    </div>

                                <?php } else if ($row['type'] == "True/False") {  ?>
                                    <div class="form-group">
                                        <input type="radio" class="one tf-check" name="tf_answer[<?php echo $question_id; ?>] [correct]" id="true <?php echo $row['question_id']; ?>" value="True" data-question="<?php echo $row['question_id']; ?>" required>
                                        <label for="true <?php echo $row['question_id']; ?>" class="answer first">
                                            <div class="course"> <span class="circle"></span>
                                                <span class="subject"> True </span>
                                            </div>
                                        </label>
                                        <input type="radio" class="two tf-check" name="tf_answer[<?php echo $question_id; ?>] [correct]" id="false <?php echo $row['question_id']; ?>" value="False" data-question="<?php echo $row['question_id']; ?>">
                                        <label for="false <?php echo $row['question_id']; ?>" class="answer second">
                                            <div class="course"> <span class="circle"></span>
                                                <span class="subject"> False </span>
                                            </div>
                                        </label>
                                        <div class="radio-empty pt-4 px-4"></div>
                                    </div>
                                <?php } else { ?>
                                    <div class="text-answer px-4">
                                        <input type="text" class="form-control" name="text_answer[<?php echo $question_id; ?>] [correct]" data-question="<?php echo $row['question_id']; ?>" required>
                                        <label class="px-4">Answer:</label>
                                        <div class="invalid-feedback"></div>
                                    </div>
                                <?php } ?>
                                <input type="hidden" name="user_id" id="user-id" value="<?php echo $user_id ?>">
                                <input type="hidden" name="assessment_id" id="assessment-id" value="<?php echo $row['assessment_id']; ?>">
                                <input type="hidden" name="question_id" id="question-id" value="<?php echo $row['question_id']; ?>">
                                <input type="hidden" name="institution_id" id="institution-id" value="<?php echo $_SESSION['institution_id']; ?>">
                                <input type="hidden" name="retake-code" id="retake-code" value="<?php echo $code ?>">
                                <input type="hidden" name="point" id="point" value="<?php echo $row['point']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="col-12">
                <div class="d-flex justify-content-center"> <input type="submit" class="btn btn-custom-primary px-4 py-2 fw-bold" value="Submit"> </div>
            </div>
        </form>
    </div>
</section>


<script>
    $(document).ready(function() {

        var yield = $(".point");
        var yieldType = $(".point-name");

        var single = yield.html() === 1;
        $(".point-name").each(function() {


            var option = $(this);
            if (single) {
                option.text(option.attr("data-single"));
            } else {
                option.text(option.attr("data-plural"));
            }
        });
    })
</script>

<script>
    $(document).ready(function() {
        $('.question-point').each(function() {
            if ($(this).text() === '1 Points') {
                $(this).text('1 Point');
            }
        });
    });
</script>