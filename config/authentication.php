<?php
class Authenticate{
	public $userName = 'admin';
	public $password = 'admin';
	
	public function authentication(){
		header("Cache-Control : no-cache ,must-revalidate , max-age=0"); //Tell server no cache and always check credential

		$credentailSupplied = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));

		$notAutneticated = (!$credentailSupplied || $_SERVER['PHP_AUTH_USER'] != $this->userName || $_SERVER['PHP_AUTH_PW'] != $this->password);

		if($notAutneticated){
			header("HTTP/1.1 401 Authorization Required");
			header('WWW-Authenticate : Basic realm="Access denied"');
			exit;
		}

	}
}
?>