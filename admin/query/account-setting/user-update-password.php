<?php include_once('../../../database/config.php'); ?>

<?php
if (isset($_POST['user_id'])) {

    $old_password =  mysqli_real_escape_string($mysqli, $_POST['old_password']);
    $old_hash = password_hash($old_password, PASSWORD_BCRYPT);

    $password = mysqli_real_escape_string($mysqli, $_POST['password']);
    $hash = password_hash($password, PASSWORD_BCRYPT);

    $query = "UPDATE user_tbl as user
INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id  set  user.password='" . $hash . "' WHERE user.user_id = '" . $_POST['user_id'] . "'"; // update form data from the database

$row="select * FROM user_tbl WHERE user_id = '" . $_POST['user_id'] . "' ";
    $selPasswordRow = mysqli_query($mysqli, $row);
    $rowPassword = mysqli_fetch_assoc($selPasswordRow);

    if (password_verify($_POST['old_password'], $rowPassword['password'])) {
        $res = mysqli_query($mysqli, $query);
        if ($res) {
            echo json_encode('Password Matched');
        }
        else {
            echo "Error: " . $sql . "" . mysqli_error($mysqli);
        }
    }else{
        echo json_encode('WRONG');
    }
}
?>
