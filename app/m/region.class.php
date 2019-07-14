<?php
/**
 * @author mol
 */
class m_region extends base_m {
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'region';
	}
    
    public function getProvinceByName($province_name) {
        $values = $this->select("region_name='".$province_name."' and parent_id=1", "", "", "order by region_name");
		//var_dump(json_encode($this));
        $values = $values->items;
        return $values;
    }
    
    public function getProvinceByid($province_id) {
        $values = $this->select("region_id='".$province_id."' and parent_id!=1", "", "", "order by region_name");
        $values = $values->items;
        
        return $values;
    }
    
    
    public function getCityByProvinceid($province_id) {
        $values = $this->select("parent_id='".$province_id."'", "", "", "order by region_name");
        $values = $values->items;
        
        return $values;
    }
    
    public function getCityByName($city_name) {
        $values = $this->select("region_name='".$city_name."' and parent_id!=1", "", "", "order by region_name");
        $values = $values->items;
        
        return $values;
    }
    
    public function getCityById($city_id) {
        $values = $this->select("region_id='".$city_id."' and parent_id!=1", "", "", "order by region_name");
        $values = $values->items;
        
        return $values;
    }
   
}
