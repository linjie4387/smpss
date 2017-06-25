<?php
/**
 * 销售预测数据模型
 * @author zjx
 */
class m_forecast extends base_m {
	const log_type =7;
	
	public function primarykey() {
		return 'id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'forecast';
	}
    
	public function relations() {
		return array ();
	}
	/**
	 * 销售预测列表查询
	 * @param unknown $condition
	 * @param number $page
	 */
	public function listForecast($condition, $page=1){
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
		$adminObj = new m_admin();
		$forecastTable = $this->tableName();
		$adminTable = $adminObj->tableName();
		$join = array("{$adminTable}"=>"{$forecastTable}.admin_id={$adminTable}.admin_id");
		$rs = $this->select($condition, "{$forecastTable}.*, {$adminTable}.admin_name", "", "order by create_time desc",$join);
		return $rs;
	}
	/**
	 * 查询销售预测明细
	 * @param unknown $forecast_id
	 */
	public function getForecast($forecast_id){
		$forecast = $this->selectOne("id={$forecast_id}");
		if(!$forecast){
			$this->setError(0, "销售预测不存在。");
			return false;
		}
		$bill_no = $forecast['bill_no'];
		$forecastDetailObj = new m_forecastdetail();
		$join = array(
				"smpss_goods"=>"smpss_goods.goods_id = smpss_forecast_detail.goods_id",
				"smpss_officegoods"=>"smpss_officegoods.office_id={$forecast['office_id']} and smpss_officegoods.goods_id=smpss_forecast_detail.goods_id"
		);
		$select = "smpss_forecast_detail.*,smpss_goods.manu,smpss_goods.category, smpss_officegoods.last_safe_stock";
		$orderby = "order by smpss_goods.manu,smpss_goods.category,smpss_forecast_detail.goods_name asc";
		$details = $forecastDetailObj->select("forecast_bill_no='{$bill_no}'",$select,"",$orderby,$join);
		
		//前3月
		$orderGoodsObj = new m_ordergoods ();
		$orderGoodsTable = $orderGoodsObj->tableName ();
		$orderObj = new m_order ();
		$orderTable = $orderObj->tableName ();
		foreach ($details->items as &$item) {
			$goods_id = $item['goods_id'];
			$where = "{$orderTable}.create_time>DATE_SUB(last_day(CURDATE()), INTERVAL 4 MONTH) and {$orderTable}.is_valid=1";
			$where = $where . " and {$orderGoodsTable}.goods_id={$goods_id}";
			$join = array (
					"{$orderTable}" => "{$orderGoodsTable}.order_id={$orderTable}.order_id"
			);
			//$fields = "sum({$orderGoodsTable}.quantity)/3 as quantity";
			$select = "DATE_FORMAT({$orderGoodsTable}.create_time,'%Y%m') months,sum({$orderGoodsTable}.quantity) quantity";
			$orderGoods = $orderGoodsObj->select ( $where, $select, "group by months", "", $join );
			$firstMon = date('Ym', strtotime('-3 month'));
			$secondMon = date('Ym', strtotime('-2 month'));
			$thirdMon = date('Ym', strtotime('-1 month'));
			if ($orderGoods->items) {
				$sum = 0;
				foreach ($orderGoods->items as $order) {
					$sum = $sum + $order['quantity'];
					$monQuantity["{$order['month']}"] = $order['quantity'];
				}
				$item['firstMon'] = $monQuantity['{$firstMon}']?$monQuantity['{$firstMon}']:0;
				$item['secondMon'] = $monQuantity['{$secondMon}']?$monQuantity['{$secondMon}']:0;
				$item['thirdMon'] = $monQuantity['{$thirdMon}']?$monQuantity['{$thirdMon}']:0;
				$item ['avg'] = ceil(sprintf("%.2f",$sum));
			} else {
				$item['firstMon'] = 0;
				$item['secondMon'] = 0;
				$item['thirdMon'] = 0;
				$item ['avg'] = 0;
			}
		}
		$forecast["detail_list"] = $details->items;
		return $forecast;
	}
	
	public function getOfficeGoodsForcast($officeId, $goodsId){
		$foreCastTable = $this->tableName();
		$detailObj = new m_forecastdetail();
		$detailTable = $detailObj->tableName();
		$where = "{$foreCastTable}.office_id={$officeId} and {$detailTable}.goods_id={$goodsId}";
		$join = array("{$foreCastTable}"=>"{$detailTable}.forecast_bill_no={$foreCastTable}.bill_no");
		$detail = $detailObj->selectOne($where, "{$detailTable}.*", "","order by {$foreCastTable}.create_time desc", $join);
		return $detail;
	}
	
    /**
     * 新增销售预测
     * @param unknown $office_id
     * @param unknown $goods_list
     */
    public function create($office_id, $goods_list){
    	$officeObj = new m_office();
    	$billNo  = $this->buildOrderNo("SF");
    	$office = $officeObj->selectOne("office_id={$office_id}");
    	$this->set("office_id", $office_id);
    	$this->set("hospital_id", $office['hospital_id']);
    	$this->set("hospital_name", $office['hospital_name']);
    	$this->set("office_name", $office['name']);
    	$this->set("bill_no", $billNo);
    	$this->set("create_time", date("Y-m-d H:i:s"));
    	$this->set("admin_id", $_COOKIE['admin_id']);
    	$id = $this->save(false);
    	if($id){
    		$forecastDetailObj = new m_forecastdetail();
    		$officeGoodsObj = new m_officegoods();
    		foreach ($goods_list as $data){
    			$data['safe_stock_ratio'] = $office['safe_stock_ratio'];
    			$data["forecast_bill_no"] = $billNo;
    			if(!$forecastDetailObj->create($data)) {
    				$this->setError(0, $forecastDetailObj->getDbError());
    				return false;
    			}
    			//更新科室商品的最新安全库存量
    			$officeGoods = $officeGoodsObj->selectOne("office_id={$office_id} and goods_id={$data['goods_id']}");
    			if($officeGoods) {
    				$officeGoodsObj->set("last_safe_stock", $data['confirm_quantity']);
    				$officeGoodsObj->save($officeGoods['officegoods_id']);
    			}
    		}
    		$content = "新增销售预测：{$id}";
    		$logObj = base_mAPI::get("m_log");
    		$logObj->create($rs, $content, m_forecast::log_type);
    	}else {
    		$this->setError(0, $this->getDbError());
    	}
    	return $id;
    }
}
