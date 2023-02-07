<?php include_once('../../../database/config.php'); ?>

<?php
session_start();

foreach ($_POST['institution_id'] as $key => $value) {

    if ($stmt = $mysqli->prepare("DELETE FROM institution_tbl WHERE institution_id = ?")) {
        $stmt->bind_param("i", $value);
        $stmt->execute();
        echo "Record deleted successfully";
    }else{
        echo "Error deleting record: " . mysqli_error($mysqli);
    }
}
mysqli_close($mysqli);
?>