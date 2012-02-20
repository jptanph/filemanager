
{if !$aResult}
	<tr>
		<td colspan="5"><center><b style='color:red'>Directory is empty.</b></center></td>	
	</tr>
{else}

	{foreach from=$aResult item=rows}
		<tr id="file_{$rows.file_name}" style="cursor:pointer" onmouseover="this.className='over'" onmouseout="this.className=''"   title="File name : {$rows.sub_file_name}">
			<td align='center'><input type="checkbox" title="" class="input_chk" value="{$rows.sub_file_name}" name="file_checkbox" id="file_checkbox"/></td>
			<td>
				{if $rows.file_type =='d' || $rows.file_type=='jpg' || $rows.file_type=='txt'}
					&nbsp;&nbsp;<b style='font-size:12px;cursor:pointer' onClick="File_manager.execView('{$rows.sub_file_name}','{$rows.file_type}')"><img src="images/{if $rows.file_type=='d'}folder.gif{else}{$rows.file_info['image']}{/if}"/> {$rows.file_name} </b>
				{else}
					<b><a href="common/downloader.php?file={$rows.file_path}{$rows.sub_file_name}"  style='font-size:12px;text-decoration:none;color:black;' title="File name : {$rows.sub_file_name}"><img src="images/{$rows.file_info['image']}" border="0"/> {$rows.file_name} </a></b>
				{/if}
			</td>
			<td onclick="File_manager.execCheckRow('{$rows.file_name}')"  ondblclick="File_manager.execUncheckRow('{$rows.file_name}')" class="table_subtitle"><i>{$rows.date_modified}</i></td>
			<td  onclick="File_manager.execCheckRow('{$rows.file_name}')"  ondblclick="File_manager.execUncheckRow('{$rows.file_name}')">{$rows.file_info['file_type']}</td>				
			<td  onclick="File_manager.execCheckRow('{$rows.file_name}')"  ondblclick="File_manager.execUncheckRow('{$rows.file_name}')">{$rows.size}</td>	
		</tr>
	{/foreach}	

{/if}

<script type="text/javascript">
	//<![CDATA[
		$(function(){
			var totalCount = $("#total_count");
			totalCount.empty();
			totalCount.append({$iTotalFiles});
			$("#sort_order").remove()
			$("body").append("<input type=\"hidden\" value='{$sSortOrder}' id=\"sort_order\" />");
		})
	//]]>
</script>
