<?php
$segment = $this->uri->segment(4);
if ($segment == "") {
    $sr = 1;
} else {
    $sr = $segment + 1;
}
?>
<table class='data-table table table-bordered' style='margin-bottom:0;'>
    <thead>
        <tr>
            <th>
                <input type="checkbox" name="header_del_id" class="header_del_id" />
            </th>
            <th>
                Sr No.
            </th>
            <th data-page='all' data-sort='<?php echo (($postdata['sorting'] == 'DESC') ? "ASC" : "DESC") ?>' dta-name='name' data-startId='<?php echo $postdata['startId'] ?>' data-endId='<?php echo $postdata['endId'] ?>' class='active sort_column'> 
                <a href='javascript:;'>Country Name</a>
            </th>      
            <th>Status </th>
            <th><center>Action</center></th>
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
//            echo "<a href='" . base_url() . "index.php/countries/changeStatusByAdmin/" . $row->country_id . "' class='del btn btn-warning btn-xs'  onclick='return changeStatusPopup(this)'";
//                if ($row->is_active == 1) {
//                    echo "title='Activate Country'";
//                    echo "><i class='icon-ok'></i>";
//                } else {
//                    echo "title='Deactivate Country'";
//                    echo "><i class='icon-remove'></i>";
//                }
//            echo "</a>  ";
            echo "<a href='" . base_url() . "index.php/countries/edit/" . $row->country_id . $suffixUrl . "' title='Edit Country' class='btn btn-success btn-xs'><i class='icon-edit'></i></a>  ";
//            echo "<a id='alert-example' href='" . base_url() . "index.php/countries/delete/" . $row->country_id . "' title='Delete Country' class='del btn btn-danger btn-xs' onclick='return deletePopup(this)'><i class='icon-trash'></i></a>";
            echo "</center></td>";
            echo "</tr>";
            $sr++;
        }
    }else{
        echo "<tr><td colspan='10' align='center'>No Counrty found</td></tr>";
    }
    ?>
</tbody>
</table>