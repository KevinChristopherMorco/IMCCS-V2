<!-- Modal -->
<div class="modal landing-page-modal fade" id="myModalss" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">IMCCS form</h5>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="user-registration">
                    <h5 class="mb-4">Please provide the correct details:</h5>
                    <input type="text" class="form-control" id="user-bdate" placeholder="Choose your birthdate" onfocus="(this.type='date')">

                    <select class="form-select" id="user-add-genders">
                        <option selected disabled>Select your gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Gay">Gay</option>
                        <option value="Lesbian">Lesbian</option>
                        <option value="Bisexual">Bisexual</option>
                        <option value="Asexual">Asexual</option>
                        <option value="Transgender Male">Transgender Male</option>
                        <option value="Transgender Female">Transgender Female</option>
                    </select>

                    <input type="hidden" class="form-control" id="user-idsession" value=<?php echo $_SESSION['user_id']; ?>>
                    <input type="hidden" class="form-control" id="user-institution-id" value=<?php echo $_SESSION['institution_id']; ?>>

            </div>
            <div class="modal-footer">
                <a href="logout.php"  class="btn btn-secondary">Go back</a>
                <input type="submit" id="submit" name="save" value="Done" class="btn btn-submit">
            </div>
            </form>
        </div>
    </div>
</div>