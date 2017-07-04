<?php
/**
 * 供应商表数据模型
 * @author mol
 */
class m_supplier extends base_m {
	public function primarykey() {
		return 'supplier_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'supplier';
	}
	public function relations() {
		return array();
	}
	
	public function getSupplierList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by supplier_id");
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
        $values = $this->select("", "supplier_id, code", "", "order by supplier_id");
        $values = $values->items;
        
        return $values;
    }

    public function create($data, $with_log = NULL) {
        if (!$data['code']) {
            $this->setError (0, "缺少供应商编码");
            return false;
        }
        
        $codeRs = $this->get("code = '{$data ['code']}'", 'code');
        if ($codeRs && ($codeRs['supplier_id'] != $data['supplier_id'])) {
            $this->setError(0, "供应商编码重复");
            return false;
        }

        $this->set("code", $data['code']);
        if ($data['supplier_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($data['supplier_id']);
        if ($rs) {
            if ($with_log) {
                $content = $data['supplier_id'] ? "修改供应商：{$data['code']}" : "新增供应商：{$data['code']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 3);
            }

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }

}
