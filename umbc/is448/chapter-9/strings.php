<?php
	/*
	Illustrates use of Strings in PHP
	*/

	//a simple string
	$txt="Hello World";
	echo "$txt <br/>";




	//concatenating two strings
	$txt2 = "1234";
	$txt3 = $txt.','.$txt2;
	echo "$txt3 <br />";

	//using strlen function
	$len = strlen($txt3);
	echo "length of string is: $len <br />";

	//using strcmp function
	//strcmp returns 0 if the two strings are identical
	$txt4 = "1234";
	$num = strcmp($txt2, $txt4);
	echo "Value returned by strcmp: $num";
	echo "<br />";
	if(!(strcmp($txt2, $txt4))){
		echo "Strings are identical <br />";
	}
	else{
		echo "Strings are not identical <br />";
	}

?>
