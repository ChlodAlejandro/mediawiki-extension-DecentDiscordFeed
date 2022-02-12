<?php

namespace MediaWiki\Extension\DecentDiscordFeed;

use RecentChange;
use Title;

class Utils {

	/**
	 * @param \RecentChange $rc
	 * @param string $wikitext
	 * @return string
	 */
	public static function wikitextToMarkdown( RecentChange $rc, string $wikitext ): string {
		$parsed = $wikitext;
		$diffTitle = Title::newFromText(
			'Special:Diff/' . $rc->getAttribute( 'rc_this_oldid' )
		);
		$diffUrl = $diffTitle->getFullURL();

		// Parse section links
		$parsed = preg_replace_callback(
			'/\/\*\*?\s*(.+?)\s*\*\*?\/(\s*$)?/i',
			static function ( $matches ) use ( $diffUrl ) {
				$sectionName = $matches[1] . ( ( $matches[2] == null ) ? ': ' : '' );
				$sectionFragment = preg_replace( '/\s+/', '_', $sectionName );

				return "[\u{2192}$sectionName]($diffUrl#$sectionFragment)"
					. !empty( $matches[2] ) ? $matches[2] : "";
			},
			$parsed
		);

		// Parse intrawiki links
		return preg_replace_callback(
			'/\[\[(.+?)(?:\|(.+?))?]]/i',
			static function ( $matches ) {
				$linkLabel = $matches[2] ?? $matches[1];
				$linkUrl = preg_replace( '/\s+/', '_', $matches[1] );

				return "[$linkLabel]($linkUrl)";
			},
			$parsed
		);
	}

	/**
	 * @param string $username
	 * @return string
	 */
	public static function getUserLinkMarkdown( string $username ): string {
		$linkUserpage = Title::newFromText( $username, NS_USER )
			->getFullUrl();
		$linkTalkpage = Title::newFromText( $username, NS_USER_TALK )
			->getFullUrl();
		$linkContributions = Title::newFromText( 'Special:Contributions/' . $username )
			->getFullUrl();

		return "[$username]($linkUserpage) ([talk]($linkTalkpage) | [contribs]($linkContributions))";
	}

	/**
	 * @param string $text
	 * @return string
	 */
	public static function codeBlock( string $text ): string {
		return "```\n" . $text . "\n```";
	}

	/**
	 * @param array $var
	 * @return bool
	 */
	public static function isArray( array $var ): bool {
		return is_array( $var ) && array_diff_key( $var, array_keys( array_keys( $var ) ) );
	}

}
