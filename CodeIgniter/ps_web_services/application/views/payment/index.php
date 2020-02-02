<?php
$queryString = '';
$suffixUrl = '';
if ($this->input->get('keyword'))
    $queryString = "?keyword=" . $this->input->get('keyword');
if ($this->input->get('perpage')) {
    if ($queryString != '')
        $suffixUrl = $queryString . "&perpage=" . $this->input->get('perpage');
    else
        $suffixUrl = "?perpage=" . $this->input->get('perpage');
}else {
    $suffixUrl = $queryString;
}
?>
<?php
$segment = $this->uri->segment(3);
$startId = 0;
$endId = 0;

if ($segment == "") {
    $sr = 1;
} else {
    $sr = $segment + 1;
}
if ($payments) {
    $cnt = count($payments);
    $startId = $payments[0]->payment_id;
    $endId = $payments[$cnt - 1]->payment_id;
}
?>
<style>
    .alert-success1 {
        background-color: #dff0d8;
        border-color: #d6e9c6;
        color: #468847;
    }
    .alert-dismissable1 {
        padding-right: 35px;
    }
    .alert1 {
        border: 1px solid transparent;
        border-radius: 4px;
        margin-bottom: 20px;
        padding: 15px;
    }
</style>
<div class="alert1 alert-success1 alert-dismissable1" id="success_msg" style="display: none;">
    <a class="close" href="#" data-dismiss="alert"> × </a>
</div>
<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-money'></i>
                        <?php if(empty($this->input->get('type'))){ ?>
                            
                        <span>All Payments</span>
                     <?php   } else if($this->input->get('type') == 1){?>
                        <span>Payment Requested from Freelancer</span>
                     <?php   } else if($this->input->get('type') == 2){?>
                        <span>Release Requested from Employer</span>
                     <?php   } else if($this->input->get('type') == 3){?>
                        <span>Paid Payments</span>
                     <?php } ?>
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
                            <li class='active'>Payments</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-5 col-xs-12'>
