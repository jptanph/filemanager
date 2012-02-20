<?php /* Smarty version Smarty-3.0.8, created on 2011-09-14 12:39:42
         compiled from "templates/index-upload-form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1223057064e70300e447864-37323738%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0250bcf1c0b37069cd70581dd33437f5677e5dfa' => 
    array (
      0 => 'templates/index-upload-form.tpl',
      1 => 1315975177,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1223057064e70300e447864-37323738',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<form action="index.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="requestType" value="doupload">
<input type="hidden" name="path" id="path" value="asdfasdf"/>
<input id="uploadResult" type="hidden" value="<?php echo $_smarty_tpl->getVariable('result')->value;?>
" />
<input id="uploadFilename" type="hidden" value="" />
<input id="uploadFilepath" type="hidden" value="" />
<center><input id="filetoupload" type="file" name="filetoupload" style="font-size: 12px"/></center>
</form>