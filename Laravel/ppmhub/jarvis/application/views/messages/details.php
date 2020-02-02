<div style="width: 97%">
    <h2><?php echo $ip ?> - <?php echo $date ?></h2>
<?php
$i = 0;
foreach ($messages as $row) { ?>
    <hr/>
    <div>
        <?php
        if ($i % 2 !== 0) { ?>
            <div>
                <span class="uk-text-bold uk-text-primary">JARVIS (ROBOT):</span>
                <span class="uk-text-muted uk-float-right uk-text-small"><?php echo date('Y-h-d H:i:s',$row->created_date) ?></span>
                <p class="uk-text-muted uk-text-bold uk-text-success"><?php echo ucwords(nl2br($row->message)) ?></p>
            </div>
        <?php }else{?>
            <span class="uk-text-primary"><?php echo $row->email.' With ip <'.$row->ip.'>' ?> </span>
            <span class="uk-text-muted uk-float-right uk-text-small"><?php echo date('Y-h-d H:i:s',$row->created_date) ?> </span>
            <p class="uk-text-muted"><?php echo ucwords(nl2br($row->message)) ?></p>
        <?php } ?>
    </div>
    <hr/>
<?php $i++; } ?>
</div>