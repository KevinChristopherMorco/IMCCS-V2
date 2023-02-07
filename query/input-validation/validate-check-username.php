<?php include_once('../../database/config.php'); ?>

<?php

if(isset($_POST['username'])){
   $username = mysqli_real_escape_string($mysqli,$_POST['username']);
   $checkUsername = $mysqli->prepare("SELECT count(*) as username_cnt from student_faculty_profile_tbl where username= ?");
   $checkUsername->bind_param('s', $username);
   $checkUsername->execute();
   $returnCheckUsername = $checkUsername->get_result();
   $row = $returnCheckUsername->fetch_assoc();

   $count = $row['username_cnt'];

   if ($count > 0) {
      echo json_encode(array("Username Exist"));
   } else {
      echo json_encode(array("Username Doesn't Exist"));
   }


   die;
}