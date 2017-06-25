<?php
/**
 * 工程部科室表数据模型
 * @author mol
 */
class m_engineeroffice extends base_m {
	public function primarykey() {
		return 'office_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'engineer_office';
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
    
}
