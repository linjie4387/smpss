<?php
class io_weiphp extends SGui{
	private function getJsonParams($assoc=FALSE) {
		$param = $GLOBALS ['HTTP_RAW_POST_DATA'];
		error_log ( '请求报文：' . $param );
		$obj = json_decode ( $param, $assoc);
		return $obj;
	}
	/**
	 * 更新用户订阅状态
	 */
	function pageupdateuser(){
		error_log("receive weiphp update info");
		$param = $this->getJsonParams();
		$openid = $param->openid;
		$status = $param->status;
		$weichatuserObj = new m_weichatuser();
		$data = array(
			"openid" => $openid,
			"status" => $status
		);
		$weichatuserObj->updatesubscribe($data);
	}
	
}