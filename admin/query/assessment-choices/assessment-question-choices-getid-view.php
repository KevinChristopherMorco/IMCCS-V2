<?php include_once('../../../database/config.php'); ?>

<?php

$question_id = $_POST['question_id'];


$stmt = $mysqli->prepare("SELECT * from assessment_question_tbl as question INNER JOIN assessment_answer_tbl as assessment_answer WHERE question.question_id = ? AND assessment_answer.question_id = ?");

$stmt->bind_param("ii", $question_id, $question_id);
$stmt->execute();
$result = $stmt->get_result();

// Initialize an array to store the answers
$get_ids = array();

// Iterate over the result set and store the answers in the array
while ($row = $result->fetch_array()) {
  $get_ids[] = $row;
}

// Encode the array as a JSON object
$json = json_encode($get_ids);
echo $json;
