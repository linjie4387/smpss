<?php
/**
 * 型号表数据模型
 * @author mol
 */
class m_model extends base_m {
	public function primarykey() {
		return 'model_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'model';
	}
	public function relations() {
		return array();
	}
	
	public function getModelList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by model_id");
        if ($rs) {
            $list = $rs->items;
            
            $adminObj = new m_admin();
            $supplierObj = new m_supplier();
            
            for ($i=0; $i<count($list); $i++) {
                $admin = $adminObj->selectOne("admin_id = {$list[$i]['admin_id']}");
                $list[$i]['admin_name'] = $admin['admin_name'];
                $supplier = $supplierObj->selectOne("supplier_id = {$list[$i]['supplier_id']}");
                $list[$i]['supplier_code'] = $supplier['code'];
            }
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}
    
    public function create($data, $with_log = NULL) {
        if (!$data['name']) {
            $this->setError (0, "缺少型号名称");
            return false;
        }
        if (!$data['supplier_id']) {
            $this->setError (0, "缺少供应商");
            return false;
        }
        
        $this->set("name", $data['name']);
        $this->set("supplier_id", $data['supplier_id']);
        
        if ($data['model_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($data['model_id']);
        if ($rs) {
            if ($with_log) {
                $content = $data['model_id'] ? "修改型号： {$data['supplier_id']}_{$data['name']}" : "新增型号：{$data['supplier_id']}_{$data['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 3);
            }

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
    
}
