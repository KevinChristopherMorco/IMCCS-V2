<?php include_once('../../database/config.php'); ?>

<?php
if (!empty($_POST)) {
    mysqli_autocommit($mysqli, FALSE);
    //Recaptcha
    /*
    $secret = "6LdUoyMjAAAAABMR2KLQC1WH7QXTYUrWZulwvr-U";
    $response = $_POST['captcha'];
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";
    $data = file_get_contents($url);
    $captchaResponse = json_decode($data, true);
    */

    $email = $_POST['email'];
    $password =  $_POST['password'];
    $hash = password_hash($password, PASSWORD_BCRYPT);
    $usertype =  ucwords($_POST['usertype']);
    $fname =  ucwords($_POST['fname']);
    $lname =  ucwords($_POST['lname']);
    $gender =  ucwords($_POST['gender']);
    $institution = ucwords(strtolower($_POST['institution']));
    $grade_level =  ucwords($_POST['grade_level']);
    $username = $_POST['username'];
    $contact =  $_POST['contact'];
    $date = date("Y-m-d H:i:s");

    $checkInstitution = $mysqli->prepare("SELECT name from institution_tbl WHERE name=?");
    $checkInstitution->bind_param('s', $institution);
    $checkInstitution->execute();
    $checkInstitution->store_result();
    $returnCheckInstitution = $checkInstitution->num_rows;


    $checkUsername = $mysqli->prepare("SELECT username from student_faculty_profile_tbl WHERE username=?");
    $checkUsername->bind_param('s', $username);
    $checkUsername->execute();
    $checkUsername->store_result();
    $returnCheckUsername = $checkUsername->num_rows;

    $checkEmail = $mysqli->prepare("SELECT email from user_tbl WHERE email= ?");
    $checkEmail->bind_param('s', $email);
    $checkEmail->execute();
    $checkEmail->store_result();
    $returnCheckEmail = $checkUsername->num_rows;



    $mysqli->autocommit(FALSE);
    if ($returnCheckInstitution == 1 && $returnCheckEmail !=1 && strlen($username) >= 5 && strlen($contact) == 11) {


        if (strlen($username) < 5) {
            echo json_encode(array("Username Length is Invalid"));
            $mysqli->rollback();
        } else if (strlen($contact) != 11) {
            echo json_encode(array("Contact Number Length is Invalid"));
            $mysqli->rollback();
        } else if ($returnCheckUsername == 1) {
            echo json_encode(array("Username Exists Already"));
            $mysqli->rollback();
        } else {

            $stmt = $mysqli->prepare("INSERT INTO user_tbl (email,password, usertype, created_at) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $email, $hash, $usertype, $timestamp);
            $stmt->execute();

            $stmt = $mysqli->prepare("INSERT INTO student_faculty_profile_tbl (user_id, fname, lname,gender, institution, grade_level, username, contact_no, created_at) VALUES (LAST_INSERT_ID(), ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $fname, $lname, $gender, $institution, $grade_level, $username, $contact, $timestamp);
            $stmt->execute();
            echo json_encode(array("Existing Code"));
        }
    } else {
        echo json_encode(array("No Existing Code"));
        $mysqli->rollback();
    }

    $mysqli->commit();



/*
    $checkInstitution = mysqli_query($mysqli, "SELECT name from institution_tbl WHERE name='$institution'");

    $checkEmail = mysqli_query($mysqli, "SELECT email from user_tbl WHERE email='$email'");
    // Insert some values
    $insert1 = mysqli_query($mysqli, "INSERT INTO user_tbl (email,password, usertype, created_at)
       VALUES ('$email','$hash','$usertype','$date')");
    $insert2 = mysqli_query($mysqli, "INSERT INTO student_faculty_profile_tbl (user_id, fname, lname, institution,gender, grade_level, username, contact_no, created_at)
       VALUES (LAST_INSERT_ID(),'$fname','$lname','$institution','$gender', '$grade_level', '$username', '$contact' ,'$date')");



    if (mysqli_num_rows($checkInstitution) == 1 && mysqli_num_rows($checkEmail) != 1 && strlen($username) >= 5 && strlen($contact) == 11 && $captchaResponse['success'] == "true") {
        if ($insert1 && $insert2) {
            echo json_encode(array("Existing Code"));
            mysqli_query($mysqli, "COMMIT");
        }
    } else if (strlen($username) < 5) {
        echo json_encode(array("Username Length is Invalid"));
        mysqli_query($mysqli, "ROLLBACK");
    } else if (strlen($contact) != 11) {
        echo json_encode(array("Contact Number Length is Invalid"));
        mysqli_query($mysqli, "ROLLBACK");
    } else if (mysqli_num_rows($checkEmail) == 1) {
        echo json_encode(array("Email Exists Already"));
        mysqli_query($mysqli, "ROLLBACK");
    } else {
        echo json_encode(array("No Existing Code"));
        mysqli_query($mysqli, "ROLLBACK");
    }
}
mysqli_query($mysqli, "SET AUTOCOMMIT=1");
*/
}
mysqli_close($mysqli);
?>



