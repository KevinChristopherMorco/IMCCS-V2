<?php
include_once('../database/config.php');

$fullname =  mysqli_real_escape_string($mysqli, $_POST['fullname']);
$email =  mysqli_real_escape_string($mysqli, $_POST['email']);
$mobile_no =  mysqli_real_escape_string($mysqli, $_POST['mobile_no']);
$feedback_message =   mysqli_real_escape_string($mysqli, $_POST['feedback_message']);

/*
$sql = "INSERT INTO feedbacks(fullname, email, mobile_no, feedback_message)
	VALUES ('$fullname','$email','$mobile_no','$feedback_message')";
if (mysqli_query($mysqli, $sql)) {
    echo json_encode(array("Feedback Added"));
} else {
    echo json_encode(array("Feedback Not Added"));
}*/


$stmt = $mysqli->prepare("INSERT INTO feedbacks(fullname, email, mobile_no, feedback_message) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $fullname, $email, $mobile_no, $feedback_message);
$stmt->execute();

echo json_encode(array("Feedback Added"));

mysqli_close($mysqli);
