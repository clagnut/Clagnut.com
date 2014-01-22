<?php
$dr = $_SERVER["DOCUMENT_ROOT"];
$dr2 = preg_replace("/\/[^\/]+$/","/includes_clagnut",$dr);
include($dr2 . "/db_connect.php");


// get variables from query
$name = (isset($_REQUEST["name"]))?$_REQUEST["name"]:false; 
$url = (isset($_REQUEST["url"]))?$_REQUEST["url"]:false; 
$description = (isset($_REQUEST["description"]))?$_REQUEST["description"]:false; 
$xfn = (isset($_REQUEST["xfn"]))?$_REQUEST["xfn"]:false; 
$submitAdd = (isset($_REQUEST["submitAdd"]))?$_REQUEST["submitAdd"]:false;
$submitEdit = (isset($_REQUEST["submitEdit"]))?$_REQUEST["submitEdit"]:false;
$webcatID = (isset($_REQUEST["webcatID"]))?$_REQUEST["webcatID"]:false;
$id = (isset($_REQUEST["id"]))?$_REQUEST["id"]:false;

$name = trim($name);
$url = trim($url);
$description = trim($description);
$xfn = trim($xfn);
$message = "";
$error = "";

// if submit button pressed then add a new website to the database
if ($submitAdd) {
	$sql = "INSERT INTO websites 
	(website_id,webcatID,name,url,description,xfn)
	VALUES (NULL, '$webcatID', '$name', '$url', '$description', '$xfn')";
	$result = mysql_query($sql);
	if (mysql_affected_rows() > 0) {
		$message = "$name added.";
	} else {
		$message = "There was a problem.<br>
		MySQL said: ".mysql_error().".";
	}
	$id = mysql_insert_id();
}

