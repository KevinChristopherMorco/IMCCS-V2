<?php include_once('../../../database/config.php'); ?>

<?php
if (isset($_POST['user_id'])) {

    $fname =  mysqli_real_escape_string($mysqli, $_POST['fname']);
    $lname =  mysqli_real_escape_string($mysqli, $_POST['lname']);

    $query = "UPDATE user_tbl as user
INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id  set  prfl.fname='" . $fname . "', prfl.lname='" . $lname . "' WHERE user.user_id = '" . $_POST['user_id'] . "'"; // update form data from the database

    $res = mysqli_query($mysqli, $query);
    if ($res) {
        echo json_encode($res);
    } else {
        echo "Error: " . $sql . "" . mysqli_error($mysqli);
    }
}
?>
