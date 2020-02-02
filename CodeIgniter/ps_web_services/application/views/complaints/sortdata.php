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
                              <th data-page='all' data-sort='" . (($postdata['sorting'] == 'DESC') ? "ASC" : "DESC") . "' dta-name='user_name' data-startId='" . $postdata['startId'] . "' data-endId='" . $postdata['endId'] . "' class='active sort_column'>
                                <a href='javascript:;'>User Name</a>
                             </th>
                           <th>Description </th>
                            <th>Complaints Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>";

if ($complaints) {
    foreach ($complaints as $row) {
        $table.="<tr>";
        $table.="<td>" . $sr . "</td>";
        $table.="<td>". $row->user_name . "</td>";
        $table.="<td>". base64_decode($row->description) . "</td>";
        $table.="<td>". base64_decode($row->action) . "</td>";      

        $table.="</tr>";
        $sr++;
    }
} else {
    $table.="<tr><td colspan='10' align='center'>No Complaints found</td></tr>";
}
$table.="</tbody></table>";

echo $table;
