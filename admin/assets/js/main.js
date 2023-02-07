function invalidEmpty() {
  Swal.fire({
      title: 'Some fields are invalid!',
      text: "Please check your inputs and fill up the form correctly.",
      icon: 'error',
      confirmButtonColor: '#800000',
      confirmButtonText: 'OK',
      allowOutsideClick: false,

  })
}

function adminValidateEmail() {
  // get value of input email
  var email = $("#user-add-email").val();
  var updateEmail = $("#user-update-email").val();

  // use reular expression
  var reg = new RegExp("^[_A-Za-z0-9-]+(\\.[_A-Za-z0-9-]+)*@(gmail|yahoo|hotmail)+\.(com|org)$");
  if (reg.test(email) || reg.test(updateEmail)) {
      return true;
  } else {
      return false;
  }
}

/* AJAX REGISTRATION PROCESS */
function adminValidatePhoneNumber() {
  // get value of input email
  var contact = $("#user-add-contact").val();
  var updateContact = $("#user-update-contact").val();

  // use reular expression
  var reg = new RegExp("(09)\\d{9}");
  if (reg.test(contact) || reg.test(updateContact) ) {
      return true;
  } else {
      return false;
  }

}

function adminValidInteger() {
  // return theNumber.match(/^\d+$/) && parseInt(theNumber) > 0;

  var contact = $("#user-update-contact").val();

  var regex = /^[0-9]+$/;
  if (contact.match(regex)) {
      return true;
  }
}

(function () {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function (e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  /**
   * Search bar toggle
   */
  if (select('.search-bar-toggle')) {
    on('click', '.search-bar-toggle', function (e) {
      select('.search-bar').classList.toggle('search-bar-show')
    })
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Initiate tooltips
   */
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })


  /**
   * Initiate Bootstrap validation check
   */
  var needsValidation = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(needsValidation)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })

})();

/*// store the currently selected tab in the hash value
$("ul.nav-pills > li.nav-item > a.nav-link ").on("shown.bs.tab", function(e) {
    var id = $(e.target).attr("href").substr(1);
    window.location.hash = id;
  });

  // on load of the page: switch to the currently selected tab
  var hash = window.location.hash;
  $('#nav-pills a[href="' + hash + '"]').tab('show');*/

$(document).ready(function () {

  if (location.hash) {
    $('a[href=\'' + location.hash + '\']').tab('show');
  }
  var activeTab = localStorage.getItem('activeTab');
  if (activeTab) {
    $('a[href="' + activeTab + '"]').tab('show');
  }

  $('body').on('click', 'a[data-bs-toggle=\'pill\']', function (e) {

    e.preventDefault()
    var tab_name = this.getAttribute('href')
    if (history.pushState) {
      history.pushState(null, null, tab_name)
    }
    else {
      location.hash = tab_name
    }
    localStorage.setItem('activeTab', tab_name)

    $(this).tab('show');
    return false;
  });
  $(window).on('popstate', function () {
    var anchor = location.hash ||
      $('a[data-bs-toggle=\'pill\']').first().attr('href');
    $('a[href=\'' + anchor + '\']').tab('show');
  });

});

/* ACCOUNT SETTING */

/* ACCOUNT SETTINGS */

$(document).ready(function () {
  var id = $('#get-user-id').val()

  $.ajax({
    type: 'POST',
    url: 'query/account-setting/user-getid-view.php',
    data: {
      user_id: id
    },
    dataType: 'json',
    success: function (res) {
      $('#user-id').val(res.user_id);
      $('#user-update-fname').val(res.fname);
      $('#user-update-lname').val(res.lname);
      $('#user-update-institution').val(res.institution);
      $('#user-update-grade-level').val(res.grade_level);
      $('#user-update-email').val(res.email);
      $('#user-update-contact').val(res.contact_no);
    }
  });

});


