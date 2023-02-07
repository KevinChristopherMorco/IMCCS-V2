<section id="contact" class="contact">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-8 col-lg-7">
                <div class="contact-content-wrapper">
                    <div class="contact-title">
                        <span>CONTACT US</span>
                        <h2 class="faq">
                            For more information<br />
                            You can send us a messeage here!
                        </h2>
                    </div>
                    <div class="contact-info-wrapper">
                        <div class="single-info">
                            <div class="info-icon">
                                <i class="lni lni-map-marker"></i>
                            </div>
                            <div class="info-meta">
                                <h5>Our Location</h5>
                                <p>Santa Cruz Laguna (Mock Location)</p>
                            </div>
                        </div>
                        <div class="single-info">
                            <div class="info-icon">
                                <i class="lni lni-envelope"></i>
                            </div>
                            <div class="info-meta">
                                <h5>How Can We Help?</h5>
                                <p>test@gmail.com (Mock Location)</p>
                                <p>test@yahoo.com (Mock Location)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5">
                <div class="contact-form-wrapper wow fadeInUp" data-wow-delay=".2s">
                    <h3 class="contact-form-title">Send us a Message</h3>
                    <form action="javascript:void(0)" class="contact-form"  method="POST">
                        <div class="index-form-group">
                            <label for="fullName">Full Name*</label>
                            <input type="text" name="fullname" id="fullname" placeholder="Juan Dela Cruz" />
                        </div>
                        <div class="index-form-group">
                            <label for="email">Email*</label>
                            <input type="email" name="email" id="email" placeholder="juan@email.com" required />
                        </div>
                        <div class="index-form-group">
                            <label for="phone">Phone*</label>
                            <input type="text" name="mobile_no" id="mobile-no" placeholder="09123456789" required />
                        </div>
                        <div class="index-form-group">
                            <label for="message">Message*</label>
                            <textarea name="feedback_message" id="feedback-message" rows="1" placeholder="Place your feedbacks here" required></textarea>
                        </div>
                        <div class="index-form-group mb-0">
                            <input type="submit" name="submit" value="Send Feedback" onclick="checkFeedbackForm();" class="btn">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
     $('.contact-form').submit(function(event) {
        event.preventDefault();

        var fullname = $('#fullname').val();
        var email = $('#email').val();
        var mobile_no = $('#mobile-no').val();
        var feedback_message = $('#feedback-message').val();

                $.ajax({
                    type: "POST",
                    url: "query/create-feedback.php",
                    data: {
                        fullname: fullname,
                        email: email,
                        mobile_no: mobile_no,
                        feedback_message: feedback_message
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data == 'Feedback Added') {
                            Swal.fire({
                                title: 'Feedback Submitted!',
                                icon: 'success',
                                confirmButtonColor: '#800000',
                                confirmButtonText: 'OK'
                            })
                        }
                    },
                    error: function(xhr, status, error) {


                    }
                });


    });
</script>