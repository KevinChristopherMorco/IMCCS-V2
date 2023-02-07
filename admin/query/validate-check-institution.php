<?php include_once('../../database/config.php'); ?>

<?php

if(isset($_POST['institution'])){
   $institution = mysqli_real_escape_string($mysqli,$_POST['institution']);

   $query = "SELECT COUNT(*) as institution_cnt FROM institution_tbl WHERE name=?";

   $stmt = mysqli_prepare($mysqli, $query);
   mysqli_stmt_bind_param($stmt, "s", $institution);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt);

   if (mysqli_num_rows($result)) {
      $row = mysqli_fetch_array($result);
      $count = $row['institution_cnt'];

      if($count > 0){
         echo json_encode(array("Institution Exist"));
      }else{
         echo json_encode(array("Institution Doesnt Exist"));
      }
   }

   die;
}