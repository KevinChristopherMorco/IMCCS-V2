<?php include_once('../../../database/config.php'); ?>

<?php
function generateCode() {
    $code = "";
    $possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    $date = new DateTime();
    $minutes = str_pad(base_convert($date->format('i'), 10, 36), 2, '0', STR_PAD_LEFT);
    $seconds = str_pad(base_convert($date->format('s'), 10, 36), 2, '0', STR_PAD_LEFT);

    for ($j = 0; $j < 3; $j++) {
      for ($i = 0; $i < 4; $i++) {
        $code .= $possible[rand(0, strlen($possible) - 1)];
      }
      if ($j === 2) {
        $code .= '-' . $minutes . $seconds;
      } else {
        $code .= '-';
      }
    }

    return $code;
  }

  // Generate a unique code
  $generatedString = generateCode();

$name =  mysqli_real_escape_string($mysqli,  ucwords(strtolower($_POST['name'])));
$type =  mysqli_real_escape_string($mysqli,  ucwords(strtolower($_POST['type'])));
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

if ($stmt = $mysqli->prepare("INSERT INTO institution_tbl (code, name,type, street_name, barangay, municipality_city, province, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)")) {

    $stmt->bind_param("sssssssss", $generatedString,$name,$type,$street_name,$barangay,$municipality,$province,$status,$timestamp);
    $stmt->execute();
    echo json_encode(array("Institution Added"));

} else {

    echo json_encode(array("Institution Not Added"));
}
mysqli_close($mysqli);
?>