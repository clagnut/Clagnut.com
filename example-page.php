<?php

$dr = str_replace($_SERVER['SCRIPT_NAME'], '/includes/', $_SERVER['SCRIPT_FILENAME']);
require_once($dr.'functions.inc.php');
$data = require_once($dr.'data.php');

$case_study = getCaseStudy( 'c4news', $data );
$case_studies = getCaseStudies( $data );

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>A Page</title>
</head>
<body>

	<h1><?php echo $case_study['name']; ?></h1>

	<h2>People:</h2>
	<ul>
		<?php foreach( $case_study['people'] as $slug => $person ): ?>
		<li>
			<a href="/is/<?php echo $slug; ?>"><?php echo $person['name']; ?></a>
		</li>
		<?php endforeach; ?>
	</ul>

	<h2>Activities:</h2>
	<ul>
		<?php foreach( $case_study['activities'] as $slug => $activity ): ?>
		<li>
			<a href="/does/<?php echo $slug; ?>"><?php echo $activity['name']; ?></a>
		</li>
		<?php endforeach; ?>
	</ul>

</body>
</html>



