<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-edit'></i>
                        <span>Edit Profile</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="box">
                    <div class="box-header sea-blue-background">
                        <div class="title">Edit Profile</div>
                    </div>
                    <div class="box-content">
                        <form id="editUserform" class="form form-horizontal validate-form" action="<?php echo site_url('home/changeProfile'); ?>" method="post" enctype="multipart/form-data">
                             <div class="form-group">
                                <label class="control-label col-sm-4 col-sm-4" for="name">Name<font color="red">*</font></label>
                                <div class="col-sm-4 controls with-icon-over-input">
                                    <input class="form-control" id="name" name="name" data-rule-lettersonly="true" data-rule-required="true" placeholder="Name" type="text" value="<?php echo $name; ?>">
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-sm-4" for="email">Email<font color="red">*</font></label>
                                <div class="col-sm-4 controls">
                                    <input class="form-control" id="user_email" name="email" placeholder="Email" type="text" value="<?php echo $email; ?>" data-rule-email="true" data-rule-required="true">
                                </div>
                            </div>
                              <div class="form-group">
                                <label class="control-label col-sm-4" for="contact_num">Contact Number<font color="red">*</font></label>
                                <div class="col-sm-4 controls">
                                    <input class="form-control" id="contact_num" name="contact_num" placeholder="Contact Number" type="text" value="<?php echo $contact_num; ?>" data-rule-required="true" data-rule-phonenumber="true" data-rule-phonenumberlength>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="profile_image">Profile Image</label>
                                <div class="col-sm-4 controls">
                                    <input id="user_profile_image" name="profile_image" type="file" onchange="readURL(this);">
                                    <?php if(isset($profile_image) && $profile_image != ""){ ?>
                                    <div id="imgpreview"  style="<?php echo (isset($profile_image) && $profile_image != "" && file_exists('./' . PROFILE_IMAGES . '/' . $profile_image)) ? '' : 'display: none' ?> margin-top: 10px;">
                                        <img <?php echo (isset($profile_image) && $profile_image != "" && file_exists('./' . PROFILE_IMAGES . '/' . $profile_image)) ? "src='" . base_url() . PROFILE_IMAGES . '/' . $profile_image . "'" : "src=''" ?> height='60px' width='60px'/>
                                    </div>
                                <?php } ?>
                                </div>
                            </div>                          
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="address">Address<font color="red">*</font></label>
                                <div class="col-sm-4 controls">
                                    <textarea class="form-control" name="address" id="address" data-rule-required="true"><?php echo $address; ?></textarea>
                                  
                                </div>
                            </div>
                            
                            <div class="form-actions" style="margin-bottom:0">
                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-3">
                                        <button class="btn btn-primary" type="submit" name="save" value="Save">
                                            <i class="icon-save"></i>
                                            Save
                                        </button>
                                        <input type="button" name="Button" class="btn btn-danger" value="Cancel" onclick="location.href = '<?php echo site_url('home'); ?>'">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    /*To make left side bar menu link active*/
    var links = document.getElementsByClassName("leftSideLink");

    for (var i = 0; i < links.length; i++) {
        links[i].className = "leftSideLink";
    }
//    var d = document.getElementById("allUsers");
//    d.className = d.className + " active";
</script>
<!--<script src="<?php echo base_url() . 'assets/javascripts/jquery/jquery.validate.min.js'; ?>" type="text/javascript"></script>-->

