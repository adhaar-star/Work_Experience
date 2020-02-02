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
                            <th data-page='all' data-sort='" . (($postdata['sorting'] == 'DESC') ? "ASC" : "DESC") . "' dta-name='name' data-startId='" . $postdata['startId'] . "' data-endId='" . $postdata['endId'] . "' class='active sort_column'>
                                <a href='javascript:;'>Bank Name</a>
                             </th>
                              <th data-page='all' data-sort='" . (($postdata['sorting'] == 'DESC') ? "ASC" : "DESC") . "' dta-name='user_name' data-startId='" . $postdata['startId'] . "' data-endId='" . $postdata['endId'] . "' class='active sort_column'>
                                <a href='javascript:;'>User Name</a>
                             </th>
                           <th>Type</th>
                            <th>Country</th>
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
        $table.="<td>". $row->name . "</a></td>";
        $table.="<td>". $row->user_name . "</a></td>";
        if($row->type == 1 ){
        $table.="<td>Local</td>";
        }else{
        $table.="<td>International</td>";
            
        }
        $table.="<td>". $row->country . "</a></td>";
        $table.="<td><center>";        
        $table.= "<a href='" . base_url() . "index.php/users_bank_details/view/" . $row->bank_id . "' class = 'btn btn-info  btn-xs' title='View User's bank Account Details><i class='icon-eye-open'></i></a>  ";
        
        $table.="</center></td>";
        $table.="</tr>";
        $sr++;
    }
} else {
    $table.="<tr><td colspan='10' align='center'>No User's Bank Account Details found</td></tr>";
}
$table.="</tbody></table>";

echo $table;
