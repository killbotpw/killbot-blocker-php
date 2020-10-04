<?php

require_once('class.killbot.php');

$Killbot = new Killbot([
    'active'        => true, // If 'true' will set blocker protection active, and 'false' will deactive protection
    'apikey'        => 'YOUR_APIKEY', // Your API Key from https://killbot.pw/developer
    'bot_redirect'  => 'https://google.com' // Bot will be redirect to this URL
]);
$Killbot->run();

// Your code here
echo 'Not blocked ...';