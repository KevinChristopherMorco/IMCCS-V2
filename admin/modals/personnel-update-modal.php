<div class="modal fade" id="update-personnel-modal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-xl">
            <div class="modal-header modal-xl">
                <h3 class="modal-title">Update Personnel Information</h3>
            </div>
            <div class="modal-body">
                <form class="form-update-personnel" id="form-update-personnel" action="javascript:void(0)" method="POST" novalidate>
                <div class="container">
                        <div class="row mb-3">
                        <input type="hidden" name="user_id" id="personnel-id">

                            <label class="col-2 col-form-label">Personnel name</label>
                            <div class="col-5">

                                <div class="input-group has-validation">

                                    <input type="text" class="form-control" id="personnel-update-firstname" name="fname" placeholder="First Name" required />

                                    <div class="invalid-feedback feedback-fname">
                                        <i class="fa-solid fa-triangle-exclamation"></i> Please enter the first name.
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="input-group has-validation">
                                    <input type="text" class="form-control" id="personnel-update-lastname" name="lname" placeholder="Last Name" required />
                                    <div class="invalid-feedback feedback-lname">
                                        <i class="fa-solid fa-triangle-exclamation"></i> Please enter the last name.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="personnel-update-gender" class="col-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="personnel-update-gender" name="gender" placeholder="Enter Gender" required />
                                <div class="invalid-feedback feedback-gender">
                                        <i class="fa-solid fa-triangle-exclamation"></i> Please enter the gender.
                                    </div>
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="personnel-update-institution" class="col-2 col-form-label">Institution</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control  myInstitution" id="personnel-update-institution" name="institution" placeholder="Enter Institution" required />
                                <div id="" class="invalid-feedback institution-feedback">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="personnel-update-grade-level" class="col-2 col-form-label">Grade Level</label>
                            <div class="col-10">
                                <div class="input-group has-validation">
                                    <select class="form-control form-select" name="grade_level" id="personnel-update-grade-level" required>
                                        <option value="" disabled selected>Please Select</option>
                                        <option value="" disabled>Please Select Grade Level</option>
                                        <option value="Grade 7">Grade 7</option>
                                        <option value="Grade 8">Grade 8</option>
                                        <option value="Grade 9">Grade 9</option>
                                        <option value="Grade 10">Grade 10</option>
                                        <option value="Grade 11">Grade 11</option>
                                        <option value="Grade 12">Grade 12</option>
                                        <option value="" disabled>Please Select Year Level</option>
                                        <option value="1st Year">1st Year</option>
                                        <option value="2nd Year">2nd Year</option>
                                        <option value="3rd Year">3rd Year</option>
                                        <option value="4th Year">4th Year</option>
                                        <option value="N/A">N/A</option>
                                    </select>
                                    <div class="invalid-feedback feedback-grade-level" id="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <label class="col-2 col-form-label">Email</label>
                            <div class="col-10">

                                <div class="input-group has-validation">
                                    <input type="text" class="form-control myEmail" id="personnel-update-email" name="email" placeholder="Enter Email" required />
                                    <span class="input-group-text"><i class="fa-solid fa-envelope-circle-check"></i></span>

                                    <div id="" class="invalid-feedback email-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Contact</label>
                            <div class="col-10">

                                <div class="input-group has-validation">

                                    <input type="text" class="form-control myContact" id="personnel-update-contact" name="contact" placeholder="Enter Contact Number " required />
                                    <span class="input-group-text"><i class="fa-solid fa-phone-flip"></i></span>

                                    <div id="" class="invalid-feedback contact-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Username</label>
                            <div class="col-10">

                                <div class="input-group has-validation">
                                    <input type="text" class="form-control myUsername" id="personnel-update-username" name="username" placeholder="Username" required />
                                    <div id="" class="invalid-feedback feedback-username"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-2 col-form-label">Password</label>
                            <div class="col-10">

                                <input type="password" class="form-control" id="personnel-update-password" name="password" value="<?php echo $code ?>" placeholder="Password" required disabled />
                                <div class="invalid-feedback">
                                    Please enter your password.
                                </div>
                            </div>

                            <div class="col-12 mt-3">
                                <input type="hidden" class="type" name="type" id="personnel-personnel" value="personnel" />
                            </div>

                        </div>

                    </div>

            </div>

            <div class="modal-footer">
                <button class="btn modal-cancel" type="button" data-bs-dismiss="modal">Close</button>
                <input type="submit" id="update" name="update" value="Update" class="btn modal-edit">
            </div>
            </form>
        </div>
    </div>
</div>