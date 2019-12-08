<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
print_r($uri);
if ($uri[2] == 'img') {
	header('Content-Type: image/png');
	readfile('storage/img/'.$uri[3]);
	exit();
}
//exit();