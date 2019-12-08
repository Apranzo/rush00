<?php
// public directory definition
$public_dir = __DIR__.'/public';

// serve existing files as-is
if (file_exists($_SERVER["DOCUMENT_ROOT"].'/'.$_SERVER['REQUEST_URI'])) {
	header('Content-Type: image/png');
	return FALSE;
}

switch ($_SERVER["SCRIPT_NAME"]) {
	case "/php-template/about.php":
		$CURRENT_PAGE = "About";
		$PAGE_TITLE = "About Us";
		break;
	case "/php-template/contact.php":
		$CURRENT_PAGE = "Contact";
		$PAGE_TITLE = "Contact Us";
		break;
	default:
		$CURRENT_PAGE = "Index";
		$PAGE_TITLE = "Welcome to my homepage!";
}


// patch SCRIPT_NAME and pass the request to index.php
//$_SERVER['SCRIPT_NAME'] = 'index.php';
require(($_SERVER["DOCUMENT_ROOT"]).'/controllers/index.php');