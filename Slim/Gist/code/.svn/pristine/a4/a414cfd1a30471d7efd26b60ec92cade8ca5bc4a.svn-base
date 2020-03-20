<!DOCTYPE html>
<html lang="en">

<?php
include_once $this->getPart('/web/common/header.php');
    
$montharray = array('January','February','March','April','May','June','July','August','September','October','November','December');
$montharrayvalues = array('01','02','03','04','05','06','07','08','09','10','11','12');
?>
<body class="grey_bg">

     <div class="header_outer">
        <div class="header_inner">
            <div class="logo">
                <div class="back_icon">
                    <h1><a href="#" title="Gist">Gist</a></h1><span class="account_setting"><a href="#" title="Account Settings">Account Settings</a></span>
                </div>
            </div>

            <div class="menu_links">
                <ul>
                    <li> <a title="Help" class="btns" href="<?= $app['base_url']; ?>candidate/dashboard">Back to Recruiting</a> </li>
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

      <?php
include_once $this->getPart('/web/common/common_nav.php');
?>

    <div class="page_outer_section">
   
<div class="account_outer">
            <div class="account_inner">
   <button type="button" class="slide_toggle btn">Slide Toggle</button>
   
<div class="step_three_outer edit">
     <div class="edit_side">

                    <ul>
                        <li class="active">
                            <a href="#" title="Edit Profile">Edit Profile</a>
                        </li>
                         <li>
                            <a href="<?= $app['base_url']; ?>candidate/gist/edit" title="Edit Gist">Edit Gist</a>
                        </li>
                        <li>
                            <a href="#" title="Password">Password</a>
                        </li>
                        <li>
                            <a href="#" title="Billing">Billing</a>
                        </li>
                        <li>
                            <a href="#" title="Help">Help</a>
                        </li>
                    </ul>
                </div>

    <div class="register_form_inner">
        <div class="user_form">
            <form method="POST" id="candidateedit_form">

                <div class="fild_outer">
                    <label class="tittle_heading">Your Name *</label>
                    <div class="fild_inner">
                        <input autofocus="" class="form-control" value="<?php echo $candidatedetails['Name']; ?>" name="candidatename" placeholder="Enter your name" type="text">
                    </div>
                </div>


                <div class="fild_outer">
                    <label class="tittle_heading">Email *</label>
                    <div class="fild_inner">
                        <input class="form-control" placeholder="Your personal email" type="text" name="candidateemail" id="candidateemail" value="<?php echo $candidatedetails['Email']; ?>" disabled>
                    </div>
                </div>


                <div class="fild_outer">
                    <label class="tittle_heading">Experience *</label>
                    <div class="fild_inner">
                        <select class="selectpicker form-control initialexperience" name="candidateexperience[]" id="candidateexperience">
                        <option value="default">Your experience level</option>
                        <?php foreach($experiences as $key=>$value){
                        ?>
                <option value="<?php echo $value['Experience_Id'];  ?>" <?php echo($value['Experience_Id'] == $candidatedetails['experience'] ? 'selected' : '' ); ?> ><?php echo $value['Experience_level'];  ?></option>
                                <?php  
                                }
                        ?>
                        </select>                    
                    </div>
                </div>


                <div class="fild_outer">
                    <label class="tittle_heading">Primary Field *</label>
                    <div class="fild_inner">
                        <select class="selectpicker form-control" name="candidateexpertise[]">
                        <option value="default" selected>Your area of expertise</option>
                         <?php foreach($expertises as $key=>$value){
                        ?>
                <option value="<?php echo $value['expertise_id'];  ?>" <?php echo($value['expertise_id'] == $candidatedetails['expertise'] ? 'selected' : '' ); ?> ><?php echo $value['expertise_level'];  ?></option>
                                <?php  
                                }
                        ?>
                        </select>
                    </div>
                </div>


                <div class="fild_outer">
                    <label class="tittle_heading">URL *</label>
                    <div class="fild_inner">
                        <textarea class="form-control" placeholder="Paste your LinkedIn, GitHub, Stack Overflow or personal website URL" name="candidateurl"><?php echo $candidatedetails['url']; ?></textarea>
                    </div>
                </div>
                

              <!--Work Education  HTML start here-->    
                <div class="fild_outer work_exper_outer">
                    <label class="tittle_heading">Education * </label>
                    <?php  foreach($candidateeducationdetails as $educationkey=>$educationvalue){ ?>
                    <div class="experi_list_outer clone_education">
                        <div class="experience_list_outer">
                            <div class="left_filds latest_degree">
                                <div class="fild_inner">
                                    <select class="selectpicker form-control candidatedegree" name="candidatedegree[]" id="candidatedegree-<?php echo $educationkey; ?>">
                                        <option value="default" selected>Latest degree</option>
                                         <?php foreach($degrees as $key=>$value){
                        ?>
                <option value="<?php echo $value['degree_id'];  ?>"  <?php echo($value['degree_id'] == $educationvalue['degree_id'] ? 'selected' : '' ); ?>><?php echo $value['Degree'];  ?></option>
                                <?php  
                                }
                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="right_filds fild_of_study">
                                <div class="fild_inner">
                                     <select class="selectpicker form-control candidatestudyfield" name="candidatestudyfields[]" id="candidatestudyfield-<?php echo $educationkey; ?>">
                                       <option value="default">Field of Study</option>
                                         <?php foreach($studyfields as $key=>$value){
                        ?>
                <option value="<?php echo $value['study_field_id'];  ?>" <?php echo($value['study_field_id'] == $educationvalue['study_field_id'] ? 'selected' : '' ); ?>><?php echo $value['study_field'];  ?></option>
                                <?php  
                                }
                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="experience_list_outer">
                            <div class="left_filds college">
                                <div class="fild_inner">
                                    <select class="selectpicker form-control candidatecollege" name="candidatecollege[]" id="candidatecollege-<?php echo $educationkey; ?>">
                                        <option value="default" selected>College</option>
                                        <?php foreach($colleges as $key=>$value){
                        ?>
                <option value="<?php echo $value['college_id'];  ?>"  <?php echo($value['college_id'] == $educationvalue['college_id'] ? 'selected' : '' ); ?>><?php echo $value['college'];  ?></option>
                                <?php  
                                }
                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="right_filds grand_year">
                                <div class="fild_inner">
                                    <select class="selectpicker form-control candidategradyear" name="candidategradyear[]" id="candidategradyear-<?php echo $educationkey; ?>">
                                        <option value="default">Grad year</option>
                                       <?php  for($gradyear=2018;$gradyear>1958;$gradyear--) {?>
                                        <option value="<?php echo $gradyear;?>" <?php echo($gradyear == $educationvalue['grad_year'] ? 'selected' : '' ); ?>><?php echo $gradyear;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="add_remove_outer add_education">
                            <div class="add_btn add_education_button"><a href="#" title="Remove"><span class="check_btn"><img src="<?= $app['base_assets_url']; ?>images/plus-icon.png" alt="Add another"></span><span class="btn_name">Add another</span></a></div>
                        </div>
                        <input type="hidden" name="candidate_education_id[]" value="<?php echo $educationvalue['candidate_education_id']; ?>" class="candidate_education_id">
                    </div>
                     <?php  }?>

              
                </div>
               <!--Work Education  HTML end here-->    
                
                
                

           <!--Work Experience  HTML start here-->  
                <div class="fild_outer work_exc_form work_exper_outer">
                    <label class="tittle_heading">Work Experience * </label>
                    <?php  foreach($candidatejobdetails as $jobkey=>$jobvalue){ ?>
                    <div class="experi_list_outer clone_experience">
                        <div class="experience_list_outer">
                            <div class="left_filds">
                                <div class="fild_inner">
                                  <input class="form-control candidatecompany" placeholder="Company" type="text" name="candidatecompany[]" value="<?php echo $jobvalue['company']; ?>" id="candidatecompany-<?php echo $jobkey;?>">
                                </div>
                            </div>
                            <div class="right_filds">
                                <div class="fild_inner">
                                    <input class="form-control candidatecompanytitle" placeholder="Your title at this company" type="text" name="candidatecompanytitle[]" value="<?php echo $jobvalue['job_title']; ?>" id="candidatecompanytitle-<?php echo $jobkey;?>">
                                </div>
                            </div>
                        </div>
                          <div class="experience_list_outer start_end_yr">
                                <div class="left_filds">
                                  <div class="fild_inner">
                                    <select class="selectpicker form-control candidatestartmonth" name="candidatestartmonth[]" id="candidatestartmonth-<?php echo $jobkey;?>">
                                      <option value="default">Started MM</option><<?php  for($i=0;$i<count($montharray);$i++) {?>
                                        <option value="<?php echo $montharrayvalues[$i];?>" <?php echo($montharrayvalues[$i] == $jobvalue['start_month'] ? 'selected' : '' ); ?>><?php echo $montharray[$i];?></option>
                                        <?php }?>
                                    </select>
                                  </div>
                                  <div class="fild_inner">
                                    <select class="selectpicker form-control candidatestartyear" name="candidatestartyear[]" id="candidatestartyear-<?php echo $jobkey;?>">
                                      <option value="default">Started YY</option>     <?php  for($gradyear=2018;$gradyear>1958;$gradyear--) {?>
                                        <option value="<?php echo $gradyear;?>" <?php echo($gradyear == $jobvalue['start_year'] ? 'selected' : '' ); ?>><?php echo $gradyear;?></option>
                                        <?php }?>
                                    </select>
                                  </div>
                                </div>
                              <div class="right_filds" <?php echo("nomonth" == $jobvalue['end_month'] && $jobkey==0 ? 'style = "display:none;"' : 'style = "display:inline-block;"' ); ?> >
                                  <div class="fild_inner">
                                    <select class="selectpicker form-control candidateendmonth" name="candidateendmonth[<?php echo $jobkey;?>]" id="candidateendmonth-<?php echo $jobkey;?>">
                                      <option value="default">Ended MM</option>
                                      <?php  for($i=0;$i<count($montharray);$i++) {?>
                                        <option value="<?php echo $montharrayvalues[$i];?>" <?php echo($montharrayvalues[$i] == $jobvalue['end_month'] ? 'selected' : '' ); ?>><?php echo $montharray[$i];?></option>
                                        <?php }?>

                                    </select>
                                  </div>
                                  <div class="fild_inner">
                                    <select class="selectpicker form-control candidateendyear" name="candidateendyear[<?php echo $jobkey;?>]" id="candidateendyear-<?php echo $jobkey;?>">
                                      <option value="default">Ended YY</option>               <?php  for($gradyear=2018;$gradyear>1958;$gradyear--) {?>
                                        <option value="<?php echo $gradyear;?>" <?php echo($gradyear == $jobvalue['end_year'] ? 'selected' : '' ); ?>><?php echo $gradyear;?></option>
                                        <?php }?>
                                    </select>
                                  </div>
                                </div>
                                <?php  if($jobkey==0){?> 
                                <div class="currently_working">
                                    <p><label class="check_boxes"><input type="checkbox" name="is_currently_working[]" <?php echo("nomonth" == $jobvalue['end_month'] ? 'checked' : '' ); ?> >
                                    <span class="checkmark"></span></label><span class="label_name">I currently work here</span></p>
                                 </div>
                                 <?php  }?>
                            </div>

                        <div class="add_remove_outer add_work_experience">
                            <div class="add_btn add_work_experience_button"><a href="#" title="Remove"><span class="check_btn"><img src="<?= $app['base_assets_url']; ?>images/plus-icon.png" alt="Add another"></span><span class="btn_name">Add another</span></a></div>
                        </div>
                                       <input type="hidden" name="candidate_job_id[]" value="<?php echo $jobvalue['candidate_job_id']; ?>" class="candidate_job_id">
                    </div>

                       <?php  }?>

                      
                </div>
             <!--Work Experience  HTML end here-->  
                
                
                <div class="fild_outer">
                    <label class="tittle_heading">Blocked List</label>
                    <div class="fild_inner">
                        <textarea class="form-control" placeholder="List any companies you want to block from seeing your information" name="candidateblockedlist"><?php echo($candidatedetails['blocked'] == "" ? '' : $candidatedetails['blocked'] ); ?></textarea>
                    </div>
                </div>
                
                
               <!--Location  HTML start here-->               
                  <div class="fild_outer specialties_check">
                    <div class="type_head">
                        <label class="tittle_heading">Location *</label>
                        <p><span>Where are you open to working? Select up to three locations</span></p>
                    </div>
                    <div class="specialties_check_outer">
                        <?php  $count = count($locations);
                               foreach($locations as $key=>$value) { 
                            if ($key % 2 == 0) {    
                           ?>
                        <div class="specialties_check_list  search_box">
                        <?php } ?>
                            <div <?php echo($key % 2 == 0 ? 'class="left_side"' : 'class="right_side"' ); ?>>
                                <div class="experience_type">
                                    <p  <?php echo($value['location']=="" ? 'class="check_box_here"' : '' ); ?>><label class="check_boxes"><input type="checkbox"  name="candidatelocation[]" value="<?php echo $value['location_id'];?>" <?php echo($value['location']=="" ? 'class="extralocations"' : '' );?> <?php echo (in_array($value['location'],$candidatelocationdetails) ? 'checked' : '' );?> > <span class="checkmark"</span></label><?php if($value['location']!=""){ ?><span class="label_name"><?php echo $value['location'];?></span><?php }?></p>
                                    <?php   if($value['location']==""){  ?>
                                    <div class="fild_inner">
                                        <input  class="form-control extralocationvalue" type="text" name="candidatelocationvalue[<?php  echo $key;?>]"
                                        id="left<?php  echo $key;?>">
                                    </div>
                                      <input type="hidden" name="candidate_location_id[]" value="" class="candidate_location_id">
                                    <?php }else{                                     
                                        ?>
                                     <input type="hidden" name="candidate_location_id[]" value="<?php echo $locations[$key]['location_id']; ?>" class="candidate_location_id">
                               <?php }?>
                                </div>
                            </div>
                                  <?php   if ($key % 2 != 0 && $key > 0) { ?>                          
                            </div>
                         <?php  }
                          }?>
                                            
                    </div>
                </div>
                <!--Location  HTML end here-->
                
                
                  <!--Skill Tags   HTML start here-->               
                  <div class="fild_outer skill_outer specialties_check">
                    <div class="type_head">
                        <label class="tittle_heading">Skill Tags *</label>
                        <p><span>List five of your core skills that are relevant to the job you’re pursuing. A skill<br>
                        is an ability to do something that requires training and experience like HTML, <br>
                        Copywriting, Statistical Analysis, Enterprise Sales, Big Data, etc. Do not list <br>
                        personality traits like hardworking, sociable, motivated, etc.</span></p>
                    </div>
                    <div class="specialties_check_outer">
            
                        
                        <?php  for($i=0;$i<5;$i++){                             
                         ?>
                         <div class="specialties_check_list search_box">
                            <div class="left_side">
                                <div class="experience_type">
                                    <p class="check_box_here"><label class="check_boxes"><input type="checkbox"  name="candidateskills[]" class="candidateskills" <?php echo(array_key_exists($i,$candidateskilldetails) ? 'checked' : '' );?> ><span class="checkmark"></span></label></p>
                                    <div class="fild_inner inner_input">
                                        <input class="form-control candidateskillvaluelist" type="text" name="candidateskillvalue[<?php echo $i;?>]" id="candidateskillvalue-<?php echo $i;?>" <?php echo(array_key_exists($i,$candidateskilldetails) ? 'value = '.$candidateskilldetails[$i]["skill"] : '' );?>>
                                    </div>
                                </div>
                            </div>
                            <div  <?php echo(array_key_exists($i,$candidateskilldetails) ? 'class="select_experience edit_experience"' : 'class="select_experience"' );?> >
                               <div class="fild_inner">
                                    <select class="selectpicker form-control candidateskillexperience" name="candidateskillexperience[<?php echo $i;?>]" id="candidateskillexperience-<?php echo $i;?>" >
                                        <option value="default" >Experience</option>
                                           <?php foreach($masterskilllevels as $key=>$value){
                        ?>
                        <option value="<?php echo $value['master_skill_level_id'];  ?>" <?php echo(array_key_exists($i,$candidateskilldetails) && $candidateskilldetails[$i]['experience_Id'] == $value['master_skill_level_id'] ? 'selected' : ''); ?>><?php echo $value['master_skill_level'];  ?></option>
                                <?php  
                                }
                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <?php }?>
                          
                        
                    </div>
                </div>
                <!--Skill Tags  HTML end here-->
                
            <div class="fild_outer">
                <label class="tittle_heading">Password *</label>
                <div class="fild_inner">
                    <input class="form-control" placeholder="Create a password " type="text" name="candidatepassword" value="<?php echo $candidatedetails['Password']; ?>" disabled>
                </div>
            </div>
          <div class="apply_now submit_employers"><button class="submit_btn btn" title="Complete">Complete</button></div>
         <div class="click_complete"><p>By clicking “Complete” you’re indicating that you have read and agree to our Terms of Service</p></div>
       </form>
      </div>
   </div>

</div>
 </div>
    </div>
 
        </div>
    
   <!-- <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>-->
           <?php
include_once $this->getPart('/web/common/footer.php');
?>
<script>
 window.addEventListener("beforeunload", function(event) {
       event.returnValue = "All page data will be lost.Are you sure?";
      });
</script>
</body>
</html>