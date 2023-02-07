<section class="page-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h1>Account Recovery</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="d-flex align-items-center justify-content-center mt-4">
    <div class="card text-center forget-pass" style="width: 600px;">
        <div class="card-header h5 text-white">Password Reset</div>
        <div class="card-body px-5">
            <p class="card-text py-2">
                Please enter your registered email address and we'll send an email to reset your password.
            </p>
            <form action="javascript:void(0)" class="forgot-pass" id="forgot-pass" method="post" novalidate>

                <div class="inputContainer">
                    <input class="form-control email-input" type="email" name="forgot-email" id="forgot-email" placeholder=" " required>
                    <label for="" class="label">Email</label>
                </div>
                <div class="invalid-feedback email-feedback d-block"></div>

                <input type="submit" class="btn btn-custom-primary" name="reset" style="border-radius: 20px;" value="Reset Password">
            </form>
        </div>
    </div>
</div>


<script>

</script>