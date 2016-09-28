<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if (isset($_SERVER["HTTP_REFERER"])) {
    if ($_REQUEST["method"] !== "txt") {
        header('Content-Type: image/png');
        passthru("curl -sD - \"https://validator.w3.org/check?uri=".$_SERVER["HTTP_REFERER"]."\" | grep X-W3C-Validator | grep -v Recursion | sed 's/X-W3C-Validator-//' | convert -size 1000x2000 xc:white -font NimbusSans-Regular -pointsize 12 -fill black -annotate +15+15 @- -trim -border 10 +repage -transparent white png:-");
    } else {
        header('Content-Type: text/plain');
        passthru("curl -sD - \"https://validator.w3.org/check?uri=".$_SERVER["HTTP_REFERER"]."\" | grep X-W3C-Validator | grep -v Recursion");
    }
} else {
    print_r($_SERVER);
}
