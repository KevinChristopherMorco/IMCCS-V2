<?php include_once('../../database/config.php'); ?>

<?php
if (isset($_GET['user_id'])) {

    $user_id =  mysqli_real_escape_string($mysqli, $_GET['user_id']);
    $assessment_id =  mysqli_real_escape_string($mysqli, $_GET['assessment_id']);
    $date_deadline =  mysqli_real_escape_string($mysqli, $_GET['date_deadline']);
    $date_submit =  mysqli_real_escape_string($mysqli, $_GET['date_submit']);
    /*
    $checkAssessment = mysqli_query($mysqli, "SELECT assessment_id, user_id from assessment_chosen WHERE user_id='$user_id' AND assessment_id='$assessment_id'");
    $checkAssessmentStatus = mysqli_query($mysqli, "SELECT * from assessment_tbl WHERE status = 'Active' AND assessment_id='$assessment_id'");
    $checkAssessmentRetake = mysqli_query($mysqli, "SELECT * from assessment_tbl WHERE retake = 'Yes' AND assessment_id='$assessment_id'");
*/

    $checkAssessment = $mysqli->prepare("SELECT assessment_id, user_id from assessment_chosen WHERE user_id=? AND assessment_id=?");
    $checkAssessment->bind_param('ii', $user_id, $assessment_id);
    $checkAssessment->execute();
    $returnCheckAssessment = $checkAssessment->get_result();

    $checkAssessmentStatus = $mysqli->prepare("SELECT * from assessment_tbl WHERE status = 'Active' AND assessment_id=?");
    $checkAssessmentStatus->bind_param('i', $assessment_id);
    $checkAssessmentStatus->execute();
    $returnCheckAssessmentStatus = $checkAssessmentStatus->get_result();

    $checkAssessmentRetake = $mysqli->prepare("SELECT * from assessment_tbl WHERE retake = 'Yes' AND assessment_id=?");
    $checkAssessmentRetake->bind_param('i', $assessment_id);
    $checkAssessmentRetake->execute();
    $returnCheckAssessmentRetake = $checkAssessmentRetake->get_result();



    if ($returnCheckAssessment->num_rows == 0) {
        if ($returnCheckAssessmentStatus->num_rows == 1) {
            if ($date_deadline < $date_submit) {
                echo json_encode(array("exceed"));
            } else {
                echo json_encode(array("TakeNow"));
            }
        } else {
            echo json_encode(array("Not Active"));
        }
    } else if ($returnCheckAssessment->num_rows > 0) {
        if ($returnCheckAssessmentRetake->num_rows == 1) {
            echo json_encode(array("Retake"));
        } else {
            echo json_encode(array("You have already taken this topic"));
        }
    } else {

        echo json_encode(array("You have already taken this topic"));
    }
}
mysqli_close($mysqli);
?>