<?php

$segment = $this->uri->segment(4);
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
                            <th data-page='all' data-sort='" . (($postdata['sorting'] == 'DESC') ? "ASC" : "DESC") . "' dta-name='skill_description_en' data-startId='" . $postdata['startId'] . "' data-endId='" . $postdata['endId'] . "' class='active sort_column'>
                                <a href='javascript:;'>Skill Name(English)</a>
                            </th>
                            <th>Skill Name(Arabic)</th>
                            <th>Skill Name(Mandarin)</th>
                            <th>Skill Name(Spanish)</th>
                           <th><center> Action </center></th>
                        </tr>
                    </thead>
                    <tbody>";

if ($skills) {
    foreach ($skills as $row) {
        $table.="<tr>";
        $table.="<td><input type='checkbox' class='del_id' name='del_id[]' value='" . $row->skill_id . "'></td>";
        $table.="<td>" . $sr . "</td>";
        $table.="<td><a href='" . base_url() . "index.php/skills/getsubcategories/" . $row->skill_id . "'  data-id='" . $row->skill_id . "'>" . $row->skill_description_en . "</a></td>";
        $table.="<td><a href='" . base_url() . "index.php/skills/getsubcategories/" . $row->skill_id . "'  data-id='" . $row->skill_id . "'>" . $row->skill_description_ar . "</a></td>";
        $table.="<td><a href='" . base_url() . "index.php/skills/getsubcategories/" . $row->skill_id . "'  data-id='" . $row->skill_id . "'>" . $row->skill_description_zh . "</a></td>";
        $table.="<td><a href='" . base_url() . "index.php/skills/getsubcategories/" . $row->skill_id . "'  data-id='" . $row->skill_id . "'>" . $row->skill_description_es . "</a></td>";
//        $table.="<td>" . $query_parent->skill_description . "</td>";
        $table.="<td><center>";
        $table.="<a href='" . base_url() . "index.php/skills/editCategory/" . $query_parent->skill_id . "/" . $row->skill_id . "' class = 'btn btn-success  btn-xs' title='Edit Skill'><i class='icon-edit'></i></a>  ";
        $table.= "<a href='" . base_url() . "index.php/skills/view/" . $row->skill_id . "' class = 'btn btn-info  btn-xs' title='View Skill'><i class='icon-eye-open'></i></a>  ";
        $table.="<a href='" . base_url() . "index.php/skills/delete/" . $row->skill_id . "' class = 'btn btn-danger btn-xs' title='Delete Skill' class='del' onclick='return deletePopup(this)'><i class='icon-trash'></i></a>";
        $table.="</center></td>";
        $table.="</tr>";
        $sr++;
    }
} else {
    $table.="<tr><td colspan='10' align='center'>No Skills found</td></tr>";
}
$table.="</tbody></table>";

echo $table;
