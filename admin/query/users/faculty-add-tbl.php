<?php include_once('../../../database/config.php'); ?>

<?php

//mysqli_autocommit($mysqli, FALSE);

$username = mysqli_real_escape_string($mysqli, ($_POST['username']));
$password = mysqli_real_escape_string($mysqli, $_POST['password']);
$hash = password_hash($password, PASSWORD_BCRYPT);
$usertype = mysqli_real_escape_string($mysqli, ucwords($_POST['usertype']));
$fname = mysqli_real_escape_string($mysqli, ucwords($_POST['fname']));
$lname = mysqli_real_escape_string($mysqli, ucwords($_POST['lname']));
$gender =  ucwords($_POST['gender']);
$institution = ucwords(strtolower($_POST['institution']));
$grade_level = mysqli_real_escape_string($mysqli, ucwords($_POST['grade_level']));
$email = mysqli_real_escape_string($mysqli, ($_POST['email']));
$contact = mysqli_real_escape_string($mysqli, $_POST['contact']);

date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d H:i:s");

$checkInstitution = $mysqli->prepare("SELECT name from institution_tbl WHERE name=?");
$checkInstitution->bind_param('s', $institution);
$checkInstitution->execute();
$checkInstitution->store_result();
$returnCheckInstitution = $checkInstitution->num_rows;


$checkUsername = $mysqli->prepare("SELECT username from student_faculty_profile_tbl WHERE username=?");
$checkUsername->bind_param('s', $username);
$checkUsername->execute();
$checkUsername->store_result();
$returnCheckUsername = $checkUsername->num_rows;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../../mail/Exception.php';
require '../../../mail/PHPMailer.php';
require '../../../mail/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
$api_key = "e99a40036c2b4f10bb88b98ab1e79c6f";

$ch = curl_init();

curl_setopt_array($ch, [
    CURLOPT_URL => "https://emailvalidation.abstractapi.com/v1?api_key=$api_key&email=$email",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true
]);

$response = curl_exec($ch);

curl_close($ch);

$data = json_decode($response, true);

if ($data['deliverability'] === "UNDELIVERABLE") {
    echo json_encode(array("Undeliverable"));
    exit;
}
if ($data["is_disposable_email"]["value"] === true) {
    echo json_encode(array("Disposable"));
    exit;
} else {
    $mysqli->autocommit(FALSE);
    if ($returnCheckInstitution == 1) {


        if (strlen($username) < 5) {
            echo json_encode(array("Username Length is Invalid"));
            $mysqli->rollback();
        } else if (strlen($contact) != 11) {
            echo json_encode(array("Contact Number Length is Invalid"));
            $mysqli->rollback();
        } else if ($returnCheckUsername == 1) {
            echo json_encode(array("Username Exists Already"));
            $mysqli->rollback();
        } else {

            $stmt = $mysqli->prepare("INSERT INTO user_tbl (email,password, usertype, created_at) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $email, $hash, $usertype, $timestamp);
            $stmt->execute();

            $stmt = $mysqli->prepare("INSERT INTO student_faculty_profile_tbl (user_id, fname, lname,gender, institution, grade_level, username, contact_no, created_at) VALUES (LAST_INSERT_ID(), ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $fname, $lname, $gender, $institution, $grade_level, $username, $contact, $timestamp);
            $stmt->execute();
            echo json_encode(array("Existing Code"));
        }
    } else {
        echo json_encode(array("No Existing Code"));
        $mysqli->rollback();
    }

    $mysqli->commit();
    try {

        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'imccs-onlinesupport@imccs.online';
        $mail->Password   = 'Kevinisback12345*';                            // SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;


        /*
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '9ccf23b8516359';
        $mail->Password = '20cdbb486b9762';
*/

        $mail->setFrom('imccs-onlinesupport@imccs.online', 'IMCCS');
        $mail->addAddress($email, 'You');

        $token = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'IMCCS Account Registration';
        $mail->Body    = '
    <html>
    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8">
    <tr>
        <td>
            <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                      <a href="https://imccs.online" title="logo" target="_blank">
                        <img width="60" src="https://i.ibb.co/d03Mhh0/IMCCS-black.png" " title="logo" alt="logo">
                      </a>
                    </td>
                </tr>
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                            style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="padding:0 35px;">
                                    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;">IMCCS Account Registration</h1>
                                    <span
                                        style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                       Your Account Password is: ' . $password . ' <br></br>
                                      <b> Please do not share this with anyone. </b>
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="height:40px;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                <tr>
                    <td style="height:20px;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:center;">
                        <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.imccs.online</strong></p>
                    </td>
                </tr>
                <tr>
                    <td style="height:80px;">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</html>';

        $conn = new mySqli('localhost', 'u351518056_capstone', 'H7xpO*D>9d', 'u351518056_capstone');
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }

        $verifyQuery = $conn->query("SELECT * FROM user_tbl WHERE email = '$email'");

        if ($verifyQuery->num_rows) {
            $codeQuery = $conn->query("UPDATE user_tbl  set  token='$token' WHERE email = '$email'");

            $mail->send();
        }
        $conn->close();
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        echo json_encode(array("Mailer Error"));
    }
}
mysqli_close($mysqli);
?>



