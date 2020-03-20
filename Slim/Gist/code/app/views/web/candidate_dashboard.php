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
                    <h1><a href="#" title="Gist Logo">Gist</a></h1>
                </div>
            </div>
            <div class="menu_links">
                <ul>
                    <li> <a title="Help" class="btns" href="#">Help</a> </li>
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

        <div class="auto_apply coman_outer">
            <div class="auto_apply_inner">
                <div class="share_gist">
                    <h2><?php  echo $candidatedetails['Name'];?></h2>
                    <p><?php echo ($candidateLatestJobdetails['job_title'] == "" ? "Student" : $candidateLatestJobdetails['job_title']);?><br>
                        <?php  echo $candidateLocationDetails[0];?></p>
                    <div class="auto_apply_btn"><button type="button" class="btn" title="Auto Apply" data-toggle="modal" data-target="#applyWithGist"><span class="bolt_icon"><img src="<?= $app['base_assets_url']; ?>images/bolt.png" alt="Bolt"></span><span>Auto Apply</span></button></div>
                    <div class="share_btn"><button type="button" class="btn" title="Share my Gist" id="sharegist">Share my Gist ›</button></div>
                </div>
                <div class="candidate_video">
                    <video width="550" height="750" class="video_inner" controls>
                        <source src="<?php  echo $candidatedetails['video_url'];?>" type="video/mp4">
                    </video>
                    <div class="progres_outer">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                            </div>
                        </div>
                    </div>
                    <div class="copied_clipboard" style="display: none;"><p>Link copied to clipboard.</p></div>
                </div>
            </div>

        </div>

        <div class="coman_outer engagement_outer">
            <div class="engagement_inner">





                <div class="engagement_box coman_outer">
                    <h2>Engagement</h2>

                    <div class="engagement_num">
                        <ul>
                            <li>
                                <h3><?php echo($candidateTotalViews == 0 ? "61" : $candidateTotalViews); ?><span class="plus_num"><?php echo($candidateLatestViews == 0 ? "+4" : "+".$candidateLatestViews); ?></span></h3>
                                <h4>Views</h4>
                            </li>
                            <li>
                                <h3><?php echo($candidateTotalSaves == 0 ? "13" : $candidateTotalSaves); ?><span class="red_num"><?php echo($candidateLatestSaves == 0 ? "-1" : "-".$candidateLatestSaves); ?></span></h3>
                                <h4>Saves</h4>
                            </li>
                            <li>
                                <h3><?php echo($candidateTotalShares == 0 ? "13" : $candidateTotalSaves); ?><span class="plus_num"><?php echo($candidateLatestShares == 0 ? "+2" : "+".$candidateLatestShares); ?></span></h3>
                                <h4>Shares</h4>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="engagement_box coman_outer">
                    <h2>Visitors by Industry</h2>

                    <div class="top_industry">
                        <h3>Top Locations</h3>
                        <ul>
                            <li>
                                <span class="info_name">Information Technology</span>
                                <div class="progres_outer">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="48" style="width:48%">
                                        </div>
                                    </div>
                                    <span>48%</span>
                                </div>
                            </li>

                            <li>
                                <span class="info_name">Financial Services</span>
                                <div class="progres_outer">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="21" aria-valuemin="0" aria-valuemax="21" style="width:21%">
                                        </div>
                                    </div>
                                    <span>21%</span>
                                </div>
                            </li>


                            <li>
                                <span class="info_name">Computer Software</span>
                                <div class="progres_outer">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="18" aria-valuemin="0" aria-valuemax="18" style="width:18%">
                                        </div>
                                    </div>
                                    <span>18%</span>
                                </div>
                            </li>

                            <li>
                                <span class="info_name">Higher Education</span>
                                <div class="progres_outer">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="12" style="width:12%">
                                        </div>
                                    </div>
                                    <span>12%</span>
                                </div>
                            </li>

                            <li>
                                <span class="info_name">Marketing and Advertising</span>
                                <div class="progres_outer">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="7" style="width:7%">
                                        </div>
                                    </div>
                                    <span>7%</span>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>

                <div class="engagement_box coman_outer">
                    <h2>Visitors by Location</h2>

                    <div class="top_industry">
                        <h3>Top Locations</h3>
                        <ul>
                            <li>
                                <span class="info_name">New York City</span>
                                <div class="progres_outer">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="48" aria-valuemin="0" aria-valuemax="48" style="width:48%">
                                        </div>
                                    </div>
                                    <span>48%</span>
                                </div>
                            </li>

                            <li>
                                <span class="info_name">Atlanta </span>
                                <div class="progres_outer">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="21" aria-valuemin="0" aria-valuemax="26" style="width:26%">
                                        </div>
                                    </div>
                                    <span>26%</span>
                                </div>
                            </li>


                            <li>
                                <span class="info_name">Boston</span>
                                <div class="progres_outer">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="17" aria-valuemin="0" aria-valuemax="17" style="width:17%">
                                        </div>
                                    </div>
                                    <span>17%</span>
                                </div>
                            </li>

                            <li>
                                <span class="info_name">Los Angeles</span>
                                <div class="progres_outer">
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="14" style="width:14%">
                                        </div>
                                    </div>
                                    <span>14%</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>



    </div>


    <!--Share via Email code start here-->
    <div class="modal fade popup_outer complete_popup" id="applyWithGist" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Apply with Gist</h3> <button type="button" class="close" title="close" data-dismiss="modal" aria-hidden="true"><img src="<?= $app['base_assets_url']; ?>images/pop_close.png" title="Close iocn" class="img-responsive" alt="close iocn"></button>
                </div>
                <form method="POST" id="candidateInvitation">
                <div class="modal-body">
                    <div class="auto_apply_popout">
                        <p>Applying for a job on the web? Attracting<br>
                            employers is easy when they know who you are.<br>
                            Just enter an employer’s email below, then we’ll <br>
                            introduce you on Gist, and you’ll be 5.5x more <br>
                            likely to land the interview.</p>
                        <div class="fild_outer">
                            <div class="fild_inner">
                                <input class="form-control" name="candidateEmployerEmail" placeholder="Enter employer’s email" type="text">
                            </div>
                        </div>

                        <div class="send_btn"><button type="submit"  class="btn">Send</button></div>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--Share via Email code end here-->


    <!--Share via Email code start here-->
    <div class="modal fade popup_outer complete_popup" id="sharePopup" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Share Candidate</h3> <button type="button" class="close" title="close" data-dismiss="modal" aria-hidden="true"><img src="<?= $app['base_assets_url']; ?>images/pop_close.png" title="Close iocn" class="img-responsive" alt="close iocn"></button>
                </div>
                <div class="modal-body">
                    <h4><a href="mailto:?subject=Gist Profile Link&body=Profile Link - <?php echo $candidatedetails['profile_link']; ?>" title="Share via Email"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>images/email.png" alt="Share via Email"></span> <span>Share via Email</span></a></h4>
                    <h4><a href="#" title="Copy Link" onclick="copyLink('<?php echo  $candidatedetails['profile_link'];?>');displayMessage();"><span class="icon_type"><img src="<?= $app['base_assets_url']; ?>images/copy_link.png" alt="Copy Link"></span> <span>Copy Link</span></a></h4>
                    <h4 class="cancel_btn"><a href="#" title="Cancel" data-dismiss="modal"><span class="icon_type">&nbsp;</span> <span>Cancel</span></a></h4>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!--Share via Email code end here-->



