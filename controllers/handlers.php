

<!--урлы
$_SESSION['basket'] корзина;

$user = [
		id => '1',
		login => '',
		paswd => '',
		orders =>


	];


$order = [
	'date' => '',
	'products' => [ id =>, img =>, description => 'asdf', tag, price
	],
	'status' => ''
];

get_products() : массив [0 =>  [ id =>, img =>, description => 'asdf', tag(категория)], 1 => ...]
<div class='table-row'> контенер
<div class='cell'>product</>





-->

<?php
	$handlers = [
		'get' => [
			'users' => [
				'id' => '',
				'filter' => '',
			],
			'products' => [
				'img'
				'id' => '',
				'filter' => [
					'name' => '',
					'tag' => ''
				],
			],
		],

		'post' => [
			'orders' => '',
			'users' => '',
			'products' => ''
		],
		'put' => [
			'orders' => '',
			'users' => '',
			'products' => ''
		],
		'del' => [
			'orders' => '',
			'users' => '',
			'products' => ''
		],
	];

	function post_user($req)	{
		if (login_exists($req['login'])) {
			return -1;
		};

		$user = [
			id => increment_user_id(),
			login => $req['login'],
			paswd => hash($req['passwd']),
			roles => [
				[
					'type' => 'customer',
					'busket' => [
						'content' => '',
						'cost' => '',
					],

					'history' => [
						[
							'data' => '',
							'buscket' => '',
							'status' => ''
						]
					] //orders
				],
				[
					'type' => 'admin'
				]

			],

		];

	}


//		login => '',
//		paswd => '',
//		orders => [
//			[
//				'type' => 'customer',
//				'busket' => [
//					'content' => '',
//					'cost' => '',
//				],
//
//				'history' => [
//					[
//						'data' => '',
//						'buscket' => '',
//						'status' => ''
//					]
//				] //orders
//			],
//			[
//				'type' => 'admin'
//			]
//
//		],

	];
		check_ permissions($_SESSION);

	}