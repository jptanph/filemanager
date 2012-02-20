{if $sFileExtension=='txt'}
<table border="0" align="center" style="margin:3px">
<tr>
	<td>
		<textarea rows="15" id="text-content" cols="59" id="text-content" style="border:solid 1px gray;background-color:whitesmoke;color:black;">{$sTextFileContent}</textarea>
		<input type="hidden" name="file-name" value="{$sFileName}" id="file-name" />
	</td>
</tr>
<tr>
	<td align="center">
		<br />
		<input type="button" value="Save" onClick="File_manager.execSaveTextFile()"/> <input type="button" value="Close" onClick="File_manager.execClose('view-dialog')"/>

	</td>
</tr>
</table>
{elseif  $sFileExtension=='jpg'}
	<div style="margin:9px;border:solid 9px whitesmoke;display:none" align="center" id="image-canvass">
		<img src="files/{$sImage}" width="100%" align="center" title="{$sFileName}"/>
	</div>
	
	<center>
		<input type="button" value="Close" onClick="File_manager.execClose('view-dialog')"/>
	</center>
{/if}

<script type="text/javascript">
	//<![CDATA[
	 $(function(){
		$("#view-dialog").dialog({				
			height:{if $sFileExtension=='txt'}'380'{else}'450'{/if},
			width:'498px',
			modal:true
		})
		
		$("#image-canvass").fadeIn(4500)
		$("input:button").button().css('font-size','11px');
	 })
	//]]>
</script>
