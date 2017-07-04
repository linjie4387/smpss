<?php
/**
 * 微信用户管理
 * @author mol
 *
 */
class c_user extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "微信用户管理-" . $this->params ['head_title'];
	}
	
	function pagehospitalindex($inPath) {
        $url = $this->getUrlParams($inPath);
		$page = $url ['page'] ? (int)$url ['page'] : 1;
		$status = $url ['status'] ? (int)$url ['status'] : '';
        
        $condition = '(type = 1 or type=3) and is_valid = 1';
        $weichatuserObj = new m_weichatuser();

        if($_POST){
            $key = base_Utils::getStr($_POST['key'], 'html');
            $subscribe = (int)$_POST['subscribe'];
            $user_type = (int)$_POST['user_type'];
            if ($key) {
				$condition .= " and (name like '%{$key}%' or mobile like '%{$key}%' or hospital_name like '%{$key}%')";
                $this->params['key'] = $key;
            }
            if($subscribe){
            	$condition .= " and (subscribe={$subscribe})";
            	$this->params['subscribe'] = $subscribe;
            }
            if($user_type){
            	$condition .= " and (type={$user_type})";
            	$this->params['user_type'] = $user_type;
            }
            
            $status = (int)$_POST['status'];
        }
		
		if($status){
			$condition = $condition ? $condition." and status = {$status}" : "status = {$status}";
			$this->params['status'] = $status;
		}

        $rs = $weichatuserObj->getWeichatuserList($condition, $page);
        $this->params['weichatuserList'] = $rs->items;
        
        $datadictObj = new m_datadict();
        $this->params['userstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_USER_STATUS);
        
        $this->params['pagebar'] = $this->PageBar ($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);

        return $this->render('user/hospitalindex.html', $this->params);
	}

    function pageengineerindex($inPath) {
        $url = $this->getUrlParams($inPath);
        $page = $url ['page'] ? (int)$url ['page'] : 1;
		$status = $url ['status'] ? (int)$url ['status'] : '';
        
        $condition = 'type = 2 and is_valid = 1';
        $weichatuserObj = new m_weichatuser();
        
        if($_POST){
            $key = base_Utils::getStr($_POST['key'], 'html');
            if ($key) {
                $condition .= " and (name like '%{$key}%' or mobile like '%{$key}%' or hospital_name like '%{$key}%')";
                $this->params['key'] = $key;
            }
            
            $status = (int)$_POST['status'];
            
        }
		if($status){
			$condition = $condition ? $condition." and status = {$status}" : "status = {$status}";
			$this->params['status'] = $status;
		}
        
        $rs = $weichatuserObj->getWeichatuserList($condition, $page);
        $this->params['weichatuserList'] = $rs->items;
        
        $datadictObj = new m_datadict();
        $this->params['userstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_USER_STATUS);
        
        $this->params['pagebar'] = $this->PageBar ($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
        return $this->render('user/engineerindex.html', $this->params);
    }

    function pageaddhospitaluser($inPath) {
        $url = $this->getUrlParams($inPath);
        $weichatuser_id = (int)$url['uid'] > 0 ? (int)$url ['uid'] : (int)$_POST['weichatuser_id'];

        $weichatuserObj = new m_weichatuser($weichatuser_id);
        
        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if ($weichatuserObj->createHospitalUser($post, "TRUE")) {
                $this->ShowMsg("操作成功！", $this->createUrl("/user/hospitalindex"), 2, 1);
            }
            $this->ShowMsg("操作失败" . $weichatuserObj->getError());
        }
        
        $datadictObj = new m_datadict();
        $this->params['userstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_USER_STATUS);
        $this->params['orderCompanyList'] = $datadictObj->getOrderType(base_Constant::KEY_ORDER_COMPANY);
        
        $this->params['weichatuser'] = $weichatuserObj->selectOne("weichatuser_id = {$weichatuser_id}");
        
        return $this->render('user/addhospitaluser.html', $this->params);
    }

    function pageaddengineer($inPath) {
        $url = $this->getUrlParams($inPath);
        $weichatuser_id = (int)$url['uid'] > 0 ? (int)$url ['uid'] : (int)$_POST['weichatuser_id'];
        
        $weichatuserObj = new m_weichatuser($weichatuser_id);
        
        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if ($weichatuserObj->createEngineer($post, "TRUE")) {
                $this->ShowMsg("操作成功！", $this->createUrl("/user/engineerindex"), 2, 1);
            }
            $this->ShowMsg("操作失败" . $weichatuserObj->getError());
        }
        
        $datadictObj = new m_datadict();
        $this->params['userstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_USER_STATUS);
        $this->params['userlevelList'] = $datadictObj->getOrderType(base_Constant::KEY_USER_LEVEL);
        
        $this->params['weichatuser'] = $weichatuserObj->selectOne("weichatuser_id = {$weichatuser_id}");
        
        return $this->render('user/addengineer.html', $this->params);
    }

    function pagedispatchengineer($inPath) {
        $url = $this->getUrlParams($inPath);
        $weichatuser_id = (int)$url['uid'] > 0 ? (int)$url ['uid'] : (int)$_POST['weichatuser_id'];
        
        $weichatuserObj = new m_weichatuser($weichatuser_id);
        $engineerdistrctObj = new m_engineerdistrict();
        
        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if ($engineerdistrctObj->createEngineerDistrict($post)) {
                $this->ShowMsg("操作成功！", $this->createUrl("/user/engineerindex"), 2, 1);
            }
            $this->ShowMsg("操作失败" . $engineerdistrctObj->getError());
        }
        
        $this->params['districtList'] = $engineerdistrctObj->getDistrictAllList($weichatuser_id);
        $this->params['weichatuser'] = $weichatuserObj->selectOne("weichatuser_id = {$weichatuser_id}");
        
        return $this->render('user/dispatchengineer.html', $this->params);
    }

    function pagedeleteHospitalUser($inPath) {
        $url = $this->getUrlParams($inPath);
        $weichatuser_id = (int)$url['uid'] > 0 ? (int)$url ['uid'] : (int)$_POST['weichatuser_id'];
        
        $weichatuserObj = new m_weichatuser($weichatuser_id);
        
        if ($weichatuserObj->deleteUser($weichatuser_id, "TRUE")) {
            //$this->ShowMsg("操作成功！", $this->createUrl("/user/hospitalindex"), 2, 1);
        	$this->ajax_res('操作成功',0);
        	exit();
        }
        //$this->ShowMsg("操作失败" . $weichatuserObj->getError());
        $this->ajax_res('操作失败',1);
        exit();
    }

    function pagedeleteEngineer($inPath) {
        $url = $this->getUrlParams($inPath);
        $weichatuser_id = (int)$url['uid'] > 0 ? (int)$url ['uid'] : (int)$_POST['weichatuser_id'];
        
        $weichatuserObj = new m_weichatuser($weichatuser_id);
        
        if ($weichatuserObj->deleteUser($weichatuser_id, "TRUE")) {
            //$this->ShowMsg("操作成功！", $this->createUrl("/user/engineerindex"), 2, 1);
            $this->ajax_res('操作成功',0);
            exit();
        }
        //$this->ShowMsg("操作失败" . $weichatuserObj->getError());
        $this->ajax_res('操作失败',1);
        exit();
    }
}
?>