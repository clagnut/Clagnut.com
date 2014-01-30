<?php

function curlMoments() {
	global $dr3;
	$filename = $dr3 . "/kennedy/kennedy.json";
	
	if (file_exists($filename) && ((time() - filectime($filename) > 900))) {
		// if file on my server is older than 10 minutes then get the json file again
	
		# Copy file from Dropbox
		
		// file handler
		$file = fopen($filename, 'w');
		// cURL
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,'https://dl.dropboxusercontent.com/s/zt30sdtg2olyd34/kennedy.json?dl=1&token_hash=AAH3MLZKaIWhJq57Hq-RTf6KFga8gJzrst0NlKjJA3pHIg');
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
		
		
		/*
		
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
	}
}


function getMoments() {
	curlMoments();
	global $dr3;
	// Read the file contents into a string variable,
	// and parse the string into a data structure
	$str_data = file_get_contents($dr3 . "/kennedy/kennedy.json");
	$kennedy = json_decode($str_data,true);
	$moments = $kennedy["kennedy"];
	return $moments;
}

function formatMoment($moment) {
	global $fuzzyWeather;
	$momentMarkup = "<time>" . date('j M', strtotime($moment['captureDate'])) . "</time>\n";
	$weather = (isset($fuzzyWeather[$moment['weather']]))?$fuzzyWeather[$moment['weather']]:"";
	$time = str_replace("o' clock", "o’clock", $moment['fuzzyTime']);
	$momentMarkup .= "<p>At " . $time . " on a " . $weather . "<br/>\n";
	$place = (isset($moment['venueName']))?$moment['venueName']:$moment['city'];
	$momentMarkup .= $moment['day'] . " " . $moment['timeOfDay'] . " in <i>" . $place . "</i>,<br/>\n";
	if(isset($moment['text'])) {
		$text = lcfirst($moment['text']);
		$text = preg_replace("/\.$/", "", $text);
		$momentMarkup .= "<strong>I was " . $text . "</strong>";
	}
	if(isset($moment['song'])) {
		$momentMarkup .= "<br/>\nwhile listening to " . $moment['artist'] . "’s <cite>" . $moment['song'] . "</cite>.";
	} else {
		$momentMarkup .= ".";
	}
	$momentMarkup .= "<br/>\nMeanwhile the news headline read <a href=\"" . $moment['newsURL'] . "\"><q>" . trim($moment['newsHeadline']) . "</q></a>.</p>";
	
	
	$momentMarkup = SmartyPants($momentMarkup);
	
	return $momentMarkup;
}

$fuzzyWeather = array(
    "Light Rain Showers" => "drizzly",
    "Clear" => "clear",
    "Rain Showers" => "showery",
    "Scattered Clouds" => "slightly cloudy",
    "Partly Cloudy" => "partly cloudy",
    "Mostly Cloudy" => "cloudy",
    "Light Rain" => "rainy"
);

?>