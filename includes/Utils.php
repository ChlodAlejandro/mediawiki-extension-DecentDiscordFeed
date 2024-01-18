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

namespace MediaWiki\Extension\DecentDiscordFeed;

use RecentChange;
use Title;

class Utils {

	/**
	 * @param RecentChange $rc
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
					. ( !empty( $matches[2] ) ? $matches[2] : "" );
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
