<?php
namespace App\Helper;

class SmsHelper{

	protected $username, $hash;
	public $default_otp;
	public function __construct(){
		$this->username = "tyagiabhishek248@gmail.com";
		$this->hash     = "fa78cc26424e6f70835262487b7f9b147a2bdc86ded33bb5ae64e24126154118";
		$this->sender   = "DIGISH";
		$this->test     = "0";
		$this->default_otp = "987678";
	}

	public function sendSms($mobilenumber, $message, $sender = null){
		
		if(!isset($sender)){
			$sender = $this->sender;
		}

		try{
		    if (function_exists("curl_init")){

		      $numbers 	= $mobilenumber;
	
		      $message	= urlencode($message);

		      $data 	= "username=".$this->username."&hash=".$this->hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$this->test;
		      
		      $ch 		= curl_init('http://api.textlocal.in/send/?');
		      
		      curl_setopt($ch, CURLOPT_POST, true);
		      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		      
		      $result = curl_exec($ch); 

		      curl_close($ch);
		      return ($result);
		    } 
		    else 
		    {
		         print("ERROR: curl library is not installed");
            } 
		 }
		 catch(\Exception $e){

		 }  
	}
}


?>