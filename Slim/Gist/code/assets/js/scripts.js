  $(document).ready(function(){
          
$('.step_two_outer').hide()
  

$('.step_three_outer').hide()
$('.edit').show();
 $('.uploaded_video').hide()
                $('.upload_video').show()
//$('.continue_btn a').attr("disabled","disabled");
 $('.selectpicker').selectpicker();
//$('.selectpicker').selectpicker('destroy');


if($('.clone_education').length>1){
  $('.clone_education').eq(0).find('.add_education').css("display","none")
  $('.clone_education').each(function(){
   var element = $(this).find('.add_education_button')
  
 $(element).before(newhtml)
})
}

if($('.clone_experience').length>1){
  $('.clone_experience').eq(0).find('.add_work_experience_button').css("display","none")
  $('.clone_experience').each(function(key,value){
    if(key>0){
   var element = $(this).find('.add_work_experience_button')
  
 $(element).before(newhtml)
}
})
}

$('.select_experience').each(function(){
  console.log($(this))
  if($(this).hasClass('edit_experience'))
 {
  $(this).css("display","inline-block")
 }
 else{
$(this).css("display","none")
}

})

  $('#candidateInvitation').validate({
            rules: {
                candidateEmployerEmail: {
                    required: true
                },
               
            },
            messages: {
                candidateEmployerEmail: {
                    required: "Please enter Employer's Email.",
                },
             
            },
            submitHandler: function () {

                toastr.clear();
              //  $('#submit_btn').attr('disabled', true);
                var data = {};
                data.body = $('#candidateInvitation').serializeObject();

            //  $('.loader').show(); // show loader
                $.when(applywithgist(data)).then(function (data) {

                    if (data.meta.success) { // if success
                   // profile page redirct
                   toastr.success("Email successfully sent");
                        $('#submit_btn').attr('disabled', false);
                    } else {
                      //  $('.loader').hide(); // hide loader
                        $('#submit_btn').attr('disabled', false);
                    }
                });
            }
        });
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return arg !== value;
 }, "Value must not equal default.");

  $('#login_form').validate({
            rules: {
                email: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: 'Please enter username.',
                },
                password: {
                    required: 'Please enter password.'
                }
            },
            submitHandler: function () {

                toastr.clear();
                $('#submit_btn').attr('disabled', true);
                var data = {};
                data.body = $('#login_form').serializeObject();
     // var redirect = '<?= !empty($_GET['redirect']) ? $_GET['redirect'] : '' ?>';
              //  $('.loader').show(); // show loader
              var redirect = $('#redirect').val();
                $.when(login(data)).then(function (data) {
                      
                    if (data.meta.success) { // if success
                   // profile page redirct
                   console.log(redirect);
                   var role = data.data.role;
                   if(redirect==""){
                   if(role=="Employer"){
                  window.location.href = Data.base_url + 'employer/dashboard'; 
                   }
                   else{
                      window.location.href = Data.base_url + 'candidate/profile/edit';                        
                        }
                        $('#submit_btn').attr('disabled', false);
                      }
                      else{
                        window.location.href = Data.base_url + redirect;
                      }
                    } else {
                      //  $('.loader').hide(); // hide loader
                        $('#submit_btn').attr('disabled', false);
                    }
                });
            }
        });
  

  
    $('#EmployerGistRegisteration_Form').validate({
            rules: {

                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                phone: {
                    required: true,
                     minlength:9,
                     maxlength:10,
                },
                job_title: {
                    required: true
                },
                company_name: {
                    required: true
                },
                company_industry: {
                    required: true
                },
                credit_card: {
                    required: true,
                    creditcard: true
                },
                billing_zip: {
                    required: true,
                    zipcode: true
                },
                securtiy_code: {
                    required: true,
                    cvv: true
                },
                expiration_date: {
                    required: true
                },
                employer_password: {
                    required: true
                },                
            },
            messages: {
                name: {
                    required: 'Please enter name.',
                },
                email: {
                    required: 'Please enter your working Email.',
                    email: 'PLease enter Valid Email'
                },
                phone: {
                    required: 'Please Enter Phone Number'
                },
                job_title: {
                    required: 'Please Enter Job title'
                },
                company_name: {
                    required: "Please Enter Company Name"
                },
                company_industry: {
                    required: "Please Enter Company Industry"
                },
                credit_card: {
                    required: "Please Enter Credit Card Number"
                },
                billing_zip: {
                    required: "PLease Enter Billing Zip Code"
                },
                securtiy_code: {
                    required: "PLease Enter Credit card Security Card"
                },
                expiration_date: {
                    required: "Please Enter Credit Card Expiration Date"
                },
                employer_password: {
                    required: "Please Enter Password"
                }
            },
            submitHandler: function () {

                toastr.clear();
            //    $('#submit_btn').attr('disabled', true);
                var data = {};
                data.body = $('#EmployerGistRegisteration_Form').serializeObject();


              //  $('.loader').show(); // show loader
                $.when(employerRegisteration(data)).then(function (data) {

                    if (data.meta.success) { // if success
                   // profile page redirct
                            window.location.href = Data.base_url + 'candidate/login';                        
                        $('#submit_btn').attr('disabled', false);
                    } else {
                      //  $('.loader').hide(); // hide loader
                        $('#submit_btn').attr('disabled', false);
                    }
                });
            }
        });
  

  jQuery.validator.addMethod("phone", function (value) {
            return /^[0-9.+-\s()]+$/.test(value);
        },"Please provide a valid phone number.");

jQuery.validator.addMethod("zipcode", function(value, element) {
  return this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
}, "Please provide a valid zipcode.");

jQuery.validator.addMethod("cvv", function (value) {
            return /^[0-9]{3,4}$/.test(value);
        },"Please provide a valid security number.");

    $('#login_form').validate({
            rules: {
                email: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: 'Please enter username.',
                },
                password: {
                    required: 'Please enter password.'
                }
            },
            submitHandler: function () {

                toastr.clear();
                $('#submit_btn').attr('disabled', true);
                var data = {};
                data.body = $('#login_form').serializeObject();


    var redirect = '<?php !empty($_GET["redirect"]) ? $_GET["redirect"] : "" ?>';
              //  $('.loader').show(); // show loader
                $.when(login(data)).then(function (data) {

                    if (data.meta.success) { // if success
                   // profile page redirct
                            window.location.href = Data.base_url + 'candidate/profile/edit';                        
                        $('#submit_btn').attr('disabled', false);
                    } else {
                      //  $('.loader').hide(); // hide loader
                        $('#submit_btn').attr('disabled', false);
                    }
                });
            }
        });

