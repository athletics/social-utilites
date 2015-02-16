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

}