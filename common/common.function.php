<?php

function getVar( $sVarName ){

	$returnValue = '';
	
	$gVars = array_merge( $_POST , $_GET , $_REQUEST , $_FILES );
	
	if( array_key_exists ( $sVarName ,  $gVars) && isset ( $gVars[ $sVarName ] ) )
	
		$returnValue = $gVars[$sVarName];

	else
	
		$returnValue = FALSE;
	
	return $returnValue;
}

function checkVar($var){
	echo "<pre>";
		var_dump($var);
	echo "</pre>";
}


function limitChar($str , $perStr)
{
	$countStr = strlen($str);
	$resultStr = '';
	
	if($countStr < $perStr){
		return $str;
	}else{
		for( $i = 0 ; $i < $perStr ; $i++ )
		{
			if( $i <= $perStr  )
			{
				$resultStr .= $str[$i];
			}
		}
		return $resultStr . '...';
	}
}

function sliceBracket($sStr)
{
	$sResult = str_replace('[','\[',$sStr);
	$sResult = str_replace(']','\]',$sResult);
	return $sResult;
}