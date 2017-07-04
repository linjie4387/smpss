<?php
/**
 * 发车送货员表数据模型
 * @author mol
 */
class m_deliverywithman extends base_m {

    public function primarykey() {
		return 'withman_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'deliverywithman';
	}
    
	public function relations() {
		return array();
	}

	public function getDeliverymanList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by deliveryman_id");
        if ($rs) {
            $list = $rs->items;
            
            $deliverymanObj = new m_deliveryman();
            
            for ($i=0; $i<count($list); $i++) {
                $deliveryman = $deliverymanObj->selectOne("deliveryman_id = {$list[$i]['deliveryman_id']}");
                $list[$i]['deliveryman_name'] = $deliveryman['name'];
                $list[$i]['deliveryman_mobile'] = $deliveryman['mobile'];
            }
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}
    
    public function getManAllList($delivery_id) {
        $deliverymanObj = new m_deliveryman();
        $rs = $deliverymanObj->getOptionList();
        if ($rs) {
            $list = $rs;
            
            for ($i=0; $i<count($list); $i++) {
                $deliveryman = $this->selectOne("delivery_id = {$delivery_id} and deliveryman_id = {$list[$i]['deliveryman_id']}");
                if ($deliveryman) {
                    $list[$i]['is_checked'] = 1;
                }
                else {
                    $list[$i]['is_checked'] = 0;
                }
            }
            return $list;
        }
        else
            return array();
    }
    
    function createItem($delivery_id, $deliveryman_id) {
        if (!$delivery_id or ! $deliveryman_id) {
            $this->setError(0, "缺少必要参数");
            return false;
        }
        
        $this->set("delivery_id", $delivery_id);
        $this->set("deliveryman_id", $deliveryman_id);
        $this->set("admin_id", $_COOKIE['admin_id']);
        $this->set("create_time", date('Y-m-d H:i:s'));
        
        $res = $this->save(false);
        if ($res) {
            return $res;
        }
        $this->setError(0, "保存数据失败:" . $this->getError());
        return false;
    }
    
    public function create($data, $with_log = NULL) {
        if (!$data['delivery_id']) {
            $this->setError (0, "缺少发货单号");
            return false;
        }

        if (!$data['deliveryman_id']) {
            $this->setError (0, "缺少发货员标识");
            return false;
        }
        
        $this->set("delivery_id", $data['delivery_id']);
        $this->set("deliveryman_id", $data['deliveryman_id']);
        $this->set("create_time", date('Y-m-d H:i:s'));
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($data['withman_id']);
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
     * 设置送货员占用状态
     *
     * @param unknown $withman_id
     * @param unknown $with_log
     * @return boolean
     */
    function setWithman($withman_id,$status = 0) {
        $this->set("isrun",$status);
        $rs = $this->save($data['withman_id']);
        if ($withman) {
            $this->delete("withman_id = '{$withman_id}'");
            return true;
        } else {
            $this->setError ( 0, "设置送货员状态。" );
            return false;
        }
    }
    
    /**
     * 删除送货员
     *
     * @param unknown $withman_id
     * @param unknown $with_log
     * @return boolean
     */
    function delWithman($withman_id, $with_log = NULL) {
        $withman = $this->selectOne ( "withman_id = {$withman_id}" );
        if ($withman) {
            $this->delete("withman_id = '{$withman_id}'");
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
            $this->setError ( 0, "删除送货员失败, 该送货员不存在。" );
            return false;
        }
    }

    public function createWithman($data) {
        if (!$data['delivery_id']) {
            $this->setError (0, "缺少送货单标识");
            return false;
        }
        
        if (!$data['manlist']) {
            $this->setError (0, "缺少送货员信息");
            return false;
        }
        
        $deliveryObj = new m_delivery();
        $delivery = $deliveryObj->selectOne("delivery_id = {$data['delivery_id']}");
        
        // 删除原来旧数据
        $this->delete("delivery_id = '{$data['delivery_id']}'");
        
        $deliverywithmanList = $data['manlist'];
        for ($i=0; $i<count($deliverywithmanList); $i++) {
            $rs = $this->createItem($data['delivery_id'], $deliverywithmanList[$i]);
            if (!$rs) {
                $this->setError (0, "保存数据失败" . $this->getError());
                return false;
            }
        }
        
        return true;
    }



}
