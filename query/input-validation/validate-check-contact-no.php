<?php include_once('../../database/config.php'); ?>

<?php

if (isset($_POST['contact'])) {
   $contact = mysqli_real_escape_string($mysqli, $_POST['contact']);
   $checkContact = $mysqli->prepare("SELECT count(*) as contact_no_cnt from student_faculty_profile_tbl where contact_no=?");
   $checkContact->bind_param('s', $contact);
   $checkContact->execute();
   $returnCheckContact = $checkContact->get_result();
   $row = $returnCheckContact->fetch_assoc();

   $count = $row['contact_no_cnt'];

   if ($count > 0) {
      echo json_encode(array("This Number is Already Registered"));
   } else {
      echo json_encode(array("This Number Doesn't Exist"));
   }

   die;
}
