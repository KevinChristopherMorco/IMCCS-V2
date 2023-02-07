<?php include_once('../../../database/config.php'); ?>

<?php

$institution_id = $_POST['institution_id'];
/*
    $query="SELECT * from institution_tbl WHERE institution_id = '" .$institution_id. "'";


    $result = mysqli_query($mysqli,$query);

    $get_id = mysqli_fetch_array($result);

    if($get_id) {

     echo json_encode($get_id);

    } else {

     echo "Error: " . $sql . "" . mysqli_error($mysqli);

    }
*/
$stmt = $mysqli->prepare("SELECT * from institution_tbl WHERE institution_id = ?");
$stmt->bind_param("i", $institution_id);
$stmt->execute();
$result = $stmt->get_result();
$get_id = $result->fetch_array();
if ($get_id) {

    echo json_encode($get_id);
} else {

    echo "Error: " . $sql . "" . mysqli_error($mysqli);
}

?>