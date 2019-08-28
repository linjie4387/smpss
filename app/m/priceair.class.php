<?php
/**
 * 车辆表数据模型
 * @author mol
 */
class m_priceair extends base_m {
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'priceair';
	}
    
    
    public function create($data, $with_log = NULL) {
        if (!$data['province_name']) {
            $this->setError (0, "缺少省份");
            return false;
        }

        if (!$data['city_name']) {
            $this->setError (0, "缺少城市");
            return false;
        }
        
        $this->set("province_id", $data['province_id']);
        $this->set("province_name", $data['province_name']);
        $this->set("city_id", $data['city_id']);
		$this->set("city_name", $data['city_name']);
        $this->set("col1", $data['col1']);
        $this->set("col2", $data['col2']);
        $this->set("col3", $data['col3']);
        $this->set("col4", $data['col4']);
        $this->set("col5", $data['col5']);
        $this->set("duration", $data['duration']);
		
        $rs = $this->save(false);
		
        if ($rs) {
            return true;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }


	public function getOne($province_id,$city_id) {
        if (!$data['province_name']) {
            $this->setError (0, "缺少省份");
            return false;
        }

        if (!$data['city_name']) {
            $this->setError (0, "缺少城市");
            return false;
        }
		
		$rs = $this->select ("province_id='".$province_id."' and city_id='".$city_id."'", "", "", "order by id desc" );
		$list = $rs->items;
		if ($list) {
			$price = $rs->items[0];
			return $price;
		} else
			return array ();
	}
}
