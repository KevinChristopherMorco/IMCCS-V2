<?php
include_once('../../database/config.php');
session_start();
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
    $returnDateSubmit = date("Y-m-d H:i:s", strtotime($date));
}



$query = " SELECT * FROM assessment_tbl assessment WHERE NOT EXISTS (SELECT 1 FROM assessment_chosen chosen WHERE assessment.assessment_id = chosen.assessment_id AND chosen.user_id = '" . $_SESSION['user_id'] . "')";



/*
$checkAssessmentChosen = "SELECT * FROM assessment_chosen WHERE user_id = '" .$_SESSION['user_id']."' ";
$selAssessmentChosen = mysqli_query($mysqli, $checkAssessmentChosen);
$rowcountss = mysqli_num_rows($selAssessmentChosen);
*/

if (isset($_POST["difficulty"])) {
    $difficulty_filter = implode("','", $_POST["difficulty"]);
    $query .= " AND difficulty IN('" . $difficulty_filter . "')";
}
if (isset($_POST["time"])) {
    $time = implode("','", $_POST["time"]);
    $query .= " AND unit_time IN('" . $time . "')";
}
?>

<?php
$selAssessmentRow = mysqli_query($mysqli, $query);
mysqli_fetch_all($selAssessmentRow, MYSQLI_ASSOC);
$rowcount = mysqli_num_rows($selAssessmentRow);
if ($rowcount > 0) {
    foreach ($selAssessmentRow as $row) { ?>
        <?php
        date_default_timezone_set('Asia/Manila');
        $dateDeadline =  $row['deadline'];
        //Date for database
        $returnDateDeadline = date('Y-m-d H:i:s', strtotime($dateDeadline));

        $dateDeadlineDisplay =  $row['deadline'];
        //Date for database
        $returnDateDeadlineDisplay = date('F j Y h:i A', strtotime($dateDeadlineDisplay));
        ?>
        <div class="col-lg-6">
            <div class="topic-assessment-container mb-4" id="">
                <div class="topic-assessment-card">
                    <img src="admin/assets/img/<?php echo $row['question_img'] ?>" onerror="this.src='assets/images/card/no-img.png'" />

                    <div class="card-details">
                        <div class="">
                            <span title="Difficulty" class="tag"><i class="fa-solid fa-star"></i> <?php echo $row['difficulty'] ?></span>
                            <span title="Recommended Completion Time" class="tag time"><i class="fa-solid fa-clock"></i> <?php echo $row['estimated_time'] ?> <?php echo $row['unit_time'] ?></span>
                            <span title="Due Date" class="tag due"><i class="fa-solid fa-calendar-days"></i> <?php echo $returnDateDeadlineDisplay ?></span>
                        </div>
                        <!-- A div with name class for the name of the card -->
                        <div class="name"><?php echo $row['title'] ?></div>

                        <p class="mt-4 mb-4"><?php echo $row['description'] ?></p>

                        <form id="insert-chosen-assessment" class="insert-chosen-assessment" method="GET">
                            <input type="hidden" name="" id="user-id" value="<?php echo $_SESSION['user_id'] ?>">
                            <input type="hidden" name="assessment-id" id="assessment-id" value="<?php echo $row['assessment_id'] ?>">
                            <input type="hidden" name="date-deadline" id="date-deadline" value="<?php echo $returnDateDeadline ?>">
                            <input type="hidden" name="date-submit" id="date-submit" value="<?php echo $returnDateSubmit ?>">
                            <input type="hidden" name="user-email" id="user-email" value="<?php echo $_SESSION['email'] ?>">
                            <div class="btn-topic-assessment-container">
                                <input type="submit" class="ch-topic-assessment-btn" value="Take Assessment">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php }
} else { ?>
    <div class="text-center mt-4">
        <p class="chosen-empty"><img src="assets/images/icons/search-gif.gif" width="50" height="50" alt="">No available pre assessments yet</p>
        <p class="chosen-suggestion mt-2">Please wait for more upcoming assessments!</p>
    </div>
<?php  }
?>
<script>
    $('.insert-chosen-assessment').submit(function(event) {
        event.preventDefault();


        var user_id = $('#user-id').val();
        var date_deadline = $('#date-deadline').val();
        var date_submit = $('#date-submit').val();

        var assessment_id = $(this).closest('form').find('input[name=assessment-id]').val();
        var date_deadline = $(this).closest('form').find('input[name=date-deadline]').val();





        Swal.fire({
            title: 'Do you want to choose this Assessment?',
            text: "Press CONFIRM to proceed!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'CONFIRM',
            reverseButtons: true,
            allowOutsideClick: false,
            customClass: {
                confirmButton: 'edit-primary-button'
            },

        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "GET",
                    url: "query/assessment-page/user-save-assessment.php",
                    data: {
                        user_id: user_id,
                        assessment_id: assessment_id,
                        date_deadline: date_deadline,
                        date_submit,
                        date_submit


                    },
                    dataType: 'json',

                    success: function(data) {
                        if (data == 'You have already taken this topic') {
                            Swal.fire({
                                title: 'You have already taken this Assessment!',
                                text: "Please choose another one",
                                icon: 'warning',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            })
                        } else if (data == 'Not Active') {
                            Swal.fire({
                                title: 'This Assessment is not active!',
                                text: "Please contact the administrator for further details",
                                icon: 'warning',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            })
                        } else if (data == 'exceed') {
                            Swal.fire({
                                title: 'This assessment is overdue!',
                                text: "Please contact the administrator for further details",
                                icon: 'warning',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            })

                        } else if (data == 'Retake') {

                            window.location = 'home-student.php?page=user-retake-assessment&assessment_id=' + assessment_id;


                        } else {
                            window.location = 'home-student.php?page=user-progress-assessment&assessment_id=' + assessment_id;

                        }
                    },
                    error: function(xhr, status, error) {


                    }
                });
            }
        });

    });
</script>