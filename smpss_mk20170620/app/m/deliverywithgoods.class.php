<?php
/**
 * 发车货品清单表数据模型
 * @author mol
 */
class m_deliverywithgoods extends base_m {
    const SIGN_STATUS_WAIT = 1;
    const SIGN_STATUS_OK = 2;
    const SIGN_STATUS_REFUSED = 3;

    public function primarykey() {
		return 'withgoods_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'deliverywithgoods';
	}
    
	public function relations() {
		return array();
	}

	public function getDeliverygoodsList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by order_id");
        if ($rs) {
            $list = $rs->items;
            
            $orderObj = new m_order();
            $datadictObj = new m_datadict ();
            
            for ($i=0; $i<count($list); $i++) {
                $order = $orderObj->selectOne("order_id = {$list[$i]['order_id']}");
                $list[$i]['hospital_name'] = $order['hospital_name'];
                $list[$i]['office_name'] = $order['office_name'];
                $list[$i]['delivery_no'] = $order['delivery_no'];
                $list[$i]['invoice_no'] = $order['invoice_no'];
                $list[$i]['order_remark'] = $order['remark'];
                $list[$i]['type'] = $list[$i]['is_for_goods'] == 0 ? '发票' : '商品';
                $list[$i]['is_valid'] = $order['is_valid'];
                $key = base_Constant::KEY_SIGN_STATUS;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['sign_status']} and key_id = {$key}");
                $list[$i]['sign_status_name'] = $datadict['name'];

            }
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}
    
    public function create($data, $with_log = NULL) {
        if (!$data['delivery_id']) {
            $this->setError (0, "缺少发货单号");
            return false;
        }

        if (!$data['order_id']) {
            $this->setError (0, "缺少正式单标识");
            return false;
        }
        
        $this->set("delivery_id", $data['delivery_id']);
        $this->set("order_id", $data['order_id']);
        $this->set("is_for_goods", $data['is_for_goods']);
        $this->set("sign_status", self::SIGN_STATUS_WAIT);
        $this->set("create_time", date('Y-m-d H:i:s'));
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save(false);
        if ($rs) {
            /*
            if ($with_log) {
                $content = $data['deliveryman_id'] ? "修改送货员：{$data['name']}" : "新增送货员：{$data['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 3);
            }
             */

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }

	
    /**
     * 修改货品签收信息
     *
     * @param unknown $withgoods_id
     * @param unknown $with_log
     * @return boolean
     */
    function editWithgoods($withgoods_id, $info) {
        $this->set("remark",$info['remark']);
		if($info['sign_status'] == 'true')$this->set("sign_status",self::SIGN_STATUS_OK);
        $rs = $this->save($withgoods_id);
        if ($rs) {
            return $rs;
        }
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
    
    /**
     * 删除货品清单
     *
     * @param unknown $withgoods_id
     * @param unknown $with_log
     * @return boolean
     */
    function delWithgoods($withgoods_id, $with_log = NULL) {
        $withgoods = $this->selectOne ( "withgoods_id = {$withgoods_id}" );
        if ($withgoods) {
            $this->delete("withgoods_id = '{$withgoods_id}'");
            /*
            if ($rs) {
                if ($with_log) {
                    $content = "删除订单：{$orderId}";
                    $logObj = base_mAPI::get ( "m_log" );
                    $logObj->create ( $rs, $content, 5 );
                }
                return true;
            }
             */
            return true;
        } else {
            $this->setError ( 0, "删除货品失败, 该货品不存在。" );
            return false;
        }
    }

	 function createWithgoods($data) {                
        // 删除原来旧数据
        $this->delete("delivery_id = '{$data['delivery_id']}'");
        
        $orderList = $data['orderlist'];
        $isforgoodsList = $data['is_for_goods'];
        for ($i=0; $i<count($orderList); $i++) {
			$deliverGoods['delivery_id'] = $data['delivery_id'];
			$deliverGoods['order_id'] = $orderList[$i];
			$deliverGoods['is_for_goods'] = $isforgoodsList[$i];
			
            $rs = $this->create($deliverGoods);
            if (!$rs) {
                $this->setError (0, "保存数据失败" . $this->getError());
                return false;
            }
        }
        
        return true;
    }
}
