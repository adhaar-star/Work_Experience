<link href="<?php echo base_url() . 'assets/stylesheets/plugins/bootstrap_datepicker/bootstrap-datepicker.css'; ?>" media="all" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url() . 'assets/javascripts/plugins/bootstrap_datepicker/bootstrap-datepicker.js'; ?>" type="text/javascript"></script>

<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-list'></i>
                        <span><?php echo (isset($subcategory)) ? "Edit" : "Add"; ?> Subcategory To <?php echo $parent_name->skill_description_en ?></span>
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
                            <li class='active'> <a href='<?php echo base_url() . 'index.php/skills/' ?>'>Skills</a></li>
                            <li class='separator'>
                                <i class='icon-angle-right'></i>
                            </li>
                            <li class='active'><a href="<?php echo base_url() . 'index.php/skills/getcategories/' . $parent->skill_id ?>" >Categories</a></li>
                            <li class='separator'>
                                <i class='icon-angle-right'></i>
                            </li>
                            <li class='active'><a href="<?php echo base_url() . 'index.php/skills/getsubcategories/' . $parent_name->skill_id ?>" >Subcategories</a></li>
                            <li class='separator'>
                                <i class='icon-angle-right'></i>
                            </li>
                            <li class='active'><?php echo (isset($subcategory)) ? "Edit" : "Add"; ?></li>
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
                        $action = (isset($subcategory)) ? base_url() . "index.php/skills/editSubCategory/" . $parent_name->skill_id . "/" . $subcategory->skill_id : base_url() . "index.php/skills/addSubCategory/" . $parent_name->skill_id;
                        ?>
                        <form id="addform" class='form-horizontal validate-form' style='margin-bottom: 0;' action="<?php echo $action ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" value="<?php echo $parent_name->skill_id ?>" name="parent_id" />
                            <input type="hidden" value="<?php echo isset($subcategory) ? $subcategory->skill_id : '' ?>" name="id" />
                            <div class='form-group'>
                                <label class='control-label col-sm-4' for='skill_description_en'>Category Name<font color="red">*</font></label>
                                <div class='col-sm-4 controls'>
                                    <input class='form-control' data-rule-required='true' name='skill_description_en' placeholder='Skill Name (English)' type='text' value="<?php echo (isset($subcategory)) ? $subcategory->skill_description_en : ""; ?>">
                                </div>
                            </div>

                            <div class='form-group'>
                                <label class='control-label col-sm-4' for='skill_description_ar'> Category Name(Arabic)</label>
                                <div class='col-sm-4 controls'>
                                    <input class='form-control' data-rule-required='false' data-rule-arabic='true' name='skill_description_ar' placeholder='Skill Name (Arabic)' type='text' value="<?php echo (isset($subcategory)) ? $subcategory->skill_description_ar : ""; ?>">
                                </div>
                            </div>
							
                            <div class='form-group'>
                                <label class='control-label col-sm-4' for='skill_description_zh'> Category Name(Mandarin)</label>
                                <div class='col-sm-4 controls'>
                                    <input class='form-control' data-rule-required='false' name='skill_description_zh' placeholder='Skill Name (Mandarin)' type='text' value="<?php echo (isset($subcategory)) ? $subcategory->skill_description_zh : ""; ?>">
                                </div>
                            </div>
							
                            <div class='form-group'>
                                <label class='control-label col-sm-4' for='skill_description_es'> Category Name(Spanish)</label>
                                <div class='col-sm-4 controls'>
                                    <input class='form-control' data-rule-required='false' name='skill_description_es' placeholder='Skill Name (Spanish)' type='text' value="<?php echo (isset($subcategory)) ? $subcategory->skill_description_es : ""; ?>">
                                </div>
                            </div>
							
							 <div class='form-group'>
                                <label class='control-label col-sm-4' for='skill_description_fr'> Category Name(French)</label>
                                <div class='col-sm-4 controls'>
                                    <input class='form-control' data-rule-required='false' name='skill_description_fr' placeholder='Skill Name (French)' type='text' value="<?php echo (isset($subcategory)) ? $subcategory->skill_description_fr : ""; ?>">
                                </div>
                            </div>
							
                            <div class='form-group'>
                                <label class='control-label col-sm-4' for='image'>Profile Image</label>
                                <div class='col-sm-4 controls'>
                                    <?php if (isset($subcategory)) { ?>
                                        <input id="image" name="image" type="file" onchange="readURL(this)">
                                    <?php } else { ?>
                                        <input id="image" name="image" type="file" onchange="readURL(this)">
                                        <?php
                                    }
                                    ?>
                                    <div id="imgpreview" style="margin-top: 10px;">
                                        <?php
                                        if (isset($subcategory)) {
                                            if ($subcategory->img_icon == '')
                                                echo "No Image";
                                            else
                                                echo "<img src='" . ICON_IMAGES . '/' . $subcategory->img_icon . "' height='73px' width='73px'>";
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