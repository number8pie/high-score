<?php
	session_start();

	//Set some important captcha constants
	define('CAPTCHA_NUMCHARS', 6);	// number of characters in pass-phrase
	define('CAPTCHA_WIDTH', 100);		// width of image
	define('CAPTCHA_HEIGHT', 25);		// height of image

	//Generate random pass phrase
	$pass_phrase = "";
	for ($i=0; $i < CAPTCHA_NUMCHARS; $i++) { 
		$pass_phrase .= chr(rand(97, 122)); 
	}
	//chr() matches numbers passed to ASCII chars and returns those chars, rand() generates random numbers between the numbers passed to it.

	//Store the encrypted pass-phrase in a session variable
	$_SESSION['pass_phrase'] = sha1($pass_phrase);

	//Create the image
	$img = imagecreatetruecolor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);

	//Set a white background with black text and grey graphics
	$bg_color = imagecolorallocate($img, 255, 255, 255);
	$text_color = imagecolorallocate($img, 0, 0, 0);
	$graphic_color = imagecolorallocate($img, 64, 64, 64);

	//Fill the background
	imagefilledrectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

	//Draw some random lines
	for ($i=0; $i < 5; $i++) { 
    imageline($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
	}

	//Sprinkle in some random dots
	for ($i=0; $i < 50; $i++) { 
		imagesetpixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
	}

	//for both the random lines and random dots generators:
	//the modulus operator (%) makes sure the random value is less than the CAPTCHA_WIDTH and CAPTCHA_HEIGHT
	//by dividing the rand number by either CAPTCHA_WIDTH or CAPTCHA_HEIGHT and returning the remainder
	//the remainder therefore has to be less than CAPTCHA_WIDTH or CAPTCHA_HEIGHT

	//Draw the pass phrase string
	imagettftext($img, 18, 0 , 5, CAPTCHA_HEIGHT -5, $text_color, "CourierNewBold.ttf", $pass_phrase);
	//Output the image as a PNG using a header
	header("Content-type: image/png");
	imagepng($img);

	//Clean up
	imagedestroy($img);

?>