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

class EmbedField {

	/** @var string */
	private $name;
	/** @var string */
	private $value;
	/** @var bool */
	private $inline;

	/**
	 * @param ?string $name
	 * @param ?string $value
	 * @param ?bool $inline
	 */
	public function __construct( ?string $name, ?string $value, bool $inline = false ) {
		$this->name = $name;
		$this->value = $value;
		$this->inline = $inline;
	}

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return EmbedField
	 */
	public function setName( string $name ): EmbedField {
		$this->name = $name;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getValue(): string {
		return $this->value;
	}

	/**
	 * @param string $value
	 * @return EmbedField
	 */
	public function setValue( string $value ): EmbedField {
		$this->value = $value;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isInline(): bool {
		return $this->inline;
	}

	/**
	 * @param bool $inline
	 * @return EmbedField
	 */
	public function setInline( bool $inline ): EmbedField {
		$this->inline = $inline;

		return $this;
	}

	/**
	 * Returns the embed fields as an associative array, to later be encoded in JSON.
	 * @return array
	 */
	public function toArray(): array {
		return array_filter( [
			'name' => $this->getName(),
			'value' => $this->getValue(),
			'inline' => $this->isInline()
		] );
	}

}
