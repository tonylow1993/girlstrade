<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



if ( ! function_exists('ExceedDescLength'))
{
	function ExceedDescLength($message, $len)
	{
		$message=trim($message);
		if(empty($message) || strlen($message)==0)
			return true;
		if(mb_strlen($message, 'utf-8')>$len)
			return true;
		if(mb_strlen($message, 'utf-8')<DESCMINLENGTHINNEWPOST)
			return true;
		return false;
	}

}

if ( ! function_exists('ShortDescLength'))
{
	function ShortDescLength($message, $len)
	{
		$message=trim($message);
		if(empty($message) || strlen($message)==0)
			return true;
		if(mb_strlen($message, 'utf-8')<$len)
			return true;
		return false;
	}

}

if ( ! function_exists('trimLongText'))
{
	function trimLongText($message)
	{
		$message=str_replace(PHP_EOL,  ' ', $message);
		$message=str_replace("<br />",  ' ', $message);
		$message=preg_replace("/[\n\r]/",  ' ', $message);
	    $message=trim($message);
		if(mb_strlen($message, 'utf-8')>MAXLENGTHMSG_SHOWN_IN_TABLE)
		{
			$message=trim(substr($message,0,MAXLENGTHMSG_SHOWN_IN_TABLE))."...";
		}
		return $message;
	}
		
}
if ( ! function_exists('trimLongTextInViewAllComments'))
{
	function trimLongTextInViewAllComments($message)
	{
		$message=str_replace(PHP_EOL,  ' ', $message);
		$message=str_replace("<br />",  ' ', $message);
		$message=preg_replace("/[\n\r]/",  ' ', $message);
		$message=trim($message);
		if(mb_strlen($message, 'utf-8')>MAXLENGTHMSG_SHOWN_IN_COMMENTS_TABLE)
		{
			$message=trim(substr($message,0,MAXLENGTHMSG_SHOWN_IN_COMMENTS_TABLE))."...";
		}
		return $message;
	}

}
if(! function_exists('strlen_unicode')){
	function strlen_unicode($str) {
		return count(preg_split(
				'~~u', $str, -1, PREG_SPLIT_NO_EMPTY));
	}

}

if(! function_exists('getRatingArray')){
	function getRatingArray() {
		return array(2=>"Average", 3=> "Good",  1=>"Bad");
         		 	
	}

}
if(! function_exists('is_file_exists')){

function is_file_exists($filePath)
{
	return is_file($filePath) && file_exists($filePath);
}
}

