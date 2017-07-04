<?php
/**
 * 上载日志数据模型
 * @author mol
 */
class m_uploadlog extends base_m {
	//文件类型-仪器文件
	const FILE_TYPE_DEVICE = 1;
	//文件类型-试剂文件
	const FILE_TYPE_REAGENT = 2;

	public function primarykey() {
		return 'uploadlog_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'uploadlog';
	}
	public function relations() {
		return array();
	}
	
	public function getUploadlogList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "", "", "order by uploadlog_id desc");
        if ($rs) {
            $list = $rs->items;
            
            $adminObj = new m_admin();
            
            for ($i=0; $i<count($list); $i++) {
                if ($list[$i]['is_loaded'] == '0')
                    $list[$i]['is_loaded_name'] = '未加载';
                else
                    $list[$i]['is_loaded_name'] = '已加载';
                $admin = $adminObj->selectOne("admin_id = {$list[$i]['upload_admin_id']}");
                $list[$i]['admin_name'] = $admin['admin_name'];
            }
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}

    public function createUploadlog($file_name, $file_path, $file_url, $file_type=1) {
        if (!$file_name) {
            $this->setError (0, "缺少文件名");
            return false;
        }
        if (!$file_path) {
            $this->setError (0, "缺少文件路径");
            return false;
        }
        if (!$file_url) {
            $this->setError (0, "缺少文件地址");
            return false;
        }

        $this->set("file_name", $file_name);
        $this->set("file_path", $file_path);
        $this->set("file_url", $file_url);
        $this->set("file_type", $file_type);
        $this->set("upload_time", date('Y-m-d H:i:s'));
        $this->set("upload_admin_id", $_COOKIE['admin_id']);
        $this->set("is_loaded", '1');
        $this->set("load_time", date('Y-m-d H:i:s'));
        
        $rs = $this->save($data['uploadlog_id']);
        if ($rs)
            return $rs;
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }

}
