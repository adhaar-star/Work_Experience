<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-key'></i>
                        <span>Change Password</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="row">
                <div class="box">
                    <div class="box-header sea-blue-background">
                        <div class="title">Change Password</div>
                    </div>
                    <div class="box-content">
                        <form id="changePasswordform" class="form form-horizontal validate-form" action="<?php echo site_url('home/changePassword'); ?>" method="post">
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-sm-3" for="oldpassword">Old Password<font color="red">*</font></label>
                                <div class="col-sm-4 controls with-icon-over-input">
                                    <input class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password" type="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-3" for="password">New Password<font color="red">*</font></label>
                                <div class="col-sm-4 controls">
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Password">
                                    <div id="err"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-sm-3" for="confirmpassword">Confirm Password<font color="red">*</font></label>
                                <div class="col-sm-4 controls">
                                    <input class="form-control" id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm Password">
                                </div>
                            </div>

                            <div class="form-actions" style="margin-bottom:0">
                                <div class="row">
                                    <div class="col-sm-9 col-sm-offset-3">
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
<script src="<?php echo base_url() . 'assets/javascripts/jquery/jquery.validate.min.js'; ?>" type="text/javascript"></script>
<script>
    // Setup form validation on the #register-form element
    $("#changePasswordform").validate({
        // Specify the validation rules
        rules: {
            oldpassword: "required",
            password: {
                required: true,
                minlength: 5
            },
            confirmpassword: {
                required: true,
                equalTo: "#password",
            },
        },
        //Specify the validation error messages
        messages: {
            password: {
                minlength: "Your password must be at least 5 characters long"
            },
            confirmpassword: {
                equalTo: "Password does not match with confirm password field",
            },
        },
    });
</script>

