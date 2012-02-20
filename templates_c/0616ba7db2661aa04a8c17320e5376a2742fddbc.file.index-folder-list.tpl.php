<?php /* Smarty version Smarty-3.0.8, created on 2011-09-20 19:25:18
         compiled from "templates/index-folder-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10531286534e78781edaa509-77900905%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0616ba7db2661aa04a8c17320e5376a2742fddbc' => 
    array (
      0 => 'templates/index-folder-list.tpl',
      1 => 1316517915,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10531286534e78781edaa509-77900905',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('hasFolder')->value==0){?>
	<tr onmouseover="this.className='over'" onmouseout="this.className=''" style="cursor:pointer" onClick="File_manager.execViewFolder('<?php echo $_smarty_tpl->getVariable('rows')->value['directory_name'];?>
')"><td colspan="3" align="center"><b style="color:red"><center>No directory found.<center></b></td></tr>
<?php }elseif($_smarty_tpl->getVariable('hasFolder')->value>=2){?>
	<?php if ($_smarty_tpl->getVariable('hasBack')->value!=''){?>
	<tr onClick="File_manager.execBackList()"><td colspan="3" align="center" style="cursor:pointer;"><img src="images/back-icon.png" /> Path : <b style="color:gray" title="Back"> <?php echo $_smarty_tpl->getVariable('hasBack')->value;?>
</b></td></tr>
	<?php }?>
	
	<?php if (!$_smarty_tpl->getVariable('aFolderList')->value){?>
	<tr><td colspan="3" align="center"><span style="color:black;font-size:11px"><center><b><?php echo $_smarty_tpl->getVariable('actionType')->value;?>
 files here?</b><center></span></td></tr>

	<?php }else{ ?>
		<?php  $_smarty_tpl->tpl_vars['rows'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('aFolderList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['rows']->key => $_smarty_tpl->tpl_vars['rows']->value){
?>
			<tr onmouseover="this.className='over'" onmouseout="this.className=''" style="cursor:pointer" onClick="File_manager.execShowFolder('<?php echo $_smarty_tpl->tpl_vars['rows']->value['directory_name'];?>
')"><td><img src="images/folder.gif" border="0" /> <?php echo $_smarty_tpl->tpl_vars['rows']->value['directory_name'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['rows']->value['date'];?>
</td><td><?php echo $_smarty_tpl->tpl_vars['rows']->value['directory_size'];?>
 kb</td></tr>
		<?php }} ?>
		<tr><td colspan="3" align="center"><span style="color:black;font-size:11px"><center><b id="default_action">Move or copy files here?</b><center></span></td></tr>		
	<?php }?>
<?php }?>

<script>
$(function(){
	<?php if ($_smarty_tpl->getVariable('hasFolder')->value==0){?>
		$("#backup-btn").hide();
	<?php }else{ ?>
		$("#backup-btn").show();
	<?php }?>
})
</script>