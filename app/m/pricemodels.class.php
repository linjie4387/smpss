<?php
/**
 * @author mol
 */
class m_pricemodels extends base_m {
    
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'pricemodels';
	}
    
    
    public function create($file_name,$target_name,$file_url, $with_log = NULL) {
        if (!$file_name) {
            $this->setError (0, "缺少文件名");
            return false;
        }
        
        $this->set("file_name", $file_name);
        $this->set("target_name", $target_name);
        $this->set("file_url", $file_url);
        $this->set("upload_datetime",  date('Y-m-d H:i:s'));
		
        $rs = $this->save(false);
		//var_dump(json_encode($this));
        if ($rs) {

            return true;
        }
        
        $this->setError (0, "保存数据失败" . $this->getError());
        return false;
    }
	
	public function getList($condition = '', $page = 1) {
		$this->setCount ( true );
		$this->setPage ( $page );
		$this->setLimit ( base_Constant::PAGE_SIZE );
		
		$rs = $this->select ( $condition, "", "", "order by id desc" );
		//var_dump(json_encode($rs));
		if ($rs) {
			$list = $rs->items;
			return $list;
		} else
			return array ();
	}
}
