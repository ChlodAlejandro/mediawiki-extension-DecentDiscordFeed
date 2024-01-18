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

namespace MediaWiki\Extension\DecentDiscordFeed\Discord;

use MediaWiki\Extension\DecentDiscordFeed\DiscordHttpRequestFactory;
use MediaWiki\Logger\LoggerFactory;
use MediaWiki\MediaWikiServices;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class WebhookCaller {

	/**
	 * @param string $hook
	 * @param \MediaWiki\Extension\DecentDiscordFeed\Discord\WebhookPayload $payload
	 */
	public static function callWebhook( string $hook, WebhookPayload $payload ): void {
		$logger = LoggerFactory::getInstance( 'DecentDiscordFeed' );
		try {
			/** @type DiscordHttpRequestFactory $http */
			$http = MediaWikiServices::getInstance()->get( 'DiscordHttpRequestFactory' );

			if ( !$http->canMakeRequests() ) {
				$logger->error( 'Cannot make HTTP requests.' );
				return;
			}

			$http->post(
				$hook,
				[
					'logger' => $logger,
					'postData' => $payload->toArray()
				]
			);
		} catch ( NotFoundExceptionInterface $e ) {
			$logger->error( "Couldn't find the DiscordHttpRequestFactory service: {$e->getMessage()}" );
		} catch ( ContainerExceptionInterface $e ) {
			$logger->error( "Couldn't get the DiscordHttpRequestFactory service: {$e->getMessage()}" );
		} catch ( Exception $e ) {
			$logger->error( 'Error while calling Discord webhook: ' . $e->getMessage() );
			$logger->error( 'Payload: ' . json_encode( $payload->toArray() ) );
		}
	}

}
