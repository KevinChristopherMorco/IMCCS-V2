<?php include_once('../../../database/config.php'); ?>

<?php
function generateUniqueString($length = 10) {
    // start with a unique identifier
    $uniqueString = uniqid();

    // add a random string to the unique identifier
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for ($i = 0; $i < $length; $i++) {
        $uniqueString .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return "CN-" . substr($uniqueString, 0, 255 - 5);
}
$generatedString = generateUniqueString(10);
$name =  mysqli_real_escape_string($mysqli,  ucwords(strtolower($_POST['name'])));
$street_name =  mysqli_real_escape_string($mysqli, ucwords($_POST['street_name']));
$barangay =  mysqli_real_escape_string($mysqli, ucwords($_POST['barangay']));
$municipality =   mysqli_real_escape_string($mysqli, ucwords($_POST['municipality_city']));
$province =   mysqli_real_escape_string($mysqli, ucwords($_POST['province']));
$status =  mysqli_real_escape_string($mysqli, ucwords($_POST['status']));

date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d H:i:s");

/*

$sql = "INSERT INTO institution_tbl(code, name, street_name, barangay, municipality_city, province, status, created_at)
	VALUES ('$code','$name','$street_name','$barangay','$municipality','$province','$status','$timestamp')";
if (mysqli_query($mysqli, $sql)) {
    echo json_encode(array("Institution Added"));
} else {
    echo json_encode(array("Institution Not Added"));
}
*/

if ($stmt = $mysqli->prepare("INSERT INTO institution_tbl (code, name, street_name, barangay, municipality_city, province, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {

    $stmt->bind_param("ssssssss", $generatedString,$name,$street_name,$barangay,$municipality,$province,$status,$timestamp);
    $stmt->execute();
    echo json_encode(array("Institution Added"));

} else {

    echo json_encode(array("Institution Not Added"));
}
mysqli_close($mysqli);
?>