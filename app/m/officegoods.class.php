<?php
/**
 * 科室商品表数据模型
 * @author mol
 */
class m_officegoods extends base_m {
	public function primarykey() {
		return 'officegoods_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'officegoods';
	}
	public function relations() {
		return array ();
	}
	function create($office_id, $goods_id, $remark = NULL, $safe_stock=NULL) {
		if (! $office_id or ! $goods_id) {
			$this->setError ( 0, "缺少必要参数" );
			return false;
		}
		
		$this->set ( "office_id", $office_id );
		$this->set ( "goods_id", $goods_id );
		$this->set ( "remark", $remark );
		$this->set ( "safe_stock", $safe_stock );
		$this->set ( "admin_id", $_COOKIE ['admin_id'] );
		$this->set ( "create_time", date ( 'Y-m-d H:i:s' ) );
		
		$res = $this->save ( false );
		if ($res) {
			return $res;
		}
		$this->setError ( 0, "保存数据失败:" . $this->getError () );
		return false;
	}
	
	function createOne($office_id, $goods_id, $sort = 100, $safe_stock = 0, $remark = NULL) {
		if (! $office_id or ! $goods_id) {
			$this->setError ( 0, "缺少必要参数" );
			return false;
		}
		
		$this->set ( "office_id", $office_id );
		$this->set ( "goods_id", $goods_id );
		$this->set ( "sort", $sort );
		$this->set ( "safe_stock", $safe_stock );
		$this->set ( "remark", $remark );
		$this->set ( "admin_id", $_COOKIE ['admin_id'] );
		$this->set ( "create_time", date ( 'Y-m-d H:i:s' ) );
		
		$res = $this->save ( false );
		if ($res) {
			return $res;
		}
		$this->setError ( 0, "保存数据失败:" . $this->getError () );
		return false;
	}
	/**
	 * 修改科室商品备注
	 * 
	 * @param unknown $office_id        	
	 * @param unknown $goods_id        	
	 * @param unknown $remark        	
	 */
	public function modifyRemark($office_id, $goods_id, $remark) {
		$officeGoods = $this->selectOne ( "office_id={$office_id} and goods_id={$goods_id}" );
		if (! $officeGoods) {
			$this->setError ( 0, "找不到科室商品。" );
			return false;
		}
		$this->setPkid ( $officeGoods ['officegoods_id'] );
		$this->set ( "remark", $remark );
		$this->set ( "modify_time", date ( "Y-m-d H:i:s" ) );
		if ($this->save ()) {
			$officeObj = new m_office ();
			$office = $officeObj->selectOne ( "office_id = {$office_id}" );
			$content = "修改科室商品备注: {$office['hospital_name']}-{$office['name']}-{$goods_id}";
			$logObj = base_mAPI::get ( "m_log" );
			$logObj->create ( $data ['weichatuser_id'], $content, 2 );
		} else {
			$this->setError ( 0, "操作失败：" . $this->getDbError () );
			return false;
		}
		return true;
	}
	
	/**
	 * 修改科室商品期初安全库存
	 *
	 * @param unknown $office_id
	 * @param unknown $goods_id
	 * @param unknown $remark
	 */
	public function modifySafeStock($office_id, $goods_id, $safe_stock) {
		$officeGoods = $this->selectOne ( "office_id={$office_id} and goods_id={$goods_id}" );
		if (! $officeGoods) {
			$this->setError ( 0, "找不到科室商品。" );
			return false;
		}
		$this->setPkid ( $officeGoods ['officegoods_id'] );
		$this->set ( "safe_stock", $safe_stock );
		$this->set ( "modify_time", date ( "Y-m-d H:i:s" ) );
		if ($this->save ()) {
			$officeObj = new m_office ();
			$office = $officeObj->selectOne ( "office_id = {$office_id}" );
			$content = "修改科室商品期初库存: {$office['hospital_name']}-{$office['name']}-{$goods_id}";
			$logObj = base_mAPI::get ( "m_log" );
			$logObj->create ( $data ['weichatuser_id'], $content, 2 );
		} else {
			$this->setError ( 0, "操作失败：" . $this->getDbError () );
			return false;
		}
		return true;
	}
	
