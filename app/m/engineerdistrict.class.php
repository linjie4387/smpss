<?php
/**
 * 工程师区县表数据模型
 * @author mol
 */
class m_engineerdistrict extends base_m {
	public function primarykey() {
		return 'engineerdistrict_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'engineerdistrict';
	}
	public function relations() {
		return array();
	}
    
    function create($weichatuser_id, $district_id) {
        if (!$weichatuser_id or ! $district_id) {
            $this->setError(0, "缺少必要参数");
            return false;
        }

        $this->set("weichatuser_id", $weichatuser_id);
        $this->set("district_id", $district_id);
        $this->set("admin_id", $_COOKIE['admin_id']);
        $this->set("create_time", date('Y-m-d H:i:s'));

        $res = $this->save(false);
        if ($res) {
            return $res;
        }
        $this->setError(0, "保存数据失败:" . $this->getError());
        return false;
    }

    public function getDistrictList($weichatuser_id) {
        $rs = $this->select("weichatuser_id = {$weichatuser_id}", "", "", "order by weichatuser_id");
        if ($rs) {
            return $rs;
        }
        else
            return array();
    }

    public function getDistrictAllList($weichatuser_id) {
        $districtObj = new m_district();
        $rs = $districtObj->getOptionList();
        if ($rs) {
            $list = $rs;
            
            for ($i=0; $i<count($list); $i++) {
                $engineerdistrict = $this->selectOne("weichatuser_id = {$weichatuser_id} and district_id = {$list[$i]['district_id']}");
                if ($engineerdistrict) {
                    $list[$i]['is_checked'] = 1;
                }
                else {
                    $list[$i]['is_checked'] = 0;
                }
            }
            return $list;
        }
        else
            return array();
    }

    public function createEngineerDistrict($data) {
        if (!$data['weichatuser_id']) {
            $this->setError (0, "缺少微信用户信息");
            return false;
        }

        if (!$data['engineerdistrict']) {
            $this->setError (0, "缺少工程师区县信息");
            return false;
        }
        
        $weichatuserObj = new m_weichatuser();
        $weichatuser = $weichatuserObj->selectOne("weichatuser_id = {$data['weichatuser_id']}");

        // 删除原来旧数据
        $this->delete("weichatuser_id = '{$data['weichatuser_id']}'");

        $engineerdistrictList = $data['engineerdistrict'];
        for ($i=0; $i<count($engineerdistrictList); $i++) {
            $rs = $this->create($data['weichatuser_id'], $engineerdistrictList[$i]);
            if (!$rs) {
                $this->setError (0, "保存数据失败" . $this->getError());
                return false;
            }
        }
        
        $content = "分配微信用户区县权限: {$weichatuser['name']}";
        $logObj = base_mAPI::get("m_log");
        $logObj->create($data['weichatuser_id'], $content, 4);
        
        return true;
    }

}
