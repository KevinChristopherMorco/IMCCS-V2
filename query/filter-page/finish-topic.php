<?php include_once('../../database/config.php'); ?>

<?php
//if (isset($_POST['user_id'])) {
    $title =   mysqli_real_escape_string($mysqli, $_POST['title']);
    $id =   mysqli_real_escape_string($mysqli, $_POST['id']);
    $module_title =   mysqli_real_escape_string($mysqli, $_POST['module_title']);
    $subtopic_id =   mysqli_real_escape_string($mysqli, $_POST['subtopic_id']);
    $lesson_id =   mysqli_real_escape_string($mysqli, $_POST['lesson_id']);


    $stmt = $mysqli->prepare("INSERT INTO subtopic_progress_tbl (lesson_id, user_id, subtopic_id, topic_title, module_title) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiiss",$lesson_id, $id, $subtopic_id, $title, $module_title);
    $stmt->execute();
    echo json_encode($stmt);
//}

?>




