<?php

$params = array(
	'uuid' => 'test_uuid_123',
	'client_ip' => '36.110.43.178',
	'user_id' => '101',
	'platform_logic' => '31',
	'payment_mode_id' => '3',
	'total_amount' => '0.03',
	'order_detail' => array(
		array(
			'business_logic' => '1',
			'city_id' => '1',
			'order_id' => '9001',
			'subtotal' => '0.01',
			'subject' => '东方菜馆1',
			'quantity' => '3',
		),
		array(
			'business_logic' => '1',
			'city_id' => '1',
			'order_id' => '9001',
			'subtotal' => '0.02',
			'subject' => '东方菜馆2',
			'quantity' => '3',
		),
	),
	'time_start' => $_SERVER['REQUEST_TIME'],
	'time_expire' => $_SERVER['REQUEST_TIME'] + 600,
	'notify_url' => 'http://dev.sll.payment.daojia.com.cn/tests/callback.php',
);

$client = new Yar_Client('http://dev.payment.daojia.com.cn/payment/gateway');
$result = $client->getTransactionCode($params);
var_dump($result);