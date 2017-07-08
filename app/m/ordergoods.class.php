<?php
/**
 * 订单商品视图
 *（以前各个表关联商品采用自增主键，为了避免重新导入商品导致已经配置好的商品信息丢失，这里创建视图，用goods_no值替换代替原来的goods_id)
 * @author mol
 */
class m_ordergoods extends base_m {

    public function primarykey() {
		return 'ordergoods_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'ordergoods';
	}
    
	public function relations() {
		return array ();
	}
    
    public function getGoodsList($order_id) {
        $orderObj = new m_order();
        $order = $orderObj->selectOne("order_id = {$order_id}");
        if (!$order) {
            $this->setError(0, "订单不存在");
            return false;
        }
        $where = "select * from smpss_goods as a join ";
        $where .= "(select goods_id from smpss_ordergoods where order_id={$order_id}";
        $where .= " union select goods_id from smpss_officegoods where office_id={$order['office_id']}) b";
		$where .=" on a.goods_id=b.goods_id order by manu, category, name";

		//echo $where;
        $goodslist = $orderObj->query($where);
		
        if (!empty($goodslist->items)) {
            $list = $goodslist->items;
            
            $goodsObj = new m_goods();
            $offcegoodsObj = new m_officegoods();

            for ($i=0; $i<count($list); $i++) {
				
                $goods = $goodsObj->selectOne("goods_id = '{$list[$i]['goods_id']}'");
				
                $list[$i]['specification'] = $goods['specification'];
                $list[$i]['unit'] = $goods['unit'];
                $list[$i]['name'] = $goods['name'];
                $list[$i]['extern_name'] = $goods['extern_name'];
				
                $list[$i]['category'] = $goods['category'];
                $list[$i]['machine'] = $goods['machine'];
                $list[$i]['manu'] = $goods['manu'];
                $item = $this->selectOne("order_id = {$order_id} and goods_id = '{$list[$i]['goods_id']}'");
                if ($item) {
                    $list[$i]['quantity'] = $item['quantity'];
                }
                else {
                    $list[$i]['quantity'] = 0.0;
                }
                $officeitem = $offcegoodsObj->selectOne("office_id = {$order['office_id']} and goods_id = '{$list[$i]['goods_id']}'");
                if ($officeitem) {
                    $list[$i]['is_exist'] = 1;
                }
                else {
                    $list[$i]['is_exist'] = 0;
                }
            }
            
            $rs->items = $list;
            
            return $rs;
        }
        else
            return array();
    }
	