	public function delOfficeGoods($office_id, $goods_id) {
		$officeGoods = $this->selectOne ( "office_id={$office_id} and goods_id={$goods_id}" );
		if (! $officeGoods) {
			$this->setError ( 0, "找不到科室商品。" );
			return false;
		}
		return $this->delete ( "office_id={$office_id} and goods_id={$goods_id}" );
	}
	public function getGoodsList($office_id) {
		$join = array('smpss_goods'=>'smpss_goods.goods_id = smpss_officegoods.goods_id');
		$rs = $this->select ( "office_id = {$office_id}", "smpss_officegoods.*,smpss_goods.specification,smpss_goods.unit,smpss_goods.name,smpss_goods.manu,smpss_goods.category,smpss_goods.machine,smpss_goods.extern_name,smpss_goods.goods_no", "", "order by smpss_officegoods.sort,smpss_goods.manu,smpss_goods.category,smpss_goods.name asc", $join);
		$goodsObj = new m_goods ();
		if ($rs) {
			$list = $rs->items;
			
			/*for($i = 0; $i < count ( $list ); $i ++) {
				$goods = $goodsObj->selectOne ( "goods_id = {$list[$i]['goods_id']}" );
				$list [$i] ['specification'] = $goods ['specification'];
				$list [$i] ['unit'] = $goods ['unit'];
				$list [$i] ['name'] = $goods ['name'];
				$list [$i] ['manu'] = $goods ['manu'];
				$list [$i] ['category'] = $goods ['category'];
				$list [$i] ['machine'] = $goods ['machine'];
				$list [$i] ['extern_name'] = $goods ['extern_name'];
			}*/
			$rs->items = $list;
			
			return $rs;
		} else
			return array ();
	}
	/**
	 * 销售预测
	 */
	public function forecast($office_id) {
		$rs = $this->select ( "office_id = {$office_id}", "", "", "order by goods_id" );
		$goodsObj = new m_goods ();
		$goodsTable = $goodsObj->tableName ();
		$orderGoodsObj = new m_ordergoods ();
		$orderGoodsTable = $orderGoodsObj->tableName ();
		$orderObj = new m_order ();
		$orderTable = $orderObj->tableName ();
		$officeObj = new m_office("{$office_id}");
		$office = $officeObj->get();
		if ($rs) {
			foreach ( $rs->items as &$officeGoods ) {
				$goods_id = $officeGoods ['goods_id'];
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
					$officeGoods['firstMon'] = $monQuantity['{$firstMon}']?$monQuantity['{$firstMon}']:0;
					$officeGoods['secondMon'] = $monQuantity['{$secondMon}']?$monQuantity['{$secondMon}']:0;
					$officeGoods['thirdMon'] = $monQuantity['{$thirdMon}']?$monQuantity['{$thirdMon}']:0;
					$officeGoods ['avg'] = ceil(sprintf("%.2f",$sum));
				} else {
					$officeGoods['firstMon'] = 0;
					$officeGoods['secondMon'] = 0;
					$officeGoods['thirdMon'] = 0;
					$officeGoods ['avg'] = 0;
				}
				
				if($office['safe_stock_ratio']) {
					$officeGoods ['safe_stock'] = ceil( $officeGoods ['avg'] * $office['safe_stock_ratio']);
				}else {
					$officeGoods ['safe_stock'] = ceil( $officeGoods ['avg'] * base_Constant::FORECAST_SAFE_MULTIPLE);
				}
				
				//$officeGoods ['stock'] = 0;
				//$officeGoods ['order_quantity'] = $officeGoods ['safe_stock'];
				if(!$officeGoods ['last_safe_stock']){
					!$officeGoods ['last_safe_stock'] = $officeGoods['safe_stock'];
				}
				$officeGoods ['confirm_quantity'] = $officeGoods ['last_safe_stock'];
				if($officeGoods ['last_safe_stock']) {
					$officeGoods ['percent'] = round(abs($officeGoods ['safe_stock']-$officeGoods ['last_safe_stock'])/$officeGoods ['last_safe_stock'], 4)*100;
				}
				$goods = $goodsObj->selectOne("goods_id={$goods_id}");
				$officeGoods['name'] = $goods['name'];
				$officeGoods['specification'] = $goods['specification'];
				$officeGoods['unit'] = $goods['unit'];
			}
			return $rs->items;
		} else
			return array ();
	}
	public function getGoodsAllList($office_id) {
		$goodsObj = new m_goods ();
		$rs = $goodsObj->getOptionList ();
		if ($rs) {
			$list = $rs;
			
			for($i = 0; $i < count ( $list ); $i ++) {
				$officegoods = $this->selectOne ( "office_id = {$office_id} and goods_id = {$list[$i]['goods_id']}" );
				if ($officegoods) {
					$list [$i] ['is_checked'] = 1;
				} else {
					$list [$i] ['is_checked'] = 0;
				}
			}
			return $list;
		} else
			return array ();
	}
	public function createOfficeGoods($data) {
		if (! $data ['office_id']) {
			$this->setError ( 0, "缺少科室信息" );
			return false;
		}
		
		if (! $data ['officegoods']) {
			$this->setError ( 0, "缺少科室商品信息" );
			return false;
		}
		
		$officeObj = new m_office ();
		$office = $officeObj->selectOne ( "office_id = {$data['office_id']}" );
		
		// 删除原来旧数据
		$this->delete ( "office_id = '{$data['office_id']}'" );
		
		$officeGoodsList = $data ['officegoods'];
		for($i = 0; $i < count ( $officeGoodsList ); $i ++) {
			$rs = $this->create ( $data ['office_id'], $officeGoodsList [$i] );
			if (! $rs) {
				$this->setError ( 0, "保存数据失败" . $this->getError () );
				return false;
			}
		}
		
		$content = "分配科室商品: {$office['hospital_name']}-{$office['name']}";
		$logObj = base_mAPI::get ( "m_log" );
		$logObj->create ( $data ['weichatuser_id'], $content, 2 );
		
		return true;
	}
}
