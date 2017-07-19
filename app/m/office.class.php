<?php
/**
 * 科室表数据模型
 * @author mol
 */
class m_office extends base_m {
	public function primarykey() {
		return 'office_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'office';
	}
	public function relations() {
		return array();
	}
	
	public function getOfficeList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by office_id");
        if ($rs) {
            $list = $rs->items;
            
            $adminObj = new m_admin();
            
            for ($i=0; $i<count($list); $i++) {
                $admin = $adminObj->selectOne("admin_id = {$list[$i]['admin_id']}");
                $list[$i]['admin_name'] = $admin['admin_name'];
            }
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}
	
	public function getOfficeListAndGoods($condition = '', $page = 1, $having=""){
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
		$fields = "smpss_office.*, count(smpss_officegoods.officegoods_id) as goods_count";
		$join = array("smpss_officegoods"=>"smpss_office.office_id=smpss_officegoods.office_id");
		$rs = $this->select($condition, $fields, "group by hospital_id,office_id", "order by office_id", $join, $having);
		if ($rs) {
			$list = $rs->items;
		
			$adminObj = new m_admin();
		
			for ($i=0; $i<count($list); $i++) {
				$admin = $adminObj->selectOne("admin_id = {$list[$i]['admin_id']}");
				$list[$i]['admin_name'] = $admin['admin_name'];
			}
			$rs->items = $list;
		
			return $rs;
		}
		else
			return array();
	}
    
    public function create($data, $with_log = NULL) {
        if (!$data['name']) {
            $this->setError (0, "缺少科室名称");
            return false;
        }
        if (!$data['hospital_id']) {
            $this->setError (0, "缺少医院");
            return false;
        }
        /*
        if (!$data['contact_name']) {
            $this->setError (0, "缺少联系人");
            return false;
        }
        if (!$data['contact_phone']) {
            $this->setError (0, "缺少联系电话");
            return false;
        }
         */
        
        $this->set("name", $data['name']);
        $this->set("hospital_id", $data['hospital_id']);
        $this->set("contact_name", $data['contact_name']);
        $this->set("contact_phone", $data['contact_phone']);
        $this->set("space", $data['space']);
        $hospitalObj = new m_hospital();
        $hospital = $hospitalObj->selectOne("hospital_id = {$data['hospital_id']}");
        $this->set("hospital_name", $hospital['name']);

        if ($data['office_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        $rs = $this->save($data['office_id']);

        if ($rs) {
            if ($with_log) {
                $content = $data['office_id'] ? "修改科室： {$hospital['name']}_{$data['name']}" : "新增科室：{$hospital['name']}_{$data['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 2);
            }

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
    /**
     * 修改科室安全库存系数
     * @param unknown $office_id
     * @param unknown $ratio
     * @return boolean|boolean|unknown
     */
    function setSafeStockRatio($office_id, $ratio){
    	if(!$office_id||!$ratio) {
    		$this->setError (0, "缺少参数");
    		return false;
    	}
    	$this->set("safe_stock_ratio", $ratio);
    	$rs = $this->save($office_id);
    	if ($rs) {
    		if ($with_log) {
    			$content = "修改科室安全库存倍数： {$ratio}";
    			$logObj = base_mAPI::get("m_log");
    			$logObj->create($rs, $content, 11);
    		}
    		return $rs;
    	}
    	
    	$this->setError (0, "保存数据失败" . $this->getError());
    	return false;
    }
}
