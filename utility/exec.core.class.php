<?php
/*
 * Exec helper class
 * @return array values
 */

class Exec_core
{
	private $_sCommand;
	
	public function __construct(){/** Just construct it. :)**/}
	
	public function execCommand($sCommand)
	{
		$this->_sCommand = $sCommand;
		return $this->_execCore();	
	}
	
	private function _execCore()
	{
		exec( $this->_sCommand , $aResult);
		return $aResult;
	}
	
	public function __destruct()
	{
		unset($this->sCommand);
	}
}

/**
 * End class Exec Helper
 */