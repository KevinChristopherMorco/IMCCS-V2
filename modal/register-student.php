<head>
    <style>
        div.g-recaptcha {
            margin: 0 auto;
            width: 304px;
        }
    </style>
</head>
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="add_student_modal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">Create an Account</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body">
                <form id="form1" name="form1" class="needs-validation" method="post" novalidate>
                    <div class="container">
                        <div class="custom-progress-bar">
                            <div class="mb-4" style="text-align:center;">
                                <span class="step" id="step-1">1</span>
                                <span class="step" id="step-2">2</span>
                                <span class="step" id="step-3">3</span>
                                <span class="step" id="step-4">4</span>
                            </div>
                        </div>

                        <div class="tab" id="tab-1">
                            <h4 class="mb-4">Your Fullname:</h4>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" placeholder="First Name" id="user-add-firstname" name="firstname" required>
                                <div class="invalid-feedback feedback-fname">
                                    <i class="fa-solid fa-triangle-exclamation"></i> Please enter your first name.
                                </div>
                            </div>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control" placeholder="Last Name" id="user-add-lastname" name="lastname">
                                <div class="invalid-feedback feedback-lname">
                                    <i class="fa-solid fa-triangle-exclamation"></i> Please enter your last name.
                                </div>
                            </div>
                            <select class="form-control form-select" id="user-add-gender" class="user-add-gender" name="gender">
                                <option value="none" selected>Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option class="editable" value="Other:">Other:</option>
                            </select>
                            <input class="customGender" style="display:none;"></input>
                            <div class="invalid-feedback feedback-gender">
                                <i class="fa-solid fa-triangle-exclamation"></i> Please enter your gender.
                            </div>
                            <div class="modal-footer">
                                <div class="btn btn-submit" onclick="checkFormValue1();">Next</div>
                            </div>
                        </div>

                        <div class="tab" id="tab-2">
                            <h4 class="mb-4">Education Institution:</h4>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control  myInstitution" id="user-add-institution" name="institution" placeholder="Enter Institution" required />
                                <div class="input-tooltip" data-bs-placement="right">
                                    <i class="fa-solid fa-circle-question"></i>
                                </div>
                                <div id="institution-feedback" class="invalid-feedback">
                                </div>
                            </div>


                            <div class="input-group has-validation">
                                <select class="form-control form-select" name="grade_level" id="user-add-grade-level" required>
                                    <option disabled selected>Please Select Grade Level</option>
                                    <optgroup label="Junior High">
                                        <option class="junior-high" value="Grade 7">Grade 7</option>
                                        <option class="junior-high" value="Grade 8">Grade 8</option>
                                        <option class="junior-high" value="Grade 9">Grade 9</option>
                                        <option class="junior-high" value="Grade 10">Grade 10</option>
                                    </optgroup>

                                    <optgroup label="Senior High">
                                        <option value="Grade 11">Grade 11</option>
                                        <option value="Grade 12">Grade 12</option>
                                    </optgroup>

                                    <optgroup label="College Level">

                                        <option value="1st Year">1st Year</option>
                                        <option value="2nd Year">2nd Year</option>
                                        <option value="3rd Year">3rd Year</option>
                                        <option value="4th Year">4th Year</option>
                                        <option value="N/A">N/A</option>
                                    </optgroup>

                                </select>
                                <div class="invalid-feedback feedback-grade-level" id="feedback-grade-level">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="btn modal-cancel" onclick="run(2, 1);">Previous</div>
                                <div class="btn btn-submit" onclick="checkFormValue2();">Next</div>
                            </div>
                        </div>

                        <div class="tab" id="tab-3">
                            <h4 class="mb-4">Contact Details:</h4>
                            <div class="input-group has-validation">
                                <input type="text" class="form-control myEmail" id="user-add-email" name="email" placeholder="Enter Email" required />
                                <div id="email-feedback" class="invalid-feedback"></div>
                            </div>

                            <div class="input-group has-validation">
                                <input type="text" class="form-control myContact" id="user-add-contact" name="contact" placeholder="Enter Contact Number " required />
                                <div id="contact-feedback" class="invalid-feedback"></div>
                            </div>



                            <div class="modal-footer">
                                <div class="btn modal-cancel" onclick="run(3, 2);">Previous</div>
                                <div class="btn btn-submit" onclick="checkFormValue3();">Next</div>
                            </div>
                        </div>

                        <div class="tab" id="tab-4">
                            <h4 class="mb-4">Setup Account:</h4>
                            <div class="d-flex justify-content-lg-center align-items-center password-message-container">
                                <div id="message" class="password-message text-center px-4 pt-4 mb-3">
                                    <h6 class="mb-2">Password Validation:</h6>
                                    <p id="password-validation-lowercase" class="invalid">Must contain at least one <b>lowercase</b> letter</p>
                                    <p id="password-validation-uppercase" class="invalid">Must contain at least one <b>uppercase</b> letter</p>
                                    <p id="password-validation-number" class="invalid">Must contain at least one <b>number</b></p>
                                    <p id="password-validation-length" class="invalid">Length must be at least <b>8 characters</b></p>
                                    <p id="password-validation-match" class="invalid">Password must <b>match</b></p>

                                </div>
                            </div>

                            <div class="input-group has-validation">
                                <input type="text" class="form-control myUsername" id="user-add-username" name="username" placeholder="Username" required />
                                <div id="feedback-username" class="invalid-feedback"></div>
                            </div>


                            <div class="input-password-group">
                                <input type="password" class="form-control myCpwdClass" id="user-add-password" name="password" placeholder="Password" required />
                                <div class="eye-viewer">
                                    <i class="fa-solid fa-eye-slash" id="toggle-password"></i>
                                </div>
                            </div>
                            <div class="invalid-feedback password-feedback"></div>


                            <div class="input-password-group">

                                <input type="password" class="form-control myCpwdClass" id="user-add-confirmpassword" placeholder="Confirm your Password" required />
                                <div class="eye-viewer">
                                    <i class="fa-solid fa-eye-slash" id="toggle-confirm-password"></i>
                                </div>
                            </div>

                            <div class="invalid-feedback password-feedback"></div>


                            <!--<label class="form-label">Who are you?</label>
                            <div class="btn-group btn-toggle-type" data-toggle="buttons">
                                <input type="radio" class="type" name="type" id="user-add-faculty" value="Faculty" checked />
                                <label for="user-add-faculty" class="btn btn-default"> I'm a faculty staff </label>
                                <input type="radio" class="type" name="type" id="user-add-student" value="Student" />
                                <label for="user-add-student" class="btn btn-default"> I'm a student </label>
                                <div class="invalid-feedback">
                                    Please choose one.
                                </div>
                            </div>-->


                            <div class="modal-footer">
                                <div class="btn modal-cancel" onclick="run(4, 3);">Previous</div>
                                <div class="btn btn-submit" onclick="checkFormValue4();">Next</div>
                            </div>
                        </div>

                        <div class="tab" id="tab-5">
                            <div class="cc-selector" style="text-align: center;">
                                <h4 class="mb-3">Final Step!</h4>
                                <h6 class="mb-4"> Indicate if you're a faculty or student </h6>
                                <input type="radio" class="type" name="type" id="user-add-faculty" value="Faculty" checked />
                                <label for="user-add-faculty" class="user-card-cc faculty" for="user-add-faculty"></label>
                                <input type="radio" class="type" name="type" id="user-add-student" value="Student" />
                                <label for="user-add-student" class="user-card-cc student" for="user-add-student"></label>
                                <input type="radio" class="type" name="type" id="user-add-personnel" value="Personnel" />
                                <label for="user-add-personnel" class="user-card-cc personnel" for="user-add-personnel"></label>
                            </div>

                              <!--  <div data-type="image" class="g-recaptcha" data-sitekey="6LdUoyMjAAAAAJj81CNdE_5UKEKbhY706L4o7XN_"></div> -->

                            <div class="modal-footer">
                                <div class="btn modal-cancel" onclick="run(5, 4);">Previous</div>
                                <input type="submit" id="submit" name="save" value="Register" class="btn btn-submit">
                            </div>
                        </div>
                    </div>
            </div>

            </form>
        </div>
    </div>
</div>




<script>
    $('#user-add-firstname').on('keyup', function() {
        $('#user-add-firstname').addClass('is-valid');
        $('#user-add-firstname').removeClass('is-invalid');
    })

    $('#user-add-lastname').on('keyup', function() {
        $('#user-add-lastname').addClass('is-valid');
        $('#user-add-lastname').removeClass('is-invalid');
    })
</script>

<script type='text/javascript'>

</script>

<script>

</script>

<script>

</script>