<!--                <input class="btn btn-primary" onclick="window.location = '<?php echo base_url() ?>index.php/banks/add'"  type="button" value="Add New Bank" style="margin-bottom:5px">
                <input class="btn btn-warning delete_All" type="button" value="Delete Selected" style="margin-bottom:5px" disabled="disabled">-->
                <input class="btn btn-success" type="button" value="Back" style="margin-bottom:5px" onclick="window.history.back()">
            </div>
            <div class="col-md-7 pull-right tabmt10">
                <div class="row">
                    <form action="<?php echo site_url('payment'); ?>" method="get" id="filter_search">
                        <div class="col-md-7 col-xs-6">
                            <select name="type" class="form-control select2" name="type" id="type" onchange="document.getElementById('filter_search').submit();">

                                <?php
                                $type = 0;
                                if (isset($_GET['type']) && $_GET['type'] != '') {
                                    $type = $_GET['type'];
                                } echo $type;
                                ?>

                                <option value="">Select Type</option>
                                <option value="0"  <?php if ($type == 0) echo 'selected'; ?>>All</option>
                                <option value="1" <?php if ($type == 1) echo 'selected'; ?>>Payment Requested from Freelancer</option>
                                <option value="2" <?php if ($type == 2) echo 'selected'; ?>>Release Requested from Employer</option>
                                <option value="3" <?php if ($type == 3) echo 'selected'; ?>>Paid</option>
                            </select>
                        </div>
                        <div class="col-md-5 col-xs-6 ">
                            <div class="input-group">
                                <!--<input id="appendedInputButtons1" type="text" name="keyword" class="form-control" placeholder="Search Keyword" value="<?php echo ($this->input->get('keyword')) ? $this->input->get('keyword') : '' ?>" onchange="document.getElementById('filter_search').submit();">-->
                                <input id="appendedInputButtons1" type="text" name="keyword" class="form-control" placeholder="Search Keyword" value="<?php echo ($this->input->get('keyword')) ? $this->input->get('keyword') : '' ?>">
                                <?php if ($this->input->get('perpage')) { ?>
                                    <input type="hidden" name="perpage" value="<?php echo $this->input->get('perpage'); ?>"/>
                                <?php } ?>
                                <span class="input-group-btn">
                                    <button class="btn" type="button">
                                        <i class="icon-search"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br/>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='box bordered-box blue-background' style='margin-bottom:0;'>
                    <div class='box-header blue-background pull-left col-xs-12 ofv' id="boxHeader">
                        <div class='title'>All Payments</div>
                    </div>

                    <div class='box-content box-no-padding pull-left col-xs-12'>
                        <div class='responsive-table'>
                            <div class='scrollable-area'>
                                <table class='data-table table table-bordered' style='margin-bottom:0;'>
                                    <thead>
                                        <tr>
                                            <th>
                                                <input type="checkbox" name="header_del_id" class="header_del_id" />
                                            </th>
                                            <th>
                                                Sr No.
                                            </th>
                                            <th>User Name
                                            </th>
                                            <th>
                                                Amount
                                            </th>
                                            <th>
                                                Currency Code
                                            </th>
                                            <?php if (empty($this->input->get('type'))) { ?>
                                                <th>
                                                    Status
                                                </th>
                                            <?php } ?>
                                            <th>
                                                Payment Date
                                            </th>
                                            <th>
                                                Payment Release Date
                                            </th>
                                            <?php if ($this->input->get('type') != 3) { ?>
                                                <th><center>
                                            Action
                                        </center></th>
                                    <?php } ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($payments) {
//                                            $s = 1;
                                            foreach ($payments as $row) {
                                                echo "<tr>";
                                                echo "<td><input type='checkbox' class='del_id' name='del_id[]' value='" . $row->payment_id . "'></td>";
                                                echo "<td>" . $sr . "</td>";
                                                echo "<td>" . $row->user_name . "</td>";
                                                echo "<td>" . $row->amount . "</td>";
                                                echo "<td>" . $row->currency . "</td>";
                                                
                                                /** For staus when displaying all*/
                                                if (empty($this->input->get('type'))) {
                                                    if ($row->payment_requested == 1 && $row->release_requested == 0 && $row->payment_release == 0)
                                                        echo "<td>Payment Requested from Freelancer</td>";
                                                    else if ($row->release_requested == 1 && $row->payment_release == 0)
                                                        echo "<td>Release Requested from Employer</td>";
                                                    else if ($row->payment_release == 1 && $row->payment_requested == 1 || $row->payment_release == 1 && $row->release_requested == 1)
                                                        echo "<td>Paid</td>";

                                                }
                                                    echo "<td>" . date('d-M-Y H:m:i', strtotime($row->payment_date)) . "</td>";

                                                if ($row->payment_release_date != '') {
                                                    echo "<td>" . date('d-M-Y H:m:i', strtotime($row->payment_release_date)) . "</td>";
                                                } else {
                                                    echo "<td>" . $row->payment_release_date . "</td>";
                                                }
                                                if ($this->input->get('type') == '') {
                                                    echo "<td><center>";
                                                    ?>

                                                                                                        <!--<input type='button' payment-id="<?php echo $row->payment_id ?>" data-job_id="<?php echo $row->job_id ?>" data-id="<?php echo $row->freelancer_id ?>" id="pay_btn" value='Pay' style='margin-bottom:5px' class='btn btn-success'>-->
                                                <input type='button' onclick='window.location = "<?php echo base_url() ?>index.php/payment/view/<?php echo $row->freelancer_id; ?>"' value='View Details' style='margin-bottom:5px' class='btn btn-info'>

                                                <?php
                                                echo "</center></td>";
                                            } else if ($this->input->get('type') == 1) {
                                                echo "<td><center>";
                                                ?>
                                                <!--<input type='button' payment-id="<?php echo $row->payment_id ?>" data-job_id="<?php echo $row->job_id ?>" data-id="<?php echo $row->freelancer_id ?>" id="pay_btn" value='Pay' style='margin-bottom:5px' class='btn btn-success pay_btn'>-->
                                                <input type='button' onclick='window.location = "<?php echo base_url() ?>index.php/payment/view/<?php echo $row->freelancer_id; ?>"' value='View Details' style='margin-bottom:5px' class='btn btn-info'>

                                                <?php
                                            } else if ($this->input->get('type') == 2) {
                                                echo "<td><center>";
                                                ?>
                                                <input type='button' payment-id="<?php echo $row->payment_id ?>" data-job_id="<?php echo $row->job_id ?>" data-id="<?php echo $row->freelancer_id ?>" id="pay_btn" value='Pay' style='margin-bottom:5px' class='btn btn-success pay_btn'>
                                                <input type='button' onclick='window.location = "<?php echo base_url() ?>index.php/payment/view/<?php echo $row->freelancer_id; ?>"' value='View Details' style='margin-bottom:5px' class='btn btn-info'>

                                                <?php
                                                echo "</center></td>";
                                            } else {
                                                echo "<td><center>";
                                                ?>

                                                <input type='button' onclick='window.location = "<?php echo base_url() ?>index.php/payment/view/<?php echo $row->freelancer_id; ?>"' value='View Details' style='margin-bottom:5px' class='btn btn-info'>
                                                <?php
//                                       
                                            }
                                            echo "</center></td>";
                                            echo "</tr>";
                                            $sr++;
                                        }
                                    } else {
                                        echo "<tr><td colspan='10' align='center'>No Payment found</td></tr>";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">  
            <div class='col-sm-12'>
                <?php echo $links; ?>
            </div>
        </div>
    </div>
</div>

<script>

    $('#success_msg').hide();
    $('.pay_btn').click(function () {
//        alert('dvcx');
        var freelancer_id = $(this).attr('data-id');
        var payment_id = $(this).attr('payment-id');
        var job_id = $(this).attr('data-job_id');
	
        $.ajax({
            url: '<?php echo base_url() ?>index.php/payment/changeStatus',
            type: 'POST',
            dataType: 'json',
            data: {freelancer_id: freelancer_id, payment_id: payment_id, job_id: job_id},
            success: function (data) {
                $('#success_msg').show();
                $('#success_msg').html('Payment is done successfully.');
                location.reload();
            }
        });
    });

    setTimeout(function () {
        $("#success_msg").hide();
    }, 5000);
</script>
