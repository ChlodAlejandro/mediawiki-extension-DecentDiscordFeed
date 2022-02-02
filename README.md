# DecentDiscordFeed
Provides a decent Discord webhook feed based on stjohannson's WikiBot embed look and feel.

## Usage
1. Clone the extension into your `extensions` folder.
2. Load the extension in your LocalSettings.php
```php
wfLoadExtension( 'DecentDiscordFeed' );
```
3. Configure your webhook URL.
```php
$wgDecentDiscordFeedWebhook = "https://discord.com/api/webhooks/...";
```
4. You're done!
