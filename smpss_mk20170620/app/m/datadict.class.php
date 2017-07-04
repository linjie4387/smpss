<?php
/**
 * 数据字典表数据模型
 * @author mol
 */
class m_datadict extends base_m {

    public function primarykey() {
		return 'dict_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'datadict';
	}
    
	public function relations() {
		return array ();
	}
    
    public function getOrderType($key_id) {
        $values = $this->select("key_id = {$key_id}", "value, name, key_desc", "", "order by dict_id");
        $values = $values->items;

        return $values;
    }
    
    public function setDataDict($key_id, $list) {
        if (!$key_id) {
            $this->setError(0, "字段关键字不存在");
            return false;
        }

        $data['key_id'] = $key_id;
        $count = 0;

        foreach ($list as $key => $val) {
            $count = count($val);
        }

        for ($i=0; $i<$count; $i++) {
            $data['name'] = $list['name'][$i];
            $data['value'] = $list['value'][$i];
            $data['key_desc'] = $list['key_desc'][$i];

            $itemResult = $this->selectOne("key_id = {$data['key_id']} and value = {$data['value']}");
            if ($itemResult) {
                $data['dict_id'] = $itemResult['dict_id'];
            }
            else {
                $data['dict_id'] = NULL;
            }
            $rs = self::create($data);
            if (!$rs) {
                $this->setError (0, "保存数据失败" . $this->getError());
                return false;
            }
        }
        
        return true;
    }
    
    public function create($data) {
        if (!$data['key_id']) {
            $this->setError (0, "缺少关键字");
            return false;
        }
        if (!$data['value']) {
            $this->setError (0, "缺少值");
            return false;
        }
        if (!$data['name']) {
            $this->setError (0, "缺少名称");
            return false;
        }
        
        $this->set("key_id", $data['key_id']);
        $this->set("key_desc", $data['key_desc']);
        $this->set("value", $data['value']);
        $this->set("name", $data['name']);
        
        if ($data['dict_id']) {
            $rs = $this->save($data['dict_id']);
        }
        else {
            $rs = $this->save(false);
        }
        if ($rs) {
            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
    
}
