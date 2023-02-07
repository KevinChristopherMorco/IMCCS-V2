<?php include_once('../../../database/config.php'); ?>

<?php
if (isset($_POST['lesson_id'])) {
    $lesson_id =  mysqli_real_escape_string($mysqli, $_POST['lesson_id']);
    $title =  mysqli_real_escape_string($mysqli, $_POST['title']);
    $description =  mysqli_real_escape_string($mysqli, $_POST['description']);
    $difficulty =  mysqli_real_escape_string($mysqli, $_POST['difficulty']);
    $estimated_time =  mysqli_real_escape_string($mysqli, $_POST['estimated_time']);
    $unit_time =  mysqli_real_escape_string($mysqli, $_POST['unit_time']);
    $lesson_paragraph = mysqli_real_escape_string($mysqli, $_POST['lesson_paragraph']);
    $status = mysqli_real_escape_string($mysqli, $_POST['status']);
    $pic = ($_FILES['lesson-update-pic']['name']);

    date_default_timezone_set('Asia/Manila');
    $timestamp = date("Y-m-d H:i:s");


    /*
    $query = "UPDATE lesson_tbl set  title='" . $title . "', description='" . $description . "', difficulty='" . $difficulty . "', estimated_time='" . $estimated_time . "', unit_time='" . $unit_time . "', lesson_paragraph='" . $lesson_paragraph . "', lesson_img='" . $pic . "', status='" . $status ."', updated_at='" . $timestamp . "' WHERE lesson_id='" . $_POST['lesson_id'] . "'"; // update form data from the database

    $dir = "../assets/img/";
    $imagelocation = $dir . basename($_FILES['lesson-update-pic']['name']);
    $extension = pathinfo($imagelocation, PATHINFO_EXTENSION);
    if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
        echo "plzz upload only jpg,jpeg And png";
    } else {
        if (move_uploaded_file($_FILES['lesson-update-pic']['tmp_name'], $imagelocation)) {
            if (mysqli_query($mysqli, $query)) {
                echo json_encode(array("statusCode" => 200));
            }
        } else {

            echo "ERROR";
        }
    }

    $res = mysqli_query($mysqli, $query);

    if ($res) {

        echo json_encode($res);
    } else {

        echo "Error: " . $sql . "" . mysqli_error($mysqli);
    }
*/


    if ($stmt = $mysqli->prepare("UPDATE lesson_tbl set  title=?, description=?, difficulty=?, estimated_time=?, unit_time=?, lesson_paragraph=?, lesson_img=?, status=?, updated_at=? WHERE lesson_id=?")) {

        $stmt->bind_param("sssssssssi", $title, $description, $difficulty, $estimated_time, $unit_time, $lesson_paragraph, $pic, $status,  $timestamp, $lesson_id);
        $stmt->execute();

        $dir = "../../assets/img/";
        $imagelocation = $dir . basename($_FILES['lesson-update-pic']['name']);
        $extension = pathinfo($imagelocation, PATHINFO_EXTENSION);
        if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') {
            echo "Upload only jpg,jpeg And png";
        } else {
            move_uploaded_file($_FILES['lesson-update-pic']['tmp_name'], $imagelocation);
            echo json_encode(array("statusCode" => 200));
        }
    } else {
        echo json_encode(array("statusCode" => 201));
    }
}

?>
