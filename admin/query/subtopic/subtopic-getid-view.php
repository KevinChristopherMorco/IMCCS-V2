<?php include_once('../../../database/config.php'); ?>

<?php

$subtopic_id = $_POST['subtopic_id'];
/*
    $query="SELECT * from subtopic_tbl WHERE subtopic_id = '" .$subtopic_id. "'";


    $result = mysqli_query($mysqli,$query);

    $get_id = mysqli_fetch_array($result);

    if($get_id) {

     echo json_encode($get_id);

    } else {

     echo "Error: " . $sql . "" . mysqli_error($mysqli);

    }
*/
$stmt = $mysqli->prepare("SELECT * from subtopic_tbl WHERE subtopic_id = ?");
$stmt->bind_param("i", $subtopic_id);
$stmt->execute();
$result = $stmt->get_result();
$get_id = $result->fetch_array();
if ($get_id) {

    echo json_encode($get_id);
} else {

    echo "Error: " . $sql . "" . mysqli_error($mysqli);
}

?>