<div class="first_time_sign_in" style="display:none;"><p>Welcome <?php echo $candidatedetails['Name'];?>! Your Gist is live — now sit back while the companies come to you!</p></div>
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

        $(document).on('click',"#sharegist",function(){
         
         $('#sharePopup').modal('show');
        })

         $(window).load(function(){
        $(".first_time_sign_in").show().delay(5000).fadeOut();
         })
        function displayMessage(){
            $(".copied_clipboard").show().delay(5000).fadeOut();
        }

 var tolerancePixel = 300;
    var counter = 0;
    function checkMedia(){
     //   console.log("scroll"+tolerancePixel)
        // Get current browser top and bottom
        var scrollTop = $(window).scrollTop() + tolerancePixel;
        var scrollBottom = $(window).scrollTop() + $(window).height() - tolerancePixel;
        var media = $('.video_inner');
        media.each(function(index, el) {
       
          var yTopMedia = $(this).offset().top;
          var yPos = el.offsetTop - el.scrollTop + el.clientTop;
       //   console.log($(el).position())
                //console.log(yPos)
          var yBottomMedia = $(this).height() + yTopMedia;
            if(scrollTop < yBottomMedia && scrollBottom > yTopMedia){ //view explaination in `In brief` section above
         //   console.log("a")
              $(this).get(0).play();
            }
            else {
           //      console.log("b")
              $(this).get(0).pause();
               counter = 0;

            }
               $(this).get(0).ontimeupdate  = function() {
        console.log("The video is now playing");

         var currentTime = $(this)[0].currentTime

           var duration = $(this)[0].duration;
var percent = Math.floor((currentTime/this.duration) * 100);
var calc = percent+"%";

if (this.paused==false) {
    console.log(this.paused);
  $('.progress-bar').css("width",calc)
}

         console.log(currentTime)
             
            };
          });
        //}
      }

      $(window).on('scroll', checkMedia);
        
    </script>

 
</body>

</html>