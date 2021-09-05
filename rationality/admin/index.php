<?php
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    $redirect_me = "";
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        $value = trim($parts[1]);
        if ($name == "state" || $name == "flow" || $name == "code") {
            $redirect_me = $redirect_me . $name . '=' . $value . '&';
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }
    if ($redirect_me) {
        header('Location: /authorize?'.$redirect_me);
        return;
    }
} 
include __DIR__.'/vendor/autoload.php';
Sentry\init(['dsn' => 'https://d78dcdfaf8624281825f176df5accf17@sentry.io/1842235' ]);
if (!isset($_REQUEST['spf']) && !isset($_POST['api-action'])) { ?>
<!DOCTYPE html>
<html>
<head>
<title>Fletcher</title>
        <meta name="flattr:id" content="j7rde5">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="flattr:id" content="j7rde5">
<meta name="og:image" content="https://dorito.space/fletcher/fletching-icon.png" />
<link rel="icon" href="https://dorito.space/fletcher/fletching-icon.png">
<link rel="shortcut icon" href="https://dorito.space/fletcher/fletching-icon.png">
<style type="text/css">
body {
  display: flex;
  flex-direction: row;
  height: 100vh;
  margin: 0;
  font-family: "Fira Sans", Roboto, sans-serif;
}

.mdc-drawer-app-content {
  flex: auto;
  overflow: auto;
  position: relative;
}

dt::before {
  content: "\A";
  white-space: pre-wrap;
  display: block;
  height: .5em;
}

dt, dd {
  display: inline;
  margin: 0;
margin-right: 1em;
}

.mdc-drawer__header {
  background-image: url('https://dorito.space/fletcher/fletching-icon.png');
  background-color: lightgrey;
  background-size: cover;
  background-position-y: center;
  background-blend-mode: screen;
  padding-bottom: 1em;
}
.mdc-drawer__subtitle {
  padding-top: 1em;
  padding-right: 1em;
  display: flex;
}

.mdc-drawer__content {
  scrollbar-width: thin;
  white-space: nowrap;
}

.main-content {
  overflow: auto;
  height: calc(100% - 8em);
  padding: 4em;
  scrollbar-width: thin;
  width: 100%;
}
#main-content-overlay {
  display: none;
  position:absolute;
  left:0;
  top:0;
  width:100%;
  height:100%;
  z-index:20;
  background: rgba(100, 100, 100, 0.3);
}
.mdc-data-table__row-read-only td {
  color: grey;
}
.app-bar {
  position: absolute;
}
figcaption {
    max-width: 80%;
}
figure img {
    width: 100%;
height: auto;
}
img[role="presentation"], i.material-icons[role="presentation"] {
  border-radius: 50%;
  transition-duration: 0.1s;
  margin-right: 1em;
  vertical-align: middle;
  display: inline-block;
  height: 32px;
  width: 32px;
}
ul {
  list-style-type: '- '
}

a.mdc-list-item i {
  font-size: 32px;
  margin-right: 14px;
}

code {
  font-size: 87.5%;
  word-break: break-word;
  font-family: SFMono-Regular,Menlo,Monaco,Consolas,"Liberation Mono","Courier New",monospace;
}

footer {
  padding-top: 4em;
  margin-bottom: 8px;
  font-size: 87.5%;
  color: grey;
}

footer a {
  color: darkgrey;
}

:root {
  --mdc-data-table-light-theme-bg-color: #fff;
  --mdc-data-table-dark-theme-bg-color: #303030;
  --mdc-data-table-light-theme-border-color: #e0e0e0;
  --mdc-data-table-dark-theme-border-color: #4f4f4f;
  --mdc-data-table-light-theme-row-hover: #eee;
  --mdc-data-table-dark-theme-row-hover: #414141;
  --mdc-data-table-light-theme-row-selected: #f5f5f5;
  --mdc-data-table-dark-theme-row-selected: #3a3a3a;
}
.mdc-data-table {
  box-shadow: 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 2px 2px 0 rgba(0, 0, 0, 0.14),
    0 1px 5px 0 rgba(0, 0, 0, 0.12);
  color: rgba(0, 0, 0, 0.87) !important;
  color: var(
    --mdc-theme-text-primary-on-background,
    rgba(0, 0, 0, 0.87)
  ) !important;
  -webkit-box-orient: vertical;
  -ms-flex-flow: column nowrap;
  flex-flow: column nowrap;
}
.mdc-data-table,
.mdc-data-table__header {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-direction: normal;
}
.mdc-data-table__header {
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-pack: justify;
  -ms-flex-pack: justify;
  justify-content: space-between;
  height: 64px;
  -webkit-box-orient: horizontal;
  -ms-flex-flow: row nowrap;
  flex-flow: row nowrap;
  padding: 0 14px 0 24px;
  -webkit-box-flex: 0;
  -ms-flex: none;
  flex: none;
}
.mdc-data-table__header-title {
  font-weight: 400;
  font-size: 20px;
  display: inline-block;
  margin: 0;
}
.mdc-data-table__header-actions {
  color: rgba(0, 0, 0, 0.54) !important;
  color: var(
    --mdc-theme-text-secondary-on-background,
    rgba(0, 0, 0, 0.54)
  ) !important;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-align: center;
  -ms-flex-align: center;
  align-items: center;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: reverse;
  -ms-flex-flow: row-reverse nowrap;
  flex-flow: row-reverse nowrap;
}
.mdc-data-table__header-actions :nth-last-child(n + 2) {
  margin-left: 24px;
}
.mdc-data-table__content {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed;
}
.mdc-data-table__content tr:first-child,
.mdc-data-table__content tr:nth-last-child(n + 2) {
  border-bottom: 1px solid #e0e0e0;
}
.mdc-data-table__content tr.mdc-data-table--selected {
  background-color: #f5f5f5;
}
.mdc-data-table__content td,
.mdc-data-table__content th {
  text-align: left;
  padding: 12px 24px;
  vertical-align: middle;
}
.mdc-data-table__content td.mdc-data-table--numeric,
.mdc-data-table__content th.mdc-data-table--numeric {
  text-align: right;
}
.mdc-data-table__content th {
  font-size: 13px;
  line-height: 17px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  color: rgba(0, 0, 0, 0.54) !important;
  color: var(
    --mdc-theme-text-secondary-on-background,
    rgba(0, 0, 0, 0.54)
  ) !important;
}
.mdc-data-table__content th.mdc-data-table--sortable {
  cursor: pointer;
}
.mdc-data-table__content th.mdc-data-table--sortable.mdc-data-table--sort-asc,
.mdc-data-table__content th.mdc-data-table--sortable.mdc-data-table--sort-desc {
  color: rgba(0, 0, 0, 0.87) !important;
  color: var(
    --mdc-theme-text-primary-on-background,
    rgba(0, 0, 0, 0.87)
  ) !important;
}
.mdc-data-table__content
  th.mdc-data-table--sortable.mdc-data-table--sort-asc:before,
