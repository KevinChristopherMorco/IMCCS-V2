<?php include_once('../../../database/config.php'); ?>

<?php
/*
$datas = explode('|',$_POST['title']);
$assessment_id = $datas[0];
$title = $datas[1];
*/

if (isset($_POST['question_id'])) {
    $datas = explode('|', $_POST['assessment_title']);
    $assessment_id = $datas[0];
    $title = $datas[1];

    $question_id =  mysqli_real_escape_string($mysqli, $_POST['question_id']);
    $assessment_question =  mysqli_real_escape_string($mysqli, strip_tags($_POST['assessment_question']));
    $type =  mysqli_real_escape_string($mysqli, $_POST['type']);

    $ch1 =   $_POST['assessment_choice1'];
    $ch2 =   $_POST['assessment_choice2'];
    $ch3 =   $_POST['assessment_choice3'];
    $ch4 =   $_POST['assessment_choice4'];
    $assessment_answer =  $_POST['assessment_answer'];
    $answer_id =  $_POST['answer_id'];

    $point =  mysqli_real_escape_string($mysqli, $_POST['point']);
    date_default_timezone_set('Asia/Manila');
    $timestamp = date("Y-m-d H:i:s");


    $stmt = $mysqli->prepare("UPDATE assessment_question_tbl as question INNER JOIN assessment_answer_tbl as assessment_answer set question.assessment_id=?, assessment_title=?,  assessment_question=?, type=?, assessment_choice1=?, assessment_choice2=?, assessment_choice3=?, assessment_choice4=?, point=?, updated_at=? WHERE question.question_id=?");
    $stmt->bind_param("ssssssssssi", $assessment_id, $title, $assessment_question, $type, $ch1, $ch2, $ch3, $ch4, $point, $timestamp, $question_id);
    $stmt->execute();

    // Loop through the assessment_answer and answer_id arrays
    for ($i = 0; $i < count($assessment_answer); $i++) {
        // Update the answer with the corresponding answer_id

        $stmt = $mysqli->prepare("UPDATE assessment_answer_tbl SET assessment_answer = ? WHERE assessment_answer_id = ?");
        $stmt->bind_param("si", $assessment_answer[$i], $answer_id[$i]);
        $stmt->execute();
    }

    echo json_encode(array("statusCode" => 200));
} else {
    echo json_encode(array("statusCode" => 201));
}

mysqli_close($mysqli);

?>
