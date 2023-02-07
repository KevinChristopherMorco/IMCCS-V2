<?php include_once('../../database/config.php'); ?>

<?php
if (isset($_POST['user_id'])) {
    $user_id =  mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $email =  mysqli_real_escape_string($mysqli, $_POST['email']);
    $contact_no =  mysqli_real_escape_string($mysqli, $_POST['contact_no']);

    $stmt = $mysqli->prepare("UPDATE user_tbl as user
    INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id  set  user.email= ?, prfl.contact_no= ? WHERE user.user_id = ?");

        $stmt->bind_param("ssi", $email, $contact_no,  $user_id);
        $stmt->execute();
        echo json_encode($stmt);
}

?>
