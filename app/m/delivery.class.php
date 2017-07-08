<?php
/**
 *  发货表数据模型
 * @author mol
 */
class m_delivery extends base_m {
	const STATUS_TO_SEND = 1;
	const STATUS_SENDED = 2;
	const STATUS_CANCEL = 3;
	const STATUS_UNREACH = 4;
	const STATUS_FINISHED = 5;
	
    public function primarykey() {
		return 'delivery_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'delivery';
	}
    
	public function relations() {
		return array();
	}

	public function getList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
		//$this->setLimit(15);
        
		$rs = $this->select($condition, "", "", "order by create_time desc");
        if ($rs) {
            $list = $rs->items;
            
            $datadictObj = new m_datadict ();
            $deliverymanObj = new m_deliveryman();
            
            for($i = 0; $i < count ( $list ); $i ++) {
                $key = base_Constant::KEY_DELIVERY_STATUS;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['status']} and key_id = {$key}");
                $list[$i]['status_name'] = $datadict['name'];
                
                $deliveryman = $deliverymanObj->selectOne("deliveryman_id = '{$list[$i]['driver_deliveryman_id']}'");
                $list[$i]['driver_mobile'] = $deliveryman['mobile'];
            }
            
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}
    
    public function create($data, $with_log = NULL) {
        if (!$data['car_id']) {
            $this->setError (0, "缺少车辆");
            return false;
        }
        if (!$data['driver_deliveryman_id']) {
            $this->setError (0, "缺少司机");
            return false;
        }

        $deliverymanObj = new m_deliveryman();
        $deliveryman = $deliverymanObj->selectOne("deliveryman_id = '{$data['driver_deliveryman_id']}'");
        $this->set("driver_name", $deliveryman['name']);

        $this->set("car_id", $data['car_id']);
        $carObj = new m_car();
        $car = $carObj->selectOne("car_id = '{$data['car_id']}'");
        $this->set("car_license", $car['car_license']);
        $this->set("driver_deliveryman_id", $data['driver_deliveryman_id']);
        if ($data['delivery_id']) {
            $this->set("delivery_time", date('Y-m-d H:i:s'));
            $this->set("delivery_weichatuser_id", $deliveryman['weichatuser_id']);
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
            $this->set("admin_id", $_COOKIE['admin_id']);
        }
        
        $rs = $this->save($data['delivery_id']);
        if ($rs) {
            if ($with_log) {
                /*
                $content = $data['goods_id'] ? "修改商品：{$data['name']}" : "新增商品：{$data['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 3);
                 */
            }

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
	
	public function createDelivery($data, $with_log = NULL) {
        if (!$data['car_id']) {
            $this->setError (0, "缺少车辆");
            return false;
        }
        if (!$data['driver_deliveryman_id']) {
            $this->setError (0, "缺少司机");
            return false;
        }

        $deliverymanObj = new m_deliveryman();
        $deliveryman = $deliverymanObj->selectOne("deliveryman_id = '{$data['driver_deliveryman_id']}'");
        
        $carObj = new m_car();
        $car = $carObj->selectOne("car_id = '{$data['car_id']}'");
		
		$this->set("car_id", $data['car_id']);
        $this->set("car_license", $car['car_license']);
		$this->set("driver_name", $deliveryman['name']);
        $this->set("driver_deliveryman_id", $data['driver_deliveryman_id']);
		$this->set("20l_quantity", $data['quantity']);
		
        if ($data['delivery_id']) {
           // $this->set("delivery_time", date('Y-m-d H:i:s'));
            //$this->set("delivery_weichatuser_id", $deliveryman['weichatuser_id']);
        }
        else {
            $this->set("status", 1);
            $this->set("create_time", date('Y-m-d H:i:s'));
            $this->set("admin_id", $_COOKIE['admin_id']);
        }
        
        $rs = $this->save($data['delivery_id']);
        if ($rs) {
            if ($with_log) {
                /*
                $content = $data['goods_id'] ? "修改商品：{$data['name']}" : "新增商品：{$data['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 3);
                 */
            }

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
	//换司机
	 public function changeDelivery($delivery_id,$delivery_man){
    	$this->set("driver_deliveryman_id",$delivery_man['deliveryman_id']);
		$this->set("driver_name",$delivery_man['name']);
    	$this->set("modify_time", date('Y-m-d H:i:s'));
    	$rs = $this->save($delivery_id);
    	if($rs){
    		$content = "修改订单送货司机：{$delivery_id}";
    		$logObj = base_mAPI::get("m_log");
    		$logObj->create($rs, $content, 41);
    		return $rs;
    	}
    	$this->setError (0, "更换司机失败：" . $this->getDbError());
    	return false;
    }
    
    public function cancelDelivery($delivery_id,$data){
		$this->set("status",self::STATUS_CANCEL);
		if($data['isUnable'] == 'true')$this->set("status",4);
    	$this->set("modify_time", date('Y-m-d H:i:s'));
    	$this->set("remark",$data['remark']);
    	$rs = $this->save($data['delivery_id']);
    	if($rs){
    		$content = "删除订单：{$delivery_id}";
    		$logObj = base_mAPI::get("m_log");
    		$logObj->create($rs, $content, 41);
    		return $rs;
    	}
    	$this->setError (0, "删除订单失败：" . $this->getDbError());
    	return false;
    }
    
    public function changeStatus($delivery_id,$status){
		$this->set("status",$status);
    	$this->set("modify_time", date('Y-m-d H:i:s'));
    	$rs = $this->save($delivery_id);
    	return true;
    }
}
