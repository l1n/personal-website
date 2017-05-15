<html>
<head>
	<title>Your rating and the average rating for the movie Madagascar</title>
	<link rel="stylesheet" type="text/css" href="form_proc.css" />
</head>

<body>
<h1>Your rating</h1>
<p> 
Your rating for the movie Madagascar is <?=$_REQUEST["rating"]?>.
	</p>
<p>
	The average rating for the movie is  
<?php
    $rating = explode(" ", file_get_contents('rating'));
    $rating[0] = ( $_REQUEST['rating'] + $rating[1] * $rating[0] ) / ( $rating[1] + 1 );
    $rating[1] = $rating[1] + 1;
?>
<?=$rating[0]?> </p>
<?php
    $rating = implode(" ", $rating);
    file_put_contents('rating', $rating);
?>
	<p><a href="ratings_sol2.html"> Go back and vote again </a></p>



</body>
</html>
