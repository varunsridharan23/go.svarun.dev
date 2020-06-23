<?php
define( 'APP_PATH', __DIR__ . '/' );
define( 'SAVE_PATH', APP_PATH . '../../wp/plugins/' );
define( 'ITEMS_JSON_LINK', 'https://cdn.svarun.dev/wordpress.org/plugins.json' );
try {
	$json = json_decode( file_get_contents( ITEMS_JSON_LINK ), true );
	if ( is_array( $json ) ) {
		foreach ( $json as $item ) {
			$content       = file_get_contents( APP_PATH . 'envato-redirect.md' );
			$url           = 'https://wordpress.org/plugins/' . $item['slug'];
			$slug          = $item['slug'];
			$mini_slug     = $item['mini_slug'];
			$redirect_from = <<<TEXT
    - /${slug}/
TEXT;
			$content       = str_replace( array(
				'{item_title}',
				'{redirect_to}',
				'{redirect_from}',
			), array( $item['name'], $url, $redirect_from ), $content );

			@mkdir( SAVE_PATH, '0777', true );
			if ( ! file_exists( SAVE_PATH . $slug . '.md' ) ) {
				file_put_contents( SAVE_PATH . $slug . '.md', $content );
			}
		}
	}
} catch ( Exception $exception ) {
	$msg = '🛑 Unknown Error !!' . PHP_EOL . PHP_EOL;
	$msg .= print_r( $exception->getMessage(), true );
	die( $msg );
}