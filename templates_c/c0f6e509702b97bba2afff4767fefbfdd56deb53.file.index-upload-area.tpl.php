<?php /* Smarty version Smarty-3.0.8, created on 2011-09-20 12:04:49
         compiled from "templates/index-upload-area.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7582061444e7810e126f218-98586465%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0f6e509702b97bba2afff4767fefbfdd56deb53' => 
    array (
      0 => 'templates/index-upload-area.tpl',
      1 => 1316491488,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7582061444e7810e126f218-98586465',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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