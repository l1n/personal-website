<html xmlns = "http://www.w3.org/1999/xhtml">
<!-- today.php - A trivial example to illustrate a php document -->
  <head> <title> today.php </title>
  </head>
  <body>
    <p>
	<b>
		Welcome to my home page <br /> <br />
		Today is:
	</b>
    <?php
 		//l requests the day of week, F requests month, j requests date
		//S next to the j gets the correct suffix, e.g., st or nd or th
        print date("l, F jS");       
      ?>
	  <br />
    </p>
  </body>
</html>
