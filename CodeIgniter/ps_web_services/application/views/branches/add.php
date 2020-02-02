<link href="<?php echo base_url() . 'assets/stylesheets/plugins/bootstrap_datepicker/bootstrap-datepicker.css'; ?>" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url() . 'assets/javascripts/plugins/bootstrap_datepicker/bootstrap-datepicker.js'; ?>" type="text/javascript"></script>

<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-sitemap'></i>
                        <span><?php echo (isset($branch)) ? "Edit" : "Add"; ?> Branch</span>
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
                            <li class='active'> <a href='<?php echo base_url() . 'index.php/branches/' ?>'>Branches</a></li>
                            <li class='separator'>
                                <i class='icon-angle-right'></i>
                            </li>
                            <li class='active'><?php echo (isset($branch)) ? "Edit" : "Add"; ?></li>
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
                        $action = (isset($branch)) ? base_url() . "index.php/branches/edit/" . $branch->branch_id : base_url() . "index.php/branches/add";
                        ?>
                        <form id="addform" class='form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo $action ?>" method="post" enctype="multipart/form-data">

                            <div class="form-group">
                                <label class='control-label col-sm-4' for='name'> Bank<font color="red">*</font></label>
                                 <div class='col-sm-4'>
                                <select class="form-control" name="bank_id" id="bank_id">
                                    <option value=''>Select Bank</option>
                                    <?php
                                    foreach ($banks as $row) {
                                                if ($branch->bank_id == $row->bank_id)
                                                    echo "<option value='" . $row->bank_id . "' selected>" . $row->name . "</option>";
                                                else
                                                    echo "<option value='" . $row->bank_id . "' >" . $row->name . "</option>";//                                                
                                            }
                                    ?>
                                </select>
                                 </div>
                            </div>
                            <div class='form-group'>
                                <label class='control-label col-sm-4' for='name'> Branch Name<font color="red">*</font></label>
                                <div class='col-sm-4 controls'>
                                    <input class='form-control' data-rule-required='true' name='name' placeholder='Branch Name' type='text' value="<?php echo (isset($branch)) ? $branch->name : ""; ?>">
                                </div>
                            </div>                   
							
                             <div class='form-group'>
                                <label class='control-label col-sm-4' for='name'> Branch Name(French)</label>
                                <div class='col-sm-4 controls'>
                                    <input class='form-control' data-rule-required='true' name='frenchname' placeholder='Branch Name(French)' type='text' value="<?php echo (isset($branch)) ? $branch->french_name : ""; ?>">
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

