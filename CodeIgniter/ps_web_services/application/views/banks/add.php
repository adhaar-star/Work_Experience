<link href="<?php echo base_url() . 'assets/stylesheets/plugins/bootstrap_datepicker/bootstrap-datepicker.css'; ?>" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url() . 'assets/javascripts/plugins/bootstrap_datepicker/bootstrap-datepicker.js'; ?>" type="text/javascript"></script>

<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-money'></i>
                        <span><?php echo (isset($bank)) ? "Edit" : "Add"; ?> Bank</span>
                    </h1>
                    <div class='pull-right'>
                        <ul class='breadcrumb'>
                            <li>
                                <a href='<?php echo base_url() ?>'>
                                    <i class='icon-bar-chart'></i>
                                </a>
                            </li>
                            <li class='separator'>
                                <i class='icon-angle-right'></i>
                            </li>
                            <li class='active'> <a href='<?php echo base_url() . 'index.php/banks/' ?>'>Banks</a></li>
                            <li class='separator'>
                                <i class='icon-angle-right'></i>
                            </li>
                            <li class='active'><?php echo (isset($bank)) ? "Edit" : "Add"; ?></li>
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
                        $action = (isset($bank)) ? base_url() . "index.php/banks/edit/" . $bank->bank_id : base_url() . "index.php/banks/add";
                        ?>
                        <form id="addform" class='form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo $action ?>" method="post" enctype="multipart/form-data">

                           
                            
                            <div class="form-group">
                                <label class='control-label col-sm-4' for='name'> Country<font color="red">*</font></label>
                                 <div class='col-sm-4'>
                                <select class="form-control" name="country_id" id="country_id">
                                    <option value=''>Select Country</option>
                                    <?php
                                    foreach ($countries as $row) {
                                                if ($bank->country_id == $row->country_id)
                                                    echo "<option value='" . $row->country_id . "' selected>" . $row->name . "</option>";
                                                else
                                                    echo "<option value='" . $row->country_id . "' >" . $row->name . "</option>";//                                                
                                            }
                                    ?>
                                </select>
                                 </div>
                            </div>
                            <div class='form-group'>
                                <label class='control-label col-sm-4' for='name'> Bank Name<font color="red">*</font></label>
                                <div class='col-sm-4 controls'>
                                    <input class='form-control' data-rule-required='true' name='name' placeholder='Bank Name' type='text' value="<?php echo (isset($bank)) ? $bank->name : ""; ?>">
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

