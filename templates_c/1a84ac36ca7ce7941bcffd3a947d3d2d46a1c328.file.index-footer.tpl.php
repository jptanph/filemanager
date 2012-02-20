<?php /* Smarty version Smarty-3.0.8, created on 2011-09-20 12:46:38
         compiled from "templates/index-footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8172520314e781aae7a28c3-23258132%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a84ac36ca7ce7941bcffd3a947d3d2d46a1c328' => 
    array (
      0 => 'templates/index-footer.tpl',
      1 => 1316493888,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8172520314e781aae7a28c3-23258132',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<input type="hidden" value="<?php echo $_smarty_tpl->getVariable('sFilePath')->value;?>
" name="file_path" id="file_path"/>
<script type="text/javascript">
	/** Function will send a request (list) when the page is loaded successfully. **/
	File_manager.execFileList();
</script>
</body>
</html>