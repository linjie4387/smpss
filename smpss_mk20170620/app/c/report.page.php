<?php
/**
 * 数据报表
 */

class c_report extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "报表-" . $this->params ['head_title'];
	}
	//评价数据字典
	private function getAppraiseDict(){
		$dictObj = new m_datadict();
		$items = $dictObj->select("key_id=".base_Constant::KEY_APPAISE_TYPE)->items;
		$result = array();
		foreach ($items as $item) {
			$result[$item['value']] = $item['name']; 
		}
		return $result;
	}
	
	/**
	 * 订单运输统计报表
	 */
	public function pageOrder($inPath){
		$url = $this->getUrlParams ( $inPath );
		if($_POST){
			$stime = $_POST['stime'];
			$etime = $_POST['etime'];
			
			$hospitalOrderObj = new m_hospitalorder();
			$field = "h.*, o.delivery_no, o.invoice_no, o.order_id, o.remark order_remark, o.create_time, o.large_size_count";
			$field = $field.", d.delivery_time, d.remark delivery_remark, d.sign_time,d.remark sign_remark,d.delivery_id ";
			$field = $field.", dd.driver_name, dd.car_license";
			$sql = "select $field from (select * ,'商品' goods_type, 1 is_for_goods from smpss_hospitalorder where status!=5 union all select *, '发票' goods_type, 0 is_for_goods from smpss_hospitalorder where status!=5) as h";
			$sql = $sql." left join (select * from smpss_order where status!=5) o on o.hospitalorder_id=h.hospitalorder_id";
			$sql = $sql." left join (select * from smpss_deliverywithgoods where sign_status!=3) d on d.order_id=o.order_id and d.is_for_goods=h.is_for_goods";
			$sql = $sql." left join smpss_delivery dd on d.delivery_id=dd.delivery_id";
			if($stime){
				$where = " where h.preapply_time>='{$stime}'";	
			}
			if($etime){
				$where = $where?" and h.preapply_time<='{$etime}'":" where h.preapply_time<='{$etime}'";
			}
			$sql = $sql.$where;
			$list = $hospitalOrderObj->query($sql);
			$exl_data = $list->items;
			$excel = array ();
			$deliveryManObj = new m_deliverywithman();
			$praiseDict = $this->getAppraiseDict();
			foreach ( $exl_data as $key=>$row ) {
				$e ['seq'] = $key+1;
				$e ['hospitalorder_id'] = $row ['hospitalorder_id'];
				$e ['hospital_name'] = $row['hospital_name'];
				$e ['office_name'] = $row['office_name'];
				$e ['name'] = $row ['name'];
				$e ['remark'] = $row ['remark'];
				$e ['order_remark'] = $row ['order_remark'];
				$e ['preapply_time'] = date("Y-m-d",strtotime($row['preapply_time']));
				$e ['order_id'] = $row['order_id'];
				$e ['goods_type'] = $row['goods_type'];
				$e ['order_no'] = $row['is_for_goods']==1?$row['delivery_no']:$row['invoice_no'];
				$e ['delivery_remark'] = $row['delivery_remark'];
				$e ['large_size_count'] = $row['large_size_count'];
				$e ['create_time'] = date("Y-m-d", strtotime($row['create_time']));
				$e ['delivery_time'] = date("Y-m-d", strtotime($row['delivery_time']));
				$e ['delivery_id'] = $row['delivery_id'];
				$e ['car_license'] = $row['car_license'];
				$e ['driver_name'] = $row['driver_name'];
				$join = array("smpss_deliveryman"=>"smpss_deliverywithman.deliveryman_id=smpss_deliveryman.deliveryman_id");
				$deliveryManList = $deliveryManObj->select("delivery_id=".$row['delivery_id'],"smpss_deliveryman.name","","",$join);
				if(!empty($deliveryManList->items)){
					$deliveryMen = "";
					foreach ($deliveryManList->items as $man) {
						if(strlen($man['name'])>0){
							$deliveryMen = $deliveryMen.$man['name'].";";
						}
					}
				}
				
				$e ['delivery_man'] = $deliveryMen;
				$e ['sign_time'] = date("H:i:s",strtotime($row['sign_time']));
				$e ['appraise'] = $praiseDict[$row['appraise']];//评价
				$e ['appraise_comment'] = $row['appraise_comment'];
				$e ['sign_remark'] = $row['sign_remark'];
				$e ['sign_date'] = date("Y-m-d", strtotime($row['sign_time']));
				$excel [] = $e;
			}
			 
			$excelObj = new m_excel ();
			$titles = array (
					"A:10"=>'序号',
					"B:20"=>'预订单号',
					"C:10"=>'医院名称',
					"D:10"=>'科室名称',
					"E:10"=>'提交人',
					"F:10"=>'医院备注',
					"G:10"=>'接单备注',
					"H:10"=>'预订单日期',
					"I:10"=>'订单号',
					"J:10"=>'货物类别',
					"K:10"=>'单据号',
					"L:10"=>'出库备注',
					"M:10"=>'大货数量',
					"N:10"=>'订单日期',
					"O:10"=>'出库日期',
					"P:10"=>'送货单号',
					"Q:10"=>'车号',
					"R:10"=>'司机',
					"S:10"=>'送货员',
					"T:10"=>'签收时间',
					"U:10"=>'用户评价',
					"V:10"=>'评语',
					"W:10"=>'签收备注',
					"X:10"=>'签收日期'
			);
			
			$orderObj = new m_order();
			$order = $orderObj->selectOne("order_id = {$order_id}");
			
			$title = date("Ymd", time()).'_'.$order['hospital_name'].'_'.$order['office_name']. '_' . $order_id ;
			$excelObj->push ( $titles, $excel, "运输统计数据表" );
		}
		return $this->render('report/order.html', $this->params);
	}
}