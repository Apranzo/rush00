<?php
	$user = [
		id => '1',
		login => '',
		paswd => '',
		roles => [
			'#id' =>
			[
				'type' => 'customer',
				'busket' => [
					'content' => '',
					'cost' => '',
				],

				'history' =>
					[ '#id_order' => 'order'

				] //orders
			],
			'#id' => [ 'type' => 'admin' ] //...

		],

	];

	$order = [
		'date' => '',
		'products' => ['#ids...'],
		'status' => ''
	];


