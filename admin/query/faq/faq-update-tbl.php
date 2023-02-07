<?php include_once('../../../database/config.php'); ?>

<?php
if (isset($_POST['id'])) {
    $faq_id =  mysqli_real_escape_string($mysqli, $_POST['id']);
    $title =  mysqli_real_escape_string($mysqli, $_POST['title']);
    $description =  mysqli_real_escape_string($mysqli, $_POST['description']);
    date_default_timezone_set('Asia/Manila');
    $timestamp = date("Y-m-d H:i:s");

    if ($stmt = $mysqli->prepare("UPDATE faq_tbl set  title=?, description=?, updated_at=? WHERE id=?")) {

        $stmt->bind_param("sssi", $title,$description,$timestamp,$faq_id);
        $stmt->execute();
        echo json_encode(array("Institution Added"));

    } else {
        echo "Error: " . $sql . "" . mysqli_error($mysqli);
    }
}

?>
