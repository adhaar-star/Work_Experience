<br/>
<div class="content">
    <div class="wrap uk-width-7-10">
        <div class="single-page uk-animation-fade">
            <div class="single-page-artical">
                <div class="artical-content">
                    <h2><i class="uk-icon-list"></i> Manage Users</h2>
                    <hr class="uk-article-divider">
                    <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                        <thead>
                        <tr class="uk-text-bold">
                            <th>Photos</th>
                            <th>Username</th>
                            <th>E-mail</th>
                            <th>Registered</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $row) { ?>
                            <tr id="<?php echo $row->user_id ?>">
                                <td class="uk-text-middle"><img style="width: 20%" class="uk-border-circle"
                                                                src="<?php echo display_image_path($row->user_photo) ?>"/>
                                </td>
                                <td class="uk-text-middle"><?php echo $row->user_username ?></td>
                                <td class="uk-text-middle">
                                    <a href="mailto:<?php echo $row->user_email ?>"><?php echo $row->user_email ?></a>
                                </td>
                                <td><?php echo time_elapsed_string($row->user_created_date) ?></td>
                                <td class="uk-text-middle">
                                    <a href="<?php echo site_url('admin/delete_user/' . $row->user_id) ?>"
                                       class="uk-button uk-button-danger"><i class="uk-icon-trash"></i> Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>