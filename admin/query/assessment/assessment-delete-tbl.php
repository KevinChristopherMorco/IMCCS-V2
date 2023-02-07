<?php include_once('../../../database/config.php'); ?>

<?php
session_start();
/*$id=$_GET['id']; */

/*
foreach ($_POST['assessment_id'] as $key => $value) {

$sql = "DELETE FROM assessment_tbl WHERE assessment_id='" . $value . "'";
if (mysqli_query($mysqli, $sql)) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . mysqli_error($mysqli);
}
}
*/

foreach ($_POST['assessment_id'] as $key => $value) {

    if ($stmt = $mysqli->prepare("DELETE FROM assessment_tbl WHERE assessment_id = ?")) {
        $stmt->bind_param("i", $value);
        $stmt->execute();
        echo "Record deleted successfully";
    }else{
        echo "Error deleting record: " . mysqli_error($mysqli);
    }
}

mysqli_close($mysqli);
?>