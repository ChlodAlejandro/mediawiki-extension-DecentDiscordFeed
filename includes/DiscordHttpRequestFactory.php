<?php

namespace MediaWiki\Extension\DecentDiscordFeed;

use MediaWiki\Http\HttpRequestFactory as MWHHttpRequestFactory;

class DiscordHttpRequestFactory extends MWHHttpRequestFactory {

	/**
	 * @inheritDoc
	 */
	public function create( $url, array $options = [], $caller = __METHOD__ ) {
		if ( isset( $options[ 'postData' ] ) && is_array( $options[ 'postData' ] ) ) {
			$options[ 'postData' ] = json_encode( $options[ 'postData' ] );
		}
		$client = parent::create( $url, $options, $caller );
		if ( isset( $options[ 'postData'] ) ) {
			$client->setHeader( 'Content-Type', 'application/json' );
		}
		return $client;
	}

}
