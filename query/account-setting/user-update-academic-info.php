<?php include_once('../../database/config.php'); ?>

<?php
if (isset($_POST['user_id'])) {
    $user_id =  mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $institution =  mysqli_real_escape_string($mysqli, $_POST['institution']);
    $grade_level =  mysqli_real_escape_string($mysqli, $_POST['grade_level']);




    $stmt = $mysqli->prepare("UPDATE user_tbl as user
INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id  set  prfl.institution= ?, prfl.grade_level= ? WHERE user.user_id = ?");

    $stmt->bind_param("ssi", $institution, $grade_level,  $user_id);
    $stmt->execute();
    echo json_encode($stmt);

}

?>
