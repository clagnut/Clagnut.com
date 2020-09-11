<?php
/* sendToHost
 * ~~~~~~~~~~
 * Params:
 *   $host      - Just the hostname.  No http:// or 
                  /path/to/file.html portions
 *   $method    - get or post, case-insensitive
 *   $path      - The /path/to/file.html part
 *   $data      - The query string, without initial question mark
 *   $useragent - If true, 'MSIE' will be sent as 
                  the User-Agent (optional)
 *
 * Examples:
 *   sendToHost('www.google.com','get','/search','q=php_imlib');
 *   sendToHost('www.example.com','post','/some_script.cgi',
 *              'param=First+Param&second=Second+param');
 */

function sendToHost($host,$method,$path,$data,$useragent=1,$auth=0)
{
    // Supply a default method of GET if the one passed was empty
    if (empty($method)) {
        $method = 'GET';
    }
    $method = strtoupper($method);
    $fp = @fsockopen($host, 80);
    $buf = "";
    if ($fp) {
		if ($method == 'GET') {
			$path .= '?' . $data;
		}
		fputs($fp, "$method $path HTTP/1.1\r\n");
		fputs($fp, "Host: $host\r\n");
		if ($auth) {
			$auth = base64_encode($auth);
			fputs($fp, "Authorization: Basic " . $auth . "\r\n");
		}	
		fputs($fp,"Content-type: application/x-www-form-urlencoded\r\n");
		fputs($fp, "Content-length: " . strlen($data) . "\r\n");
		if ($useragent) {
			fputs($fp, "User-Agent: Clagnut PHP submitter\r\n");
		}
		fputs($fp, "Connection: close\r\n\r\n");
		if ($method == 'POST') {
			fputs($fp, $data);
		}
	
		while (!feof($fp)) {
			$buf .= fgets($fp,128);
		}
		fclose($fp);
		if (preg_match("/^HTTP\/1.(0|1) 200 OK/",$buf)) {
			$message = "Submission to $host OK";
		} else {
			$message = "Submission to $host failed - 200 OK not returned\n<pre>".$buf."</pre>";
		}
		return $message;
	} else {
		$error = "Submit to $host failed. Probably no Internet connection.";
		return $error;
	}	
}


//	$url is the del.icio.us URL with arguments
//	$user is your username
//	$password is your password

function curl($url, $user, $password) {

	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERPWD, $user.":".$password);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$contents = curl_exec($ch);
	curl_close($ch);
	return $contents;
}

//	$contents now contains the contents of the XML file

?>