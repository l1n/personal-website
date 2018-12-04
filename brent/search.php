<!DOCTYPE html>
<html>
<head>
<title>Search brent-archive [id:pub-nova-lw-ds-bd] on presiding.noblejury.com</title>
<link rel="stylesheet" href="https://umbc.in/css/elegant.css">
</head>
<body>
<header>
<h1 class="logo">Search brent-archive</h1>
</header>
<main>
<article>
<form>
<label><input type="checkbox" name="i" checked>Case insensitive</label>
<select name="rt">
<option value="f" selected>literal</option>
<option value="e">regex</option>
<option value="p">perl</option>
</select>
<input type="text" name="q" value="<?=isset($_REQUEST["q"])?htmlspecialchars($_REQUEST["q"]):"Enter search query"?>" />
<input type="submit">
</form>
<?php
if (isset($_REQUEST["q"])) { ?>
<hr />
<article>
<?php
    if (!isset($_REQUEST["rt"]) || $_REQUEST["rt"] !== "f" || $_REQUEST["rt"] !== "e" || $_REQUEST["rt"] !== "p") {
        $_REQUEST["rt"] = "f";
    }
?>
    <p>Search query <?=$_REQUEST["rt"]?>:"<?=htmlspecialchars($_REQUEST["q"])?>"</p>
<pre>
<?php 
    passthru("/bin/".$_REQUEST["rt"]."grep -R ".(isset($_REQUEST["i"])?"-i ":"").escapeshellarg($_REQUEST["q"])." /pub/lin/personal/brent | cut -f 1 -d : | cut -f 6- -d / | sort -u | perl -pe '\$_ = qq[<a href=\"\$_\" target=\"_blank\">\$_</a>]'");
?>
</pre>
</article>
<?php } ?>
</main>
<footer>
<p>Maintained by <a href="mailto:nova@noblejury.com">Euclidean Torus</a>.</p>
</footer>
</body>
</html>
