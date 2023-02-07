<?php include_once('../../database/config.php'); ?>

<?php

if(isset($_POST['username'])){
   $username = mysqli_real_escape_string($mysqli,$_POST['username']);

   $query = "SELECT COUNT(*) as username_cnt FROM student_faculty_profile_tbl WHERE username = ?";

   $stmt = $mysqli->prepare($query);
   $stmt->bind_param('s', $username);
   $stmt->execute();
   $result = $stmt->get_result();

   if($result->num_rows > 0) {
     $row = $result->fetch_array();
     $count = $row['username_cnt'];
     if($count > 0) {
       echo json_encode(array("Username Exist"));
     } else {
       echo json_encode(array("Username Doesn't Exist"));
     }
   }


   die;
}