$('#update-user-personal-info').submit(function (event) {
  $("#update-user-personal-info input").each(function (e) {

    var checkEmptyInput = $(this);
    if (checkEmptyInput.val() == "") {
      checkEmptyInput.addClass('is-invalid')
      $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }
  });

  if ($("#update-user-personal-info input").hasClass('is-invalid')) {
    event.preventDefault();
    invalidEmpty()
  } else {
    var user_id = $('#user-id').val();
    var fname = $('#user-update-fname').val();
    var lname = $('#user-update-lname').val();

    Swal.fire({
      title: 'Are you sure you want to update this record?',
      text: "This action cannot be reverted!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Update!',
      reverseButtons: true,
      allowOutsideClick: false,
      customClass: {
        confirmButton: 'edit-primary-button'
      },

    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "query/account-setting/user-update-personal-info.php",
          data: {
            user_id: user_id, //fieldname in the database : data-id value
            fname: fname,
            lname: lname,
          },
          dataType: 'json',

          success: function (data) {

            Swal.fire({
              title: 'Record Updated!',
              text: "You have succesfully modified this record",
              icon: 'success',
            }).then(function () {
              window.location.reload();
            });
          },
          error: function (xhr, status, error) {


          }
        });
      } else {
        Swal.fire({
          title: "No Changes Were Saved!",
          text: "Your Information is just same as  the last time!",
          icon: 'warning',
        })
      }
    });
  }

});

$('#update-user-academic-info').submit(function (event) {
  $("#update-user-academic-info input").each(function (e) {

    var checkEmptyInput = $(this);
    if (checkEmptyInput.val() == "") {
      checkEmptyInput.addClass('is-invalid')
      $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }
  });

  if ($("#update-user-academic-info input").hasClass('is-invalid')) {
    event.preventDefault();
    invalidEmpty()
  } else {
    var user_id = $('#user-id').val();
    var institution = $('#user-update-institution').val();
    var grade_level = $('#user-update-grade-level').val();

    Swal.fire({
      title: 'Are you sure you want to update this record?',
      text: "This action cannot be reverted!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Update!',
      reverseButtons: true,
      allowOutsideClick: false,
      customClass: {
        confirmButton: 'edit-primary-button'
      },

    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "query/account-setting/user-update-academic-info.php",
          data: {
            user_id: user_id, //fieldname in the database : data-id value
            institution: institution,
            grade_level: grade_level,
          },
          dataType: 'json',

          success: function (data) {

            Swal.fire({
              title: 'Record Updated!',
              text: "You have succesfully modified this record",
              icon: 'success',
            }).then(function () {
              window.location.reload();
            });
          },
          error: function (xhr, status, error) {


          }
        });
      } else {
        Swal.fire({
          title: "No Changes Were Saved!",
          text: "Your Information is just same as  the last time!",
          icon: 'warning',
        })
      }
    });
  }

});

