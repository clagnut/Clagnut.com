<?php
// If magic quotes is turned on then strip slashes
if (get_magic_quotes_gpc()) {
  foreach ($_POST as $key => $value) {
    $_POST[$key] = stripslashes($value);
  }
}

$dr = $_SERVER["DOCUMENT_ROOT"];

// connect to database
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");

// get variables from query
$Add = (isset($_REQUEST["Add"]))?$_REQUEST["Add"]:""; 
$Update = (isset($_REQUEST["Update"]))?$_REQUEST["Update"]:""; 
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:""; 
$action = (isset($_REQUEST["action"]))?$_REQUEST["action"]:""; 
$startyear = (isset($_REQUEST["startyear"]))?$_REQUEST["startyear"]:""; 
$endyear = (isset($_REQUEST["endyear"]))?$_REQUEST["endyear"]:""; 
$startmon = (isset($_REQUEST["startmon"]))?$_REQUEST["startmon"]:""; 
$endmon = (isset($_REQUEST["endmon"]))?$_REQUEST["endmon"]:""; 
$artist = (isset($_REQUEST["artist"]))?$_REQUEST["artist"]:""; 
$title = (isset($_REQUEST["title"]))?$_REQUEST["title"]:""; 
$notes = (isset($_REQUEST["notes"]))?$_REQUEST["notes"]:""; 
$single = (isset($_REQUEST["single"]))?$_REQUEST["single"]:""; 
$ep = (isset($_REQUEST["ep"]))?$_REQUEST["ep"]:""; 
$album = (isset($_REQUEST["album"]))?$_REQUEST["album"]:""; 
$cd3 = (isset($_REQUEST["cd3"]))?$_REQUEST["cd3"]:""; 
$cd5 = (isset($_REQUEST["cd5"]))?$_REQUEST["cd5"]:""; 
$v5 = (isset($_REQUEST["v5"]))?$_REQUEST["v5"]:""; 
$v9 = (isset($_REQUEST["v9"]))?$_REQUEST["v9"]:""; 
$v10 = (isset($_REQUEST["v10"]))?$_REQUEST["v10"]:""; 
$v12 = (isset($_REQUEST["v12"]))?$_REQUEST["v12"]:""; 
$flexi = (isset($_REQUEST["flexi"]))?$_REQUEST["flexi"]:""; 
$tape = (isset($_REQUEST["tape"]))?$_REQUEST["tape"]:""; 
$video = (isset($_REQUEST["video"]))?$_REQUEST["video"]:""; 
$dvd = (isset($_REQUEST["dvd"]))?$_REQUEST["dvd"]:"";  
$year = (isset($_REQUEST["year"]))?$_REQUEST["year"]:""; 
$purchasedate = (isset($_REQUEST["purchasedate"]))?$_REQUEST["purchasedate"]:"";
$newartist = (isset($_REQUEST["newartist"]))?$_REQUEST["newartist"]:""; 
$newlabel = (isset($_REQUEST["newlabel"]))?$_REQUEST["newlabel"]:""; 
$type = (isset($_REQUEST["type"]))?$_REQUEST["type"]:""; 
$format = (isset($_REQUEST["format"]))?$_REQUEST["format"]:""; 
$label = (isset($_REQUEST["label"]))?$_REQUEST["label"]:"";  
$new = (isset($_REQUEST["new"]))?$_REQUEST["new"]:"";  

$newartist = addslashes(trim($newartist));
$title = addslashes(trim($title));
$newlabel = addslashes(trim($newlabel));
$notes = addslashes(trim($notes));

// Error handling
$error1 = "";
$error2 = "";
$error3 = "";
$message = "";