.mdc-data-table__content
  th.mdc-data-table--sortable.mdc-data-table--sort-desc:before {
  font-family: Material Icons;
  font-size: 16px;
  vertical-align: text-bottom;
  line-height: 16px;
  margin-right: 8px;
}
.mdc-data-table__content
  th.mdc-data-table--sortable.mdc-data-table--sort-asc:before {
  content: "arrow_downward";
}
.mdc-data-table__content
  th.mdc-data-table--sortable.mdc-data-table--sort-desc:before {
  content: "arrow_upward";
}
.mdc-data-table__content td {
  font-size: 14px;
}
.mdc-data-table__content tbody tr:hover {
  background-color: #eee;
}
.mdc-data-table__footer {
  color: rgba(0, 0, 0, 0.54) !important;
  color: var(
    --mdc-theme-text-secondary-on-background,
    rgba(0, 0, 0, 0.54)
  ) !important;
  border-top: 1px solid #e0e0e0;
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  height: 56px;
  -ms-flex-flow: row nowrap;
  flex-flow: row nowrap;
  padding: 0 14px 0 0;
  -webkit-box-flex: 0;
  -ms-flex: none;
  flex: none;
  font-size: 13px;
}
.mdc-data-table__footer,
.mdc-data-table__footer .mdc-data-table__per-page {
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
  -webkit-box-pack: end;
  -ms-flex-pack: end;
  justify-content: flex-end;
}
.mdc-data-table__footer .mdc-data-table__per-page {
  display: -webkit-inline-box;
  display: -ms-inline-flexbox;
  display: inline-flex;
  -ms-flex-flow: row nowrap;
  flex-flow: row nowrap;
  -ms-flex-align: center;
  width: 64px;
  background-repeat: no-repeat;
  background-position: right 7px center;
  text-align: right;
  cursor: pointer;
}
.mdc-data-table__footer .mdc-data-table__per-page:after {
  font-family: Material Icons;
  font-size: 20px;
  content: "arrow_drop_down";
  margin: 0 2px;
}
.mdc-data-table__footer .mdc-data-table__results {
  margin-left: 32px;
}
.mdc-data-table__footer .mdc-data-table__prev {
  margin-left: 32px;
  cursor: pointer;
}
.mdc-data-table__footer .mdc-data-table__next {
  margin-left: 24px;
  cursor: pointer;
}
.mdc-data-table [dir="rtl"] td,
.mdc-data-table [dir="rtl"] th,
.mdc-data-table[dir="rtl"] td,
.mdc-data-table[dir="rtl"] th,
.mdc-data-table__content[dir="rtl"] td,
.mdc-data-table__content[dir="rtl"] th {
  text-align: right;
}
.mdc-data-table [dir="rtl"] td.mdc-data-table--numeric,
.mdc-data-table [dir="rtl"] th.mdc-data-table--numeric,
.mdc-data-table[dir="rtl"] td.mdc-data-table--numeric,
.mdc-data-table[dir="rtl"] th.mdc-data-table--numeric,
.mdc-data-table__content[dir="rtl"] td.mdc-data-table--numeric,
.mdc-data-table__content[dir="rtl"] th.mdc-data-table--numeric {
  text-align: left;
}
.mdc-data-table
  [dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-asc:before,
.mdc-data-table
  [dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-desc:before,
.mdc-data-table[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-asc:before,
.mdc-data-table[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-desc:before,
.mdc-data-table__content[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-asc:before,
.mdc-data-table__content[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-desc:before {
  display: none;
}
.mdc-data-table
  [dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-asc:after,
.mdc-data-table
  [dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-desc:after,
.mdc-data-table[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-asc:after,
.mdc-data-table[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-desc:after,
.mdc-data-table__content[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-asc:after,
.mdc-data-table__content[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-desc:after {
  font-family: Material Icons;
  font-size: 16px;
  vertical-align: text-bottom;
  line-height: 16px;
  margin-left: 8px;
}
.mdc-data-table
  [dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-asc:after,
.mdc-data-table[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-asc:after,
.mdc-data-table__content[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-asc:after {
  content: "arrow_downward";
}
.mdc-data-table
  [dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-desc:after,
.mdc-data-table[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-desc:after,
.mdc-data-table__content[dir="rtl"]
  .mdc-data-table--sortable.mdc-data-table--sort-desc:after {
  content: "arrow_upward";
}
.mdc-data-table--dark,
.mdc-theme--dark .mdc-data-table {
  color: #fff !important;
  color: var(--mdc-theme-text-primary-on-dark, #fff) !important;
  background-color: #303030;
}
.mdc-data-table--dark .mdc-data-table__header-actions,
.mdc-theme--dark .mdc-data-table .mdc-data-table__header-actions {
  color: hsla(0, 0%, 100%, 0.7) !important;
  color: var(
    --mdc-theme-text-secondary-on-dark,
    hsla(0, 0%, 100%, 0.7)
  ) !important;
}
.mdc-data-table--dark .mdc-data-table__content tr:first-child,
.mdc-data-table--dark .mdc-data-table__content tr:nth-last-child(n + 2),
.mdc-theme--dark .mdc-data-table .mdc-data-table__content tr:first-child,
.mdc-theme--dark
  .mdc-data-table
  .mdc-data-table__content
  tr:nth-last-child(n + 2) {
  border-bottom-color: #4f4f4f;
}
.mdc-data-table--dark .mdc-data-table__content tr.mdc-data-table--selected,
.mdc-theme--dark
  .mdc-data-table
  .mdc-data-table__content
  tr.mdc-data-table--selected {
  background-color: #3a3a3a;
}
.mdc-data-table--dark .mdc-data-table__content th,
.mdc-theme--dark .mdc-data-table .mdc-data-table__content th {
  color: hsla(0, 0%, 100%, 0.7) !important;
  color: var(
    --mdc-theme-text-secondary-on-dark,
    hsla(0, 0%, 100%, 0.7)
  ) !important;
}
.mdc-data-table--dark .mdc-data-table__content th.mdc-data-table--sort-asc,
.mdc-data-table--dark .mdc-data-table__content th.mdc-data-table--sort-desc,
.mdc-theme--dark
  .mdc-data-table
  .mdc-data-table__content
  th.mdc-data-table--sort-asc,
.mdc-theme--dark
  .mdc-data-table
  .mdc-data-table__content
  th.mdc-data-table--sort-desc {
  color: #fff !important;
  color: var(--mdc-theme-text-primary-on-dark, #fff) !important;
}
.mdc-data-table--dark .mdc-data-table__content tbody tr:hover,
.mdc-theme--dark .mdc-data-table .mdc-data-table__content tbody tr:hover {
  background-color: #414141;
}
.mdc-data-table--dark .mdc-data-table__footer,
.mdc-theme--dark .mdc-data-table .mdc-data-table__footer {
  color: hsla(0, 0%, 100%, 0.7) !important;
  color: var(
    --mdc-theme-text-secondary-on-dark,
    hsla(0, 0%, 100%, 0.7)
  ) !important;
  border-top-color: #4f4f4f;
} 
.hide {
    display: none;
}
@media screen and (max-width: 800px) {
.main-content {
  overflow: auto;
  height: calc(100% - 8em);
  padding: 0;
  scrollbar-width: thin;
  width: 100%;
}
.visuallyhidden {
    display: none;
}
/* Force table to not be like tables anymore */
    table, thead, tbody, th, td, tr { 
        display: block; 
    }
    td.mdc-data-table__cell { 
        /* Behave  like a "row" */
        border: none;
        border-bottom: 1px solid #eee; 
        position: relative;
height: auto;
    }
    
    td:before { 
        /* Now like a table header */
        position: absolute;
        /* Top/left values mimic padding */
        top: 6px;
        left: 6px;
        width: 45%; 
        padding-right: 10px; 
        white-space: nowrap;
    }
aside.mdc-drawer {
width: 64px;
}
.mdc-drawer__title {
display: none;
}
</style>
</head>
<body>
<?php
}
if (isset($_REQUEST['flush']) || (isset($_SERVER['HTTP_PRAGMA']) && $_SERVER['HTTP_PRAGMA'] === "no-cache")) {
    $FLUSH = "FLUSH";
} else {
    $FLUSH = "";
}


use RestCord\DiscordClient;
$redis = new Predis\Client([
    "scheme" => "tcp",
    "host" => "localhost",
    "port" => 6379,
    "persistent" => "1"]);

require_once ('Slimdown.php');

function render_toc($file) {
?>
<h3>Table of Contents</h3>
        <label class="mdc-text-field" data-mdc-auto-init="MDCTextField">
          <div class="mdc-line-ripple"></div>
          <span class="mdc-floating-label" for="toc-filter">Filter Table</span>
<input class="mdc-text-field__input mdc-data-table__filter" data-target="toc" id="toc-filter" />
          <div class="mdc-line-ripple"></div>
        </label>
<table class="mdc-data-table"><thead>
<tr class="mdc-data-table__header-row">
<th class="mdc-data-table__header-cell" role="columnheader" scope="col" aria-sort="none" data-column-id="name">Name</th>
<th class="mdc-data-table__header-cell" role="columnheader" scope="col">Owner</th>
<th class="mdc-data-table__header-cell" role="columnheader" scope="col">Date Created</th>
<th class="mdc-data-table__header-cell" role="columnheader" scope="col">Description</th>
<th class="mdc-data-table__header-cell" role="columnheader" scope="col">Tags</th>
</tr>
</thead><tbody class="mdc-data-table__content" id="toc"><?php
    foreach (json_decode(file_get_contents($file), false) as $chapter) {
        $tags = [];
        preg_match_all('/\[(.*?)\]/', $chapter->content, $matches, PREG_PATTERN_ORDER);
        $tags = $matches[1];
        if (strpos($chapter->content, '!requestinvite') !== false) {
            $tags[] = 'Request Invite';
            $chapter->content = str_replace('!requestinvitechannel', '', $chapter->content);
        }
        if (strpos($chapter->content, '!openchannel') !== false) {
            $tags[] = 'Open Channel';
            $chapter->content = str_replace('!openchannel', '', $chapter->content);
        }
?>
    <tr class="mdc-data-table__row">
<td class="mdc-data-table__cell"><a href="<?=$chapter->jump_url?>"><?=$chapter->name?></a></td>
<td class="mdc-data-table__cell"><?=$chapter->author?></td>
<td class="mdc-data-table__cell"><?=$chapter->created?></td>
<td class="mdc-data-table__cell"><?=Slimdown::render($chapter->content)?></td>
<td class="mdc-data-table__cell"><?=implode(', ', $tags)?></td>
</tr>
<?php
    }
    ?></tbody></table><?php
}
function my_parse_ini_file($file,$mode=false,$scanner_mode=INI_SCANNER_RAW) {
      return parse_ini_string(preg_replace('/^#.*\\n/m', "", @file_get_contents($file)),$mode,$scanner_mode);
}

function objectToArray($d) {
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    }
    else {
        // Return array
        return $d;
    }
}

$discord_call_log = "<!--discord call log\n";

$fletcher_main_config = my_parse_ini_file('/pub/lin/.fletcherrc', true);

$discord = new DiscordClient(['token' => $fletcher_main_config['discord']['botToken']]);
$dbconn = sprintf("host='%s' dbname='%s' user='%s' password='%s'", $fletcher_main_config['database']['host'], $fletcher_main_config['database']['tablespace'], $fletcher_main_config['database']['user'], $fletcher_main_config['database']['password']);
$dbconn = pg_connect($dbconn);

if (!empty($_SERVER['HTTP_REMOTE_USER'])) {
$user = $redis->get('discord-user-'.  (int) $_SERVER['HTTP_REMOTE_USER']);
if (empty($user) || $FLUSH) {
    $user = $discord->user->getUser(['user.id' => (int) $_SERVER['HTTP_REMOTE_USER']]);
    $discord_call_log .= "user->getUser\n";
    $redis->setEx('discord-user-'. (int) $_SERVER['HTTP_REMOTE_USER'], 6000, json_encode(objectToArray($user)));
} else {
    $user = json_decode($user, false);
}

$guilds = $redis->get('discord-user-'. $user->id . '-guilds');
if (empty($guilds) || $FLUSH) {
    $guilds = $discord->user->getCurrentUserGuilds();
    $discord_call_log .= "user->getCurrentUserGuilds\n";
    $redis->setEx('discord-user-'. $user->id . '-guilds', 6000, json_encode(objectToArray($guilds)));
} else {
    $guilds = json_decode($guilds, false);
}
} else {
    $user = (object) [
        'id' => '',
        'avatar' =>  'https://dorito.space/fletcher/fletching-icon.png'
    ];
}

$user_guilds = [];

if (!empty($_SERVER['HTTP_REMOTE_USER'])) {

foreach (explode(',', $_SERVER['HTTP_GROUPS']) as $guildid) {
    $guildid = (int)$guildid;
    if (count(array_filter($guilds, function($guild) use ($guildid) {
        return $guild->id === $guildid;
    })) === 0) {
        continue;
    }
    try {
        if (isset($_REQUEST['spf']) && isset($_REQUEST['guild_id']) && $guildid != $_REQUEST['guild_id']) {
            continue;
        }
        $user_guilds[$guildid] = $redis->get('discord-'.($user->id).'-'.($guildid));
        if (!empty($user_guilds[$guildid]) && !$FLUSH) {
            if ($user_guilds[$guildid] === 'continue') {
                unset($user_guilds[$guildid]);
                continue;
            }
            $user_guilds[$guildid] = json_decode($user_guilds[$guildid], true);
        }
        if (empty($user_guilds[$guildid]) || $FLUSH) {
            $member = $discord->guild->getGuildMember(['guild.id' => $guildid, 'user.id' => $user->id]);
            $discord_call_log .= "guild->getGuildMember\n";
            $guild = $discord->guild->getGuild(['guild.id' => $guildid]);
            $discord_call_log .= "guild->getGuild\n";
            $user_guilds[$guildid] = [
                'member' => objectToArray($member),
                'guild'  => objectToArray($guild),
            ];
            $user_guilds[$guild->id]['guild']['role_offsets'] = array();
            $i = 0;
            foreach ($user_guilds[$guild->id]['guild']['roles'] as $role) {
                $user_guilds[$guild->id]['guild']['role_offsets'][$role['id']] = $i++;
                if ($role['id'] === $guild->id && $role['position'] === 0) {
                    $user_guilds[$guild->id]['member']['roles'][] = $role['id'];
                }
            }
            $user_guilds[$guild->id]['member']['role_objects'] = array();
            foreach ($user_guilds[$guild->id]['member']['roles'] as $role_id) {
                $user_guilds[$guild->id]['member']['role_objects'][$role_id] = $user_guilds[$guild->id]['guild']['roles'][$user_guilds[$guild->id]['guild']['role_offsets'][$role_id]];
            }
            $user_guilds[$guild->id]['member']['permissions'] = array_reduce(
                array_map(
                    function ($role) {return $role['permissions'];},
                        $user_guilds[$guild->id]['member']['role_objects']
                ),
                function ($carry, $item) {return $carry | $item;}
            );
            if (($user_guilds[$guild->id]['member']['permissions']  & 0x00000008) === 0x00000008) {
                $guild_channels = $discord->guild->getGuildChannels(['guild.id' => $guild->id]);
                $discord_call_log .= "guild->getGuildChannels\n";
                $user_guilds[$guild->id]['guild']['channels'] = objectToArray($guild_channels);
            }
            $redis->setEx('discord-'.($user->id).'-'.($guild->id), 6000, json_encode($user_guilds[$guild->id]));
        }
    } catch (GuzzleHttp\Command\Exception\CommandClientException $e) {
        // Pass, unless it's an Unknown Member exception
        $ebody = json_decode($e->getresponse()->getbody()->getcontents());
        if ($ebody->code !== 10007) {
            throw $e;
        }
        if ($ebody->code === 10007) {
            unset($user_guilds[$guildid]);
            $redis->setEx('discord-'.($user->id).'-'.($guild->id), 6000, 'continue');
        }
    }
}
if (isset($_POST['api-action'])) {
    if (isset($_POST['guild_id']) &&
        isset($user_guilds[$_POST['guild_id']]) &&
        ($user_guilds[$_POST['guild_id']]['guild']['owner_id'] == $user->id ||
        $user->id == $fletcher_main_config['discord']['globalAdmin']) ||
        (($user_guilds[$_POST['guild_id']]['member']['permissions'] & 0x00000008) === 0x00000008)) {
        $guild = $user_guilds[$_POST['guild_id']]['guild'];
        $member = $user_guilds[$_POST['guild_id']]['member'];
        if (isset($fletcher_main_config['extra']['rc-path']) && file_exists($fletcher_main_config['extra']['rc-path'].'/'.$_POST['guild_id'])) {
            $ini_contents = my_parse_ini_file($fletcher_main_config['extra']['rc-path'].'/'.$_POST['guild_id'], true);
        } else {
            $ini_contents = ['DEFAULT' => []];
        }
        if ($_POST['mode'] == 'edit' && isset($ini_contents[$_POST['section_id']][$_POST['key']])) {
            $ini_contents[$_POST['section_id']][$_POST['key']] = $_POST['value'];
        } elseif ($_POST['mode'] == 'delete') {
            unset($ini_contents[$_POST['section_id']][$_POST['key']]);
        } elseif ($_POST['mode'] == 'add' && !isset($ini_contents[$_POST['section_id']][$_POST['key']])) {
            $ini_contents[$_POST['section_id']][$_POST['key']] = $_POST['value'];
        } elseif ($_POST['mode'] == 'addSection' && !isset($ini_contents[$_POST['section']])) {
            $ini_contents[$_POST['section']] = array();
        }
        $ini_str = "";
        foreach ($ini_contents as $section_name => $section) {
            $ini_str .= '['.$section_name."]\n";
            foreach ($section as $key => $value) {
                $ini_str .= $key . ' = ' . $value . "\n";
            }
        }
        file_put_contents($fletcher_main_config['extra']['rc-path'].'/'.$_POST['guild_id'], $ini_str);
        header('Content-type: application/json');
        print json_encode(['success' => 'Preference saved', 'new_config' => $ini_contents]);
        exit(0);
    } else {
        http_response_code('503');
        header('Content-type: application/json');
        print json_encode(['error' => 'Editing disallowed']);
        exit(0);
    }
}

}
if (!isset($_REQUEST['spf'])) { ?>
<aside class="mdc-drawer">
<div class="mdc-drawer__header">
<h3 class="mdc-drawer__title">Fletcher</h3>
<?php if (empty($_SERVER['HTTP_REMOTE_USER'])) { ?><a href="/oauth2/start" onfocus="returnToMe()" onclick="returnToMe()"><?php } ?><h6 class="mdc-drawer__subtitle"><img  src="<?php if (!empty($_SERVER['HTTP_REMOTE_USER'])) { ?>https://cdn.discordapp.com/avatars/<?=$user->id?>/<?=$user->avatar?>.png<?php } else { ?><?=$user->avatar?><?php } ?>" style="vertical-align: middle; display: inline-block;" role="presentation">
<span style="display: inline-block" <?php if (!empty($_SERVER['HTTP_REMOTE_USER'])) { ?>title="<?=$_SERVER['HTTP_REMOTE_EMAIL']?>">Logged in as <?=$user->username?><?php } else { ?>title="Log in">Log in via Discord<?php } ?></span></h6><?php if (empty($_SERVER['HTTP_REMOTE_USER'])) { ?></a><?php } ?>
          </div>
<div class="mdc-drawer__content">
        <nav class="mdc-list">
<?php if (!empty($_SERVER['HTTP_REMOTE_USER'])) { ?><a class="mdc-list-item spf-link" href="?view=user-preferences"><i class="material-icons" role="presentation" title="User Preferences">settings</i><span class="visuallyhidden">User Preferences</span></a>
<a class="mdc-list-item spf-link" href="?view=emoji"><i class="material-icons" role="presentation" title="Emoji List">emoji_emotions</i><span class="visuallyhidden">Emoji List</span></a><?php } ?>
<?php if ($user->id == $fletcher_main_config['discord']['globalAdmin']) { ?>
<a class="mdc-list-item spf-link" href="?view=global-preferences"><i class="material-icons" role="presentation" title="Global Preferences">settings</i><span class="visuallyhidden">Global Preferences</span></a>
<a class="mdc-list-item spf-link" href="?view=scheduler"><i class="material-icons" role="presentation" title="View Scheduler">calendar_today</i><span class="visuallyhidden">View Scheduler</span></a>
<?php } ?>
<?php foreach ($user_guilds as $guild_id => $member) {
if ($user_guilds[$guild_id]['guild']['owner_id'] == $user->id || $user->id == $fletcher_main_config['discord']['globalAdmin'] || (($user_guilds[$guild_id]['member']['permissions'] & 0x00000008) === 0x00000008) || file_exists('../' . $guild_id . '.toc')) {
?>
<a class="mdc-list-item spf-link" href="?guild_id=<?=$member['guild']['id']?>"><?php if ($member['guild']['icon']) {?><img src="https://cdn.discordapp.com/icons/<?=$member['guild']['id']?>/<?=$member['guild']['icon']?>.png?size=32"  role="presentation" title="<?=htmlspecialchars($member['guild']['name'])?>" /><?php } else { ?><i class="material-icons" role="presentation" title="<?=htmlspecialchars($member['guild']['name'])?>">explore</i><?php } ?><span class="visuallyhidden"><?=htmlspecialchars($member['guild']['name'])?></span></a>
<?php }} ?>
          <a class="mdc-list-item spf-link" href="http://fletcher.fun/"><i class="material-icons" role="presentation">info_outline</i><span class="visuallyhidden">About</span></a>
          <a class="mdc-list-item spf-link" href="http://fletcher.fun/todo"><i class="material-icons" role="presentation">info_outline</i><span class="visuallyhidden">Features &amp; Bugs</span></a>
          <a class="mdc-list-item spf-link" href="http://fletcher.fun/man"><i class="material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
      </div>
</aside>
<main id="main-content" class="main-content">
<?php
}
if (isset($_REQUEST['spf'])) {
  ob_start();
}
?>
<div id="main-content-overlay"></div>
<div id="edit-dialog" class="mdc-dialog"
     role="alertdialog"
     aria-modal="true"
     aria-labelledby="edit-dialog-title"
     aria-describedby="edit-dialog-content" style="display: hidden;">
  <div class="mdc-dialog__container">
    <form method="POST" onsubmit="return false">
    <div class="mdc-dialog__surface">
      <h2 class="mdc-dialog__title" id="edit-dialog-title">Edit Value</h2>
      <div class="mdc-dialog__content" id="edit-dialog-content">
        <span id="edit-dialog-content-text">{{key}}</span>
        <input type="hidden" name="guild_id" />
        <input type="hidden" name="section_id" />
        <input type="hidden" name="key" />
        <input type="hidden" name="api-action" value="set-guild-config" />
        <div class="mdc-text-field">
          <input type="text" id="target-edit-value" class="mdc-text-field__input" name="value">
          <label class="mdc-floating-label" for="target-edit-value">Current: {{value}}</label>
          <div class="mdc-line-ripple"></div>
        </div>
      </div>
      <footer class="mdc-dialog__actions">
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="edit" name="mode" value="edit">
          <span class="mdc-button__label">Edit</span>
        </button>
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="delete" name="mode" value="delete">
          <span class="mdc-button__label">Delete</span>
        </button>
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="close">
          <span class="mdc-button__label">Cancel</span>
        </button>
      </footer>
    </div>
    </form>
  </div>
  <div class="mdc-dialog__scrim"></div>
</div>
<div id="add-dialog" class="mdc-dialog"
     role="alertdialog"
     aria-modal="true"
     aria-labelledby="add-dialog-title"
     aria-describedby="add-dialog-content" style="display: hidden;">
  <div class="mdc-dialog__container">
    <form method="POST" onsubmit="return false">
    <div class="mdc-dialog__surface">
      <h2 class="mdc-dialog__title" id="add-dialog-title">Add Value</h2>
      <div class="mdc-dialog__content" id="add-dialog-content">
        <input type="hidden" name="guild_id" />
        <input type="hidden" name="section_id" />
        <input type="hidden" name="api-action" value="set-guild-config" />
        <div class="mdc-text-field">
          <input type="text" id="target-add-key" class="mdc-text-field__input" name="key">
          <label class="mdc-floating-label" for="target-add-key">Key</label>
          <div class="mdc-line-ripple"></div>
        </div>
        <div class="mdc-text-field">
          <input type="text" id="target-add-value" class="mdc-text-field__input" name="value">
          <label class="mdc-floating-label" for="target-add-value">Value</label>
          <div class="mdc-line-ripple"></div>
        </div>
      </div>
      <footer class="mdc-dialog__actions">
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="add" name="mode" value="add">
          <span class="mdc-button__label">Add</span>
        </button>
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="close">
          <span class="mdc-button__label">Cancel</span>
        </button>
      </footer>
    </div>
    </form>
  </div>
  <div class="mdc-dialog__scrim"></div>
</div>
<div id="add-section-dialog" class="mdc-dialog"
     role="alertdialog"
     aria-modal="true"
     aria-labelledby="add-section-dialog-title"
     aria-describedby="add-section-dialog-content" style="display: hidden;">
  <div class="mdc-dialog__container">
    <form method="POST" onsubmit="return false">
    <div class="mdc-dialog__surface">
      <h2 class="mdc-dialog__title" id="add-section-dialog-title">Add Value</h2>
      <div class="mdc-dialog__content" id="add-section-dialog-content">
        <input type="hidden" name="guild_id" />
        <input type="hidden" name="api-action" value="set-guild-config" />
        <div class="mdc-text-field">
          <input type="text" id="target-add-section" class="mdc-text-field__input" name="section">
          <label class="mdc-floating-label" for="target-add-key">Channel/Section ID</label>
          <div class="mdc-line-ripple"></div>
        </div>
      </div>
      <footer class="mdc-dialog__actions">
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="addSection" name="mode" value="addSection">
          <span class="mdc-button__label">Add</span>
        </button>
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="close">
          <span class="mdc-button__label">Cancel</span>
        </button>
      </footer>
    </div>
    </form>
  </div>
  <div class="mdc-dialog__scrim"></div>
</div>
<div id="rename-section-dialog" class="mdc-dialog"
     role="alertdialog"
     aria-modal="true"
     aria-labelledby="rename-section-dialog-title"
     aria-describedby="rename-section-dialog-content" style="display: hidden;">
  <div class="mdc-dialog__container">
    <form method="POST" onsubmit="return false">
    <div class="mdc-dialog__surface">
      <h2 class="mdc-dialog__title" id="rename-section-dialog-title">Rename Section</h2>
      <div class="mdc-dialog__content" id="rename-section-dialog-content">
        <span id="rename-section-dialog-content-text">{{section_name}}</span>
        <input type="hidden" name="guild_id" />
        <input type="hidden" name="section_id" />
        <input type="hidden" name="api-action" value="set-guild-config" />
        <div class="mdc-text-field">
          <input type="text" id="target-rename-section-value" class="mdc-text-field__input" name="value">
          <label class="mdc-floating-label" for="target-rename-section-value">New Channel/Section ID</label>
          <div class="mdc-line-ripple"></div>
        </div>
      </div>
      <footer class="mdc-dialog__actions">
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="renameSection" name="mode" value="renameSection">
          <span class="mdc-button__label">Rename</span>
        </button>
        <button type="button" class="mdc-button mdc-dialog__button" data-mdc-dialog-action="close">
          <span class="mdc-button__label">Cancel</span>
        </button>
      </footer>
    </div>
    </form>
  </div>
  <div class="mdc-dialog__scrim"></div>
</div>
<?php
if (isset($_REQUEST['guild_id'])
    && (isset($user_guilds[$_REQUEST['guild_id']])
    || ($user->id == $fletcher_main_config['discord']['globalAdmin']))
    && (($user_guilds[$_REQUEST['guild_id']]['guild']['owner_id'] === $user->id)
    || ($user->id == $fletcher_main_config['discord']['globalAdmin'])
    || (($user_guilds[$_REQUEST['guild_id']]['member']['permissions'] & 0x00000008)
    === 0x00000008)
    )
)
 {
    $guild = $user_guilds[$_REQUEST['guild_id']]['guild'];
    $member = $user_guilds[$_REQUEST['guild_id']]['member'];
    if (isset($fletcher_main_config['extra']['rc-path']) && file_exists($fletcher_main_config['extra']['rc-path'].'/'.$_REQUEST['guild_id'])) {
        $fletcher_guild_config = my_parse_ini_file($fletcher_main_config['extra']['rc-path'].'/'.$_REQUEST['guild_id'], true);
    } else {
        $fletcher_guild_config = ['DEFAULT' => []];
    }
    if (isset($fletcher_main_config['Guild '.$_REQUEST['guild_id']])) {
        foreach ($fletcher_main_config['Guild '.$_REQUEST['guild_id']] as $key => $value) {
            $fletcher_guild_config['DEFAULT'][$key] = ['read_only' => $value];
        }
    }
?>
    <h2><?=$guild['name']?> Server Preferences</h2>
<p><?php if ($guild['owner_id'] == $user->id) { ?>
You own this server.
<?php } elseif (($member['permissions'] & 0x00000008) === 0x00000008) { ?>
You are an administrator for this server, make sure that any changes you make are allowed by owner policy.
<?php } else { ?>
You are a Fletcher administrator, <strong>you do not own this server. Be careful!</strong>
<?php } ?>
<!-- Your permision bitstring for this server is <?=sprintf("0x%08x", $member['permissions'])?>.--></p>
<h3>Bridges</h3>
<?php if (isset($fletcher_guild_config['DEFAULT']['synchronize']) && $fletcher_guild_config['DEFAULT']['synchronize'] === 'on') { ?>
<p>Note that a bridge appearing here only shows one half of the configuration - if messages are only going one way, verify that the other side of the bridge also exists.</p>
<table class="mdc-data-table">
<thead>
<tr class="mdc-data-table__header-row"><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Channel</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Target</th></tr>
</thead>
<tbody class="mdc-data-table__content">
<?php
        $webhooks = $redis->get('discord-'.$guild['id'].'-webhooks');
        if (!empty($webhooks) && !$FLUSH) {
            if ($webhooks === 'continue') {
                unset($webhooks);
            }
            $webhooks = json_decode($webhooks, true);
        }
        if (empty($webhooks) || $FLUSH) {
            $webhooks = json_decode(json_encode($discord->webhook->getGuildWebhooks(['guild.id' => $guild['id']])), true);
            $discord_call_log .= "webhook->getGuildWebhooks\n";
            $redis->setEx('discord-'.$guild['id'].'-webhooks', 6000, json_encode($webhooks));
        }
        $botNavel = $fletcher_main_config['discord']['botNavel'];
        foreach ($webhooks as $webhook) {
            if (substr_compare($webhook['name'], $botNavel . ' (', 0, strlen($botNavel . ' (')) === 0) {
            $title = $redis->get('discord-'.$guild['id'].'-'.$webhook['channel_id']);
            if (empty($title) || $FLUSH) {
                try { 
                    $channel = $discord->channel->getChannel(['channel.id' => $webhook['channel_id']]);
                    $title = '#'.$channel->name;
                } catch (GuzzleHttp\Command\Exception\CommandClientException $e) {
                    $title = 'Forbidden to list channel ('.$e->getCode().')';
                }
                $discord_call_log .= "guild->getChannel\n";
                $redis->setEx('discord-'.$guild['id'].'-'.$webhook['channel_id'], 6000, $title);
            }
?>
            <tr class="mdc-data-table__row"><td class="mdc-data-table__cell"><?=$title?></td><td class="mdc-data-table__cell"><?=$webhook['name']?></td></tr>
<?php }} ?>
</tbody>
</table>
<?php } else { ?>
<p>Bridges are disabled for this server. To enable, set the <code>synchronize</code> config to <code>on</code> in the <code>General</code> section.</p>
<?php } ?>
<h3>Reports</h3>
<?php
            $rxn_logs = "/pub/lin/personal/rationality/reaction-logs/".$guild['name']."/";
            if (is_dir($rxn_logs)) { ?>
<h4>Reaction Reports</h4>
<?php 
$dir_h = opendir($rxn_logs);
$reports_available = False;
while (($file = readdir($dir_h)) !== false) {
    if ($file[0] === ".") {
        continue;
    }
    $reports_available = True; ?>
<details>
    <summary><?=date("F Y", strtotime(substr($file, 0, -4)))?></summary>
<pre>
<?=file_get_contents($rxn_logs . $file)?>
</pre>
</details>
<?php
}
if ($reports_available === False) { ?>
<p>No reports currently available for this server.</p>
<?php }
            } ?>
<h3>Config</h3>
<p>Use this form to affect Fletcher behavior in this server.</p>
<?php
    foreach ($fletcher_guild_config as $section_name => $section) {
        if (is_numeric($section_name)) {
            $title = $redis->get('discord-'.$guild['id'].'-'.$section_name);
            if (empty($title) || $FLUSH) {
                $channel = $discord->channel->getChannel(['channel.id' => $section_name]);
                $discord_call_log .= "guild->getChannel\n";
                $title = '#'.$channel->name;
                $redis->setEx('discord-'.$guild['id'].'-'.$section_name, 6000, $title);
            }
            if (empty($title)) {
                $title = 'Unknown channel (ID: '.$section_name.')';
            }
        } elseif ($section_name == 'DEFAULT') {
            $title = 'General';
        } else {
            $title = $section_name;
        }
?>
    <h4><?=$title?><?php if ($title !== "General") {?> <button onclick="openRenameSectionDialog(this)" class="mdc-button" data-guild-id="<?=$guild['id']?>" data-section-id="<?=$section_name?>"><span class="mdc-button__label">Rename</span></button><?php } ?></h4>
<button onclick="openAddDialog(this)" class="mdc-button" data-guild-id="<?=$guild['id']?>" data-section-id="<?=$section_name?>"><span class="mdc-button__label">Add Preference</span></button>
<table class="mdc-data-table">
<thead>
<tr class="mdc-data-table__header-row"><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Key</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Value</th></tr>
</thead>
<tbody class="mdc-data-table__content">
<?php
        foreach ($section as $key => $value) {
    if (strpos($key, "password") !== false || strpos($key, "token") !== false) {
        $value = "***";
    }
            if (isset($value['read_only'])) {
?>
<tr class="mdc-data-table__row mdc-data-table__row-read-only"><td class="mdc-data-table__cell"><?=$key?></td><td class="mdc-data-table__cell" title="Read-only, you cannot set global preferences"><?=$value['read_only']?></td></tr>
<?php } else { ?>
<tr class="mdc-data-table__row" data-guild-id="<?=$guild['id']?>" data-section-id="<?=$section_name?>" data-preference-key="<?=$key?>" data-preference-value="<?=$value?>"><td class="mdc-data-table__cell"><?=$key?></td><td class="mdc-data-table__cell"><?=$value?></td><td class="mdc-data-table__cell"><button onclick="openEditDialog(this)" class="mdc-button"><span class="mdc-button__label">Edit</span></button></td></tr>
<?php }} ?>
</table>
<?php } ?>
<button onclick="openAddSectionDialog(this)" class="mdc-button" data-guild-id="<?=$guild['id']?>"><span class="mdc-button__label">Add Section</span></button>
<?php
    render_toc('../' . $_REQUEST['guild_id'] . '.toc');
} elseif (isset($_REQUEST['guild_id']) && isset($user_guilds[$_REQUEST['guild_id']]) && file_exists('../' . $_REQUEST['guild_id'] . '.toc')) {
    $guild = $user_guilds[$_REQUEST['guild_id']]['guild'];
?>
    <h2><?=$guild['name']?> Server Information</h2>
<p>You are a member of this server. If you expected to see configuration information, please contact your server owner to update permisssions.</p>
<?php render_toc('../' . $_REQUEST['guild_id'] . '.toc');
} elseif (isset($_REQUEST['view']) && $_REQUEST['view'] === "global-preferences" && $user->id == $fletcher_main_config['discord']['globalAdmin']) {
?>
<h2>Global Preferences</h2>
<p>Can't be edited using the web interface for now. May contain defaults for various guilds.</p>
<?php
foreach ($fletcher_main_config as $section_name => $section) {
    ?><h3><?=$section_name?></h3>
<table class="mdc-data-table">
<thead>
<tr class="mdc-data-table__header-row"><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Key</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Value</th></tr>
</thead>
<tbody class="mdc-data-table__content">
<?php
    foreach ($section as $key => $value) {
    if (strpos($key, "password") !== false || strpos($key, "token") !== false) {
        $value = "***";
    }
?>
<tr class="mdc-data-table__row" data-preference-key="<?=$key?>" data-preference-value="<?=$value?>"><td class="mdc-data-table__cell"><?=$key?></td><td class="mdc-data-table__cell"><?=$value?></td></tr>
<?php } ?>
</table>
<?php
}
} elseif (empty($user->id) && isset($_REQUEST['view']) && $_REQUEST['view'] === "reciprocity") {
    ?>Redirecting you to login, page requires authorization...<script>document.location = 'https://fletcher.fun/oauth2/start'</script><?php
} elseif (!empty($user->id) && isset($_REQUEST['view']) && $_REQUEST['view'] === "reciprocity") {
$query = 'SELECT value FROM user_preferences WHERE user_id = $1 AND guild_id IS NULL AND key = \'reciprocity\';';
$result = pg_query_params($query, [$user->id]) or die('Query failed: ' . pg_last_error());
$line = pg_fetch_array($result, null, PGSQL_ASSOC);
if ($line && $line["value"] === "True") {
    $reciprocity_enabled = true;
?><p>Reciprocity matching is enabled on your profile. To disable, DM Fletcher with <code>!preference reciprocity False</code>.</p>
<?php
    $profile = '';
    if (isset($_POST['profile'])) {
        $query = 'INSERT INTO user_preferences (user_id, key, value) VALUES ($1, \'profile\', $2) ON CONFLICT (user_id, key, (guild_id IS NULL)) WHERE guild_id IS NULL DO UPDATE SET value = excluded.value;';
        $result = pg_query_params($query, [$user->id, $_POST['profile']]) or die('Query failed: ' . pg_last_error());
        $profile = $_POST['profile'];
    } else {
        $query = 'SELECT value FROM user_preferences WHERE user_id = $1 AND key = \'profile\' AND guild_id IS NULL;';
        $result = pg_query_params($query, [$user->id]) or die('Query failed: ' . pg_last_error());
        $profile = pg_fetch_row($result)[0];
    }
    ini_set('display_errors', 1);
    $poss_matches = [];
$query = 'SELECT user_id FROM user_preferences WHERE guild_id IS NULL AND key = \'reciprocity\' AND value = \'True\' ORDER BY user_id DESC';
$result = pg_query_params($query, []) or die('Query failed: ' . pg_last_error());
$true_recip = array_map(function ($line) {return $line['user_id'];}, pg_fetch_all($result));
$query = 'SELECT user_id FROM user_preferences WHERE guild_id IS NULL AND key = \'reciprocity\' AND value != \'True\' ORDER BY user_id DESC';
$result = pg_query_params($query, []) or die('Query failed: ' . pg_last_error());
$false_recip = array_map(function ($line) {return $line['user_id'];}, pg_fetch_all($result));
    foreach ($user_guilds as $guild) {
        if (isset($fletcher_main_config['extra']['rc-path']) && file_exists($fletcher_main_config['extra']['rc-path'].'/'.$guild['guild']['id'])) {
            $fletcher_guild_config = my_parse_ini_file($fletcher_main_config['extra']['rc-path'].'/'.$guild['guild']['id'], true);
        } else {
            $fletcher_guild_config = ['DEFAULT' => []];
        }
        # TODO support paging
            $guild_members = $redis->get('discord-'.$guild['guild']['id'].'-members-1');
            if (empty($guild_members) || $FLUSH) {
                $guild_members = $discord->guild->listGuildMembers(['guild.id' => (int) $guild['guild']['id'], 'limit' => 1000]);
                $discord_call_log .= "guild->listGuildMembers\n";
                $redis->setEx('discord-'.$guild['guild']['id'].'-members-1', 60000, json_encode($guild_members));
            }
            else {
                $guild_members = json_decode($guild_members);
            }
            $filter = function ($member) use ($true_recip) {
                return in_array($member->user->id, $true_recip);
            };
            if (isset($fletcher_guild_config['DEFAULT']['reciprocity']) && $fletcher_guild_config['DEFAULT']['reciprocity'] === 'True') {
                $filter = function ($member) use ($false_recip) {
                    return !in_array($member->user->id, $false_recip);
                };
            }
            $guild_members = array_filter($guild_members, $filter);
            foreach ($guild_members as $member) {
                if (isset($poss_matches[$member->user->id])) {
                    $poss_matches[$member->user->id]['guilds'][] = $guild['guild'];
                } else {
                    $poss_matches[$member->user->id] = objectToArray($member);
                    $poss_matches[$member->user->id]['guilds'] = [$guild['guild']];
                }
            }
        }
unset($poss_matches[$user->id]);
            ?>
<form method="POST">
<label style="font-weight: bold" for="profile">Your profile (max 4000 char)</label>
<button onclick="document.forms[0].submit()" class="mdc-button" ><span class="mdc-button__label">Save All</span></button>
<div><textarea maxlength="4000" style="max-width: 1000px; width: 100%; min-height: 5em" id="profile" name="profile" placeholder="e.g. 'I don't use this for dating, and I'm mostly looking for female friends'. Discord Markdown OK."><?=$profile?></textarea></div>
<style>
@media screen and (max-width: 800px) {
table td {
display: inline-block;
width: 48%;
}
table tr:first-of-type {
display: none;
}
table td:nth-of-type(1) div {
max-height: 4em;
overflow: hidden;
}
table td:nth-of-type(2) div {
height: 32px;
}
table tr {
border-bottom: 1px grey solid;
}
}
@media screen and (max-width: 600px) {
table td {
display: inline-block;
width: 48%;
}
table td:nth-of-type(1) {
width: 100%;
}
table td:nth-of-type(2) {
width: 100%;
}
table td:nth-of-type(2) div {
height: 32px !important;
width: 100% !important;
}
}
@media screen and (max-width: 850px) {
main#main-content {
padding: 1em;
}
}
@media screen and (min-width: 801px) {
table label {
display: none;
}
table td:nth-of-type(1) div {
max-height: 12em;
overflow: hidden;
}
table th:nth-of-type(2) {
width: 160px;
}
table td:nth-of-type(2) div {
max-width: 160px; 
}
table td:nth-of-type(2) {
width: 160px;
}
table th:nth-of-type(3) {
width: 1%;
}
table th:nth-of-type(4) {
width: 1%;
}
table td:nth-of-type(3) {
width: 1%;
}
table td:nth-of-type(4) {
width: 1%;
}
}
table {
padding: 1em;
}
</style>
                <table class="mdc-data-table" id="members" name="members">
<thead>
<tr>
                <th role="columnheader" scope="col">Member</th>
                <th role="columnheader" scope="col">Mutual&nbsp;Servers</th>
                <th role="columnheader" scope="col" id="match-friend-label">Hang&nbsp;out some&nbsp;time</th>
                <th role="columnheader" scope="col" id="match-date-label">Go&nbsp;on a&nbsp;date or&nbsp;something</th>
</tr>
</thead>
                <tbody>
                <?php
$query = 'SELECT m1.user2 AS user_id, m1.description AS description, m2.description AS reciprocal_description, m1.notification_sent FROM matches m1 LEFT JOIN matches m2 ON m1.user1 = m2.user2 AND m1.user2 = m2.user1 WHERE m1.user1 = $1';
$result = pg_query_params($query, [$user->id]) or die('Query failed: ' . pg_last_error());
$descriptions = [];
while ($line = pg_fetch_array($result)) {
    $descriptions[$line['user_id']] = $line;
}
$query = 'SELECT user_id, value FROM user_preferences WHERE key = \'profile\' AND user_id IN (' . implode(',', array_map(function ($member) {return $member['user']['id'];}, $poss_matches)) . ');';
$result = pg_query_params($query, []) or die('Query failed: ' . pg_last_error());
while ($line = pg_fetch_array($result)) {
    $profiles[$line['user_id']] = $line['value'];
}
            foreach ($poss_matches as $member) {
                ?><tr>
                    <td><img role="presentation" src="https://cdn.discordapp.com/avatars/<?=$member['user']['id']?>/<?=$member['user']['avatar']?>.png" ><span title="<?=htmlspecialchars($member['user']['username'])?>"><?=htmlspecialchars(isset($member['nick']) ? $member['nick'] : $member['user']['username']) ?></span><div><?=isset($profiles[$member['user']['id']]) ? $profiles[$member['user']['id']] : ''?></div></td>
<td><div style="height: <?=min(96, 32*ceil(sizeof($member['guilds'])/5))?>px;overflow: clip">
<?php foreach ($member['guilds'] as $guild) {
if ($guild['icon']) {?>
                <img style="margin-right: 0;" src="https://cdn.discordapp.com/icons/<?=$guild['id']?>/<?=$guild['icon']?>.png?size=32"  role="presentation" title="<?=htmlspecialchars($guild['name'])?>" />
<?php } else { ?>
<i class="material-icons" style="font-size: 32px; margin-right: 0; display: inline-block" role="presentation" title="<?=htmlspecialchars($guild['name'])?>">explore</i><?php }} ?></div></td>
<td><input <?php if (isset($descriptions[$member['user']['id']]) && str_contains($descriptions[$member['user']['id']]['description'], 'friend')) {?>checked<?php } ?> id="match-friend-<?=$member['user']['id']?>" name="match-friend-<?=$member['user']['id']?>" type="checkbox" aria-labelledby="match-friend-label" /><label for="match-friend-<?=$member['user']['id']?>">Hang out some time</label></td>
<td><input <?php if (isset($descriptions[$member['user']['id']]) && str_contains($descriptions[$member['user']['id']]['description'], 'date')) {?>checked<?php } ?> id="match-date-<?=$member['user']['id']?>" name="match-date-<?=$member['user']['id']?>" type="checkbox" aria-labelledby="match-date-label" /><label for="match-date-<?=$member['user']['id']?>">Go on a date or something</label></td>
</tr><?php
            }
?></tbody></table>
<input type="hidden" name="view" value="reciprocity" />
<button onclick="document.forms[0].submit()" class="mdc-button" ><span class="mdc-button__label">Save All</span></button>
</form>
<?php
} else {
    $reciprocity_enabled = false;
?><p>Reciprocity matching is disabled on your profile. You may still be matched with if you are in a server where the owner has enabled this, but you will not receive notifications about this. To enable, DM Fletcher with <code>!preference reciprocity True</code>.</p>
<?php
}
} elseif (isset($_REQUEST['view']) && $_REQUEST['view'] === "emoji") {
include('../emoji_fragment.html');
} elseif (isset($_REQUEST['view']) && $_REQUEST['view'] === "scheduler" && $user->id == $fletcher_main_config['discord']['globalAdmin']) {
?>
<h2>Scheduler</h2>
<p>Current tasks scheduled for running via the TXF.</p>
<?php
// Performing SQL query
// fletcher=#  CREATE TABLE reminders (userid bigint NOT NULL, guild bigint NOT NULL, channel bigint NOT NULL, message bigint NOT NULL, content text, created timestamp without time zone, scheduled timestamp without time zone, trigger_type text);

$query = 'SELECT userid, guild, channel, message, content, created, scheduled, trigger_type FROM reminders ORDER BY scheduled DESC;';
$result = pg_query_params($query, []) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
?><table class="mdc-data-table">
<thead>
<tr class="mdc-data-table__header-row"><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Member</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Guild</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Channel</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Message ID</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Content</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Created</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Scheduled</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Trigger Type</th></tr>
</thead>
<tbody class="mdc-data-table__content">
<?php
// Report all errors except E_NOTICE
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    $member = $redis->get('discord-'.$line['guild'].'-member-'.$line['userid']);
    if (empty($member) || $FLUSH) {
        if ((int)$line['guild'] !== 0) {
            $member = $discord->guild->getGuildMember(['guild.id' => (int) $line['guild'], 'user.id' => (int) $line['userid']]);
        } else {
            $member = $discord->user->getUser(['user.id' => (int) $line['userid']]);
        }
        $discord_call_log .= "guild->getGuildMember\n";
        $member = isset($member->nick) && $member->nick ? $member->nick : (isset($member->user) ? $member->user->username . '#' . $member->user->discriminator : $member->username . '#' . $member->discriminator);
        $redis->setEx('discord-'.$line['guild'].'-member-'.$line['userid'], 6000, $member);
    }
    if ($line['channel'] && $line['guild']) {
        $channel_name = array_reduce($user_guilds[$line['guild']]['guild']['channels'], function ($result, $channel) use ($line) {
            return $channel['id'] === (int) $line['channel']? $channel['name'] : $result;
        });
    } else {
        $channel_name = '';
    }
    if (empty($channel_name) || $channel_name === '#') {
        $channel_name = 'Unknown channel '.$line['channel'];
    }
    if (explode(' ', $line['trigger_type'], 2)[0] === 'overwrite') {
        $trigger_type = '<h4>Overwrites:</h4><dl>';
        $no_overwrites_flag = 1;
        foreach (array_filter(json_decode(explode(' ', $line['trigger_type'], 2)[1], true), function ($po) {return (bool) $po;}) as $tuple) {
            if (isset($tuple[1])) {
                $trigger_type = $trigger_type . '<dt>' . var_export($tuple[0], TRUE). '</dt><dd>' . var_export($tuple[1], TRUE). '</dd>';
                $no_overwrites_flag = 0;
            }
        }
        if ($no_overwrites_flag === 1) {
            $trigger_type = '<h4>Reset Permissions to Default</h4>';
        } else {
            $trigger_type = $trigger_type .'</dl>';
        }
    } else {
        $trigger_type = $line['trigger_type'];
    }
?>
<tr class="mdc-data-table__row">
<td class="mdc-data-table__cell" onclick="navigator.clipboard.writeText(this.title)" title="<?=$line['userid']?>"><?=$member ? $member : $line['userid']?></td>
<td class="mdc-data-table__cell" onclick="navigator.clipboard.writeText(this.title)" title="<?=$line['guild']?>"><?=$line['guild'] ? $user_guilds[$line['guild']]['guild']['name'] : 'N/A'?></td>
<td class="mdc-data-table__cell" onclick="navigator.clipboard.writeText(this.title)" title="<?=$line['channel']?>"><?=$channel_name?></td>
<td class="mdc-data-table__cell"><?=$line['message']?></td>
<td class="mdc-data-table__cell"><?=$line['content']?></td>
<td class="mdc-data-table__cell"><?=$line['created']?></td>
<td class="mdc-data-table__cell"><?=$line['scheduled']?></td>
<td class="mdc-data-table__cell"><?=$trigger_type?></td>
</tr>
<?php } ?>
</table>
<?php

// Free resultset
pg_free_result($result);
} elseif (isset($_REQUEST['view']) && $_REQUEST['view'] === "user-preferences") {
?>
<h2>User Preferences</h2>
<p>These preferences are usually scoped to a guild. Select <em>All guilds</em> to add a key that applies to all guilds (this may not be applicable to all preference types).</p>
<?php
// Performing SQL query
// fletcher=# CREATE TABLE user_preferences (user_id BIGINT NOT NULL, guild_id BIGINT NOT NULL, key TEXT NOT NULL, value TEXT);
if ($user->id == $fletcher_main_config['discord']['globalAdmin']) {
    $query = 'SELECT user_id, guild_id, key, value FROM user_preferences WHERE (user_id = $1) OR True ORDER BY user_id, guild_id, key;';
} else {
    $query = 'SELECT user_id, guild_id, key, value FROM user_preferences WHERE user_id = $1 ORDER BY guild_id, key;';
}
$result = pg_query_params($query, [$user->id]) or die('Query failed: ' . pg_last_error());

// Printing results in HTML
?><table class="mdc-data-table">
<thead>
<tr class="mdc-data-table__header-row"><?php if ($user->id == $fletcher_main_config['discord']['globalAdmin']) { ?><th class="mdc-data-table__header-cell" role="columnheader" scope="col">User</th><?php } ?><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Guild</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Key</th><th class="mdc-data-table__header-cell" role="columnheader" scope="col">Value</th></tr>
</thead>
<tbody class="mdc-data-table__content">
<?php
while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    $key = $line["key"];
    $value = $line["value"];
    if (strpos($key, "password") !== false || strpos($key, "token") !== false) {
        $value = "***";
    }
?>
<tr class="mdc-data-table__row" data-guild-id="<?=$line['guild_id']?>" data-preference-key="<?=$key?>" data-preference-value="<?=$value?>"><?php if ($user->id == $fletcher_main_config['discord']['globalAdmin']) { ?><td class="mdc-data-table__cell"><?=$line['user_id']?></th><?php } ?><td class="mdc-data-table__cell"><?=$user_guilds[$line['guild_id']]['guild']['name']?></td><td class="mdc-data-table__cell"><?=$key?></td><td class="mdc-data-table__cell"><?=$value?></td></tr>
<?php } ?>
</table>
<?php

// Free resultset
pg_free_result($result);
} else {
?>
<h2>About</h2>
<p>This website is a companion to the hosted Fletcher bot instance for managing preferences. If you are the owner of a Discord server with Fletcher in it, the server can be selected from the left hand drawer. All users can select User Preferences to set user-specific configuration options.</p>
<hr>
<h3>Fletcher: A Discord Teleport Bot</h3>
<h4>Copyright (C) 2021 <a href="mailto:fletcher@noblejury.com">Novalinium</a> (<a href="https://noblejury.com">Noble Jury Software</a>)</h4>
<p><em>This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.</em></p>

<p><em>This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.</em><p>

<p<em>You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <a href="https://www.gnu.org/licenses/">https://www.gnu.org/licenses/</a>.</em></p>

<h4>Description</h4>
<p>Fletcher is a message bot that aims to resolve common moderation tasks in
Discord, a popular chat platform. It is designed to be scalable, easy to run,
and secure (e.g. will not interfere with other programs running on the same
host and will not disclose user information inappropriately). </p>

<p>Functionality at time of writing includes:</p>
<ul>
<li> Teleports between channels, including across servers
<li> One or two way synchronization between channels, including across servers
<li> Spoiler codes for text (ROT13 [classic] and memfrob [wider character support
  and name obfuscation]) and images
<li> Channel activity checks
<li> User activity checks
<li> Voice channel updates
<li> Moderation reports (automated and manual)
<li> Moderation role ping bypass
<li> Moderation permissions elevation (similar to `<code>sudo</code>`)
<li> Issue tracker integration
<li> Management of new server members (role assignment, rules acknowledgement,
  auto role save and restore)
<li> GitHub integration
</ul>
<p>And a few more fun modules:</p>
<ul>
<li> Collective action coordination
<li> Music relay
<li> Math rendering
<li> Random image posting (Google Photos)
<li> ShindanMaker integration
<li> RetroWave Image Generator
</ul>

<h4>Installation:</h4>
<p>If you would like to self-host Fletcher, email the author: we'll work something
out. This is a source code release of only the main modules, without optional
modules or other ancillaries provided. Alternatively, simply add the hosted
Fletcher to your own Discord server using the OAuth grant link at
<a href="https://fletcher.fun/add">https://fletcher.fun/add</a>.</p>

<h4>Documentation:</h4>
<p>Documentation for this code is in progress at <a href="https://man.sr.ht/~nova/fletcher">https://man.sr.ht/~nova/fletcher</a>,
but the author strives to make the code readable without much trouble. This area
is under development. Currently, the bot can self-report loaded commands with
the <code>`!help'</code> command, as well as some additional information with the <code>`verbose'</code>
parameter. In addition, a command flow diagram is included in controlflow.dot,
as well as a PNG (Warning: large file) at
<a href="https://novalinium.com/rationality/fletcher.png">https://novalinium.com/rationality/fletcher.png</a>.</p>

<figure>
<img src="https://media.discordapp.net/attachments/542033764260511765/835740077983531018/unknown.png" alt="Fletcher as depicted by @ghostmusing. A small white bird with golden eyes and a haloof blue and red-orange hues." />
<figcaption>Fletcher fanart by <a href="https://instagram.com/ghostmusing">@ghostmusing</a></figcaption>
</figure>

<h4>Development:</h4>
<p>Development can be tracked via the project issue tracker at
<a href="https://todo.sr.ht/~nova/fletcher">https://todo.sr.ht/~nova/fletcher</a>, and on the author's blog at
<a href="https://novalinium.com/blog">https://novalinium.com/blog</a>. Most announcements take place on a Discord that
this bot was built for, email the author if you would like access to the
announcements Discord. Development and hosting costs are generously supported
through Ko-Fi (<a href="https://ko-fi.com/novalinium/">https://ko-fi.com/novalinium/</a>): it takes time and
resources to support this bot, and Liberapay helps make this possible.</p>

<p>If you have feature requests or would like to contribute to the project,
patches are accepted by email or through the project issue tracker.</p>

<h4>Caveats:</h4>
<p>Warning! This project DOES NOT provide all files needed to self-host. It is
missing the test harness, as well as the debugging, code injection and SystemD
unit files, as well as any database schemas. This software is *not* General
Data Protection Regulation (EU) 2016/679 compliant on its own, and should be
paired with appropriate log parsing software for compliance. Some functionality
may not be ADA Amendments Act of 2008 compliant due to technologic limitations
and/or limited understanding by the author. Finally, per the terms of the AGPL,
there is NO WARRANTY provided with this program. If you would like a less
restrictive license, please contact the author, and we'll discuss it.</p>

<h4 id="privacy">Privacy Policy</h4>
<p>In the hosted version of this bot, we store:</p>
<ul>
<li>Guild IDs</li>
<li>Channel IDs</li>
<li>User IDs</li>
<li>Message IDs</li>
<li>Role IDs</li>
<li>User defined timezones (and other preferences/memos)</li>
<li>Pocket user tokens</li>
</ul>

<p>Why do we need the data, and why do we use this data?</p>
<p>Most data is used in the context of creating bridges between discords in which case message-message correspondance has to be stored. Some is also used for configuration storage for features like timezone conversions, moon phases, timestamps in various places and username masks.</p>

<p>Other than Discord, do we share your data with any 3rd parties?</p>
<p>We use Sentry as part of development.</p>

<p>How can users get data removed, or how can users contact the bot admin?</p>
<p><a href="mailto:fletcher@noblejury.com">fletcher@noblejury.com</a></p>
<?php } ?>
<?=$discord_call_log?>
-->
<footer>Fletcher is generously supported via <a href="https://ko-fi.org/novalinium">Ko-fi</a>. Web interface Copyright (C) 2020 <a href="mailto:fletcher@noblejury.com">Novalinium</a> (<a href="https://noblejury.com">Noble Jury Software</a>)</footer>
<?php
if (!isset($_REQUEST['spf'])) { ?>
</main>
<script src="https://dorito.space/bundle.min.js" crossorigin="anonymous"></script>
<script src="https://novalinium.com/js/spf.js"></script>
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<script type="text/javascript">
try {
Sentry.init({ dsn: 'https://d78dcdfaf8624281825f176df5accf17@sentry.io/1842235' });
} catch (error) {
    console.error(error);
}
function textareaDidChange(e) {
        e.target.style.height = 'auto';
        e.target.style.height = e.target.scrollHeight + 'px';
    }

    async function postData(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
        method: 'POST', // *GET, POST, PUT, DELETE, etc.
            body: data // body data type must match "Content-Type" header
    });
        return await response.json(); // parses JSON response into native JavaScript objects
    }
function openAddSectionDialog(that) {
    let addSectionDialog = document.getElementById('add-section-dialog');
    addSectionDialog.querySelector('input[name="guild_id"]').value   = that.dataset['guildId'];
    window.dialogs['addSectionDialog'].open();
}
function openAddDialog(that) {
    let addDialog = document.getElementById('add-dialog');
    addDialog.querySelector('input[name="guild_id"]').value   = that.dataset['guildId'];
    addDialog.querySelector('input[name="section_id"]').value = that.dataset['sectionId'];
    window.dialogs['addDialog'].open();
}
function openEditDialog(that) {
    let editDialog = document.getElementById('edit-dialog');
    editDialog.querySelector('#edit-dialog-content-text').innerHTML    =             that.parentElement.parentElement.dataset['preferenceKey'];
    editDialog.querySelector('#target-edit-value').labels[0].innerHTML = 'Current: '+that.parentElement.parentElement.dataset['preferenceValue'];
    editDialog.querySelector('input[name="guild_id"]').value           =             that.parentElement.parentElement.dataset['guildId'];
    editDialog.querySelector('input[name="section_id"]').value         =             that.parentElement.parentElement.dataset['sectionId'];
    editDialog.querySelector('input[name="key"]').value                =             that.parentElement.parentElement.dataset['preferenceKey'];
    window.dialogs['editDialog'].open();
}
function spfReload() {
    document.getElementById('main-content-overlay').style.display = 'inherit';
    spf.load(window.location.href, {onDone:  loadhook});
}
function loadhook() {
    let list = new mdc.list.MDCList(document.querySelector('.mdc-list'));
    // const dataTable = [].map.call(document.querySelectorAll('.mdc-data-table'), (dataTable) => new mdc.dataTable.MDCDataTable(dataTable));
    // console.log(dataTable);
const getCellValue = (tr, idx) => { return tr.children[idx].querySelector('input[type="checkbox"]') ? tr.children[idx].querySelector('input[type="checkbox"]').checked : (tr.children[idx].innerText || tr.children[idx].textContent)};

const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

// do the work...
document.querySelectorAll('.mdc-data-table th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('table');
	const tbody = table.querySelector('tbody:last-of-type');
    Array.from(tbody.querySelectorAll('tr'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => tbody.appendChild(tr) );
})));
Array.from(document.getElementsByClassName('mdc-data-table__filter')).forEach(input => document.getElementById(input.dataset.target) && input.addEventListener('keydown', () => Array.from(document.getElementById(input.dataset.target).querySelectorAll('tr')).forEach(tr => tr.classList.toggle('hide', !Array.from(tr.querySelectorAll('td')).map(td => td.innerHTML).some(text => text.includes(input.value))))));
    window.dialogs = {
    'editDialog': new mdc.dialog.MDCDialog(document.getElementById('edit-dialog')),
        'addDialog': new mdc.dialog.MDCDialog(document.getElementById('add-dialog')),
        'addSectionDialog': new mdc.dialog.MDCDialog(document.getElementById('add-section-dialog')),
    };

    let buttonRipples = Array.from(document.querySelectorAll('.mdc-button')).map((buttonEl) => {mdc.ripple.MDCRipple.attachTo(buttonEl)});

    let textField = Array.from(document.querySelectorAll('.mdc-text-field')).map((textField) => {mdc.textField.MDCTextField.attachTo(textField)});
    Object.keys(window.dialogs).forEach((k) => {
    let v = window.dialogs[k];
    v.listen('MDCDialog:closed', () => {
    if (event.detail.action !== "close") {
        event.preventDefault();
        let data = new FormData(event.target.querySelector('form'));
        data.set('mode', event.detail.action);
        postData('/', data).then(console.log).then(spfReload);
    }
    });
    });
    document.getElementById('main-content-overlay').style.display = 'none';
    mdc.autoInit();
    const textareaElements = document.querySelectorAll('textarea');
    for (const textareaElement of textareaElements) {
        textareaElement.addEventListener( 'input', textareaDidChange );
    }
}
function returnToMe () {
    document.cookie = `returnTo=${encodeURIComponent(window.location)}`;
}
window.addEventListener("load", (event) => {
    spf.init();
    window.addEventListener("spfdone", loadhook);
if (document.cookie.indexOf('returnTo') >=0) {
    const cookieValue = document.cookie
        .split('; ')
        .find(row => row.startsWith('returnTo'))
        .split('=')[1];
    document.cookie = "returnTo=; expires=Thu, 01 Jan 1970 00:00:00 GMT";
    document.getElementById('main-content-overlay').style.display = 'inherit';
    spf.navigate(decodeURIComponent(cookieValue), {onDone:  loadhook});
}
    loadhook();
});
</script>
</body>
</html>
<?php }
if (isset($_REQUEST['spf'])) {
    $json = json_encode(array("body" => array(isset($_REQUEST["id"])?$_REQUEST["id"]:"main-content" => ob_get_contents())));
    ob_end_clean();
    header('Content-type: application/json');
    echo $json;
}
