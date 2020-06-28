<?php
require_once __DIR__ . '/common.php';
global $app_config, $table_list;
$app_config = array();

function get_absolute_path( $path ) {
	return trim( trim( str_replace( URLS_FILES, '', $path ), '/' ) );
}

try {
	if ( ! file_exists( APP_PATH . 'config.json' ) ) {
		throw new Error( '⚠️ App Config File Not Found !' );
	}
	$app_config = json_decode( file_get_contents( APP_PATH . 'config.json' ), true );
	$path1      = glob( URLS_FILES . '*.json' );
	$path2      = glob( URLS_FILES . '*/*.json' );
	$path3      = glob( URLS_FILES . '*/*/*.json' );
	$path4      = glob( URLS_FILES . '*/*/*/*.json' );
	$url_files  = array_filter( array_unique( array_merge( $path1, $path2, $path3, $path4 ) ) );
	$table_list = array();
	if ( ! file_exists( APP_OUTPUT ) ) {
		mkdir( APP_OUTPUT, 0777, true );
	}

	if ( ! empty( $url_files ) ) {
		global $redirect_url, $title;
		foreach ( $url_files as $json_file ) {
			$json = json_decode( file_get_contents( $json_file ), true );
			if ( isset( $json[0] ) ) {
				$master_url = get_absolute_path( $json_file );
				echo '###[group] Generating For ' . $master_url . PHP_EOL;
				$title        = $json[0];
				$redirect_url = false;
				$alternates   = false;

				if ( false !== filter_var( $json[0], FILTER_VALIDATE_URL ) ) {
					$redirect_url = $json[0];
					$alternates   = isset( $json[1] ) ? $json[1] : array();
				} else {
					$redirect_url = $json[1];
					$alternates   = isset( $json[2] ) ? $json[2] : array();
				}

				if ( ! is_array( $alternates ) ) {
					$alternates = array( $alternates );
				}

				$print = implode( PHP_EOL, $alternates );

				echo <<<TEXT
	Title        : ${title}
	Redirect URL : ${redirect_url}
	Master URL   : ${master_url}
	Alternates   : ${print}

TEXT;

				$alternates[] = $master_url;
				if ( ! isset( $table_list[ $redirect_url ] ) ) {
					$table_list[ $redirect_url ] = array(
						'name' => $title,
						'urls' => array(),
					);
				}
				foreach ( $alternates as $aurl ) {
					$aurl                                  = str_replace( '.json', '', $aurl );
					$table_list[ $redirect_url ]['urls'][] = $aurl;
					if ( ! file_exists( APP_OUTPUT . $aurl ) ) {
						mkdir( APP_OUTPUT . $aurl, 0777, true );
					}

					ob_start();
					include APP_PATH . 'html-template.php';
					$html = ob_get_clean();
					file_put_contents( APP_OUTPUT . $aurl . '/index.html', $html );
				}
				echo '###[endgroup]' . PHP_EOL;
			} else {
				echo "⚠️ Excluding File @ ${json_file}" . PHP_EOL;
			}
		}

		ob_start();
		include APP_PATH . 'main-index.php';
		$html = ob_get_clean();
		file_put_contents( APP_OUTPUT . '/index.html', $html );
	}
} catch ( Exception $exception ) {
	$msg = '🛑 Unknown Error !!' . PHP_EOL . PHP_EOL;
	$msg .= print_r( $exception->getMessage(), true );
	die( $msg );
}