<?php

$docRoot = $_SERVER['DOCUMENT_ROOT'];
require_once ( $docRoot . '/Smarty/libs/Smarty.class.php');
require_once ( $docRoot . '/filemanager/utility/execute.class.php');
require_once ( $docRoot . '/filemanager/common/common.function.php');

/*
 * Class File Manager
 */
 
class File_manager
{
	private $_oSmarty;
	private $_oExecHelper;
	private $_tplFolder;
	
	/**
     * Class constructor
     * return void
	 */ 
	public function __construct()
	{
		$this->_oExecHelper = new Execute_helper();	
		$this->_oSmarty = new Smarty();
		$this->_tplFolder = 'templates/';
		$this->_initUIEnvironment();
		$this->_requestHandler();
	}
	
	/**
	 * _initUIEnvironment | Initialize default variables
	 * @access private
	 * @var object
	 */
	private function _initUIEnvironment()
	{
		$this->_oSmarty->assign( 'mainCss', 'css/plugin.css' );
		$this->_oSmarty->assign( 'images', 'images/' );
		$this->_oSmarty->assign( 'pageTitle' , 'File Manager | Linux');
		$this->_oSmarty->assign( 'sModuleTitle' , 'Linux File Manager');
		$this->_oSmarty->assign( 'sSortOrder' , ( getVar('sortOrder')=='desc') ? 'asc' : 'desc');
		$this->_oSmarty->assign( 'sFilePath' , '');
	}
	
	private function _initUI()
	{
		/** Initialize page. **/
		$this->_oSmarty->assign('sCurrentPath',$this->_execCurrentPath());
		$indexHeader = $this->_oSmarty->fetch( $this->_tplFolder . 'index-header.tpl');
		$indexBody = $this->_oSmarty->fetch( $this->_tplFolder . 'index-body.tpl');
		$indexFooter = $this->_oSmarty->fetch( $this->_tplFolder . 'index-footer.tpl');

		/** Fetch page content(HTML). **/
		$this->_oSmarty->assign( 'indexHeader' , $indexHeader);
		$this->_oSmarty->assign( 'indexBody' , $indexBody);
		$this->_oSmarty->assign( 'indexFooter' , $indexFooter);
		$this->_oSmarty->display( $this->_tplFolder . 'index.tpl' );
	}
	
	private function _execFileList()
	{
		$aResult = $this->_oExecHelper->execFileList();
		( getVar('order')=='desc' ) ? @krsort( $aResult['aDisplayList'] ) : @ksort( $aResult['aDisplayList'] );
		$this->_oSmarty->assign( 'sSortOrder' , ( getVar('order')=='desc') ? 'asc' : 'desc');		
		$this->_oSmarty->assign('aResult',$aResult['aDisplayList']);
		$this->_oSmarty->assign('iTotalFiles',$aResult['total_files']);
		$this->_oSmarty->display($this->_tplFolder . 'index-list.tpl');
	}
	
	private function _requestHandler()
	{
		switch(getVar('requestType'))
		{
			case 'list': $this->_execFileList();
			break;
			
			case 'create':$this->_execCreate();
			break;			
			
			case 'save': $this->_execSave();
			break;

			case 'savetextfile': $this->_execSaveTextFile();
			break;			
			
			case 'uploadform': $this->_execUploadForm();
			break;
			
			case 'uploadarea': $this->_execUploadArea();
			break;			
			
			case 'doupload': $this->_execFileUpload();
			break;		
			
			case 'folderlist': $this->_execFolderList();
			break;	
			
			case 'view':$this->_execView();
			break;		
			
			case 'delete': $this->_execDelete();
			break;				

			case 'backupform': $this->_execBackupForm();
			break;				

			case 'backupfiles': $this->_execBackupFiles();
			break;	
			
			case 'copymove': $this->_execCopyMove();
			break;	
			
			case 'allfolder': $this->_execAllFolder();
			break;
			
			case 'backuplist': $this->_execBackupList();
			break;				
			
			default: $this->_initUI();
		}
	}
	
