<?php
// add to portal web server for unifi redirect: /var/www/html/guest/s/index.php
// UniFi External Portal Redirector: Bridges to API login server.
// Captures client params from GET and forwards.

// Fetch and sanitize GET params to prevent injection (basic XSS mitigation).
$id = isset($_GET['id']) ? htmlspecialchars($_GET['id'], ENT_QUOTES, 'UTF-8') : '';
$ap = isset($_GET['ap']) ? htmlspecialchars($_GET['ap'], ENT_QUOTES, 'UTF-8') : '';
$url = isset($_GET['url']) ? htmlspecialchars($_GET['url'], ENT_QUOTES, 'UTF-8') : ''; // Unused; could enable post-auth redirect.
$ssid = isset($_GET['ssid']) ? htmlspecialchars($_GET['ssid'], ENT_QUOTES, 'UTF-8') : '';

// Hardcoded for this site; future: use config/DB for dynamic nasid handling (e.g., switch on $_GET['nasid']).
$nasid = 'myhotel';
$siteid = '6erty546'; 

// Redirect to external login with params. Uses HTTPS for security.
header("Location: https://my.portal.com.au/logiu.php?res=notyet&id=$id&ap=$ap&ssid=$ssid&siteid=$siteid&nasid=$nasid");
exit(); // Ensure no further output.
?>
