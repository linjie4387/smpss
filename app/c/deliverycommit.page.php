<?php
/**
 * 商品管理
 * @author mol
 *
 */

class c_deliverycommit extends base_c {

    function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			// $this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "配送任务-" . $this->params ['head_title'];
	}
	

    function pagecommit($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		$withgoods_id = $url ['wdi'] ? ( int ) $url ['wdi'] : 1;
		$order_id = $url ['oid'] ? ( int ) $url ['oid'] : 1;
		
		$deliverycommitObj = new m_deliverycommit();
		$sql = "select ifnull(if(fid=0,order_id,fid),order_id) fid from smpss_order where order_id=".$order_id;
		$orderList = $deliverycommitObj->query($sql);
		$orderItems = $orderList->items;
		$order_fid = $orderItems[0]['fid'];

		//var_dump($commitObj);
		if($commitObj){
			$this->params = $this->getComm($withgoods_id);
			$this->params['order_fid'] = $order_fid;
		}else{
			$this->params['order_fid'] = $order_fid;
			$this->params['withgoods_id'] = $withgoods_id;
			$this->params['order_id'] = $order_id;
		}
		
		return $this->render('delivery/commit.html', $this->params);
	}
	
    function pagecreatecommit($inPath) {
        $url = $this->getUrlParams($inPath);
		
		if ($_POST) {
			$result = $_POST['result'];
			$result_desc = $_POST['result_desc'];
			$order_id = $_POST['order_id'];
			$withgoods_id = $_POST['withgoods_id'];
			$order_fid = $_POST['order_fid'];
		}
		
		$data['result']=$result;
		$data['result_desc']=$result_desc;
		$data['withgoods_id']=$withgoods_id;
		$deliverycommitObj = new m_deliverycommit();
		$rs = $deliverycommitObj->create($data);
		
		$this->params = $this->getComm($withgoods_id);
		$this->params['order_fid'] = $order_fid;
		
		if($rs){
			$this->ShowMsg("操作成功！", $this->createUrl("/delivery/deliverygoodsbo-did-".$order_fid.".html"), 2, 1);
			//return $this->render('delivery/commit.html',$this->params);
		}
		
	}
	
	function getComm($withgoods_id){
		$deliverycommitObj = new m_deliverycommit();
		$commitObj = $deliverycommitObj->getObj($withgoods_id);
		return $commitObj;
	}
}
?>