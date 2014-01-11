<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Kennedy</title>
</head>
<body>
<?php
/*

Copy file from Dropbox

// file handler
$file = fopen(dirname(__FILE__) . '/kennedy.json.zip', 'w');
// cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,'https://dl.dropboxusercontent.com/s/37wi91qannreupo/kennedy.json.zip?dl=1&token_hash=AAGblcoNEHXesDyEqb92oie7j4EcNDcCFjby_TWoDOysrQ');
// set cURL options
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// set file handler option
curl_setopt($ch, CURLOPT_FILE, $file);
// execute cURL
curl_exec($ch);
// close cURL
curl_close($ch);
// close file


Unzip

// assuming file.zip is in the same directory as the executing script.
$file = 'kennedy.json.zip';

// get the absolute path to $file
$path = pathinfo(realpath($file), PATHINFO_DIRNAME);

$zip = new ZipArchive;
$res = $zip->open($file);

if ($res === TRUE) {
  // extract it to the path we determined above
  $zip->extractTo($path);
  $zip->close();
  echo "WOOT! $file extracted to $path";
} else {
  echo "Doh! I couldn't open $file. resv was $res";
}

*/

// Read the file contents into a string variable,
// and parse the string into a data structure
$str_data = file_get_contents("kennedy.json");
$data = json_decode($str_data,true);

foreach ($data as $key => $value)
 {
   foreach($value as $v)
   {
	   echo "<pre>";
       echo $v[captureDate];
       echo "</pre>";
   }
}

?>

</body>
</html>
