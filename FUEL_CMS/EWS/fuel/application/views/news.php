<?php

?>
 
<h1>News</h1>
 
<?php if (!empty($news_item)) : ?>
 
<?php fuel_set_var('page_title', $news_item->headline); ?>
 
<div class="news_item">
    <h2><?=$news_item->headline?></h2>
    <div class="date"><?=$news_item->release_date_formatted?></div>
    <?=$news_item->content_formatted?>
</div>
 
<?php else: ?>
 
 
<?php foreach($news as $item) : ?>
 
<div class="news_item">
    <h2><a href="<?=$item->url?>"><?=$item->headline?></a></h2>
    <div class="date"><?=$item->release_date_formatted?></div>
    <?=$item->get_excerpt_formatted(300, 'Read Full Story »')?>
 
    <hr />
</div>
 
<?php endforeach; ?>
 
<?php endif; ?>
