<div class='col-xs-12'>
    <div class='row'>
        <div class='col-sm-12'>
            <div class='page-header'>
                <h1 class='pull-left'>
                    <i class='icon-eye-open'></i>
                    <span>View Skill Details</span>
                </h1>
                <div align="right">
                    <input type="button" name="Button" class="btn btn-danger" value="Back" onclick="window.history.back()" style="margin-top: 25px;">
                </div>
            </div>
        </div>
    </div>
    <div class='row'>
       <?php 
      
         if (isset($skill)) {
        if ($skill->img_icon != '') { ?>
            <div class='col-sm-3 col-lg-2'>
                <div class='box'>
                    <div class='box-content'>
                        <img class="img-responsive"  src="<?php echo ICON_IMAGES . '/' . $skill->img_icon; ?>" />
                    </div>
                </div>
            </div>
         <?php } }?>
        <div class='col-sm-9 col-lg-10'>
            <div class='box'>
                <div class='box-content box-double-padding'>
                    <fieldset>
                        <div class='col-sm-12'>
                            <div class='box bordered-box red-border'>
                                <div class='box-content box-no-padding'>
                                    <table class='table table-hover table-striped'>
                                        <tbody>
                                            <?php if (!empty($skill)) { ?>
                                                <tr>
                                                    <td><strong>Skill Name(English)</strong></td>
                                                    <td><?php echo $skill->skill_description_en; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Skill Name(Arabic)</strong></td>
                                                    <td><?php echo $skill->skill_description_ar; ?></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td><strong>Skill Name(Mandarin)</strong></td>
                                                    <td><?php echo $skill->skill_description_zh; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Skill Name(Spanish)</strong></td>
                                                    <td><?php echo $skill->skill_description_es; ?></td>
                                                </tr>
                                                 <tr>
                                                    <td><strong>Skill Name(French)</strong></td>
                                                    <td><?php echo $skill->skill_description_fr; ?></td>
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

