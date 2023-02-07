   <!--
   <a href="javascript:void(0)" class="back-to-top">
       <i class="lni lni-chevron-up"> </i>
   </a>
  -->

   <!-- ====== All Javascript Files ====== -->
   <script src="assets/js/bootstrap.bundle.min.js"></script>
   <script src="assets/js/wow.min.js"></script>
   <script src="assets/js/main.js"></script>
   <script src="assets/js/student-pages.js"></script>
   <script src="assets/js/ajax.js"></script>
   <script src="assets/js/forgot-pass-ajax.js"></script>


   <script>
       // ==== for menu scroll
       const pageLink = document.querySelectorAll(".ud-menu-scroll");

       pageLink.forEach((elem) => {
           elem.addEventListener("click", (e) => {
               e.preventDefault();
               document.querySelector(elem.getAttribute("href")).scrollIntoView({
                   behavior: "smooth",
                   offsetTop: 1 - 60,
               });
           });
       });

       // section menu active
       function onScroll(event) {
           const sections = document.querySelectorAll(".ud-menu-scroll");
           const scrollPos =
               window.pageYOffset ||
               document.documentElement.scrollTop ||
               document.body.scrollTop;

           for (let i = 0; i < sections.length; i++) {
               const currLink = sections[i];
               const val = currLink.getAttribute("href");
               const refElement = document.querySelector(val);
               const scrollTopMinus = scrollPos + 73;
               if (
                   refElement.offsetTop <= scrollTopMinus &&
                   refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
               ) {
                   document
                       .querySelector(".ud-menu-scroll")
                       .classList.remove("active");
                   currLink.classList.add("active");
               } else {
                   currLink.classList.remove("active");
               }
           }
       }

       window.document.addEventListener("scroll", onScroll);
   </script>
   <!-- FEEDBACK -->
   <script>
       function checkFeedbackForm() {
           let fullname = document.getElementById('fullname').value;
           fullname.trim();
           let email = document.getElementById('email').value;
           email.trim();
           let mobile_no = document.getElementById('mobile_no').value;
           mobile_no.trim();
           let feedback_message = document.getElementById('feedback_message').value;
           feedback_message.trim();


           if (fullname == "" || email == "" || mobile_no == "" || feedback_message == "") {
               setTimeout(function() {
                   swal({
                       title: "Some Fields Are Empty",
                       text: "Please Fill Up the Required Fields",
                       type: "error"
                   })
               }, 1000);
           } else {
               setTimeout(function() {
                   swal({
                       title: "Submitted",
                       text: "Thank you for your feedback",
                       type: "error"
                   })
               }, 1000);
           }
       }
   </script>
   <script>
       function successfulFeedbackSubmit() {
           setTimeout(function() {
               swal({
                   title: "Feedback Submitted",
                   text: "We appreciate your comments and suggestions.",
                   type: "success"
               })
           }, 1000);
       }
   </script>

   <script>
       $(document).ready(function() {
           $('#sign-in').click(function() {
               $("body").removeClass();
           })
       });
   </script>