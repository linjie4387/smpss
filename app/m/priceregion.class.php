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
		
		$regionsort["北京"]=1;
		$regionsort["重庆"]=2;
		$regionsort["上海"]=3;
		$regionsort["天津"]=4;
		$regionsort["安徽"]=5;
		$regionsort["福建"]=6;
		$regionsort["广东"]=7;
		$regionsort["甘肃"]=8;
		$regionsort["广西"]=9;
		$regionsort["贵州"]=10;
		$regionsort["湖北"]=11;
		$regionsort["河北"]=12;
		$regionsort["黑龙江"]=13;
		$regionsort["海南"]=14;
		$regionsort["河南"]=15;
		$regionsort["湖南"]=16;
		$regionsort["吉林"]=17;
		$regionsort["江苏"]=18;
		$regionsort["江西"]=19;
		$regionsort["辽宁"]=20;
		$regionsort["宁夏"]=21;
		$regionsort["内蒙古"]=22;
		$regionsort["青海"]=23;
		$regionsort["四川"]=24;
		$regionsort["山东"]=25;
		$regionsort["山西"]=26;
		$regionsort["陕西"]=27;
		$regionsort["新疆"]=28;
		$regionsort["西藏"]=29;
		$regionsort["香港"]=30;
		$regionsort["云南"]=31;
		$regionsort["浙江"]=32;
		
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
		
		
		$sort=$regionsort[$region_name];
		$all='0';
		if(empty($sort)){
			$sort='99';
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
