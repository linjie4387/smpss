<?php
/**
 * 发车货品清单表数据模型
 * @author mol
 */
class m_deliverycommit extends base_m {
    const PASS = 1;
    const NOPASS = 0;

    public function primarykey() {
		return 'commit_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'deliverycommit';
	}
    
	public function relations() {
		return array();
	}

	public function getCommit($withgoods_id) {
		$rs = $this->selectOne("withgoods_id=".$withgoods_id);
		return $rs;
	}
    
    public function create($data) {
		//echo '2222342333222222222';

		$withgoods_id = $data['withgoods_id'];
		
		$withgoodsObj = new m_deliverywithgoods();
		$withgoods = $withgoodsObj->getWithGoods($withgoods_id);
		$this->query('delete from smpss_deliverycommit where withgoods_id='.$withgoods['withgoods_id']);
		//$this->set("withgoods_id",  $withgoods['withgoods_id']);
		//$this->delete();
		
        $this->set("delivery_id",  $withgoods['delivery_id']);
		$this->set("order_id",  $withgoods['order_id']);
		$this->set("withgoods_id",  $withgoods['withgoods_id']);
        $this->set("user_id", $_COOKIE['admin_id']);
        $this->set("user_name",$_COOKIE['admin_name']);
        $this->set("result", $data['result']);
		$this->set("result_desc", $data['result_desc']);
		$this->set("create_time", date('Y-m-d H:i:s'));
        
		$rs = $this->save();
        if ($rs) {
            return $rs;
        }else{
	        $this->setError (0, "保存数据失败" . $this->getError());
		}
        return false;
    }
	
    public function update($data) {
		
		$withgoods_id = $data['withgoods_id'];
        $this->set("user_id", $_COOKIE['admin_id']);
        $this->set("user_name",$_COOKIE['admin_name']);
        $this->set("result", $data['result']);
		$this->set("result_desc", $data['result_desc']);
		$this->set("create_time", date('Y-m-d H:i:s'));
        
        $rs = $this->save($withgoods_id);
        if ($rs) {
            return $rs;
        }else{
	        $this->setError (0, "保存数据失败" . $this->getError());
		}
        return false;
    }
	
    public function getObj($withgoods_id) {
		
        $rs = $this->selectOne("withgoods_id=".$withgoods_id);
        if ($rs) {
            return $rs;
        }else{
	        $this->setError (0, "保存数据失败" . $this->getError());
		}
        return false;
    }

}
