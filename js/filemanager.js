/** 
  * File Manager Proto type
  */
  
var path = [];
var pathList = [];
var searchWord = '';

var File_manager = {

	sServerUrl : 'index.php'
	
	,execFileList : function(path,keyword){
	
		var contentBody = $("#content-body");
		var search = (keyword =='') ? '' : keyword;
		var directory = (path =='') ? '' : path;
		var file_path = $("#file_path").val();
		contentBody.empty();
		
		$("#select-all").removeAttr("checked")
		$("input:button").button().css('font-size','11px');
		$('#search-keyword').focus();
		$("#content-body").append("<tr id=\"loader\"><td colspan=\"5\" valign=\"middle\"><br /><center><img src=\"images/ajax-loader.gif\" border=\"0\" /><br /><br /><b>Loading files.. Please wait..</b></center><br /></td></tr>")

		$.ajax({
			type:'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'list',
				search : search,
				directory : directory,
				pathName : file_path
			},success : function(requestContent){
				$("#loader").remove();
				contentBody.html(requestContent);
			}
		})
	
	},execFileSort: function(sortType,sortOrderType,sortId){
	
		var sortList = ['filename','date','size'];
		
		$("#content-body").empty();
		var contentBody = $("#content-body");
		var sortOrder = $("#sort_order").val();
		var search = ( searchWord == '' ) ? '' : searchWord;
		var file_path = $("#file_path").val();
		$("#content-body").append("<tr id=\"loader\"><td colspan=\"5\" valign=\"middle\"><br /><center><img src=\"images/ajax-loader.gif\" border=\"0\" /><br /><br /><b>Sorting files.. Please wait..</b></center><br /></td></tr>")
		var sortOrder = ($("#sort_order").val()=='') ? sortOrderType : $("#sort_order").val()
		
		for(i = 0 ; i < sortList.length ; i++)
		{
			if(sortId == sortList[i])
			{
				$("#"+sortList[i]).attr("class",sortOrder)
			}
			else
			{
				$("#"+sortList[i]).attr("class",'asc')	
			}
		}	
		$.ajax({
			type:'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'list',
				sort : sortType,
				order : sortOrder,
				directory : file_path,
				search : search
				
			},success : function(requestContent){
				$("#loader").remove();
				contentBody.html(requestContent);			
			}
		})

	},execCreate : function(){
	
		$("#create-dialog").remove();	
		$("body").append("<div id=\"create-dialog\" title=\"Create File\"></div>");
		
		$.ajax({
			type:'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'create'
				
			},success : function(requestContent){
				$("#create-dialog").html(requestContent)
			}
		})		
		
	},execSaveFile : function(){
		
		var file_type = $("input[name=file_type]:checked").val();
		var file_name = $("#file_name").val();
		var file_path = $("#file_path").val();
		
		if($.trim(file_name)==''){
			$("#file_name").css("border","solid 1px red").effect("pulsate", { times:3 }, 800);
			
		}else{
	
			$.ajax({
				type:'POST',
				url : this.sServerUrl,
				data : {
					requestType : 'save',		
					fileType : file_type,
					fileName : $.trim(file_path+""+file_name)
				},success : function(requestContent){
					
					if(requestContent=='Not Exists'){
						File_manager.execStatus(file_name+" has been save successfully!",'ok');
						File_manager.execClose("create-dialog");
						File_manager.execFileList(file_path,'');
					}else{
						File_manager.execStatus("File name already exist. Please provide other name. ",'error');
					}
				}
			})
			
		}
		
	},execSearch  : function(){
		
		var file_path = $("#file_path").val();
		searchWord = $('#search-keyword').val()

		if($.trim(searchWord)==''){
			File_manager.execStatus("Please enter the name of the file you want to search.",'error');
			$('#search-keyword').focus();
			return false;		
		}else{
			this.execFileList(file_path,searchWord)
		
		}
		
	},execFileUpload : function(){
		
		$("#upload-form").remove();
		$("body").append("<div id=\"upload-form\" title=\"Upload File\"></div>");
		$.ajax({
			type:'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'uploadform'
			},success : function(requestContent){
				$("#upload-form").html(requestContent)
			}
		})

	},execClose : function(divId){
		
		$('#'+divId).remove();

		if(divId=='folder-dialog'){
			pathList.splice(0,pathList.length)
		}
				
	
	},execSaveUpload : function(){
		
		var file_path = $("#file_path").val()
		
		if($.trim($("#fileToUpload").val())==''){
			
			File_manager.execStatus("Please select the a file you want to upload.",'error');
			return false;
		
		}else{
		
			$("#upload-area").hide();
			$("#uploader")
			.ajaxStart(function(){
				$(this).show();
			})
			.ajaxComplete(function(){
				$(this).hide();
			});
			

			$.ajaxFileUpload
			(
				{
					url:'index.php',
					secureuri:false,
					fileElementId:'fileToUpload',
					dataType: 'json',
					data:{ name:'logan', 
							id:'id',
							requestType : 'doupload',
							pathName : file_path
					},success: function (data, status){
					
						if(typeof(data.error) != 'undefined')
						{
							if(data.error != '')
							{
								File_manager.execStatus("There is an error in uploading.",'error');
								
							}else
							{
								File_manager.execStatus("File has been uploaded successfully.",'ok');
								File_manager.execFileList(file_path,'')		
								File_manager.execClose('upload-form')
							}
						}
					},
					error: function (data, status, e)
					{
						alert(e);
					}
				}
			)
			return false;
		}

	},execView : function(fileName,fileType){
	
		$("#view-dialog").remove();	
		$("body").append("<div id=\"view-dialog\" title=\"File Name : "+fileName+"\"></div>");
		searchWord = ''
		var tracePath = '';		
		
		( fileType=='d' ) ? path.push(fileName+"/") :'';

		for ( i = 0 ; i < path.length ; i++ )
		{
			tracePath += path[i];
		}
		
		$("#file_path").val(tracePath)

		$.ajax({
			type : 'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'view',
				fileName : $("#file_path").val()+""+fileName				
			},success : function(requestContent){
				
				( requestContent == 'directory' ) ? File_manager.execFileList($("#file_path").val(),'') : $("#view-dialog").html(requestContent);
				
				if( requestContent == 'directory' ){
					var filePath = $("#file_path");
					var exPath = '';
					var currentPath = '';

					$("#extended-path").empty()
					
					for ( i = 0 ; i < path.length ; i++ )
					{
						currentPath += path[i];
						repPath = path[i].replace( "/" , " » " );
						
						if( fileName+'/'==path[i] && tracePath==currentPath)
						{
							exPath += " <b style=\"cursor:pointer\" id='expath_"+ i +"'  onclick=\"File_manager.execFolderContent('"+currentPath+"')\">"+repPath+"</b> ";						
						}
						else
						{
							exPath += "<span id=\"dir"+i+"\"><b href=# style=\"cursor:pointer;text-decoration:none;color:#3c7cb4;\" id='expath_"+i+"' onclick=\"File_manager.execFolderContent('"+currentPath+"')\">"+repPath+"</b></span>";
						}
					}

					$("#extended-path").html(exPath);
				}
			}		
		})
		
	},execSelectAll : function(){
		
		$("#select-all").click(function(){
			var checked_status = this.checked;
			$("input[name=file_checkbox]").each(function(){
				this.checked = checked_status;
			});
		});
	
	},execSaveTextFile : function(){
		var text_content = $("#text-content");
		var file_name = $("#file-name");
		var file_path = $("#file_path").val();


		$.ajax({
			type : 'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'savetextfile',
				fileName : file_name.val(),
				textContent : text_content.val()
			},success : function(requestContent){

				File_manager.execFileList(file_path,'');
				File_manager.execStatus(file_name.val()+" has been updated successfully!",'ok');
				File_manager.execClose("view-dialog");
			}		
		})

	},execDelete : function(){
		
		var file_checkbox = $("input[name=file_checkbox]");
		var total_checked = file_checkbox.filter(':checked').length
		var file_path = $("#file_path").val();
		
		$("#select-all").removeAttr('checked');
		
		if(total_checked==0){
		
			File_manager.execStatus("There is no file to delete.",'error');			
		
		}else{
		
			$("input[name=file_checkbox]").each(function(){
				if($(this).is(':checked')==true){
					$.ajax({
						type : 'POST',
						url : this.sServerUrl,
						data : {
							requestType : 'delete',
							fileName : file_path+""+$(this).attr('value')
						},success : function(requestContent){
							File_manager.execStatus("Deleted successfully!",'ok');										
							File_manager.execFileList(file_path,'');
						}
					})
				}
			});	
		}
		
	},execStatus : function(message,msgType){
	
		var status_area = $("#status-area");
		var mType = ( msgType == 'ok') ? 'suc' : 'warn';
		status_area.empty();
		status_area.append("<div class=\"msg_"+mType+"_box\" style=\"display:none\" id=\"modify-status\"></div>");
		$("#modify-status").append("<p><span class=\"notification\" id=\"delete-notify\">"+message+"</span></p>")
							 .fadeIn(400)
							 .fadeOut(8000);
		
							 
	},execRefresh : function(){
	
		$("#select-all").click(function(){
			var checked_status = this.checked;
			$("input[name=file_checkbox]").each(function(){
				this.checked = false;
			});
		});
		var sortList = ['filename','date','size'];
		for(i = 0 ; i < sortList.length ; i++)
		{
			$("#"+sortList[i]).attr("class",'asc')	
		}
		
		$("#select-all").removeAttr("checked")
		$("#search-keyword").val('');
		$("#extended-path").empty();
		$("#file_path").val('')
		searchWord = '';
		path.splice(0,path.length)
		pathList.splice(0,pathList.length)
		this.execFileList();
		
		
	},execFolderList : function(action){	
	
		$("#action").remove();
		$("body").append("<input type=\"hidden\" id=\"action\" value='"+action+"'>");
		$("#folder-dialog").remove();
		
		var file_checkbox = $("input[name=file_checkbox]");		
		var total_checked = file_checkbox.filter(':checked').length
		var action_type = $("#action").val();
		

		if(total_checked==0){

			File_manager.execStatus("Please select the file you want to "+action+".",'error');	

		}else{		
		
			$("body").append("<div id=\"folder-dialog\" title=\"File Directory ("+action.toUpperCase()+") \"></div>");		
			$.ajax({
				type : 'POST',
				url : this.sServerUrl,
				data : {
					requestType : 'folderlist',
					action_type : action
				},success : function(requestContent){
					$("#folder-dialog").html(requestContent)
				}
			})
		}
	
	},execFolderContent : function(pathInfo){
	
		this.execTracePath(pathInfo);
		var content_body = $("#content-body")
		content_body.empty().append("<tr id=\"loader\"><td colspan=\"5\" valign=\"middle\"><br /><center><img src=\"images/ajax-loader.gif\" border=\"0\" /><br /><br /><b>Loading files.. Please wait..</b></center><br /></td></tr>")
	
		$.ajax({
			type : 'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'list',
				directory : pathInfo
				
			},success : function(requestContent){
				content_body.html(requestContent)
			}
		})		
		
	},execTracePath : function(pathInfo){
	
		/** Remove parent directory.**/
		var slice = pathInfo.split("/")
		var filePath = '';
		searchWord = ''
		for( i = 0 ; i < ( path.length ) ; i++ )
		{
			if( ( slice.length - 1 ) == i ){
				
				for( j = ( i - 1 ) ; j < path.length ; j++ )
				{	
					$("#expath_" + ( j ) ).css("color","black")
					$("#expath_" + ( j + 1) ).remove();

				}
				path.splice( ( i ) , path.length )					
				for(k = 0 ; k < path.length ; k ++ ){
					filePath += path[k];
				}
				$("#file_path").val(filePath)			
			}
		}		

	},execSearchPath : function(searchPath){
	
		var folder_list = $("#folder-list");	
		var search = $("#search-path").val();
		var searchSplit = search.split("/")
		
		folder_list.empty();
		$.ajax({
			type : 'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'allfolder',
				searchPath : search
			},success : function(requestContent){
				folder_list.html(requestContent);
			}
		})
		
	},execAllFolder : function(){
	
		var folder_list = $("#folder-list");		
		folder_list.empty();

		$("#folder-list").append("<tr id=\"loader-list\"><td colspan=\"2\" valign=\"middle\"><br /><center><img src=\"images/ajax-loader.gif\" border=\"0\" /><br /><br /><b>Loading files.. Please wait..</b></center><br /></td></tr>");
		$.ajax({
			type : 'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'allfolder'
			},success : function(requestContent){
				
				folder_list.html(requestContent)
				$("#loader-list").remove()
			}
		})
		
	},execCopyMove : function(){
		
		var search_path = $("#search-path").val()
		var file_path = $("#file_path").val()
		var action_type = $("#action").val();
		
		$("input[name=file_checkbox]").each(function(){
		
			if($(this).is(':checked')==true){
				$.ajax({
					type : 'POST',
					url : this.sServerUrl,
					data : {
						
						requestType : 'copymove',
						fileName : file_path+""+$(this).attr('value'),
						searchPath : search_path,
						actionType : action_type
						
					},success : function(requestContent){
						File_manager.execFileList(file_path,'');
						File_manager.execStatus("File has been "+((action_type=='copy') ? 'copied' : 'moved')+" successfully!",'ok');
						File_manager.execClose('folder-dialog')
					}
				})	
			}
			
		});
		
	},execShowFolder : function(folder){
		
		var tracePath = ''
		var search_path = $("#search-path").val()
		var folder_list = $("#folder-list");
		var action_type = $("#action").val();

		pathList.push(folder+'/');
		
		for( i = 0 ; i < pathList.length ; i++ )
		{
			tracePath+=$.trim(pathList[i]);
		}

		folder_list.empty();
		
		$.ajax({
			type : 'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'allfolder',
				searchPath : $.trim(tracePath),
				actionType : action_type
			},success : function(requestContent){
				folder_list.html(requestContent);
				$("#search-path").val($.trim(tracePath))
			}
		})
		
	},execBackList : function(){
		
		var tracePath = ''		
		var folder_list = $("#folder-list");	
		
		if(pathList.length>0)
		{
			pathList.splice( ( pathList.length-- ) ,( pathList.length-1 ) )	
		}

		for( i = 0 ; i < pathList.length ; i++ )
		{
			tracePath += $.trim(pathList[i]);
		}
		
		folder_list.empty();
		
		$.ajax({
			type : 'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'allfolder',
				searchPath : tracePath
			},success : function(requestContent){
				folder_list.html(requestContent);
				$("#search-path").val(tracePath)
			}
		})
		
		$("#search-path").val(tracePath)
		
	},execBackupForm : function(){
		
		var backup_form = $("#backup-form");
		backup_form.remove();
		
		$("body").append("<div title=\"Backup Files\" id=\"backup-form\"></div>");
		
		$.ajax({
			type : 'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'backupform'
			},success : function(requestContent){
				$("#backup-form").html(requestContent);		
			}
		})
	},execFileBackup : function(){
		$("#backup-confirm").hide();
		$("#backup-loader").show();
		$.ajax({
			type : 'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'backupfiles'
			},success : function(requestContent){
				$("#backup-log").val(requestContent)
				$("#backup-loader").hide();
				$("#backup-list").show();
				File_manager.execStatus("Files has been successfully backup!",'ok');
			}
		})
		
	},execCheckRow : function(value){
		$("input[value='"+value+"']").attr("checked",true)
	},execUncheckRow : function(value){
		$("input[value='"+value+"']").removeAttr("checked")
	
	},execBackupList : function(){
		var backup_list = $("#backup-list-form");
		backup_list.remove();
		
		$("body").append("<div title=\"Backup Files\" id=\"backup-list-form\"></div>");		
		$.ajax({
			type : 'POST',
			url : this.sServerUrl,
			data : {
				requestType : 'backuplist'
			},success : function(requestContent){
				$("#backup-list-form").html(requestContent)
			}
		})
	}
}