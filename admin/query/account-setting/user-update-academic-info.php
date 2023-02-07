<?php include_once('../../../database/config.php'); ?>

<?php
if (isset($_POST['user_id'])) {

    $institution =  mysqli_real_escape_string($mysqli, $_POST['institution']);
    $grade_level =  mysqli_real_escape_string($mysqli, $_POST['grade_level']);

    $query = "UPDATE user_tbl as user
INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id  set  prfl.institution='" . $institution . "', prfl.grade_level='" . $grade_level . "' WHERE user.user_id = '" . $_POST['user_id'] . "'"; // update form data from the database

    $res = mysqli_query($mysqli, $query);
    if ($res) {
        echo json_encode($res);
    } else {
        echo "Error: " . $sql . "" . mysqli_error($mysqli);
    }
}
?>
