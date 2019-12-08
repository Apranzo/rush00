<?php

define('STORAGE_USERS', 'storage/users');
define('STORAGE_ORDERS', 'storage/orders');
define('STORAGE_PRODUCTS', 'storage/products');
define('STORAGE_NEXT_IDS', 'storage/ids');
define('STORAGE_RESOURS_IMG', 'storage/res/img');

$users_id_next = 1;
$orders_id_next = 1;
$products_id_next = 1;

$users_fd = 0;
$orders_fd = 0;
$products_fd = 0;

init_fd_start();

function loging($mess) {
//	file_exists()
}

function get_id($type) {
	$fd = fopen(STORAGE_NEXT_IDS, 'r+') or exit("Can't open ".STORAGE_NEXT_IDS."!");
	$max_ids = json_decode(fgets($fd), true);
	$id = $max_ids[$type];
	$max_ids[$type] += 1;
	rewind($fd);
	fputs($fd, json_encode($max_ids, JSON_FORCE_OBJECT) . "\n");
	fclose($fd);
	return $id;
}

function get_user_id() {
	return get_id('users');
}

function get_order_id() {
	return get_id('orders');
}

function get_product_id() {
	return get_id('products');
}


#region product
function get_product($id) {
	$fds = init_fd_start();
	while (($product =  json_decode(fgets($fds['products']), true))) {
		if ($id == $product['id'])
			break;
	}
	return $product;
}

function get_products() {
	$fd = init_fd_start()['products'];
	$products = [];
	while(!feof($fd)) {
		$products[] = json_decode(fgets($fd), true);
	}
	return $products;

}
function del_product($id) {
	$fd = init_fd_start()['products'];
	$file = [];
	while(!feof($fd)) {
		$file[] = fgets($fd);
	}

	foreach($file as $product) {
		if(json_decode($product, true)['id'] != $id) {
			fwrite($fd, json_encode($product, JSON_FORCE_OBJECT) . "\n");
		}
	}
}

function create_product($product) {
	if ($product['id']) {
		loging('user_'.$product['id'].'_exists');
		return;	}

	$product['id'] = get_product_id();
	$fds = init_fd_end();
	fputs($fds['products'], json_encode($product, JSON_FORCE_OBJECT)."\n");
}
#endregion

#region order
function get_order($id) {
	$fds = init_fd_start();
	while (($order =  json_decode(fgets($fds['orders']), true))) {
		if ($id == $order['id'])
			break;
	}
	return $order;
}

function del_order($id) {
	$fd = init_fd_start()['orders'];
	$file = [];
	while(!feof($fd)) {
		$file[] = fgets($fd);
	}

	foreach($file as $order) {
		if(json_decode($order, true)['id'] != $id) {
			fwrite($fd, json_encode($order, JSON_FORCE_OBJECT) . "\n");
		}
	}
}

function create_order($order) {
	if ($order['id']) {
		loging('user_'.$order['id'].'_exists');
		return;
	}

	$order['id'] = get_order_id();
	foreach ($order['products'] as $product) {
		$order['total'] += $product['cost'];
	}
	$fds = init_fd_start();
	fputs($fds['orders'], json_encode($order, JSON_FORCE_OBJECT)."\n");
}
#endregion



#region user
function delete_user($id) {
	$fd = init_fd_start()['users'];
	$file = [];
	while(!feof($fd)) {
		$file[] = fgets($fd);
	}

	foreach($file as $user) {
		if(json_decode($$user, true)['id'] != $id) {
			fwrite($fd, json_encode($user, JSON_FORCE_OBJECT) . "\n");
		}
	}
}
function update_user($user) {
	if (!$user['id'])
		loging('update_user_'.$user['id'].'_not_exists');
	$fd = fopen(STORAGE_USERS, 'r+') or exit("Can't open ".STORAGE_USERS."!");
	fputs($fd, json_encode($user, JSON_FORCE_OBJECT) . "\n");
}
function create_user([logd => "sf", ]) {
	if ($user['id']) {
		loging('user_'.$user['id'].'_exists');
		return;
	}

	$user['id'] = get_user_id();
	$fds = init_fd_start();
	while (($exists = json_decode(fgets($fds['users']), true))) {
		if ($exists['login'] === $user['login']) {
			echo "login_exists\n";
		}
	}
	$user['passwd'] = hash('sha256', $user['passwd']);
	fputs($fds['users'], json_encode($user, JSON_FORCE_OBJECT)."\n");
}
function get_user($id) {
	$fds = init_fd_start();
	while (($user =  json_decode(fgets($fds['users']), true))) {
		if ($id == $user['id'])
			break;
	}
	return $user;
}

function	roles_are_filled($user) {
	foreach ($user['orders'] as $key => $val)
		if (!$val)
			return false;
	return true;
}

function	init_fd_start()
{
	$fds = ['users' => '', 'orders' => '', 'products' => ''];
	$fds['users'] = fopen(STORAGE_USERS, 'r+') or exit("Can't open ".STORAGE_USERS."!");
	$fds['orders'] = fopen(STORAGE_ORDERS, 'r+') or exit("Can't open ".STORAGE_ORDERS."!");
	$fds['products'] = fopen(STORAGE_PRODUCTS, 'r+') or exit("Can't open ".STORAGE_PRODUCTS."!");
	return $fds;
}
function	init_fd_end()
{
	$fds = ['users' => '', 'orders' => '', 'products' => ''];
	$fds['users'] = fopen(STORAGE_USERS, 'a+') or exit("Can't open ".STORAGE_USERS."!");
	$fds['orders'] = fopen(STORAGE_ORDERS, 'a+') or exit("Can't open ".STORAGE_ORDERS."!");
	$fds['products'] = fopen(STORAGE_PRODUCTS, 'a+') or exit("Can't open ".STORAGE_PRODUCTS."!");
	return $fds;
}

#create_product(['name' => 'say my name','taq' => ['party'], 'cost' => 33.50, 'desc' => 'Best Sellers!', 'img' => '/storage/img/heisenberg.jpg']);
#endregion
create_user(['login' => 'admin', 'passwd' => '123', 'roles' => ['admin', 'customer'], orders => []]);
