<table class="dataTable" width="100%" cellspacing="0">
<tr>
{foreach from=$fields key=k item=v}
<th onclick="xajax_RefreshElement('{$divName}','{$className}','{$fieldSort.$k}')"{if $curField==$k} class="activeColumn"{/if}>{$v}</th>
{/foreach}
<th width="46"><img src="images/spacer.gif" width="32" height="1"></th>
</tr>
{foreach from=$rowData item=v}
{assign var='id' value=$v.id}
<tr class="row{cycle values="0,1"}">

{foreach from=$fields key=field item=fieldname}

<td>{if $v.$field==""}&nbsp;{/if}{$v.$field}</td>
{/foreach}
<td valign="middle" align="center" width="46"><img title="Edit" alt="Edit" src="images/edit.png" class="clickable" onclick="xajax_RefreshElement('{$editDiv}','{$editClass}','{$editData.$id}');xajax_ShowDiv('{$areaDiv}');">
<img title="Delete" alt="Delete" src="images/delete.png" class="clickable" onclick="xajax_DeleteItem('{$tableName}','{$v.id}', '{$divName}', '{$className}')"></td>
</tr>
{/foreach}
</table>
{if $newButton != ""}
<input type="button" class="clickable" value="{$newButton}" onclick="xajax_RefreshElement('{$editDiv}','{$editClass}','{$newData}');xajax_ShowDiv('{$areaDiv}');">
{/if}
