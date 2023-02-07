<?php include_once('../../../database/config.php'); ?>

<?php
session_start();
/*$id=$_GET['id']; */
/*
foreach ($_POST['lesson_id'] as $key => $value) {
    $sql = "DELETE FROM lesson_tbl WHERE lesson_id='" . $value . "'";
    if (mysqli_query($mysqli, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($mysqli);
    }
}
*/

foreach ($_POST['lesson_id'] as $key => $value) {

    if ($stmt = $mysqli->prepare("DELETE FROM lesson_tbl WHERE lesson_id = ?")) {
        $stmt->bind_param("i", $value);
        $stmt->execute();
        echo "Record deleted successfully";
    }else{
        echo "Error deleting record: " . mysqli_error($mysqli);
    }
}
mysqli_close($mysqli);
?>