<?php
/**
 * 送货员表数据模型
 * @author mol
 */
class m_deliveryman extends base_m {
	const STATUS_NORMAL = 1;
	const STATUS_DEL = 2;
	
    public function primarykey() {
		return 'deliveryman_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'deliveryman';
	}
    
	public function relations() {
		return array();
	}

    public function getOptionList() {
        $values = $this->select("status=1", "deliveryman_id, name", "", "order by deliveryman_id");
        $values = $values->items;
        
        return $values;
    }

	public function getDeliverymanList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        if($condition==''){
        	$condition = "status=1";
        }else{
        	$condition = $condition." and status=1";
        }
		$rs = $this->select($condition, "", "", "order by deliveryman_id");
        if ($rs) {
            $list = $rs->items;
            
            $adminObj = new m_admin();
            $weichatuserObj = new m_weichatuser();
            $datadictObj = new m_datadict();
            
            for ($i=0; $i<count($list); $i++) {
                $admin = $adminObj->selectOne("admin_id = {$list[$i]['admin_id']}");
                $list[$i]['admin_name'] = $admin['admin_name'];
                
                $weichatuser = $weichatuserObj->selectOne("weichatuser_id = {$list[$i]['weichatuser_id']}");
                $list[$i]['weichatuser_name'] = $weichatuser['name'];
                
                $key = base_Constant::KEY_DRIVERLICENSE_TYPE;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['driverlicense_type']} and key_id = {$key}");
                $list[$i]['driverlicense_type_name'] = $datadict['name'];
            }
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}
    
    public function create($data, $with_log = NULL) {
        if (!$data['name']) {
            $this->setError (0, "缺少姓名");
            return false;
        }

        if (!$data['mobile']) {
            $this->setError (0, "缺少手机号码");
            return false;
        }
        
        $this->set("name", $data['name']);
        $this->set("mobile", $data['mobile']);
        $this->set("is_driver", $data['is_driver']);
        if ((int)$data['is_driver'] > 0) {
            $this->set("driverlicense_type", $data['driverlicense_type']);
        }
        else {
            $this->set("driverlicense_type", 0);
        }
        $this->set("weichatuser_id", $data['weichatuser_id']);
        if ($data['deliveryman_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($data['deliveryman_id']);
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
	 * 设置送货员为空闲
	 * @param unknown $deliveryman_id
	 */
    public function setWithman($deliveryman_id,$status=0){
    	$man = $this->selectOne("deliveryman_id={$deliveryman_id}");
    	if(!$man){
    		$this->setError (0, "系统异常：送货员信息不存在。");
    		return false;
    	}
    	$this->set("modify_time", date('Y-m-d H:i:s'));
    	$this->set("isrun",$status);
    	$rs = $this->save($deliveryman_id);
    	if ($rs) {
    		$logObj = base_mAPI::get("m_log");
    		$logObj->create($rs, "设置送货员为空闲：".$man['name'], 4401);
    		return $rs;
    	}
    	$this->setError (0, "系统异常：" . $this->getDbError());
    	return false;
    }
	/**
	 * 删除送货员
	 * @param unknown $deliveryman_id
	 */
    public function delete($deliveryman_id){
    	$man = $this->selectOne("deliveryman_id={$deliveryman_id}");
    	if(!$man){
    		$this->setError (0, "系统异常：送货员信息不存在。");
    		return false;
    	}
    	$this->set("modify_time", date('Y-m-d H:i:s'));
    	$this->set("status", m_deliveryman::STATUS_DEL);
    	$rs = $this->save($deliveryman_id);
    	if ($rs) {
    		$logObj = base_mAPI::get("m_log");
    		$logObj->create($rs, "删除送货员：".$man['name'], 4401);
    		return $rs;
    	}
    	$this->setError (0, "系统异常：" . $this->getDbError());
    	return false;
    }
}
