<?php include_once('templates/header.php');
?>
<?php include_once('database/config.php'); ?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LOGIN</title>
    <style>
        .navbar {
            display: none;
        }
    </style>
</head>


<!-- ====== Login Start ====== -->
<section class="login-section">
    <a href="index.php" class="btn-custom-secondary" style="top:10px; position:absolute;"><i class="fa-solid fa-arrow-left"></i> Go Back</a>

    <div class="row">
        <div class="login-section-wrapper">
            <div class="image-holder">
            </div>
            <div class="login-section-logo">
                <img src="assets/images/website-main-logo/IMCCS-black.png" width="150px" height="75px" alt="logo" />
            </div>
            <h4 class="mb-4">Please Login Your Account</h4>

            <div class="login-section-form-container">
            <form class="login-section-form" action="index.php" method="POST">
            <div style="width: 100%;">
                <?php if (!empty($_SESSION['errMsg'])) {
                    echo '<div class="error">';
                    echo $_SESSION['errMsg'];
                    echo '</div></br>';
                } ?>
            </div>
            <?php unset($_SESSION['errMsg']); ?>
                <div class="login-form-group">
                    <input type="text" name="email" placeholder="Email" />
                </div>
                <div class="login-form-group">
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="user-password" placeholder="*********" />
                        <i class="fa-solid fa-eye-slash" id="login-toggle-password"></i>
                    </div>
                </div>

                <div class="login-form-group">
                    <input type="submit" name="login" value="Login" class="btn btn-custom-primary login">
                </div>

            </form>
            </div>
            <a class="forget-pass" href="index.php?page=forgot-password">
                Forgot Password?
            </a>
            <p class="signup-option">
                No Existing Account ? <a href="javascript:void(0)" class="sign-in"> Sign Up </a>
            </p>
        </div>
    </div>
</section>
<!-- ====== Login End ====== -->

<script type='text/javascript'>
    var loginTogglePassword = document.querySelector("#login-toggle-password");
    var loginPassword = document.querySelector("#user-password");

    loginTogglePassword.addEventListener("click", function() {
        // toggle the type attribute
        var type = loginPassword.getAttribute("type") === "password" ? "text" : "password";
        loginPassword.setAttribute("type", type);

        // toggle the icon
        this.classList.toggle("fa-eye");
    });
</script>