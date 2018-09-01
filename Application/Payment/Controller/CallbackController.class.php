<?php
namespace Payment\Controller;

use Think\Controller;

/**
 * 支付回调
 *
 */
class CallbackController extends Controller 
{
	/**
	 * @brief notify 支付回调
	 *
	 * @return 
	 */
	public function notify()
	{
		$post = file_get_contents("php://input");
		if(empty($post))
		{
			echo "fail";
			return;
		}
		$date = date("Y-m-d");
		
		if((isset($_POST['out_trade_no']) && isset($_POST['trade_no'])) || isset($_POST['from']))
		{//支付宝,余额系统
			$post = $_POST;
		}
		@file_put_contents("./logs/{$date}_notify.log",var_export($post,true)."\n\n",FILE_APPEND);
		
		$PaymentSoaUrl=C("PAYMENTSOA_URL");
		$yar = new \Yar_Client($PaymentSoaUrl."/transaction");
		$result = $yar->callback($post);
		$this->addBusiLog(array(
				"OrderId"=>"",
				"Tid"=>$this->parseTid($post),
				"Node"=>"回调",
				"Class"=>__CLASS__,
				"Method"=>__FUNCTION__,
				"Entry"=>$post,
				"Return"=>$result,
				"ExtraInfo"=>array(
						"NotifyTime"=>date("Y-m-d H:i:s"),
				),
		));
		if($result === true)
		{
			echo "success";
		}
		else
		{
			echo "fail";
		}
	}

	/**
	 * @brief refund_notify 退款回调
	 *
	 * @return 
	 */
	public function refund_notify()
	{
		if(empty($_POST))
		{
			echo "fail";
			return;
		}
		$post = $_POST;
		$date = date("Y-m-d");
		@file_put_contents("./logs/{$date}_refund_notify.log",var_export($post,true)."\n\n",FILE_APPEND);
		$PaymentSoaUrl=C("PAYMENTSOA_URL");
		$yar = new \Yar_Client($PaymentSoaUrl."/refund");
		$result = $yar->callback($post);
		if($result === true)
		{
			echo "success";
		}
		else
		{
			echo "fail";
		}
	}
	private function addBusiLog(array $data){
		try{
			$PaymentSoaUrl=C("PAYMENTSOA_URL");
			$yar = new \Yar_Client($PaymentSoaUrl."/Tool/BusinessLog");
			$data["Project"]="Payment";
			$yar->addBusiLog($data);
		}catch (\Exception $e){}

	}
	private function parseTid($post)
	{
		$tid = "";
		if (isset($post['out_trade_no']) && isset($post['trade_no'])) {//支付宝
			$tid = $post['out_trade_no'];
		} elseif (isset($post['from'])) {
			$tid = $post['bzParams']['TransactionId'];
		} else { //微信
			libxml_disable_entity_loader(true);
			$data = json_decode((json_encode(simplexml_load_string($post, 'SimpleXMLElement', LIBXML_NOCDATA))), true);
			if ($data === false)//如果是苹果支付
			{
				$result_arr = array();
				parse_str($post, $result_arr);
				$tid = $result_arr['orderId'];
			} else {
				$tid = $data["out_trade_no"];
			}
		}
		return $tid;
	}
}