if ($Add OR $Update) {
	if($artist == 'new') {
		$sql = "INSERT INTO artists (artist_id,artist) VALUES (NULL,'$newartist')";
		$result = mysql_query($sql);
		if (mysql_affected_rows() == -1) {
			$error1 = "Something barfed when adding a new artist. MySQL said:<br>".mysql_error();
		} else {
			$artist = mysql_insert_id();
		}
	}
		
	if($label == 'new') {
		$sql = "INSERT INTO labels (label_id,label) VALUES (NULL,'$newlabel')";
		$result = mysql_query($sql);
		if (mysql_affected_rows() == -1) {
			$error2 = "Something barfed when adding a new label. MySQL said:<br>".mysql_error();
		} else {
			$label = mysql_insert_id();
		}
	}

	if ($Add) {
		$sql = "INSERT INTO music (id,artist,title,type,format,label,year,notes,purchasedate,new) VALUES (NULL,'$artist','$title','$type','$format','$label','$year','$notes','$purchasedate','$new')";
		$result = mysql_query($sql);
		if (mysql_affected_rows() == -1) {
			$error3 = "Something barfed. MySQL said:<br>".mysql_error();
		} else {
			$message = "$title added!";
			$id = mysql_insert_id();
		}
	}
	

	if ($Update AND $id) {
		$sql = "UPDATE music SET
		artist='$artist',
		title='$title',
		type='$type',
		format='$format',
		label='$label',
		year='$year',
		notes='$notes',
		purchasedate='$purchasedate',
		new='$new'
		WHERE id=$id";
		$result = mysql_query($sql);
		if (mysql_affected_rows() == -1) {
			$error3 = "Something barfed. MySQL said:<br>".mysql_error();
		} else {
			$message = stripslashes($title)." updated!";
		}
	}	
}
if ($id) {
	$music = mysql_query("SELECT * FROM music WHERE id=$id LIMIT 1",$db);
	if ($myrow = mysql_fetch_array($music)) {
		$artist = $myrow["artist"];
		$title = $myrow["title"];
		$type = $myrow["type"];
		$format = $myrow["format"];
		$label = $myrow["label"];
		$year = $myrow["year"];
		$notes = $myrow["notes"];
		$purchasedate = $myrow["purchasedate"];
		$new = $myrow["new"];
	}
	$action = "Update";
} else {
	$action = "Add";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo $action?> music</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
<script type="text/javascript">
function getOption(mytextbox,mydropdown,typed,keypressed) {
	myselect = document.music[mydropdown]
	myinput = document.music[mytextbox]
	if (keypressed != 8 && keypressed != 46 && keypressed != 13) {
		for(i=0; i<myselect.options.length; i++){
		 	option = myselect.options[i].text
			pattern = "^" + typed
			re = new RegExp(pattern,"i")
			if (re.test(option)) {
				myselect.options[i].selected = true
				myinput.value = option
				selectionStart = typed.length
				selectionEnd = option.length
				selectionText = option.substring(selectionStart,selectionEnd)
				if (myinput.setSelectionRange) 	{myinput.setSelectionRange(selectionStart,selectionEnd)}
				if (myinput.createTextRange) {
					var r = myinput.createTextRange();
					r.findText(selectionText);
					r.select();
				}
				break
			} myselect.options[0].selected = true;
		}  
	}
}

function setText(mytextbox, mydropdown, myoption) {
	document.music[mytextbox].value = document.music[mydropdown].options[myoption].text
}
</script>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_music.inc")
?>
</div>
<div id="screen">
<h2><?php echo $action?> music</h2>

<form method="get" action="<?php echo $_SERVER["PHP_SELF"]?>" name="music" id="music">
<input type="hidden" name="id" value="<?php echo $id ?>">
<p><?php echo "$error1 $error2 $error3 $message"; ?></p>
<p>artist:
<input type="text" name="newartist" size="50" maxlength="255" value="<?php echo $newartist ?>" onkeyup="getOption('newartist','artist',this.value,event.keyCode)">
<SELECT NAME="artist" onchange="setText('newartist', 'artist', this.selectedIndex)">
<option value="new"> - new - </option>
<?php
	/* get all artist strings from db and display in drop down */
	$artistlist = mysql_query("SELECT * FROM artists ORDER BY artist",$db);
	if ($myrow = mysql_fetch_array($artistlist)) {
		do {
			printf("<OPTION VALUE='%s'", $myrow["artist_id"]);
			if($artist == $myrow["artist_id"]) {echo " selected='selected'";}
			printf(">%s</OPTION>\n", $myrow["artist"]);
		} while  ($myrow = mysql_fetch_array($artistlist));
	}
?>
</SELECT>
</p>

<p>title: <input type="Text" name="title" size="60" maxlength="255" value="<?php echo $title ?>"></p>

<p>type:
<SELECT NAME="type">
<?php
	/* get all type strings from db and display in drop down */
	$typelist = mysql_query("SELECT * FROM types",$db);
	if ($myrow = mysql_fetch_array($typelist)) {
		do {
			printf("<OPTION VALUE='%s'", $myrow["id"]);
			if($type == $myrow["id"]) {echo " selected='selected'";}
			printf(">%s</OPTION>\n", $myrow["type"]);
		} while  ($myrow = mysql_fetch_array($typelist));
	}
?>
</SELECT></p>

<p>format:<SELECT NAME="format">
<?php
/* get all format strings from db and display in drop down */
	$formatlist = mysql_query("SELECT * FROM formats",$db);
	if ($myrow = mysql_fetch_array($formatlist)) {
	do {
			printf("<OPTION VALUE='%s'", $myrow["id"]);
			if($format == $myrow["id"]) {echo " selected='selected'";}
			printf(">%s</OPTION>\n", $myrow["format"]);
		} while  ($myrow = mysql_fetch_array($formatlist));
	}
?>
</SELECT></p>

<p>label:
<input type="text" name="newlabel" size="20" maxlength="255" value="<?php echo $newlabel ?>"  onkeyup="getOption('newlabel','label',this.value,event.keyCode)">
<SELECT NAME="label" onchange="setText('newlabel', 'label', this.selectedIndex)">
<option value="new" selected> - new - </option>
<?php
	/* get all artist strings from db and display in drop down */
	$labellist = mysql_query("SELECT * FROM labels ORDER BY label",$db);
	if ($myrow = mysql_fetch_array($labellist)) {
		do {
			printf("<OPTION VALUE='%s'", $myrow["label_id"]);
			if($label == $myrow["label_id"]) {echo " selected='selected'";}
			printf(">%s</OPTION>\n", $myrow["label"]);
		} while  ($myrow = mysql_fetch_array($labellist));
	}
?>
</SELECT>
</p>

<p>year:<input type="Text" name="year" value="<?php echo $year ?>"></p>
<p>notes:<input type="Text" name="notes" size="60" maxlength="255" value="<?php echo $notes ?>"></p>

<p>purchased:
<input type="Text" name="purchasedate" value="<?php 
if(!$purchasedate) {$purchasedate = date("Y-m-d", time());}
echo $purchasedate;
?>">
yyyy-mm-dd
</p>

<p>new:<input type="radio" name="new" value="1" <?php if($new == '1' || !$new) {echo " checked='checked'";}?>>yes <input type="radio" name="new" value="0" <?php if($new == '0') {echo " checked='checked'";}?>>no</p>

<input type="Submit" name="<?php echo $action?>" value="<?php echo $action?> record">

</form>

</div>
</body>
</html>
