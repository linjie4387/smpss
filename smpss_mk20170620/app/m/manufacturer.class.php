<?php
/**
 * 试剂厂商表数据模型
 * @author mol
 */
class m_manufacturer extends base_m {
	public function primarykey() {
		return 'manufacturer_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'manufacturer';
	}
	public function relations() {
		return array();
	}
	
	public function getManufacturerList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by manufacturer_id");
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
    
    public function getOptionList() {
        $values = $this->select("", "manufacturer_id, name", "", "order by manufacturer_id");
        $values = $values->items;
        
        return $values;
    }

    public function create($data, $with_log = NULL) {
        if (!$data['name']) {
            $this->setError (0, "缺少厂商名称");
            return false;
        }
        
        $codeRs = $this->get("name = '{$data ['name']}'", 'name');
        if ($codeRs && ($codeRs['manufacturer_id'] != $data['manufacturer_id'])) {
            $this->setError(0, "厂商编码重复");
            return false;
        }

        $this->set("name", $data['name']);
        if ($data['manufacturer_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($data['manufacturer_id']);
        if ($rs) {
            if ($with_log) {
                $content = $data['manufacturer_id'] ? "修改厂商：{$data['name']}" : "新增厂商：{$data['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 3);
            }

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }

}
