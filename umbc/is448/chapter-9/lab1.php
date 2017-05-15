<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/xhtml; charset=utf-8" />
<title>Background Colors change based on the day of the week</title>
<script type="text/javascript" src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<style type="text/css">
body {
    background-color: <?=sprintf("#%x0%x6",date("N")%7/7*16,date("s")/60*16)?>;
    font-family: "Liberation Serif", Georgia, serif;
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}
pre.prettyprint {
    background-color: white;
    word-break: break-all;
    white-space: pre-wrap;
}
div#footer {
    padding-left: auto;
    padding-right: auto;
    text-align: center;
}
</style>
</head>
<body>
    <div id="main">
    <h1>Background changes</h1>
    <h2>Source</h2>
    <pre class="prettyprint">
<?=htmlspecialchars(file_get_contents('lab1.php'))?>
    </pre>
</div>
    <div id="footer">
        <a href="//validator.w3.org/check?uri=referer"><img alt="XHTML Validation Check" src="//lin.noblejury.com/umbc/is448/validator.php" /></a>
    </div>
</body>
</html>
