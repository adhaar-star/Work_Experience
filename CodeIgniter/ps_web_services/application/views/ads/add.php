<link href="<?php echo base_url() . 'assets/stylesheets/plugins/bootstrap_datepicker/bootstrap-datepicker.css'; ?>" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url() . 'assets/javascripts/plugins/bootstrap_datepicker/bootstrap-datepicker.js'; ?>" type="text/javascript"></script>

<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-film'></i>
                        <span><?php echo (isset($ad)) ? "Edit" : "Add"; ?> Ad</span>
                    </h1>
                    <div class='pull-right'>
                        <ul class='breadcrumb'>
                            <li>
                                <a href='<?php echo base_url()?>'>
                                    <i class='icon-bar-chart'></i>
                                </a>
                            </li>
                            <li class='separator'>
                                <i class='icon-angle-right'></i>
                            </li>
                              <li class='active'> <a href='<?php echo base_url().'index.php/ads/'?>'>Ad</a></li>
                            <li class='separator'>
                                <i class='icon-angle-right'></i>
                            </li>
                            <li class='active'><?php echo (isset($ad)) ? "Edit" : "Add"; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box'>
                    <div class='box-content'>
                        <?php
                        $action = (isset($ad)) ? base_url() . "index.php/ads/edit/" . $ad->ad_id : base_url() . "index.php/ads/add";
                        ?>
                        <form id="addform" class='form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
                            
                            <div class='form-group'>
                                <label class='control-label col-sm-4' for='url'> Ad URL<font color="red">*</font></label>
                                <div class='col-sm-4 controls'>
                                    <input class='form-control' data-rule-required='true' name='url' placeholder='Ad URL' type='text' value="<?php echo (isset($ad)) ? $ad->url : ""; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-4" for="is_active">Status<font color="red">*</font></label>
                                <div class="col-sm-4 controls">
                                    <input type="radio" id="is_active" data-rule-required="true" name="is_active" value="0" <?php
                                    if ((isset($ad))) {
                                        if ($ad->is_active == 0)
                                            echo 'checked="checked"';
                                        else
                                            echo '';
                                    }
                                    ?>>
                                    Active 
                                    &nbsp;&nbsp;
                                    <input type="radio" id="is_active" data-rule-required="true" name="is_active" value="1" 
                                    <?php
                                    if ((isset($ad))) {
                                        if ($ad->is_active == 1)
                                            echo 'checked="checked"';
                                        else
                                            echo '';
                                    }
                                    ?>
                                           >
                                    Inactive
                                </div>
                            </div>
                             <div class='form-group'>
                                <label class='control-label col-sm-4' for='image'>Ad Image</label>
                                <div class='col-sm-4 controls'>
                                    <?php if (isset($ad)) { ?>
                                        <input id="image" name="image" type="file" onchange="readURL(this)">
                                    <?php } else { ?>
                                        <input id="image" name="image" type="file" onchange="readURL(this)" data-rule-required='true'>
                                        <?php
                                    }
                                    ?>
                                    <div id="imgpreview" style="margin-top: 10px;">
                                        <?php
                                        if (isset($ad)) {
                                            if ($ad->image == '')
                                                echo "No Image";
                                            else
                                                echo "<img src='" .  AD_IMAGES . '/' . $ad->image . "' height='73px' width='73px'>";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            <div class='form-actions' style='margin-bottom:0'>
                                <div class='row'>
                                    <div class='col-sm-9 col-sm-offset-3'>
                                        <button class='btn btn-primary btn-submit' type='submit' name="save" value="Save">
                                            <i class='icon-save'></i>
                                            Save
                                        </button>            
                                        <input type="button" name="Button" class="btn btn-danger" value="Cancel" onclick="window.history.back()">
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

