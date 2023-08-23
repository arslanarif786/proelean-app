<?php



define('ENCRYPT_METHOD','AES-256-CBC');
define('SECRET_KEY','live4ajvf11224vb');
define('SECRET_IV','liveaves2211bfhhj34hb');

if(!function_exists('customEncrypt'))
{
    function customEncrypt($string)
	{
		// hash
		$key = hash('sha256', SECRET_KEY);
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, ENCRYPT_METHOD, $key, 0, $iv);
        $output = base64_encode($output);
		return $output;
    }
}


if(!function_exists('customDecrypt')){

    function customDecrypt($string)
	{
        if(is_numeric($string)){
            return $string;
        }

		// hash
		$key = hash('sha256', SECRET_KEY);
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), ENCRYPT_METHOD, $key, 0, $iv);
		return $output;
	}
}

if(!function_exists('logactivity')){
    function logactivity($order,$user,$description, $type = null, $value = null, $action = null)
    {
        activity($order->orderNo)
            ->performedOn($order)
            ->causedBy($user)
            ->withProperties([
                'type' => $type,
                'value' => $value,
                'action' => $action
            ])
            ->log($description);
        return 1;
    }
}
