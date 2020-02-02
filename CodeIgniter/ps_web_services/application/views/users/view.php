<div class='col-xs-12'>
    <div class='row'>
        <div class='col-sm-12'>
            <div class='page-header'>
                <h1 class='pull-left'>
                    <i class='icon-eye-open'></i>
                    <span>View Users bank Account Details</span>
                </h1>
                <div align="right">
                    <input type="button" name="Button" class="btn btn-danger" value="Back" onclick="window.history.back()" style="margin-top: 25px;">
                </div>
            </div>
        </div>
    </div>
    <div class='row'>
        <?php
//        echo 
//        ICON_IMAGES . '/' . $skill->img_icon;
        if (isset($user)) {
            if ($user->profile_pic != '') {
                ?>
                <div class='col-sm-3 col-lg-2'>
                    <div class='box'>
                        <div class='box-content'>
                            <img class="img-responsive"  src="<?php echo USER_IMAGES . '/' . $user->profile_pic; ?>" />
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <?php if ($user->cover_pic != '') { ?>
            <div class='col-sm-3 col-lg-2'>
                <div class='box'>
                    <div class='box-content'>
                        <img class="img-responsive"  src="<?php echo COVER_IMAGES . '/' . $user->cover_pic; ?>" />
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class='col-sm-9 col-lg-10'>
            <div class='box'>
                <div class='box-content box-double-padding'>
                    <fieldset>
                        <div class='col-sm-12'>
                            <div class='box bordered-box red-border'>
                                <div class='box-content box-no-padding'>
                                    <table class='table table-hover table-striped'>
                                        <tbody>
                                            <?php if (!empty($user)) { ?>
                                                <tr>
                                                    <td><strong>User Name</strong></td>
                                                    <td><?php echo $user->user_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email</strong></td>
                                                    <td><?php echo $user->email; ?></td>
                                                </tr> 
                                                <tr>
                                                    <td><strong>Facebook Id</strong></td>
                                                    <td><?php                                                        
                                                            echo $user->facebook_id;                                                        
                                                        ?>
                                                    </td>
                                                </tr> 
                                                <tr>
                                                    <td><strong>Twitter Id</strong></td>
                                                    <td><?php echo $user->twitter_id; ?></td>
                                                </tr> 
                                                <tr>
                                                    <td><strong>First Name</strong></td>
                                                    <td><?php echo $user->first_name; ?></td>
                                                </tr> 
                                                <tr>
                                                    <td><strong>Last Name</strong></td>
                                                    <td><?php echo $user->last_name; ?></td>
                                                </tr> 
                                                <tr>
                                                    <td><strong>Gender</strong></td>
                                                    <td><?php if($user->gender==1){
														echo "Male";
														}else{
														echo "Female";
														} ?></td>
                                                </tr> 
                                                <tr>
                                                    <td><strong>Date Of Birth</strong></td>
                                                    <td><?php 
                                                    if($user->dob != '0000-00-00')
                                                    echo $user->dob; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Phone</strong></td>
                                                    <td><?php echo $user->phone; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Location</strong></td>
                                                    <td><?php echo $user->location; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Latitude</strong></td>
                                                    <td><?php echo $user->latitude; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Longitude</strong></td>
                                                    <td><?php echo $user->longitude; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>College Name</strong></td>
                                                    <td><?php echo $user->college_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Major</strong></td>
                                                    <td><?php echo $user->major; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Degree</strong></td>
                                                    <td><?php echo $user->degree; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Experience</strong></td>
                                                    <td><?php echo $user->experience; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Education Level</strong></td>
                                                    <td><?php echo $user->education_level; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Class</strong></td>
                                                    <td><?php echo $user->class; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>School Name</strong></td>
                                                    <td><?php echo $user->school_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Average Ratings</strong></td>
                                                    <td><?php echo $user->average_ratings; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Hourly Rate</strong></td>
                                                    <td><?php echo $user->hourly_rate; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Year Attained</strong></td>
                                                    <td><?php echo $user->year_attained; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Is Verified</strong></td>
                                                    <td><?php 
                                                    if($user->is_verified == 1){
                                                        echo 'Verified';
                                                    }else{
                                                        echo 'Not Verified';
                                                        
                                                    }
                                                    ?></td>
                                                </tr>

                                                <?php
                                            } else {
                                                echo "<tr><td colspan=2><br/><br/>No Data</td></tr>";
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</div>

