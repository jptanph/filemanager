<fieldset><legend> &nbsp;<b>Select file type</b></legend>
<br />
<table width="300px" style="margin:15px" cellpadding="3" cellspacing="3">
<tr style="font-size:12px"><td><label><input type="radio" name="file_type" value="folder"  checked> Create a Folder</label> &nbsp;&nbsp;<label><input type="radio" name="file_type" value="text_file"> Create a Text File</label></td></tr>
<tr style="font-size:12px"><td>&nbsp;</td></tr>
<tr style="font-size:12px"><td>Name : <input type="text" name="file_name" id="file_name" size="30"></td></tr>
<tr style="font-size:12px"><td>&nbsp;</td></tr>
<tr style="font-size:12px"><td align="center"><input type="button" value="Submit" onClick="File_manager.execSaveFile();"> <input type="button" value="Close" onClick="File_manager.execClose('create-dialog')"></td></tr>
</table>
<br />
<br />
</fieldset>
<script type="text/javascript">
$(function(){
	$("input:button").button().css('font-size','11px');
	$("#create-dialog").dialog({
		width:'360',
		modal:true
	})
})
</script>