<?php include_once('../../database/config.php'); ?>

<?php
if (isset($_POST['user_id'])) {
    $user_id =  mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $fname =  mysqli_real_escape_string($mysqli, $_POST['fname']);
    $lname =  mysqli_real_escape_string($mysqli, $_POST['lname']);

    $stmt = $mysqli->prepare("UPDATE user_tbl as user
    INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id  set  prfl.fname= ?, prfl.lname= ? WHERE user.user_id = ?");

        $stmt->bind_param("ssi", $fname, $lname,  $user_id);
        $stmt->execute();
        echo json_encode($stmt);
}

?>
