<?php
// unifi_api_login_example.php
// Standalone example for UniFi guest authorization via API

// Configuration - Replace with your details
$controlleruser = 'your_username';
$controllerpassword = 'your_password';
$controllerurl = 'https://your-controller-ip:8443';
$controllerversion = 'v9'; // Adjust to your controller version
//$site_id = 'default'; // Site ID
$debug = false;

// Guest details from POST or set manually
$site_id = $_POST['site_id'] ?? 'AA:BB:CC:DD:EE:FF'; // MAC to authorize
$client_mac = $_POST['mac'] ?? 'AA:BB:CC:DD:EE:FF'; // MAC to authorize
$ap_mac = $_POST['ap_mac'] ?? '11:22:33:44:55:66'; // AP MAC
$duration = 3600; // Seconds (1 hour)
$up = 5000; // Upload bytes per second
$down = 20000; // Download bytes per second
$bytes = 0; // Total bytes (0 for unlimited)

// Include UniFi API client (assume in same directory or adjust path)
require_once('./UniFi-API-client/src/Client.php');

// Initialize connection
$unifi_connection = new UniFi_API\Client($controlleruser, $controllerpassword, $controllerurl, $site_id, $controllerversion);
$unifi_connection->set_debug($debug);

// Login to controller
$loginresults = $unifi_connection->login();
if (!$loginresults) {
    die('Login failed');
}

// Authorize guest
$auth_result = $unifi_connection->authorize_guest($client_mac, $duration, $up, $down, $bytes, $ap_mac);
if ($auth_result) {
    echo "<h3>Guest authorized successfully!</h3>";
    echo "<p>MAC: $client_mac</p>";
    echo "<p>Duration: $duration seconds</p>";
    // Optional: Redirect or further actions
    // header("Refresh: 3; URL=your-redirect-url");
} else {
    echo "<h3>Authorization failed!</h3>";
}

// Logout (optional)
$unifi_connection->logout();
?>
