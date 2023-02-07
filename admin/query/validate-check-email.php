<?php include_once('../../database/config.php'); ?>

<?php

if(isset($_POST['email'])){
   $email = mysqli_real_escape_string($mysqli,$_POST['email']);

   $query = "SELECT COUNT(*) as email_cnt FROM user_tbl WHERE email = ?";

   $stmt = $mysqli->prepare($query);
   $stmt->bind_param('s', $email);
   $stmt->execute();
   $result = $stmt->get_result();

   if($result->num_rows > 0) {
     $row = $result->fetch_array();
     $count = $row['email_cnt'];
     if($count > 0) {
       echo json_encode(array("Email Exists"));
     } else {
       echo json_encode(array("This Email Doesn't Exist"));
     }
   }


   die;
}