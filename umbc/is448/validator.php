<?php
error_reporting(E_ALL ^ (E_DEPRECATED & E_NOTICE));
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if (isset($_SERVER["HTTP_REFERER"])) {
    if (isset($_REQUEST["method"]) && $_REQUEST["method"] === "txt") {
        header('Content-Type: text/plain');
        passthru("curl -sD - \"https://validator.w3.org/check?uri=".$_SERVER["HTTP_REFERER"]."\" | grep X-W3C-Validator | grep -v Recursion | sed 's/X-W3C-Validator-//'");
    } else {
        header('Content-Type: image/gif');
        passthru("curl -sD - \"https://validator.w3.org/check?uri=".$_SERVER["HTTP_REFERER"]."\" | grep X-W3C-Validator | grep -v Recursion | sed 's/X-W3C-Validator-//' | convert -background lightblue -size 350x caption:@- -trim +repage -transparent lightblue gif:-");
    }
} else {
    print_r($_SERVER);
}
