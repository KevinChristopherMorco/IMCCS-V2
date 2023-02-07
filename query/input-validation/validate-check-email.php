<?php include_once('../../database/config.php'); ?>

<?php

if(isset($_POST['email'])){
   $email = mysqli_real_escape_string($mysqli,$_POST['email']);
   $checkEmail = $mysqli->prepare("select count(*) as email_cnt from user_tbl where email= ?");
   $checkEmail->bind_param('s', $email);
   $checkEmail->execute();
   $returnCheckEmail = $checkEmail->get_result();
   $row = $returnCheckEmail->fetch_assoc();

   $count = $row['email_cnt'];

   if ($count > 0) {
      echo json_encode(array("Email Exists"));
   } else {
      echo json_encode(array("This Email Doesn't Exist"));
   }


   die;
}