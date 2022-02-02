<?php

namespace MediaWiki\Extension\DecentDiscordFeed\Discord;

class Embed {

	/** @var int */
	private $color;
	/** @var string */
	private $author;
	/** @var string */
	private $authorUrl;
	/** @var string */
	private $authorIconUrl;
	/** @var string */
	private $title;
	/** @var string */
	private $url;
	/** @var string */
	private $description;
	/** @var string[] */
	private $imageUrls;
	/** @var string */
	private $thumbnailUrl;
	/** @var \MediaWiki\Extension\DecentDiscordFeed\Discord\EmbedField[] */
	private $fields;
	/** @var string */
	private $footerText;
	/** @var int */
	private $footerTimestamp;
	/** @var string */
	private $footerIconUrl;

	/**
	 * @return int
	 */
	public function getColor(): int {
		return $this->color;
	}

	/**
	 * @param int $color
	 * @return Embed
	 */
	public function setColor( int $color ): Embed {
		$this->color = $color;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAuthor(): string {
		return $this->author;
	}

	/**
	 * @param string $author
	 * @return Embed
	 */
	public function setAuthor( string $author ): Embed {
		$this->author = $author;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAuthorUrl(): string {
		return $this->authorUrl;
	}

	/**
	 * @param string $authorUrl
	 * @return Embed
	 */
	public function setAuthorUrl( string $authorUrl ): Embed {
		$this->authorUrl = $authorUrl;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getAuthorIconUrl(): string {
		return $this->authorIconUrl;
	}

	/**
	 * @param string $authorIconUrl
	 * @return Embed
	 */
	public function setAuthorIconUrl( string $authorIconUrl ): Embed {
		$this->authorIconUrl = $authorIconUrl;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return Embed
	 */
	public function setTitle( string $title ): Embed {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getUrl(): string {
		return $this->url;
	}

	/**
	 * @param string $url
	 * @return Embed
	 */
	public function setUrl( string $url ): Embed {
		$this->url = $url;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription(): string {
		return $this->description;
	}

	/**
	 * @param string $description
	 * @return Embed
	 */
	public function setDescription( string $description ): Embed {
		$this->description = $description;

		return $this;
	}

	/**
	 * @return string[]
	 */
	public function getImageUrls(): array {
		return $this->imageUrls;
	}

	/**
	 * @param string[] $imageUrls
	 * @return Embed
	 */
	public function setImageUrls( array $imageUrls ): Embed {
		$this->imageUrls = $imageUrls;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getThumbnailUrl(): string {
		return $this->thumbnailUrl;
	}

	/**
	 * @param string $thumbnailUrl
	 * @return Embed
	 */
	public function setThumbnailUrl( string $thumbnailUrl ): Embed {
		$this->thumbnailUrl = $thumbnailUrl;

		return $this;
	}

	/**
	 * @return \MediaWiki\Extension\DecentDiscordFeed\Discord\EmbedField[]
	 */
	public function getFields(): array {
		return $this->fields;
	}

	/**
	 * @param \MediaWiki\Extension\DecentDiscordFeed\Discord\EmbedField $field
	 * @return Embed
	 */
	public function addField( EmbedField $field ): Embed {
		if ( !isset( $this->fields ) ) {
			$this->fields = [];
		}
		$this->fields[] = $field;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFooterText(): string {
		return $this->footerText;
	}

	/**
	 * @param string $footerText
	 * @return Embed
	 */
	public function setFooterText( string $footerText ): Embed {
		$this->footerText = $footerText;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getFooterTimestamp(): int {
		return $this->footerTimestamp;
	}

	/**
	 * @param int $footerTimestamp
	 * @return Embed
	 */
	public function setFooterTimestamp( int $footerTimestamp ): Embed {
		$this->footerTimestamp = $footerTimestamp;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getFooterIconUrl(): string {
		return $this->footerIconUrl;
	}

	/**
	 * @param string $footerIconUrl
	 * @return Embed
	 */
	public function setFooterIconUrl( string $footerIconUrl ): Embed {
		$this->footerIconUrl = $footerIconUrl;

		return $this;
	}

	/**
	 * Returns the embed fields as an associative array, to later be encoded in JSON.
	 * @return array
	 */
	public function toArray(): array {
		return array_filter( [
			'color' => $this->color,
			'author' => !empty( $this->author ) ? array_filter( [
				'name' => $this->author,
				'url' => $this->authorUrl,
				'icon_url' => $this->authorIconUrl
			] ) : null,
			'title' => $this->title,
			'url' => $this->url,
			'description' => $this->description,
			'image_urls' => $this->imageUrls,
			'thumbnail_url' => $this->thumbnailUrl,
			'fields' => $this->fields != null ? array_map( static function ( EmbedField $field ) {
				return $field->toArray();
			}, $this->fields ) : null,
			'footer' => !empty( $this->footerText ) ? array_filter( [
				'text' => $this->footerText,
				'icon_url' => $this->footerIconUrl
			] ) : null,
			'timestamp' => !empty( $this->footerTimestamp ) ? date( 'c', $this->footerTimestamp ) : null
		] );
	}

}
