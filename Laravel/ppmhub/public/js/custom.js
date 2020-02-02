(function () {
   $('.plans').show();
   // Add smooth scrolling to all links in navbar
   $(".asdf a, a.btn-appoint, .quick-info li a, .overlay-detail a").on('click', function (event) {
      event.preventDefault();
      var hash = this.hash;
      $('html, body').animate({
         scrollTop: $(hash).offset().top
      }, 900, function () {
         window.location.hash = hash;
      });
   });


//   $('#login-register').submit(function (e) {
//      e.preventDefault();
//      e.stopPropagation();
//
//      if ($('#login-register').valid() == false)
//         return;
//      document.querySelector('.error-message').innerHTML = "";
//      $('.error-message').hide();
//      ajaxOpt = {};
//      ajaxOpt.form = $(this).attr('id');
//      $.ajax({
//         url: $(this).attr('action'),
//         method: 'POST',
//         data: $(this).serialize(),
//         success: function (data) {
//            if (data.error == false) {
//               ajaxOpt.otpid = data.otpid;
//               $('#otp-form').attr('action', data.otpurl);
//               $('#otp').modal('open');
//
//            } else if (data.error == true) {
//               $('.error-message').append("<p style='color:red' class='text-center' >" + data.message + "</p>");
//               $('.error-message').show();
//
//            }
//         },
//         statusCode: {
//            422: function (errors) {
//               for (i in errors.responseJSON) {
//                  $('.error-message').append("<p style='color:red' class='text-center' >" + errors.responseJSON[i][0] + "</p>");
//               }
//               $('.error-message').show();
//            }
//         }
//      });
//   });
   $('#login-register').validate({
      errorElement: 'span',
      rules: {
         'name': {
            required: true
         },
         'lname': {
            required: true
         },
         'phone': {
            required: true,
            digits: true
         },
         'email': {
            required: true,
            email: true
         },
         'company_name': {
            required: true
         },
         'password': {
            required: true,
            minlength: 4
         },
         'confirm_password': {
            required: true,
            equalTo: "#password"
         },
         agree: {
            required: true,
         }
      },
      messages: {
         'name': {
            required: 'Please Enter First Name.'
         },
         'lname': {
            required: 'Please Enter Last Name.'
         },
         'phone': {
            required: 'Please Enter Phone Number.',
            digits: 'Please Enter Valid Phone Number'
         },
         'email': {
            required: 'Please Enter Email.',
            email: 'Please Enter Valid Email.'
         },
         'company_name': {
            required: 'Please Enter Company Name.'
         },
         'password': {
            required: 'Please Enter Password.',
         },
         'confirm_password': {
            required: 'Please Enter Password',
            equalTo: 'Password and Confirm Password Mismatch.'
         },
         agree: {
            required: 'Please Accept Terms & Conditions',
         }
      },
      errorPlacement: function (error, element) {
         element.attr("name") == "agree" ? error.insertAfter('#agreeMsg') : error.insertAfter(element);
         error.addClass('text-danger');
      },
           
   });

   $('#otp-form').submit(function (e) {
      e.preventDefault();
      document.querySelector('.otp-error-message').innerHTML = "";
      $('.otp-error-message').hide();
      $.ajax({
         url: $(this).attr('action'),
         method: 'POST',
         data: $(this).serialize(),
         success: function (data) {
            if (data.error == false) {
               window.location.href = data.redirect;
            } else if (data.error == true) {
               $('.otp-error-message').append("<p style='color:red' class='text-center' >" + data.message + "</p>");
               $('.otp-error-message').show();
            }
         },
         statusCode: {
            422: function (errors) {
               for (i in errors.responseJSON) {
                  $('.otp-error-message').append("<p style='color:red' class='text-center' >" + errors.responseJSON[i][0] + "</p>");
               }
               $('.otp-error-message').show();
            }
         }
      });
   });
})();


