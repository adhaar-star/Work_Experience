<?php
$queryString = '';
$suffixUrl = '';


if ($this->input->get('perpage')) {
    if ($queryString != '')
        $suffixUrl = $queryString . "&perpage=" . $this->input->get('perpage');
    else
        $suffixUrl = "?perpage=" . $this->input->get('perpage');
} else
    $suffixUrl = $queryString;
?>
<script>
    var del_url = '<?php echo base_url() ?>index.php/countries/deleteAll';
    var tag_url = '<?php echo base_url() . 'index.php/countries' . $this->uri->segment(4) . $suffixUrl; ?>';
    var sort_url = '<?php echo base_url() ?>index.php/countries/sortData<?php echo $this->uri->segment(4) . $suffixUrl; ?>';
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
if ($countries) {
    $cnt = count($countries);
    $startId = $countries[0]->country_id;
    $endId = $countries[$cnt - 1]->country_id;
}
?>

<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-globe'></i>
                        <span>All Countries</span>
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
                            <li class='active'>Countries</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6 col-xs-12'>
                <input class="btn btn-primary" onclick="window.location = '<?php echo base_url() ?>index.php/countries/add'" type="button" value="Add New Country" style="margin-bottom:5px">
                <input class="btn btn-warning delete_All" type="button" value="Delete Selected" style="margin-bottom:5px" disabled="disabled">
                <input class="btn btn-success" type="button" value="Back" style="margin-bottom:5px" onclick="window.history.back()">
            </div>
            <div class="col-md-5 col-md-5 pull-right tabmt10">
                <div class="row">
                    <form action="<?php echo base_url() . 'index.php/countries' ?>" method="get">
                        <div class="col-md-5 col-xs-6">

                        </div>
                        <div class="col-md-7 col-xs-6 ">
                            <div class="input-group">
                                <input id="appendedInputButtons1" type="text" name="keyword" class="form-control" placeholder="Search Keyword" value="<?php echo ($this->input->get('keyword')) ? $this->input->get('keyword') : '' ?>"/>
                                <?php if ($this->input->get('perpage')) { ?>
                                    <input type="hidden" name="perpage" value="<?php echo $this->input->get('perpage'); ?>"/>
                                <?php } ?>
                                <span class="input-group-btn">
                                    <button class="btn" type="submit">
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
                        <div class='title'>All Countries</div>                                         
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
                                            <th data-page="all" data-sort="DESC" dta-name="name" class="active sort_column" data-startId="<?php echo $startId; ?>" data-endId="<?php echo $endId; ?>">
                                                <a href='javascript:;'>Country Name</a></th>
                                            <th>
                                                Status
                                            </th>
                                            <th><center>
                                        Action
                                    </center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($countries) {
                                            foreach ($countries as $row) {
                                                echo "<tr>";
                                                echo "<td><input type='checkbox' class='del_id' name='del_id[]' value='" . $row->country_id . "'></td>";
                                                echo "<td>" . $sr . "</td>";
                                                echo "<td>" . $row->name . "</td>";
                                                if ($row->is_active == 1) {
                                                    echo "<td>Deactive </td>";
                                                } else {
                                                    echo "<td>Active</td>";
                                                }
                                                echo "<td><center>";
                                                echo "<a href='" . base_url() . "index.php/countries/changeStatusByAdmin/" . $row->country_id . "' class='del btn btn-warning btn-xs'  onclick='return changeStatusPopup(this)'";
                                                if ($row->is_active == 1) {
                                                    echo "title='Activate Country'";
                                                    echo "><i class='icon-ok'></i>";
                                                } else {
                                                    echo "title='Deactivate Country'";
                                                    echo "><i class='icon-remove'></i>";
                                                }
                                                echo "</a>  ";
                                                echo "<a href='" . base_url() . "index.php/countries/edit/" . $row->country_id . "' title='Edit Country' class='btn btn-success btn-xs'><i class='icon-edit'></i></a>  ";
                                                echo "<a id='alert-example' href='" . base_url() . "index.php/countries/delete/" . $row->country_id . "' title='Delete Country' class='del btn btn-danger btn-xs' onclick='return deletePopup(this)'><i class='icon-trash'></i></a>";
                                                echo "</center></td>";
                                                echo "</tr>";
                                                $sr++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='7' class='text-center'>No Countries Found</td></tr>";
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
        jconfirm("Do you really want to change the status for this country?", function (r) {
            console.log(r);
            if (r) {
                window.location = $(obj).attr('href');
            }
        });
        return false;
    }

    function deletePopup(obj) {
        jconfirm("Do you really want to delete this country?", function (r) {
            console.log(r);
            if (r) {
                window.location = $(obj).attr('href');
            }
        });
        return false;
    }
</script>
