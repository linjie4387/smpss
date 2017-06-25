<?php
/**
 * 医院表数据模型
 * @author mol
 */
class m_hospital extends base_m {
	public function primarykey() {
		return 'hospital_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'hospital';
	}
	public function relations() {
		return array();
	}
	
    public function getOptionList() {
        $values = $this->select("", "hospital_id, name", "", "order by hospital_id");
        $values = $values->items;
        
        return $values;
    }

	public function getHospitalList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by hospital_id");
        if ($rs) {
            $list = $rs->items;
            
            $districtObj = new m_district();
            
            for ($i=0; $i<count($list); $i++) {
                $district = $districtObj->selectOne("district_id = {$list[$i]['district_id']}");
                $list[$i]['district_name'] = $district['name'];
            }
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}
    
    public function create($data, $with_log = NULL) {
        if (!$data['code']) {
            $this->setError (0, "缺少编号");
            return false;
        }
        if (!$data['name']) {
            $this->setError (0, "缺少名称");
            return false;
        }
        if (!$data['level']) {
            $this->setError (0, "缺少级别");
            return false;
        }
        if (!$data['level_order']) {
            $this->setError (0, "缺少级别顺序");
            return false;
        }
        if (!$data['hospital_level']) {
            $this->setError (0, "缺少医院等级");
            return false;
        }
        if (!$data['district_id']) {
            $this->setError (0, "缺少区县");
            return false;
        }
        /*
        if (!$data ['post_code']) {
            $this->setError (0, "缺少邮编");
            return false;
        }
        if (!$data ['address']) {
            $this->setError (0, "缺少地址");
            return false;
        }
         */
        $this->set("code", $data['code']);
        $this->set("name", $data['name']);
        $this->set("invoice_name", $data['invoice_name']);
        $this->set("level", $data['level']);
        $this->set("level_order", $data['level_order']);
        $this->set("hospital_level", $data['hospital_level']);
        $this->set("district_id", $data['district_id']);
        $this->set("post_code", $data['post_code']);
        $this->set("address", $data['address']);
        $this->set("tax_num",  $data['tax_num']);
		
        if ($data['hospital_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
        	$old = $this->selectOne("name='".$data['name']."'");
        	if($old) {
        		$this->setError (0, "新增医院失败：" . $data['name']."已存在。");
        		return false;
        	}
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);

        $rs = $this->save($data['hospital_id']);

        if ($rs) {
            if ($with_log) {
                $content = $data['hospital_id'] ? "修改医院：{$data['name']}" : "新增医院：{$data['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 2);
            }
            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }

}
