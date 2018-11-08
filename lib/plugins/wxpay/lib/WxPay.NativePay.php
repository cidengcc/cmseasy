<?php

require_once "WxPay.Api.php";
require_once "WxPay.Notify.php";
require_once "log.php";


class PayNotifyCallBack extends WxPayNotify
{
    public $xml = '';
    public $return = false;
    //查询订单
    public function Queryorder($transaction_id)
    {
        $input = new WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = WxPayApi::orderQuery($input);
        Log::DEBUG("query:" . json_encode($result));
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            return true;
        }
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {

        Log::DEBUG("call back:" . json_encode($data));
        /*$notfiyOutput = array();

        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if(!$this->Queryorder($data["transaction_id"])){
            $msg = "订单查询失败";
            return false;
        }*/
        //file_put_contents('xxx.txt',var_export($data,true));
        if($data['result_code'] == 'SUCCESS' && $data['return_code'] == 'SUCCESS'){
            if(pay::changeorders3($data['attach'],$data)){
                $this->return = true;
            }
        }else{
            return false;
        }
        return true;
    }
}


class NativeNotifyCallBack extends WxPayNotify
{

	public function unifiedorder($openId, $product_id)
	{

		//统一下单
		$input = new WxPayUnifiedOrder();
		$input->SetBody("test");
		$input->SetAttach("test");
		$input->SetOut_trade_no(WxPayConfig::$MCHID.date("YmdHis"));
		$input->SetTotal_fee("1");
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		$input->SetGoods_tag("test");
		$input->SetNotify_url("http://test2.cmseasy.cn/index.php?case=archive&act=respond");
		$input->SetTrade_type("NATIVE");
		$input->SetOpenid($openId);
		$input->SetProduct_id($product_id);
		Log::DEBUG("bbbbbb:" . var_export($input,true));
		$result = WxPayApi::unifiedOrder($input);
		Log::DEBUG("unifiedorder:" . json_encode($result));
		return $result;
	}

	public function NotifyProcess($data, &$msg)
	{
		//Log::DEBUG("sss".var_export($data,true));
		//echo "处理回调";
		Log::DEBUG("call back:" . json_encode($data));

		if(!array_key_exists("openid", $data) ||
			!array_key_exists("product_id", $data))
		{
			$msg = "回调数据异常";
			return false;
		}

		$openid = $data["openid"];
		$product_id = $data["product_id"];

		//统一下单
		$result = $this->unifiedorder($openid, $product_id);
		Log::DEBUG("ccc".var_export($result,true));
		if(!array_key_exists("appid", $result) ||
			!array_key_exists("mch_id", $result) ||
			!array_key_exists("prepay_id", $result))
		{
			$msg = "统一下单失败";
			return false;
		}

		$this->SetData("appid", $result["appid"]);
		$this->SetData("mch_id", $result["mch_id"]);
		$this->SetData("nonce_str", WxPayApi::getNonceStr());
		$this->SetData("prepay_id", $result["prepay_id"]);
		$this->SetData("result_code", "SUCCESS");
		$this->SetData("err_code_des", "OK");
		return true;
	}
}

/**
 * 
 * 刷卡支付实现类
 * @author widyhu
 *
 */
class NativePay
{
	/**
	 * 
	 * 生成扫描支付URL,模式一
	 * @param BizPayUrlInput $bizUrlInfo
	 */
	public function GetPrePayUrl($productId)
	{
		$biz = new WxPayBizPayUrl();
		$biz->SetProduct_id($productId);
		$values = WxpayApi::bizpayurl($biz);
		$url = "weixin://wxpay/bizpayurl?" . $this->ToUrlParams($values);
		return $url;
	}
	
	/**
	 * 
	 * 参数数组转换为url参数
	 * @param array $urlObj
	 */
	private function ToUrlParams($urlObj)
	{
		$buff = "";
		foreach ($urlObj as $k => $v)
		{
			$buff .= $k . "=" . $v . "&";
		}
		
		$buff = trim($buff, "&");
		return $buff;
	}
	
	/**
	 * 
	 * 生成直接支付url，支付url有效期为2小时,模式二
	 * @param UnifiedOrderInput $input
	 */
	public function GetPayUrl($input)
	{
		if($input->GetTrade_type() == "NATIVE")
		{
			$result = WxPayApi::unifiedOrder($input);
			return $result;
		}
	}
}