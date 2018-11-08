<?php
/**
 * 微信用户表数据模型
 * @author mol
 */
class m_weichatuser extends base_m {
	//用户类型-医院用户
	const USER_TYPE_HOSPITAL = 1;
	//用户类型-工程部用户
	const USER_TYPE_DEPARTMENT = 2;
	//用户类型-代理用户
	const USER_TYPE_AGENT = 3;

	//用户级别
	const USER_LEVEL_NORMAL = 1;   //普通用户
	const USER_LEVEL_DRIVER = 101;   //司机
	const USER_LEVEL_ADMIN = 2;		//管理员
	
	//用户状态
	const USER_STATUS_UNPASS = 1;   //待审核
	const USER_STATUS_PASSED = 2;   //审核通过
	const USER_STATUS_BLOCK = 3;   //审核不通过
	const USER_STATUS_CLOSE = 4;   //关闭权限
	
	//用户是否有效
	const USER_VALID = 1;   //普通用户
	const USER_UNVLID = 0;   //司机


	
	public function primarykey() {
		return 'weichatuser_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'weichatuser';
	}
	public function relations() {
		return array();
	}
	
	public function getWeichatuserList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by weichatuser_id desc");
        if ($rs) {
            $list = $rs->items;
            
            $datadictObj = new m_datadict();
            
            for ($i=0; $i<count($list); $i++) {
                $key = base_Constant::KEY_USER_TYPE;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['type']} and key_id = {$key}");
                $list[$i]['type_name'] = $datadict['name'];
                $key = base_Constant::KEY_USER_LEVEL;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['level']} and key_id = {$key}");
                $list[$i]['level_name'] = $datadict['name'];
                $key = base_Constant::KEY_USER_STATUS;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['status']} and key_id = {$key}");
                $list[$i]['status_name'] = $datadict['name'];
               
                $list[$i]['subscribe_name'] = $list[$i]['subscribe']==1?"是":"否";
            }
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}
    
    public function getHospitalOptionList() {
        $values = $this->select("is_valid = 1 and status = 2 and type = 3", "weichatuser_id, name,mobile", "", "order by weichatuser_id");
        $values = $values->items;
        
        return $values;
    }
	
	//获得下单人微信列表
	public function gethasdeliveryList() {
        $values = $this->select("is_valid = 1 and status = 2 and type = 1", "weichatuser_id, name,mobile", "", "order by weichatuser_id");
        $values = $values->items;
        
        return $values;
    }
	
	
    //查询送货员
    public function getDeliveryUser(){
    	//$values = $this->select("is_valid = 1 and status = 2 and (type = 3 or type=2)", "weichatuser_id, name", "", "order by weichatuser_id");
		//edit by linj, type=3为内部用户 level=101为司机或送货员, status = 2为已审核， is_valid=1 为有效（没被删除）
		$values = $this->select("is_valid = 1 and status = 2 and type = 3 and level = 101", "weichatuser_id, name", "", "order by weichatuser_id");
    	$values = $values->items;
    	
    	return $values;
    }

    public function createHospitalUser($data) {
        if (!$data['open_id']) {
            $this->setError (0, "缺少微信OPENID");
            return false;
        }
        if (!$data['name']) {
            $this->setError (0, "缺少姓名");
            return false;
        }
        if (!$data['mobile']) {
            $this->setError (0, "缺少手机号码");
            return false;
        }
        if($data['type']==m_weichatuser::USER_TYPE_HOSPITAL) {
	        if (!$data['hospital_id'] || !$data['hospital_name']) {
	            $this->setError (0, "缺少医院");
	            return false;
	        }
	        if (!$data['office_id'] || !$data['office_name']) {
	            $this->setError (0, "缺少科室");
	            return false;
	        }
	        if (!$data['order_company']) {
	        	$this->setError (0, "缺少接单公司");
	        	return false;
	        }
        }
        if (!$data['status']) {
            $this->setError (0, "缺少用户状态");
            return false;
        }
        
        $weichatuser = $this->selectOne("weichatuser_id = {$data['weichatuser_id']}");

        $this->set("open_id", $data['open_id']);
        $this->set("name", $data['name']);
        $this->set("mobile", $data['mobile']);
        $this->set("hospital_id", $data['hospital_id']);
        $this->set("hospital_name", $data['hospital_name']);
        $this->set("office_id", $data['office_id']);
        $this->set("office_name", $data['office_name']);
        $this->set("status", $data['status']);
        $this->set("order_company", $data['order_company']);
        $this->set("type", $weichatuser['type']);
        $this->set("level", $data['level']);
        $this->set("apply_time", $weichatuser['apply_time']);
        $this->set("verify_time", $weichatuser['verify_time']);
        $this->set("verify_admin_id", $weichatuser['verify_admin_id']);
        $this->set("close_time", $weichatuser['close_time']);
        $this->set("close_admin_id", $weichatuser['close_admin_id']);
        
        switch ($data['status']) {
            case 1 : // 待审核状态
                break;
            case 2:  // 正常用户
            case 3:  // 审核不通过
                $this->set("verify_time", date('Y-m-d H:i:s'));
                $this->set("verify_admin_id", $_COOKIE['admin_id']);
                break;
            case 4:  // 关闭权限
                $this->set("close_time", date('Y-m-d H:i:s'));
                $this->set("close_admin_id", $_COOKIE['admin_id']);
                break;
        }

        if ($data['weichatuser_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($data['weichatuser_id']);
        if ($rs) {
            $content = $data['weichatuser_id'] ? "修改微信用户：{$data['name']}" : "新增微信用户：{$data['name']}";
            $logObj = base_mAPI::get("m_log");
            $logObj->create($rs, $content, 4);

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }

    public function createEngineer($data, $with_log = NULL) {
        if (!$data['open_id']) {
            $this->setError (0, "缺少微信OPENID");
            return false;
        }
        if (!$data['name']) {
            $this->setError (0, "缺少姓名");
            return false;
        }
        if (!$data['mobile']) {
            $this->setError (0, "缺少手机号码");
            return false;
        }
        if (!$data['level']) {
            $this->setError (0, "缺少用户等级");
            return false;
        }
        if (!$data['status']) {
            $this->setError (0, "缺少用户状态");
            return false;
        }
        
        $weichatuser = $this->selectOne("weichatuser_id = {$data['weichatuser_id']}");
        
        $this->set("open_id", $data['open_id']);
        $this->set("name", $data['name']);
        $this->set("mobile", $data['mobile']);
        $this->set("status", $data['status']);
        $this->set("is_valid", $data['is_valid']);
        $this->set("level", $data['level']);
        $this->set("type", $weichatuser['type']);
        $this->set("apply_time", $weichatuser['apply_time']);
        $this->set("verify_time", $weichatuser['verify_time']);
        $this->set("verify_admin_id", $weichatuser['verify_admin_id']);
        $this->set("close_time", $weichatuser['close_time']);
        $this->set("close_admin_id", $weichatuser['close_admin_id']);
        $this->set("remark", $weichatuser['remark']);
        
        switch ($data['status']) {
            case 1 : // 待审核状态
                break;
            case 2:  // 正常用户
            case 3:  // 审核不通过
                $this->set("verify_time", date('Y-m-d H:i:s'));
                $this->set("verify_admin_id", $_COOKIE['admin_id']);
                break;
            case 4:  // 关闭权限
                $this->set("close_time", date('Y-m-d H:i:s'));
                $this->set("close_admin_id", $_COOKIE['admin_id']);
                break;
        }
        
        if ($data['weichatuser_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($data['weichatuser_id']);
        if ($rs) {
            if ($with_log) {
                $content = $data['weichatuser_id'] ? "修改微信用户：{$data['name']}" : "新增微信用户：{$data['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 4);
            }

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }

    public function deleteUser($weichatuser_id, $with_log = NULL) {
        if (!$weichatuser_id) {
            $this->setError (0, "缺少微信用户标识");
            return false;
        }
        
        $weichatuser = $this->selectOne("weichatuser_id = {$weichatuser_id}");
        
        $this->set("is_valid", "0");
        $this->set("modify_time", date('Y-m-d H:i:s'));
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($weichatuser_id);
        if ($rs) {
            if ($with_log) {
                $content = "删除微信用户：{$weichatuser['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 4);
            }
            
            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
	/**
	 * 修改用户订阅状态
	 * @param unknown $data
	 * @return boolean
	 */
    function updatesubscribe($data) {
    	$openid = $data['openid'];
    	$status = $data['status'];
    	if(empty($openid)||empty($status)){
    		$this->setError(0, "参数不足");
    		return false;
    	}
    	$weichatuser = $this->selectOne("open_id = '{$openid}'");
    	if($status==2&&empty($weichatuser)){
    		$this->setError(0, "用户不存在");
    		return false;
    	}
    	if($weichatuser) {
	    	$this->set("subscribe", $status);
	    	$this->set("modify_time", date('Y-m-d H:i:s'));
	    	$rs = $this->save($weichatuser['weichatuser_id']);
    	}
    }
}
