<?php include_once('../../../database/config.php'); ?>

<?php

$title =   mysqli_real_escape_string($mysqli, $_POST['title']);
$description =  mysqli_real_escape_string($mysqli, $_POST['description']);
$difficulty =  mysqli_real_escape_string($mysqli, $_POST['difficulty']);
$estimated_time =  mysqli_real_escape_string($mysqli, $_POST['estimated_time']);
$unit_time =  mysqli_real_escape_string($mysqli, $_POST['unit_time']);

$lesson_paragraph = mysqli_real_escape_string($mysqli, $_POST['lesson_paragraph']);
$status = mysqli_real_escape_string($mysqli, $_POST['status']);
$pic = ($_FILES['img']['name']);

date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d H:i:s");

/*
$sql = "INSERT INTO lesson_tbl(title, description, difficulty, estimated_time, unit_time, lesson_paragraph,status, lesson_img, created_at)
	VALUES ('$title','$description','$difficulty','$estimated_time','$unit_time','$lesson_paragraph','$status','$pic','$timestamp')";


$dir = "../assets/img/";
$imagelocation = $dir . basename($_FILES['img']['name']);
$extension = pathinfo($imagelocation, PATHINFO_EXTENSION);
if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
    echo "plzz upload only jpg,jpeg And png";
} else {
    if (move_uploaded_file($_FILES['img']['tmp_name'], $imagelocation)) {
        if (mysqli_query($mysqli, $sql)) {
            echo json_encode(array("statusCode" => 200));
        }
    } else {

        echo "ERROR";
    }
}
*/

if ($stmt = $mysqli->prepare("INSERT INTO lesson_tbl(title, description, difficulty, estimated_time, unit_time, lesson_paragraph,status, lesson_img, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")) {

    $stmt->bind_param("sssssssss", $title, $description, $difficulty, $estimated_time, $unit_time, $lesson_paragraph, $status, $pic, $timestamp);
    $stmt->execute();

    $dir = "../../assets/img/";
    $imagelocation = $dir . basename($_FILES['img']['name']);
    $extension = pathinfo($imagelocation, PATHINFO_EXTENSION);
    if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
        echo "plzz upload only jpg,jpeg And png";
    }
    else {
        move_uploaded_file($_FILES['img']['tmp_name'], $imagelocation);
        echo json_encode(array("statusCode" => 200));
    }
    if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
        echo "Upload only jpg,jpeg And png";
    } else {
        move_uploaded_file($_FILES['img']['tmp_name'], $imagelocation);
        echo json_encode(array("statusCode" => 200));
    }
} else {

    echo json_encode(array("statusCode" => 201));
}



mysqli_close($mysqli);


?>