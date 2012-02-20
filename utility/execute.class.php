<?php

/**
 * Execute helper class
 * 
 * This page executes all the request of the page
 * 
 * @package    utility
 * @author    John Adrian Pevidal Tan <john@simplexi.com>
 */
require_once('exec.core.class.php');

/**
 * Execute helper class
 * This page executes all the request of the page
 * @package   utility
 * @author    John Adrian Pevidal Tan <john@simplexi.com>
 */
class Execute_helper
{
	/**
	 * $_oCoreHelper | Extends the class execute core
	 * @access private
	 * @var object
	 */
	private $_oCoreHelper;
	/**
	 * $_targetFolder | folder of templates for smarty
	 * @access private
	 * @var string
	 */
	private $_targetFolder;

	/**
	 * class constructor
	 * constructor
	 * @author John Adrian Pevidal Tan <john@simplexi.com>
	 * @access public
	 */
	public function __construct()
	{
		$this->_oExecCore = new Exec_core();
		$this->_sTargetFolder = 'files';
	}
	
	/**
	 * execFileList($oPath = '')
	 * display list of file and directories 
	 * @access public
	 * @param datatype $oPath = 'path_here/foo/'
	 * @return array
	 */	
	public function execFileList($oPath = '')
	{
		$aResult = array();
		$otherPath = ($oPath=='') ? $this->_sTargetFolder : $oPath;
		$aDirectory = array('image'=>'folder.gif','file_type'=>'File Folder');
		$sSort = ( getVar('sort')=='' ) ? '-t' : '-'.getVar('sort');
		$searchKeyword = ( getVar('search')=='' ) ? '' :  " | grep -i '".getVar('search')."'";
		$listDirectory = ( getVar('directory')=='' ) ? '' :  getVar('directory');
		$sRequestPath = ( getVar('requestPath')=='' ) ? '' :  '';
		
		$aList = $this->_oExecCore->execCommand("ls $sSort '$otherPath/$listDirectory' $searchKeyword");
		$pathName = (getVar('pathName')=='') ? '' : getVar('pathName');

		foreach($aList as $val)
		{
			$aDetails = $this->_oExecCore->execCommand("ls -l '$otherPath/$listDirectory' | grep -w '".sliceBracket($val)."'");			
			$aFileInfo['file_info'] = $this->_execCheckFile($val);
		
			foreach($aDetails as $sDetails)
			{
				$aResultInfo = preg_split('/ / ',$sDetails,-1, PREG_SPLIT_NO_EMPTY);
				$bIsDirectory = substr($aResultInfo[0],0,1);
			}
			
			$aFileList[] = array("file_name"=>limitChar($val,30),
				"sub_file_name"=>$val,
				"date_modified"=>$aResultInfo[5] . ' ' . $aResultInfo[6] . ' ' .$aResultInfo[7],
				"file_info"=>( $bIsDirectory=='d' ) ? $aDirectory : $aFileInfo['file_info'],
				"size"=>$aResultInfo[4]. ' kb',
				"file_type"=>$this->execCheckFile($val),
				"file_path"=>$pathName
			);
		}		
		$aResult['total_files'] = $this->_execCountFiles();
		$aResult['aDisplayList'] = @$aFileList;
		
		return $aResult;
	}
	
	/**
	 * execCountFiles()s
	 * count the file and directories 
	 * @access private
	 * @param datatype none
	 * @return int
	 */		
	private function _execCountFiles()
	{	
		$searchKeyword = (getVar('search')=='') ? '' :  ' | grep -i '.getVar('search');
		$fileName= (getVar('directory')=='') ? '' :  getVar('directory');
		$aResult = $this->_oExecCore->execCommand("ls '$this->_sTargetFolder/$fileName' $searchKeyword | wc -l");
		return (int)$aResult[0];
	}

	/**
	 * exec
	 * execute internal command
	 * @access public
	 * @param datatype $sCommand = "'ls -al | grep -w 'foo'";
	 * @return array
	 */			
	public function exec($sCommand)
	{
		return $this->_oExecCore->execCommand($sCommand);	
	}

	/**
	 * execSave()
	 * save the created file or folders on the specific path
	 * @access public
	 * @param datatype none
	 * @return string (Exists or not Exists)
	 */		
	public function execSave()
	{
		if(getVar('fileType')=='folder')
		{
			$isExist = $this->_oExecCore->execCommand("[ -d '$this->_sTargetFolder/" . trim(getVar('fileName')) . "' ] && echo 'Exist' || echo 'Not Exists'");				
			
			if($isExist[0]=='Not Exists')
			{	
				$this->_oExecCore->execCommand("mkdir '$this->_sTargetFolder/".getVar('fileName') . "' ");
			}
		}
		else
		{
			$isExist = $this->_oExecCore->execCommand("[ -f '$this->_sTargetFolder/" . trim(getVar('fileName')) . ".txt' ] && echo 'Exist' || echo 'Not Exists'");				
			if($isExist[0]=='Not Exists')
			{	
				$this->_oExecCore->execCommand("touch '$this->_sTargetFolder/".getVar('fileName').".txt'");
			}		
		}
		echo $isExist[0];
	}
	
