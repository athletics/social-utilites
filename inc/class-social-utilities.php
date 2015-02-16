<?php

namespace Athletics;

/**
 * Social Utilities
 */
class Social_Utilities {

	/**
	 * Regex for Facebook profile URL
	 * @var string $facebook_regex
	 * @access public
	 */
	public static $facebook_regex = '#https?\://(?:www\.)?facebook\.com/(\d+|[A-Za-z0-9\.]+)/?#';

	/**
	 * Regex for Twitter profile URL
	 * @var string $twitter_regex
	 * @access public
	 */
	public static $twitter_regex = '|https?://(www\.)?twitter\.com/(#!/)?@?([^/\?]*)|';

	/**
	 * Get username from URL
	 *
	 * @param string $url Social profile URL.
	 * @param string $type 'facebook' or 'twitter'
	 * @return false|string Username on success, false on failure.
	 */
	public static function get_username_from_url( $url, $type ) {

		switch ( $type ) {

			case 'facebook':
				$regex = static::$facebook_regex;
				$index = 1;
				break;

			case 'twitter':
				$regex = static::$twitter_regex;
				$index = 3;
				break;

			default:
				return false;

		}

		if ( 1 !== preg_match( $regex, $url, $matches ) ) {
			return false;
		}

		if ( ! isset( $matches[ $index ] ) || empty( $matches[ $index ] ) ) {
			return false;
		}

		return $matches[ $index ];


	}

	/**
	 * Get Facebook username from URL
	 *
	 * @param string $url Facebook profile URL.
	 * @return false|string Facebook username on success, false on failure.
	 */
	public static function get_facebook_username( $url ) {

		return static::get_username_from_url( $url, 'facebook' );

	}

	/**
	 * Get Twitter username from URL
	 *
	 * @param string $url Twitter profile URL.
	 * @return false|string Twitter username on success, false on failure.
	 */
	public static function get_twitter_username( $url ) {

		return static::get_username_from_url( $url, 'twitter' );

	}

	/**
	 * Facebook Follow Button
	 *
	 * @see https://developers.facebook.com/docs/plugins/follow-button
	 * @param string $username Facebook URL to follow.
	 * @param array $args Optional settings for the follow button.
	 * @return string $button Follow button markup.
	 */
	public static function facebook_follow_button( $username, $args = array() ) {

		$defaults = array(
			// 'light' or 'dark'
			'color_scheme' => 'light',
			// 'standard', 'button_count', 'button', or 'box_count'
			'layout' => 'button_count',
			// 'true' or 'false'
			'show_faces' => 'false',
		);

		$args = wp_parse_args( $args, $defaults );
		$args = array_map( 'esc_attr', $args );

		$username = esc_attr( $username );

		$button = <<<EOT
<div class="fb-follow" data-href="https://www.facebook.com/{$username}" data-colorscheme="{$args['color_scheme']}" data-layout="{$args['layout']}" data-show-faces="{$args['show_faces']}"></div>
EOT;

		return $button;

	}

	/**
	 * Facebook Like Button
	 *
	 * @see https://developers.facebook.com/docs/plugins/like-button
	 * @param string $url The URL to like.
	 * @param array $args Optional settings for the like button.
	 * @return string $button Like button markup.
	 */
	public static function facebook_like_button( $url, $args = array() ) {

		$defaults = array(
			// 'like' or 'recommend'
			'action' => 'like',
			// 'light' or 'dark'
			'color_scheme' => 'light',
			// 'standard', 'button_count', 'button', or 'box_count'
			'layout' => 'button_count',
			// 'true' or 'false'
			'show_faces' => 'false',
		);

		$args = wp_parse_args( $args, $defaults );
		$args = array_map( 'esc_attr', $args );

		$url = esc_attr( $url );

		$button = <<<EOT
<div class="fb-like" data-href="{$url}" data-action="{$args['action']}" data-colorscheme="{$args['color_scheme']}" data-layout="{$args['layout']}" data-show-faces="{$args['show_faces']}"></div>
EOT;

		return $button;

	}

	/**
	 * Google+ Follow Button
	 *
	 * @see https://developers.google.com/+/web/follow/
	 * @param string $page_id Google+ page ID to follow.
	 * @param array $args Optional settings for the follow button.
	 * @return string $button Follow button markup.
	 */
	public static function google_plus_follow_button( $page_id, $args = array() ) {

		$defaults = array(
			// 'none', 'bubble', or 'vertical-bubble'
			'annotation' => 'bubble',
			// '15', '20', or '24'
			'height' => '20',
			// 'author' or 'publisher'
			'rel' => 'author',
		);

		$args = wp_parse_args( $args, $defaults );
		$args = array_map( 'esc_attr', $args );

		$page_id = esc_attr( $page_id );

		$button = <<<EOT
<div class="g-follow" data-href="https://plus.google.com/{$page_id}" data-annotation="{$args['annotation']}" data-height="{$args['height']}" data-rel="{$args['rel']}"></div>
EOT;

		return $button;

	}

	/**
	 * Twitter Follow Button
	 *
	 * @see https://dev.twitter.com/docs/follow-button
	 * @param string $username Twitter user to follow.
	 * @param array $args Optional settings for the follow button.
	 * @return string $button Follow button markup.
	 */
	public static function twitter_follow_button( $username, $args = array() ) {

		$defaults = array(
			// 'true' or 'false'
			'show_screen_name' => 'true',
			// 'true' or 'false'
			'show_count' => 'true',
			// 'medium' or 'large'
			'size' => 'medium',
			// 'en', 'fr', 'de', 'it', 'es', 'ko', or 'ja'
			'lang' => 'en',
			// 'true' or 'false'
			'opt_out' => 'true',
		);

		$args = wp_parse_args( $args, $defaults );
		$args = array_map( 'esc_attr', $args );

		$username = str_replace( '@', '', $username );
		$username = esc_attr( $username );

		$button = <<<EOT
<a href="https://twitter.com/{$username}" class="twitter-follow-button" data-show-screen-name="{$args['show_screen_name']}" data-show-count="{$args['show_count']}" data-size="{$args['size']}" data-lang="{$args['lang']}" data-dnt="{$args['opt_out']}">Follow @{$username}</a>
EOT;

		return $button;

	}

}