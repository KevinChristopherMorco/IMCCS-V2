
<?php

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


if (isset($_POST['code-login'])) {

    $code = $_POST['code'];


    $sql = $mysqli->prepare("SELECT * FROM institution_tbl  WHERE code = ?");
    $sql->bind_param('s', $code);
    $sql->execute();
    $result = $sql->get_result();


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {

       // header("location:index.php?page=login");
       $_SESSION['loggedin'] = true;
       $_SESSION['name'] = $row['name'];
       $_SESSION['user_id'] = $generatedString;

       $_SESSION['institution_id'] = $row['institution_id'];

       header("location:index.php?page=landing-page");
        }
    } else {
        header("location:index.php");
    }
    $sql->close();
}
