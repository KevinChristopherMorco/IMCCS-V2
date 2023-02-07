<?php include_once('../../database/config.php'); ?>

<?php

if (isset($_POST['contact'])) {
   $contact = mysqli_real_escape_string($mysqli, $_POST['contact']);

   $query = "SELECT COUNT(*) as contact_no_cnt FROM student_faculty_profile_tbl WHERE contact_no = ?";

   $stmt = $mysqli->prepare($query);
   $stmt->bind_param('s', $contact);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($result->num_rows > 0) {
      $row = $result->fetch_array();
      $count = $row['contact_no_cnt'];
      if ($count > 0) {
         echo json_encode(array("This Number is Already Registered"));
      } else {
         echo json_encode(array("This Number Doesn't Exist"));
      }
   }

   die;
}
