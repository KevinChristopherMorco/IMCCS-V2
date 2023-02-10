<?php include_once('../../database/config.php'); ?>

<?php
session_start();
    $query = "SELECT *
    FROM admin_tbl as user
    INNER JOIN admin_profile_tbl as prfl
    ON user.user_id = prfl.user_id WHERE user.user_id='".$_SESSION['user_id']."'";


    $result = mysqli_query($mysqli,$query);

    $get_id = mysqli_fetch_array($result);

    if($get_id) {

     echo json_encode($get_id);

    } else {

     echo "Error: " . $query . "" . mysqli_error($mysqli);

    }

?>