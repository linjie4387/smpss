<?php
/**
 * 销售预测明细数据模型
 * @author zjx
 */
class m_forecastdetail extends base_m {
	
	public function primarykey() {
		return 'id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'forecast_detail';
	}
    
	public function relations() {
		return array ();
	}
    
    public function create($data){
    	$this->set("forecast_bill_no", $data['forecast_bill_no']);
    	$this->set("goods_id", $data['goods_id']);
    	$this->set("goods_name", $data['goods_name']);
    	$this->set("specification", $data['specification']);
    	$this->set("unit", $data['unit']);
    	$this->set("safe_stock", $data['safe_stock']);
    	$this->set("safe_stock_ratio", $data['safe_stock_ratio']);
    	$this->set("avg", $data['avg']);
    	$this->set("order_quantity", $data['order_quantity']);
    	$this->set("confirm_quantity", $data['confirm_quantity']);
    	$this->set("remark", $data['remark']);
    	return $this->save(false);
    }
}
