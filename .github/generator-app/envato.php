<?php
require_once __DIR__ . '/common.php';

define( 'SAVE_PATH', URLS_FILES . 'envato/' );
define( 'ITEMS_JSON_LINK', 'https://cdn.svarun.dev/envato/items.json' );
try {
	$json = json_decode( file_get_contents( ITEMS_JSON_LINK ), true );
	if ( isset( $json['plugins'] ) ) {
		foreach ( $json as $group => $items ) {
			foreach ( $items as $item ) {
				$id            = $item['id'];
				$url           = ( isset( $item['ref_url'] ) ) ? $item['ref_url'] : false;
				$url           = ( empty( $url ) && isset( $item['url'] ) ) ? $item['url'] : $url;
				$slug          = $item['slug'];
				$mini_slug     = $item['mini_slug'];
				$redirect_from = array(
					"/${slug}/",
					"/envato/${slug}/",
					"/${mini_slug}/",
					"/envato/${mini_slug}/",
				);

				@mkdir( SAVE_PATH, 0777, true );
				if ( ! file_exists( SAVE_PATH . $id . '.json' ) ) {
					file_put_contents( SAVE_PATH . $id . '.json', json_encode( array(
						$item['name'],
						$url,
						$redirect_from,
					) ) );
				}
			}
		}
	}
} catch ( Exception $exception ) {
	$msg = '🛑 Unknown Error !!' . PHP_EOL . PHP_EOL;
	$msg .= print_r( $exception->getMessage(), true );
	die( $msg );
}