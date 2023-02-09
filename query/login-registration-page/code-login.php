<?php include('../../database/config.php'); ?>
<?php session_start() ?>

<?php
/*

function generateUniqueString($length = 10) {
    // start with a unique identifier
    $uniqueString = uniqid();

    // add a random string to the unique identifier
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    for ($i = 0; $i < $length; $i++) {
        $uniqueString .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return substr($uniqueString, 0, 255);
}
$generatedString = generateUniqueString(10);
*/



if (isset($_POST['code'])) {

    $code = $_POST['code'];
    $visitorID = $_POST['visitorId'];


    $sql = $mysqli->prepare("SELECT * FROM institution_tbl  WHERE code = ?");
    $sql->bind_param('s', $code);
    $sql->execute();
    $result = $sql->get_result();


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            // Get the status
            $status = $row['status'];

            // Check if the status is inactive
            if ($status == "Inactive") {
                echo "Inactive";
            } else {
                $_SESSION['loggedin'] = true;
                $_SESSION['name'] = $row['name'];
                $_SESSION['type'] = $row['type'];

                $_SESSION['user_id'] = $visitorID;

                $_SESSION['institution_id'] = $row['institution_id'];
                echo 'Code Exist';
            }
        }
    } else {
        echo 'Code Not Exist';
    }
    $sql->close();
}
