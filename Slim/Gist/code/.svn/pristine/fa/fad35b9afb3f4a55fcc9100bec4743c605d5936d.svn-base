<!DOCTYPE html>
<html lang="en">

<?php
include_once $this->getPart('/web/common/header.php');
?>
<body class="grey_bg">

    <div class="header_outer">
        <div class="header_inner">
            <div class="logo">
                <div class="back_icon">
                    <h1><a href="#" title="Gist">Gist</a></h1>
                </div>
            </div>

            <div class="menu_links">
                <ul>
                    <li> <a href="#" id="toggle_menu" title="Menu">
                            <span id="menu-lines-container">
                                <span id="menu-line-top"></span>
                                <span id="menu-line-bottom"></span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="menu_list">
        <ul>
                <li><a href="#" title="Sign Up">Record New Gist</a></li>
                <li><a href="#" title="Login">Update Profile</a></li>
                <li><a href="#" title="Support">View Resume</a></li>
                <li><a href="#" title="Colleges">Help</a></li>
                <li><a href="#" title="Employers">Logout</a></li>
                <li class="menu_term_link"><span>© I Think Therefore I am Ventures — <a href="#" title="Terms &amp; Privacy">Terms &amp; Privacy</a></span></li>
        </ul>
    </div>


    <div class="page_outer_section">
        <div class="coman_outer employer_dash">
            <div class="coman_inner">
                
                <div class="candidate_list">
                    <div class="candidate_video">
                        <video width="550" height="750" id="myVideo" autoplay>
                            <source src="<?php echo $candidatedetails['video_url'];?>" type="video/mp4">
                        </video>
                        <div class="progres_outer">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                </div>
                            </div>
                        </div>
                         <input type="hidden" class="employer_candidate_id" name="candidate_id" value="<?php echo $candidatedetails['user_id'];?>"/>
                    </div>
                    <div class="candidate_dec">
                        <div class="candidate_inner">
                            <h3><span class="position"><?php echo $candidatedetails['Name']; ?></span></h3>
                            <h4><?php echo $candidateLatestJobdetails['job_title']; ?><br><?php  foreach($candidateLocationDetails as $key => $value){ ?>
                    <span><?php echo $value; ?></span><br>
                    <?php } ?></h4>

                           <p>Hello, I'm  <?php echo $candidatedetails['Name']; ?><?php if($candidatedetails['Experience_level']!="Student") { ?> , a  <?php echo $candidateLatestJobdetails['job_title']; ?> in <?php echo $candidateLocationDetails[0]; ?> with <?php echo $candidatedetails['Experience_level']." experience"; } ?>  <?php if($candidateLatestEducationdetails['Degree'] == "Student"){ echo ".I am a Student in ";} else if($candidateLatestEducationdetails['Degree'] == "Bacholers"){ echo ".I have a Bacholer's Degree in ";} else if($candidateLatestEducationdetails['Degree'] == "Masters"){ echo ".I have a Master's Degree in ";} else { echo ".I have a PhD Degree in "; } echo $candidateLatestEducationdetails['study_field']. " from the ".$candidateLatestEducationdetails['college'] ; echo ". My core skills include ".$skills_string; ?>    

                </p>
                        </div>
                        <div class="action_list">

                            <ul>
                                <li><a class="contact_btn" title="Contact">Contact</a></li>
                                <li><a class="action_btn" href="#" title="Resume" id="downloadresume"><img src="<?= $app['base_assets_url']; ?>images/resume_icon.png" alt="Resume"></a></li>
                                <li><a class="action_btn" title="Share" id="shareresume"><img src="<?= $app['base_assets_url']; ?>images/share.png" alt="Share"></a></li>
                            </ul>
                        </div>

                    </div>

                            <!--   <div id="gistModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

             <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Email <?php  echo $candidatedetails['Name'];?></h4>
      </div>

      <div class="modal-body">     
           <p><a href="mailto:<?php echo $candidatedetails['Email']; ?>?subject=Gist Invite"><?php echo $candidatedetails['Email']; ?></a></p>
       
       
      </div>
      <div class="modal-footer">
       
      </div>
     
    </div>

  </div>
</div>-->

 <div class="modal fade popup_outer complete_popup" id="gistModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Email <?php  echo $candidatedetails['Name'];?></h3> <button type="button" class="close" title="close" data-dismiss="modal" aria-hidden="true"><img src="<?= $app['base_assets_url']; ?>images/pop_close.png" title="Close iocn" class="img-responsive" alt="close iocn"></button>
                </div>
                <div class="modal-body">
                    <h4 class="cancel_btn email"><a href="mailto:<?php echo $candidatedetails['Email']; ?>?subject=Gist Invite" title="Share via Email"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>images/email_icon.png" alt="Share via Email"></span> <span><?php echo $candidatedetails['Email'];?></span></a></h4>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

                   <!-- <div id="gistShareModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Share my gist</h4>
      </div>

      <div class="modal-body">     
           <p><a href="mailto:<?php echo $candidatedetails['Email']; ?>?subject=Gist Profile Link" id="candiateshare" onclick="triggerShare(this)">Share via Email</a></p>
           <p><a href="#" id="candidatelink" onclick="copyLink('<?php echo  $candidatedetails['profile_link'];?>');triggerShare(this)">Copy link</a></p>
           <p><a href="javascript:void(0)"  data-dismiss="modal">Cancel</a></p>
       
      </div>
      <div class="modal-footer">
       
      </div>
     
    </div>

  </div>
