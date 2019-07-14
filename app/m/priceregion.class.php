<?php
/**
 * @author mol
 */
class m_priceregion extends base_m {
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'priceregion';
	}
    
    public function getProvinceByName($province_name) {
        $values = $this->select("region_name='".$province_name."' and parent_id=0", "", "", "order by  sort asc");
		$values = $values->items;
		if($values){
			//var_dump(json_encode($values));
			return $values;
		}
		return null;
    }
    
    public function getProvinceByid($province_id) {
        $values = $this->select("region_id='".$province_id."' and parent_id!=0", "", "", "order by  sort asc");
		$values = $values->items;
		if($values){
			//var_dump(json_encode($this));
			return $values;
		}
		return null;
    }
    
    
    public function getCityByProvinceid($province_id) {
        $values = $this->select("parent_id='".$province_id."'", "", "", "order by  sort asc");
		$values = $values->items;
		if($values){
			//var_dump(json_encode($this));
			return $values;
		}
		return null;
    }
    
    public function getCityByName($city_name) {
        $values = $this->select("region_name='".$city_name."' and parent_id!=0", "", "", "order by sort asc");
		$values = $values->items;
		if($values){
			//var_dump(json_encode($this));
			return $values;
		}
		return null;
    }
    
    public function getCityById($city_id) {
        $values = $this->select("region_id='".$city_id."' and parent_id!=0", "", "", "order by sort asc");
		$values = $values->items;
		if($values){
			//var_dump(json_encode($this));
			return $values;
		}
		return null;
    }
	
    public function createProvince($region_name, $with_log = NULL) {
        if (!$region_name) {
            $this->setError (0, "缺少省份名称");
            return false;
        }
		//var_dump(json_encode($this));
        $values = $this->select("region_name='".$region_name."' and parent_id=0", "", "", "");
		$values = $values->items;
		if($values){
			return true;
		}
		
		$sort='100';
		$all='0';
		if($region_name=='香港' || $region_name=='澳门'){
			$sort='101';
		}
				                
        $this->set("region_name", $region_name);
        $this->set("parent_id", '0');
        $this->set("sort", $sort);
        $this->set("city_all", $all);
		
        $rs = $this->save(false);
        if ($rs) {

            return true;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
	
    public function createCity($region_name,$parent_id, $with_log = NULL) {
        if (!$region_name) {
            $this->setError (0, "缺少城市名称");
            return false;
        }
		
        $values = $this->select("region_name='".$region_name."' and parent_id=".$parent_id, "", "", "");
		//var_dump(json_encode($this));
		$values = $values->items;
		if($values){
			
			return true;
		}
		
		$sort='100';
		$all='0';
		if($region_name=='香港' || $region_name=='澳门' || $region_name=='香港全境' || $region_name=='澳门全境'){
			$sort='101';
		}
		
		if(strpos($region_name,'全境')!=false){
			$sort='99';
			$all='1';
		}
		//var_dump(json_encode($this));      
        $this->set("region_name", $region_name);
        $this->set("parent_id", $parent_id);
        $this->set("sort", $sort);
        $this->set("city_all", $all);
		
        $rs = $this->save(false);
        if ($rs) {

            return true;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
   
}
