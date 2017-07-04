<?php
/**
 * 区县表数据模型
 * @author mol
 */
class m_district extends base_m {
	public function primarykey() {
		return 'district_id';
	}

    public function tableName() {
		return base_Constant::TABLE_PREFIX . 'district';
	}

    public function relations() {
		return array();
	}

    public function getOptionList() {
        $values = $this->select("", "district_id, name", "", "order by district_id");
        $values = $values->items;
        
        return $values;
    }
    
    public function getDistrictList($condition = '', $page = 1) {
        $this->setCount(true);
        $this->setPage($page);
        $this->setLimit(base_Constant::PAGE_SIZE);

        $rs = $this->select($condition, "", "", "order by create_time");
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
            $this->setError (0, "缺少区县名称");
            return false;
        }
        
        $nameRs = $this->get("name = '{$data['name']}'", 'name');
        if ($nameRs && ($nameRs['district_id'] != $data['district_id'])) {
            $this->setError ( 0, "区县名称重复" );
            return false;
        }

        $this->set("name", $data['name']);
        if ($data['district_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);

        $rs = $this->save($data['district_id']);
		if ($rs)
        {
            if ($with_log) {
                $content = $data['district_id'] ? "修改区县：{$data['name']}" : "新增区县：{$data['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 1);
            }

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
		return false;
	}
}