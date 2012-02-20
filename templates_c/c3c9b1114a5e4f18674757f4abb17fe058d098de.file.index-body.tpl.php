<?php /* Smarty version Smarty-3.0.8, created on 2011-09-23 07:28:31
         compiled from "templates/index-body.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19531010514e7bc49fa428a0-08554058%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c3c9b1114a5e4f18674757f4abb17fe058d098de' => 
    array (
      0 => 'templates/index-body.tpl',
      1 => 1316734105,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19531010514e7bc49fa428a0-08554058',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<br />
<h2><h2 onClick="File_manager.execRefresh(); return false" style="cursor:pointer" title="<?php echo $_smarty_tpl->getVariable('sModuleTitle')->value;?>
"><?php echo $_smarty_tpl->getVariable('sModuleTitle')->value;?>
</h2><br />
<b>Current Directory : <span id="current-directory" style="color:black;font-size:13px"><?php echo $_smarty_tpl->getVariable('sCurrentPath')->value;?>
  »  <a href="#" style="text-decoration:none" onclick="File_manager.execRefresh();" title="files">files » </a> <b id="extended-path"> </b></span></b><br /><br />
<b >Total File : <span id="total_count" style="color:red" title="Total Files"></span></b> 
<br />
<br />
<span id="status-area">
</span>
<table border="1" cellpadding="0" cellspacing="0" class="table_hor_02">
<colgroup>
	<col width="15px" />
	<col width="200px"/>
	<col width="120px"/>
	<col width="120px"/>			
	<col width="120px"/>
</colgroup>
<thead>			
<tr>
	<th class="chk"><input type="checkbox" title="Select all File and Folder" class="input_chk" id="select-all" onMouseOver="File_manager.execSelectAll()" /></th>
	<th><a id="filename" href="#" onClick="File_manager.execFileSort('X','desc',this.id)"  class="asc" title="File name">File Name</a></th>
	<th><a id="date" href="#" onClick="File_manager.execFileSort('t','desc',this.id)" class="asc"  title="Date Modified">Date Modified</a></th>				
	<th><label style="color:black" title="File Type">File Type</label></th>		
	<th><a id="size" href="#" onClick="File_manager.execFileSort('S','desc',this.id)" class="asc" title="File Size">File Size</a></th>	
</tr>
</thead>
<tbody id="content-body">
</tbody>
</table>
<br />
<table>
<tr>
	<td><input type="text" title="Search Box" size="49" style="border:solid 1px #CCCCCC;background-color:whitesmoke" name="search-keyword" id="search-keyword" /></td>
	<td>&nbsp;<input type="button" onClick="File_manager.execSearch();" class="input" value="Search" title="Search"/></td>
</tr>
</table>

<br />
<table cellpadding="5" cellspacing="5">
	<tr>
		<td><input type="button" title="Delete" value="Delete" name="delete-btn" id="delete-btn" onClick="File_manager.execDelete()"/></td>
		<td><input type="button" title="Copy" value="Copy" name="copy-btn" id="copy-btn" onclick="File_manager.execFolderList('copy');" /></td>
		<td><input type="button" title="Move" value="Move" name="move-btn" id="move-btn" onclick="File_manager.execFolderList('move');"/></td>
		<td><input type="button" title="Create" value="Create" onclick="File_manager.execCreate(); return false"></td>
		<td><input type="button" title="Upload" value="Upload"  onclick="File_manager.execFileUpload(); return false"></td>
		<td><input type="button" title="Backup" value="Backup" onClick="File_manager.execBackupForm()"></td>
	</tr>
</table>
