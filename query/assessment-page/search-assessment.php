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

    $count1 = $row['count_code'];


    $checkCode2 = $mysqli->prepare("SELECT COUNT(*) as count_code FROM retake_chosen_tbl WHERE user_id = ? AND institution_id = ? AND code = ?");
    $checkCode2->bind_param('sss', $user_id, $institution_id, $assessment_code);
    $checkCode2->execute();
    $returncheckCode2 = $checkCode2->get_result();
    $row2 = $returncheckCode2->fetch_assoc();
    $count2 = $row2['count_code'];

/*
    if ($count1 > 0) {
        echo 'Valid';
    } else {
        echo 'Invalid';
    }

    */

    if ($count1 > 0 && $count2 == 0) {
        echo 'Valid';
    } elseif ($count1 == 0 && $count2 > 0) {
        echo 'Valids';
    } elseif ($count1 > 0 && $count2 > 0) {
        echo 'Valid in both tables';
    } else {
        echo 'Invalid';
    }

    die;
}
