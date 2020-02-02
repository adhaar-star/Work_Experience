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
<script>
    var del_url = '<?php echo base_url() ?>index.php/complaints/deleteAll';
    var tag_url = '<?php echo base_url() . 'index.php/complaints/index/' . $this->uri->segment(3) . $suffixUrl; ?>';
    var sort_url = '<?php echo base_url() ?>index.php/complaints/sortData/<?php echo $this->uri->segment(3) . $suffixUrl; ?>';
</script>

<?php
$segment = $this->uri->segment(3);
$startId = 0;
$endId = 0;

if ($segment == "") {
    $sr = 1;
} else {
    $sr = $segment + 1;
}
if ($complaints) {
    $cnt = count($complaints);
    $startId = $complaints[0]->complaints_id;
    $endId = $complaints[$cnt - 1]->complaints_id;
}
?>
<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-group'></i>
                        <span>All Complaints</span>
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
                            <li class='active'>Complaints</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6 col-xs-12'>
<!--                <input class="btn btn-primary" onclick="window.location = '<?php echo base_url() ?>index.php/users_bank_details/add'"  type="button" value="Add New Skill" style="margin-bottom:5px">
                <input class="btn btn-warning delete_All" type="button" value="Delete Selected" style="margin-bottom:5px" disabled="disabled">
                <input class="btn btn-success" type="button" value="Back" style="margin-bottom:5px" onclick="window.history.back()">-->
            </div>
            <div class="col-md-5 col-md-5 pull-right tabmt10">
                <div class="row">
                    <form action="<?php echo base_url() . 'index.php/complaints' ?>" method="get">
                        <div class="col-md-5 col-xs-6">

                        </div>
                        <div class="col-md-7 col-xs-6 ">
                            <div class="input-group">
                                <input id="appendedInputButtons1" type="text" name="keyword" class="form-control" placeholder="Search Keyword" value="<?php echo ($this->input->get('keyword')) ? $this->input->get('keyword') : '' ?>"/>
                                <?php if ($this->input->get('perpage')) { ?>
                                    <input type="hidden" name="perpage" value="<?php echo $this->input->get('perpage'); ?>"/>
                                <?php } ?>
                                <span class="input-group-btn">
                                    <button class="btn" type="submit" type="submit">
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
                        <div class='title'>All Complaints</div>
                    </div>
                    <div class='box-content box-no-padding pull-left col-xs-12'>
                        <div class='responsive-table'>
                            <div class='scrollable-area'>
                                <table class='data-table table table-bordered' style='margin-bottom:0;'>
                                    <thead>
                                        <tr>
<!--                                            <th>
                                                <input type="checkbox" name="header_del_id" class="header_del_id" />
                                            </th>-->
                                            <th>
                                                Sr No.
                                            </th>
                                            <th data-page="all" data-sort="DESC" dta-name="user_name" class="active sort_column" data-startId="<?php echo $startId; ?>" data-endId="<?php echo $endId; ?>">
                                                <a href='javascript:;'>User Name</a>
                                            </th>
                                            <th>Description
                                            </th>
                                            <th>Complaints Action</th>
											<th>Created Date</th>
<!--                                            <th><center>
                                        Action</center>
                                    </th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($complaints) {
//                                            $s = 1;
                                            foreach ($complaints as $row) {
                                                echo "<tr>";
                                                echo "<td>" . $sr . "</td>";
                                               
                                                echo "<td>" . $row->user_name . "</td>";
                                                echo "<td>" . base64_decode($row->description) . "</td>";
                                                echo "<td>" . base64_decode($row->action) . "</td>";
												echo "<td>" .date('d-M-Y H:m:i', strtotime($row->created_date)) . "</td>";
//                                                echo "<td><center>";
////                                                echo "<a href='" . base_url() . "index.php/skills/edit/" . $row->skill_id . "' class = 'btn btn-success  btn-xs' title='Edit Skill'><i class='icon-edit'></i></a>  ";
//                                                echo "<a href='" . base_url() . "index.php/complaints/view/" . $row->complaints_id . "' class = 'btn btn-info  btn-xs' title='View Complaints'><i class='icon-eye-open'></i></a>  ";
////                                                echo "<a href='" . base_url() . "index.php/skills/delete/" . $row->skill_id . $suffixUrl . "' class = 'btn btn-danger btn-xs' title='Delete Skill' class='del' onclick='return deletePopup(this)'><i class='icon-trash'></i></a>";
//
//                                                echo "</center></td>";
                                                echo "</tr>";
                                                $sr++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='10' align='center'>No Complaints found</td></tr>";
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
    function changeStatusPopup(obj) {
        var msg = $(obj).attr('title');
        jconfirm("Do you really want to " + msg + "?", function (r) {
            console.log(r);
            if (r) {
                window.location = $(obj).attr('href');
            }
        });
        return false;
    }

    function deletePopup(obj) {
        jconfirm("Do you really want to delete this Complaints?", function (r) {
            console.log(r);
            if (r) {
                window.location = $(obj).attr('href');
            }
        });
        return false;
    }
</script>
