<html>
<?php

	$month = date("F");
	if ($month == "October")
		$page_title = "Halloween is this month";
	else if($month == "September")
		$page_title = "Fall begins this month";
	else $page_title = "Just any other month";

	$test = "This page is about the months in a year";

?>

<head> 
	<title> <?php echo $page_title; ?> </title> 
</head>
<body>
	<h1> 
		<?php echo $page_title; ?> 
	</h1>
	
	<p>
		<?php echo $test ?>
		<br />
		We will describe what is unique to each month here.
	</p>
	</body>
</html>
