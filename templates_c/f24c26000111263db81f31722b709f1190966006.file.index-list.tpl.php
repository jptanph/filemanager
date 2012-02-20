<?php /* Smarty version Smarty-3.0.8, created on 2011-09-26 13:04:27
         compiled from "templates/index-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12274015964e8007db90f962-67547910%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f24c26000111263db81f31722b709f1190966006' => 
    array (
      0 => 'templates/index-list.tpl',
      1 => 1317013466,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12274015964e8007db90f962-67547910',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php if (!$_smarty_tpl->getVariable('aResult')->value){?>
	<tr>
		<td colspan="5"><center><b style='color:red'>Directory is empty.</b></center></td>	
	</tr>
<?php }else{ ?>

	<?php  $_smarty_tpl->tpl_vars['rows'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('aResult')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['rows']->key => $_smarty_tpl->tpl_vars['rows']->value){
?>
		<tr id="file_<?php echo $_smarty_tpl->tpl_vars['rows']->value['file_name'];?>
" style="cursor:pointer" onmouseover="this.className='over'" onmouseout="this.className=''"   title="File name : <?php echo $_smarty_tpl->tpl_vars['rows']->value['sub_file_name'];?>
">
			<td align='center'><input type="checkbox" title="" class="input_chk" value="<?php echo $_smarty_tpl->tpl_vars['rows']->value['sub_file_name'];?>
" name="file_checkbox" id="file_checkbox"/></td>
			<td>
				<?php if ($_smarty_tpl->tpl_vars['rows']->value['file_type']=='d'||$_smarty_tpl->tpl_vars['rows']->value['file_type']=='jpg'||$_smarty_tpl->tpl_vars['rows']->value['file_type']=='txt'){?>
					&nbsp;&nbsp;<b style='font-size:12px;cursor:pointer' onClick="File_manager.execView('<?php echo $_smarty_tpl->tpl_vars['rows']->value['sub_file_name'];?>
','<?php echo $_smarty_tpl->tpl_vars['rows']->value['file_type'];?>
')"><img src="images/<?php if ($_smarty_tpl->tpl_vars['rows']->value['file_type']=='d'){?>folder.gif<?php }else{ ?><?php echo $_smarty_tpl->tpl_vars['rows']->value['file_info']['image'];?>
<?php }?>"/> <?php echo $_smarty_tpl->tpl_vars['rows']->value['file_name'];?>
 </b>
				<?php }else{ ?>
					<b><a href="common/downloader.php?file=<?php echo $_smarty_tpl->tpl_vars['rows']->value['file_path'];?>
<?php echo $_smarty_tpl->tpl_vars['rows']->value['sub_file_name'];?>
"  style='font-size:12px;text-decoration:none;color:black;' title="File name : <?php echo $_smarty_tpl->tpl_vars['rows']->value['sub_file_name'];?>
"><img src="images/<?php echo $_smarty_tpl->tpl_vars['rows']->value['file_info']['image'];?>
" border="0"/> <?php echo $_smarty_tpl->tpl_vars['rows']->value['file_name'];?>
 </a></b>
				<?php }?>
			</td>
			<td onclick="File_manager.execCheckRow('<?php echo $_smarty_tpl->tpl_vars['rows']->value['file_name'];?>
')"  ondblclick="File_manager.execUncheckRow('<?php echo $_smarty_tpl->tpl_vars['rows']->value['file_name'];?>
')" class="table_subtitle"><i><?php echo $_smarty_tpl->tpl_vars['rows']->value['date_modified'];?>
</i></td>
			<td  onclick="File_manager.execCheckRow('<?php echo $_smarty_tpl->tpl_vars['rows']->value['file_name'];?>
')"  ondblclick="File_manager.execUncheckRow('<?php echo $_smarty_tpl->tpl_vars['rows']->value['file_name'];?>
')"><?php echo $_smarty_tpl->tpl_vars['rows']->value['file_info']['file_type'];?>
</td>				
			<td  onclick="File_manager.execCheckRow('<?php echo $_smarty_tpl->tpl_vars['rows']->value['file_name'];?>
')"  ondblclick="File_manager.execUncheckRow('<?php echo $_smarty_tpl->tpl_vars['rows']->value['file_name'];?>
')"><?php echo $_smarty_tpl->tpl_vars['rows']->value['size'];?>
</td>	
		</tr>
	<?php }} ?>	

<?php }?>

<script type="text/javascript">
	//<![CDATA[
		$(function(){
			var totalCount = $("#total_count");
			totalCount.empty();
			totalCount.append(<?php echo $_smarty_tpl->getVariable('iTotalFiles')->value;?>
);
			$("#sort_order").remove()
			$("body").append("<input type=\"hidden\" value='<?php echo $_smarty_tpl->getVariable('sSortOrder')->value;?>
' id=\"sort_order\" />");
		})
	//]]>
</script>
