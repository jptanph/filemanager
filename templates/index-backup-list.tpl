<div style="margin:1px;" align="center">
<br />
	<table border="1" cellpadding="0" cellspacing="0" class="table_hor_02" id="backup-tbl">
	<colgroup>
		<col width="285px"/>		
		<col width="140px"/>
		<col width="100px"/>
	</colgroup>
	<thead>			
	<tr>
		<th><label>Backup Name</label></th>
		<th><label>Backup date</label></th>	
		<th><label>Size</label></th>	
	</tr>
	</thead>
	<tbody id="folder-list">
	{if !$aBackupList}
	<tr><td colspan="3" align="center"><span style="color:black;font-size:11px"><center><b>This directory is empty.</b><center></span></td></tr>

	{else}
	{foreach from=$aBackupList item=rows}
			<tr onmouseover="this.className='over'" onmouseout="this.className=''"><td><img src="images/rar.bmp" border="0" /> <a href="common/downloader.php?file=../file_backup/{$rows.sub_file_name}" style='text-decoration:none;color:black;font-size:10px'>{$rows.file_name}</a></td><td>{$rows.date_modified}</td><td>{$rows.size}</td></tr>
	{/foreach}
	{/if}
	
	</tbody>
	</table>
</div>
<br />
<div style="margin:10px">
	<center>
		<input type="button" value="Close" onClick="File_manager.execClose('backup-list-form')"/>
	</center>
</div>
<script type="text/javascript">
	//<![CDATA[
	 $(function(){
		$("#backup-list-form").dialog({	
			modal:true,
			width:'580',
			position:'center',
			beforeClose : function(){
				File_manager.execClose('backup-form')
			}
		});
		$("#search-path").focus()
		$("input:button").button().css('font-size','11px');			
	 })
	//]]>
</script>