	//设置拆分后的订单信息并更新被拆分的订单信息
	public function newOrderExcreteGoods($order_id,$excrete) {
        if (!$order_id) {
            $this->setError(0, "订单标识不存在");
            return false;
        }
        $orderObj = new m_order();
        $order = $orderObj->selectOne("order_id = {$order_id}");
        if (!$order) {
            $this->setError(0, "订单不存在");
            return false;
        }
		$goodsObj = new m_goods();
		$oldOrderid = $excrete['order_id'];
		foreach($excrete['details'] as $item){
			$this->set("order_id",$order_id);
			$this->set("hospital_id",(int)$order['hospital_id']);
			$this->set("office_id",(int)$order['office_id']);
			$this->set("goods_id",$item['goods_id']);
			$this->set("quantity", (float)$item['excrete']);
			$this->set("create_time", date('Y-m-d H:i:s'));
			$this->set("modify_time", date('Y-m-d H:i:s'));
			$this->set("admin_id",$_COOKIE ['admin_id']);
			$this->set("remark",$item['remark']);
			$goods = $goodsObj->selectOne("goods_id={$item['goods_id']}");
			$this->set("goods_name",$goods['name']);
			$this->set("spec",$goods['specification']);
			$this->set("unit",$goods['unit']);
			$rs = $this->save(false);
			
			$item['hospital_id'] = (int)$order['hospital_id'];
			$item['office_id'] = (int)$order['office_id'];
			if (!$rs) {
				$this->setError (0, "保存数据失败" . $this->getError());
	            return false;
	        }
			else{
				//更新原订单下的商品数量
				$updateExcrete = $this->updateExcreteOrder($oldOrderid,$item);
				if(!$updateExcrete){
					$this->setError (0, "更新原订单数据失败." . $this->getError());
            		return false;
				}
			}
		}
        return true;
    }
	//更新被拆分后的商品数量 并更新备注
	public function updateExcreteOrder($order_id,$goods) {
        if (!$order_id) {
            $this->setError (0, "缺少订单标识");
            return false;
        }
		$goodsInfo = $this->selectOne("
			goods_id = {$goods['goods_id']} and order_id = {$order_id}  
			and hospital_id = {$goods['hospital_id']} 
			and office_id = {$goods['office_id']}
		 ");
		if($goodsInfo['quantity']-(float)$item['excrete'] <0)continue;
		$this->set("quantity", $goodsInfo['quantity']-$goods['excrete']);
		$this->set("remark",$goodsInfo['remark'].$goods['remark']);
		
		$rs = $this->save($goodsInfo['ordergoods_id']);
		if (!$rs) {
			$this->setError (0, "保存数据失败" . $this->getError());
            return false;
        }
		return true;
    }

    public function setOrderGoods($order_id, $list) {
        if (!$order_id) {
            $this->setError(0, "订单标识不存在");
            return false;
        }

        $data['order_id'] = $order_id;
        $orderObj = new m_order();
        $order = $orderObj->selectOne("order_id = {$data['order_id']}");
        if (!$order) {
            $this->setError(0, "订单不存在");
            return false;
        }
        $data['hospital_id'] = $order['hospital_id'];
        $data['office_id'] = $order['office_id'];
        $count = 0;

        foreach ($list as $key => $val) {
            $count = count($val);

        }
		$goodsObj = new m_goods();
		
        for ($i=0; $i<$count; $i++) {
            $data['goods_id'] = $list['goods_id'][$i];
            $data['quantity'] = $list['quantity'][$i];
            $goods = $goodsObj->selectOne("goods_id='{$list['goods_id'][$i]}'");
            $data['goods_name'] = $goods['name'];
            $data['spec'] = $goods['specification'];
            $data['unit'] = $goods['unit'];
            
            $itemResult = $this->selectOne("order_id = {$data['order_id']} and goods_id = '{$data['goods_id']}'");
            if ($itemResult) {
                $data['ordergoods_id'] = $itemResult['ordergoods_id'];
            }
            else {
                $data['ordergoods_id'] = NULL;
            }
            
            $rs = self::create($data);
            if (!$rs) {
                $this->setError (0, "保存数据失败" . $this->getError());
                return false;
            }
        }
        
        return true;
    }
    
    public function create($data) {
        if (!$data['order_id']) {
            $this->setError (0, "缺少订单标识");
            return false;
        }
        if (!$data['hospital_id']) {
            $this->setError (0, "缺少医院标识");
            return false;
        }
        if (!$data['office_id']) {
            $this->setError (0, "缺少科室标识");
            return false;
        }
        if (!$data['goods_id']) {
            $this->setError (0, "缺少商品标识");
            return false;
        }
        if (!$data['quantity'] && $data['quantity'] != 0.0) {
            $this->setError (0, "缺少数量");
            return false;
        }
        
        $this->set("order_id", $data['order_id']);
        $this->set("hospital_id", $data['hospital_id']);
        $this->set("office_id", $data['office_id']);
        $this->set("goods_id", $data['goods_id']);
        $this->set("quantity", $data['quantity']);
        $this->set("goods_name", $data['goods_name']);
        $this->set("spec", $data['spec']);
        $this->set("unit", $data['unit']);
        $this->set("is_valid", 1);
        
        if ($data['ordergoods_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        if ($data['ordergoods_id']) {
            $rs = $this->save($data['ordergoods_id']);
        }
        else {
            if ($data['quantity'] != 0.0) {
                $rs = $this->save(false);
            }
            else {
                return true;
            }
        }
        if ($rs) {
            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
    
}
