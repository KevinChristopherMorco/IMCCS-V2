<head>
    <style>

    </style>
</head>
<main id="main" class="main user-personal-info">
    <div class="pagetitle">
        <section class="main-section">
            <div class="main-content">
                <nav class="assessment-breadcrumb" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb mt-4">
                        <li class="breadcrumb-item"><a href="home-student.php?page=user-home"><i class="fa-solid fa-house"></i> Home</a></li>
                        <li class="breadcrumb-item active"><a href="#"><i class="fa-solid fa-id-card"></i> Personal Information</a></li>
                    </ol>
                </nav>
                <input type="hidden" id="get-user-id" value="<?php echo $_SESSION['user_id']; ?>">
                <h1 class="text-center mb-2 pt-4">Personal Info</h1>
                <p class="text-center mb-4">Personal information about you across IMCCS</p>
                <div class="user-basic-information col-10">
                    <h4>Basic Information</h4>
                    <div class="change-pass-form mt-4">
                        <form action="javascript:void(0)" id="update-user-personal-info" method="post" novalidate>
                            <input type="hidden" id="user-id">
                            <div class="row">

                                <div class="mb-3 col-sm-12 col-lg-6">
                                    <div class="text-input d-inline-flex align-items-center">
                                        <div class="input-group has-validation">
                                            <div class="inputContainer">
                                                <input class="form-control user-update-input" type="text" id="user-update-fname" placeholder=" " required>
                                                <label for="user-update-fname" class="label">First Name</label>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>

                                </div>
                                <div class="mb-3 col-sm-12 col-lg-6">

                                    <div class="text-input d-inline-flex align-items-center">
                                        <div class="inputContainer">
                                            <input class="form-control user-update-input" type="text" id="user-update-lname" placeholder=" " required>
                                            <label for="user-update-lname" class="label">Last Name</label>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>


                            <div class="form-footer account-settings mt-4">
                                <input type="submit" name="save" value="Save Changes" class="btn btn-custom-primary update-personal-info">
                            </div>
                    </div>
                    </form>
                </div>

                <div class="user-basic-information col-10 mt-4">
                    <h4>Academic Information</h4>
                    <div class="change-pass-form mt-4">
                        <form action="javascript:void(0)" id="update-user-academic-info" method="post" novalidate>
                            <div class="row">

                                <div class="mb-3 col-sm-12 col-lg-6">
                                    <div class="text-input d-inline-flex align-items-center">
                                        <div class="inputContainer">
                                            <input class="form-control user-update-input" type="text" id="user-update-institution" placeholder=" " required>
                                            <label for="user-update-institution" class="label">Institution Name</label>
                                        </div>
                                    </div>
                                    <div class="personal-feedback">
                                    </div>
                                </div>
                                <div class="mb-3 col-sm-12 col-lg-6">
                                    <div class="text-input d-inline-flex align-items-center">
                                        <div class="inputContainer">
                                            <input class="form-control user-update-input" type="text" id="user-update-grade-level" placeholder=" " required>
                                            <label for="user-update-grade-level" class="label">Grade Level</label>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>

                            <div class="form-footer account-settings mt-4">
                                <input type="submit" name="save" value="Save Changes" class="btn btn-custom-primary update-personal-info">
                            </div>
                    </div>
                    </form>
                </div>

                <div class="user-basic-information col-10 mt-4">
                    <div class="col-sm-8">
                        <h4>Contact Information</h4>
                    </div>
                    <div class="change-pass-form mt-4">
                        <form action="javascript:void(0)" id="update-user-contact-info" method="post" novalidate>
                            <div class="row">

                                <div class="mb-3 col-sm-12 col-lg-6">
                                    <div class="text-input d-inline-flex align-items-center">
                                        <div class="inputContainer">
                                            <input class="form-control user-update-input" type="text" id="user-update-email" placeholder=" " required>
                                            <label for="user-update-email" class="label">Email</label>
                                        </div>
                                    </div>
                                    <div class="email-feedback">
                                    </div>
                                </div>
                                <div class="mb-3 col-sm-12 col-lg-6">
                                    <div class="text-input d-inline-flex align-items-center">
                                        <div class="inputContainer">
                                            <input class="form-control user-update-input" type="text" id="user-update-contact" placeholder=" " required>
                                            <label for="user-update-contact" class="label">Contact</label>
                                        </div>
                                    </div>
                                    <div class="contact-feedback">
                                    </div>
                                </div>
                                <div class="form-footer account-settings mt-4">
                                    <input type="submit" name="save" value="Save Changes" class="btn btn-custom-primary ">
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
</main>