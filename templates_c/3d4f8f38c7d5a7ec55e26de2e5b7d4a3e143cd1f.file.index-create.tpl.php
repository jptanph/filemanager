<?php /* Smarty version Smarty-3.0.8, created on 2011-09-20 12:01:10
         compiled from "templates/index-create.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13186358274e781006bb3b71-27365635%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d4f8f38c7d5a7ec55e26de2e5b7d4a3e143cd1f' => 
    array (
      0 => 'templates/index-create.tpl',
      1 => 1316491143,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13186358274e781006bb3b71-27365635',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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