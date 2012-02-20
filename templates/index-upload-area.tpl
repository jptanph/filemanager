<div id="upload-area"><br /><br />
	<form name="form" action="" method="POST" enctype="multipart/form-data">
		<fieldset><legend> &nbsp;<b>Please select a file you want to upload.</b></legend>
		<br />
		<table width="300px" style="margin:15px;border:solid 1px white" cellpadding="3" cellspacing="3">
		<tr style="font-size:12px">
			<td align="center">
				<center><input id="fileToUpload" type="file" name="fileToUpload" class="input"></center>
			</td>
		<tr><td>&nbsp;</td></tr>
		<tr style="font-size:12px">
			<td align="center"><input type="button" value="Save" onClick="File_manager.execSaveUpload();"> <input type="button" value="Close" onClick="File_manager.execClose('upload-form')">
			</td>
		</tr>
		</tr>
		</table>
		<br />
		</fieldset>
	</form>
</div>
<br />
<br />
<div style="font-size:11px;display:none" id="uploader" >
	<center><img src="images/uploader.gif" /><br />
	<b>Uploading.. Please wait.</b>
	</center>
</div><br />
<script type="text/javascript">
$(function(){
	$("input:button").button().css('font-size','11px');
	$("input:submit").button().css('font-size','11px');		
	$("#upload-form").dialog({				
		width:'380',
		modal:true
	});		
})
</script>