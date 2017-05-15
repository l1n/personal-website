<html>
<head>
	<title>Variables	</title>
</head>
<body>

<div id = "">

<?php
	//This program prints hello world, a locally defined variable, and uses a special-reserved variable $_SERVER
	$txt = "Hello World";
	$num1 = 16;

	echo "<div>";
	echo "$txt <br />";
	echo "User-defined Variable's value:  $num1 <br />";

	echo "You are accessing the page with the following browser: <b>" . 
			$_SERVER['HTTP_USER_AGENT'];
	echo "</b>";

	echo "$num1 <br />";
	
	

?>

</div>
</body>
</html>

