<?php
/**
 * 系统设置
 * @author mol
 *
 */
class c_system extends base_c {
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "系统-" . $this->params ['head_title'];
	}
    
	function pageindex($inPath) {
		$this->params['system'] = $this->systemCount();
		return $this->render('system/index.html', $this->params);
	}
	
	function pagesetting($inPath) {
		$modelObj = new base_m();
		if(!$_POST){
			$this->params['system_name'] = base_Constant::DEFAULT_TITLE;
            $this->params['domain_name'] = base_Constant::DOMAIN_NAME;
			$this->params['rewrite'] = (int)base_Constant::REWRITE;
			$this->params['cookie_key'] = base_Constant::COOKIE_KEY;
			$this->params['temp_dir'] = base_Constant::TEMP_DIR;
            $this->params['safe_multiple'] = base_Constant::FORECAST_SAFE_MULTIPLE;
        }else{
			if($_POST['cleartable'] == 1) {
				$tableArr = array("device", "reagent", "district", "engineerdistrict", "hospital", "hospitalorder", "model", "office", "supplier", "weichatuser", "uploadlog", "log", "delivery");
				if(!$modelObj->clearTable($tableArr)) {
					$this->showMsg("清空数据出错！原因:".$modelObj -> getError());
				}
			}
			$constant = file_get_contents(ROOT_APP."/base/Constant.class.php");
			$system_name = base_Utils::getStr($_POST['system_name']);
			if ($system_name) {
				$constant = str_replace(base_Constant::DEFAULT_TITLE, $system_name, $constant);
			}
            $domain_name = base_Utils::getStr($_POST['domain_name']);
            if ($domain_name) {
                $constant = str_replace(base_Constant::DOMAIN_NAME, $domain_name, $constant);
            }
			$cookie_key = base_Utils::getStr($_POST['cookie_key']);
			if ($cookie_key != base_Constant::COOKIE_KEY) {
				$cookie_key = md5($cookie_key);
				$constant = str_replace(base_Constant::COOKIE_KEY, $cookie_key, $constant);
			}
            $safe_multiple = base_Utils::getStr($_POST['safe_multiple']);
            if ($safe_multiple != base_Constant::FORECAST_SAFE_MULTIPLE) {
                $constant = str_replace("const "."FORECAST_SAFE_MULTIPLE"." = ".base_Constant::FORECAST_SAFE_MULTIPLE, "const "."FORECAST_SAFE_MULTIPLE"." = ".$safe_multiple, $constant);
            }
            $rewrite = base_Utils::getStr($_POST['rewrite'], 'int');
			if ($rewrite == 1) {
				$constant = str_replace("FALSE", "TRUE", $constant);
			} else {
				$constant = str_replace("TRUE", "FALSE", $constant);
			}
			
			$logo = $_FILES['logo'];
			if($logo['size']>0){
				$logo_url = $this->uploadLogo($logo);
				if($logo_url){
					//$logo_url = str_replace("/var/websites/smpss","",$logo_url);
					$constant = str_replace(base_Constant::LOGO_DATA_DIR, $logo_url, $constant);
					//$constant = base_Constant::LOGO_DATA_DIR;
				}
			}
			$f = @fopen(ROOT_APP."/base/Constant.class.php", "w+");
			if ($f) {
				fwrite($f, $constant);
				fclose($f);
			} else {
				$this->ShowMsg("没有写权限");
			}
			$this->showMsg("修改成功",$this->createUrl("/system/setting"),2,1);
			//$this->redirect($this->createUrl("/system/setting"));
		}
		return $this->render('system/setting.html', $this->params);
	}
	
	function pagerights($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$groupObj = new m_group ();
		$gid = ( int ) $url ['gid'];
		$this->params ['gid'] = $gid;
		if (! $gid) {
			$this->params ['group'] = $groupObj->select ()->items;
			return $this->render ( 'system/rights.html', $this->params );
		} else {
			if (! $_POST) {
				if ($gid) {
					$this->params ['rights'] = $groupObj->selectOne ( "gid = {$gid}" );
					$this->params ['action'] = unserialize ( $this->params ['rights'] ['action_code'] );
					return $this->render ( 'system/rightsshow.html', $this->params );
				}
				$this->ShowMsg ( "用户组不存在！" );
			} else {
				$action_code = $this->creatRights ( $_POST );
				$groupObj->update ( "gid = {$gid}", "action_code = '{$action_code}'" );
				$cacheName = "action_code_group_" . $gid;
				$cache = SCache::getCacheEngine ( 'file' );
				$cache->init ( array ("dir" => SlightPHP::$appDir . "/cache", "depth" => 3 ) );
				$rs = $cache->del ( $cacheName );
				$this->ShowMsg ( "编辑成功！", $this->createUrl ( '/system/rights' ), '', 1 );
			}
		}
	}
	
	function pageaddrights($inPath) {
		if (! $_POST ['group_name']) {
			return $this->render ( 'system/addrights.html', $this->params );
		} else {
			$item = array ();
			$item ['group_name'] = base_Utils::shtmlspecialchars ( $_POST ['group_name'] );
			if ($item ['group_name']) {
				$groupObj = new m_group ();
				$res = $groupObj->selectOne ( "group_name='{$item['group_name']}'", 'gid' );
				if ($res)
					$this->ShowMsg ( '用户组名称已经存在！' );
				$item ['action_code'] = $this->creatRights ( $_POST );
				$rs = $groupObj->insert ( $item );
				if ($rs) {
					$this->ShowMsg ( '添加成功', $this->createUrl ( '/system/rights' ), '', 1 );
				} else {
					$this->ShowMsg ( '添加失败，请重试！错误原因：' . $groupObj->getError () );
				}
			}
			$this->ShowMsg ( '用户组名称不能够为空！' );
		}
	}
	
	function pagelog($inPath){
		$url = $this->getUrlParams($inPath);
		$page = $url ['page'] ? (int)$url['page'] : 1;
        $type = $url['type'] ? (int)$url['type'] : 2;
		$ymd = date("Y-m-d", time());
		$condi = "type = {$type}";

		if ($_POST) {
			$stime = base_Utils::getStr($_POST['stime']);
			$etime = base_Utils::getStr($_POST ['etime']);
			if ($stime) {
				$etime = $etime ? $etime : $ymd;
				$condi .= " and dateymd between '{$stime}' and '{$etime}'";
			}
		}
        
		$logObj = new m_log();
		$logObj->setCount(true);
		$logObj->setPage($page);
		$logObj->setLimit(base_Constant::PAGE_SIZE);

		$rs = $logObj->select($condi, "", "", "order by log_id desc");
		$this->params['log'] = $rs->items;
		$this->params['stime'] = $stime;
		$this->params['etime'] = $etime;
		$this->params['type'] = $type;
		$this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
		return $this->render('system/log.html', $this->params);
	}

    function pagedictsetting($inPath){
        $url = $this->getUrlParams($inPath);
        $key_id = $url['key_id'] ? (int)$url['key_id'] : base_Constant::KEY_ORDER_COMPANY;

        $datadictObj = new m_datadict();
        
        if ($_POST) {
            $post = base_Utils::shtmlspecialchars($_POST);
            $key_id = $post['key_id'];
            $list = $post['companylist'];
            
            if ($datadictObj->setDataDict($key_id, $list)) {
                $this->ShowMsg("操作成功！", $this->createUrl("/system/dictsetting"), 2, 1);
            }
            $this->ShowMsg("操作失败" . $datadictObj->getError());
        }
        
        $rs = $datadictObj->getOrderType($key_id);

        $this->params['datalist'] = $rs;
        $this->params['key_id'] = $key_id;
        
        return $this->render('system/dictsetting.html', $this->params);
    }
    
    private function creatRights($post) {
		$post = (array)base_Utils::shtmlspecialchars($post);
		$action = $menu = $btn = array();
		foreach ( $post as $key => $val ) {
			if (in_array ( $key, array ('report', 'system', 'account', 'district', 'supplier', 'hospital', 'order', 'member', 'category', 'shop', 'user', 'device', 'reagent', 'goods', 'consume', 'apply', 'purchase', 'dispatch', 'statistics', 'delivery' ) )) {
				$_temp = array ();
				foreach ( $val as $v ) {
					$vArr = explode ( ':', $v );
					if(count($vArr)==2) {
						$_temp [$vArr [1]] = $vArr [0];
						$action [] = $key . '_' . $vArr [1];
					}else if(count($vArr)==3){
						$btn["{$key}_{$vArr[1]}"] = 1;
					}
				}
				$menu [$key] = $_temp;
			}
		}
		return serialize ( array ('all' => 0, 'action' => $action, 'menu' => $menu, 'btn'=>$btn ) );
	}
	
	private function systemCount() {
		$modelObj = new base_m();

        $districtCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "district", "", "count(1) as num" )->items; //区县总数
        $arr['districtcount'] = $districtCount[0]['num'];

        $hospitalCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "hospital", "", "count(1) as num" )->items; //医院总数
        $arr['hospitalcount'] = $hospitalCount[0]['num'];

        $officeCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "office", "", "count(1) as num" )->items; //科室总数
        $arr['officecount'] = $officeCount[0]['num'];

        $supplierCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "supplier", "", "count(1) as num" )->items; //供应商总数
        $arr['suppliercount'] = $supplierCount[0]['num'];

        $modelCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "model", "", "count(1) as num" )->items; //型号总数
        $arr['modelcount'] = $modelCount[0]['num'];

        $weichatCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "weichatuser", "type = 1", "count(1) as num" )->items; //医院微信用户总数
        $arr['weichatusercount_hospital'] = $weichatCount[0]['num'];

        $weichatCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "weichatuser", "type = 2", "count(1) as num" )->items; //工程部微信用户总数
        $arr['weichatusercount_engineer'] = $weichatCount[0]['num'];
		
		$preweichatCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "weichatuser", "(type = 1 or type=3) and status = 1 and is_valid = 1", "count(1) as num" )->items; //待审核医院微信用户总数
        $arr['preweichatusercount_hospital'] = $preweichatCount[0]['num'];

        $preWeichatCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "weichatuser", "type = 2 and status = 1 and is_valid = 1", "count(1) as num" )->items; //待审核工程部微信用户总数
        $arr['preweichatusercount_engineer'] = $preWeichatCount[0]['num'];

        $orderCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "hospitalorder", "", "count(1) as num" )->items; //订单总数
        $arr['ordercount'] = $orderCount[0]['num'];
		
		$preOrderCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "hospitalorder", "status = 1", "count(1) as num" )->items; //待处理订单总数
        $arr['preordercount'] = $preOrderCount[0]['num'];

        $deviceCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "device", "", "count(1) as num" )->items; //仪器总数
        $arr['devicecount'] = $deviceCount[0]['num'];

        $reagentCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "reagent", "", "count(1) as num" )->items; //试剂总数
        $arr['reagentcount'] = $reagentCount[0]['num'];
        
        return $arr;
	}
	/**
	 * 首页提示
	 */
	public function pagereminder($inPath){
		$modelObj = new base_m();
		$preweichatCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "weichatuser", "(type = 1 or type=3) and status = 1 and is_valid = 1", "count(1) as num" )->items; //待审核医院微信用户总数
		$arr['preweichatusercount_hospital'] = $preweichatCount[0]['num'];
		
		$preWeichatCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "weichatuser", "type = 2 and status = 1 and is_valid = 1", "count(1) as num" )->items; //待审核工程部微信用户总数
		$arr['preweichatusercount_engineer'] = $preWeichatCount[0]['num'];
		
		$preOrderCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "hospitalorder", "status = 1", "count(1) as num" )->items; //待处理订单总数
		$arr['preordercount'] = $preOrderCount[0]['num'];

        $tradeOrderCount = $modelObj->_db->select(base_Constant::TABLE_PREFIX . "order", "status = 1", "count(1) as num" )->items; //正式订单总数
        $arr['tradeordercount'] = $tradeOrderCount[0]['num'];
        
		$this->ajax_res("操作成功",0,array(
                "t_count"=>$arr['tradeordercount'],
				"o_count"=>$arr['preordercount'],
				"e_count"=>$arr['preweichatusercount_engineer'],
				"h_count"=>$arr['preweichatusercount_hospital']
		));
	}
	private function uploadLogo($logo) {
		$path = ROOT_APP . base_Constant::UPLOAD_DATA_DIR."/logo/";
		if(!is_dir($path)){
			mkdir($path);
		}
		
		$str = "";
		//上传后的文件名
		$name = 'logo'.strrchr ( $logo ['name'], '.' );
		$uploadfile = $path.$name;//上传后的文件名地址
		$tempname = $logo ['tmp_name']; 
		$result = move_uploaded_file($tempname,$uploadfile);
		if($result){
			return $uploadfile;
		}else{
			return false;
		}
	}
	
	
	/**
	 * 删除用户组
	 */
	function pagedelgroup($inPath){
		if($_POST){
			$gid = (int)$_POST['gid'];
			$adminObj = new m_admin ();
			$admin = $adminObj->selectOne("gid={$gid}");
			if($admin){
				$this->ajax_res("操作失败：请先删除该角色下的所有成员。",-1 );
				exit();
			}
			$groupObj = new m_group();
			$rs = $groupObj->delete("gid={$gid}");
			if($rs) {
				$this->ajax_res("操作成功！",0 );
			}else{
				$this->ajax_res("操作失败:".$adminObj->getDbError(),-1 );
			}
		}
	}
}
?>