<?php
	define('FONT', 'arialbold.ttf');
	
	$colors = array (
		'couleur' => array ( 226, 0, 64 ),
		'niveaugris' => array ( 0, 0, 0),
		'mononoir' => array ( 0, 0, 0),
		'monorouge' => array ( 226, 0, 64),
		'monoblanc' => array ( 255, 255, 255)
	);

	if ( array_key_exists( $_REQUEST['version'], $colors) && file_exists( $_REQUEST['version'].'.png' ) ) {
		$file = $_REQUEST['version'].'.png';
		$im = imagecreatefrompng( $file );
	} elseif ( array_key_exists( $_REQUEST['version'], $colors) && file_exists ( $_REQUEST['version'].'.jpg' ) ) {
		$file = $_REQUEST['version'].'.jpg';
		$im = imagecreatefromjpeg( $file );
	} else {
		$file = 'couleur.png';
		$im = imagecreatefrompng( $file );
	}

	$size = getimagesize( $file );
		
	$text_color = imagecolorallocate( $im,
		$colors[$_REQUEST['version']][0],
		$colors[$_REQUEST['version']][1],
		$colors[$_REQUEST['version']][2]
	);

	if ( file_exists(FONT) ) {
		imagettftext( $im, 20, 0, 100, 400, $text_color, FONT, strip_tags($_REQUEST['text']) );
	} else {
		die('Font error');
	}
	
	
	if ( (int)$_REQUEST['width'] > 0 ) {

		$newheight = ( $size[1] / $size[0])*$_REQUEST['width'];
		$newsize = array ( (int)$_REQUEST['width'], (int)$newheight);
		$om = imagecreatetruecolor( $newsize[0], $newsize[1] );

		if ( imagecopyresized( $om, $im, 0, 0, 0, 0, $newsize[0], $newsize[1], $size[0], $size[1] ) ) {
			$out = $om;
		} else {
			die ('resize error');
		}
	} else {
		$out = $im;
	}
		
	header("Content-Type: image/png");
	header('Content-Disposition: attachment; filename="logo_ps_'.time().'.png"');
	imagepng($out);
	imagedestroy($im);
	
?>