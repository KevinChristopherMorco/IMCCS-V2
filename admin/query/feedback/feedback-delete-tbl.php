<?php include_once('../../../database/config.php'); ?>

<?php
session_start();
/*$id=$_GET['id']; */
$id = $_POST['id'];

foreach($_POST['feedback_id'] as $key => $value ) {

if ($stmt = $mysqli->prepare("DELETE FROM feedbacks WHERE feedback_id = ?")) {
    $stmt->bind_param("i", $value);
    $stmt->execute();
    echo "Record deleted successfully";
}else{
    echo "Error deleting record: " . mysqli_error($mysqli);
}
}
mysqli_close($mysqli);
?>