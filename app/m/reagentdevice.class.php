<?php
/**
 * 试剂设备表数据模型
 * @author mol
 */
class m_reagentdevice extends base_m {
	public function primarykey() {
		return 'device_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'reagent_device';
	}
	public function relations() {
		return array();
	}
	
	public function getDeviceList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by device_id desc");
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
        $values = $this->select("", "device_id, device_name", "", "order by device_id");
        $values = $values->items;
        
        return $values;
    }

    public function create($data, $with_log = NULL) {
        if (!$data['device_name']) {
            $this->setError (0, "缺少设备名称");
            return false;
        }
        
        $deviceRs = $this->get("device_name = '{$data ['device_name']}'", 'device_id');
        if ($deviceRs) {
            return $deviceRs['device_id'];//已存在则返回设备标识
        }

        $this->set("device_name", $data['device_name']);
        if ($data['device_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($data['device_id']);
        if ($rs) {
            if ($with_log) {
                $content = $data['device_id'] ? "修改试剂类型：{$data['device_name']}" : "新增试剂类型：{$data['device_name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 3);
            }
			if(empty($data['device_id'])){
	            return $rs;
			}else{
				return $deviceRs['device_id'];
			}
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }

}
