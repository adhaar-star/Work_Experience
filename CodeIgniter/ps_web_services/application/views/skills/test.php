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
    var del_url = '<?php echo base_url() ?>skills/deleteAll';
    var tag_url = '<?php echo base_url() . 'skills/index/' . $this->uri->segment(3) . $suffixUrl; ?>';
    var sort_url = '<?php echo base_url() ?>skills/sortData/<?php echo $this->uri->segment(3) . $suffixUrl; ?>';
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
if ($skills) {
    $cnt = count($skills);
    $startId = $skills[0]->skill_id;
    $endId = $skills[$cnt - 1]->skill_id;
}
?>
<div class='row' id='content-wrapper'>
    <div class='col-xs-12'>
        <div class='row'>
            <div class='col-sm-12'>
                <div class='page-header'>
                    <h1 class='pull-left'>
                        <i class='icon-group'></i>
                        <span>All Skills</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class='row'>
            <div class='col-md-6 col-xs-12'>
                <input class="btn btn-primary" onclick="window.location = '<?php echo base_url() ?>skills/add'"  type="button" value="Add New Skill" style="margin-bottom:5px">
                <input class="btn btn-warning delete_All" type="button" value="Delete Selected" style="margin-bottom:5px" disabled="disabled">
                <input class="btn btn-success" type="button" value="Back" style="margin-bottom:5px" onclick="window.history.back()">
            </div>
            <div class="col-md-5 col-md-5 pull-right tabmt10">
                <div class="row">
                    <form action="<?php echo base_url() . 'skills' ?>" method="get">
                        <!--<div class="col-md-5 col-xs-6">-->
                        <div class="control-label col-sm-1">
                            <p style="margin-top: 5px;"><strong>Filter By:</strong></p>
                        </div>
                        <div class="col-sm-4 controls with-icon-over-input">
                            <select name="skill_id" class="form-control" data-rule-required="true" id="skill_id">
                                <option value="">--Select Skill--</option>
                                <?php
                                foreach ($skills as $row) {
//                                                if ($user->skill_id == $row->skill_id)
//                                                    echo "<option value='" . $row->skill_id . "' selected>" . $row->skill_description . "</option>";
//                                                else
                                    echo "<option value='" . $row->skill_id . "' >" . $row->skill_description . "</option>";
//                                                echo "<option value='" . $row->id . "'>" . $row->name_en . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!--</div>-->
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
        <div class='row tab'>
            <div class='col-sm-12'>
                <div class='box bordered-box blue-background' style='margin-bottom:0;'>
                    <div class='box-header blue-background pull-left col-xs-12 ofv' id="boxHeader">
                        <div class='title'>All Skills</div>
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
                                            <th data-page="all" data-sort="DESC" dta-name="skill_description" class="active sort_column" data-startId="<?php echo $startId; ?>" data-endId="<?php echo $endId; ?>">
                                                <a href='javascript:;'>Skill Name</a>
                                            </th>
                                            <th>
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="skill">
                                        <?php
                                        if ($skills) {
//                                            $s = 1;
                                            foreach ($skills as $row) {
                                                echo "<tr>";
                                                echo "<td><input type='checkbox' class='del_id' name='del_id[]' value='" . $row->skill_id . "'></td>";
                                                echo "<td>" . $sr . "</td>";
                                                echo "<td><a href='" . base_url() . "skills/getcategories/" . $row->skill_id . "'  data-id='" . $row->skill_id . "'>" . $row->skill_description . "</a></td>";
                                                echo "<td>";
//                                                echo "<a href='" . base_url() . "users/changeStatus/" . $row->skill_id . $suffixUrl . "' title='" . (($row->is_active == 1) ? "Deactivate User" : "Activate User") . "' class = 'btn btn-success btn-xs' onclick='return changeStatusPopup(this)'>" . (($row->is_active == 1) ? "<i class=' icon-remove'></i>" : "<i class=' icon-ok'></i>") . "</a>  ";
                                                echo "<a href='" . base_url() . "skills/edit/" . $row->skill_id . "' class = 'btn btn-success  btn-xs' title='Edit Skill'><i class='icon-edit'></i></a>  ";
//                                                echo "<a href='" . base_url() . "skills/view/" . $row->skill_id . "' class = 'btn btn-info  btn-xs' title='View Skill'><i class='icon-eye-open'></i></a>  ";
                                                echo "<a href='" . base_url() . "skills/delete/" . $row->skill_id . $suffixUrl . "' class = 'btn btn-danger btn-xs' title='Delete Skill' class='del' onclick='return deletePopup(this)'><i class='icon-trash'></i></a>";
                                                echo "</td>";
                                                echo "</tr>";
                                                $sr++;
                                            }
                                        } else {
                                            echo "<tr><td colspan='10' align='center'>No Skill found</td></tr>";
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
        <div class="row links">  
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
        jconfirm("Do you really want to delete this Skill?", function (r) {
            console.log(r);
            if (r) {
                window.location = $(obj).attr('href');
            }
        });
        return false;
    }

    $(function () { //document is loaded so we can bind events

        $("#skill_id").change(function () { //change event for select
            var skill_id = $(this).val();
            $.ajax({//ajax call
                type: "POST", //method == POST 
                
                url: "<?php echo base_url() ?>Categories/getcategories/" + skill_id, //url to be called
                dataType: 'html',
                data: {users: $("#skill_id option:selected").val()}, //data to be send 
                success: function (data) {
//                    var obj = jQuery.parseJSON(data);
//                    console.log(data);
//                    var dtaa = "<div class='skill1'>" + data + "</div>";


//                    $('#content-wrapper').html(tab);
                    window.location.href= '<?php echo base_url() ?>Categories/getcategories/' + skill_id;
                }
            });
        });
    });
</script>
