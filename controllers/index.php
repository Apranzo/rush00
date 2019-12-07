<?php
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
print_r($uri."\n");
$uri = explode( '/', $uri );
print_r($uri);
print_r($_GET);
$_SESSION
if ($uri[1] == 'view') {
	load_view(array_slice($uri, 2));
}
if ($uri[1] == 'api') {
	load_api(array_slice($uri, 2));
}
