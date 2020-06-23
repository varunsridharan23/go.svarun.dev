<?php
define( 'APP_PATH', __DIR__ . '/' );
define( 'SAVE_PATH', APP_PATH . '../../envato/' );
define( 'ITEMS_JSON_LINK', 'https://cdn.svarun.dev/envato/items.json' );
try {
	$json = json_decode( file_get_contents( ITEMS_JSON_LINK ), true );
	if ( isset( $json['plugins'] ) ) {
		foreach ( $json as $group => $items ) {
			foreach ( $items as $item ) {
				$id            = $item['id'];
				$url           = ( isset( $item['ref_url'] ) ) ? $item['ref_url'] : false;
				$url           = ( empty( $url ) && isset( $item['url'] ) ) ? $item['url'] : $url;
				$content       = file_get_contents( APP_PATH . 'envato-redirect.md' );
				$slug          = $item['slug'];
				$mini_slug     = $item['mini_slug'];
				$redirect_from = <<<TEXT
    - /${slug}/
    - /envato/${slug}/
    - /${mini_slug}/
    - /envato/${mini_slug}/
TEXT;
				$content       = str_replace( array(
					'{item_title}',
					'{redirect_to}',
					'{redirect_from}',
				), array( $item['name'], $url, $redirect_from ), $content );
				@mkdir( SAVE_PATH, '0777', true );
				if ( ! file_exists( SAVE_PATH . $id . '.md' ) ) {
					file_put_contents( SAVE_PATH . $id . '.md', $content );
				}
			}
		}
	}
} catch ( Exception $exception ) {
	$msg = '🛑 Unknown Error !!' . PHP_EOL . PHP_EOL;
	$msg .= print_r( $exception->getMessage(), true );
	die( $msg );
}