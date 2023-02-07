<?php include_once('../../database/config.php'); ?>

<?php

    $lesson_id = $_POST['lesson_id'];

    $query="SELECT * from lesson_tbl WHERE lesson_id = '" .$lesson_id. "'";


    $result = mysqli_query($mysqli,$query);

    $get_id = mysqli_fetch_array($result);

    if($get_id) {

     echo json_encode($get_id);

    } else {

     echo "Error: " . $sql . "" . mysqli_error($mysqli);

    }

?>