<?php
/**
 * 医院下单数据模型
 * @author mol
 */
class m_hospitalorder extends base_m {
	// const ORDER_STATUS_NEW = 1;
	// const ORDER_STATUS_ONDEAL = 2;
	// const ORDER_STATUS_CLOSE = 3;
	// const ORDER_STATUS_DEL = 4;
	const ORDER_STATUS_NEW = 1;
	const ORDER_STATUS_TOCONFIRM = 2;
	const ORDER_STATUS_ONDEAL = 3;
	const ORDER_STATUS_CLOSE = 4;
	const ORDER_STATUS_DEL = 5;
	
	public function primarykey() {
		return 'hospitalorder_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'hospitalorder';
	}
    
	public function relations() {
		return array ();
	}
    
    public function getOrderDetail($hospitalorder_id) {
        $rs = $this->selectOne("hospitalorder_id = {$hospitalorder_id}");
        if ($rs) {
            $datadictObj = new m_datadict();
            $adminObj = new m_admin();
            
            $key = base_Constant::KEY_ORDER_STATUS;
            $datadict = $datadictObj->selectOne("value = {$rs['status']} and key_id = {$key}");
            $rs['status_name'] = $datadict ['name'];
            
            $key = base_Constant::KEY_ORDER_COMPANY;
            $datadict = $datadictObj->selectOne("value = {$rs['order_company']} and key_id = {$key}");
            $rs['order_company_name'] = $datadict['name'];
            
            $admin = $adminObj->selectOne("admin_id = {$rs['preverify_admin_id']}");
            $rs['preverify_admin_name'] = $admin['admin_name'];

            $admin = $adminObj->selectOne("admin_id = {$rs['preclose_admin_id']}");
            $rs['preverify_close_name'] = $admin['admin_name'];
        }
        
        return $rs;
    }

	public function getHospitalorderList($condition = '', $page = 1) {
		$this->setCount ( true );
		$this->setPage ( $page );
		$this->setLimit ( base_Constant::PAGE_SIZE );
		
		$rs = $this->select ( $condition, "", "", "order by hospitalorder_id desc" );
		if ($rs) {
			$list = $rs->items;
			
			$datadictObj = new m_datadict ();
			
			for($i = 0; $i < count ( $list ); $i ++) {
				$key = base_Constant::KEY_ORDER_STATUS;
				$datadict = $datadictObj->selectOne ( "value = {$list[$i]['status']} and key_id = {$key}" );
				$list [$i] ['status_name'] = $datadict ['name'];
				
				$appraiseType = base_Constant::KEY_APPAISE_TYPE;
				$dict = $datadictObj->selectOne("value = {$list[$i]['appraise']} and key_id = {$appraiseType}");
				$list [$i] ['appraise_name'] = $dict ['name'];
			}
			$rs->items = $list;
			
			return $rs;
		} else
			return array ();
	}
    
