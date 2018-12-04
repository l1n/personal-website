<?php
$dord = simplexml_load_string(file_get_contents('https://rss.noblejury.com/public.php?op=rss&id=38&key=p8vr985a5f9d87ce8e8&order=date_reverse'));
?>
<!DOCTYPE html>
<html>
<head>
<title><?=$dord->title?>(Mirror)</title>
        <link rel="stylesheet" href="https://umbc.in/css/elegant.css">
        <meta name=viewport content="width=device-width, initial-scale=1">
        <link href='https://fonts.googleapis.com/css?family=Lato&amp;subset=latin' rel='stylesheet' type='text/css'>
</head>
<body>
<header>
<h1 class="logo">Mirror of the now-defunct dord.horse comic by Jeph Jacques</h1>
</header>
<main class="container">
<?php foreach ($dord->entry as $entry) { ?>
<article>
<?php
$content = (string) $entry->content;
$content = str_replace('500.jpg', 'raw.jpg', preg_replace("/\".*com/", "\"https://s3.amazonaws.com/data.tumblr.com", $content));
echo $content;
?>
<p>Posted: <?=$entry->updated?></p>
</article>
<?php } ?>
</main>
</body>
</html>