</div>-->


<div class="modal fade popup_outer complete_popup" id="gistShareModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Share Candidate</h3> <button type="button" class="close" title="close" data-dismiss="modal" aria-hidden="true"><img src="<?= $app['base_assets_url']; ?>images/pop_close.png" title="Close iocn" class="img-responsive" alt="close iocn"></button>
                </div>
                <div class="modal-body">
                    <h4><a  href="mailto:<?php echo $candidatedetails['Email']; ?>?subject=Gist Profile Link" id="candiateshare" onclick="triggerShare(this)" title="Share via Email"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>images/email.png" alt="Share via Email"></span> <span>Share via Email</span></a></h4>
                    <h4><a href="#"  id="candidatelink" onclick="copyLink('<?php echo  $candidatedetails['profile_link'];?>');triggerShare(this)" title="Copy Link"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>images/copy_link.png" alt="Copy Link"></span> <span>Copy Link</span></a></h4>
                    <h4 class="cancel_btn"><a href="#" title="Cancel"><span class="icon_type">&nbsp;</span> <span>Cancel</span></a></h4>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

                </div>
            </div>
        </div>
    </div>








   <?php
include_once $this->getPart('/web/common/footer.php');
?>

    <script>
        window.scrollTo(0, 0);
        window.addEventListener('scroll', function(e) {
            // console.log(window.scrollY);
            if (window.scrollY > 100) {
                document.getElementsByClassName('header_outer')[0].classList.add("sticky");
            } else {
                document.getElementsByClassName('header_outer')[0].classList.remove("sticky");
            }
        })


        $('.custom_textarea').on("keyup", function(e) {
            var maxlength = 10000;

            this.style.height = "1px";
            if (parseInt(this.scrollHeight) <= 50) {
                console.log(this.scrollHeight);
                this.style.height = "50px";
            } else {
                this.style.height = (this.scrollHeight) + "px";
            }

        });




        $(document).ready(function() {
            if (parseInt($(window).width()) <= 767) {
                $(".edit_side").slideUp();
            }

            $(".slide_down").click(function() {
                $(".edit_side").slideToggle();
            });
             
        });

       

     

var myVideoTag = document.getElementById('myVideo');

$("#myVideo").click(function() {
 // console.log($(this)); 
  if (this.paused) {
   //var width =  $('.progress-bar').width();
     var width = $(".progress-bar").width() / $('.progress-bar').parent().width() * 100;
    console.log("width - "+width);
    if(width=="100"){
      $('.progress-bar').css("width","0%")
   }
    this.play();
  } else {
    this.pause();
  }
});
myVideoTag.addEventListener('timeupdate', function(e) {
   // console.log("check");
    //var percent = null;
    // FF4+, Chrome
   var currentTime = this.currentTime;
var percent = Math.floor((currentTime/this.duration) * 100);
var calc = percent+"%";
  $('.progress-bar').css("width",calc)
  //  console.log(percent)

}, false);

$(document).on('click','#downloadresume',function(){

  var candidate_id = $(this).parents().closest(".candidate_list").find('.employer_candidate_id').val();
  var data = {};
                data.body = {"candidate_id" : candidate_id};

            //  $('.loader').show(); // show loader
                $.when(createResumePdf(data)).then(function (data) {
                        console.log(data)
                    if (data.meta.success) { // if success
                    var return_url = data.data.return_url;
                   window.location.href = return_url;
                    //window.open(return_url,'_blank');
                   // profile page redirct
                  // toastr.success("Email successfully sent");
                    //    $('#submit_btn').attr('disabled', false);
                    } else {
                      //  $('.loader').hide(); // hide loader
                      //  $('#submit_btn').attr('disabled', false);
                    }
                });
})
 $(document).on('click','#shareresume',function(){
           console.log("shared");
           $(this).parents().closest(".candidate_list").find('#gistShareModal').modal("show")
          
              
       })

 $(document).on('click','.contact_btn',function(){
   $(this).parents().closest('.candidate_list').find('#gistModal').modal('show');
})

  function triggerShare(element){
        // console.log($(this))
          if($(element).hasClass("shared")!=true){
            console.log($(element).parents().closest(".candidate_list").find('.employer_candidate_id'))
                  var candidate_id = $(element).parents().closest(".candidate_list").find('.employer_candidate_id').val();
                  
                    var data = {};
                data.body = {"candidate_id" : candidate_id};

            //  $('.loader').show(); // show loader
                $.when(updateVideoShares(data)).then(function (data) {

                    if (data.meta.success) { // if success
                    console.log(data)
                   // profile page redirct
                  // toastr.success("Email successfully sent");
                    //    $('#submit_btn').attr('disabled', false);
                    } else {
                      //  $('.loader').hide(); // hide loader
                      //  $('#submit_btn').attr('disabled', false);
                    }
                });
                $(this).addClass("shared");
              }
        }
    </script>

   
</body>

</html>