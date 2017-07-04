<?php
/**
 * 正式订单数据模型
 * @author mol
 */
class m_order extends base_m {
	const ORDER_STATUS_WAIT = 1;
	const ORDER_STATUS_VERIFY = 2;
	const ORDER_STATUS_DELIVERY = 3;
	const ORDER_STATUS_OVER = 4;
	public function primarykey() {
		return 'order_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'order';
	}
    
	public function relations() {
		return array ();
	}
    
    function diffBetweenTwoDays($day1, $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);
        
        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return floor(($second1 - $second2) / 86400);
    }
    
	public function getOrderList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
		
		$rs = $this->select($condition, "", "", "order by order_id desc");
		if ($rs) {
			$list = $rs->items;
			
			$datadictObj = new m_datadict ();
			
			for($i = 0; $i < count ( $list ); $i ++) {
				$key = base_Constant::KEY_TRADE_STATUS;
				$datadict = $datadictObj->selectOne("value = {$list[$i]['status']} and key_id = {$key}");
				$list[$i]['status_name'] = $datadict['name'];

                $key = base_Constant::KEY_ORDER_COMPANY;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['order_company']} and key_id = {$key}");
                $list[$i]['order_company_name'] = $datadict['name'];
                
                if ($list[$i]['status'] == self::ORDER_STATUS_WAIT) {
                    $list[$i]['day_wait'] = self::diffBetweenTwoDays($list[$i]['create_time'], date('Y-m-d H:i:s'));
                }
                else {
                    $list[$i]['day_wait'] = 0;
                }
			}
			$rs->items = $list;
			
			return $rs;
		} else
			return array ();
	}

	/**
	 * 创建拆分的新订单
	 */
	public function excreteOrder($data,$excrete){
		if(!$data['hospital_id']||!$data['office_id']){
			$this->setError(0, "请选择医院及科室。");
			return false;
		}
		$officeObj = new m_office();
		$office = $officeObj->selectOne("office_id={$data['office_id']}");
		
		$this->set("name", $data['name']);
		$this->set("mobile", $data['mobile']);
		$this->set("hospital_id", $data['hospital_id']);
		$this->set("weichatuser_id", $data['weichatuser_id']);
		$this->set("hospitalorder_id", $data['hospitalorder_id']);
		$this->set("hospital_name", $data['hospital_name']);
		$this->set("office_id", $data['office_id']);
		$this->set("office_name", $data['office_name']);
		$this->set("order_company", $data['order_company']);
		$this->set("is_coldchain", $data['is_coldchain']);
		$this->set("large_size_count", $data['large_size_count']);
		$this->set("status",$data['status']);
		$this->set("delivery_no",'');
		$this->set("delivery_time", date('Y-m-d H:i:s'));
		$this->set("invoice_no",'');
		$this->set("remark", $data['remark']);
		$this->set("create_time", date('Y-m-d H:i:s'));
		$this->set("is_valid",$data['is_valid']);
		$this->set("verify_admin_id",$data['verify_admin_id']);
		$this->set("verify_time",date('Y-m-d H:i:s',strtotime($data['verify_time'])));
		$this->set("delivery_admin_id",$data['delivery_admin_id']);
		$this->set("fid",$excrete['fid']);
		$rs = $this->save();
		if($rs) {
			$logObj = base_mAPI::get ( "m_log" );
			$content = "录入拆分订单：{$rs}。";
			$logObj->create ($rs, $content, 6);
			$orderGoodsObj = new m_ordergoods();
			$myExcrete = $orderGoodsObj->newOrderExcreteGoods($rs,$excrete);
			return $myExcrete;
		}
		$this->setError(0, "订单拆分失败" . $this->getError());
		return false;
	}

	// 创建订单
    public function createOrder($hospitalorder_id, $with_log = NULL) {
		if (!$hospitalorder_id) {
			$this->setError(0, "缺少预订单标识");
			return false;
		}
        
        $hospitalorderObj = new m_hospitalorder();
        
		$hospitalorder = $hospitalorderObj->selectOne("hospitalorder_id = {$hospitalorder_id}");
        if (!$hospitalorder) {
            $this->setError(0, "预订单标识不存在");
            return false;
        }
		
		$this->set("hospitalorder_id", $hospitalorder['hospitalorder_id']);
        $this->set("weichatuser_id", $hospitalorder['weichatuser_id']);
		$this->set("name", $hospitalorder['name']);
		$this->set("mobile", $hospitalorder['mobile']);
		$this->set("hospital_id", $hospitalorder['hospital_id']);
		$this->set("hospital_name", $hospitalorder['hospital_name']);
		$this->set("office_id", $hospitalorder['office_id']);
		$this->set("office_name", $hospitalorder['office_name']);
        $this->set("order_company", $hospitalorder['order_company']);
		$this->set("status", self::ORDER_STATUS_WAIT);
        $this->set("is_valid", 1);
		$this->set("fid",0);
        $this->set("create_time", date('Y-m-d H:i:s'));
				
		$rs = $this->save();
		if ($rs) {
			if ($with_log) {
				$content = "预订单转正式订单：{$hospitalorder['hospitalorder_id']}";
				$logObj = base_mAPI::get("m_log");
				$logObj->create($rs, $content, 6);
			}
			return $rs;
		}
		
		$this->setError(0, "保存数据失败" . $this->getError());
		return false;
	}
	
	/**
	 * 录入订单
	 */
	public function enterOrder($data){
		if(!$data['hospital_id']||!$data['office_id']){
			$this->setError(0, "请选择医院及科室。");
			return false;
		}
		if(!$data['delivery_no']||!$data['invoice_no']||!$data['large_size_count']){
			$this->setError(0, "订单信息填写不完整，请补充。");
			return false;
		}
		$officeObj = new m_office();
		$office = $officeObj->selectOne("office_id={$data['office_id']}");
		
		$this->set("name", $office['contact_name']);
		$this->set("mobile", $office['contact_phone']);
		$this->set("hospital_id", $office['hospital_id']);
		$this->set("hospital_name", $office['hospital_name']);
		$this->set("office_id", $office['office_id']);
		$this->set("office_name", $office['name']);
		$this->set("is_coldchain", $data['is_coldchain']);
		$this->set("large_size_count", $data['large_size_count']);
		$this->set("status", self::ORDER_STATUS_DELIVERY);
		$this->set("delivery_no", $data['delivery_no']);
		$this->set("delivery_time", date('Y-m-d H:i:s'));
		$this->set("invoice_no", $data['invoice_no']);
		$this->set("remark", $data['remark']);
		$this->set("create_time", date('Y-m-d H:i:s'));
		$this->set("is_valid", 1);
		$this->set("verify_admin_id", $_COOKIE['admin_id']);
		$rs = $this->save();
		if($rs) {
			$logObj = base_mAPI::get ( "m_log" );
			$content = "录入订单：{$rs}。";
			$logObj->create ($rs, $content, 6);
			return $rs;
		}
		$this->setError(0, "订单录入失败" . $this->getError());
		return false;
	}

	/**
	 * 后台录入临时订单
	 */
	public function createTOrder($data){
		if(!$data['hospital_id']||!$data['office_id']){
			$this->setError(0, "请选择医院及科室。");
			return false;
		}
		$officeObj = new m_office();
		$office = $officeObj->selectOne("office_id={$data['office_id']}");
		
		$this->set("name", $data['name']);
		$this->set("mobile", $data['mobile']);
		$this->set("hospital_id", $office['hospital_id']);
		$this->set("hospital_name", $office['hospital_name']);
		$this->set("office_id", $office['office_id']);
		$this->set("office_name", $office['name']);
		$this->set("order_company", $data['order_company_id']);
		$this->set("weichatuser_id", $data['weichatuser_id']);
		$this->set("is_coldchain",0);
		$this->set("large_size_count",0);
		$this->set("status", self::ORDER_STATUS_DELIVERY);
		$this->set("delivery_no",'');
		$this->set("delivery_time", date('Y-m-d H:i:s'));
		$this->set("invoice_no", $data['invoice_no']);
		$this->set("remark", $data['remark']);
		$this->set("create_time", date('Y-m-d H:i:s'));
		$this->set("is_valid", 1);
		$this->set("verify_admin_id", $_COOKIE['admin_id']);
		$rs = $this->save();
		if($rs) {
			$logObj = base_mAPI::get ( "m_log" );
			$content = "录入订单：{$rs}。";
			$logObj->create ($rs, $content, 6);
			return $rs;
		}
		$this->setError(0, "订单录入失败" . $this->getError());
		return false;
	}
    
	/**
	 * 结束订单
	 * 
	 * @param unknown $order_id
     * @param unknown $pic_data
	 * @param unknown $with_log        	
	 * @return boolean|unknown
	 */
	function overOrder($order_id) {
		$order = $this->selectOne("order_id = {$order_id}");
        if (!$order) {
            $this->setError(0, "正式订单不存在");
            return false;
        }
		if ($order['status'] == self::ORDER_STATUS_OVER) {
            $this->setError(0, "该订单已经结束.");
            return false;
        }
		$this->set("is_valid",0);
		$this->set("status", self::ORDER_STATUS_OVER);
		$rs = $this->save($order_id);
		if ($rs) {
			if ($with_log) {
				$content = "结束订单：{$orderId}";
				$logObj = base_mAPI::get ( "m_log" );
				$logObj->create ($rs, $content, 6);
			}
			return $rs;
		}
	}
	
	
	/**
	 * 修改订单状态
	 * 
	 * @param unknown $order_id
     * @param unknown $pic_data
	 * @param unknown $with_log        	
	 * @return boolean|unknown
	 */
	function updateOrderStatus($order_id, $pic_list, $with_log = NULL, $extra) {
		$order = $this->selectOne("order_id = {$order_id}");
        if (!$order) {
            $this->setError(0, "正式订单不存在");
            return false;
        }
        
        $orderpicObj = new m_orderpic();

		switch ($order['status']) {
			case self::ORDER_STATUS_WAIT : // 待确认->已确认
				$this->set("verify_time", date('Y-m-d H:i:s'));
				$this->set("verify_admin_id", $_COOKIE['admin_id']);
				$this->set("status", self::ORDER_STATUS_VERIFY);

                foreach ($pic_list as $pic) {
                    $orderpic = array (
                                       "order_id" => $order['hospitalorder_id'],
                                       "pic_url" => $pic,
                                       "type" => m_orderPic::PIC_TYPE_TRADEORDER
                                       );
                    $picid = $orderpicObj->createPic($orderpic);
                    if (!$picid) {
                        $this->setError ( 0, $orderpicObj->getError());
                        return false;
                    }
                }

				$content = "确认正式订单：{$order_id}";
				break;

            case self::ORDER_STATUS_VERIFY://已确认->已发货
				$this->set("delivery_time", date('Y-m-d H:i:s'));
				$this->set("delivery_admin_id", $_COOKIE['admin_id']);
				$this->set("status", self::ORDER_STATUS_DELIVERY);
				$this->set("delivery_no", $extra['delivery_no']);
				$this->set("invoice_no", $extra['invoice_no']);
                foreach ($pic_list as $pic) {
                    $orderpic = array (
                                       "order_id" => $order['hospitalorder_id'],
                                       "pic_url" => $pic,
                                       "type" => m_orderPic::PIC_TYPE_DELIVERY
                                       );
                    $picid = $orderpicObj->createPic($orderpic);
                    if (!$picid) {
                        $this->setError(0, $orderpicObj->getError());
                        return false;
                    }
                }
                
				$content = "正式订单发货：{$order_id}";
				break;
			case self::ORDER_STATUS_DELIVERY : // 预订单完毕
				break;
		}

		$rs = $this->save($order_id);
		if ($rs) {
			if ($with_log) {
				// $content = "修改订单：{$orderId}";
				$logObj = base_mAPI::get ( "m_log" );
				$logObj->create ($rs, $content, 6);
			}
			return $rs;
		}
	}
    
    public function getOrderDetail($order_id) {
        $rs = $this->selectOne("order_id = {$order_id}");
        if ($rs) {
            $datadictObj = new m_datadict();
            $adminObj = new m_admin();
            
            $key = base_Constant::KEY_TRADE_STATUS;
            $datadict = $datadictObj->selectOne("value = {$rs['status']} and key_id = {$key}");
            $rs['status_name'] = $datadict ['name'];
            
            $key = base_Constant::KEY_ORDER_COMPANY;
            $datadict = $datadictObj->selectOne("value = {$rs['order_company']} and key_id = {$key}");
            $rs['order_company_name'] = $datadict['name'];
            
            $admin = $adminObj->selectOne("admin_id = {$rs['verify_admin_id']}");
            $rs['verify_admin_name'] = $admin['admin_name'];
            
            $admin = $adminObj->selectOne("admin_id = {$rs['delivery_admin_id']}");
            $rs['delivery_admin_name'] = $admin['admin_name'];
        }
        
        return $rs;
    }

    public function billAdm($data, $with_log = NULL) {
        $order_id = $data['oid'];
        if (!$order_id) {
            $this->setError (0, "缺少订单标识");
            return false;
        }
        
        $this->set("delivery_no", $data['delivery_no']);
        $this->set("invoice_no", $data['invoice_no']);
        $this->set("remark", $data['remark']);

        $rs = $this->save($order_id);
        if ($rs) {
            if ($with_log) {
                $content = "订单单据维护：{$orderId}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 6);
            }
            return $rs;
        }

        return $rs;
    }

    /**
     * 作废订单
     * @param unknown $order_id
     */
    public function delOrder($order_id){
    	if (!$order_id) {
    		$this->setError (0, "缺少订单标识");
    		return false;
    	}
    	$this->set("is_valid", 2);//作废
    	$rs = $this->save($order_id);
    	if ($rs) {
    		if ($with_log) {
    			$content = "订单作废：{$orderId}";
    			$logObj = base_mAPI::get("m_log");
    			$logObj->create($rs, $content, 7);
    		}
    		return $rs;
    	}
    	
    	return $rs;
    }    
}
