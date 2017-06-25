<?php
class c_test extends base_c {

	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "下单管理-" . $this->params ['head_title'];
	}
	

    function pagetest($inPath) {
			$data["token"] = base_Constant::WP_APP_TOKEN;
    		$data["open_id"] = 'o4wVF1Te2vhBi8SKeukvH0IyQxA4';
    		$data["order_id"] = '409';
    		$postData = urldecode(json_encode($data));
    		error_log($postData);
			var_dump($postData);
			echo base_Constant::WP_ORDER_CONFIRM_URL;
    		$resp = base_Utils::httpPost(base_Constant::WP_ORDER_CONFIRM_URL, $postData,array('Content-Type'=>'text/plain;charset=UTF-8'));
			var_dump($resp);
    		/*error_log($resp);*/
	}

}
?>