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
                                Sr No.
                            </th>
                           <th>Image</th>
                            
                              <th data-page='all' data-sort='" . (($postdata['sorting'] == 'DESC') ? "ASC" : "DESC") . "' dta-name='user_name' data-startId='" . $postdata['startId'] . "' data-endId='" . $postdata['endId'] . "' class='active sort_column'>
                                <a href='javascript:;'>User Name</a>
                             </th>
                             <th data-page='all' data-sort='" . (($postdata['sorting'] == 'DESC') ? "ASC" : "DESC") . "' dta-name='email' data-startId='" . $postdata['startId'] . "' data-endId='" . $postdata['endId'] . "' class='active sort_column'>
                                <a href='javascript:;'>Email</a>
                             </th>
                           <th>Status</th>
                            <th><center>
                                Action</center>
                            </th>
                        </tr>
                    </thead>
                    <tbody>";

if ($users) {
    foreach ($users as $row) {
        $table.="<tr>";
        $table.="<td>" . $sr . "</td>";
        if ($row->profile_pic != '') {
            $filename = getimagesize(USER_IMAGES . '/' . $row->profile_pic);
            if ($filename > 0) {
                $table.="<td align='center'><img src='" . USER_IMAGES . '/' . $row->profile_pic . "' height='50px' width='50px'></td>";
            } else {
                $table.="<td align='center'> No Image</td>";
            }
        } else {
            $table.="<td align='center'> No Image</td>";
        }
        $table.="<td>" . $row->user_name . "</td>";
        $table.="<td>" . $row->email . "</td>";
        if ($row->is_verified == 1) {
            $table.="<td>Verified </td>";
        } else {
            $table.="<td>Not verified</td>";
        }
        $table.="<td><center>";
        $table.="<a href='" . base_url() . "index.php/users/verifiedByAdmin/" . $row->user_id . "' class='del btn btn-warning btn-xs'  onclick='return changeStatusPopup(this)'";
        if ($row->is_verified == 1) {
            $table.= "title='Verify User'";
            $table.= "><i class='icon-ok'></i>";
        } else {
            $table.= "title='Unverify User'";
            $table.= "><i class='icon-remove'></i>";
        }
        $table.= "</a>  ";
        $table.= "<a href='" . base_url() . "index.php/users/view/" . $row->user_id . "' class = 'btn btn-info  btn-xs' title='View User'><i class='icon-eye-open'></i></a>  ";
        $table.="</center></td>";
        $table.="</tr>";
        $sr++;
    }
} else {
    $table.="<tr><td colspan='10' align='center'>No User found</td></tr>";
}
$table.="</tbody></table>";

echo $table;
