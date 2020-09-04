<?php
class encryptDecrypt
{
	public static function encrypt($text) 
	{ 
	$key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
		//return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256,$key, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)))); 
        	return $text; 
	} 
	public static function decrypt($text) 
	{ 
	$key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
	//	return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))); 
       return $text; 
	} 
}
