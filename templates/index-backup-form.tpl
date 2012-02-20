
<div id="backup-loader" style="display:none">
	<br />
	<br />
	<center>
		<img src="images/uploader.gif" /> <br />
		<b style="font-size:11px">Processing.. Please wait..</b>
	</center>
	<br />
	<br />
</div>


<div id="backup-list" style="display:none">
	<br />
	<br />
	<center>
	<b style='font-size:11px'>Backup done. Do you want to view the backup list?</b><br /><br />
	<input type="button" value=" View " onClick="File_manager.execBackupList();" /> <input type="button" value=" Logs " id="view-logs" onClick="File_manager.execViewLogs()" /> <input type="button" value="Close"  onClick="File_manager.execClose('backup-form')"/>
	<br />
	<br />
	</center>
	<div id="log-area" style="display:none;">
	<hr size="1" />
	<br />
	<b style='font-size:11px'>Backup log : </b><br /><br />
	<textarea id="backup-log" readonly="true" style="color:white;background-color:black;font-size:11px;border:solid 1px gray" rows="7" cols="52"></textarea>
	<br />
	<br />
	</div>
	
	<br />
	<br />
</div>

<table width="300px" style="margin:15px;border:solid 1px white" cellpadding="3" cellspacing="3" align="center" id="backup-confirm">
	<tr>
		<td align="center" valign="middle">
			<span><img src="images/bg_warn_box.gif" /> Do you want to backup all your files?</span>
			<br /><br />
			<input type="button" value="Backup" onClick="File_manager.execFileBackup();" /> <input type="button" value="Close"  onClick="File_manager.execClose('backup-form')"/>
		</td>
	</tr>
</table>


<script type="text/javascript">
$(function(){
	$("input:button").button().css('font-size','11px');
	$("input:submit").button().css('font-size','11px');		
	$("#backup-form").dialog({				
		width:'390',
		resizable:true,
		modal:true
	});	
	var flip = 0;
	$("#view-logs").click(function(){
		$("#log-area").toggle();
	})
})
</script>