$('#candidatesignup_form').validate({
            rules: {
    
              candidateemail: {
        required: true,
         email: true,
         remote: {
        url: Data.base_url + 'api/mobile/candidate/candidatecheck/',
        type: "post",
        data: {
          email: function() {
         return  $.validator.format("{0} is already taken", $( "#candidateemail" ).val())
             
          }
        },

      }
     },
         candidateurl: {
                     required: true,
                     url: true
                 },
     candidatename: {
                    required: true
               },
                 'candidatecompany[]': {
                    required: true
               },
                'candidatecompanytitle[]': {
                    required: true
               },
               'extrafieldofstudy[]': {
                  required: true
               },
                'extracollege[]': {
                  required: true
               },
               'candidatelocation[]': {
                 required: true,
                 maxlength: 3
             },
           /* 'candidateskillvalue[]': {
              required: {
                depends: function(element) {
        var checkelement = $(element).parents().closest('.experience_type').find('.candidateskills')
           console.log(checkelement)      
                    //return $("#candidateskillvalue-0:checked")
                    return checkelement.checked;
                 
                }
            }
          },*/
                 candidatepassword: {
                    required: true,
                 },
    
           
             'candidateskills[]': {
                  required: true,
                  minlength: 1
              }, 

    'candidateexperience[]': { valueNotEquals: "default" },
      'candidatedegree[]': { valueNotEquals: "default" },
      'candidatestudyfields[]': { valueNotEquals: "default" },
      'candidatecollege[]': { valueNotEquals: "default" },
      'candidategradyear[]': { valueNotEquals: "default" },
     'candidateexpertise[]': { valueNotEquals: "default" },
      'candidatestartmonth[]': { valueNotEquals: "default" },
      'candidatestartyear[]': { valueNotEquals: "default" },
    '#candidateendmonth-0': { valueNotEquals: "default" },
    '#candidateendyear-0': { valueNotEquals: "default" },
     //'candidateskillexperience[]': { valueNotEquals: "default" },
            },
            messages: {
             candidatename: {
                     required: 'Please enter username.',
                 },
                
                 candidateemail: {
                     required: 'Please enter email.',
                     email: 'Please Enter Valid Email',
                     regex: 'Please Enter Valid Email',
                     remote:jQuery.validator.format("{0} is already taken, please enter a different address.")
                 },
                
                 candidatepassword: {
                     required: 'Please enter your password.',
                 },
                  candidateurl: {
                     required: 'Please enter Url.',
                 },
                   'candidatecompany[]': {
                     required: 'Please enter Company Name.',
                 },
                   'candidatecompanytitle[]': {
                     required: 'Please enter Company Job title.',
                 },
            'candidatelocation[]': {
         required: "You must check at least 1 location",
         maxlength: "Check no more than {0} locations"
            },
              'candidateskills[]': {
         required: "Candidate Skills Are required",
        minlength: "You should choose  atleast 1 skill"
             },
             'candidatedegree[]': { valueNotEquals: "Degree is required" },
               'candidatestudyfields[]': { valueNotEquals: "Field of Study is required" },
                  'candidatecollege[]': { valueNotEquals: "College is required" },
                  'candidategradyear[]': { valueNotEquals: "Grad Year is required" },
        'candidateexperience[]': { valueNotEquals: "Experience is required" },

    'candidatestartmonth[]': { valueNotEquals: "Candidate Start Month is required" },
        'candidatestartyear[]': { valueNotEquals: "Candidate Start Year is required" },
    '#candidateendmonth-0': { valueNotEquals: "Candidate End Month is required" },
'#candidateendyear-0': { valueNotEquals: "Experience End Year is required" },
'candidateexpertise[]': { valueNotEquals: "Expertise is required" },

            },
            submitHandler: function () {
      
                toastr.clear();
               $('.submit_btn btn').attr('disabled', true);
                var data = {};
                data.body = $('#candidatesignup_form').serializeObject();
                data.body['question'] = question;
                data.body['video'] = videourl;
                console.log(data.body)
               // var redirect = '<?= !empty($_GET['redirect']) ? $_GET['redirect'] : '' ?>';
               // $('.loader').show(); // show loader
             
           $.when(candidateregister(data)).then(function (data) {


                if (data.meta.success) { // if success
                     toastr.success("Signed up successfully.Please Login");
                     window.location.href = Data.base_url + 'candidate/login';
                      console.log("success")
                         $('.submit_btn btn').attr('disabled', false);
                    } else {
                 //       $('.loader').hide(); // hide loader
                 toastr.error("Could not Sign up.PLease retry after some time");
                        $('.submit_btn btn').attr('disabled', false);
                    }

             })

            }
        });


  $('#candidateedit_form').validate({
            rules: {
    
              candidateemail: {
        required: true,
         email: true,
         remote: {
        url: Data.base_url + 'api/mobile/candidate/candidatecheck/',
        type: "post",
        data: {
          email: function() {
         return  $.validator.format("{0} is already taken", $( "#candidateemail" ).val())
             
          }
        },

      }
     },
         candidateurl: {
                     required: true,
                     url: true
                 },
     candidatename: {
                    required: true
               },
                 'candidatecompany[]': {
                    required: true
               },
                'candidatecompanytitle[]': {
                    required: true
               },
               'extrafieldofstudy[]': {
                  required: true
               },
                'extracollege[]': {
                  required: true
               },
               'candidatelocation[]': {
                 required: true,
                 maxlength: 3
             },
           /* 'candidateskillvalue[]': {
              required: {
                depends: function(element) {
        var checkelement = $(element).parents().closest('.experience_type').find('.candidateskills')
           console.log(checkelement)      
                    //return $("#candidateskillvalue-0:checked")
                    return checkelement.checked;
                 
                }
            }
          },*/
                 candidatepassword: {
                    required: true,
                 },
    
           
             'candidateskills[]': {
                  required: true,
                  minlength: 1
              }, 

    'candidateexperience[]': { valueNotEquals: "default" },
      'candidatedegree[]': { valueNotEquals: "default" },
      'candidatestudyfields[]': { valueNotEquals: "default" },
      'candidatecollege[]': { valueNotEquals: "default" },
      'candidategradyear[]': { valueNotEquals: "default" },
     'candidateexpertise[]': { valueNotEquals: "default" },
      'candidatestartmonth[]': { valueNotEquals: "default" },
      'candidatestartyear[]': { valueNotEquals: "default" },
    '#candidateendmonth-0': { valueNotEquals: "default" },
    '#candidateendyear-0': { valueNotEquals: "default" },
     //'candidateskillexperience[]': { valueNotEquals: "default" },
            },
            messages: {
             candidatename: {
                     required: 'Please enter username.',
                 },
                
                 candidateemail: {
                     required: 'Please enter email.',
                     email: 'Please Enter Valid Email',
                     regex: 'Please Enter Valid Email',
                     remote:jQuery.validator.format("{0} is already taken, please enter a different address.")
                 },
                
                 candidatepassword: {
                     required: 'Please enter your password.',
                 },
                  candidateurl: {
                     required: 'Please enter Url.',
                 },
                   'candidatecompany[]': {
                     required: 'Please enter Company Name.',
                 },
                   'candidatecompanytitle[]': {
                     required: 'Please enter Company Job title.',
                 },
            'candidatelocation[]': {
         required: "You must check at least 1 location",
         maxlength: "Check no more than {0} locations"
            },
              'candidateskills[]': {
         required: "Candidate Skills Are required",
        minlength: "You should choose  atleast 1 skill"
             },
             'candidatedegree[]': { valueNotEquals: "Degree is required" },
               'candidatestudyfields[]': { valueNotEquals: "Field of Study is required" },
                  'candidatecollege[]': { valueNotEquals: "College is required" },
                  'candidategradyear[]': { valueNotEquals: "Grad Year is required" },
        'candidateexperience[]': { valueNotEquals: "Experience is required" },

    'candidatestartmonth[]': { valueNotEquals: "Candidate Start Month is required" },
        'candidatestartyear[]': { valueNotEquals: "Candidate Start Year is required" },
    '#candidateendmonth-0': { valueNotEquals: "Candidate End Month is required" },
'#candidateendyear-0': { valueNotEquals: "Experience End Year is required" },
'candidateexpertise[]': { valueNotEquals: "Expertise is required" },

            },
            submitHandler: function () {
                toastr.clear();
               $('.submit_btn btn').attr('disabled', true);
                var data = {};
                data.body = $('#candidateedit_form').serializeObject();
                data.body['question'] = question;
                data.body['video'] = videourl;
                console.log(data.body)
               // var redirect = '<?= !empty($_GET['redirect']) ? $_GET['redirect'] : '' ?>';
               // $('.loader').show(); // show loader
             
            $.when(candidateupdate(data)).then(function (data) {


                if (data.meta.success) { // if success
                  toastr.success(data.data.message);
            window.location.href = Data.base_url + 'candidate/profile/edit';
                         $('.submit_btn btn').attr('disabled', false);
                    } else {
                      toastr.error("Could Not Update.Please retry");
                 //       $('.loader').hide(); // hide loader
                        $('.submit_btn btn').attr('disabled', false);
                    }

             })
            }
        });


  

    var checkbox = $('.currently_working input[type=checkbox]')
