<?php include_once('../../database/config.php'); ?>
<?php  session_start();
 ?>
<?php
$gender =  $_POST['gender'];
date_default_timezone_set('Asia/Manila');

$id =  $_POST['id'];
$birthdate =  $_POST['bdate'];
$institution_id =  $_POST['institution_id'];

function generateUniqueString($length = 15) {
    // start with a unique identifier
    $uniqueString = uniqid();

    // add a random string to the unique identifier
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for ($i = 0; $i < $length; $i++) {
        $uniqueString .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return substr($uniqueString, 0, 255);
}
$generatedString = generateUniqueString(15);

// convert birthdate into a timestamp
$birthdateTimestamp = strtotime($birthdate);

// get current timestamp
$now = time();

// calculate age in seconds
$ageInSeconds = $now - $birthdateTimestamp;

// calculate age in years
$ageInYears = $ageInSeconds / (60 * 60 * 24 * 365);

// round the age to the nearest year
$roundedAge = intval($ageInYears);

$timestamp = date("Y-m-d H:i:s");

$stmt = $mysqli->prepare("INSERT INTO user_profile (user_id,user_control_code, institution_id, age,gender,created_at) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss",$id,$generatedString,$institution_id, $roundedAge, $gender, $timestamp);
$stmt->execute();
$_SESSION["generatedString"] = $generatedString;

echo "Registered";

?>