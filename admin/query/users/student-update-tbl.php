<?php include_once('../../../database/config.php'); ?>

<?php
if (isset($_POST['user_id'])) {
    $user_id =  mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $fname =  mysqli_real_escape_string($mysqli, $_POST['fname']);
    $lname =  mysqli_real_escape_string($mysqli, $_POST['lname']);
    $gender =  ucwords($_POST['gender']);
    $institution = ucwords(strtolower($_POST['institution']));
    $grade_level =   mysqli_real_escape_string($mysqli, $_POST['grade_level']);
    $email =   mysqli_real_escape_string($mysqli, $_POST['email']);
    $contact =   mysqli_real_escape_string($mysqli, $_POST['contact']);
    $username =   mysqli_real_escape_string($mysqli, $_POST['username']);

    date_default_timezone_set('Asia/Manila');
    $timestamp = date("Y-m-d H:i:s");

    $checkInstitution = $mysqli->prepare("SELECT name from institution_tbl WHERE name=?");
    $checkInstitution->bind_param('s', $institution);
    $checkInstitution->execute();
    $checkInstitution->store_result();
    $returnCheckInstitution = $checkInstitution->num_rows;


    $checkUsername = mysqli_query($mysqli, "SELECT username from student_faculty_profile_tbl WHERE username='$username'");
    $checkUsername = $mysqli->prepare("SELECT username from student_faculty_profile_tbl WHERE username=?");
    $checkUsername->bind_param('s', $username);
    $checkUsername->execute();
    $checkUsername->store_result();
    $returnCheckUsername = $checkUsername->num_rows;



    /*$query = "UPDATE user set  user.username='" . $username . "', prfl.fname='" . $fname . "', prfl.lname='" . $lname . "' FROM user_tbl as user
INNER JOIN student_faculty_profile_tbl as prfl
ON user.user_id = prfl.user_id WHERE user.user_id =; // update form data from the database*/

    /*$query = "UPDATE user_tbl as user
INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id
SET user.username = $username, prfl.fname = $fname, prfl.lname = $lname
WHERE user.user_id ";*/



    /*$query = "UPDATE user_tbl set  username='" . $username . "' WHERE user_id='" . $_POST['user_id'] . "'"; // update form data from the database */

    /*

    $query = "UPDATE user_tbl as user
INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id  set  prfl.fname='" . $fname . "', prfl.lname='" . $lname . "' , prfl.institution='" . $institution .  "' , prfl.updated_at='" . $timestamp . "',
prfl.grade_level='" . $grade_level . "', prfl.username='" . $username . "', prfl.contact_no='" . $contact . "',user.email='" . $email . "' WHERE user.user_id = '" . $_POST['user_id'] . "'"; // update form data from the database
    $res = mysqli_query($mysqli, $query);


    if ($res) {

        echo json_encode($res);
    } else {

        echo "Error: " . $sql . "" . mysqli_error($mysqli);
    }
}
*/


    $mysqli->autocommit(FALSE);
    if ($returnCheckInstitution == 1) {


        if (strlen($username) < 5) {
            echo json_encode(array("Username Length is Invalid"));
            $mysqli->rollback();
        } else if (strlen($contact) != 11) {
            echo json_encode(array("Contact Number Length is Invalid"));
            $mysqli->rollback();
        } /*else if ($returnCheckUsername == 1) {
            echo json_encode(array("Username Exists Already"));
            $mysqli->rollback();
        }*/ else {

            $stmt = $mysqli->prepare("UPDATE user_tbl as user
        INNER JOIN student_faculty_profile_tbl as prfl ON user.user_id = prfl.user_id  set  prfl.fname=?, prfl.lname=? , prfl.gender=? , prfl.institution=? , prfl.updated_at=?,
        prfl.grade_level=?, prfl.username=?, prfl.contact_no=?,user.email=? WHERE user.user_id = ?");
            $stmt->bind_param("ssssssssss", $fname, $lname, $gender, $institution, $timestamp, $grade_level, $username, $contact, $email, $user_id);
            $stmt->execute();


            echo json_encode(array("statusCode" => 200));
        }
    } else {
        echo json_encode(array("statusCode" => 201));
        $mysqli->rollback();
    }

    $mysqli->commit();
}

?>
