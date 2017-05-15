<?php
$bgcolor = array("#e6ffff", "#e6fff7", "#e6f2ff", "#ffffe6", "#ffe6f2", "#fff2e6", "#e6fff7");
$bgcolor = $bgcolor[date("N")-1];

function isValid() {
    preg_match("/^\(\d{3}\) \d{3}-\d{4}$/", $_REQUEST["phone"], $match);
    if (!isset($match[0])) {
        $_REQUEST["error"] = "<h3>Your phone number must be in the format (###) ###-####.</h3>";
        return false;
    }
    preg_match("/^\d+\s[\w\s]+$/", $_REQUEST["address"], $match);
    if (!isset($match[0])) {
        $_REQUEST["error"] = "<h3>Your address must be in the format 111 Light Street.</h3>";
        return false;
    }
    return true;
}

function writeEntry() {
    $db = fopen("db.txt", "a");
    if (flock($db, LOCK_EX)) {
        fwrite($db, $_REQUEST["post"]);
        fwrite($db, "");
        fflush($db);
        flock($db, LOCK_UN);
        fclose($db);
        return true;
    } else {
        fclose($db);
        $_REQUEST["error"] = "<h3>Error acquiring lock on database.</h3>";
        return false;
    }
}
?><?="<?"?>xml version="1.0" encoding="utf-8"<?="?>"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Lin's Homework III</title>
        <style type="text/css">
body {
    max-width: 800px;
    margin: auto;
    padding-top: 50%;
    transform: translateY(-50%);
    font-family: Georgia, serif;
    background: <?=$bgcolor?>;
}
img {
    max-width: 100%;
}
article {
    border: 3px double grey;
    display: block;
    padding: 10px;
}
        </style>
        <script type="text/javascript">
window.onload = function () {
    var phoneRe = /^\(\d{3}\) \d{3}-\d{4}$/;
    var addressRe = /^\d+\s[\w\s]+$/;
    var form = document.getElementById('form');
    if (form) {
        form.onsubmit = function () {
            if (!phoneRe.exec(document.getElementById('phone').value)) {
                document.getElementById('error').innerHTML = "<h3>Your phone number must be in the format (###) ###-####.</h3>";
                return false;
            } else if (!addressRe.exec(document.getElementById('address').value)) {
                document.getElementById('error').innerHTML = "<h3>Your address must be in the format 111 Light Street.</h3>";
                return false;
            }
            return true;
        };
    }
};
        </script>
    </head>
    <body>
        <div id="error">
<?php if (isset($_REQUEST["submitted"]) and isValid() and writeEntry()) {
?>
<article>
<?=$_REQUEST["name"]?>, thank you for your blog entry!
Your post will be reviewed, and if we have any questions we will attempt to contact you at <?=$_REQUEST["phone"]?>. For your reference, the post in its entirety is reproduced below.
<pre><?=$_REQUEST["post"]?></pre>
</article>
<?php } else { print $_REQUEST["error"]; ?>
        </div>
        <form id="form" method="post" action="#">
            <fieldset>
                <legend>Create Post</legend>
                <label>Name
                <input id="name" type="text" name="name" value="<?=$_REQUEST["name"]?>" />
                </label>
                <label>Street Address
                <input id="address" type="text" name="address" value="<?=$_REQUEST["address"]?>" />
                </label>
                <label>County
                    <select id="county" name="county">
                        <option value="Allegany County, Maryland">Allegany</option>
                        <option value="Anne Arundel County, Maryland">Anne Arundel</option>
                        <option value="Baltimore County, Maryland">Baltimore</option>
                        <option value="Calvert County, Maryland">Calvert</option>
                        <option value="Caroline County, Maryland">Caroline</option>
                        <option value="Carroll County, Maryland">Carroll</option>
                        <option value="Cecil County, Maryland">Cecil</option>
                        <option value="Charles County, Maryland">Charles</option>
                        <option value="Dorchester County, Maryland">Dorchester</option>
                        <option value="Frederick County, Maryland">Frederick</option>
                        <option value="Garrett County, Maryland">Garrett</option>
                        <option value="Harford County, Maryland">Harford</option>
                        <option value="Howard County, Maryland">Howard</option>
                        <option value="Kent County, Maryland">Kent</option>
                        <option value="Montgomery County, Maryland">Montgomery</option>
                        <option value="Prince George's County, Maryland">Prince George's</option>
                        <option value="Queen Anne's County, Maryland">Queen Anne's</option>
                        <option value="St. Mary's County, Maryland">St. Mary's</option>
                        <option value="Somerset County, Maryland">Somerset</option>
                        <option value="Talbot County, Maryland">Talbot</option>
                        <option value="Washington County, Maryland">Washington</option>
                        <option value="Wicomico County, Maryland">Wicomico</option>
                        <option value="Worcester County, Maryland">Worcester</option>
                    </select>
                </label>
                <label>Phone Number
                <input id="phone" type="text" name="phone" value="<?=$_REQUEST["phone"]?>" />
                </label>
                <label>Post
                <textarea id="post" name="post" rows="3" cols="16"><?=$_REQUEST["post"]?></textarea>
                </label>
                <input type="hidden" name="submitted" value="true" />
                <button type="submit" value="Submit">Submit</button>
            </fieldset>
        </form>
<?php } ?>
        <div id="footer">
            <a href="//validator.w3.org/check?uri=referer"><img
               alt="XHTML Validation Check" src="/umbc/is448/validator.php" /></a>
        </div>
    </body>
</html>

