<?php include_once('../../../database/config.php'); ?>
<?php

?>
<?php
if (isset($_POST['subtopic_id'])) {
    $subtopic_id =   $_POST['subtopic_id'];
    $title =   $_POST['title'];
    $module =   $_POST['module'];
    $subtopic =   $_POST['subtopic'];

    $content =    $_POST['content'];
    date_default_timezone_set('Asia/Manila');
    $timestamp = date("Y-m-d H:i:s");

    /*

    $query = "UPDATE subtopic_tbl set  title='" . $title . "', module='" . $module . "', subtopic='" . $subtopic . "', content='" . $content . "',updated_at='" . $timestamp . "' WHERE subtopic_id='" . $_POST['subtopic_id'] . "'"; // update form data from the database

    $res = mysqli_query($mysqli, $query);


    if ($res) {

        echo json_encode($res);
    } else {

        echo "Error: " . $sql . "" . mysqli_error($mysqli);
    }
*/
    if ($stmt = $mysqli->prepare("UPDATE subtopic_tbl set  title=?, module=?, subtopic=?, content=?, updated_at=? WHERE subtopic_id=?")) {

        $stmt->bind_param("sssssi", $title,$module,$subtopic,$content,$timestamp,$subtopic_id);
        $stmt->execute();
        echo json_encode(array("Institution Added"));

    } else {
        echo "Error: " . $sql . "" . mysqli_error($mysqli);
    }
}

?>
