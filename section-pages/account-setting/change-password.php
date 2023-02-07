<head>
    <style>
        .inputContainer {
            position: relative;
            height: 45px;
            width: 100%;
            margin-bottom: 17px;
            border: 1px solid #939496;
            border-radius: 7px;

        }

        .user-update-input {
            position: absolute;
            top: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
            border-color: 1px solid #DADCE0;
            border-radius: 7px;
            font-size: 16px;
            padding: 0 20px;
            z-index: 1;
        }


        .label {
            position: absolute;
            top: 15px;
            left: 15px;
            padding: 0 4px;
            background-color: white;
            color: #939496;
            font-size: 16px;
            transition: 0.5s;
            z-index: 1;
        }

        ::placeholder {
            color: transparent;
        }

        .user-update-input:focus+.label {
            top: -7px;
            left: 3px;
            z-index: 10;
            font-size: 14px;
            font-weight: 600;
            color: #800000;
        }

        .user-update-input:not(:placeholder-shown)+.label {
            top: -7px;
            left: 3px;
            z-index: 10;
            font-size: 14px;
            font-weight: 600;
        }

        .user-update-input:focus {
            border: 2px solid #800000;
        }

        .card.forget-pass .card-header {
            background-color: #800000;
        }
    </style>
</head>

<main id="main" class="main">
    <div class="pagetitle">
        </nav>
        <section class="main-section">
            <div class="main-content">
                <nav class="assessment-breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4">
                        <li class="breadcrumb-item"><a href="home-student.php?page=user-home"><i class="fa-solid fa-house"></i> Home</a></li>
                        <li class="breadcrumb-item active"><a href="#"><i class="fa-solid fa-lock"></i> Change Password</a></li>
                    </ol>
                </nav>
                <h1 class="text-center mb-2 pt-4">Account Security</h1>
                <p class="text-center mb-4">You can manage your password here</p>
                <div class="user-basic-information  col-10">
                    <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>">
                    <div class="col-sm-8">
                        <h4>Change Your Password</h4>
                    </div>
                    <div class="d-flex justify-content-lg-center align-items-center">
                        <div id="message" class="password-message text-center px-4 pb-4 pt-4 mt-4 mb-3">
                            <h6 class="mb-2">Password Validation:</h6>
                            <p id="password-validation-lowercase" class="invalid">Must contain at least one <b>lowercase</b> letter</p>
                            <p id="password-validation-uppercase" class="invalid">Must contain at least one <b>uppercase</b> letter</p>
                            <p id="password-validation-number" class="invalid">Must contain at least one <b>number</b></p>
                            <p id="password-validation-length" class="invalid">Length must be at least <b>8 characters</b></p>
                            <p id="password-validation-match" class="invalid">Password must <b>match</b></p>
                        </div>
                    </div>
                    <div class="change-pass-form mt-4">
                        <input type="hidden" id="student-id">

                        <form action="javascript:void(0)" id="update-student-password" method="post" novalidate>
                            <div class="mb-3">
                                <div class="text-input d-inline-flex align-items-center">
                                    <div class="inputContainer">
                                        <input class="form-control user-update-input" type="password" id="student-oldpassword" placeholder=" " required>
                                        <label for="student-oldpassword" class="label">Current Password</label>
                                    </div>
                                </div>
                                <div id="old-password-feedback" class="old-password-feedback"></div>

                            </div>

                            <div class="mb-3">
                                <div class="text-input d-inline-flex align-items-center">
                                    <div class="inputContainer">
                                        <input class="form-control user-update-input" type="password" id="user-update-password" placeholder=" " required>
                                        <label for="user-update-password" class="label">New Password</label>
                                    </div>
                                </div>
                                <div id="password-feedback" class="password-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <div class="text-input d-inline-flex align-items-center">
                                    <div class="inputContainer">
                                        <input class="form-control user-update-input" type="password" id="student-update-confirmpassword" placeholder=" " required>
                                        <label for="student-update-confirmpassword" class="label">Confirm Password</label>
                                    </div>

                                </div>
                                <div id="password-feedback" class="password-feedback"></div>
                            </div>


                            <div class="form-footer account-settings mt-4">
                                <input type="submit" id="save-institution" name="save" value="Save Changes" class="btn btn-custom-primary">
                            </div>
                    </div>
                    </form>
                </div>

            </div>

    </div>

    </section>
</main>