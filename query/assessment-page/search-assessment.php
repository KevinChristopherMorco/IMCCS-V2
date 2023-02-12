<?php
include_once('../../database/config.php');

if (isset($_POST['code'])) {
    $code = mysqli_real_escape_string($mysqli, $_POST['code']);
    $checkCode = $mysqli->prepare("SELECT assessment_code from answer_tbl");
    $checkCode->bind_param('s', $code);
    $checkCode->execute();
    $returncheckCode = $checkCode->get_result();
    $row = $returncheckCode->fetch_assoc();

   /* $count = $row['contact_no_cnt'];

    if ($count > 0) {
       echo json_encode(array("This Number is Already Registered"));
    } else {
       echo json_encode(array("This Number Doesn't Exist"));
    }*/

    die;
 }


?>