	/**
	 * execDelete()
	 * delete file or folders on the specific path
	 * @access public
	 * @param datatype none
	 * @return none
	 */		
	public function execDelete()
	{	
		$sDelete = ( $this->execCheckFile() == 'd' ) ? "rm -rf '$this->_sTargetFolder/" . getVar('fileName') . "' " : "rm -rf '$this->_sTargetFolder/" . getVar('fileName') . "' ";
		$this->_oExecCore->execCommand( $sDelete );		
	}
	
	/**
	 * execCheckFile()
	 * check the file extension
	 * @access public
	 * @param datatype $fileName = "foo.txt"
	 * @return array
	 */			
	public function execCheckFile( $fileName = '' )
	{
		$sFileName = ( $fileName == '' ) ? getVar('fileName') : $fileName;
		$aFileInfo = $this->_execCheckFile($sFileName);
		$sFileType = '';
		
		if( empty( $aFileInfo['file_extension'] ) )
		{
			$aDirectory = $this->_oExecCore->execCommand("ls -al '$this->_sTargetFolder/".getVar('fileName') . "'");
			
			if( !isset( $aDirectory[1] ) )
			{
				$sFileType = '';
			}
			else
			{
				$sFileType = substr( $aDirectory[1],0,1 );	
			}
		}
		else
		{
			$sFileType = $aFileInfo['file_extension'];
		}
		
		return $sFileType;
	}
	
	/**
	 * _execCheckFile()
	 * check file's extension,image and file type
	 * @access public
	 * @param $sFileName = "foo.txt"
	 * @return array
	 */		
	private function _execCheckFile($sFileName)
	{
		$aFile = array();
		$sFile = strtolower( pathInfo ( $sFileName,PATHINFO_EXTENSION ) );
		$sImage = '';
		$sFileType = '';
		
		switch($sFile)
		{
			case'txt':
				$sImage = 'txt.gif';
				$sFileType = 'Text Document';
			break;

			case'sql':
				$sImage = 'sql.png';
				$sFileType = 'SQL File';
			break;
			
			case'exe':
				$sImage = 'exe.gif';
				$sFileType = 'Executable File';				
			break;
			
			case'jpg':
				$sImage = 'img.gif';
				$sFileType = 'JPEG Image';				
			break;

			case'png':
				$sImage = 'png.png';
				$sFileType = 'PNG Image';				
			break;
			
			case'zip':
				$sImage = 'rar.bmp';
				$sFileType = 'Compressed File(ZIP)';				
			break;

			case'rar':
				$sImage = 'rar.bmp';
				$sFileType = 'Compressed File(RAR)';				
			break;
			
			case'docx':
				$sImage = 'word.gif';
				$sFileType = 'Word File';				
			break;
			
			case'doc':
				$sImage = 'word.gif';
				$sFileType = 'Word File';				
			break;			

			case'pdf':
				$sImage = 'pdf.gif';
				$sFileType = 'PDF File';				
			break;
			
			case'js':
				$sImage = 'js.png';
				$sFileType = 'Javascript File';				
			break;
			
			case'html' :
				$sImage = 'html.png';
				$sFileType = 'HTML File';				
			break;

			case'htm' :
				$sImage = 'html.png';
				$sFileType = 'HTML File';				
			break;
			
			case'php':
				$sImage = 'php.png';
				$sFileType = 'PHP File';				
			break;

			case'gif':
				$sImage = 'gif.png';
				$sFileType = 'GIF File';				
			break;			
			
			case'css':
				$sImage = 'css.png';
				$sFileType = 'CSS File';				
			break;

			case'wmv':
				$sImage = 'wmv.png';
				$sFileType = 'WMV File';				
			break;
			
			case'xls':
				$sImage = 'excel.gif';
				$sFileType = 'Microsoft Excel File';				
			break;
			
			case'xlsx':
				$sImage = 'excel.gif';
				$sFileType = 'Microsoft Excel File';				
			break;
			
			default:
				$sImage = 'etc.gif';
				$sFileType = 'Other File';
		}
		
		$aFile['image'] = $sImage;
		$aFile['file_type'] = $sFileType;
		$aFile['file_extension'] = $sFile;
		
		return $aFile;
	}
	
