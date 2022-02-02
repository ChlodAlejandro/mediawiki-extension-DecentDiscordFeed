<?php

namespace MediaWiki\Extension\DecentDiscordFeed\Discord;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use MediaWiki\Logger\LoggerFactory;

class WebhookCaller {

	/**
	 * @param string $hook
	 * @param \MediaWiki\Extension\DecentDiscordFeed\Discord\WebhookPayload $payload
	 */
	public static function callWebhook( string $hook, WebhookPayload $payload ): void {
		if ( $hook == null ) {
			return;
		}

		try {
			$client = new Client();
			$response = $client->post( $hook, [
				RequestOptions::JSON => $payload->toArray()
			] );
			$response->getStatusCode();
		} catch ( GuzzleException $e ) {
			LoggerFactory::getInstance( 'DecentDiscordFeed' )
				->error( 'Error while calling Discord webhook: ' . $e->getMessage() );
			LoggerFactory::getInstance( 'DecentDiscordFeed' )
				->error( 'Payload: ' . json_encode( $payload->toArray() ) );
		}
	}

}
