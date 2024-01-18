# DecentDiscordFeed
No-brainer recent changes to Discord webhook extension.

Provides a decent Discord webhook feed based on stjohannson's
[WikiBot](https://github.com/stjohann/DiscordWikiBot) embed look and feel.

## Usage
1. Clone the extension into your `extensions` folder.
2. Load the extension in your LocalSettings.php
   ```php
   wfLoadExtension( 'DecentDiscordFeed' );
   ```
3. Configure your webhook URL in your `LocalSettings.php`.
   ```php
   $wgDecentDiscordFeedWebhook = "https://discord.com/api/webhooks/...";
   ```
4. You're done!


## Log events
Log events are handled on a "best effort" basis. If the log event is not
supported, it will be printed as serialized data.
