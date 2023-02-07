<?php include_once('../../database/config.php'); ?>

<?php
if (isset($_POST['user_id'])) {

    mysqli_autocommit($mysqli, FALSE);
    $user_id =  mysqli_real_escape_string($mysqli, $_POST['user_id']);
    $code =  mysqli_real_escape_string($mysqli, $_POST['code']);

    $assessment_id =  mysqli_real_escape_string($mysqli, $_POST['assessment_id']);
    $date_deadline =  mysqli_real_escape_string($mysqli, $_POST['date_deadline']);
    $date_submit =  mysqli_real_escape_string($mysqli, $_POST['date_submit']);
    $institution_id =  mysqli_real_escape_string($mysqli, $_POST['institution_id']);
    $email =  mysqli_real_escape_string($mysqli, $_POST['email']);
    $fname =  mysqli_real_escape_string($mysqli, $_POST['fname']);
    $assessmentTitle =  mysqli_real_escape_string($mysqli, $_POST['assessment_title']);
    $answers = json_decode($_REQUEST['answer'], true);


    $checkAssessmentChosen = $mysqli->prepare("SELECT * FROM assessment_chosen WHERE user_id = ?  AND assessment_id = ?");
    $checkAssessmentChosen->bind_param('ii', $user_id, $assessment_id);
    $checkAssessmentChosen->execute();
    $checkAssessmentChosen->store_result();
    $rowcount = $checkAssessmentChosen->num_rows;

    //Count the total items on the question
    $selOver = $mysqli->prepare("SELECT SUM(point) as point  FROM assessment_question_tbl WHERE assessment_id = ?");
    $selOver->bind_param('i', $assessment_id);
    $selOver->execute();
    $resultOver = $selOver->get_result();
    $returnCountOver = $resultOver->fetch_assoc();
    /*

    $queryScore = $mysqli->prepare("SELECT * FROM assessment_question_tbl question WHERE question.assessment_id= ?");
    $queryScore->bind_param('i', $assessment_id);
    $queryScore->execute();
    $resultScore = $queryScore->get_result();

    */

    $sql = "SELECT assessment_answers.question_id, assessment_answer, point FROM assessment_answer_tbl assessment_answers INNER JOIN assessment_question_tbl question WHERE assessment_answers.assessment_id = ? AND question.assessment_id = ? ";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $assessment_id, $assessment_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $queryChosenAssessment = $mysqli->prepare("SELECT * FROM assessment_tbl WHERE assessment_id= ?");
    $queryChosenAssessment->bind_param('i', $assessment_id);
    $queryChosenAssessment->execute();
    $resultChosenAssessment = $queryChosenAssessment->get_result();
    $returnChosenAssessment = $resultChosenAssessment->fetch_assoc();


    $selOver = $mysqli->prepare("SELECT SUM(point) as point  FROM assessment_question_tbl WHERE assessment_id = ? ");
    $selOver->bind_param('i', $assessment_id);
    $selOver->execute();
    $resultOver = $selOver->get_result();
    $returnCountOver = $resultOver->fetch_assoc();

    /*

    while ($row = $resultScore->fetch_assoc()) {
        $answerKey[] = $row['assessment_answer'];
        $pointKey[] = $row['point'];
    }
    */

    $correctAnswers = array();

    while ($row = $result->fetch_assoc()) {
        $pointKey[] = $row['point'];

        // Check if the correct answer for the current question is already stored in the $correctAnswers array
        if (isset($correctAnswers[$row['question_id']])) {
            // If the correct answer is already stored, append the new answer to the array
            $correctAnswers[$row['question_id']] .= ", {$row['assessment_answer']}";
        } else {
            // If the correct answer is not already stored, add the new answer to the array
            $correctAnswers[$row['question_id']] = $row['assessment_answer'];
        }
    }
    $score = 0;

    foreach ($answers  as $key => $value) {
        $question_id = $_POST['question_id'][$key];
       // $pointValue  = $_POST['point'][$key];

        $pointValue  = $value['point'];

        $answer = $value['answer'];

        // Check if the correct answer for the current question is stored in the $correctAnswers array
        if (isset($correctAnswers[$question_id])) {
            // Split the correct answer into an array of individual answers using a regular expression to match the comma delimiter
            $correctAnswersArray = preg_split('/,\s*/', $correctAnswers[$question_id]);
            // If the user's answer is in the array of correct answers, increment the score
            if (in_array($answer, $correctAnswersArray)) {
                $score += $pointValue * 1;
            }
        }
        $insert1 = $mysqli->prepare("INSERT INTO retake_answer_tbl(code, user_id, institution_id, assessment_id, question_id, point, question_answer) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert1->bind_param("sssssss", $code, $user_id, $institution_id, $assessment_id, $question_id, $pointValue, $answer);
        $insert1->execute();
    }
    $ans = number_format($score / $returnCountOver['point'] * 100);

    $verdict = null;

    if ($ans >= $returnChosenAssessment['passing_rate']) {
        $verdict = 'Passed';
    } else {
        $verdict = 'Failed';
    }

    $insert2 = $mysqli->prepare("INSERT INTO retake_chosen_tbl(code,user_id,institution_id,assessment_id) VALUES (?, ?, ?, ?)");
    $insert2->bind_param("siii", $code, $user_id, $institution_id, $assessment_id);
    $insert2->execute();

    $insert3 = $mysqli->prepare("INSERT INTO retake_score_tbl(code,user_id,institution_id,assessment_id,retake_score, verdict) VALUES (?, ?, ?, ?, ?, ?)");
    $insert3->bind_param("siiiis", $code, $user_id, $institution_id, $assessment_id, $score , $verdict);
    $insert3->execute();



    if ($date_deadline < $date_submit) {
      //  echo json_encode(array("exceed"));
      echo 'exceed';
        $mysqli->rollback();
    } else {
        if ($rowcount == 1) {
            if ($insert1 && $insert3) {
            //    echo json_encode(array("NotTaken"));
            echo 'NotTaken';

                $mysqli->commit();
            }
        } else if ($rowcount > 0) {
            /* echo json_encode(array("Taken"));
            mysqli_query($mysqli, "ROLLBACK");*/
          //  echo json_encode(array("NotTaken"));
          echo 'NotTaken';

            $mysqli->commit();
        }
    }
}
mysqli_query($mysqli, "SET AUTOCOMMIT=1");
/*

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../mail/Exception.php';
require '../../mail/PHPMailer.php';
require '../../mail/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'imccs-support@imccs.online';
    $mail->Password   = 'Kevinisback12345*';                            // SMTP password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->setFrom('imccs-support@imccs.online', 'IMCCS');
    $mail->addAddress($email);

    $token = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'), 0, 10);

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'IMCCS Quiz Retake Result';
    $mail->Body    = '<table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8">
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
                                    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;">' . $assessmentTitle . ' Retake Result</h1>
                                    <span
                                        style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                        Good Day !, <b> ' . $fname . ' </b><br></br>
                                        We would like to inform you that you have retaken the: <br></br><b>  ' . $assessmentTitle . ' Assessment </b>  with a score of:  <br></br>
                                        <h1> ' . $score . ' / ' . $returnCountOver['point'] . ' </h1> <br></br>
                                        Based on your results, you have <b> ' . $verdict . ' </b> the assessment<br></br>
                                        Taken On : ' . $date_submit . '
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
</table>';

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
  // echo json_encode(array("MailerError"));
  echo 'MailerError';

}
mysqli_close($mysqli);
?>
*/