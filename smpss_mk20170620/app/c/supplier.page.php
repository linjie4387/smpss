<?php
/**
 * 供应商管理
 * @author mol
 *
 */
class c_supplier extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "供应商管理-" . $this->params ['head_title'];
	}
	
	function pageindex($inPath) {
        $url = $this->getUrlParams($inPath);
		$page = $url ['page'] ? (int)$url ['page'] : 1;
        
        $condition = '';
        $supplierObj = new m_supplier();

        if($_POST){
            $key = base_Utils::getStr($_POST['key'], 'html');
            if ($key) {
                $condition = "(code like '%{$key}%')";
                $this->params['key'] = $key;
            }
        }

        $rs = $supplierObj->getSupplierList($condition, $page);
        $this->params['supplierList'] = $rs->items;
        
        $this->params['pagebar'] = $this->PageBar ($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);

        return $this->render ('supplier/index.html', $this->params);
	}
    
    function pageaddsupplier($inPath) {
        $url = $this->getUrlParams($inPath);
        $supplier_id = (int)$url['sid'] > 0 ? (int)$url ['sid'] : (int)$_POST['supplier_id'];

        $supplierObj = new m_supplier($supplier_id);
        
        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if ($supplierObj->create($post, "TRUE")) {
                $this->ShowMsg("操作成功！", $this->createUrl("/supplier/addsupplier"), 2, 1);
            }
            $this->ShowMsg("操作失败" . $supplierObj->getError());
        }
        
        $this->params['supplier'] = $supplierObj->selectOne("supplier_id = {$supplier_id}");
        
        return $this->render('supplier/addsupplier.html', $this->params);
    }

    function pagemodelindex($inPath) {
        $url = $this->getUrlParams($inPath);
        $page = $url['page'] ? (int)$url['page'] : 1;
        $supplier_id = (int)$url['sid'] > 0 ? (int)$url ['sid'] : (int)$_POST['supplier_id'];
        
        $condition = '';
        
        if ($_POST) {
        }
        
        if ($supplier_id) {
            $condition = $condition ? $condition." and supplier_id = {$supplier_id}" : "supplier_id = {$supplier_id}";
            $this->params['supplier_id'] = $supplier_id;
        }
        
        $modelObj = new m_model();
        $rs = $modelObj->getModelList($condition, $page);
        $this->params['modelList'] = $rs->items;
        
        $supplierObj = new m_supplier();
        $this->params['supplierList'] = $supplierObj->getOptionList();
        
        $this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
        return $this->render('supplier/modelindex.html', $this->params);
    }

    function pageaddmodel($inPath) {
        $url = $this->getUrlParams($inPath);
        $model_id = (int)$url['mid'] > 0 ? (int)$url ['mid'] : (int)$_POST['model_id'];
        $supplier_id = (int)$url['sid'] > 0 ? (int)$url ['sid'] : (int)$_POST['supplier_id'];
        
        $modelObj = new m_model($model_id);
        
        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if ($modelObj->create($post, "TRUE")) {
                $this->ShowMsg("操作成功！", $this->createUrl("/supplier/addmodel"), 2, 1);
            }
            $this->ShowMsg("操作失败" . $modelObj->getError());
        }
        
        $supplierObj = new m_supplier();
        $this->params['supplierList'] = $supplierObj->getOptionList();
        
        $model = $modelObj->selectOne("model_id = {$model_id}");
        $this->params['model'] = $model;
        if ($model['supplier_id']) {
            $supplier_id = $model['supplier_id'];
        }
        $this->params['supplier_id'] = $supplier_id;
        
        return $this->render('supplier/addmodel.html', $this->params);
    }

}
?>