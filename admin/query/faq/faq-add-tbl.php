<?php include_once('../../../database/config.php'); ?>

<?php
$title =   mysqli_real_escape_string($mysqli, $_POST['title']);
$description =  mysqli_real_escape_string($mysqli, $_POST['description']);

date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d H:i:s");

if ($stmt = $mysqli->prepare("INSERT INTO faq_tbl(title, description, created_at) VALUES (?, ?, ?)")) {

    $stmt->bind_param("sss", $title,$description,$timestamp);
    $stmt->execute();
    echo json_encode(array("Institution Added"));

} else {

    echo json_encode(array("Institution Not Added"));
}
mysqli_close($mysqli);
?>