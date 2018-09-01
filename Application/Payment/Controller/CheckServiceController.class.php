<?php
namespace Payment\Controller;

use Think\Controller;

/**
 * 检测Yar请求是否正常
 *
 */
class CheckServiceController extends Controller {
	public function checkYar(){
		$params = array(
				'CityId' 	   => 1,
				'PlatformType' => 'ANDROID',
				'BusinessLogic'=>'ORDER'
		);
		$yar = new \Yar_Client(C("PAYMENTSOA_URL")."/gateway");
		$res = $yar->getPaymentMethods($params);
		$flag = ('200' == $res['status'])? 1:0;
		echo $flag;
	}
}
