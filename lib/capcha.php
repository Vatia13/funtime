<?php
/*
 *
 * CMS osRealty 2.1.x
 * Autor: Roman Chernyshov
 * E-mail: support@osRealty.ru
 * URL: www.osRealty.ru
 *
*/

error_reporting(E_ERROR | E_WARNING | E_PARSE);
require_once('captcha.class.php');
session_start();
//session_name('captcha');
$captcha = new Image(); 
$captcha->AddHendler( 'imagetype', array( 'jpeg', 100 ) );
$captcha->addImage( '120', '50' );
$captcha->addText( 1, rand( 17, 18 ) );
//$captcha->addBorder();
$captcha->AddFilter( 'smooth', 20  );
//$captcha->AddFilter( 'meanremoval' );
//$captcha->AddFilter( 'edgedetect'  );
//$captcha->AddFilter( 'brightness', rand( 0, 100 ) );
//$captcha->AddNoise( '200' );
$captcha->draw();
$_SESSION['captha_text'] = $captcha->getCaptchaText();
