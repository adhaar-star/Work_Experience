<div class='col-xs-12'>
    <div class='row'>
        <div class='col-sm-12'>
            <div class='page-header'>
                <h1 class='pull-left'>
                    <i class='icon-eye-open'></i>
                    <span>View Ad Details</span>
                </h1>
                <div align="right">
                    <input type="button" name="Button" class="btn btn-danger" value="Back" onclick="window.history.back()" style="margin-top: 25px;">
                </div>
            </div>
        </div>
    </div>
    <div class='row'>
        <?php if ($ad->image != '') { ?>
            <div class='col-sm-12 col-lg-12'>
                <div class='box'>
                    <div class='box-content'>
                        <img class="img-responsive"  src="<?php echo AD_IMAGES . '/' . $ad->image; ?>" />
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class='class='col-sm-12 col-lg-12'>
            <div class='box'>
                <div class='box-content box-double-padding'>
                    <fieldset>
                        <div class='col-sm-12'>
                            <div class='box bordered-box red-border'>
                                <div class='box-content box-no-padding'>
                                    <table class='table table-hover table-striped'>
                                        <tbody>
                                            <?php if (!empty($ad)) { ?>
                                                <tr>
                                                    <td><strong>AD URL</strong></td>
                                                    <td><?php echo $ad->url; ?></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Status</strong></td>
                                                    <td><?php
                                                        if ($row->is_active == 1) {
                                                            echo "Deactive";
                                                        } else {
                                                            echo "Active";
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

