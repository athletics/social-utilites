# Social Utilities

A lightweight WordPress plugin providing commonly needed methods for interacting with social networks.

## Features

- Handles the asynchronous load of social network JavaScript libraries (like Facebook’s SDK):
	- Libraries are conditionally loaded as needed.
	- Events are broadcasted when libraries are loaded and elements are rendered.
- Generates markup for the following social buttons:
	- Facebook Follow Button
	- Facebook Like Button
	- Facebook Page Plugin
	- Google+ Follow Button
	- Twitter Follow Button
- Get usernames from profile URLs:
	- Facebook Username
	- Twitter Username

## Usage

:warning: All functions are in the following namespace: `Athletics\Social_Utilities`

### Username Functions

```php
get_username_from_url( $url, $type )
get_facebook_username( $url )
get_twitter_username( $url )
```

### Markup Functions

```php
facebook_follow_button( $username, $args = array() )
facebook_like_button( $url, $args = array() )
facebook_page_plugin( $page_url, $args = array() )
google_plus_follow_button( $page_id, $args = array() )
twitter_follow_button( $username, $args = array() )
```

:warning: Since this plugin uses namespaces, it requires PHP 5.3.0+.