if($(checkbox)["0"].value=="on"){
 $('#candidateendmonth-0').rules('remove')
    $('#candidateendyear-0').rules('remove')

}
else{
$('#candidateendmonth-0').rules('add', { valueNotEquals: "default" })
    $('#candidateendyear-0').rules('add', { valueNotEquals: "default" })

}
$(document).on('submit', '#candidatesignup_form', function(event) {

event.preventDefault();

})
$(document).on('submit', '#candidateedit_form', function(event) {

event.preventDefault();

})

       
        $.validator.addMethod("unique", function(value, element, params) {
    var prefix = params;
    var selector = jQuery.validator.format("[name!='{0}'][unique='{1}']", element.name, prefix);
    var matches = new Array();
    $(selector).each(function(index, item) {
        if (value == $(item).val()) {
            matches.push(item);
        }
    });

    return matches.length == 0;
}, "Value is not unique.");
$.validator.classRuleSettings.unique = {
    unique: true
};
  })
 
  $(document).on('change','.candidatecollege', function(){
     var id = $(this).attr("id");
 console.log(id) 
 var res = id.split("-");
 var resid = res[1];
 var nextid = parseInt(resid)
 var nextidvalue = "extracollege-"+nextid 
var addinputrow = '<div class="experience_list_outer">'
    addinputrow+= '<input autofocus="" class="form-control extracollege" name="extracollege[]" id="'+nextidvalue+'" placeholder="Enter your college" type="text">'
    addinputrow+= '</div>'

    var selectedvalue = $(this)["0"].selectedOptions["0"].innerText
   if(selectedvalue=="Others"){
    $(this).addClass("others")
   var parentrow =  $(this)["0"].parentElement.parentElement.parentElement
   $(parentrow).after(addinputrow)
   }
   else{

        if($(this).hasClass( "others" )){
       // $(this).find('[value="others"]').remove();
   $(this).removeClass("others")    
   $(this).parents().closest('.experience_list_outer')["0"].nextSibling.remove()

        }
    }
  })
    $(document).on('change','.candidatestudyfield', function(){
 var id = $(this).attr("id");
 console.log(id) 
 var res = id.split("-");
 var resid = res[1];
 var nextid = parseInt(resid)
 var nextidvalue = "extrafieldofstudy-"+nextid       
var addinputrow = '<div class="experience_list_outer">'
    addinputrow+= '<input autofocus="" class="form-control extrafieldofstudy" name="extrafieldofstudy[]" id="'+nextidvalue+'" placeholder="Enter your field of study" type="text">'
    addinputrow+= '</div>'
   var selectedvalue = $(this)["0"].selectedOptions["0"].innerText
   console.log(selectedvalue);
   if(selectedvalue=="Others"){
    $(this).addClass("others")
   var parentrow =  $(this)["0"].parentElement.parentElement.parentElement
   $(parentrow).after(addinputrow)
   }
   else{

        if($(this).hasClass( "others" )){
       // $(this).find('[value="others"]').remove();
   $(this).removeClass("others")    
   $(this).parents().closest('.experience_list_outer')["0"].nextSibling.remove()

        }
    
   }
    })
        

       var question = ""
       var videourl = ""