	private function _execCurrentPath()
	{
		$aResult = $this->_oExecHelper->exec('pwd');
		return str_replace ( '/' ,' &raquo; ' ,$aResult[0]);
	}
	
	private function _execCreate()
	{
		$this->_oSmarty->display($this->_tplFolder . 'index-create.tpl');
	}
	
	private function _execFileUpload()
	{
		$this->_oExecHelper->execFileUpload();
	}
	
	private function _execUploadForm()
	{
		$this->_oSmarty->display($this->_tplFolder . 'index-upload-area.tpl');
	}
	
	private function _execUploadArea()
	{
		$this->_oSmarty->assign('result',getVar('result'));
		$this->_oSmarty->assign('path',getVar('path'));
		$this->_oSmarty->display($this->_tplFolder . 'index-upload-form.tpl');
	}

	private function _execSave()
	{
		$this->_oExecHelper->execSave();
	}

	private function _execSaveTextFile()
	{
		$this->_oExecHelper->execSaveTextFile();
	}
	
	private function _execDelete()
	{
		$this->_oExecHelper->execDelete();	
	}
	
	private function _execView()
	{
		$aFileInfo['file_extension'] = $this->_oExecHelper->execCheckFile();
		
		switch($aFileInfo['file_extension'])
		{
			case'txt':
				$this->_oSmarty->assign('sTextFileContent',$this->_oExecHelper->execOpenFileContent());
			break;
			
			case'jpg':
				$this->_oSmarty->assign('sImage',getVar('fileName'));
			break;
					
		}
		if($aFileInfo['file_extension']=='d' || $aFileInfo['file_extension']=='')
		{
			echo'directory';
		}
		elseif($aFileInfo['file_extension']=='txt' || $aFileInfo['file_extension']=='jpg')
		{
			$this->_oSmarty->assign('sFileExtension',$aFileInfo['file_extension']);
			$this->_oSmarty->assign('sFileName',getVar('fileName'));
			$this->_oSmarty->display($this->_tplFolder . 'index-view.tpl');
		}
	}
	
	private function _execFolderList()
	{	
		$this->_oSmarty->assign('actionType',ucwords(getVar('action_type')));
		$this->_oSmarty->display($this->_tplFolder . 'index-folder.tpl');	
	}
	
	private function _execAllFolder()
	{
		$aFolderList = $this->_oExecHelper->execDirectoryList();
		$this->_oSmarty->assign('aFolderList',$aFolderList['folder_list']);
		$this->_oSmarty->assign('hasFolder',$aFolderList['has_folder']);
		$this->_oSmarty->assign('hasBack',$aFolderList['has_back']);
		$this->_oSmarty->assign('actionType',ucwords($aFolderList['action_type']));
		$this->_oSmarty->display($this->_tplFolder . 'index-folder-list.tpl');	
	}
	
	private function _execCopyMove()
	{
		$this->_oExecHelper->execCopyMove();
	}
	
	private function _execBackupForm()
	{
		$this->_oSmarty->display($this->_tplFolder . 'index-backup-form.tpl');	
	}
	
	private function _execBackupFiles()
	{
		$aLogs = $this->_oExecHelper->execBackupFiles();
		$sLogs = '';
		$sLogs .="Start back up..\n";
		
		foreach($aLogs as $val)
		{
			$sLogs .= $val . "\n";
		}
		
		$sLogName = "backup_log_" . date('Y-m-d-H-i-s');
		$aResult = $this->_oExecHelper->exec("touch 'logs/$sLogName.txt' | echo '$sLogs' > 'logs/$sLogName.txt'");
		echo $sLogs;
	}
	
	private function _execBackupList()
	{
		$aBackupList = $this->_oExecHelper->execBackupList();
		$this->_oSmarty->assign('aBackupList',$aBackupList['aDisplayList']);
		$this->_oSmarty->display($this->_tplFolder . 'index-backup-list.tpl');	
	}
}

/** File manager object instantiation. **/
$ofileManager = new File_manager();
