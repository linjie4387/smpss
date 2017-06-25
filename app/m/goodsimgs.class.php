<?php
/**
 * 上传图片模型
 * @author mol
 */
class m_goodsimgs extends base_m {
	public function primarykey() {
		return 'id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'goodsimgs';
	}
	public function relations() {
		return array();
	}
	
    public function create($data) {
    	if (!$data['goods_no']) {
            $this->setError (0, "缺少goods_no");
            return false;
        }
    	$this->set("goods_no", $data['goods_no']);
        if($data['regimg'])$this->set("regimg", $data['regimg']);
        if($data['noticeimg'])$this->set("noticeimg", $data['noticeimg']);
		if($data['labelimg'])$this->set("labelimg", $data['labelimg']);
        $this->set("create_time", date('Y-m-d H:i:s'));
        $this->set("admin_id", $_COOKIE['admin_id']);
        $rs = $this->save($data['id']);
		if($rs)return $rs;
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }

}