$('#update-user-contact-info').submit(function (event) {
  $("#update-user-contact-info input").each(function (e) {

    var checkEmptyInput = $(this);
    if (checkEmptyInput.val() == "") {
      checkEmptyInput.addClass('is-invalid')
      $('.invalid-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
    }
  });

  if ($("#update-user-contact-info input").hasClass('is-invalid')) {
    event.preventDefault();
    invalidEmpty()
  } else {
    var user_id = $('#user-id').val();
    var email = $('#user-update-email').val();
    var contact = $('#user-update-contact').val();


    Swal.fire({
      title: 'Are you sure you want to update this record?',
      text: "This action cannot be reverted!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, Update!',
      reverseButtons: true,
      allowOutsideClick: false,
      customClass: {
        confirmButton: 'edit-primary-button'
      },

    }).then((result) => {
      if (result.value) {
        $.ajax({
          type: "POST",
          url: "query/account-setting/user-update-contact-info.php",
          data: {
            user_id: user_id, //fieldname in the database : data-id value
            email: email,
            contact_no: contact,
          },
          dataType: 'json',

          success: function (data) {

            Swal.fire({
              title: 'Record Updated!',
              text: "You have succesfully modified this record",
              icon: 'success',
            }).then(function () {
              window.location.reload();
            });
          },
          error: function (xhr, status, error) {


          }
        });
      } else {
        Swal.fire({
          title: "No Changes Were Saved!",
          text: "Your Information is just same as  the last time!",
          icon: 'warning',
        })
      }
    });
  }

});



/*CHANGE PASSWORD*/

$('#student-oldpassword').on('keyup', function () {
  var password = $('#student-oldpassword').val().trim();
  if (password != '') {
      $('.old-password-feedback').hide()

      $('#student-oldpassword').addClass('is-valid')
      $('#student-oldpassword').removeClass('is-invalid')


  } else {
      $('.old-password-feedback').show()
      $('.old-password-feedback').addClass('invalid-feedback')
      $('.old-password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty!');

      $('#student-oldpassword').addClass('is-invalid')
      $('#student-oldpassword').removeClass('is-valid')
  }



})

$('#user-update-password, #student-update-confirmpassword').on('keyup', function () {
  var password = $('#user-update-password').val().trim();
  if (password != '') {
      if ($('#user-update-password').val() != $('#student-update-confirmpassword').val() || $('#user-update-password').val().length < 7 && $('#student-update-confirmpassword').val().length < 7) {
          $('.password-feedback').addClass('invalid-feedback');
          $('.password-feedback').removeClass('valid-feedback');

          $('.password-feedback').show();

          $('.myCpwdClass').addClass('is-invalid');
          $('.myCpwdClass').removeClass('is-valid');
          $('#user-update-password').addClass('is-invalid');
          $('#student-update-confirmpassword').addClass('is-invalid');
          $('#user-update-password').removeClass('is-valid');
          $('#student-update-confirmpassword').removeClass('is-valid');

          $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Pasword does not match!');
          $('#password-validation-match').addClass('invalid');
          $('#password-validation-match').removeClass('valid');

      } else {
          $('.password-feedback').addClass('valid-feedback');
          $('.password-feedback').removeClass('invalid-feedback');

          $('.password-feedback').show();

          $('.myCpwdClass').addClass('is-valid');
          $('.myCpwdClass').removeClass('is-invalid');

          $('#user-update-password').addClass('is-valid');
          $('#student-update-confirmpassword').addClass('is-valid');
          $('#user-update-password').removeClass('is-invalid');
          $('#student-update-confirmpassword').removeClass('is-invalid');

          $('.password-feedback').html('<i class="fa-solid fa-circle-check"></i> Pasword matched!');
          $('#password-validation-match').removeClass('invalid');
          $('#password-validation-match').addClass('valid');

      }

      // Validate lowercase letters
      var lowerCaseLetters = /[a-z]/g;
      if ($('#user-update-password').val().match(lowerCaseLetters)) {
          $('#password-validation-lowercase').addClass('valid');
          $('#password-validation-lowercase').removeClass('invalid');
      } else {
          $('#password-validation-lowercase').addClass('invalid');
          $('#password-validation-lowercase').removeClass('valid');
          $('.myCpwdClass').addClass('is-invalid');
          $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Password validation is not met');
          $('.password-feedback').addClass('invalid-feedback');
      }


      // Validate capital letters
      var upperCaseLetters = /[A-Z]/g;
      if ($('#user-update-password').val().match(upperCaseLetters)) {
          $('#password-validation-uppercase').addClass('valid');
          $('#password-validation-uppercase').removeClass('invalid');
      } else {
          $('#password-validation-uppercase').addClass('invalid');
          $('#password-validation-uppercase').removeClass('valid');
          $('.myCpwdClass').addClass('is-invalid');
          $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Password validation is not met');
          $('.password-feedback').addClass('invalid-feedback');
      }

      // Validate numbers
      var numbers = /[0-9]/g;
      if ($('#user-update-password').val().match(numbers)) {
          $('#password-validation-number').addClass('valid');
          $('#password-validation-number').removeClass('invalid');
      } else {
          $('#password-validation-number').addClass('invalid');
          $('#password-validation-number').removeClass('valid');
          $('.myCpwdClass').addClass('is-invalid');
          $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Password validation is not met');
          $('.password-feedback').addClass('invalid-feedback');
      }

      // Validate length
      if ($('#user-update-password').val().length >= 8) {
          $('#password-validation-length').addClass('valid');
          $('#password-validation-length').removeClass('invalid');
      } else {
          $('#password-validation-length').addClass('invalid');
          $('#password-validation-length').removeClass('valid');
          $('.myCpwdClass').addClass('is-invalid');
          $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Password validation is not met');
          $('.password-feedback').addClass('invalid-feedback');
      }
  } else {
      $('#user-update-password').addClass('is-invalid');
      $('#student-update-confirmpassword').addClass('is-invalid');
      $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your password');
      $('.myCpwdClass').addClass('is-invalid');
      $('.password-feedback').addClass('invalid-feedback');
      $('.password-feedback').show();
      $('#password-validation-lowercase').addClass('invalid');
      $('#password-validation-uppercase').addClass('invalid');

      $('#password-validation-match').addClass('invalid');
      $('#password-validation-number').addClass('invalid');
      $('#password-validation-length').addClass('invalid');
      $('#password-validation-lowercase').removeClass('valid');
      $('#password-validation-uppercase').removeClass('valid');

      $('#password-validation-match').removeClass('valid');
      $('#password-validation-number').removeClass('valid');
      $('#password-validation-length').removeClass('valid');

  }


});



$(document).ready(function () {
  var id = $('#get-password-user-id').val()

  $.ajax({
      type: 'POST',
      url: 'query/account-setting/user-getid-view.php',
      data: {
          user_id: id
      },
      dataType: 'json',
      success: function (res) {
          $('#student-id').val(res.user_id);
          $('#student-update-fname').val(res.fname);
          $('#student-password').val(res.password);
          $('#student-update-lname').val(res.lname);
          $('#student-update-email').val(res.email);
          $('#student-update-contact').val(res.contact_no);
      }
  });

});



$('#update-student-password').submit(function (event) {

  if ($('#update-student-password #student-oldpassword').val() == "") {
      $('.old-password-feedback').addClass('invalid-feedback');
      $('.old-password-feedback').show();
      $('.old-password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
      $('#student-oldpassword').addClass('is-invalid');
      event.preventDefault();
      invalidEmpty()
  }

  if ($('#user-update-password, #student-update-confirmpassword').val() == "") {
      $('.password-feedback').addClass('invalid-feedback');
      $('.password-feedback').show();
      $('.password-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> This field cannot be empty');
      $('#user-update-password').addClass('is-invalid');
      $('#student-update-confirmpassword').addClass('is-invalid');
      event.preventDefault();
      invalidEmpty()
  }

  if ($("#update-student-password input").hasClass('is-invalid')) {
      event.preventDefault();
      invalidEmpty()
  } else {
      var user_id = $('#student-id').val();
      var old_password = $('#student-oldpassword').val();

      var password = $('#user-update-password').val();

      Swal.fire({
          title: 'Are you sure you want to change your password?',
          text: "This action cannot be reverted!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Save Changes',
          reverseButtons: true,
          allowOutsideClick: false,
          customClass: {
              confirmButton: 'edit-primary-button'
          },

      }).then((result) => {
          if (result.value) {
              $.ajax({
                  type: "POST",
                  url: "query/account-setting/user-update-password.php",
                  data: {
                      user_id: user_id, //fieldname in the database : data-id value
                      old_password: old_password,
                      password: password
                  },
                  dataType: 'json',

                  success: function (data) {
                      if (data == 'Password Matched') {
                          Swal.fire({
                              title: 'Password Changed!',
                              text: "You have succesfully change your password",
                              icon: 'success',
                          }).then(function () {
                              window.location.reload();
                          });
                      } else if (data == 'WRONG') {
                          Swal.fire({
                              title: 'Wrong Password Credentials!',
                              html: "Your current password does not match to our database.<br> We cannot update your password, Please try again!",
                              icon: 'error',
                          }).then(function () {
                              window.location.reload();
                          });
                      }


                  },
                  error: function (xhr, status, error) {


                  }
              });
          } else {
              Swal.fire({
                  title: "No Changes Were Saved!",
                  text: "Your password is just same as the last time!",
                  icon: 'warning',
              })
          }
      });
  }

});

/*CHANGE PASSWORD END*/


$("#user-update-email").keyup(function () {

  var email = $(this).val().trim();

  if (email != '') {


      $.ajax({
          url: 'query/validate-check-email.php',
          type: 'post',
          data: {
              email: email
          },
          dataType: "json",

          success: function (response) {

              if (response == 'Email Exists') {
                  $('.email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is already taken');
                  $('#empty-field-email').hide();
                  $('#user-update-email').removeClass('is-valid');
                  $('#user-update-email').addClass('is-invalid');
                  $('.email-feedback').removeClass('valid-feedback');
                  $('.email-feedback').addClass('invalid-feedback');
                  $('.email-feedback').show();

              } else if (!adminValidateEmail()) {
                  $('#user-update-email').removeClass('is-valid');
                  $('#user-update-email').addClass('is-invalid');
                  $('.email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Email is invalid format');
                  $('.email-feedback').removeClass('valid-feedback');
                  $('.email-feedback').addClass('invalid-feedback');
                  $('.email-feedback').show();
              } else {
                  $('#user-update-email').addClass('is-valid');
                  $('#user-update-email').removeClass('is-invalid');
                  $('.email-feedback').hide();

                  $('.email-feedback').html('<i class="fa-solid fa-circle-check"></i> Email is valid');
                  $('.email-feedback').addClass('valid-feedback');
                  $('.email-feedback').removeClass('invalid-feedback');

              }


          }
      });
  } else {
      $('.email-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your institution name');
  }

});



$("#user-update-contact").keyup(function () {

  var contact = $(this).val().trim();

  if (contact != '') {

      $.ajax({
          url: 'query/validate-check-contact-no.php',
          type: 'post',
          data: {
              contact: contact
          },
          dataType: "json",

          success: function (response) {

              if (response == 'This Number is Already Registered') {
                  $('.contact-feedback').show();
                  $('.contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number is already taken');
                  $('#empty-field-contact').hide();
                  $('#user-update-contact').addClass('is-invalid');
                  $('#user-update-contact').removeClass('is-valid');
                  $('.contact-feedback').removeClass('valid-feedback');
                  $('.contact-feedback').addClass('invalid-feedback');
              } else if (!adminValidInteger()) {
                  $('.contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format  only include numbers');
                  $('.contact-feedback').show();
                  $('#empty-field-contact').hide();
                  $('#user-update-contact').addClass('is-invalid');
                  $('#user-update-contact').removeClass('is-valid');
                  $('.contact-feedback').removeClass('valid-feedback');
                  $('.contact-feedback').addClass('invalid-feedback');
              } else if (contact.length != 11) {
                  $('.contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Contact number must be 11 numbers');
                  $('.contact-feedback').show();
                  $('#empty-field-contact').hide();
                  $('#user-update-contact').addClass('is-invalid');
                  $('#user-update-contact').removeClass('is-valid');
                  $('.contact-feedback').removeClass('valid-feedback');
                  $('.contact-feedback').addClass('invalid-feedback');
              } else if (!adminValidatePhoneNumber()) {
                  $('.contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Wrong format must include <b> 09 </b> at the beginning of contact number');
                  $('.contact-feedback').show();
                  $('#empty-field-contact').hide();
                  $('#user-update-contact').addClass('is-invalid');
                  $('#user-update-contact').removeClass('is-valid');
                  $('.contact-feedback').removeClass('valid-feedback');
                  $('.contact-feedback').addClass('invalid-feedback');
              } else {
                  $('.contact-feedback').show();
                  $('#empty-field-contact').hide();
                  $('.contact-feedback').html('<i class="fa-solid fa-circle-check"></i> Contact number is valid');
                  $('.contact-feedback').addClass('valid-feedback');
                  $('.contact-feedback').removeClass('invalid-feedback');
                  $('#user-update-contact').addClass('is-valid');
                  $('#user-update-contact').removeClass('is-invalid');
              }
          }
      });
  } else {
      $('#user-update-contact').addClass('is-invalid');
      $('.contact-feedback').addClass('invalid-feedback');

      $('#empty-field-contact').show();
      $('.contact-feedback').html('<i class="fa-solid fa-triangle-exclamation"></i> Please enter your contact number');

  }

});