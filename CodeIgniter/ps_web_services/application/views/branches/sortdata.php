<?php

$segment = $this->uri->segment(3);
if ($segment == "") {
    $sr = 1;
} else {
    $sr = $segment + 1;
}
$table = "<table class='data-table table table-bordered' style='margin-bottom:0;'>
                    <thead>
                        <tr>
                            <th>
                                <input type='checkbox' name='header_del_id' class='header_del_id'/>
                            </th>
                            <th>
                                Sr No.
                            </th>
                            <th data-page='all' data-sort='" . (($postdata['sorting'] == 'DESC') ? "ASC" : "DESC") . "' dta-name='branch_name' data-startId='" . $postdata['startId'] . "' data-endId='" . $postdata['endId'] . "' class='active sort_column'>
                                <a href='javascript:;'>Branch Name</a>
                             </th>
                            <th>
                                Bank Name
                            </th>
                            <th>
                                Status
                            </th>
                            <th><center>
                                                Action
                                    </center></th>
                        </tr>
                    </thead>
                    <tbody>";

if ($branches) {
    foreach ($branches as $row) {
        $table.="<tr>";
        $table.="<td><input type='checkbox' class='del_id' name='del_id[]' value='" . $row->branch_id . "'></td>";
        $table.="<td>" . $sr . "</td>";
        $table.="<td>" . $row->branch_name . "</td>";
        $table.="<td>" . $row->bank_name . "</td>";
        if ($row->branch_active == 1) {
            $table.="<td>Deactive </td>";
        } else {
          $table.="<td>Active</td>";
        }
        $table.="<td><center>";
        $table.="<a href='" . base_url() . "index.php/branches/changeStatusByAdmin/" . $row->branch_id . "' class='del btn btn-warning btn-xs'  onclick='return changeStatusPopup(this)'";
        if ($row->branch_active == 1) {
            $table.="title='Activate Branch'";
           $table.="><i class='icon-ok'></i>";
        } else {
           $table.="title='Deactivate Branch'";
           $table.="><i class='icon-remove'></i>";
        }
        $table.="</a>  ";                                        
       $table.="<a href='" . base_url() . "index.php/branches/edit/" . $row->branch_id . "' title='Edit Branch' class='btn btn-success btn-xs'><i class='icon-edit'></i></a>  ";
        $table.="<a id='alert-example' href='" . base_url() . "index.php/branches/delete/" . $row->branch_id . "' title='Delete Branch' class='del btn btn-danger btn-xs' onclick='return deletePopup(this)'><i class='icon-trash'></i></a>";
        $table.="</center></td>";
        $table.="</tr>";
        $sr++;
    }
} else {
    $table.="<tr><td colspan='10' align='center'>No Branch found</td></tr>";
}
$table.="</tbody></table>";

echo $table;
