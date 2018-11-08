<?php

/**
 * �н鵣��Ӧ����
 * ============================================================================
 * api˵����
 * getKey()/setKey(),��ȡ/������Կ
 * getParameter()/setParameter(),��ȡ/���ò���ֵ
 * getAllParameters(),��ȡ���в���
 * isTenpaySign(),�Ƿ�Ƹ�ͨǩ��,true:�� false:��
 * doShow(),��ʾ������
 * getDebugInfo(),��ȡdebug��Ϣ
 * 
 * ============================================================================
 *
 */

require ("ResponseHandler.class.php");

class MediPayResponseHandler extends ResponseHandler {
	
	function doShow() {
		$strHtml = "<html><head>\r\n" .
			"<meta name=\"TENCENT_ONLINE_PAYMENT\" content=\"China TENCENT\">" .
			"</head><body></body></html>";
			
		echo $strHtml;
		
		exit;		
	}
	/**
	 * @Override
	 * ǩ������,����ĸa-z����,������ֵ���μ�ǩ��
	 * @return bool
	 */
	function isTenpaySign() {
	
		$signParameterArray = array(
			'attach',
			'buyer_id',
			'cft_tid',
			'chnid',
			'cmdno',
			'mch_vno',
			'retcode',
			'seller',
			'status',
			'total_fee',
			'trade_price',
			'transport_fee',
			'version'
		);
		
		//����ĸa-z����
		ksort($signParameterArray);
		
		foreach($signParameterArray as $k ) {
			$v = $this->getParameter($k);
			if(isset($v)) {
				$signPars .= $k . "=" . urldecode($v) . "&";
			}
		}
		
		$signPars .= "key=" . $this->getKey();
		
		$sign = strtolower(md5($signPars));
		
		$tenpaySign = strtolower($this->getParameter("sign"));
				
		//debug��Ϣ
		$this->_setDebugInfo($signPars . " => sign:" . $sign .
				" tenpaySign:" . $this->getParameter("sign"));
		
		return $sign == $tenpaySign;
	
	}
	
}


?>