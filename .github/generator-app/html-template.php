<!DOCTYPE html>
<html lang="en-US">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-63845590-5"></script>

<script>
	window.dataLayer = window.dataLayer || [];

	function gtag() {
		dataLayer.push( arguments );
	}

	gtag( 'js', new Date() );
	gtag( 'config', 'UA-63845590-5' );
</script>

<meta charset="utf-8">

<title><?php echo $title; ?>  | <?php echo $app_config['default_title']; ?></title>

<link rel="canonical" href="<?php echo $redirect_url; ?>">

<script>location = "<?php echo $redirect_url; ?>"</script>

<meta http-equiv="refresh" content="0; url=<?php echo $redirect_url; ?>">

<meta name="robots" content="noindex">

<h1><?php echo $app_config['default_heading']; ?> | <?php echo $title; ?> </h1>

<a href="<?php echo $redirect_url; ?>>">Click here if you are not redirected.</a>

</html>