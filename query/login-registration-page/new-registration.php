<?php include_once('../../database/config.php'); ?>

<?php
$gender =  $_POST['gender'];
date_default_timezone_set('Asia/Manila');

$id =  $_POST['id'];
$birthdate =  $_POST['bdate'];
$institution_id =  $_POST['institution_id'];

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

$stmt = $mysqli->prepare("INSERT INTO user_profile (user_id,institution_id, age,gender,created_at) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss",$id,$institution_id, $roundedAge, $gender, $timestamp);
$stmt->execute();

echo "Registered";

?>