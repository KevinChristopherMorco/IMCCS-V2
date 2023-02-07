<?php include_once('../../database/config.php'); ?>

<?php

if (isset($_POST['institution'])) {
   $institution = mysqli_real_escape_string($mysqli, $_POST['institution']);
   $checkInstitution = $mysqli->prepare("SELECT count(*) as institution_cnt from institution_tbl where name=?");
   $checkInstitution->bind_param('s', $institution);
   $checkInstitution->execute();
   $returnCheckInstitution = $checkInstitution->get_result();
   $row = $returnCheckInstitution->fetch_assoc();

   $count = $row['institution_cnt'];

   if ($count > 0) {
      echo json_encode(array("Institution Exists"));
   } else {
      echo json_encode(array("Institution Doesnt Exist"));
   }

   die;
}
