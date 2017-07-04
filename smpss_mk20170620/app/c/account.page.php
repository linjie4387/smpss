<?php
/**
 * 账号管理
 * @author 齐迹  email:smpss2012@gmail.com
 *
 */
class c_account extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "账号管理-" . $this->params ['head_title'];
	}
	
	function pageindex($inPath) {
		$url = $this->getUrlParams ( $inPath );
        $page = $url ['page'] ? ( int ) $url ['page'] : 1;

		$aid = ( int ) $url ['aid'];
		$this->params ['aid'] = $aid;
		$adminObj = new m_admin ( $aid );
		if ($aid) {
			if ($_POST ['group'] > 0) {
				$post = base_Utils::shtmlspecialchars ( $_POST );
				if ($post ['pwd'])
					$adminObj->set ( "admin_pwd", md5 ( $post ['pwd'] ) );
				if ($post ['group'])
					$adminObj->set ( "gid", $post ['group'] );
                $adminObj->set ( "order_company", $post ['order_company'] );
                $adminObj->set ( "weichatuser_id", $post ['weichatuser_id'] );
				if ($adminObj->save ( $aid )) {
					$this->ShowMsg ( '修改成功', $this->createUrl ( '/account/index' ), '', '1' );
				}
				$this->ShowMsg ( '修改出错！原因：' . $adminObj->getError () );
			} else {
				$groupObj = new m_group ();
				$this->params ['group'] = $groupObj->select ()->items;
				$this->params ['account'] = $adminObj->get ();

                $datadictObj = new m_datadict();
                $this->params['orderCompanyList'] = $datadictObj->getOrderType(base_Constant::KEY_ORDER_COMPANY);
                
                $weichatuserObj = new m_weichatuser();
                $this->params['weichatuserList'] = $weichatuserObj->getHospitalOptionList();

                return $this->render ( 'account/indexshow.html', $this->params );
			}
		}

        $rs = $adminObj->getList("", $page);
        $this->params['account'] = $rs->items;
        
        $this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);

		return $this->render ( 'account/index.html', $this->params );
	}
	
	function pageaddaccount($inPath) {
		if ($_POST) {
			$adminObj = new m_admin ();
			$post = base_Utils::shtmlspecialchars ( $_POST );
			$item = array ();
			$item ["admin_name"] = $post ['admin_name'];
			$item ["admin_pwd"] = md5 ( $post ['pwd'] );
			$item ["gid"] = ( int ) $post ['group'];
			$user = $adminObj->selectOne("admin_name={$post ['admin_name']}");
			if($user) {
				$this->ShowMsg ( '添加出错，该账号已存在！');
			}
            if ((int)$post['order_company'] != 0)
                $item ["order_company"] = ( int ) $post ['order_company'];
            $item["weichatuser_id"] = $post['weichatuser_id'];
			foreach ( $item as $k => $v ) {
				if (! $v)
					$this->ShowMsg ( "字段：{$k}不能够为空" );
			}
			if ($adminObj->insert ( $item )) {
				$this->ShowMsg ( '添加成功', $this->createUrl ( '/account/index' ), '', '1' );
			}
			$this->ShowMsg ( '添加出错！原因：' . $adminObj->getError () );
		}

        $datadictObj = new m_datadict();
        $this->params['orderCompanyList'] = $datadictObj->getOrderType(base_Constant::KEY_ORDER_COMPANY);

        $weichatuserObj = new m_weichatuser();
        $this->params['weichatuserList'] = $weichatuserObj->getHospitalOptionList();

		$groupObj = new m_group ();
		$this->params ['group'] = $groupObj->select ()->items;
		return $this->render ( 'account/addaccount.html', $this->params );
	}
	
	function pagemodifypwd($inPath) {
		$admin_id = ( int ) $_COOKIE ['admin_id'];
		if ($_POST) {
			$adminObj = new m_admin ();
			$post = base_Utils::shtmlspecialchars ( $_POST );
			$resPwd = $adminObj->get ( "admin_id = {$admin_id}", 'admin_pwd' );
			if ($resPwd ['admin_pwd'] == md5 ( $post ['old_pwd'] ) and $post ['new_pwd'] == $post ['new_pwd2'] and $post ['new_pwd']) {
				$pwd = md5 ( $post ['new_pwd'] );
				$rs = $adminObj->update ( "admin_id = {$admin_id}", "admin_pwd = '{$pwd}'" );
				if ($rs) {
					$this->ShowMsg ( '修改成功', $this->createUrl ( '/account/modifypwd' ), '', 1 );
				} else {
					$this->ShowMsg ( '修改失败，请重试！错误原因：' . $adminObj->getError () );
				}
			} else {
				$this->ShowMsg ( '原密码错误或者两次新密码不一致！' );
			}
		}
		return $this->render ( 'account/modifypwd.html', $this->params );
	}
	
	/**
	 * 删除账号
	 */
	function pagedelaccount($inPath){
		if($_POST){
			$admin_id = (int)$_POST['aid'];
			$adminObj = new m_admin ();
			$rs = $adminObj->delete("admin_id={$admin_id}");
			if($rs) {
				$this->ajax_res("操作成功！",0 );
			}else{
				$this->ajax_res("操作失败:".$adminObj->getDbError(),-1 );
			}
		}
	}
}
?>