$(document).on('click', '.candidate_signup_stepone .question_check a', function() { 
            $('.step_one_outer').hide()  
            $('.step_two_outer').show()
                console.log($(this))
   question += $(this)["0"].parentElement.parentElement.childNodes[1].innerText+" — "
$('.change_ques p')["0"].childNodes["0"].textContent = question
var element1 = $('.steps_inner')["0"].children["0"].childNodes[1]
var element2 = $('.steps_inner')["0"].children["0"].childNodes[3]
$(element1).removeClass("active")
$(element2).addClass("active")
    /*
                                               
                                                var data = {};
                                                var user_data = $('#profile_form').serializeObject();
                                                var phone_number = user_data['phone_number'];
                                                //phone_number = phone_number.replace(/\s|\(|\)|-/gi, '');
                                                user_data['phone_number'] = phone_number;
                                                user_data['user_type'] = user_data['user_role'];
                                                delete user_data.user_role;
                                                data.body = user_data;


             $.when(candidateregister(data)).then(function (data) { // call the update profile api

                                                    if (data.meta.success) { // ajax success
                                                        $('.loader').hide(); // hide loader
                                                        toastr.success(data.data.message); // show toaster
                                                        $('#profile_submit').prop('disabled', false);
                                                        
                                                        setTimeout(function(){
                                                            window.location.href = Data.base_url + 'profile';
                                                        }, 3000);
                                                    } else { // ajax error
                                                        $(".loader").hide(); // hide loader
                                                        $('#profile_submit').prop('disabled', false);
                                                    }
                                                });*/
                                      
        });
            $(document).on('click', '.edit_signup_ques a', function() { 
                //console.log(question)
             $('.step_one_outer').show()  
            $('.step_two_outer').hide()
               
            var element1 = $('.steps_inner')["0"].children["0"].childNodes[1]
var element2 = $('.steps_inner')["0"].children["0"].childNodes[3]
$(element2).removeClass("active")
$(element1).addClass("active")

            question = "";
                     })

             window.URL = window.URL || window.webkitURL;

  function setFileInfo(file) {
   var imagename  = $(file)["0"].files["0"].name;
  var files = $(file)["0"].files["0"];

   var extension = imagename.split('.').pop()
          console.log("extension"+extension)
          if(extension=="mp4"){
           
  //myVideos.push(files[0]);
  var video = document.createElement('video');
  video.preload = 'metadata';

  video.onloadedmetadata = function() {
    window.URL.revokeObjectURL(video.src);
     var duration= video.duration;
     console.log("height"+video.videoHeight+"width"+video.videoWidth)
     var height = video.videoHeight
     var width = video.videoWidth
     if(duration>30){
        toastr.error("Duration of video cannot be more than 30 seconds")
     }
     else if(width<height){
    toastr.error("Video mode should be portrait")

     }
     else{
         uploadSingleFile(file)
     } 
  }

  video.src = URL.createObjectURL(files);
          }
          else{
        toastr.error("File Uploaded should be of type Video")

          }
}

function changeFileInfo(file) {
   var imagename  = $(file)["0"].files["0"].name;
  var files = $(file)["0"].files["0"];

   var extension = imagename.split('.').pop()
          console.log("videoextension"+extension)
          if(extension=="mp4"){
           
  //myVideos.push(files[0]);
  var video = document.createElement('video');
  video.preload = 'metadata';

  video.onloadedmetadata = function() {
    window.URL.revokeObjectURL(video.src);
     var duration= video.duration;
     console.log("height"+video.videoHeight+"width"+video.videoWidth)
     var height = video.videoHeight
     var width = video.videoWidth
     if(duration>30){
        toastr.error("Duration of video cannot be more than 30 seconds")
     }
     else if(width<height){
    toastr.error("Video mode should be portrait")

     }
     else{
         changeVideo(file)
     } 
  }

  video.src = URL.createObjectURL(files);
          }
          else{
        toastr.error("File Uploaded should be of type Video")

          }
}

var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png","mp4"];    
function dialog(message, yesCallback, noCallback) {
   $('#confirm').show();

    $('#btnYes').click(function() {
      //  dialog.dialog('close');
        yesCallback();
    });
    $('#btnNo').click(function() {
        //dialog.dialog('close');
        noCallback();
    });
}

function Validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    toastr.error("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }
  
    return true;
}

