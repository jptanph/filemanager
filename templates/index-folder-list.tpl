{if $hasFolder==0}
	<tr onmouseover="this.className='over'" onmouseout="this.className=''" style="cursor:pointer" onClick="File_manager.execViewFolder('{$rows.directory_name}')"><td colspan="3" align="center"><b style="color:red"><center>No directory found.<center></b></td></tr>
{elseif $hasFolder>=2}
	{if $hasBack!=''}
	<tr onClick="File_manager.execBackList()"><td colspan="3" align="center" style="cursor:pointer;"><img src="images/back-icon.png" /> Path : <b style="color:gray" title="Back"> {$hasBack}</b></td></tr>
	{/if}
	
	{if !$aFolderList}
	<tr><td colspan="3" align="center"><span style="color:black;font-size:11px"><center><b>{$actionType} files here?</b><center></span></td></tr>

	{else}
		{foreach from=$aFolderList item=rows}
			<tr onmouseover="this.className='over'" onmouseout="this.className=''" style="cursor:pointer" onClick="File_manager.execShowFolder('{$rows.directory_name}')"><td><img src="images/folder.gif" border="0" /> {$rows.directory_name}</td><td>{$rows.date}</td><td>{$rows.directory_size} kb</td></tr>
		{/foreach}
		<tr><td colspan="3" align="center"><span style="color:black;font-size:11px"><center><b id="default_action">Move or copy files here?</b><center></span></td></tr>		
	{/if}
{/if}

<script>
$(function(){
	{if $hasFolder==0}
		$("#backup-btn").hide();
	{else}
		$("#backup-btn").show();
	{/if}
})
</script>