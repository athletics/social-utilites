/**
 * Initialize module.
 *
 * Load social libraries if markup exists.
 */
function init() {

	if ( hasFacebookMarkup() ) {
		createFacebookRootElement();
		loadFacebookLibrary();
	}

	if ( hasGooglePlusMarkup() ) {
		loadGooglePlusLibrary();
	}

	if ( hasTwitterMarkup() ) {
		loadTwitterLibrary();
	}

}

/**
 * Does the document have Facebook follow or like button markup?
 *
 * @return boolean
 */
function hasFacebookMarkup() {

	return 0 !== document.querySelectorAll( '.fb-follow, .fb-like' ).length;

}

/**
 * Does the document have Google+ follow button markup?
 *
 * @return boolean
 */
function hasGooglePlusMarkup() {

	return 0 !== document.getElementsByClassName( 'g-follow' ).length;

}

/**
 * Does the document have Twitter follow button markup>
 *
 * @return boolean
 */
function hasTwitterMarkup() {

	return 0 !== document.getElementsByClassName( 'twitter-follow-button' ).length;

}

/**
 * Asynchronously load javascript library by URL.
 *
 * @param string url The full URL with protocol for the library.
 * @param string id The id for the script element. Used to check that is doesn't already exits.
 * @param function callback A callback function on load.
 */
function loadLibrary( url, id, callback ) {

	if ( null !== document.getElementById( id ) ) {
		callback();
		return;
	}

	var library = document.createElement( 'script' );
	library.id = id;
	library.src = url;
	library.type = 'text/javascript';
	library.async = 'true';
	library.defer = 'true';
	library.addEventListener( 'load', callback, false );

	var script = document.getElementsByTagName( 'script' )[ 0 ];
	script.parentNode.insertBefore( library, script );

}

/**
 * Asynchronously load the Facebook library.
 *
 * @see https://developers.facebook.com/docs/javascript
 */
function loadFacebookLibrary() {

	loadLibrary( 'https://connect.facebook.net/en_US/sdk.js', 'facebook-jssdk', facebookEvents );

}

/**
 * Create #fb-root element if it doesn't exist.
 *
 * The Facebook sdk will complain if this isn't present.
 */
function createFacebookRootElement() {

	if ( null !== document.getElementById( 'fb-root' ) ) {
		return;
	}

	var element = document.createElement( 'div' );
	element.id = 'fb-root';

	document.body.insertBefore( element, document.body.childNodes[ 0 ] );

}

/**
 * Dispatch Facebook events for loaded and rendered.
 *
 * @see https://developers.facebook.com/docs/reference/javascript/FB.Event.subscribe/v2.2
 * @uses FB.Event.subscribe
 */
function facebookEvents() {

	var loaded = new Event( 'facebook:loaded' ),
		rendered = new Event( 'facebook:rendered' );

	document.dispatchEvent( loaded );

	FB.Event.subscribe( 'xfbml.render', function ( response ) {

		document.dispatchEvent( rendered );

	} );

}

/**
 * Asynchronously load the Google+ library.
 */
function loadGooglePlusLibrary() {

	loadLibrary( 'https://apis.google.com/js/plusone.js', 'googleplus-js', googlePlusEvents );

}

/**
 * Dispatch Google+ loaded event.
 */
function googlePlusEvents() {

	var loaded = new Event( 'googleplus:loaded' );

	document.dispatchEvent( loaded );

}

/**
 * Asynchronously load the Twitter library.
 */
function loadTwitterLibrary() {

	createTwitterObject();

	loadLibrary( 'https://platform.twitter.com/widgets.js', 'twitter-wjs', twitterEvents );

	twitterEvents();

}

/**
 * Creates twttr window object. Used for callbacks and events.
 */
function createTwitterObject() {

	window.twttr = window.twttr || {};
	window.twttr._e = [];
	window.twttr.ready = function ( callback ) {
		window.twttr._e.push( callback );
	};

}

/**
 * Bind to Twitter library events, dispatch custom loaded and rendered events.
 *
 * @uses window.twttr
 * @see https://dev.twitter.com/web/javascript/events
 */
function twitterEvents() {

	window.twttr.ready( function ( twttr ) {

		var loaded = new Event( 'twitter:loaded' ),
			rendered = new Event( 'twitter:rendered' );

		twttr.events.bind( 'loaded', function ( response ) {
			document.dispatchEvent( loaded );
		} );

		twttr.events.bind( 'rendered', function ( response ) {
			document.dispatchEvent( rendered );
		} );

	} );

}

module.exports = {
	init: init
};