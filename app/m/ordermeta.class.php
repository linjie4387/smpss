<?php
/**
 * 订单视图数据模型
 * @author linj
 */
class m_ordermeta extends m_order {
	const ORDER_STATUS_WAIT = 1;
	const ORDER_STATUS_VERIFY = 2;
	const ORDER_STATUS_DELIVERY = 3;
	const ORDER_STATUS_OVER = 4;
	public function primarykey() {
		return 'order_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'ordermeta';
	}
    
	public function relations() {
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
    
	public function getOrdermetaList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
		
		$rs = $this->select($condition, "", "", "order by order_id desc");
		//echo  $this->getLastSql();
		if ($rs) {
			$list = $rs->items;
			
			$datadictObj = new m_datadict ();
			
			for($i = 0; $i < count ( $list ); $i ++) {
				$key = base_Constant::KEY_TRADE_STATUS;
				$datadict = $datadictObj->selectOne("value = {$list[$i]['status']} and key_id = {$key}");
				$list[$i]['status_name'] = $datadict['name'];

                $key = base_Constant::KEY_ORDER_COMPANY;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['order_company']} and key_id = {$key}");
                $list[$i]['order_company_name'] = $datadict['name'];
                
                if ($list[$i]['status'] == self::ORDER_STATUS_WAIT) {
                    $list[$i]['day_wait'] = self::diffBetweenTwoDays($list[$i]['create_time'], date('Y-m-d H:i:s'));
                }
                else {
                    $list[$i]['day_wait'] = 0;
                }
				
				$cd1=explode("-",$list[$i]['create_time']);
				$cd2=explode(" ",$cd1[2]);
				$createDate = intval($cd1[1])."月".intval($cd2[0])."日";
				$list[$i]['create_date'] = $createDate;
			}
			$rs->items = $list;
			
			return $rs;
		} else
		return array ();
	}
}
