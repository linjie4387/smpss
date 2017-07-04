<?php
/**
 * 试剂机型表数据模型
 * @author mol
 */
class m_reagentmodel extends base_m {
	public function primarykey() {
		return 'model_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'reagent_model';
	}
	public function relations() {
		return array();
	}
	
	public function getModelList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by model_id desc");
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
    
    public function getOptionList($device_id) {
        $values = $this->select("device_id={$device_id}", "model_id, model_name", "", "order by model_id");
        $values = $values->items;
        
        return $values;
    }

    public function create($data, $with_log = NULL) {
        if (!$data['model_name']) {
            $this->setError (0, "缺少机型名称");
            return false;
        }
        
        if (!$data['device_id']) {
        	$this->setError (0, "缺少设备标识");
        	return false;
        }
        
        $modelRs = $this->get("model_name = '{$data ['model_name']}' and device_id={$data['device_id']}", 'model_id');
        if ($modelRs) {
            return $modelRs['model_id'];
        }

        $this->set("model_name", $data['model_name']);
        $this->set("device_id", $data['device_id']);
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
                $content = $data['device_id'] ? "修改试剂机型：{$data['model_name']}" : "新增试剂机型：{$data['model_name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 3);
            }
			if($modelRs){
				return $modelRs['model_id'];
			}
            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }

}
