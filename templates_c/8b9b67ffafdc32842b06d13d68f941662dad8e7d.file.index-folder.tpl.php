<?php /* Smarty version Smarty-3.0.8, created on 2011-09-20 19:23:35
         compiled from "templates/index-folder.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15427682194e7877b7d35d68-43903340%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8b9b67ffafdc32842b06d13d68f941662dad8e7d' => 
    array (
      0 => 'templates/index-folder.tpl',
      1 => 1316517811,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15427682194e7877b7d35d68-43903340',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div style="margin:1px;" align="center">
<br />
	<table border="1" cellpadding="0" cellspacing="0" class="table_hor_02">
	<colgroup>
		<col width="150px"/>		
		<col width="100px"/>
		<col width="100px"/>
	</colgroup>
	<thead>			
	<tr>
		<th><label>Directory Name</label></th>
		<th><label>Date</label></th>	
		<th><label>Size</label></th>	
	</tr>
	</thead>
	<tbody id="folder-list">
	</tbody>
	</table>
</div>
<br />

<div style="margin:18px">
	<span style="font-size:11px"><b style="color:black">Note : </b><i>Please add "/" after each directory you typed.</i><br /><br />Path here : </span><input type="text" style="border:solid 1px #CCCCCC;background-color:whitesmoke" onKeyUp="File_manager.execSearchPath()" name="search-path" id="search-path" size="30" /><br /><br />
	<center>
		<input type="button" onClick="File_manager.execCopyMove();" value="Submit" id="backup-btn"/>
		<input type="button" value="Close" onClick="File_manager.execClose('folder-dialog')"/>
	</center>
</div>
<script type="text/javascript">
	//<![CDATA[
	 $(function(){
		$("#folder-dialog").dialog({	
			width:'420',
			modal:true,
			position:'center',
			beforeClose : function(){
				//pathList.splice(0,pathList.length)
			}
		});
		
		$("#search-path").focus()
		$("input:button").button().css('font-size','11px');
		$("#default_action").text("<?php echo $_smarty_tpl->getVariable('actionType')->value;?>
")
		File_manager.execAllFolder();
		
	 })
	//]]>
</script>
