<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-globe'></i>
                      <span><?php echo (isset($country)) ? "Edit" : "Add"; ?> Country</span>
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
                              <li class='active'> <a href='<?php echo base_url().'index.php/countries/'?>'>Countries</a></li>
                            <li class='separator'>
                                <i class='icon-angle-right'></i>
                            </li>
                            <li class='active'><?php echo (isset($country)) ? "Edit" : "Add"; ?></li>
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
                        $action = (isset($country)) ? base_url() . "index.php/countries/edit/" . $country->country_id  : base_url() . "index.php/countries/add";
                        ?>
                        <form id="addform" class='form form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo $action ?>" method="post">
                            
                            
                            <div class='form-group'>
                                <label class='control-label col-sm-4' for='name'>Country Name<font color="red">*</font></label>
                                <div class='col-sm-4 controls'>
                                    <input class='form-control' data-rule-required='true' data-rule-letterswithspace="true" id='name' name='name' placeholder='Country Name' type='text' value="<?php echo (isset($country)) ? $country->name : ""; ?>">
                                </div>
                            </div>
                            
                            
                            <div class='form-actions' style='margin-bottom:0'>
                                <div class='row'>
                                    <div class='col-sm-9 col-sm-offset-4'>
                                        <button class='btn btn-primary btn-submit' type='submit'>
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