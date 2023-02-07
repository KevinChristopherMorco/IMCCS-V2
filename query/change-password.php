<?php
if (isset($_POST['token'])) {
    $token = $_POST['token'];

   $conn = new mySqli('localhost', 'u351518056_capstone', 'H7xpO*D>9d', 'u351518056_capstone');
    if ($conn->connect_error) {
        die('Could not connect to the database');
    }

    $verifyQuery = $conn->query("SELECT * FROM user_tbl WHERE token = '$token'");

    if ($verifyQuery->num_rows == 0) {
        exit();
    }


    $password =  $_POST['newpassword'];
    $hash = password_hash($password, PASSWORD_BCRYPT);
    /*
        $changeQuery = $conn->query("UPDATE user_tbl as user
            INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id SET user.password = '$hash' WHERE user.token = '$token'");

        if ($changeQuery) {
            echo '<script type="text/javascript">
            passChange();
               </script>';
        }
        */


    $stmt = $conn->prepare("UPDATE user_tbl as user INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id SET user.password = ? WHERE user.token = ?");
    $stmt->bind_param("ss", $hash, $token);
    $stmt->execute();

    $conn->close();
} else {
    echo json_encode("wrong");
    exit();
}
