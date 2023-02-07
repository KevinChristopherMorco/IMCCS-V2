<?php include_once('../../../database/config.php'); ?>

<?php
if (isset($_POST['institution_id'])) {
    $institution_id =  mysqli_real_escape_string($mysqli, $_POST['institution_id']);
    $name =  mysqli_real_escape_string($mysqli, $_POST['name']);
    $type =  mysqli_real_escape_string($mysqli, $_POST['type']);

    $street_name =  mysqli_real_escape_string($mysqli, $_POST['street_name']);
    $barangay =  mysqli_real_escape_string($mysqli, $_POST['barangay']);
    $municipality =   mysqli_real_escape_string($mysqli, $_POST['municipality_city']);
    $province =   mysqli_real_escape_string($mysqli, $_POST['province']);
    $status =  mysqli_real_escape_string($mysqli, $_POST['status']);

    date_default_timezone_set('Asia/Manila');
    $timestamp = date("Y-m-d H:i:s");
/*
    $query = "UPDATE institution_tbl set  name='" . $name . "', code='" . $code . "', street_name='" . $street_name . "', barangay='" . $barangay . "', municipality_city='" . $municipality . "', province='" . $province . "',status='" . $status . "',updated_at='" . $timestamp ."' WHERE institution_id='" . $_POST['institution_id'] . "'"; // update form data from the database


    $res = mysqli_query($mysqli, $query);

    if ($res) {

        echo json_encode(array("Institution Added"));
    } else {

        echo "Error: " . $sql . "" . mysqli_error($mysqli);
    }
*/
    if ($stmt = $mysqli->prepare("UPDATE institution_tbl set  name=?, type=?, street_name=?, barangay=?, municipality_city=?, province=?,status=?,updated_at=? WHERE institution_id=?")) {

        $stmt->bind_param("ssssssssi", $name, $type,$street_name,$barangay,$municipality,$province,$status,$timestamp,$institution_id);
        $stmt->execute();
        echo json_encode(array("Institution Added"));

    } else {
        echo "Error: " . $sql . "" . mysqli_error($mysqli);
    }
}

?>
