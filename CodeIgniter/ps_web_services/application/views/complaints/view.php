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
//         if (isset($skill)) {
//        if ($skill->img_icon != '' && file_exists(ICON_IMAGES . '/' . $skill->img_icon)) { ?>
<!--            <div class='col-sm-3 col-lg-2'>
                <div class='box'>
                    <div class='box-content'>
                        <img class="img-responsive"  src="<?php echo ICON_IMAGES . '/' . $skill->img_icon; ?>" />
                    </div>
                </div>
            </div>-->
         <?php //} }?>
        <div class='col-sm-9 col-lg-12'>
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
                                                    <td><strong>Bank Name</strong></td>
                                                    <td><?php echo $user->name; ?></td>
                                                </tr>
                                                 <tr>
                                                    <td><strong>User Name</strong></td>
                                                    <td><?php echo $user->user_name; ?></td>
                                                </tr> <tr>
                                                    <td><strong>Type</strong></td>
                                                    <td><?php 
                                                    if($user->type == 1){
                                                        echo 'Local';
                                                    }else{
                                                        echo 'International';
                                                    }
                                                    ?></td>
                                                </tr> 
                                                <tr>
                                                    <td><strong>Branch Name</strong></td>
                                                    <td><?php echo $user->branch; ?></td>
                                                </tr> 
                                                <tr>
                                                    <td><strong>Country Name</strong></td>
                                                    <td><?php echo $user->country; ?></td>
                                                </tr> 
                                                <tr>
                                                    <td><strong>Beneficiary Account</strong></td>
                                                    <td><?php echo $user->beneficiary_account; ?></td>
                                                </tr> 
                                                <tr>
                                                    <td><strong>Beneficiary Name</strong></td>
                                                    <td><?php echo $user->beneficiary_name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Beneficiary Nickname</strong></td>
                                                    <td><?php echo $user->beneficiary_nickname; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Beneficiary Address</strong></td>
                                                    <td><?php echo $user->beneficiary_address; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Beneficiary Phone</strong></td>
                                                    <td><?php echo $user->beneficiary_phone; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Beneficiary Description</strong></td>
                                                    <td><?php echo $user->beneficiary_description; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Beneficiary Currency</strong></td>
                                                    <td><?php echo $user->beneficiary_currency; ?></td>
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

