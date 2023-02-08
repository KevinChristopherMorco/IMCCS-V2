<?php include_once('../../database/config.php'); ?>

<?php

if(isset($_POST['id'])){
   $id = mysqli_real_escape_string($mysqli,$_POST['id']);
   $checkID = $mysqli->prepare("select count(*) as id_cnt from user_profile where user_id= ?");
   $checkID->bind_param('s', $id);
   $checkID->execute();
   $returnCheckID = $checkID->get_result();
   $row = $returnCheckID->fetch_assoc();

   $count = $row['id_cnt'];

   if ($count > 0) {
      echo json_encode(array("ID Exists"));
   } else {
      echo json_encode(array("This ID Doesn't Exist"));
   }


   die;
}