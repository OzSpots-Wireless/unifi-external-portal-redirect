# UniFi Captive Portal Redirector

The `index.html` file serves as a UniFi captive portal redirector for guest Wi-Fi (SSID: **myhotel**). It uses a **meta refresh tag** with a 0-second delay to silently forward users to an external login page at `https://web.portal.com.au/login.php`.

## Parameters Passed
- `res=notyet` (indicates unauthenticated status)
- `nasid=myhotel` (network ID)
- `ap_mac` (Access Point MAC address)
- `mac` (client MAC address)
- `ssid` (network name, e.g., "myhotel")

This setup supports **API-based login** on the external server for custom authentication flows. The body is empty to ensure a silent redirect.

## Installation
1. Copy the `index.html` file into your UniFi controller at:  
   `/var/lib/unifi/sites/myhotel/app-unifi-hotspot-portal/index.html`
2. Copy the `index.php` file into your web server at:/var/www/html/guest/s/UNIFIID
   

## UniFi Site Setup
- Use **HTTPS** to secure sensitive parameters like MAC addresses.
- Configure via: [https://my.portal.com.au/manage/myhotel/insights/hotspot/portal](https://my.portal.com.au/manage/myhotel/insights/hotspot/portal)

### Controller Settings (Hotspot Section)
- **External portal server**: IP address of `my.portal.com.au`
- **Settings > Show landing page**: Enabled
- **Settings > Secure Portal**: Enabled
- **Settings > Domain**: `my.portal.com.au`
- **Settings > Authorization Access**: Add pre-auth domains (e.g., `google-analytics.com`)

**Important**: Do *not* include 'captive portal' detection domains from Google/Apple/Windows in pre-auth lists, or the redirect will fail.

#### Web Server login
- Use login.php and **UniFi-API-client** for UniFi guest authorization via API.
