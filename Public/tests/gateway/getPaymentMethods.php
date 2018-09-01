<?php

$client = new Yar_Client('http://dev.sll.payment.daojia.com.cn/payment/gateway');
$params['city_id'] = '1';
$params['platform_logic'] = '31';
$result = $client->getPaymentMethods($params);
var_dump($result);