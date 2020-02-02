<?php $__env->startSection('title','User | Registration'); ?>

<?php $__env->startSection('body'); ?>

<style>
   .text-danger{
      color: #FF0000;
   }
   .loader {
      border: 5px solid #f3f3f3;
      -webkit-animation: spin 1s linear infinite;
      animation: spin 1s linear infinite;
      border-top: 5px solid #555;
      border-radius: 50%;
      width: 50px;
      height: 50px;
   }

   @keyframes  spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
   }
</style>

<section id="service" class="registration">
   <div class="container">
      
      <div class="row">
         <div class="col s12 m12">
            <div class="register-section">
               <div class="col m12 center">
                  <h3>Sign up to our Crystal PPM</h3>
               </div>
               <div class="register-form">

                  <?php if(count($errors) > 0): ?>
                  <div class="alert alert-danger">
                     <ul>
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     </ul>
                  </div>
                  <?php endif; ?>

                  <?php if(Session::has('message')): ?>
                  <div class="alert alert-danger">
                     <ul>
                        <li><?php echo e(Session::get('message')); ?></li>
                     </ul>
                  </div>
                  <?php endif; ?>

                  <form id="login-register" method="post" action="<?php echo e(url('api/v1/store')); ?>">
                     <?php echo e(csrf_field()); ?>

                     <input type="hidden" name="remember_token" value="<?php echo md5(rand()); ?>" />
                     <div class="col s12 m12">
                        <div class="col s12 m6">
                           <div class="input-field">
                              <input id="name" type="text" name="name" >
                              <label for="fname">Firstname</label>
                           </div>
                        </div>
                        <div class="col s12 m6">
                           <div class="input-field">                                    
                              <input id="lname" type="text" name="lname" >
                              <label for="lname">Lastname</label>
                           </div>
                        </div>
                        <div class="col s12 m6">
                           <div class="input-field">
                              <input id="cname" type="text" name="company_name" >
                              <label for="cname">Company Name</label>
                           </div>
                        </div>
                        <div class="col s12 m6">
                           <div class="input-field">                                    
                              <input id="email" type="text" name="email" >
                              <label for="email">Email Address</label>
                           </div>
                        </div>

                        <div class="col s12 m6">
                           <div class="input-field">
                              <input id="password" type="password" name="password">
                              <label class="pass">Password</label>
                           </div>
                        </div>
                        <div class="col s12 m6">
                           <div class="input-field">
                              <input id="cpass" type="password" name="confirm_password" >
                              <label for="cpass">Repeat Your Password</label>
                           </div>
                        </div>
                        <div class="col s12 m6 no-padding">
                           <div class="input-field col s12 m2">
                              <div class="country_code">
                                 <p>+61</p>
                              </div>
                           </div>
                           <div class="input-field col s12 m10">
                              <input id="pnumber" type="text" name="phone" maxlength="9" >                                  
                              <label for="pnumber">Phone Number</label>
                           </div>
                        </div>
                        <div class="col s12 m6">
                           <div class="input-field">
                              <select class="plans" name="plan">
                                 <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <option value="<?php echo e($planName->braintree_plan); ?>"
                                         <?php if($planName->braintree_plan == $plan): ?>
                                         selected="selected"
                                         <?php endif; ?>
                                         ><?php echo e($planName->name .' / '. $planName->cost.' $'); ?></option>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </select>
                           </div>
                        </div>
                        <div class="col s12 m12">
                           <div class="input-field">
                              <div id="dropin-container"></div>
                              <input type="hidden" value="" name="payment_method_nonce">
                           </div>
                        </div>
                        <div class="col s12 m12">
                           <div class="checkbox-form-group">
                              <p><input type="checkbox" class="filled-in" id="agree" name="agree" value="yes"><label style="width:100%;" for="agree">I agree with our terms and conditions</label><span id="agreeMsg"></span></p>
                           </div>
                        </div>
                        <div class="input-field col s12 m12">
                           <div class='error-message' style='display:none;'> </div>    
                           <div class="register-button" style="margin: 15px 0;">
                              <button type="submit" class="btn waves-effect">Submit</button>
                              <!--a href="#" class="button-one">Sign Up</a-->
                              <a href="/" class="btn-flat waves-effect">Cancel</a>
                              <div class="loader" style="display:none;"></div> 
                           </div>
                           
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>      
   </div>
   <div id="otp" class="modal fade">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="row">
               <div class="col-lg-5 col-md-8">
                  <form id="otp-form" method="post" action="">
                     <div class="col-sm-12">
                        <p>Enter the OTP sent to your registered phone number!</p>
                     </div>
                     <div class="input-group col-sm-12">
                        <input type="text" name="verify_code" id="verify_code">
                        <label for="verify_code">OTP</label>
                     </div>
                     <div class='otp-error-message' style='display:none;'> </div>   
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-default">Submit</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                     </div>

                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php echo Html::script('/js/jquery.validate.min.js'); ?>

<?php echo Html::script('/js/custom.js'); ?>

<?php $__env->startSection('braintree'); ?>
<script src="https://js.braintreegateway.com/js/braintree-2.30.0.min.js"></script>
<script>
$.ajax({
   url: "<?php echo e(url('braintree/token')); ?>"
}).done(function (response) {
   braintree.setup(response.data.token, 'dropin', {
      container: 'dropin-container',
      onReady: function () {
         $('#payment-button').removeClass('hidden');
      },
      onPaymentMethodReceived: function (paymentMethod) {
         if (paymentMethod.nonce != '') {
            $('input[name=payment_method_nonce]').val(paymentMethod.nonce);
            var form = $('#login-register');
            if ($('#login-register').valid() == false)
               return;
            document.querySelector('.error-message').innerHTML = "";
            $('.error-message').hide();
            ajaxOpt = {};
            ajaxOpt.form = form.attr('id');
            $('.loader').show();
            $.ajax({
               url: form.attr('action'),
               method: 'POST',
               data: form.serialize(),
               success: function (data) {
                  if (data.error == false) {
                     $('.loader').hide();
                     ajaxOpt.otpid = data.otpid;
                     $('#otp-form').attr('action', data.otpurl);
                     $('#otp').modal('open');

                  } else if (data.error == true) {
                     $('.error-message').append("<p style='color:red' class='text-center' >" + data.message + "</p>");
                     $('.error-message').show();

                  }
               },
               statusCode: {
                  422: function (errors) {
                     for (i in errors.responseJSON) {
                        $('.error-message').append("<p style='color:red' class='text-center' >" + errors.responseJSON[i][0] + "</p>");
                     }
                     $('.error-message').show();
                  }
               }
            });
         }
      }
   });
});
</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>