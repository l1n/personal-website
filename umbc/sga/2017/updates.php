<html>
<head>
	<title>Thank you!</title>
</head>
<body>
<h1>Success</h1>
<p>Thank you for signing up for updates about the <strong>SGA Elections 2017</strong></p>
<?php
file_put_contents('email.tzt', $_REQUEST["email"].PHP_EOL , FILE_APPEND | LOCK_EX);
?>
<p><a href="elections">Back to election information</a></p>
</body>
</html>