var contains = function(needle) {
    // Per spec, the way to identify NaN is that it is not equal to itself
    var findNaN = needle !== needle;
    var indexOf;

    if(!findNaN && typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                var item = this[i];

                if((findNaN && item !== item) || item === needle) {
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle) > -1;
};
     var base = Data.base_url+"assets/"
     var newhtml = '<div class="remove_btn"><a href="#" title="Remove"><span class="check_btn">'
        newhtml += '<img src="'+base+'images/remove.png" alt="Remove"></span><span class="btn_name">Remove</span></a></div>'
        newhtml += '</div>' 

 var experiencenewhtml = '<div class="add_btn add_work_experience_button">'
 experiencenewhtml += '<a href="#" title="Remove">'
  experiencenewhtml += '<span class="check_btn">'
   experiencenewhtml += '<img src="'+base+'/images/plus-icon.png" alt="Add another">'
  experiencenewhtml += '</span><span class="btn_name">Add another</span></a>'
    experiencenewhtml += '</div>'
        var educationparent = $('.work_exper_outer')
                         function uploadSingleFile(file) {

      var cancelcounter = 0;
          var ajax = new XMLHttpRequest();             
          var elementfiles = $(file)["0"].files["0"];
          var imagename  = $(file)["0"].files["0"].name;
          var imagesize = $(file)["0"].files["0"].size;
         //  var form = $(file)["0"].form         
           //var check = Validate(form);
         
      if(imagesize>= 4 * 1024 * 1024){
             alert("Image size exceeded");
           toastr.error("Image Size should be lower than 4MB"); 
           $(file).val("")
        } 
       /* else if(check==false){
            $("#status_" + fileId).text("File Uploaded should be of type Image"); 
                  $(file).val("")
        }*/
        else{
          
            //Progress Listener
            ajax.upload.addEventListener("progress", function (e) {
                $('.uploaded_video').show()
                var percent = (e.loaded / e.total) * 100;
           $('.progress-bar').css("width",Math.round(percent)+"%")
               // $('.progress-bar').attr('valuenow')
                $('.value').text(Math.round(percent))
             //    $('.continue_btn a').prop('disabled', false); 
                //$('#progressbar_' + fileId).val(Math.round(percent))
               //$("#notify_" + fileId).text("Uploaded " + (e.loaded / 1048576).toFixed(2) + " MB of " + (e.total / 1048576).toFixed(2) + " MB ");
            }, false);
            //Load Listener
            ajax.addEventListener("load", function (e) {
                $('.upload_video').hide()
                var successdata = event.target.responseText;
               console.log(successdata)
               var obj = JSON.parse(event.target.responseText);
               console.log(obj)
               var add = obj.data.add;
               var filetype = obj.data.file_type
                 var imagename =  obj.data.image_name;  
                  $('.progress-bar').css("width","100%")
                 $('.video_come_here video').attr('src',imagename)  
                 videourl+=imagename;
                 $('.conti_btn').prop("disabled", false);
                 $('.save_video_button').css("display","block");

               //   $('.video_error').text("Upload Failed.Please Try Again");
               //$("#status_" + fileId).text(event.target.responseText.data.message);
            }, false);
            //Error Listener
            ajax.addEventListener("error", function (e) {
               // $("#status_" + fileId).text("Upload Failed");
              // $("#status_" + fileId).text("Upload Failed");
              //$('.video_error').text("Upload Failed.Please Try Again");
            toastr.error("Upload Failed.Please Try Again")

                                $('#retryvideo').css("display","block"); 
            }, false);
            //Abort Listener
            ajax.addEventListener("abort", function (e) {
              // $("#status_" + fileId).text("Upload Aborted");
               toastr.error("Upload Aborted")
            }, false);

            ajax.open("POST", Data.base_url + 'candidate/saveVideo',true); // Your API .net, php

            var uploaderForm = new FormData(); // Create new FormData
            uploaderForm.append("file1", elementfiles); // append the next file for upload
            ajax.send(uploaderForm);
          
            
        }
        }

          function changeVideo(file) {
           
      var cancelcounter = 0;
          var ajax = new XMLHttpRequest();   
          console.log($(file));          
          var elementfiles = $(file)["0"].files["0"];
          var imagename  = $(file)["0"].files["0"].name;
          var imagesize = $(file)["0"].files["0"].size;
          $('#videoid').val(imagename)
         //  var form = $(file)["0"].form         
           //var check = Validate(form);
         
      if(imagesize>= 4 * 1024 * 1024){
             alert("Image size exceeded");
           toastr.error("Image Size should be lower than 4MB"); 
           $(file).val("")
        } 
       /* else if(check==false){
            $("#status_" + fileId).text("File Uploaded should be of type Image"); 
                  $(file).val("")
        }*/
        else{
                         

            //Progress Listener
            ajax.upload.addEventListener("progress", function (e) {
                $('.uploaded_video').show()
                var percent = (e.loaded / e.total) * 100;
           $('.progress-bar').css("width",Math.round(percent)+"%")
               // $('.progress-bar').attr('valuenow')
                $('.value').text(Math.round(percent))
             //    $('.continue_btn a').prop('disabled', false); 
                //$('#progressbar_' + fileId).val(Math.round(percent))
               //$("#notify_" + fileId).text("Uploaded " + (e.loaded / 1048576).toFixed(2) + " MB of " + (e.total / 1048576).toFixed(2) + " MB ");
            }, false);
            //Load Listener
              //Load Listener
            ajax.addEventListener("load", function (e) {
                $('.upload_video').hide()
                var successdata = event.target.responseText;
               console.log(successdata)
               var obj = JSON.parse(event.target.responseText);
               console.log(obj)
               var add = obj.data.add;
               var filetype = obj.data.file_type
                 var imagename =  obj.data.image_name;  
                  $('.progress-bar').css("width","100%")
                 $('.video_come_here video').attr('src',imagename)  
                 videourl+=imagename;
                $('.change_video_button').css("display","block");
                // $('.conti_btn').prop("disabled", false);

                

               //   $('.video_error').text("Upload Failed.Please Try Again");
               //$("#status_" + fileId).text(event.target.responseText.data.message);
            }, false);
            //Error Listener
            ajax.addEventListener("error", function (e) {
               // $("#status_" + fileId).text("Upload Failed");
              // $("#status_" + fileId).text("Upload Failed");
              //$('.video_error').text("Upload Failed.Please Try Again");
            toastr.error("Upload Failed.Please Try Again")

              // $('#retry_' + fileId).css("display","block") 
            }, false);
            //Abort Listener
            ajax.addEventListener("abort", function (e) {
              // $("#status_" + fileId).text("Upload Aborted");
               toastr.error("Upload Aborted")
            }, false);
                 

                  var videodata = {};
                videodata.body = $('#candidateGistEdit_Form').serializeObject();
               
                console.log(videodata.body)

            ajax.open("POST", Data.base_url + 'candidate/changeVideo',true); // Your API .net, php

          var uploaderForm = new FormData(); // Create new FormData
            uploaderForm.append("file1", elementfiles); // append the next file for upload
            ajax.send(uploaderForm);
            
        
        }
        }

         $(document).on('click', '.conti_btn', function() {
            console.log(question)
            console.log(videourl)
     $('.step_two_outer').hide()
     $('.step_three_outer').show()
    // $('.coman_heading').hide()
      var element1 = $('.steps_inner')["0"].children["0"].childNodes[5]
var element2 = $('.steps_inner')["0"].children["0"].childNodes[3]
$(element2).removeClass("active")
$(element1).addClass("active")
         })
    $(document).on('click','.add_education_button',function(event){
        event.preventDefault();

  var button = this
  

    var last =   $('.clone_education:last')
    var clone = $(last).clone()
    console.log($(clone))
   var element = $(clone).find('.add_education_button')

$(element).before(newhtml)
 var length =   $(clone).find('.remove_btn').length;
if(length>1){
 $(clone).find('.remove_btn:first').remove()   
}
if($(button).parents().closest('.experi_list_outer ').find('.candidatestudyfield').hasClass('others')){
   $(clone).find('.candidatestudyfield').removeClass('others')
    $(clone).find('.extrafieldofstudy').closest('.experience_list_outer').remove();
}
if($(button).parents().closest('.experi_list_outer ').find('.candidatecollege').hasClass('others')){
   $(clone).find('.candidatecollege').removeClass('others')
    $(clone).find('.extracollege').closest('.experience_list_outer').remove();
}
$(clone).find('.bootstrap-select').replaceWith(function() { return $('select', this); });
   $(clone).find('select').selectpicker();
$(last).after(clone)

var name1 = $('.candidatedegree').eq(-2).find('.selectpicker').attr('id');
var res = name1.split("-");
var secondres = res[1];
//var res2 = secondres.split("]")
var newnameid = parseInt(secondres[0])+1
var newname = "candidatedegree-"+newnameid
console.log(newname);
$(clone).find('.candidatedegree').attr('id',newname)

var name1 = $('.candidatestudyfield').eq(-2).find('.selectpicker').attr('id');
var res = name1.split("-");
var secondres = res[1];
//var res2 = secondres.split("]")
var newnameid = parseInt(secondres[0])+1
var newname = "candidatestudyfield-"+newnameid
console.log(newname);
$(clone).find('.candidatestudyfield').attr('id',newname)    

var name1 = $('.candidatecollege').eq(-2).find('.selectpicker').attr('id');
var res = name1.split("-");
var secondres = res[1];
//var res2 = secondres.split("]")
var newnameid = parseInt(secondres[0])+1
var newname = "candidatecollege-"+newnameid
console.log(newname);
$(clone).find('.candidatecollege').attr('id',newname)    

var name1 = $('.candidategradyear').eq(-2).find('.selectpicker').attr('id');
var res = name1.split("-");
var secondres = res[1];
//var res2 = secondres.split("]")
var newnameid = parseInt(secondres[0])+1
var newname = "candidategradyear-"+newnameid
console.log(newname);
$(clone).find('.candidategradyear').attr('id',newname)  
$(clone).find('select').val("default");
$(clone).find('.candidate_education_id').val("")
$(button).hide()
    })

  $(document).on('click','.add_work_experience .add_work_experience_button',function(event){
 event.preventDefault();


  var button = this
 

    var last =   $('.clone_experience:last')

    var clone = $(last).clone()
    //$('.clone_experience:last').find('.add_work_experience_button').remove()
    console.log($(clone))
    $(clone).find('.candidatecompany').val('');
    $(clone).find('.candidatecompanytitle').val('');
   
   $(clone).find('.bootstrap-select').replaceWith(function() { return $('select', this); });
   $(clone).find('select').selectpicker();
   //$(clone).find('.candidatestartmonth').find('select').selectpicker();
   var element = $(clone).find('.add_work_experience_button')

$(element).before(newhtml)
 var length =   $(clone).find('.remove_btn').length;
if(length>1){
 $(clone).find('.remove_btn:first').remove()   
}

$(last).after(clone)
var name1 = $('.candidatecompany').eq(-2).attr('id');
var res = name1.split("-");
var secondres = res[1];
//var res2 = secondres.split("]")
var newnameid = parseInt(secondres[0])+1
var newname = "candidatecompany-"+newnameid
console.log(newname);
$(clone).find('.candidatecompany').attr('id',newname)

var name1 = $('.candidatecompanytitle').eq(-2).attr('id');
var res = name1.split("-");
var secondres = res[1];
//var res2 = secondres.split("]")
var newnameid = parseInt(secondres[0])+1
var newname = "candidatecompanytitle-"+newnameid
console.log(newname);
$(clone).find('.candidatecompanytitle').attr('id',newname)

var name1 = $('.candidatestartmonth').eq(-2).find('select').attr('id');
var res = name1.split("-");
var secondres = res[1];
//var res2 = secondres.split("]")
var newnameid = parseInt(secondres[0])+1
var newname = "candidatestartmonth-"+newnameid
console.log(newname);
$(clone).find('.candidatestartmonth').attr('id',newname)

var name1 = $('.candidatestartyear').eq(-2).find('select').attr('id');
var res = name1.split("-");
var secondres = res[1];
//var res2 = secondres.split("]")
var newnameid = parseInt(secondres[0])+1
var newname = "candidatestartyear-"+newnameid
console.log(newname);
$(clone).find('.candidatestartyear').attr('id',newname)





var name1 = $('.candidateendmonth').eq(-2).find('.selectpicker').attr('id');
var res = name1.split("-");
var secondres = res[1];
//var res2 = secondres.split("]")
var newnameid = parseInt(secondres[0])+1
var newname = "candidateendmonth-"+newnameid
console.log(newname);
$(clone).find('.candidateendmonth').attr('id',newname)
    

var name1 = $('.candidateendyear').eq(-2).find('.selectpicker').attr('id');
var res = name1.split("-");
var secondres = res[1];
//var res2 = secondres.split("]")
var newnameid = parseInt(secondres[0])+1
var newname = "candidateendyear-"+newnameid
console.log(newname);
$(clone).find('.candidateendyear').attr('id',newname)



var nameattr1 = $('.candidateendmonth').eq(-2).find('.selectpicker').attr('name');
console.log(nameattr1)
var resattr1 = nameattr1.split("[");
var secondres = resattr1[1];
var resattr12 = secondres.split("]");
var newnameattr1 = parseInt(resattr12[0])+1 
var newnameattrstring1 = 'candidateendmonth'+"["+newnameattr1+"]"
$(clone).find('.candidateendmonth').attr('name',newnameattrstring1)

var nameattr2 = $('.candidateendyear').eq(-2).find('.selectpicker').attr('name');
var resattr2 = nameattr2.split("[");
var secondres = resattr2[1];
var resattr22 = secondres.split("]");
var newnameattr2 = parseInt(resattr22[0])+1 
var newnameattrstring2 = 'candidateendyear'+"["+newnameattr2+"]"
$(clone).find('.candidateendyear').attr('name',newnameattrstring2)
/*var name1 = $('.candidatecompany').eq(-2).attr('name');
var res = name1.split("[");
var secondres = res[1];
var res2 = secondres.split("]")
var newnameid = parseInt(res2[0])+1
var newname = "candidatecompany["+newnameid+"]"
console.log(newname);
$(clone).find('.candidatecompany').attr('name',newname)*/


var rightelements = $(clone).find('.right_filds')
$(rightelements).css("display","inline-block")

var elementmonth = $(clone).find('.candidateendmonth').find('.selectpicker')
var elementyear = $(clone).find('.candidateendyear').find('.selectpicker')

 $(elementmonth).rules('add', { valueNotEquals: "default" })

 $(elementyear).rules('add', { valueNotEquals: "default" })
 
$(clone).find('.currently_working').remove();
$(clone).find('.candidate_job_id').val("")
$(button).hide()

});

$(document).on('click','.add_education .remove_btn',function(event){
       event.preventDefault();
  console.log($('.add_education').eq(-2))
     $('.add_education').eq(-2).css("display","block");
     console.log($('.clone_education').length)
    $('.add_education_button').eq(-2).css("display","inline-block");
    if($('.clone_education').length==2){
      $('.remove_btn').eq(-2).css("display","none");
     }
     // console.log($('.add_education_button')) 
       var removeElement = $(this)["0"].parentElement.parentElement;
       $(removeElement).remove();

   })
  


    $(document).on('click','.add_work_experience .remove_btn',function(event){
       event.preventDefault();
       $('.add_work_experience_button').eq(-2).show();
       $('.currently_working').eq(-2).show()
       var removeElement = $(this)["0"].parentElement.parentElement;
      $(removeElement).remove();


   })

$(document).on('change',".candidateskills",function() {
    if(this.checked) {
      var element = $(this).parents().eq(2).find('.candidateskillvaluelist');
      console.log($(element))
   $(element).rules('add', 'required')
       // console.log($(this).parents().closest('.search_box').find('.select_experience'))
   
    $(this).parents().closest('.search_box').find('.select_experience').css("display","inline-block")
   var newselect = $(this).parents().closest('.search_box').find('select')
    //console.log(newselect)
  $(newselect).rules('add', { valueNotEquals: "default" })
    }
    else{
      var element = $(this).parents().eq(2).find('.candidateskillvaluelist');
       console.log($(element))
      $(element).rules('remove');
      var newselect = $(this).parents().closest('.search_box').find('select')
    //console.log(newselect)
    $(newselect).rules('remove');
     $(this).parents().closest('.search_box').find('.select_experience').css("display","none")   
    }
});


$(document).on('change',".extralocations",function() {
    if(this.checked) {
      var element = $(this).parents().eq(2).find('.extralocationvalue');
      //var element = $(this).parents().closest('.experience_type').find('.extralocationvalue');
      console.log($(element))
   $(element).rules('add',{
        required: true,
        unique: true
    })
       // console.log($(this).parents().closest('.search_box').find('.select_experience'))
   
   
    }
    else{
      var element = $(this).parents().eq(2).find('.extralocationvalue');
     // var element = $(this).parents().closest('.experience_type').find('.extralocationvalue');
      console.log($(element))
   $(element).rules('remove')
       // console.log($(this).parents().closest('.search_box').find('.select_experience'))
   
   
    }
});

$(document).on('change',".currently_working input[type=checkbox]",function() {

 if(this.checked) {
     // var element = $(this).parents().eq(2).find('.experience_list_outer ').find('.right_filds');
      var element = $(this).parents().closest('.experience_list_outer').find('.right_filds');
      var newelement1 = $(element).find('.candidateendmonth').find('.selectpicker');
      var newelement2 = $(element).find('.candidateendyear').find('.selectpicker');

   $(element).css('display', 'none')
    $('#candidateendmonth-0').rules('remove')
    $('#candidateendyear-0').rules('remove')

     $(newelement1).rules('add', { valueNotEquals: "default" })
    $(newelement2).rules('add', { valueNotEquals: "default" })
         console.log($(newelement2))

       // console.log($(this).parents().closest('.search_box').find('.select_experience'))
   
   
    }
    else{
     // var element = $(this).parents().eq(2).find('.experience_list_outer ').find('.right_filds');
      var element = $(this).parents().closest('.experience_list_outer').find('.right_filds');
    $(element).css('display', 'inline-block')
    var newelement1 = $(element).find('.candidateendmonth');
      var newelement2 = $(element).find('.candidateendyear');
            console.log($(newelement2))
    $('#candidateendmonth-0').rules('add', { valueNotEquals: "default" })
    $('#candidateendyear-0').rules('add', { valueNotEquals: "default" })
       // console.log($(this).parents().closest('.search_box').find('.select_experience'))
   
   
    }
  })

  $(document).on('change',".initialexperience",function() {
  var selectedvalue = $(this)["0"].selectedOptions["0"].innerText
   if(selectedvalue=="Student"){
   console.log(selectedvalue);
   $('.work_exc_form').css("display","none");
   }
   else{
   $('.work_exc_form').css("display","block"); 
   }
   })
  
 
   $(document).on('click', '#toggle_menu', function() {
            $('body').addClass('menu_visible');
            var me = $(this);
            me.addClass('animate_menu');
           
            if (me.hasClass('open_menu')) {
                me.removeClass('open_menu').addClass('close_menu');
                $('body').removeClass('menu_visible');
            } else {
                me.removeClass('close_menu').addClass('open_menu');
            }
            
            setTimeout(function(){
                 me.removeClass('animate_menu');
            }, 1000);
        });

        $(document).on('click', '#toggle_menu1', function() {
            $('body').removeClass('menu_visible');
        });
         
         $(document).on('click','#retryvideo',function() {
                 var fileelement = $('.upload_video').find('#poop')
                 setFileInfo(fileelement)
         })

          $(document).on('click','#editretryvideo',function(event) {
              event.preventDefault();
                 var fileelement = $('.talent_dash .upload_video').find('#poop')
                 changeFileInfo(fileelement)
         })

         $(document).on('click','.edit_candidate_ques a',function() {
        $('.user_form').hide();
         $('.edit_candidate_firststep').css('display','block') 
         })

         $(document).on('click', '.change_video_button', function() {
          var fileelement = $('#candidateGistEdit_Form').find('#poop')
          // $(fileelement).attr('accept', '.jpg, .png');
           $(fileelement).show();
           $(fileelement).focus();
           $(fileelement).click();
           $(fileelement).hide();
         }) 

         $(document).on('click', '.save_video_button', function() {
          var fileelement = $('.step_two_outer').find('#poop')
          // $(fileelement).attr('accept', '.jpg, .png');
           $(fileelement).show();
           $(fileelement).focus();
           $(fileelement).click();
           $(fileelement).hide();
         })

         $(document).on('click','.back_icon a', function() {
          var children = $('.steps_inner ul')["0"].children
          for(var i=0;i<children.length;i++){
            //console.log($(children[i]))
            if($(children[i]).hasClass('active')){
              console.log(i);
              if(i==1){
                  $(children[i]).removeClass('active');
                $(children[i-1]).addClass('active');
                $('.step_two_outer').hide(); 
                $('.step_one_outer').css("display","block");               
              }
              else if(i==2){
                $(children[i]).removeClass('active');
                $(children[i-1]).addClass('active');
                 $('.step_three_outer').hide(); 
                $('.step_two_outer').show();
              }
            }
          }
         })

        /* $(document).on('click','#candiateshare', function(event) {
          console.log("reached")
         event.preventDefault()
        window.location.assign('mailto:foo@bar.com');
         })*/

          

      function copyLink(value) {
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = value;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
    toastr.clear();
    toastr.success("Link Copied to Clipboard");
}  

//$(document).on('change',".filter_div input[type=checkbox]",function() {
  function check(){
console.log("reached")
var locations = [];
var expertises = [];
var experiences = [];
var degrees = [];
var colleges = [];
var study_fields = [];


$('input[type="checkbox"][name="candidatelocation\\[\\]"]:checked').each(function(){

locations.push($(this)["0"].value)
})

$('input[type="checkbox"][name="candidateExpertise\\[\\]"]:checked').each(function(){
expertises.push($(this)["0"].value)
})

$('input[type="checkbox"][name="candidateExperience\\[\\]"]:checked').each(function(){
experiences.push($(this)["0"].value)
})

$('input[type="checkbox"][name="candidateDegree\\[\\]"]:checked').each(function(){
degrees.push($(this)["0"].value)
})

$('input[type="checkbox"][name="candidateStudyField\\[\\]"]:checked').each(function(){
study_fields.push($(this)["0"].value)
})

$('input[type="checkbox"][name="candidateCollege\\[\\]"]:checked').each(function(index,value){
colleges.push($(this)["0"].value)
})

var candidateskills = $('#candidateskills').val()

if($('.switch input[type=checkbox]').prop("checked") == true){ 
var savedcheck = "on";
}else{
var savedcheck = "off";
}

  var data = {};
  data.body = {"locations" : locations,"expertises" : expertises,"experiences" : experiences,
"degrees" : degrees,"study_fields" : study_fields,"colleges" : colleges,"skills" : candidateskills,"savedcheck" : savedcheck};
             //   data.body['question'] = question;
               // data.body['video'] = videourl;
               // console.log(data.body)
               // var redirect = '<?= !empty($_GET['redirect']) ? $_GET['redirect'] : '' ?>';
               // $('.loader').show(); // show loader
             
        $.when(filterCandidates(data)).then(function (data) {
                       console.log(data);
               $('.coman_inner').html("")

                if (data.meta.success) { // if success
                 var jsondata = data.data.candidatedetails
                 var candidateSkillDetails = data.data.candidateSkillDetails;
                  var candidateLatestEducationdetails = data.data.candidateLatestEducationdetails;
                  var candidateLatestJobdetails = data.data.candidateLatestJobdetails;
                  var candidateAllEducationdetails = data.data.candidateAllEducationdetails;
                   var candidateAllJobdetails = data.data.candidateAllJobdetails;
                    var candidateLocationDetails = data.data.candidateLocationDetails;
                     var skills_string = data.data.skills_string;
                 var html = "";
                 for(var i = 0; i < jsondata.length; i++) {
                   // html+= '<div class="test">hioii</div>'

                 var summary = "";   
             summary+= 'Hello, I'+"'m"+jsondata[i].Name
              if(jsondata[i].Experience_level!="Student"){ 
               summary+= ', a '+candidateLatestJobdetails[i].job_title+'in'+candidateLocationDetails[i][0]
                summary+= ' with '+jsondata[i].Experience_level+" of Experience"}
    if(candidateLatestEducationdetails[i].Degree == "Student"){ 
      summary+=".I am a Student in"} 
  else if(candidateLatestEducationdetails[i]['Degree'] == "Bacholers"){ 
  summary+=".I have a Bacholer's Degree in";}
   else if(candidateLatestEducationdetails[i]['Degree'] == "Masters"){ 
  summary+=".I have a Master's Degree in";}
  else{
   summary+=".I have a "+candidateLatestEducationdetails[i]['Degree']+"Degree in"
  }
summary+=candidateLatestEducationdetails[i].study_field+" from the "+candidateLatestEducationdetails[i].college
summary+=" .My core skills include "+skills_string[i]
    
                 html+= '<div class="candidate_list">'
                 html+= '<div class="candidate_video candidate_dashboard_video">'
                 html+= '<video width="550" height="750" class="video_inner" muted="muted">'
                 html+= '<source src="'+jsondata[i].video_url+'" type="video/mp4"></video>'
               html+= '<div class="progres_outer"><div class="progress">'
      html+=    '<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:100%">'
    html+=   '</div></div></div>'
      html+= ' <input type="hidden" class="employer_candidate_id" name="candidate_id['+i+']" value="'+jsondata[i].user_id+'"/></div>'
      html+= '<div class="candidate_dec"><div class="candidate_inner">'
      html+= '<h3><span class="position">'+candidateLatestJobdetails[i].job_title+'</span>'
html+= '<span class="hide_icon"><a href="#"><img src="'+Data.base_url+'assets/images/hide.png" alt="hide"></a></span></h3>'
html+= '<h4>'+candidateLatestEducationdetails[i].college+'<br>'+candidateLocationDetails[i][0]+'</h4>'
html+= '<p>'+summary+'</p>'+'</div>'
html+= '<div class="action_list"><ul>'
html+= '<li><a class="contact_btn"id="modal-215935" href="#modal-container-215935" role="button" class="btn" data-toggle="modal" title="Contact">Contact</a></li>'
html+= '<li><a class="action_btn" href="#" title="Resume"><img src="'+Data.base_url+'assets/images/resume_icon.png" alt="Resume"></a></li>'
html+=  '<li><a class="action_btn" title="Save"><img src="'+Data.base_url+'assets/images/save_icon.png" alt="Save"></a></li>'
html+=   '<li><a class="action_btn" id="modal-215934" href="#modal-container-215934" role="button" class="btn" data-toggle="modal" title="Share">'
html+='<img src="'+Data.base_url+'assets/images/share.png" alt="Share"></a></li></ul></div></div>'  


    html+='<div class="modal fade popup_outer complete_popup" id="gistModal" role="dialog" aria-hidden="true">'
  html+='<div class="modal-dialog">'
  html+='<div class="modal-content">'
    html+='<div class="modal-header">'
    html+='<h3>Email '+jsondata[i].Name+'</h3> <button type="button" class="close" title="close" data-dismiss="modal" aria-hidden="true"><img src="'+Data.base_url+'assets/images/pop_close.png" title="Close iocn" class="img-responsive" alt="close iocn"></button>'
      html+= '</div><div class="modal-body">'
  html+='<h4 class="cancel_btn email"><a href="mailto:'+jsondata[i].Email+'?subject=Gist Invite" title="Share via Email"><span class="icon_type"><img src="'+Data.base_url+'assets/images/email_icon.png" alt="Share via Email"></span> <span>'+jsondata[i].Email+'</span></a></h4>'
      html+='</div><div class="modal-footer"></div></div></div></div>'

  html+='<div class="modal fade popup_outer complete_popup" id="gistShareModal" role="dialog" aria-hidden="true">'
  html+='<div class="modal-dialog"><div class="modal-content"><div class="modal-header">'
  html+='<h3>Share Candidate</h3> <button type="button" class="close" title="close" data-dismiss="modal" aria-hidden="true"><img src="'+Data.base_url+'assets/images/pop_close.png" title="Close iocn" class="img-responsive" alt="close iocn"></button>'
html+='</div><div class="modal-body">'
  html+='<h4><a href="mailto:'+jsondata[i].Email+'?subject=Gist Profile Link" id="candiateshare" onclick="triggerShare(this)" title="Share via Email"><span class="icon_type"><img src="'+Data.base_url+'assetsimages/email.png" alt="Share via Email"></span> <span>Share via Email</span></a></h4>'
  html+='<h4><a href="#"  id="candidatelink" onclick="copyLink('+jsondata[i].profile_link+');triggerShare(this)" title="Copy Link"><span class="icon_type"><img src="'+Data.base_url+'assets/images/copy_link.png" alt="Copy Link"></span> <span>Copy Link</span></a></h4>'
  html+='<h4 class="cancel_btn"><a href="#" title="Cancel"><span class="icon_type">&nbsp;</span> <span>Cancel</span></a></h4>'
        html+='</div><div class="modal-footer"></div></div></div></div>'

                 }
                 if(jsondata.length==0){
                  console.log("Not found")
               $('.coman_inner').html("<p>No Candidates Found</p>"+
                "<br>"+"<p>Try Changing Your Search Criteria/Filters</p>")
                 }
                 else{
                                   console.log(html)
                 $('#nocandidates').text(jsondata.length)
                  $('.count_num').val(jsondata.length);
              //    document.getElementsByClassName(".candidate_outer_div")[0].innerHTML = html
                 $('.coman_inner').html(html);

            
                 }
                 }

          



})

$( "#showLess" ).trigger( "click" );
 
   }

  $(document).on('change',".filter_list_outer input[type=checkbox]",function() {
  check()
  })

  $(document).on('blur','#candidateskills',function (){
  check()

  })
   
   $(document).on('change','.switch input[type=checkbox]',function (){
   check()
   })

    $(document).on('click','#clearchecked',function(event){
      event.preventDefault();
  $('input:checkbox').removeAttr('checked');
  $('#candidateskills').val('');
  check()
  })