<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Resume</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">
    <link href="fonts/fonts.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="favicon.png" />

<style>
html,body{ height: 100%;color: #121212;font-family: 'Avenir Roman';}
.coman_outer{width: 100%;float: left;}    
.haeder {margin-bottom: 20px;}    
.resume_outer{text-align: center;}   
.resume_inner {padding: 40px;width: 100%;max-width: 750px;display: inline-block;box-sizing: border-box;text-align: left;}    
.left_side {width: 350px;float: left;}
.right_side {width: 250px;float: right;}    
.profile_email p span { width: 100%;display: inline-block;}  
.list_outer {margin-top: 60px;}   
.inner_list p span{color: #9d9d9d;}   
.inner_list { margin-bottom: 20px;}
.inner_list:last-child{margin: 0;} 
.title {width: 150px;display: inline-block;}    
.name{font-size: 18px;font-family: 'Avenir Heavy';}
.title_name{margin: 0 0 20px; color:#212121;font-size: 15px;line-height:23px;border-bottom: 2px solid #c2c2c2;padding-bottom: 2px;font-family: 'Avenir Heavy';letter-spacing: 2px;}
.position {font-size: 16px;margin: 0 0 3px;}
.experience{margin: 0;font-size: 16px;color: #9d9d9d;font-family: 'Avenir Roman';}    
p{font-size: 13px; color: #212121;margin: 0;}
.title {width: 150px;display: inline-block;}
.content{color: #9d9d9d;}
.list_outer.coman_outer.last_list {margin: 0;}    
.right_list p {margin-bottom: 7px;}   
</style>
</head>

<body>

<div class="resume_outer coman_outer">
    <div class="resume_inner">
        
        
        
        
        <div class="haeder coman_outer">
            <div class="left_side profile_name">
                <p class="name"><?php echo $candidatedetails['Name']; ?></p>
                <p class="position"><?php echo $candidateLatestJobdetails['job_title']; ?></p>
                <p class="experience"><?php echo $candidatedetails['Experience_level']; ?></p>
            </div>
            <div class="right_side profile_email">
                <p>
                    <span><?php echo $candidatedetails['Email']; ?></span><br>
                    <span><a href="<?php echo $candidatedetails['profile_link']; ?>"><?php echo $candidatedetails['profile_link']; ?></span></a><br>
                    <?php  foreach($candidateLocationDetails as $key => $value){ ?>
                    <span><?php echo $value; ?></span><br>
                    <?php } ?>
                </p>
            </div>
        </div>

        
        
        
        <div class="list_outer coman_outer">
            
            <div class="left_side">
                <p class="title_name">SUMMARY</p>
                <p>Hello, I'm  <?php echo $candidatedetails['Name']; ?><?php if($candidatedetails['Experience_level']!="Student") { ?> , a  <?php echo $candidateLatestJobdetails['job_title']; ?> in <?php echo $candidateLocationDetails[0]; ?> with <?php echo $candidatedetails['Experience_level']; } ?> <?php if($candidateLatestEducationdetails['Degree'] == "Student"){ echo ".I am a Student in";} else if($candidateLatestEducationdetails['Degree'] == "Bacholers"){ echo ".I have a Bacholer's Degree in";} else if($candidateLatestEducationdetails['Degree'] == "Masters"){ echo ".I have a Master's Degree in";} else { echo ".I have a PhD Degree in"; } echo "in ".$candidateLatestEducationdetails['study_field']. " from the ".$candidateLatestEducationdetails['college'] ; echo "My core skills include ".$skills_string; ?>    

                </p>
            </div>
            
            <div class="right_side">
                <p class="title_name">SKILLS</p>
             <div class="right_list coman_outer">
             <?php foreach($candidateSkillDetails as $key=>$value) { ?>
                <p><span class="title"><?php echo $value['skill'];?></span><span class="content" style="margin-left:20px;"><?php echo $value['master_skill_level'];?></span></p>
                <?php }?>
             </div>
            </div>
            
        </div>
        
        
        

        <div class="list_outer coman_outer">
            
            <div class="left_side">
                <p class="title_name">EXPERIENCE</p>
                <?php foreach($candidateAllJobdetails as $key=>$value){?>
                <div class="inner_list coman_outer">
                    <p><?php echo $value['job_title'];?></p>
                    <p><?php echo $value['company'];?></p>
                    <p><span><?php echo $value['start_month']."/".$value['start_year']; ?> - <?php echo( $value['end_month']=="nomonth" ? "Present": $value['end_month']."/".$value['end_year']);?></span></p>
                </div>
                <?php } ?>               
                
            </div>
            

            <div class="right_side">
                <p class="title_name">Meet Me</p>
              <div class="right_list coman_outer">
              <?php  $question = str_replace("— ","",$candidatedetails['question']);?>
                <p>Watch my thirty second Gist,a short video of me replying to the question,"<?php echo $question; ?>"</p>
               <p><span><a href="<?php echo $candidatedetails['profile_link']; ?>"><?php echo $candidatedetails['profile_link']; ?></a></span></p>
            </div>
            </div>
            
        </div>
        
        
        
        <div class="list_outer coman_outer last_list">
            <div class="left_side">
                <p class="title_name">EDUCATION</p>
            <?php foreach($candidateAllEducationdetails as $key=>$value){?>
                <div class="inner_list">
                    <p><?php echo $value['college'];?></p>
                    <p><?php echo $value['Degree'];?>,<?php echo $value['study_field'];?></p>
                    <p><span><?php echo $value['grad_year'];?></span></p>
                </div>
                <?php }?>
            </div>
        </div>
        
        
        
        
        
    </div>
</div>


</body>

</html>