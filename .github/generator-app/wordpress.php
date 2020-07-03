<?php
require_once __DIR__ . '/common.php';
define( 'SAVE_PATH', URLS_FILES . 'wp/plugins/' );
define( 'ITEMS_JSON_LINK', 'https://cdn.svarun.dev/json/wordpress-org-items.json' );
try {
	$json = json_decode( file_get_contents( ITEMS_JSON_LINK ), true );
	if ( is_array( $json ) ) {
		foreach ( $json as $item ) {
			$url           = 'https://wordpress.org/plugins/' . $item['slug'];
			$slug          = $item['slug'];
			$mini_slug     = $item['mini_slug'];
			$redirect_from = array( "/${slug}/" );

			@mkdir( SAVE_PATH, 0777, true );

			file_put_contents( SAVE_PATH . $slug . '.json', json_encode( array(
				$item['name'],
				$url,
				$redirect_from,
			) ) );
		}
	}
} catch ( Exception $exception ) {
	$msg = '🛑 Unknown Error !!' . PHP_EOL . PHP_EOL;
	$msg .= print_r( $exception->getMessage(), true );
	die( $msg );
}
