<?php
// $token = $_GET['email'];
$token = $_GET['token'];
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.26/sweetalert2.all.min.js"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="../../assets/css/main-style.css" />

</head>

<body>
    <div class="d-flex align-items-center justify-content-center mt-4">
        <div class="card text-center forget-pass" style="width: 600px;">
            <div class="card-header h5 text-white">Password Reset</div>
            <div class="card-body px-5">
                <p class="card-text py-2">
                    Please enter your newly created password and follow the instructions below:
                <div id="message" class="password-message text-center mb-3">
                    <h6 class="mb-2">Password Validation:</h6>
                    <p id="password-validation-lowercase" class="invalid">Must contain at least one <b>lowercase</b> letter</p>
                    <p id="password-validation-uppercase" class="invalid">Must contain at least one <b>uppercase</b> letter</p>
                    <p id="password-validation-number" class="invalid">Must contain at least one <b>number</b></p>
                    <p id="password-validation-length" class="invalid">Length must be at least <b>8 characters</b></p>
                    <p id="password-validation-match" class="invalid">Password must <b>match</b></p>
                </div>
                </p>
                <form action="javascript:void(0)" class="form-submit-forgotpass" id="form-submit-forgotpass" method="post" novalidate>
                    <div class="inputContainer">
                        <input class="form-control input-password mb-4 password myCpwdClass" type="password" id="user-forgot-password" name="newpassword" placeholder=" " required>
                        <label for="" class="label fw-bolder">New Password</label>
                    </div>
                    <div class="invalid-feedback password-feedback mb-4"></div>

                    <div class="inputContainer">
                        <input class="form-control input-password mb-4 password myCpwdClass" type="password" id="user-forgot-confirmpassword" name="confirmpassword" placeholder=" " required>
                        <label for="" class="label fw-bolder">Confirm Password</label>
                    </div>
                    <div class="invalid-feedback password-feedback mb-4"></div>
                    <input type="hidden" id="forgotpass-token" value="<?php echo $token ?>">

                    <input type="submit" class="btn btn-custom-primary" name="reset_pass" style="border-radius: 20px;" value="Reset Password">
                </form>
            </div>
        </div>
    </div>
    <script src="../../assets/js/forgot-pass-ajax.js"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>