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

:warning: Since this plugin uses namespaces, it requires PHP 5.3.0+.