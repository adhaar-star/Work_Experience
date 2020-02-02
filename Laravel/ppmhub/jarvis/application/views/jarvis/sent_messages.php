<hr/>
<div>
    <span class="uk-text-primary">Me: </span>
    <span class="uk-text-muted uk-float-right uk-text-small"><?php echo date('Y-h-d H:i:s') ?> </span>
    <p class="uk-text-muted"><?php echo nl2br($messages[0]) ?></p>
</div>
<hr/>
<div>
    <span class="uk-text-bold uk-text-primary">JARVIS: </span>
    <span class="uk-text-muted uk-float-right uk-text-small"><?php echo date('Y-h-d H:i:s') ?> </span>
    <p class="uk-text-muted uk-text-success"><?php echo ucwords(nl2br($messages[1])) ?></p>
</div>