<?php /* Smarty version Smarty-3.0.8, created on 2011-09-05 08:43:15
         compiled from "./templates/index-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7973534444e641b23598ed1-46216691%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '483fa4d57defd4ccce28a543f42432b4ea65cb48' => 
    array (
      0 => './templates/index-list.tpl',
      1 => 1315183364,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7973534444e641b23598ed1-46216691',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<!--
<?php  $_smarty_tpl->tpl_vars['rows'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('aResult')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['rows']->key => $_smarty_tpl->tpl_vars['rows']->value){
?>
	<tr onmouseover="this.className='over'" onmouseout="this.className=''">
		<td align='center'><input type="checkbox" title="" class="input_chk" /></td>
		<td><b style='font-size:12px;cursor:pointer'> <?php echo $_smarty_tpl->tpl_vars['rows']->value;?>
 </b></td>
		<td class="table_subtitle">&nbsp;</td>
		<td>&nbsp;</td>				
		<td>&nbsp;</td>	
	</tr>
<?php }} ?>	
-->