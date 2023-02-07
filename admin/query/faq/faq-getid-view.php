<?php include_once('../../../database/config.php'); ?>

<?php

    $id = $_POST['id'];

    $query="SELECT * from faq_tbl WHERE id = '" .$id. "'";


    $result = mysqli_query($mysqli,$query);

    $get_id = mysqli_fetch_array($result);

    if($get_id) {

     echo json_encode($get_id);

    } else {

     echo "Error: " . $sql . "" . mysqli_error($mysqli);

    }

?>