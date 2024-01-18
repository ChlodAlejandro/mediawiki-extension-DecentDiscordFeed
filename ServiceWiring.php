<?php

use MediaWiki\Config\ServiceOptions;
use MediaWiki\Extension\DecentDiscordFeed\DiscordHttpRequestFactory;
use MediaWiki\Http\HttpRequestFactory;
use MediaWiki\Http\Telemetry;
use MediaWiki\Logger\LoggerFactory;
use MediaWiki\MediaWikiServices;

return [
	'DiscordHttpRequestFactory' => static function ( MediaWikiServices $services ): DiscordHttpRequestFactory {
		return new DiscordHttpRequestFactory(
			new ServiceOptions(
				HttpRequestFactory::CONSTRUCTOR_OPTIONS,
				$services->getMainConfig()
			),
			LoggerFactory::getInstance( "DiscordHttpRequestFactory/http" ),
			Telemetry::getInstance()
		);
	}
];