	public function createHospitalorder($data, $with_log = NULL) {
		if (! $data ['weichatuser_id'] || ! $data ['name'] || ! $data ['mobile']) {
			$this->setError ( 0, "缺少微信用户" );
			return false;
		}
		if (! $data ['hospital_id'] || ! $data ['hospital_name']) {
			$this->setError ( 0, "缺少医院" );
			return false;
		}
		if (! $data ['office_id'] || ! $data ['office_name']) {
			$this->setError ( 0, "缺少科室" );
			return false;
		}
		if (! $data ['picture_url']) {
			$this->setError ( 0, "缺少图片" );
			return false;
		}
		if (! $data ['status']) {
			$this->setError ( 0, "缺少订单状态" );
			return false;
		}
		
		$hospitalorder = $this->selectOne ( "hospitalorder_id = {$data['hospitalorder_id']}" );
		
		$this->set ( "weichatuser_id", $data ['weichatuser_id'] );
		$this->set ( "name", $data ['name'] );
		$this->set ( "mobile", $data ['mobile'] );
		$this->set ( "hospital_id", $data ['hospital_id'] );
		$this->set ( "hospital_name", $data ['hospital_name'] );
		$this->set ( "office_id", $data ['office_id'] );
		$this->set ( "office_name", $data ['office_name'] );
		$this->set ( "status", $data ['status'] );
		$this->set ( "preapply_time", $hospitalorder ['preapply_time'] );
		$this->set ( "preverify_time", $hospitalorder ['preverify_time'] );
		$this->set ( "preverify_admin_id", $hospitalorder ['preverify_admin_id'] );
		$this->set ( "remark", $hospitalorder ['remark'] );
		
		switch ($data ['status']) {
			case 1 : // 预订单下单
			         // $this->set("preapply_time", date('Y-m-d H:i:s'));
				break;
			case 2 : // 预订单处理中
				$this->set ( "preverify_time", date ( 'Y-m-d H:i:s' ) );
				$this->set ( "preverify_admin_id", $_COOKIE ['admin_id'] );
				break;
			case 3 : // 预订单完毕
				$this->set ( "preclose_time", date ( 'Y-m-d H:i:s' ) );
				$this->set ( "preclose_admin_id", $_COOKIE ['admin_id'] );
				break;
		}
		
		if ($data ['hospitalorder_id']) {
			$this->set ( "modify_time", date ( 'Y-m-d H:i:s' ) );
		} else {
			$this->set ( "create_time", date ( 'Y-m-d H:i:s' ) );
		}
		$this->set ( "admin_id", $_COOKIE ['admin_id'] );
		
		$rs = $this->save ( $data ['hospitalorder_id'] );
		if ($rs) {
			if (! $data ['hospitalorder_id']) {
				// 新增订单图片
				if (! is_array ( $data ['picture_url'] )) {
					$this->set ( "picture_url", $data ['picture_url'] );
				} else {
					$pic_arr = $data ['picture_url'];
					$orderpicObj = new m_orderpic ();
					foreach ( $pic_arr as $pic ) {
						$orderpic = array (
								"order_id" => $rs,
								"pic_url" => $pic,
                                "type" => 1
						);
						$picid = $orderpicObj->createPic ( $orderpic );
						if (! $picid) {
							$this->setError ( 0, $orderpicObj->getError () );
							return false;
						}
					}
				}
			}
			
			if ($with_log) {
				$content = $data ['hospitalorder_id'] ? "修改订单：{$data['name']}" : "新增订单：{$data['name']}";
				$logObj = base_mAPI::get ( "m_log" );
				$logObj->create ( $rs, $content, 5 );
			}
			return $rs;
		}
		
		$this->setError ( 0, "保存数据失败" . $this->getError () );
		return false;
	}
	/**
	 * 修改订单状态
	 * 
	 * @param unknown $orderId        	
	 * @param unknown $with_log        	
	 * @return boolean|unknown
	 */
	function updateHospitalorder($orderId, $with_log = NULL) {
		$hospitalorder = $this->selectOne ( "hospitalorder_id = {$orderId}" );
		switch ($hospitalorder ['status']) {
			case self::ORDER_STATUS_NEW : // 预订单下单->待确认
				$this->set ( "preverify_time", date ( 'Y-m-d H:i:s' ) );
				$this->set ( "preverify_admin_id", $_COOKIE ['admin_id'] );
				$this->set ( "status", self::ORDER_STATUS_TOCONFIRM );
				$content = "接收订单：{$hospitalorder['name']}";
				break;
			case self::ORDER_STATUS_TOCONFIRM://待确认->已确认：微信端完成
				$this->set ( "verify_time", date ( 'Y-m-d H:i:s' ) );
				$this->set ( "verify_admin_id", $_COOKIE ['admin_id'] );
				$this->set ( "status", self::ORDER_STATUS_ONDEAL );
				$content = "订单确认：{$hospitalorder['name']}";
				break;
			case self::ORDER_STATUS_ONDEAL : // 预订单处理中-》预订单完毕
				$this->set ( "preclose_time", date ( 'Y-m-d H:i:s' ) );
				$this->set ( "preclose_admin_id", $_COOKIE ['admin_id'] );
				$this->set ( "status", self::ORDER_STATUS_CLOSE );
				$content = "订单处理完毕：{$hospitalorder['name']}";
				//生成正式订单
				$orderObj = new m_order();
				if(!$orderObj->createOrder($hospitalorder['hospitalorder_id'])){
					$this->setError(0, $orderObj->getError());
					return false;
				}
				break;
			case self::ORDER_STATUS_CLOSE : // 预订单完毕
				break;
		}
		$this->set ( "admin_id", $_COOKIE ['admin_id'] );
		$this->set ( "modify_time", date ( 'Y-m-d H:i:s' ) );
		$rs = $this->save ( $orderId );
		if ($rs) {
			if ($with_log) {
				// $content = "修改订单：{$orderId}";
				$logObj = base_mAPI::get ( "m_log" );
				$logObj->create ( $rs, $content, 5 );
			}
			return $rs;
		}
	}
	/**
	 * 删除医院订单
	 * 
	 * @param unknown $orderId        	
	 * @param unknown $with_log        	
	 * @return boolean
	 */
	function delHospitalOrder($orderId, $with_log = NULL) {
		$hospitalorder = $this->selectOne ( "hospitalorder_id = {$orderId}" );
		if ($hospitalorder) {
			$this->set ( "status", self::ORDER_STATUS_DEL );
			$this->set ( "admin_id", $_COOKIE ['admin_id'] );
			$this->set ( "modify_time", date ( 'Y-m-d H:i:s' ) );
			$rs = $this->save ( $orderId );
			if ($rs) {
				if ($with_log) {
					$content = "删除订单：{$orderId}";
					$logObj = base_mAPI::get ( "m_log" );
					$logObj->create ( $rs, $content, 5 );
				}
				return true;
			}
		} else {
			$this->setError ( 0, "删除订单失败,订单号不存在。" );
			return false;
		}
	}
    /**
     * 修改医院订单备注
     *
     * @param unknown $orderId
     * @param unknown $admin_remark
     * @param unknown $with_log
     * @return boolean
     */
    function updateHospitalOrderRemark($orderId, $admin_remark, $with_log = NULL) {
        $hospitalorder = $this->selectOne("hospitalorder_id = {$orderId}");
        if ($hospitalorder) {
            $this->set ( "admin_remark", $admin_remark);
            $this->set ( "admin_id", $_COOKIE ['admin_id'] );
            $this->set ( "modify_time", date ( 'Y-m-d H:i:s' ) );
            $rs = $this->save ( $orderId );
            if ($rs) {
                if ($with_log) {
                    $content = "修改订单备注：{$orderId}";
                    $logObj = base_mAPI::get ( "m_log" );
                    $logObj->create ( $rs, $content, 5 );
                }
                return true;
            }
        } else {
            $this->setError ( 0, "修改订单备注失败,订单号不存在。" );
            return false;
        }
    }
}
