<?php
/**
 * 车辆表数据模型
 * @author mol
 */
class m_car extends base_m {
	//状态 - 正常
	const STATUS_NORMAL = 1;
	//状态 - 停用
	const STATUS_DEL = 2;
	
    public function primarykey() {
		return 'car_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'car';
	}
    
	public function relations() {
		return array();
	}

    public function getOptionList() {
        $values = $this->select("status=1", "card_id, car_license", "", "order by car_id");
        $values = $values->items;
        
        return $values;
    }

	public function getCarList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        if($condition=='') {
        	$condition = "status=1";
        }else{
        	$condition = $condition." and status=1";
        }
		$rs = $this->select($condition, "", "", "order by car_id");
        if ($rs) {
            $list = $rs->items;
            $adminObj = new m_admin();
            $datadictObj = new m_datadict();
            
            for ($i=0; $i<count($list); $i++) {
                $admin = $adminObj->selectOne("admin_id = {$list[$i]['admin_id']}");
                $list[$i]['admin_name'] = $admin['admin_name'];
                
                $key = base_Constant::KEY_CARLICENSE_TYPE;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['license_type']} and key_id = {$key}");
                $list[$i]['license_type_name'] = $datadict['name'];
            }
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}
    
    public function create($data, $with_log = NULL) {
        if (!$data['car_license']) {
            $this->setError (0, "缺少车牌号");
            return false;
        }
        
        $car = $this->selectOne("car_license = '{$data['car_license']}' and status=1");
        if ($car && $car['car_id'] != $data['car_id']) {
            $this->setError (0, "车牌号重复" . $this->getError());
            return false;
        }
        
        if (!$data['model']) {
            $this->setError (0, "缺少型号");
            return false;
        }

        if (!$data['license_type']) {
            $this->setError (0, "缺少牌照类型");
            return false;
        }

        $this->set("car_license", $data['car_license']);
        $this->set("license_type", $data['license_type']);
        $this->set("model", $data['model']);
		$this->set("mold", $data['mold']);
        $this->set("volume", $data['volume']);
        $this->set("isrun", $data['isrun']);
        if ($data['car_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($data['car_id']);
        if ($rs) {
            /*
            if ($with_log) {
                $content = $data['car_id'] ? "修改车辆：{$data['car_license']}" : "新增车辆：{$data['car_license']}";
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
	 * 改变车辆使用状态 isrun
	 * @param unknown $carid
	 */
    public function setRun($carid,$status = 0){
    	$car = $this->selectOne("car_id={$carid}");
    	if(!$car){
    		$this->setError (0, "系统异常：车辆信息不存在。");
    		return false;
    	}
    	$this->set("modify_time", date('Y-m-d H:i:s'));
    	$this->set("isrun",$status);
    	$rs = $this->save($carid);
    	if ($rs) {
    		$logObj = base_mAPI::get("m_log");
    		$logObj->create($rs, "改变车辆使用状态：".$car['car_license'], 4301);
    		return $rs;
    	}
    	$this->setError (0, "系统异常：" . $this->getDbError());
    	return false;
    }

	/**
	 * 删除车辆
	 * @param unknown $carid
	 */
    public function delete($carid){
    	$car = $this->selectOne("car_id={$carid}");
    	if(!$car){
    		$this->setError (0, "系统异常：车辆信息不存在。");
    		return false;
    	}
    	$this->set("modify_time", date('Y-m-d H:i:s'));
    	$this->set("status", m_car::STATUS_DEL);
    	$rs = $this->save($carid);
    	if ($rs) {
    		$logObj = base_mAPI::get("m_log");
    		$logObj->create($rs, "删除车辆：".$car['car_license'], 4301);
    		return $rs;
    	}
    	$this->setError (0, "系统异常：" . $this->getDbError());
    	return false;
    }
}
