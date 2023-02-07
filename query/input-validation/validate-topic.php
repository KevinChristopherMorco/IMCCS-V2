<?php include_once('../../database/config.php'); ?>

<?php
if (isset($_POST['user_id'])) {
    $user_id =  mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $lesson_id =  mysqli_real_escape_string($mysqli, $_POST['lesson_id']);
    $checkLesson = $mysqli->prepare("SELECT lesson_id, user_id from topic_chosen WHERE user_id=? AND lesson_id=?");
    $checkLesson->bind_param('ii', $user_id, $lesson_id);
    $checkLesson->execute();
    $returnCheckLesson = $checkLesson->get_result();

    if ($returnCheckLesson->num_rows == 1) {
        echo 'Taken';
    } else {
        echo 'Not Taken';
    }
}
mysqli_close($mysqli);
?>