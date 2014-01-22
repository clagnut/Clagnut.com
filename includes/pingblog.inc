<?php
  //==============================================================================
  // A quick and dirty PHP function to update Weblogs.com
  // http://www.yaysoft.com/weblogs.phps
  //==============================================================================    

  function pingBlogs($name="", $url="", $host=false, $sock="", $dir="") {
    $fp = fsockopen($sock, 80, $errnum, $errstr);

    if(!$fp) { 
      echo "$errstr ($errnum)<br>\n";
      $output = "ERROR!";
    } else  {
      $len = strlen($name) + strlen($url) + strlen("<?xml version=\"1.0\"?><methodCall><methodName>weblogUpdates.ping</methodName><params><param><value></value></param><param><value></value></param></params></methodCall>");
      fputs($fp,"POST /".$dir." HTTP/1.0\r\n");
      if ($host) {fputs($fp,"Host: ".$sock."\r\n");}
	  fputs($fp,"User-Agent: Bean's Weblogs.com Updater (PHP Stylin')\r\n");
      fputs($fp,"Content-Type: text/xml\r\n");
      fputs($fp,"Content-length: $len\r\n\r\n");
      fputs($fp,"<?xml version=\"1.0\"?><methodCall><methodName>weblogUpdates.ping</methodName><params><param><value>$name</value></param><param><value>$url</value></param></params></methodCall>");        
      $output="";
      while(!feof($fp)) $output.=fgets($fp,4096);
      fclose($fp);        
    }

    $output = preg_replace("/.*<\/boolean>/si","",$output);
    $output = preg_replace("/.*<value>/si","",$output);
    $output = preg_replace("/<\/value>.*/si","",$output);         
    return $output;
  }
?> 