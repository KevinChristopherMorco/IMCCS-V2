<?php include_once('../../../database/config.php'); ?>

<?php

$title =   mysqli_real_escape_string($mysqli, $_POST['title']);
$description =  mysqli_real_escape_string($mysqli, $_POST['description']);
$difficulty =  mysqli_real_escape_string($mysqli, $_POST['difficulty']);
$estimated_time =  mysqli_real_escape_string($mysqli, $_POST['estimated_time']);
$deadline =  mysqli_real_escape_string($mysqli, $_POST['deadline']);
$unit_time =  mysqli_real_escape_string($mysqli, $_POST['unit_time']);
$rate =  mysqli_real_escape_string($mysqli, $_POST['rate']);
$status =  mysqli_real_escape_string($mysqli, $_POST['status']);
$retake =  mysqli_real_escape_string($mysqli, $_POST['retake']);
$pic = ($_FILES['img']['name']);


date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d H:i:s");

/*
$sql = "INSERT INTO assessment_tbl(title, description, difficulty, estimated_time, unit_time, passing_rate, deadline,  question_img, status, retake, created_at)
	VALUES ('$title','$description','$difficulty','$estimated_time','$unit_time','$rate','$deadline','$pic','$status','$retake','$timestamp')";


$dir = "../assets/img/";
$imagelocation = $dir . basename($_FILES['img']['name']);
$extension = pathinfo($imagelocation, PATHINFO_EXTENSION);
if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
    echo "Upload only jpg,jpeg And png";
} else {
    if (move_uploaded_file($_FILES['img']['tmp_name'], $imagelocation)) {
        if (mysqli_query($mysqli, $sql)) {
            echo json_encode(array("statusCode" => 200));
        }
    } else {

        echo "ERROR";
    }

}*/


if ($stmt = $mysqli->prepare("INSERT INTO assessment_tbl(title, description, difficulty, estimated_time, unit_time, passing_rate, deadline,  question_img, status, retake, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {

    $stmt->bind_param("sssssssssss", $title, $description, $difficulty, $estimated_time, $unit_time, $rate, $deadline, $pic, $status, $retake, $timestamp);
    $stmt->execute();

    $dir = "../../assets/img/";
    $imagelocation = $dir . basename($_FILES['img']['name']);
    $extension = pathinfo($imagelocation, PATHINFO_EXTENSION);

    if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
        echo "Upload only jpg,jpeg And png";
    }else{
        move_uploaded_file($_FILES['img']['tmp_name'], $imagelocation);
        echo json_encode(array("statusCode" => 200));

    }
} else {

    echo json_encode(array("statusCode" => 201));
}


mysqli_close($mysqli);


?>