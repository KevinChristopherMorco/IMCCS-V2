<?php
include_once('../../database/config.php');

if (isset($_POST['assessment_code'])) {
    $assessment_code = mysqli_real_escape_string($mysqli, $_POST['assessment_code']);
    $user_id = mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $institution_id = mysqli_real_escape_string($mysqli, $_POST['institution_id']);

    $checkCode = $mysqli->prepare("SELECT assessment_code, count(*) as count_code  from assessment_chosen WHERE user_id = ? AND institution_id = ? AND assessment_code = ?");
    $checkCode->bind_param('sss', $user_id, $institution_id, $assessment_code);
    $checkCode->execute();
    $returncheckCode = $checkCode->get_result();
    $row = $returncheckCode->fetch_assoc();

    $count = $row['count_code'];


    if ($count > 0) {
        echo 'Valid';
    } else {
        echo 'Invalid';
    }

    die;
}
