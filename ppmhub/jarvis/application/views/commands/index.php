<?php
/**
 * Created by PhpStorm.
 * User: mohamed
 * Date: 23/09/15
 * Time: 10:30 Õ
 *
 */

?>

<br/>
<br/>
<div class="uk-container uk-container-center">
    <div class="uk-width-1-1">
        <div class="uk-animation-fade">
            <h2><i class="uk-icon-cogs"></i> Manage commands</h2>
            <hr class="uk-article-divider">
            <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                <thead>
                <tr class="uk-text-bold">
                    <th> <?php l('ID') ?></th>
                    <th><i class="uk-icon-cogs"></i> <?php l('Command') ?></th>
                    <th><i class="uk-icon-cogs"></i> <?php l('Response') ?></th>
                    <th><i class="uk-icon-cog"></i> <?php l('Options') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($commands as $row) { ?>
                    <tr id="<?php echo $row->id ?>">
                        <td class="uk-text-middle" >
                            <small><?php echo $row->id ?></small>
                        </td>
                        <td class="uk-text-middle uk-width-1-4" >
                            <small>
                                <a href="<?php echo site_url('commands/edit/' . $row->id) ?>"
                                   target="_blank"><i
                                        class="uk-icon-external-link"></i>
                                    <?php echo $row->command ?></a>
                            </small>
                        </td>
                        <td class="uk-text-middle uk-width-1-2">
                            <b>
                                <a href="<?php echo site_url('commands/edit/' . $row->id) ?>"
                                   target="_blank"><i
                                        class="uk-icon-external-link"></i>
                                    <?php echo $row->response ?></a>
                            </b>
                        </td>
                        <td class="uk-text-middle">
                            <a href="<?php echo site_url('commands/edit/' . $row->id) ?>"
                               class="uk-button uk-button-danger">
                                <i class="uk-icon-pencil"></i>
                                Edit
                            </a>
                            <a href="<?php echo site_url('commands/delete/' . $row->id) ?>"
                               class="uk-button uk-button-danger">
                                <i class="uk-icon-trash"></i>
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>

        </div>
    </div>
</div>