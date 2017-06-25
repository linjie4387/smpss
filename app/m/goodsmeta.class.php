<?php
/**
 * 商品表数据模型
 * @author mol
 */
class m_goodsmeta extends base_m {

    public function primarykey() {
		return 'goods_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'goodsmeta';
	}
    
	public function relations() {
		return array();
	}

    public function getOptionList() {
        $values = $this->select("", "goods_id, name, extern_name", "", "order by goods_id");
        $values = $values->items;
        
        return $values;
    }

	public function getGoodsList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by goods_id");
        if ($rs) {
            return $rs;
        }
        else
            return array();
	}
    
    public function create($data, $with_log = NULL) {
        if (!$data['name']) {
            $this->setError (0, "缺少名称");
            return false;
        }
        /*
        $goods = $this->selectOne("name = '{$data['name']}'");
        if ($goods && $goods['goods_id'] != $data['goods_id']) {
            $this->setError (0, "名称重复" . $this->getError());
            return false;
        }
         */
        if (!$data['extern_name']) {
            $this->setError (0, "缺少外部名称");
            return false;
        }
        /*
        $goods = $this->selectOne("extern_name = '{$data['extern_name']}'");
        if ($goods && $goods['goods_id'] != $data['goods_id']) {
            $this->setError (0, "外部名称重复" . $this->getError());
            return false;
        }
         */
        if (!$data['goods_no']) {
            $this->setError (0, "缺少商品编码");
            return false;
        }
        $goods = $this->selectOne("goods_no = '{$data['goods_no']}'");
        if ($goods && $goods['goods_id'] != $data['goods_id']) {
            $this->setError (0, "商品编码重复" . $this->getError());
            return false;
        }
        if (!$data['specification']) {
            $this->setError (0, "缺少规格");
            return false;
        }
        if (!$data['unit']) {
            $this->setError (0, "缺少单位");
            return false;
        }
        
        $this->set("name", $data['name']);
        $this->set("manu", $data['manu']);
        $this->set("extern_name", $data['extern_name']);
        $this->set("goods_no", $data['goods_no']);
        $this->set("specification", $data['specification']);
		$this->set("volume", $data['volume']);
        $this->set("unit", $data['unit']);
        $this->set("category", $data['category']);
        $this->set("machine", $data['machine']);
        $this->set("is_20l", $data['is_20l']);
        $this->set("colorcode", $data['colorcode']);
        $this->set("remark", $data['remark']);
        if ($data['goods_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save($data['goods_id']);
        if ($rs) {
            if ($with_log) {
                $content = $data['goods_id'] ? "修改商品：{$data['name']}" : "新增商品：{$data['name']}";
                $logObj = base_mAPI::get("m_log");
                $logObj->create($rs, $content, 3);
            }

            return $rs;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
	
	
	public function createOne($data) {
        $this->set("name", $data['name']);
        $this->set("manu", $data['manu']);
        $this->set("extern_name", $data['extern_name']);
        $this->set("goods_no", $data['goods_no']);
        $this->set("specification", $data['specification']);
        $this->set("unit", $data['unit']);
		$this->set("volume", $data['volume']);
        $this->set("category", $data['category']);
        $this->set("machine", $data['machine']);
        $this->set("is_20l", $data['is_20l']);
        $this->set("colorcode", $data['colorcode']);
        $this->set("remark", $data['remark']);
        if ($data['goods_id']) {
            $this->set("modify_time", date('Y-m-d H:i:s'));
        }
        else {
            $this->set("create_time", date('Y-m-d H:i:s'));
        }
        $this->set("admin_id", $_COOKIE['admin_id']);
        
        $rs = $this->save(false);
       	return $rs;
    }
}
