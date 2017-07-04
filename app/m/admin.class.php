<?php
/**
 * 管理员主表数据模型
 * @author 齐迹  email:smpss2012@gmail.com
 */
class m_admin extends base_m {
	public function primarykey() {
		return 'admin_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'admin';
	}
	public function relations() {
		return array ();
	}
	public function checkLogin($username, $pwd, $timeout = 7200) {
		$pwd = md5 ( $pwd );
		$rs = $this->selectOne ( "admin_name = '{$username}' and admin_pwd = '{$pwd}'" );
		if ($rs) {
			if ($this->update ( "admin_id = {$rs['admin_id']}", "lastlogintime = {$this->_time}" )) {
				$cookie ['admin_id'] = $rs ['admin_id'];
				$cookie ['admin_name'] = $rs ['admin_name'];
				$cookie ['gid'] = $rs ['gid'];
				$cookie ['lastlogintime'] = $rs ['lastlogintime'];
				$cookie ['key'] = md5 ( $rs ['admin_id'] . $rs ['admin_name'] . $rs ['lastlogintime'] . base_Constant::COOKIE_KEY );
				base_Utils::ssetcookie ( $cookie, $timeout );
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
    
    public function getList($condition = '', $page = 1) {
        $this->setCount(true);
        $this->setPage($page);
        $this->setLimit(base_Constant::PAGE_SIZE);
        
        $rs = $this->select($condition, "", "", "order by admin_id");
        if ($rs) {
            $list = $rs->items;

            $datadictObj = new m_datadict();
            $weichatuserObj = new m_weichatuser();
            $groupObj = new m_group();
            
            for ($i=0; $i<count($list); $i++) {
                $key = base_Constant::KEY_ORDER_COMPANY;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['order_company']} and key_id = {$key}");
                $list[$i]['order_company_name'] = $datadict['name'];
                
                $weichatuser = $weichatuserObj->selectOne("weichatuser_id = {$list[$i]['weichatuser_id']}");
                $list[$i]['weichatuser_name'] = $weichatuser['name'];

                $group = $groupObj->selectOne("gid = {$list[$i]['gid']}");
                $list[$i]['group_name'] = $group['group_name'];
            }
            $rs->items = $list;
            
            return $rs;
        }
        else
            return array();
    }

}