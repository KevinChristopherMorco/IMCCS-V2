<?php
if (isset($_POST['token'])) {
    $token = $_POST['token'];

   $conn = new mySqli('localhost', 'u351518056_capstoneV2', 'b3P^9GtW?I', 'u351518056_capstoneV2');
    if ($conn->connect_error) {
        die('Could not connect to the database');
    }

    $verifyQuery = $conn->query("SELECT * FROM admin_tbl WHERE token = '$token'");

    if ($verifyQuery->num_rows == 0) {
        exit();
    }


    $password =  $_POST['newpassword'];
    $hash = password_hash($password, PASSWORD_BCRYPT);
    /*
        $changeQuery = $conn->query("UPDATE admin_tbl as user
            INNER JOIN admin_profile_tbl as prfl ON user.user_id = prfl.user_id SET user.password = '$hash' WHERE user.token = '$token'");

        if ($changeQuery) {
            echo '<script type="text/javascript">
            passChange();
               </script>';
        }
        */


    $stmt = $conn->prepare("UPDATE admin_tbl as user INNER JOIN admin_profile_tbl as prfl ON user.user_id = prfl.user_id SET user.password = ? WHERE user.token = ?");
    $stmt->bind_param("ss", $hash, $token);
    $stmt->execute();

    $conn->close();
} else {
    echo json_encode("wrong");
    exit();
}