// if there is a valid looking ID present
if (preg_match("/[0-9]+/",$id)) {

	// if submit has been pressed then update database accordingly
	if ($submitEdit) {
		$sql = "UPDATE websites SET
	    name='$name', description='$description', url='$url', webcatID='$webcatID', xfn='$xfn'
	    WHERE website_id='$id'";
	    $result = mysql_query($sql);
		if (mysql_affected_rows() > 0) {
			$message = "$name modified.";
		} else {
			$message = "There was a problem.<br>
			MySQL said: ".mysql_error().".";
		}
	}

	// pull website from database
	$sql = "SELECT name,description,url,webcatID,xfn FROM websites WHERE website_id=$id";
	$result = mysql_query($sql);
	if ($mywebsite = mysql_fetch_array($result)) {
		$name = htmlentities($mywebsite["name"]);
		$description = htmlentities($mywebsite["description"]);
		$url = $mywebsite["url"];
		$webcatID = $mywebsite["webcatID"];
		$xfn = $mywebsite["xfn"];
	} else {
		$error = "Error pulling blog from database. Bad id?";
	}
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
	 "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Edit Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<?php
include($dr . "/includes/cms_headlinks.inc");
?>
    <script type="text/javascript">
    //<![CDATA[
		function GetElementsWithClassName(elementName, className) {
		   var allElements = document.getElementsByTagName(elementName);
		   var elemColl = new Array();
		   for (i = 0; i < allElements.length; i++) {
		       if (allElements[i].className == className) {
		           elemColl[elemColl.length] = allElements[i];
		       }
		   }
		   return elemColl;
		}
		
		function upit() {
		   var inputColl = GetElementsWithClassName('input','valinp');
		   var results = document.getElementById('xfn');
		   var inputs = '';
		   for (i = 0; i < inputColl.length; i++) {
		       if (inputColl[i].checked) {
		           inputs += inputColl[i].value + ' ';
		           }
		       }
		   inputs = inputs.substr(0,inputs.length - 1);
		   results.value = inputs;
		   }
		
		function blurry() {
		   if (!document.getElementById) return;
		
		   var aInputs = document.getElementsByTagName('input');
		
		   for (var i = 0; i < aInputs.length; i++) {      
		
		       aInputs[i].onclick = function() {
		           var inputColl = GetElementsWithClassName('input','valinp');
		           var results = document.getElementById('xfn');
		           var inputs = '';
		           for (i = 0; i < inputColl.length; i++) {
		               if (inputColl[i].checked) {
		                   if (inputColl[i].value != '') inputs += inputColl[i].value + ' ';
		                   }
		               }
		           inputs = inputs.substr(0,inputs.length - 1);
		           results.value = inputs;
		       }
		
		       aInputs[i].onkeyup = function() {
		           var inputColl = GetElementsWithClassName('input','valinp');
		           var results = document.getElementById('xfn');
		           var inputs = '';
		           for (i = 0; i < inputColl.length; i++) {
		               if (inputColl[i].checked) {
		                   inputs += inputColl[i].value + ' ';
		                   }
		               }
		           inputs = inputs.substr(0,inputs.length - 1);
		           results.value = inputs;
		       }
		   
		   }
		}
		
		window.onload = blurry;
    //]]>
    </script>
	<style type="text/css">
	FIELDSET LABEL {
		float:none;
		display:inline;
		width:auto;
	}
	FIELDSET TH {
		text-align:right;
	}		
	</style>
</head>
<body>
<div class="options">
<?php
include($dr . "/includes/cms_options.inc");
include($dr . "/includes/cms_websites.inc")
?>
</div>
<div id="screen">
<h2>Edit website</h2>
<?php
if ($message) {echo "<p class='message'>$message</p>";}
if ($error) {echo "<p class='message'>$error</p>";}
?>
<form method="post" action="<?=$_SERVER["PHP_SELF"] ?>" name="website">
<input type="hidden" name="id" value="<?=$id?>">
<p>Name: <input type="text" name="name" size="60" maxlength="255" value="<?=$name?>"></p>
<p>URL: <input type="text" name="url" size="60" maxlength="255" value="<?=$url?>"></p>
<?php
// get list of categories from database
$sql = "SELECT webcat_id,webcat FROM webcats";
$result = mysql_query($sql);
$mywebcat = mysql_fetch_array($result);
if ($mywebcat) {
	// checks if any webcats have been returned from database
    echo "<p>Category: <select name='webcatID'>";
    do {
		// prints an webcat's details
		$webcat_id = $mywebcat["webcat_id"];
		$webcat = $mywebcat["webcat"];
		echo "<option value='$webcat_id'";
		if ($webcatID == $webcat_id){
			echo " selected='selected'";
		}
		echo ">$webcat</option>\n";
	} while ($mywebcat = mysql_fetch_array($result));
	echo "</select></p>\n";
} else {
        echo "<p>No categories as yet. <a href='/cms/websites/addwebcat.php'>Add category</a></p>";
}
?>
<p>Description:<br>
<textarea name="description" rows="2" cols="45"><?=$description?></textarea></p>

<fieldset>
<legend>XFN</legend>
     <table cellspacing="0">
        <tr>
          <th scope="row">
            friendship
          </th>
          <td>

            <label for="friendship-aquaintance"><input class="valinp" type="radio" name="friendship" value="acquaintance" id="friendship-aquaintance" /> acquaintance</label> <label for="friendship-friend"><input class="valinp" type="radio" name="friendship" value="friend" id="friendship-friend" /> friend</label> <label for="friendship-none"><input class="valinp" type="radio" name="friendship" value="" id="friendship-none" /> none</label>
          </td>
        </tr>
        <tr>
          <th scope="row">

            physical
          </th>
          <td>
            <label for="met"><input class="valinp" type="checkbox" name="physical" value="met" id="met" /> met</label>
          </td>
        </tr>
        <tr>
          <th scope="row">

            professional
          </th>
          <td>
            <label for="co-worker"><input class="valinp" type="checkbox" name="professional" value="co-worker" id="co-worker" /> co-worker</label> <label for="colleague"><input class="valinp" type="checkbox" name="professional" value="colleague" id="colleague" /> colleague</label>
          </td>
        </tr>
        <tr>

          <th scope="row">
            geographical
          </th>
          <td>
            <label for="co-resident"><input class="valinp" type="radio" name="geographical" value="co-resident" id="co-resident" /> co-resident</label> <label for="neighbor"><input class="valinp" type="radio" name="geographical" value="neighbor" id="neighbor" /> neighbor</label> <label for="geographical-none"><input class="valinp" type="radio" name="geographical" value="" id="geographical-none" /> none</label>

          </td>
        </tr>
        <tr>
          <th scope="row">
            family
          </th>
          <td>
            <label for="family-child"><input class="valinp" type="radio" name="family" value="child" id="family-child" /> child</label> <label for="family-parent"><input class="valinp" type="radio" name="family" value="parent" id="family-parent" /> parent</label> <label for="family-sibling"><input class="valinp" type="radio" name="family" value="sibling" id="family-sibling" /> sibling</label> <label for="family-spouse"><input class="valinp" type="radio" name="family" value="spouse" id="family-spouse" /> spouse</label> 
            <label for="family-none"><input class="valinp" type="radio" name="family" value="" id="family-none" /> none</label>

          </td>
        </tr>
        <tr>
          <th scope="row">
            romantic
          </th>
          <td>
            <label for="muse"><input class="valinp" type="checkbox" name="romantic" value="muse" id="muse" /> muse</label> <label for="crush"><input class="valinp" type="checkbox" name="romantic" value="crush" id="crush" /> crush</label> <label for="date"><input class="valinp" type="checkbox" name="romantic" value="date" id="date" /> date</label> <label for="sweetheart"><input class="valinp" type="checkbox" name="romantic" value="sweetheart" id="sweetheart" /> sweetheart</label><label for="spouse"></label>

          </td>
        </tr>
      </table>
<input type="text" name="xfn" id="xfn" value="<?=$xfn?>" size="30">
</fieldset>
<br>
<?php
if (preg_match("/[0-9]+/",$id)) {
	echo "<input type='Submit' name='submitEdit' value='Update website'>";
} else {
	echo "<input type='Submit' name='submitAdd' value='Add website'>";
}
?>
</form>
</div>
</body>
</html>
