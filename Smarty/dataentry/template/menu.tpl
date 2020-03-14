{foreach from=$menuNotices key=k item=v}
<div class="menuNotice">{$v}</div>

{/foreach}
{foreach from=$menuItems key=k item=v}
<div id="menu{$menuNumber}_{$k}" class="{if $k==0}activeMenuItem{else}menuItem{/if}" onclick="changeMenu({$menuNumber},{$k});xajax_LoadPage('{$v.page}','{$v.query}',{$v.reload})">{if $v.image!=""}<img src="{$v.image}" border="0" align="top"> {/if}{$v.name}</div>
{/foreach}

