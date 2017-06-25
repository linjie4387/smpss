<?php
/**
 * 区县管理
 * @author mol
 *
 */
class c_district extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "区县管理-" . $this->params ['head_title'];
	}
	
	function pageindex($inPath) {
        $url = $this->getUrlParams($inPath);
		$page = $url['page'] ? (int)$url['page'] : 1;
        
        $condition = '';
        $districtObj = new m_district();

        if($_POST){
            $key = base_Utils::getStr($_POST['key'], 'html');
            if ($key) {
                $condition .= "(name like '%{$key}%')";
                $this->params['key'] = $key;
            }
        }

        $rs = $districtObj->getDistrictList($condition, $page);
        $this->params['districtList'] = $rs->items;
        
        $this->params['pagebar'] = $this->PageBar ($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);

        return $this->render ('district/index.html', $this->params);
	}
    
    function pageadddistrict($inPath) {
        $url = $this->getUrlParams($inPath);
        $district_id = (int)$url['did'] > 0 ? (int)$url ['did'] : (int)$_POST['district_id'];

        $districtObj = new m_district($district_id);
        
        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if ($districtObj->create($post, "TRUE")) {
                $this->ShowMsg("操作成功！", $this->createUrl("/district/adddistrict"), 2, 1);
            }
            $this->ShowMsg("操作失败" . $districtObj->getError());
        }
        
        $this->params['district'] = $districtObj->selectOne("district_id = {$district_id}");
        
        return $this->render('district/adddistrict.html', $this->params);
    }

}
?>