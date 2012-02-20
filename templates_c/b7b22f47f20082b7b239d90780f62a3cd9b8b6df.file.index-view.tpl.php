<?php /* Smarty version Smarty-3.0.8, created on 2011-09-20 12:02:11
         compiled from "templates/index-view.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8048582254e7810431dacb3-32357465%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b7b22f47f20082b7b239d90780f62a3cd9b8b6df' => 
    array (
      0 => 'templates/index-view.tpl',
      1 => 1316491329,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8048582254e7810431dacb3-32357465',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_smarty_tpl->getVariable('sFileExtension')->value=='txt'){?>
<table border="0" align="center" style="margin:3px">
<tr>
	<td>
		<textarea rows="15" id="text-content" cols="59" id="text-content" style="border:solid 1px gray;background-color:whitesmoke;color:black;"><?php echo $_smarty_tpl->getVariable('sTextFileContent')->value;?>
</textarea>
		<input type="hidden" name="file-name" value="<?php echo $_smarty_tpl->getVariable('sFileName')->value;?>
" id="file-name" />
	</td>
</tr>
<tr>
	<td align="center">
		<br />
		<input type="button" value="Save" onClick="File_manager.execSaveTextFile()"/> <input type="button" value="Close" onClick="File_manager.execClose('view-dialog')"/>

	</td>
</tr>
</table>
<?php }elseif($_smarty_tpl->getVariable('sFileExtension')->value=='jpg'){?>
	<div style="margin:9px;border:solid 9px whitesmoke;display:none" align="center" id="image-canvass">
		<img src="files/<?php echo $_smarty_tpl->getVariable('sImage')->value;?>
" width="100%" align="center" title="<?php echo $_smarty_tpl->getVariable('sFileName')->value;?>
"/>
	</div>
	
	<center>
		<input type="button" value="Close" onClick="File_manager.execClose('view-dialog')"/>
	</center>
<?php }?>

<script type="text/javascript">
	//<![CDATA[
	 $(function(){
		$("#view-dialog").dialog({				
			height:<?php if ($_smarty_tpl->getVariable('sFileExtension')->value=='txt'){?>'380'<?php }else{ ?>'450'<?php }?>,
			width:'498px',
			modal:true
		})
		
		$("#image-canvass").fadeIn(4500)
		$("input:button").button().css('font-size','11px');
	 })
	//]]>
</script>
