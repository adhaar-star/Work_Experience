<br/>
<br/>
<div class="uk-container uk-container-center uk-height-viewport uk-margin-large-bottom">
    <div class="uk-width-1-1">
        <div class="uk-animation-fade">
            <h2><i class="uk-icon-cogs"></i> <?php l('Manage Messages') ?></h2>
            <hr class="uk-article-divider">
            <table class="uk-table uk-table-hover uk-table-striped uk-table-condensed">
                <thead>
                <tr class="uk-text-bold">
                    <th> <?php l('ID') ?></th>
                    <th><i class="uk-icon-user"></i> <?php l('User') ?></th>
                    <th><i class="uk-icon-comments"></i> <?php l('Message') ?></th>
                    <th><i class="uk-icon-calendar"></i> <?php l('Date') ?></th>
                    <th><i class="uk-icon-cog"></i> <?php l('Options') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($messages as $row) { ?>
                    <tr id="<?php echo $row->id ?>">
                        <td class="uk-text-middle">
                            <?php echo $row->id ?>
                        </td>
                        <td class="uk-text-middle">
                            <?php open_iframe($row->email,'messages/details/'.base64_encode($row->ip).'IPDATE'.($row->date)) ?>
                        </td>
                        <td class="uk-text-middle">
                            <a href="<?php echo site_url('messages/edit/' . $row->id) ?>"
                               target="_blank">
                                <?php echo wordwrap(word_limiter($row->message,10), 40, "<br/>\n", true); ?>
                            </a>
                        </td>
                        <td class="uk-text-middle uk-text-success">
                            <?php echo $row->date ?>
                        </td>
                        <td class="uk-text-middle">
                            <a href="<?php echo site_url('messages/delete/' . $row->ip) ?>"
                               class="uk-button uk-button-danger">
                                <i class="uk-icon-trash"></i>
                                Delete All Messages For This User
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>