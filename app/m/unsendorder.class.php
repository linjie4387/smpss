<?php
/**
 * 未配送的订单视图
 * @author mol
 */
class unsendorder extends base_m {
	
	public function primarykey() {
		return 'order_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'unsendorder';
	}
    
	public function relations() {
		return array ();
	}
    

	public function getUnsendOrderList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		//$this->setLimit(base_Constant::PAGE_SIZE);
		
		$rs = $this->select($condition, "", "", "order by delivery_time desc");
		if ($rs) {
			$list = $rs->items;
			
			$datadictObj = new m_datadict ();
			
			for($i = 0; $i < count ( $list ); $i ++) {
				$key = base_Constant::KEY_TRADE_STATUS;
				$datadict = $datadictObj->selectOne("value = {$list[$i]['status']} and key_id = {$key}");
				$list[$i]['status_name'] = $datadict['name'];
                
                if ($list[$i]['status'] == self::ORDER_STATUS_WAIT) {
                    $list[$i]['day_wait'] = self::diffBetweenTwoDays($list[$i]['delivery_time'], date('Y-m-d H:i:s'));
                }
                else {
                    $list[$i]['day_wait'] = 0;
                }
			}
			$rs->items = $list;
			
			return $rs;
		} else
			return array ();
	}
	
    function diffBetweenTwoDays($day1, $day2)
    {
        $second1 = strtotime($day1);
        $second2 = strtotime($day2);
        
        if ($second1 < $second2) {
            $tmp = $second2;
            $second2 = $second1;
            $second1 = $tmp;
        }
        return floor(($second1 - $second2) / 86400);
    }
}
