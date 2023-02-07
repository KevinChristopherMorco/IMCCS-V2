<?php

include_once('../../../database/config.php');

date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d H:i:s");

$total_questions = count($_POST['assessment_question']);
$total_answers = count($_POST['assessment_answer']);
var_dump($total_questions);
var_dump($total_answers);

$answers_start_index = 0;
$num_answer_options =   $_POST['length'];
//$num_answer_options =  [2,3];

foreach ($_POST['assessment_question'] as $key => $value) {
    $assessment_id =  $_POST['assessment_id'];
    $title =  $_POST['title'];
    $question = $_POST['assessment_question'][$key] = strip_tags($value);
    $answer =   $_POST['assessment_answer'];
    $type =   $_POST['type'][$key];
    $point =   $_POST['point'][$key];
    $ch1 =   $_POST['assessment_choice1'][$key];
    $ch2 =   $_POST['assessment_choice2'][$key];
    $ch3 =   $_POST['assessment_choice3'][$key];
    $ch4 =   $_POST['assessment_choice4'][$key];

    $mysqli->autocommit(FALSE);
    if ($stmt = $mysqli->prepare("INSERT INTO assessment_question_tbl (assessment_id,assessment_title, assessment_question,type, assessment_choice1, assessment_choice2, assessment_choice3,assessment_choice4,point,created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
        $stmt->bind_param("ssssssssss", $assessment_id, $title, $question, $type, $ch1, $ch2, $ch3, $ch4, $point, $timestamp);
        if ($stmt->execute()) {
            $question_id = $mysqli->insert_id;
            $answers_for_question = array_slice($answer, $answers_start_index, $num_answer_options[$key]);

            $answers_start_index += $num_answer_options[$key];
            for ($i = 0; $i < count($answers_for_question); $i++) {
                $stmt = $mysqli->prepare("INSERT INTO assessment_answer_tbl (assessment_id, question_id, assessment_answer) VALUES (?, ?, ?)");
                $stmt->bind_param("iis", $assessment_id, $question_id, $answers_for_question[$i]);
                if (!$stmt->execute()) {
                    // Handle error
                    echo json_encode(array("statusCode" => 201));
                    exit;
                }
            }
            $mysqli->commit();
            echo json_encode(array("statusCode" => 200));
        } else {
            // Handle error
            echo json_encode(array("statusCode" => 201));
        }
    } else {
        // Handle error
        echo json_encode(array("statusCode" => 201));
    }
}
mysqli_close($mysqli);
