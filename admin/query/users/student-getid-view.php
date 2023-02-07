<?php include_once('../../../database/config.php'); ?>

<?php

$user_id = $_POST['user_id'];
/*
    $query="SELECT *
    FROM user_tbl as user
    INNER JOIN student_faculty_profile_tbl as prfl
    ON user.user_id = prfl.user_id WHERE user.user_id = $user_id";


    $result = mysqli_query($mysqli,$query);

    $get_id = mysqli_fetch_array($result);

    if($get_id) {

     echo json_encode($get_id);

    } else {

     echo "Error: " . $sql . "" . mysqli_error($mysqli);

    }
 */

$stmt = $mysqli->prepare("SELECT * FROM user_tbl as user INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id WHERE user.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$get_id = $result->fetch_array();
if ($get_id) {

    echo json_encode($get_id);
} else {

    echo "Error: " . $sql . "" . mysqli_error($mysqli);
}
?>