<?php
/**
 * 门店管理
 * @author mol
 *
 */
class c_shop extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "门店管理-" . $this->params ['head_title'];
	}
	
	function pageindex($inPath) {
		$page = $url ['page'] ? (int)$url ['page'] : 1;

        $shopObj = new m_shop();
        $shopObj->setCount (true);
        $shopObj->setPage ($page);
        $shopObj->setLimit (base_Constant::PAGE_SIZE);
        $rs = $shopObj->select("", "", "", "order by create_time");
        $this->params['shops'] = $rs->items;
        $this->params['pagebar'] = $this->PageBar ($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        return $this->render ('shop/index.html', $this->params);
	}
    
    function pageaddshop($inPath) {
        $url = $this->getUrlParams($inPath);
        $shop_id = (int) $url ['sid'] > 0 ? ( int ) $url ['sid'] : ( int ) $_POST ['shop_id'];
        $shopObj = new m_shop($shop_id);
        
        if($_POST){
            $post = base_Utils::shtmlspecialchars ( $_POST );
            
            if ($shopObj->create ( $post )) {
                $this->ShowMsg ( "操作成功！", $this->createUrl ( "/shop/addshop" ), 2, 1 );
            }
            $this->ShowMsg ( "操作失败" . $shopObj->getError () );
        }
        
        $this->params['shop'] = $shopObj->selectOne("shop_id={$shop_id}");
        return $this->render ( 'shop/addshop.html', $this->params );
    }

}
?>