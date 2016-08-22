<?php 
class ar_Nonce {
	protected static $SecretKey="YOUR_KEY"; 	//MUST be configured
	protected static $NonceKey="_nonce"; 		//should be configured
	protected static $NonceDuration=300;		//should be configured if needed
	public function generate($action ,$user=null , $timeoutSeconds=null,$secret=null) {
		if ( is_string($secret) == false || strlen($secret) < 10) {
			$secret=self::$SecretKey;
		}
		if(!is_int($timeoutSeconds)){
			$timeoutSeconds=self::$NonceDuration;
		}
		$salt = self::generateSalt();
		$time = time();
		$maxTime = $time + $timeoutSeconds;
		$nonce = $salt . "," . $maxTime . "," . hash( 'sha256',$salt . $secret . $action . $maxTime . $user );
		return $nonce;
	}
	
	public function check($nonce ,$action ,$user=null , $secret=null) {
		if (is_string($nonce) == false) {
			return false;
		}
		$a = explode(',', $nonce);
		if (count($a) != 3) {
			return false;
		}
		if(!isset($timeoutSeconds)){
			$secret=self::$SecretKey;
		}
		$salt = $a[0];
		$maxTime = intval($a[1]);
		if(time()>$maxTime){
			return false;
		}
		$hash = $a[2];
		$back = hash('sha256', $salt . $secret . $action . $maxTime .$user );
#		echo "\n".$nonce."\n".$action."\n".$user."\n\n";
		if ($back != $hash) {
			return false;
		}
		if (time() > $maxTime) {
			return false;
		}
		return true;
	}
	protected function generateSalt() {
		$length = 10;
		$chars='1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
		$ll = strlen($chars)-1;
		$o = '';
		while (strlen($o) < $length) {
			$o .= $chars[ rand(0, $ll) ];
		}
		return $o;
	}
	function generate_url_nonce( $action, $user=null,$out=false ){
		$url_part= self::$NonceKey."=".self::generate( $action , $user );
		if(false==$out){
			return $url_part;
		}else{
			echo $url_part;
			return true;
		}
	}
	function generate_form_nonce( $action , $user = null,$out=false ){
		$form_part= "<input type='hidden' name='".self::$NonceKey."' value='".self::generate( $action , $user )."' />";
		if(false==$out){
			return $form_part;
		}else{
			echo $form_part;
			return true;
		}
	}
}
?>