	/**
	 * execFileUpload()
	 * upload files on the specific path
	 * @access public
	 * @param datatype none
	 * @return none
	 */			
	public function execFileUpload()
	{		
		$error = "";
		$msg = "";
		$sFileName = preg_replace("/\\.[^.\\s]{3,4}$/", "",$_FILES['fileToUpload']['name']);
		$sFileExtension = '.' . $this->execCheckFile($_FILES['fileToUpload']['name']);
		$sFilePathName = $sFileName . substr(md5(time()), 0, 16) . $sFileExtension;
		$sPath = (getVar('pathName')=='') ? '' : getVar('pathName');
		
		if(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
		{
			$error = 'No file was uploaded..';
		}
		else 
		{
			$msg .= " File Name: " . $_FILES['fileToUpload']['name'] . ", ";
			$msg .= " File Size: " . @filesize($_FILES['fileToUpload']['tmp_name']);
			move_uploaded_file($_FILES['fileToUpload']['tmp_name'], "files/$sPath$sFilePathName");
		}		
		echo "{";
		echo				"error: '" . $error . "',\n";
		echo				"msg: '" . $msg . "'\n";
		echo "}";
	}
	
	/**
	 * execSaveTextFile()
	 * save text document file only
	 * @access public
	 * @param datatype none
	 * @return none
	 */			
	public function execSaveTextFile()
	{
		$this->_oExecCore->execCommand("echo '".getVar('textContent')."' >  '$this->_sTargetFolder/".getVar('fileName')."'");
	}

	/**
	 * execOpenFileContent
	 * open the text document file contents
	 * @access public
	 * @param datatype none
	 * @return string
	 */			
	public function execOpenFileContent()
	{
		$aFileContent = $this->_oExecCore->execCommand("cat '$this->_sTargetFolder/".getVar('fileName')."'");
		$sContent = '';
		
		foreach($aFileContent as $val)
		{
			$sContent .= $val;
		}
		return $sContent;
	}

	/**
	 * execDirectoryList()
	 * display only the list of directories
	 * @access public
	 * @param datatype none
	 * @return array
	 */			
	public function execDirectoryList()
	{
		$searchPath = (getVar('searchPath')=='') ? '' : getVar('searchPath');
		$aHasContent = $this->_oExecCore->execCommand("ls -alt 'files/$searchPath' | grep '^d'");
		$aDirectoryList = $this->_oExecCore->execCommand("ls -lt 'files/$searchPath' | grep '^d'");
		$aDirectoryResult = array();
		$aResult = array();
		$sFileName = '';
		
		foreach($aDirectoryList as $key=>$sDirectory)
		{	
			$aResultDirectory = preg_split('/ / ',$sDirectory,-1, PREG_SPLIT_NO_EMPTY);
			$sFileConcat = '';		
			
			if( count( $aResultDirectory ) > 9 )
			{
				for( $i = 8 ; $i <= ( count ( $aResultDirectory ) - 1 ) ; $i++ )
				{
					$sFileConcat .= ' ' . $aResultDirectory[$i];
				}	
				$sFileName = $sFileConcat;
			}
			else
			{
				$sFileName = $aResultDirectory[8];
			}
			
			$aDirectoryResult[] = array("directory_name"=>$sFileName,"directory_size"=>$aResultDirectory[4],"date"=>$aResultDirectory[5] . ' ' . $aResultDirectory[6] . ' ' . $aResultDirectory[7]);
		}
		
		$aResult['has_folder'] = count($aHasContent);
		$aResult['folder_list'] = $aDirectoryResult;
		$aResult['has_back'] = $searchPath;
		$aResult['action_type'] = getVar('actionType');
		return $aResult;
	}
	
	/**
	 * execCopyMove()
	 * copy or move the file to the specific path
	 * @access public
	 * @param datatype none
	 * @return none
	 */			
	public function execCopyMove()
	{	
		if(getVar('actionType')=='copy')
		{
			$this->_oExecCore->execCommand("cp -R 'files/".getVar('fileName')."' 'files/".getVar('searchPath')."'");
		}
		else
		{
			$this->_oExecCore->execCommand("mv 'files/".getVar('fileName')."' 'files/".getVar('searchPath')."'");
		}
	}

	/**
	 * execBackupFiles()
	 * backup the files and directories and send it to the specific domain by using shell script
	 * @access public
	 * @param datatype none
	 * @return none
	 */			
	public function execBackupFiles()
	{
		return $this->_oExecCore->execCommand("/home/john/public_html/filemanager/sh/backup_processor.sh");
	}
	
	/**
	 * execBackupList()
	 * display list of backups 
	 * @access public
	 * @param datatype none
	 * @return array
	 */			
	public function execBackupList()
	{
		return $this->execFileList('file_backup');
	}
}
/** End class execute helper. **/