<?php
/**
 * 下单管理
 * @author mol
 *
 */
class c_order extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "下单管理-" . $this->params ['head_title'];
	}
	
	function pageindex($inPath) {
        $url = $this->getUrlParams($inPath);
		$page = $url ['page'] ? (int)$url ['page'] : 1;
		
		$status = $url ['status'] ? (int)$url ['status'] : '';
		        
        $adminObj = new m_admin();
        $admin = $adminObj->selectOne("admin_id = {$_COOKIE['admin_id']}");

        $condition = "";
        if ($admin['order_company'] != 0) {
            $condition = "(order_company = {$admin['order_company']})";
        }
		
        $hospitalorderObj = new m_hospitalorder();
        if($_POST){
            $key = base_Utils::getStr($_POST['key'], 'html');
            if ($key) {
                $condition = $condition ? $condition." and (hospitalorder_id='{$key}' or name like '%{$key}%' or mobile like '%{$key}%' or hospital_name like '%{$key}%')" : "(hospitalorder_id='{$key}' or name like '%{$key}%' or mobile like '%{$key}%' or hospital_name like '%{$key}%')";
                $this->params['key'] = $key;
            }
            
            $status = (int)$_POST['status'];
            
            $showDel = $_POST['showDel'];
            if(!$showDel){
            	$condition = $condition ? $condition." and status != ".m_hospitalorder::ORDER_STATUS_DEL : "status != ".m_hospitalorder::ORDER_STATUS_DEL;
            	//$this->params['showDel'] = $status;
            }else {
            	$this->params['showDel'] = $showDel;
            }
            
            $is_agent = (int)$_POST['is_agent'];
            if ($is_agent) {
            	$condition = $condition ? $condition." and (is_agent={$is_agent})" : "(is_agent={$is_agent})";
            	$this->params['is_agent'] = $is_agent;
            }
            
        }else{
        	$condition = $condition ? $condition." and status != ".m_hospitalorder::ORDER_STATUS_DEL : "status != ".m_hospitalorder::ORDER_STATUS_DEL;
        }
		
		if($status){
			$condition = $condition ? $condition." and status = {$status}" : "status = {$status}";
			$this->params['status'] = $status;
		}
				
        $rs = $hospitalorderObj->getHospitalorderList($condition, $page);
        $this->params['hospitalorderList'] = $rs->items;
        
        $datadictObj = new m_datadict();
        $this->params['orderstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_ORDER_STATUS);
        
        $this->params['pagebar'] = $this->PageBar ($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);

        return $this->render('order/index.html', $this->params);
	}
    
    function pagehospitalorderdetail($inPath) {
        $url = $this->getUrlParams($inPath);
        $hospitalorder_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : (int)$_POST['hospitalorder_id'];
        
        $hospitalorderObj = new m_hospitalorder();
        $hospitalorder = $hospitalorderObj->getOrderDetail($hospitalorder_id);

        $this->params['hospitalorder'] = $hospitalorder;
        
        return $this->render('order/hospitalorderdetail.html', $this->params);
    }

    function pageorderdetail($inPath) {
        $url = $this->getUrlParams($inPath);
        $order_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : (int)$_POST['order_id'];
        
        $orderObj = new m_order();
        $order = $orderObj->getOrderDetail($order_id);
        
        $this->params['order'] = $order;
        
        return $this->render('order/orderdetail.html', $this->params);
    }
    //edit by linj
    function pagetradeindex($inPath) {
        $url = $this->getUrlParams($inPath);
        $page = $url ['page'] ? (int)$url ['page'] : 1;
        
        $status = $url ['status'] ? (int)$url ['status'] : '';
        $is_valid = $url ['is_valid'] ? (int)$url ['is_valid'] : '';
        
        $adminObj = new m_admin();
        $admin = $adminObj->selectOne("admin_id = {$_COOKIE['admin_id']}");
        
		//虚拟订单不显示出来
        $condition = " order_type<>'9' ";
		//接单公司
        if ($admin['order_company'] != 0) {
            $condition = "(order_company = {$admin['order_company']})";
        }
        //$orderObj = new m_order();
		$orderObj = new m_ordermeta();

		if(empty($condition)){
			$condition=" (ifnull(fid,0)=0) ";
		}else{
			$condition=$condition." and (ifnull(fid,0)=0) ";
		}
		
        if ($_POST) {
            $order_id = (int)$_POST['order_id'];
            $key = base_Utils::getStr($_POST['key'], 'html');
            if ($key) {
                $condition = $condition ? $condition." and (name like '%{$key}%' or mobile like '%{$key}%' or hospital_name like '%{$key}%')" : "(name like '%{$key}%' or mobile like '%{$key}%' or hospital_name like '%{$key}%')";
                $this->params['key'] = $key;
            }
            
            $status = (int)$_POST['status'];
            $is_valid = (int)$_POST['is_valid'];
        }
        
        if ($status){
            $condition = $condition ? $condition." and status = {$status}" : "status = {$status}";
            $this->params['status'] = $status;
        }
        
        if ($is_valid) {
            $condition = $condition ? $condition." and is_valid = {$is_valid}" : "is_valid = {$is_valid}";
            $this->params['is_valid'] = $is_valid;
        }
        
        if ($order_id) {
            $condition = $condition ? $condition." and order_id = {$order_id}" : "order_id = {$order_id}";
            $this->params['order_id'] = $order_id;
        }
		
        $rs = $orderObj->getOrdermetaList($condition, $page);
		$list = $rs->items;
		
		if($list) {
			$myorderObj = new m_order();
			foreach($list as $key => $val){
				if($val['status']=='1'){  //等待状态
					$sql = "select ifnull(sum(a.quantity),0) cnt from smpss_ordergoods a where  a.is_valid=1 and a.order_id = ".$val['order_id'];
					$totallist = $myorderObj->query($sql);
					$totalObj = $totallist->items;
					$list[$key]['delivery_cnt'] = 0;
					$list[$key]['ordergoods_cnt'] = $totalObj[0]['cnt'];
				}else{
					//查询是否存配送任务，包括拆分后子订单的配送任务
					$sql = "select count(*) cnt from smpss_delivery a ,smpss_deliverywithgoods b, smpss_order c where a.delivery_id = b.delivery_id and b.order_id = c.order_id and ifnull(if(c.fid=0,c.order_id,c.fid),c.order_id) =".$val['order_id'];
					$totallist = $myorderObj->query($sql);
					$totalObj = $totallist->items;
					$list[$key]['delivery_cnt'] = $totalObj[0]['cnt'];
				}
			}
		}
		
        $this->params['orderList'] = $list;
        $datadictObj = new m_datadict();
        $this->params['orderstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_TRADE_STATUS);
        $this->params['show_sub_order'] = $show_sub_order; //显示自订单的状态
        $this->params['pagebar'] = $this->PageBar ($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        //echo json_encode($this->params['orderList']);
		return $this->render('order/tradeindex.html', $this->params);
    }
    
	/**
	* 查询子订单
	
    function pagesuborderindex($inPath) {
        $url = $this->getUrlParams($inPath);
        $page = $url ['page'] ? (int)$url ['page'] : 1;
        $condition = "";
        $orderObj = new m_order();

		//echo $_GET;
        if ($_GET) {
            $orderid = (int)$_GET['order_id'];
            if ($orderid != '') {
            	$condition = "(fid = {$orderid} or order_id={$orderid})";
				
        	}
        
        
        $rs = $orderObj->getOrderList($condition, $page);
        $this->params['orderList'] = $rs->items;
        $datadictObj = new m_datadict();
        $this->params['orderstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_TRADE_STATUS);
        
        $this->params['pagebar'] = $this->PageBar ($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        //return $this->render('order/tradeindex.html', $this->params);
		//$this->ajaxReturn (json_encode($this->params),'JSON');
		echo json_encode($this->params['orderList']);
		}
    }*/
    /**
     * 确认正式订单
     */
    function pageverifytradeorder($inPath){
        $url = $this->getUrlParams($inPath);
        $order_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : (int)$_POST['order_id'];
        
        $orderObj = new m_order($order_id);
        if ($_POST) {
            $post = base_Utils::shtmlspecialchars($_POST);
            $oid = $_POST['oid'];
            $reuse = (int)$_POST['reuse'];
            
            $orderpic = array();
            
            if (!$reuse) {
                if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
                    $this->ShowMsg("操作失败" . '您还未选择文件');
                }
                
                $time = time();
                $file_name = $_FILES['file']['name'];
                $file_type = substr(strrchr($file_name, '.'), 1);
                $file_tmp_name = $_FILES['file']['tmp_name'];
                $file_url = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/order/" . $time . "_" . $_FILES['file']['name'];
                $target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/order/" . $time ."_" . $_FILES['file']['name'];
                
                if (!move_uploaded_file($file_tmp_name, $target_name)) {
                    $this->ShowMsg("操作失败" . '上传失败');
                }
                array_push($orderpic, $file_url);
            }
            else {
                $order = $orderObj->selectOne("order_id = {$oid}");
                if (!$order) {
                    $this->ShowMsg("操作失败" . '订单不存在');
                }

                $orderpicObj = new m_orderpic();
                $orderpic = $orderpicObj->getPicList($order['hospitalorder_id'], m_orderpic::PIC_TYPE_PREORDER);
            }

            $rs = $orderObj->updateOrderStatus($oid, $orderpic, true);
            if ($rs) {
                return $this->redirect('tradeindex.html', $this->params);
            } else {
                $this->ShowMsg($orderObj->getError());
            }
        }
        
        $order = $orderObj->selectOne("order_id = {$order_id}");
        $this->params['reuse'] = 1;//默认复用预订单照片
        $this->params['order'] = $order;
        
        return $this->render("order/verifytradeorder.html", $this->params);
    }
    
    /**
     * 正式订单发货
     */
    function pagedeliverytradeorder($inPath){
        $url = $this->getUrlParams($inPath);
        $order_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : (int)$_POST['order_id'];
        $orderObj = new m_order($order_id);
	 	$oid = $order_id;
        $orderpic = array();
		
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
			$time = time();
			$file_name = $_FILES['file']['name'];
			$file_type = substr(strrchr($file_name, '.'), 1);
			$file_tmp_name = $_FILES['file']['tmp_name'];
			$file_url = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/order/" . $time . "_" . $_FILES['file']['name'];
			$target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/order/" . $time ."_" . $_FILES['file']['name'];
			
			if (!move_uploaded_file($file_tmp_name, $target_name)) {
				$this->ShowMsg("操作失败" . '上传失败');
			}				
        	array_push($orderpic, $file_url);
		}
        
        $rs = $orderObj->updateOrderStatus($oid, $orderpic, true, $post);
		
        if ($rs) {
        	$post['oid'] = $oid;
        	$this->createDeliveryTask($post);
            return $this->redirect("billadmtradeorder-oid-".$order_id.".html", $this->params);
        } else {
            $this->ShowMsg($orderObj->getError());
        }
        $order = $orderObj->selectOne("order_id = {$order_id}");
        $this->params['order'] = $order;
        //return $this->redirect("tradeindex.html", $this->params);
		return $this->redirect("billadmtradeorder-oid-".$order_id.".html", $this->params);
    }
    /**
     * 新增订单配送任务
     * @param unknown $param
     */
    private function createDeliveryTask($param){
    	if(!class_exists('m_delivery_task'))return false;
    	$taskObj = new m_delivery_task();
    	//新建商品配送任务
    	if($param["delivery_no"]&&$param["delivery_no"]!="无"){
    		$data['goods_type'] = m_delivery_task::GOODS_TYPE_GOODS;
    		$data['order_id'] = $param['oid'];
    		if(!$taskObj->create($data)){
    			$this->ShowMsg($taskObj->getError());
    		}
    	}
    	//新建发票配送任务
    	if($param["invoice_no"]&&$param["invoice_no"]!="无"){
    		$data['goods_type'] = m_delivery_task::GOODS_TYPE_INVOICE;
    		$data['order_id'] = $param['oid'];
    		if(!$taskObj->create($data)){
    			$this->ShowMsg($taskObj->getError());
    		}
    	}
    }
    /**
     * 修改订单状态---已作废 
     * @param unknown $inPath
     * @return void|boolean|string|mixed
     */
    function pageaddhospitalorder($inPath) {
        $url = $this->getUrlParams($inPath);
        $hospitalorder_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : (int)$_POST['hospitalorder_id'];

        $hospitalorderObj = new m_hospitalorder($hospitalorder_id);
        
        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if ($hospitalorderObj->createHospitalorder($post, "TRUE")) {
                $this->ShowMsg("操作成功！", $this->createUrl("/order/index"), 2, 1);
            }
            $this->ShowMsg("操作失败" . $hospitalorderObj->getError());
        }
        
        $datadictObj = new m_datadict();
        $this->params['orderstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_ORDER_STATUS);
        
        $this->params['hospitalorder'] = $hospitalorderObj->selectOne("hospitalorder_id = {$hospitalorder_id}");
        
        return $this->render('order/addhospitalorder.html', $this->params);
    }
    /**
     * 新增订单
     * @param unknown $inPath
     */
    function pageAddOrder($inPath){
    	$hospitalObj = new m_hospital();
    	$list = $hospitalObj->getOptionList();
    	$this->params['hospitalList'] = $list;
    	return $this->render('order/addorder.html', $this->params);
    }
    /**
     * 保存订单
     * @param unknown $inPath
     */
    function pageSaveOrder($inPath){
    	$url = $this->getUrlParams($inPath);
    	if($_POST){
    		$post = base_Utils::shtmlspecialchars($_POST);
    		$orderObj = new m_order();
    		if ($orderObj->enterOrder($post)) {
    			//新增订单配送任务
    			//$this->createDeliveryTask($post);
    			$this->ShowMsg("操作成功！", $this->createUrl("/order/tradeindex"), 2, 1);
    		}
    		$this->ShowMsg("操作失败" . $orderObj->getError());
    	}
    }
	
	/**
     * 结束订单
     * @param unknown $inPath
     */
    function pageover($inPath){
    	$url = $this->getUrlParams($inPath);
    	if($_POST){
    		$post = base_Utils::shtmlspecialchars($_POST);
    		$orderObj = new m_order();
    		if ($orderObj->overOrder($post['order_id'])) {
    			$this->ajax_res("结束订单成功!", 1);
    		}
			else $this->ajax_res($orderObj->getError(), 0);
    	}
    }
    
    /**
     * 修改订单状态
     */
    function pageupdatehospitalorder($inPath){
    	$url = $this->getUrlParams($inPath);
    	$hospitalorder_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : (int)$_POST['hospitalorder_id'];
    	
    	$hospitalorderObj = new m_hospitalorder($hospitalorder_id);
    	$weichatuserObj = new m_weichatuser();
    	if ($hospitalorderObj->updateHospitalorder($hospitalorder_id, "TRUE")) {
    		//发送模版消息
    		error_log("orderId:".$hospitalorder_id);
    		$order = $hospitalorderObj->selectOne("hospitalorder_id={$hospitalorder_id}");
    		if($order['status']!=m_hospitalorder::ORDER_STATUS_TOCONFIRM){
    			$this->ShowMsg("操作成功！", $this->createUrl("/order/index"), 2, 1);
    		}
    		$uid = $order['weichatuser_id'];
    		$user = $weichatuserObj->selectOne("weichatuser_id={$uid}");
    		$data["token"] = base_Constant::WP_APP_TOKEN;
    		$data["open_id"] = $user["open_id"];
    		$data["order_id"] = $order["hospitalorder_id"];
    		$postData = urldecode(json_encode($data));
    		error_log($postData);
    		$resp = base_Utils::httpPost(base_Constant::WP_ORDER_CONFIRM_URL, $postData,
                array('Content-Type'=>'text/plain;charset=UTF-8'));
    		error_log($resp);
    		$this->ShowMsg("操作成功！", $this->createUrl("/order/index"), 2, 1);
			//$this->ShowMsg("操作成功！", $this->createUrl("/order/hospitalorderremark-oid-".$hospitalorder_id.".html"), 2, 1);
    	}
    	$this->ShowMsg("操作失败" . $hospitalorderObj->getError());
    }
    
    /**
     * 删除订单
     * @param unknown $inPath
     */
    function pagedelhospitalorder($inPath){
    	$url = $this->getUrlParams($inPath);
    	$hospitalorder_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : (int)$_POST['hospitalorder_id'];
    	 
    	$hospitalorderObj = new m_hospitalorder($hospitalorder_id);
    	if ($hospitalorderObj->delHospitalorder($hospitalorder_id, "TRUE")) {
    		//$this->ShowMsg("操作成功！", $this->createUrl("/order/index"), 2, 1);
    		$this->ajax_res("操作成功", 0);
    		exit;
    	}
    	$this->ajax_res("操作失败：".$hospitalorderObj->getError(), -1);
    	exit;
    	//$this->ShowMsg("操作失败" . $hospitalorderObj->getError());
    }
	
	/**
     * 查看预订单图片
     * @param unknown $inPath
     */
    function pagehospitalorderprint($inPath){
    	$url = $this->getUrlParams($inPath);
    	$order_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : '';
    	
		if(empty($order_id)){
			$this->ShowMsg("获取订单信息失败");
			exit();
		}
		
    	$hospitalorderObj = new m_hospitalorder();
    	$hospitalorder = $hospitalorderObj->selectOne("hospitalorder_id = {$order_id}");
		$this->params['hospitalorder'] = $hospitalorder;
		
		$orderpicObj = new m_orderpic();
		$orderpic = $orderpicObj->select("order_id = {$order_id} and type = 1");		
		$this->params['orderpic'] = $orderpic->items;
		
		return $this->render('order/print.html', $this->params);
    }

    /**
     * 查看正式订单提交凭证
     * @param unknown $inPath
     */
    function pagetradeprint($inPath){
        $url = $this->getUrlParams($inPath);
        $order_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : '';
       
        if (empty($order_id)) {
            $this->ShowMsg("获取订单信息失败");
            exit();
        }
        
        $orderObj = new m_order();
        $order = $orderObj->selectOne("order_id = {$order_id}");
        if (!$order) {
            $this->ShowMsg("订单不存在");
            exit();
        }
        $this->params['order'] = $order;
        
        $orderpicObj = new m_orderpic();
        $orderpic = $orderpicObj->select("order_id = {$order['hospitalorder_id']} and type = 2");
        $this->params['orderpic'] = $orderpic->items;
        
        return $this->render('order/tradeprint.html', $this->params);
    }

    /**
     * 查看正式订单发货凭证
     * @param unknown $inPath
     */
    function pagedeliveryprint($inPath){
        $url = $this->getUrlParams($inPath);
        $order_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : '';
        
        if (empty($order_id)) {
            $this->ShowMsg("获取订单信息失败");
            exit();
        }
        
        $orderObj = new m_order();
        $order = $orderObj->selectOne("order_id = {$order_id}");
        if (!$order) {
            $this->ShowMsg("订单不存在");
            exit();
        }
        $this->params['order'] = $order;
        
        $orderpicObj = new m_orderpic();
        $orderpic = $orderpicObj->select("order_id = {$order['hospitalorder_id']} and type = 3");
        $this->params['orderpic'] = $orderpic->items;
        
        return $this->render('order/deliveryprint.html', $this->params);
    }

    /**
     * 预订单备注管理
     */
    function pagehospitalorderremark($inPath) {
        $url = $this->getUrlParams($inPath);
        $oid = $url['oid'];
        $orderObj = new m_hospitalorder();
        if ($_POST) {
            $oid = $_POST['oid'];
            $admin_remark = $_POST['admin_remark'];
            $rs = $orderObj->updateHospitalOrderRemark($oid, $admin_remark, true);
            if ($rs) {
                return $this->redirect('index.html', $this->params);
            } else {
                $this->ShowMsg($orderObj->getError());
            }
        }
        $hospitalorder = $orderObj->selectOne("hospitalorder_id = {$oid}");
        $this->params['hospitalorder'] = $hospitalorder;
        return $this->render ( "order/editorderremark.html", $this->params);
    }

    /**
     * 正式单录入
     */
    function pageaddrecord($inPath) {
        $url = $this->getUrlParams($inPath);
        $order_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : '';
        $readonly = (int)$url['readonly'] > 0 ? (int)$url ['readonly'] : 0;
        
        $orderObj = new m_order();
        
        if ($_POST) {
            $post = base_Utils::shtmlspecialchars($_POST);
            $order_id = $post['order_id'];
            $goodslist = $post['goodslist'];
            
            $ordergoodsObj = new m_ordergoods();
            
            if ($ordergoodsObj->setOrderGoods($order_id, $goodslist)) {
//                 $this->ShowMsg("操作成功！", $this->createUrl("/order/tradeindex"), 2, 1);
                $this->ShowMsg("操作成功！", $this->createUrl("/order/addrecord-oid-{$order_id}-readonly-{$readonly}"), 2, 1);
            }

            $this->ShowMsg("操作失败" . $ordergoodsObj->getError());
        }
        
        if(empty($order_id)){
            $this->ShowMsg("获取订单号失败");
            exit();
        }

        $order = $orderObj->selectOne("order_id = {$order_id}");
        if (!$order) {
            $this->ShowMsg("订单号不存在");
            exit();
        }
        $this->params['order'] = $order;

        $ordergoodsObj = new m_ordergoods();
        $ordergoodsList = $ordergoodsObj->getGoodsList($order_id);
        if ($readonly > 0) {
            if (!empty($ordergoodsList->items)) {
                $list = $ordergoodsList->items;
                $list_result = array();
                
                for ($i=0; $i<count($list); $i++) {
                    if ((int)($list[$i]['quantity']) > 0) {
                        array_push($list_result, $list[$i]);
                    }
                }
                $ordergoodsList->items = $list_result;
            }
        }
        $this->params['ordergoodsList'] = $ordergoodsList->items;
        
        $this->params['readonly'] = $readonly;
        
        return $this->render('order/addrecord.html', $this->params);
    }
    //订单导出
    function pageexportordergoods($inPath){
    	$url = $this->getUrlParams($inPath);
    	$order_id = (int)$url['oid'] > 0 ? (int)$url ['oid'] : '';
    	$ordergoodsObj = new m_ordergoods();
    	$ordergoodsList = $ordergoodsObj->getGoodsList($order_id);
    	
    	$exl_data = $ordergoodsList->items;
    	$excel = array ();
    	foreach ( $exl_data as $ed ) {
    		if($ed ['quantity']>0) {
	    		$e ['bar_code'] = $ed ['bar_code'];
	    		$e ['goods_sn'] = $ed ['goods_no'];
	    		$e ['depot_sn'] = "";
	    		$e ['depot_name'] = "";
	    		//$e ['goods_name'] = $ed ['name'];
	    		$e ['unit'] = $ed ['unit'];
	    		$e ['quantity'] = $ed ['quantity'] . $exl_data ['unit'];
	    		$e ['price'] = "";
	    		$e ['amount'] = "";
	    		$e ['rate'] = "";
	    		$e ['rate_price'] = "";
	    		$e ['rate_amount'] = "";
	    		$e ['remark'] = "";
	    		$e ['hint'] = "";
	    		$excel [] = $e;
    		}
    	}
    	
    	$excelObj = new m_excel ();
    	$titles = array (
    			"A:10"=>'商品条码',
    			"B:20"=>'商品编号',
    			"C:10"=>'仓库编号',
    			"D:10"=>'仓库名称',
    			"E:10"=>'单位',
    			"F:10"=>'数量',
    			"G:10"=>'单价',
    			"H:10"=>'金额',
    			"I:10"=>'税率',
    			"J:10"=>'含税单价',
    			"K:10"=>'含税金额',
    			"L:10"=>'备注',
    			"M:10"=>'提示信息'
    	);
		
		$orderObj = new m_order();
		$order = $orderObj->selectOne("order_id = {$order_id}");
		
    	$title = date("Ymd", time()).'_'.$order['hospital_name'].'_'.$order['office_name']. '_' . $order_id ;
    	$excelObj->push ( $titles, $excel, $title );
    	
    }
    
    /**
     * 正式单单据维护
     */
    function pagebilladmtradeorder($inPath) {
        $url = $this->getUrlParams($inPath);
        $oid = $url['oid'];
        $orderObj = new m_order();
        if ($_POST) {
            $post = base_Utils::shtmlspecialchars($_POST);

            $rs = $orderObj->billAdm($post, true);
            if ($rs) {
                return $this->redirect('tradeindex.html', $this->params);
            } else {
                $this->ShowMsg($orderObj->getError());
            }
        }
        $order = $orderObj->selectOne("order_id = {$oid}");
        $this->params['order'] = $order;
        return $this->render("order/billadmtrade.html", $this->params);
    }
    
    /**
     * 作废正式订单
     */
    function pageDelOrder($inPath){
    	$url = $this->getUrlParams($inPath);
    	$oid = $url['oid'];
    	$orderObj = new m_order();
		$order = $orderObj->selectOne('order_id = '.$oid.'');
    	$rs = $orderObj->delOrder($oid);
    	if ($rs) {
    		$weichatuserObj = new m_weichatuser();
    		error_log("orderId:".$oid);
    		$uid = $order['weichatuser_id'];
    		$user = $weichatuserObj->selectOne("weichatuser_id={$uid}");
    		$data["token"] = base_Constant::WP_APP_TOKEN;
    		$data["open_id"] = $user["open_id"];
    		$data["order_id"] = $order["hospitalorder_id"];
    		$postData = urldecode(json_encode($data));
    		error_log($postData);
    		$resp = base_Utils::httpPost(base_Constant::WP_ORDER_DEL_URL, $postData,array('Content-Type'=>'text/plain;charset=UTF-8'));
    		error_log($resp);
    		return $this->redirect('tradeindex.html', $this->params);
    	} else {
    		$this->ShowMsg($orderObj->getError());
    	}
    }
    
}
    ?>