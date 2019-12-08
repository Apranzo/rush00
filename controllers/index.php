<?php

include './repo/lazy.php';
function load_view($uri) {
    $table = '<div  class="table">';
	$row = 	'<div class="row">';
	$col = 	'<div class="col">';
	$endiv = '</div>';
    $products = get_products();
    $view = $table;
    foreach ($products as $pr) {
        $img = $pr['img'];
    	$view .=$row.$col.'<img  src="/storage'.$img.'"/>'.$endiv.$endiv;
    }
    $view .= $endiv;
    return $view;
}

function load_content() {
	$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$uri = explode( '/', $uri );
	return load_view(array_slice($uri, 2));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Shop</title>
	<link rel="stylesheet" href="/css/responsive.css">
</head>
<body>

<header class="row">

</header>

<div class="title">
	<h1>Shopy</h1>
</div>

<div id="content">
			<?php echo load_content() ?>
</div>
	</div>
</div>


</body>
</html>


