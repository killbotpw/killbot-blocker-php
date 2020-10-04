# Killbot Blocker PHP Library
This PHP library can detect and block fake IPs that connect to your Web applications, HTML5 websites, and APIs from Hosting, Proxy, or VPN to prevent bots, fake accounts, fraudsters, suspicious transactions, malicious users and more.

## Example
This is ecample how to use the library. It's will help you to integrate with any PHP application.
You can insert this code into your ```blocker.php```, ```config.php```, or maybe ```header.php``` as example.

```php
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
```

## API Documentation
https://documenter.getpostman.com/view/10201011/SzmmTZtS?version=latest

## Have Problem?
Contact us at https://go.killbot.pw/r/MRQNte1