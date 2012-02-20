<?php /* Smarty version Smarty-3.0.8, created on 2011-09-26 16:57:24
         compiled from "templates/index-backup-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15131736104e803e74d56497-37241925%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c0cb3eccb9695c1f18ac17c451f21951217f5b04' => 
    array (
      0 => 'templates/index-backup-list.tpl',
      1 => 1317027439,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15131736104e803e74d56497-37241925',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
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
	<?php if (!$_smarty_tpl->getVariable('aBackupList')->value){?>
	<tr><td colspan="3" align="center"><span style="color:black;font-size:11px"><center><b>This directory is empty.</b><center></span></td></tr>

	<?php }else{ ?>
	<?php  $_smarty_tpl->tpl_vars['rows'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('aBackupList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['rows']->key => $_smarty_tpl->tpl_vars['rows']->value){
?>
			<tr onmouseover="this.className='over'" onmouseout="this.className=''"><td><img src="images/rar.bmp" border="0" /> <a href="common/downloader.php?file=../file_backup/<?php echo $_smarty_tpl->tpl_vars['rows']->value['sub_file_name'];?>
" style='text-decoration:none;color:black;font-size:10px'><?php echo $_smarty_tpl->tpl_vars['rows']->value['file_name'];?>
</a></td><td><?php echo $_smarty_tpl->tpl_vars['rows']->value['date_modified'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['rows']->value['size'];?>
</td></tr>
	<?php }} ?>
	<?php }?>
	
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
