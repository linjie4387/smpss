<?php
/**
 * 日志表数据模型
 * @author mol
 */
class m_log extends base_m {
	public function primarykey() {
		return 'log_id';
	}
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'log';
	}
	public function relations() {
		return array ();
	}
    
	/**
	 * 日志
	 * @param int $object_id
	 * @param string $content
	 * @param int $type
	 */
	function create($object_id, $content, $type = 1) {
		if (!$object_id or !$content) {
			$this->setError(0, "缺少必要参数");
			return false;
		}

		$this->set("object_id", $object_id);
		$this->set("type", $type);
		$this->set("content", base_Utils::getStr($content));
		$this->set("user_id", $_COOKIE['admin_id']);
		$this->set("username", $_COOKIE['admin_name']);
		$this->set("dateymd", date("Y-m-d", $this->_time));
		$this->set("dateline", $this->_time);
        
		$res = $this->save();
		if ($res) {
			return $res;
		}

		$this->setError(0, "保存数据失败:" . $this->getError());
		return false;
	}
}
