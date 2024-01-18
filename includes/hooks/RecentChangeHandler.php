<?php
/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 *
 * @file
 */

namespace MediaWiki\Extension\DecentDiscordFeed\Hooks;

use MediaWiki\Extension\DecentDiscordFeed\Discord\WebhookCaller;
use MediaWiki\Extension\DecentDiscordFeed\Discord\WebhookPayload;
use MediaWiki\Logger\LoggerFactory;
use MediaWiki\MediaWikiServices;

class RecentChangeHandler implements \MediaWiki\Hook\RecentChange_saveHook {

	/**
	 * @inheritDoc
	 */
	public function onRecentChange_save( $recentChange ): bool {
		LoggerFactory::getInstance( 'DecentDiscordFeed' )
			->info( 'RecentChangeHandler::onRecentChange_save()' );

		$config = MediaWikiServices::getInstance()->getConfigFactory()->makeConfig( 'decentdiscordfeed' );
		$hook = $config->get( 'DecentDiscordFeedWebhook' );

		LoggerFactory::getInstance( 'DecentDiscordFeed' )
			->debug( "Sending to hook: $hook" );

		WebhookCaller::callWebhook(
			$hook,
			WebhookPayload::recentChangeToPayload( $recentChange )
		);

		return true;
	}

}
