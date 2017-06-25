<?php
/**
 * 仪器表数据模型
 * @author mol
 */
class m_orderpic extends base_m {
    const PIC_TYPE_PREORDER = 1;
    const PIC_TYPE_TRADEORDER = 2;
    const PIC_TYPE_DELIVERY = 3;

	public function primarykey() {
		return 'id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'order_pic';
	}
    
	public function relations() {
		return array();
	}
	
    /**
     * 新增订单图片
     * @param unknown $data
     */
    public function createPic($data) {
        $this->set("order_id", $data['order_id']);
        $this->set("pic_url", $data['pic_url']);
        $this->set("type", $data['type']);
        $this->set("create_time", date("Y-m-d H:i:s"));
        $rs = $this->save(false);
        if (!$rs){
        	$this->setError(0, "新增订单图片失败：".$this->getDbError());
        	return false;
        }

        return true;
    }
    
    public function getPicList($order_id, $type) {
        $piclist = array();
        
        $rs = $this->select("order_id = {$order_id} and type = {$type}", "", "", "order by id");
        if ($rs) {
            $list = $rs->items;
            
            for($i = 0; $i < count ( $list ); $i ++) {
                array_push($piclist, $list[$i]['pic_url']);
            }
        }
        
        return $piclist;
    }

}
