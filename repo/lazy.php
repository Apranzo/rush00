<?php

define('STORAGE_USERS', '/storage/users');
define('STORAGE_ROLES', '/storage/roles');
define('STORAGE_PRODUCTS', '/storage/products');
define('STORAGE_RESOURS_IMG', '/storage/res/img');

$users_id_next = 1;

$users_fd = -1;
$roles_fd = -1;
$products_fd = -1;

init_storage();
function erase_val(&$myarr) {
	$myarr = array_map(create_function('$n', 'return null;'), $myarr);
}

function loging($mess) {
//	file_exists()
}

function create_roles($user) {
	foreach ($user['roles'] as $role);
}

#region user
function create_user($user) {
	if ($user['id'])
		loging('user_'.$user['id'].'_exists');
	create_roles($user);
	$user[history] = '';
	$fds = init_storage();
	while (($exists = fgetcsv($fds['users']))) {
		if ($exists['login'] === $user['login']);
	}
	$passwd = hash('sha64', $user['passwd']);


	fputcsv(init_storage()['users_id'], $user);
}
function get_user($id) {
	$fds = init_storage();
	while ($id != ($user = fgetcsv($fds['users']))['id']);
	if (!$user)
		return;
//	$user['passwd'] = null;
	while (!roles_are_filled($user) && ($role = fgetcsv($fds['users']))) {
		foreach ($user['roles'] as $key => $val)
			if ($key == $role['id'] )
				$user['roles'][$key] = $role;
	}
	return $user;
}

function	roles_are_filled($user) {
	foreach ($user['roles'] as $key => $val)
		if (!$val)
			return false;
	return true;
}

function	init_storage()
{
	$fds = ['users' => '', 'roles' => '', 'products' => ''];

	if ($GLOBALS['users_fd']) {
		$fds['users'] = $GLOBALS['users_fd'];
	} else if(!file_exists(STORAGE_USERS)) {
		$GLOBALS['users_fd'] = fopen(STORAGE_USERS, 'r+') or exit("Can't open ".STORAGE_USERS."!");
	}
	if ($GLOBALS['roles_fd']) {
		$fds['roles'] = $GLOBALS['roles_fd'];
	} else if(!file_exists(STORAGE_ROLES)){
		$GLOBALS['roles_fd'] = fopen(STORAGE_ROLES, 'r+') or exit("Can't open ".STORAGE_ROLES."!");
	}
	if ($GLOBALS['products_fd']) {
		$fds['products'] = $GLOBALS['products_fd'];
	} else if(!file_exists(STORAGE_PRODUCTS)){
		$GLOBALS['products_fd'] = fopen(STORAGE_PRODUCTS, 'r+') or exit("Can't open ".STORAGE_PRODUCTS."!");
	}
	foreach ($fds as $key => $val)
		if (!$val)
			return init_storage();
	foreach ($fds as $key => $val)
		rewind($val);
	return $fds;
}

#endregion