<?php
/**
 * 车辆管理
 * @author mol
 *
 */
class c_delivery extends base_c {

    function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			// $this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "车辆管理-" . $this->params ['head_title'];
	}

	//车辆管理首页
    function pagecaradm($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		
		$condition = '';
		$carObj = new m_car();
		
		if ($_POST) {
			$key = base_Utils::getStr($_POST['key'], 'html');
			if ($key) {
				$condition .= "(car_license like '%{$key}%')";
				$this->params['key'] = $key;
			}
		}
		
		$rs = $carObj->getCarList($condition, $page);
		$this->params['carList'] = $rs->items;
		$datadictObj = new m_datadict();
		$driverlicensetype = $datadictObj->getOrderType(base_Constant::KEY_DRIVERLICENSE_TYPE);
		$driverKey = array_column($driverlicensetype,'value');
		//找出对应的文字 替换
		foreach($this->params['carList'] as $key=>$item){
			$dKey = array_search($item['mold'],$driverKey);
			$this->params['carList'][$key]['mold'] = $driverlicensetype[$dKey]['name'];
		}
		$this->params['driverlicensetypeList'] = $driverlicensetype;
		$this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
		
		return $this->render('delivery/carindex.html', $this->params);
	}

    function pageaddcar($inPath) {
		$url = $this->getUrlParams($inPath);
		$car_id = (int)$url['cid'] > 0 ? (int)$url['cid'] : (int)$_POST['car_id'];
		
		$carObj = new m_car($car_id);
		
		if ($_POST) {
			$post = base_Utils::shtmlspecialchars($_POST);
			
			if ($carObj->create($post, "TRUE")) {
				$this->ShowMsg( "操作成功！", $this->createUrl("/delivery/caradm" ), 2, 1);
			}
			$this->ShowMsg("操作失败" . $carObj->getError());
		}
		
		$this->params['car'] = $carObj->selectOne("car_id = {$car_id}");
        $datadictObj = new m_datadict();
        $this->params['driverlicensetypeList'] = $datadictObj->getOrderType(base_Constant::KEY_DRIVERLICENSE_TYPE);
        $this->params['licensetypeList'] = $datadictObj->getOrderType(base_Constant::KEY_CARLICENSE_TYPE);
		
		return $this->render('delivery/addcar.html', $this->params);
	}
	
	function pagedelcar($inPath){
		$url = $this->getUrlParams($inPath);
		$car_id = (int)$url['cid'] > 0 ? (int)$url['cid'] : (int)$_POST['car_id'];
		$carObj = new m_car($car_id);
		if ($carObj->delete($car_id)){
			$this->ajax_res("操作成功", 0);
		}else{
			$this->ajax_res("操作失败：".$carObj->getError(), -1);
		}
	}
    //送货人列表
    function pagemanadm($inPath) {
        $url = $this->getUrlParams ( $inPath );
        $page = $url ['page'] ? ( int ) $url ['page'] : 1;
        
        $condition = '';
        $deliverymanObj = new m_deliveryman();
        
        if ($_POST) {
            $key = base_Utils::getStr($_POST['key'], 'html');
            if ($key) {
                $condition .= "(name like '%{$key}%' or mobile like '%{$key}%')";
                $this->params['key'] = $key;
            }
        }
        
        $rs = $deliverymanObj->getDeliverymanList($condition, $page);
        $this->params['deliverymanList'] = $rs->items;
        $this->params ['head_title'] = "送货员管理-配送管理";
        $this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
        return $this->render('delivery/deliverymanindex.html', $this->params);
    }
    
    function pageadddeliveryman($inPath) {
        $url = $this->getUrlParams($inPath);
        $deliveryman_id = (int)$url['did'] > 0 ? (int)$url['did'] : (int)$_POST['deliveryman_id'];
        
        $deliverymanObj = new m_deliveryman($deliveryman_id);
        
        if ($_POST) {
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if ($deliverymanObj->create($post, "TRUE")) {
                $this->ShowMsg( "操作成功！", $this->createUrl("/delivery/manadm" ), 2, 1);
            }
            $this->ShowMsg("操作失败" . $deliverymanObj->getError());
        }
        
        $weichatuserObj = new m_weichatuser();
        $this->params['weichatuserList'] = $weichatuserObj->getHospitalOptionList();

        $this->params['deliveryman'] = $deliverymanObj->selectOne("deliveryman_id = {$deliveryman_id}");
        $datadictObj = new m_datadict();
        $this->params['driverlicensetypeList'] = $datadictObj->getOrderType(base_Constant::KEY_DRIVERLICENSE_TYPE);
        
        return $this->render('delivery/adddeliveryman.html', $this->params);
    }
	/**
	 * 删除送货员
	 * @param unknown $inPath
	 */
    function pagedeldeliveryman($inPath){
    	$url = $this->getUrlParams($inPath);
    	$deliveryman_id = (int)$url['man_id'] > 0 ? (int)$url['man_id'] : (int)$_POST['deliveryman_id'];
    	$deliverymanObj = new m_deliveryman($deliveryman_id);
    	if ($deliverymanObj->delete($deliveryman_id)){
    		$this->ajax_res("操作成功", 0);
    	}else{
    		$this->ajax_res("操作失败：".$deliverymanObj->getError(), -1);
    	}
    }
    
    function pageindex($inPath) {
        $url = $this->getUrlParams ( $inPath );
        $page = $url ['page'] ? ( int ) $url ['page'] : 1;
        $status = $url ['status'] ? (int)$url ['status'] : '';

        $condition = '';
        $deliveryObj = new m_delivery();
        
        if ($_POST) {
            $key = base_Utils::getStr($_POST['key'], 'html');
            if ($key) {
                $condition .= "(car_license like '%{$key}%' or delivery_id like '%{$key}%' or  driver_name like '%{$key}%' or exists (select 1 from smpss_deliverywithgoods g where g.delivery_id=smpss_delivery.delivery_id and g.order_id like '%{$key}%'))";
                $this->params['key'] = $key;
            }
            $status = (int)$_POST['status'];
        }
        
        if ($status){
            $condition = $condition ? $condition." and status = {$status}" : "status = {$status}";
            $this->params['status'] = $status;
        }
        
		//echo $condition;
        $rs = $deliveryObj->getList($condition, $page);
		$deliveryList = $rs->items;
		if($deliveryList) {
			foreach($deliveryList as $key => $val){
				$deliverywithgoodsObj = new m_deliverywithgoods();
				$where='select a.*,c.name as sign_status_name,b.hospital_name,b.office_name,b.delivery_no,b.invoice_no,b.remark order_remark,if(a.is_for_goods=0,\'发票\',\'商品\') type,b.is_valid from smpss_deliverywithgoods a,smpss_order b,(select value,name from smpss_datadict a where a.key_id = \'1009\') c where ifnull(a.sign_status,1)=c.value and a.order_id=b.order_id and a.delivery_id='.$val['delivery_id'];
				//echo $where;
				$sub_rs = $deliverywithgoodsObj->query($where);
				$list = $sub_rs->items;
			 	if (!empty($list)) {
					$cnt = count($list);
					//echo $val['delivery_id'].':'.$cnt.'|';
					$deliveryList[$key]['deliverywithgoods'] = $list;
					$deliveryList[$key]['deliverywithgoodscnt'] = $cnt;
					
			 	}
			}
		}
	
        $this->params['deliveryList'] = $deliveryList;
        
        $datadictObj = new m_datadict();
        $this->params['deliverystatusList'] = $datadictObj->getOrderType(base_Constant::KEY_DELIVERY_STATUS);
       // echo 'aaaaaaaa'.$rs->totalSize;
        $this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
		//echo json_encode($this->params['deliveryList']);

        return $this->render('delivery/index.html', $this->params);
    }

	function pagedeliverydmanlist($inPath) {
        $url = $this->getUrlParams ( $inPath );
        $page = $url ['page'] ? ( int ) $url ['page'] : 1;
        
        $delivery_id = $url ['did'] ? $url ['did'] : '';
        $this->params['delivery_id'] = $delivery_id;
        
        $condition = "delivery_id = {$delivery_id}";

        $deliveryObj = new m_delivery();
        $delivery = $deliveryObj->selectOne("delivery_id = {$delivery_id}");

        $this->params['delivery'] = $delivery;
		//查到订单的车辆信息 再查司机
		$carObj = new m_car();		
		$carInfo = $carObj->selectOne('status=1 and car_id = '.$delivery['car_id']);
		
		$deliveryman = new m_deliveryman();
		$is_driver = $deliveryman->getDeliverymanList('is_driver=1 and isrun=0 and driverlicense_type<='.$carInfo['mold'], $page);
        $this->params['deliverymanList'] = $is_driver->items;
        $this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
        return $this->render('delivery/dmanlist.html', $this->params);
    }

    function pagedeliverymanlist($inPath) {
        $url = $this->getUrlParams ( $inPath );
        $page = $url ['page'] ? ( int ) $url ['page'] : 1;
        
        $delivery_id = $url ['did'] ? $url ['did'] : '';
        $this->params['delivery_id'] = $delivery_id;
        
        $condition = "delivery_id = {$delivery_id}";
        $deliverywithmanObj = new m_deliverywithman();
        
        $deliveryObj = new m_delivery();
        $delivery = $deliveryObj->selectOne("delivery_id = {$delivery_id}");
        $this->params['delivery_status'] = $delivery['status'];
        
        $rs = $deliverywithmanObj->getDeliverymanList($condition, $page);
        $this->params['manList'] = $rs->items;
        $this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
        return $this->render('delivery/manlist.html', $this->params);
    }

    function pagedeliverygoodslist($inPath) {
        $url = $this->getUrlParams ( $inPath );
        $page = $url ['page'] ? ( int ) $url ['page'] : 1;
        
        $delivery_id = $url ['did'] ? $url ['did'] : '';
        $status = $url ['status'] ? (int)$url ['status'] : '';
        $condition = "";
        
        if ($_POST) {
            $status = (int)$_POST['status'];
			if(empty($delivery_id)){
            	$delivery_id = $_POST['delivery_id'];
			}
			//订单列表中，查看子订单时，会跳转过来
			if(empty($order_id)){
            	$order_id = $_POST['order_id'];
			}
        }

        if ($delivery_id) {
            $condition = "delivery_id = {$delivery_id}";
            $this->params['delivery_id'] = $delivery_id;
        }

        if ($order_id) {
            $condition = "order_id = {$order_id}";
            $this->params['order_id'] = $order_id;
        }
        
        if ($status) {
            $condition = $condition ? $condition." and sign_status = {$status}" : "sign_status = {$status}";
            $this->params['status'] = $status;
        }
        
        $deliverywithgoodsObj = new m_deliverywithgoods();
        
        $deliveryObj = new m_delivery();
        $delivery = $deliveryObj->selectOne("delivery_id ={$delivery_id}");

        $this->params['delivery_status'] = $delivery['status'];
        
        $rs = $deliverywithgoodsObj->getDeliverygoodsList($condition, $page);
		$list = $rs->items;
		
		for ($i=0; $i<count($list); $i++) {
			$deliverycommit = new m_deliverycommit();
			$sql = "select level,remark evaluate_remark,weichatuser_name from smpss_evaluate where withgoods_id=".$list[$i]['withgoods_id'];
			//echo $sql;
			$evallist = $deliverycommit->query($sql);
			$evalObj = $evallist->items;
			
			$list[$i]['level'] = $evalObj[0]['level'];

			$list[$i]['evaluate_remark'] = $evalObj[0]['evaluate_remark'];
			$list[$i]['weichatuser_name'] = $evalObj[0]['weichatuser_name'];
		}
        $this->params['goodsList'] = $list;
        
        $datadictObj = new m_datadict();
        $this->params['signstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_SIGN_STATUS);
        
        $this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
        return $this->render('delivery/goodslist.html', $this->params);
    }


    function pagedeliverygoodsbo($inPath) {
        $url = $this->getUrlParams ( $inPath );
        $page = $url ['page'] ? ( int ) $url ['page'] : 1;
        
        $order_id = $url ['did'] ? $url ['did'] : '';
		
		$sql = "";
		$sql=$sql."SELECT t1.*,t2.`level`,t2.remark evaluate_remark,t2.weichatuser_name,t2.create_time evaluate_time,     ";	
		$sql=$sql."t2.evaluate_id,t3.result commit_result,t3.result_desc commit_remark,t3.user_name commit_username	      ";
		$sql=$sql."FROM (                                                                                                 ";
		$sql=$sql."  select                                                                                               ";
		$sql=$sql."	d.sign_status,d.sign_time,d.withgoods_id,d.remark,d.delivery_id ,                                     ";
		$sql=$sql."	c.order_id,c.remark order_remark,c.is_for_goods,c.goods_type  type                                     ";
		$sql=$sql."	from smpss_allorder c                                                                                 ";
		$sql=$sql."  left join                                                                                            ";
		$sql=$sql."  (                                                                                                    ";
		$sql=$sql."		select b.is_for_goods,b.sign_status,b.sign_time,b.withgoods_id,b.remark,a.delivery_id ,b.order_id   ";
		$sql=$sql."		from smpss_delivery a ,smpss_deliverywithgoods b                                                    ";
		$sql=$sql."		where a.delivery_id = b.delivery_id                                                                 ";
		$sql=$sql."	) d on c.order_id = d.order_id and c.is_for_goods = d.is_for_goods                                    ";
		$sql=$sql."  where ifnull(if(c.fid=0,c.order_id,c.fid),c.order_id) = ".$order_id."        ";
		$sql=$sql.") t1                                                                                                   ";
		$sql=$sql." left join smpss_evaluate t2 on t1.withgoods_id = t2.withgoods_id                                      ";
		$sql=$sql." left join smpss_deliverycommit  t3 on t1.withgoods_id = t3.withgoods_id                               ";


		//echo $sql;
		$this->params['order_id'] = $order_id;
		$this->params['fromorder'] = 1;				//表示从订单查询页面跳转过去的。
        $this->params['delivery_status'] = '2'; //随便填写，不是1就行
		
        //echo 'wwwwwwww'.$condition;
	  	$deliverywithgoodsObj = new m_deliverywithgoods();
        $rs = $deliverywithgoodsObj->query($sql);
        if ($rs) {
            $list = $rs->items;
            
            $orderObj = new m_order();
            $datadictObj = new m_datadict ();
            
            for ($i=0; $i<count($list); $i++) {
                //$order = $orderObj->selectOne("order_id = {$list[$i]['order_id']}");
                //$list[$i]['hospital_name'] = $order['hospital_name'];
                //$list[$i]['office_name'] = $order['office_name'];
                //$list[$i]['delivery_no'] = $order['delivery_no'];
                //$list[$i]['invoice_no'] = $order['invoice_no'];
                //$list[$i]['order_remark'] = $order['remark'];
                //$list[$i]['type'] = $list[$i]['is_for_goods'] == 0 ? '发票' : '商品';
                //$list[$i]['is_valid'] = $order['is_valid'];
                $key = base_Constant::KEY_SIGN_STATUS;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['sign_status']} and key_id = {$key}");
                $list[$i]['sign_status_name'] = $datadict['name'];

            }
            $rs->items = $list;
        }
		
        $this->params['goodsList'] = $rs->items;
        
      
				//var_dump(json_encode($this->params['goodsList']));
        $datadictObj = new m_datadict();
        $this->params['signstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_SIGN_STATUS);
        
        $this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
        return $this->render('delivery/goodslist.html', $this->params);
    }
/*	
    function pagedeliverygoodsbo($inPath) {
        $url = $this->getUrlParams ( $inPath );
        $page = $url ['page'] ? ( int ) $url ['page'] : 1;
        
        $order_id = $url ['did'] ? $url ['did'] : '';

        $sql = "SELECT t1.*,t2.`level`,t2.remark evaluate_remark,t2.weichatuser_name,t2.create_time evaluate_time,t2.evaluate_id,t3.result commit_result,t3.result_desc commit_remark,t3.user_name commit_username	 FROM (";
        $sql = $sql."	select b.* from smpss_delivery a ,smpss_deliverywithgoods b, smpss_order c";
        $sql = $sql."	where a.delivery_id = b.delivery_id and b.order_id = c.order_id ";
        $sql = $sql."	and ifnull(if(c.fid=0,c.order_id,c.fid),c.order_id) = ".$order_id;
        $sql = $sql.") t1";
		$sql = $sql." left join smpss_evaluate t2 on t1.withgoods_id = t2.withgoods_id";
		$sql = $sql." left join smpss_deliverycommit  t3 on t1.withgoods_id = t3.withgoods_id";


		//echo $sql;
		$this->params['order_id'] = $order_id;
		$this->params['fromorder'] = 1;				//表示从订单查询页面跳转过去的。
        $this->params['delivery_status'] = '2'; //随便填写，不是1就行
		
        //echo 'wwwwwwww'.$condition;
	  		$deliverywithgoodsObj = new m_deliverywithgoods();
        $rs = $deliverywithgoodsObj->query($sql);
        if ($rs) {
            $list = $rs->items;
            
            $orderObj = new m_order();
            $datadictObj = new m_datadict ();
            
            for ($i=0; $i<count($list); $i++) {
                $order = $orderObj->selectOne("order_id = {$list[$i]['order_id']}");
                $list[$i]['hospital_name'] = $order['hospital_name'];
                $list[$i]['office_name'] = $order['office_name'];
                $list[$i]['delivery_no'] = $order['delivery_no'];
                $list[$i]['invoice_no'] = $order['invoice_no'];
                $list[$i]['order_remark'] = $order['remark'];
                $list[$i]['type'] = $list[$i]['is_for_goods'] == 0 ? '发票' : '商品';
                $list[$i]['is_valid'] = $order['is_valid'];
                $key = base_Constant::KEY_SIGN_STATUS;
                $datadict = $datadictObj->selectOne("value = {$list[$i]['sign_status']} and key_id = {$key}");
                $list[$i]['sign_status_name'] = $datadict['name'];

            }
            $rs->items = $list;
        }
		
        $this->params['goodsList'] = $rs->items;
        
      
				//var_dump(json_encode($this->params['goodsList']));
        $datadictObj = new m_datadict();
        $this->params['signstatusList'] = $datadictObj->getOrderType(base_Constant::KEY_SIGN_STATUS);
        
        $this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
        return $this->render('delivery/goodslist.html', $this->params);
    }
*/

	/**
     * 修改送货单的司机
     * @param unknown $inPath
     */
    function pagechangedman($inPath){
        $url = $this->getUrlParams($inPath);
        $delivery_id = (int)$url['did'] > 0 ? (int)$url ['did'] : (int)$_POST['did'];
        $condition = "delivery_id = {$delivery_id}  and status = 1";
        $deliveryObj = new m_delivery();
        $delivery = $deliveryObj->selectOne($condition);
		if($delivery['driver_deliveryman_id'] == $_POST['dmid']){
			$this->ajax_res("您选择的司机相同。", -1);exit();
		}

		$deliverymanObj = new m_deliveryman();
		$weichatuserObj = new m_weichatuser();
		$olddeliveryman = $deliverymanObj->selectOne('deliveryman_id = '.$delivery['driver_deliveryman_id']);	
		$deliveryman = $deliverymanObj->selectOne('deliveryman_id = '.(int)$_POST['dmid'].' and isrun = 0');

		if(count($deliveryman) == 0){
			$this->ajax_res("该司机已占用，暂不能更换。", -1);exit();
		}
		$rs = $deliveryObj->changeDelivery($delivery_id,$deliveryman);
		
		if(!$rs){
			$this->ajax_res("修改司机失败。", -1);exit();
		}
		$deliverymanObj->setWithman($delivery['driver_deliveryman_id']);
		//告诉原来司机已经取消
		$weichatuser = $weichatuserObj->selectOne('weichatuser_id = '.$olddeliveryman['weichatuser_id'].' and is_valid = 1');
		$postData["token"] = base_Constant::WP_APP_TOKEN;
		$postData['did'] = $delivery_id;
		$postData['open_id'] = $weichatuser['open_id'];
		$postData['status'] = '已更换其他司机';
		$resp = base_Utils::httpPost(base_Constant::WP_CHANGE_DELIVERY_MAN_URL, urldecode(json_encode($postData)),array('Content-Type'=>'text/plain;charset=UTF-8'));

		/* 发送送货单模板消息 */
		$postData = array();
		$driver_id = $deliveryman['deliveryman_id'];
		$sql_driver = "SELECT m.deliveryman_id,u.open_id FROM smpss_deliveryman m LEFT JOIN smpss_weichatuser u ON u.weichatuser_id = m.weichatuser_id where m.deliveryman_id = {$driver_id}";
		$sql = "SELECT wm.deliveryman_id,u.open_id FROM smpss_deliverywithman wm LEFT JOIN smpss_deliveryman m ON wm.deliveryman_id = m.deliveryman_id LEFT JOIN smpss_weichatuser u ON u.weichatuser_id = m.weichatuser_id where wm.delivery_id = {$delivery_id} and wm.deliveryman_id != {$driver_id}";

		$driveruser = $deliverymanObj->query($sql_driver);
		$postUser = array();
		foreach($driveruser->items as $val){
			$pu['deliveryman_id'] = $val['deliveryman_id'];
			$pu['open_id'] = $val['open_id'];
			$deliverymanObj->setWithman($pu['deliveryman_id'],1);
			$postUser[] = $pu;
		}
		
		$postData['users'] = $postUser;
		$deliveryInfo = $deliveryObj->selectOne("delivery_id = {$delivery_id}");
		
		$key = base_Constant::KEY_DELIVERY_STATUS;
		$datadictObj = new m_datadict ();
		$datadict = $datadictObj->selectOne("value = {$deliveryInfo['status']} and key_id = {$key}");
		$deliveryInfo['status_name'] = $datadict['name'];
		
		$deliverywithgoodsObj =  new m_deliverywithgoods();
		$withgoods = $deliverywithgoodsObj->selectOne("delivery_id = {$delivery_id}");			
		$order_id = $withgoods['order_id'];
		
		$orderObj = new m_order();			
		$orderInfo = $orderObj->selectOne('order_id='.$order_id);
		
		$hospitalObj = new m_hospital();
		$hospitalInfo = $hospitalObj->selectOne("hospital_id=".$orderInfo['hospital_id']);
		
		$ordergoodsObj = new m_ordergoods();
		$goodsres = $ordergoodsObj->selectOne("order_id = ".$orderInfo['order_id']." and hospital_id = ".$orderInfo['hospital_id']);
					
		$goods_id = $goodsres['goods_id'];
		$goodsObj = new m_goods();
		$goodsInfo = $goodsObj->selectOne("goods_id = {$goods_id}");
		
		$postData["token"] = base_Constant::WP_APP_TOKEN;
		$postData['id'] = $delivery_id;
		$postData['goods_name'] = $goodsInfo['name']."等，大包装".$deliveryInfo['20l_quantity'];
		$postData['consignee'] = $orderInfo['hospital_name']."等";			
		$postData['address'] = $hospitalInfo['address']."等";		
		$postData['status'] = $deliveryInfo['status_name'];
		$resp = base_Utils::httpPost(base_Constant::WP_DELIVERY_CONFIRM_URL, urldecode(json_encode($postData)),array('Content-Type'=>'text/plain;charset=UTF-8'));
		$this->ajax_res("操作成功",1,$postData);
    }

    /**
     * 删除送货员
     * @param unknown $inPath
     */
    function pagedeletewithman($inPath){
        $url = $this->getUrlParams($inPath);
        $withman_id = (int)$url['wid'] > 0 ? (int)$url ['wid'] : (int)$_POST['withman_id'];
        
        $deliverywithmanObj = new m_deliverywithman();
        if ($deliverywithmanObj->delWithman($withman_id, "TRUE")) {
            //$this->ShowMsg("操作成功！", $this->createUrl("/order/index"), 2, 1);
            $this->ajax_res("操作成功", 0);
            exit;
        }
        $this->ajax_res("操作失败：".$deliverywithmanObj->getError(), -1);
        exit;
        //$this->ShowMsg("操作失败" . $hospitalorderObj->getError());
    }

    /**
     * 删除送货货品
     * @param unknown $inPath
     */
    function pagedeletewithgoods($inPath){
        $url = $this->getUrlParams($inPath);
        $withgoods_id = (int)$url['wid'] > 0 ? (int)$url ['wid'] : (int)$_POST['withgoods_id'];
        
        $deliverywithgoodsObj = new m_deliverywithgoods();
        if ($deliverywithgoodsObj->delWithgoods($withgoods_id, "TRUE")) {
            //$this->ShowMsg("操作成功！", $this->createUrl("/order/index"), 2, 1);
            $this->ajax_res("操作成功", 0);
            exit;
        }
        $this->ajax_res("操作失败：".$deliverywithgoodsObj->getError(), -1);
        exit;
        //$this->ShowMsg("操作失败" . $hospitalorderObj->getError());
    }
	
	/**
     * 修改送货货品
     * @param unknown $inPath
     */
    function pageeditwithgoods($inPath){
        $url = $this->getUrlParams($inPath);
		$sign_status = (string)$_POST['status'];
		$order_id = (string)$_POST['order_id'];
		$fromorder = (string)$_POST['fromorder'];
		$withgoods_id = (int)$url['wid'] > 0 ? (int)$url ['wid'] : (int)$_POST['withgoods_id'];
		
		//获得商品父订单
		$orderObj = new m_order();
		$sql = 'select a.* from smpss_order a,smpss_order b where a.order_id = ifnull(if(b.fid=0,b.order_id,b.fid),b.order_id) and   b.order_id='.$order_id;
		//echo $sql;
		$orderrs = $orderObj->query($sql);
		$order = $orderrs->items;
		$fid = $order[0]['fid'];
		if($fid==0){
			$fid=$order_id;
		}
		
		//获得当前商品配送任务
		$deliverywithgoodsObj = new m_deliverywithgoods();
		$goods = $deliverywithgoodsObj->selectOne("withgoods_id =".$withgoods_id);
		$deliveryid = $goods['delivery_id'];
		
		if($sign_status){
			$adminObj = new m_admin();
			$admin = $adminObj->selectOne("admin_id = {$_COOKIE['admin_id']}");
			
			//var_dump($order);
			//待签收
			if($sign_status==1){
				
				//配送任务变化，父订单要跟着变化
				$deliverywithgoodsObj->set("sign_status",'1');
				$deliverywithgoodsObj->set("modify_time",date ("Y-m-d H:i:s"));
				$deliverywithgoodsObj->set("remark",$_POST['remark'].'</br>修改者：'.$admin['admin_name']);
				$rs = $deliverywithgoodsObj->save($withgoods_id);
				
				//配送任务变化，父订单要跟着变化
				$deliveryObj = new m_delivery();
				$deliveryObj->set("status",'2');
				$rs = $deliveryObj->save($goods['delivery_id']);
				//修改的是商品还是发票？
				if($goods['is_for_goods']==1){
					$orderObj->set("is_goods_signed",'0');  //待签收
				}else {
					$orderObj->set("is_invoice_signed",'0');  //待签收
				}
				//将订单恢复到已签收状态
				$orderObj->set("sign_status",'1');  //待签收
				$orderObj->set("status",'3');  //待签收
				$orderObj->set("verify_time",date ("Y-m-d H:i:s"));	
				$orderObj->save($order[0]['order_id']);
	
				$orderObj->save($goods['order_id']);
				
			}elseif($sign_status>=2){  //已签收、拒签、部分签收
				$deliverywithgoodsObj = new m_deliverywithgoods();
				$info['sign_status']=$sign_status;
				$info['remark']=$_POST['remark'];
				$rs = $deliverywithgoodsObj->editWithgoods($withgoods_id,$info);
				
				//修改的是商品还是发票？
				if($goods['is_for_goods']==1){
					$orderObj->set("is_goods_signed",'1');  //待签收
				}else {
					$orderObj->set("is_invoice_signed",'1');  //待签收
				}
				//将订单恢复到已签收状态
				$orderObj->set("sign_status",$sign_status);  //代签收
				$orderObj->set("verify_time",date ("Y-m-d H:i:s"));	
				
				$orderObj->save($order[0]['order_id']);
				
				$orderObj->save($goods['order_id']);
	
				$this->releaseManAndCar($goods['delivery_id']);
			}
			$this->params['withgoods_id'] = $withgoods_id;
			$this->params['order_id'] = $order_id;
			$this->params['status'] = $info['sign_status'];
			$this->params['remark'] = $info['remark'];
			$this->params['fid'] = $fid;
			$this->params['deliveryid'] = $deliveryid;
        	return $this->render('delivery/editgoodsstatus.html', $this->params);
		}else{
			$this->params['withgoods_id'] = $withgoods_id;
			$this->params['order_id'] = $order_id;
			$this->params['fid'] = $fid;
			$this->params['deliveryid'] = $deliveryid;
        	return $this->render('delivery/editgoodsstatus.html', $this->params);
		}
    }
	//释放司机和车
	function releaseManAndCar($deliveryid){
		
		$deliverywithgoodsObj = new m_deliverywithgoods();
		//查看是否有存在未签收的配送任务
		$goods = $deliverywithgoodsObj->selectOne("delivery_id=".$deliveryid." and sign_status<=1 limit 0,1");

		if($goods){
		}else{//如果不存则，则表示都已经签收了（或者拒签了），就可以把司机和车释放掉。
			$deliveryObj = new m_delivery();
			$dilivwm = $deliveryObj->selectOne("delivery_id=".$deliveryid);
			if($dilivwm){
				$carObj = new m_car();
				$carObj->set('isrun','0');
				$carObj->save($dilivwm['car_id']);
				
				$deliverymanObj = new m_deliveryman();
				$deliverymanObj->set('isrun','0');
				$deliverymanObj->save($dilivwm['driver_deliveryman_id']);
				
				//将配送任务结束掉
				$deliveryObj->changeStatus($deliveryid,5);

			}
		}
	}
	
    /**
     * 增加送货员
     * @param unknown $inPath
     */
    function pageaddwithman($inPath){
        $url = $this->getUrlParams($inPath);
        $delivery_id = (int)$url['did'] > 0 ? (int)$url ['did'] : (int)$_POST['delivery_id'];
        
        $deliveryObj = new m_delivery($delivery_id);
        $deliverywithmanObj = new m_deliverywithman();
        
        if ($_POST) {
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if ($deliverywithmanObj->createWithman($post)) {
                $this->ShowMsg("操作成功！", $this->createUrl("/delivery/deliverymanlist-did-".$delivery_id), 2, 1);
            }
            $this->ShowMsg("操作失败" . $deliverywithmanObj->getError());            
        }
        
        $this->params['deliverymanList'] = $deliverywithmanObj->getManAllList($delivery_id);
        $this->params['delivery'] = $deliveryObj->selectOne("delivery_id = {$delivery_id}");
        
        return $this->render('delivery/addwithman.html', $this->params);
        
    }
		
	/**
     * 任务管理 - 列表
     * @param unknown $inPath
     */
	function pagehasdeliverylist($inPath) {
        $url = $this->getUrlParams($inPath);
		
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		if($is_ajax){
			$page = $_POST ['page'] ? ( int ) $_POST ['page'] : 1;
		}
		$limitsize = (int)base_Constant::PAGE_SIZE;
		$limit = ($page - 1) * $limitsize;
        
		$deliveryObj = new m_delivery();
		
		$condition = "where 1=1";
		if ($_POST) {
			$status = (int)$_POST['status'];
			if ($status) {
				$condition = $condition ? $condition." and sign_status = {$status}" : "sign_status = {$status}";
				$this->params['status'] = $status;
			}
		}else {
			$status = $url ['status'];
			if($status) {
				$condition = $condition ? $condition." and sign_status = {$status}" : "sign_status = {$status}";
				$this->params['status'] = $status;
			}
		}
		
		if (!empty($_POST['order_id'])){
			$condition .= ' and order_id='.(int)$_POST['order_id'];
			$this->params['order_id'] = $_POST['order_id'];
		}
		else{
			$this->params['order_id'] = '';
		}
		if (!empty($_POST['delivery_id']))$delivery .= ' and b.delivery_id='.(int)$_POST['delivery_id'];else $delivery = '';
		
		$sql = "select * from (select a.order_id, a.hospital_name, a.office_name, a.goods_type, a.is_for_goods, a.goods_no, a.delivery_time,
		 	b.delivery_id, b.sign_status,b.sign_time, b.remark, b.modify_time,b.create_time from (select order_id, hospital_name, office_name,
		  	'商品' goods_type,1 is_for_goods, delivery_no goods_no, delivery_time from smpss_order where is_valid = 1 and status = 3 union all select order_id,
		   	hospital_name, office_name, '发票' goods_type,0 is_for_goods, invoice_no goods_no,delivery_time from smpss_order where is_valid = 1 and status = 3 )
		    as a left join (
		    	select DISTINCT c.delivery_id,c.order_id,c.is_for_goods,c.sign_status, c.sign_time,c.modify_time,c.create_time, c.remark from smpss_deliverywithgoods c)
		     	b on a.order_id=b.order_id and a.is_for_goods = b.is_for_goods where b.delivery_id is not null {$delivery} 
		    ) unsigned_order {$condition} order by modify_time desc, create_time desc limit {$limit},{$limitsize}";

		$totalsql = "select count(*) as totalSize from (select a.order_id, a.hospital_name, a.office_name, a.goods_type, a.is_for_goods, 
			a.goods_no, a.delivery_time, b.delivery_id, b.sign_status from (select order_id, hospital_name, office_name, '商品' goods_type,
			1 is_for_goods, delivery_no goods_no, delivery_time from smpss_order where is_goods_signed = 0 and is_valid = 1 and status = 3 union all select order_id, 
			hospital_name, office_name, '发票' goods_type,0 is_for_goods, invoice_no goods_no,delivery_time from smpss_order where is_invoice_signed = 0 and is_valid = 1 and status = 3 )
			 as a left join (select DISTINCT c.delivery_id,c.order_id,c.is_for_goods,
			 c.sign_status from smpss_deliverywithgoods c) b on a.order_id=b.order_id and a.is_for_goods = b.is_for_goods where b.delivery_id is not null{$delivery}  )
			  unsigned_order {$condition} order by delivery_time, goods_type";
		
		$list = $deliveryObj->query($sql);
		$totallist = $deliveryObj->query($totalsql);
		$totalPage = $totallist->items;
		$this->params['pagebar'] = $this->PageBar($totalPage[0]['totalSize'], $limitsize, $page, $inPath);
		
		$hospitalOrderObj = new m_hospitalorder();
		$orderObj = new m_order();
		$datadictObj = new m_datadict ();
		foreach ($list->items as &$item) {
			$order = $orderObj->selectOne("order_id={$item['order_id']}");
			if($order['hospitalorder_id']) {
				$hospitalOrder = $hospitalOrderObj->selectOne("hospitalorder_id={$order['hospitalorder_id']}");
				$item['appraise'] = $hospitalOrder['appraise'];
				if($hospitalOrder['appraise']) {
					$apprase = $datadictObj->selectOne("key_id=".base_Constant::KEY_APPAISE_TYPE." and value={$hospitalOrder['appraise']}");
					$item['appraise_name'] = $apprase['name'];
					$item['appraise_comment'] = $hospitalOrder['appraise_comment'];
				}
			}
		}
		$deliveryList = $list->items;
		
		
		$dickey = base_Constant::KEY_SIGN_STATUS;
		$sign_slist = $datadictObj->select("key_id = {$dickey}");
		$this->params['sign_slist'] = $sign_slist->items;
		
		$dataList = array();
		$deliveryIds = array();
		if($deliveryList) {
			foreach($deliveryList as $key => $val){
				$curid = $val['delivery_id'];
				if(!in_array($curid ,$deliveryIds)){
					$dataList['key_'.$val['delivery_id']]['count'] = 1;
					$deliveryIds[] = $curid;
				}else{
					$dataList['key_'.$val['delivery_id']]['count'] += 1;
				}
				$dataList['key_'.$val['delivery_id']]['delivery_id'] = $val['delivery_id'];
				
				$datadict = $datadictObj->selectOne("value = '".$val['sign_status']."' and key_id = {$dickey}");
				$val['status_name'] = $datadict['name'];
				
				$dataList['key_'.$val['delivery_id']]['data'][] = $val;
			}
			$dataList = array_values($dataList);
        	$this->params['deliveryList'] = $dataList;
		}
		$this->params ['head_title'] = "任务管理-配送管理";
        return $this->render('delivery/hasdelivery.html', $this->params);
    }

	/**
     * 增加任务 表单
     * @param unknown $inPath
     */
	function pageaddhasdeliveryindex($inPath) {
		$hospitalObj = new m_hospital ();
		$this->params ['hospitalList'] = $hospitalObj->getOptionList ();
		
		$datadictObj = new m_datadict();
        $this->params['orderCompanyList'] = $datadictObj->getOrderType(base_Constant::KEY_ORDER_COMPANY);
		$weichatuserObj = new m_weichatuser();
        $this->params['weichatuserList'] = $weichatuserObj->gethasdeliveryList();
        $this->params ['head_title'] = "新增任务-任务管理";
        return $this->render('delivery/addhasdelivery.html', $this->params);
    }

	/**
     * 获得科室 
     * @param unknown $inPath
     */
	function pagegetoffice($inPath) {
		$hospital_id = (int)$_POST['hospital_id'];
		if(empty($hospital_id)){
			$this->ajax_res("缺少参数",-1,$_POST);exit;
		}
		$officeObj = new m_office();
		$condition = "delivery_id = {$delivery_id} and order_id = {$order_id} and is_for_goods = {$is_for_goods}";
		$offices = $officeObj->select('hospital_id = '.$hospital_id,'office_id,name');
		$this->ajax_res("操作成功！", 0,$offices->items);
    }

	/**
     * 增加任务 入库
     * @param unknown $inPath
     */
	function pageaddhasdelivery($inPath) {
		$post = base_Utils::shtmlspecialchars($_POST);
		$orderObj = new m_order();
		$rs = $orderObj->createTOrder($post);
		if($rs){
			$this->ShowMsg("操作成功！", $this->createUrl("/delivery/adddelivery"), 2, 1);
		}
		else{
			$this->ShowMsg("操作失败！", $this->createUrl("/delivery/adddelivery"), 2, 1);
		}
    }
	
	/**
     * 任务管理 - 设置订单为未完成
     * @param unknown $inPath
     */
	function pagehasdeliveryback($inPath) {
        $url = $this->getUrlParams($inPath);
        
		$delivery_id = $_POST['did'];//$url ['did'] ? ( int ) $url ['did'] : -1;
		$order_id = $_POST['oid'];//$url ['oid'] ? ( int ) $url ['oid'] : -1;
		$is_for_goods = $_POST['isg'];//$url['isg'] ? ( int ) $url ['isg'] : 0;
		
		
		$deliverywithgoodsObj = new m_deliverywithgoods();
		$condition = "delivery_id = {$delivery_id} and order_id = {$order_id} and is_for_goods = {$is_for_goods}";
		
		if($deliverywithgoodsObj->delete($condition)){
			$this->ajax_res("操作成功！", 0);
			//$this->ShowMsg("操作成功！", $this->createUrl("/delivery/hasdeliverylist"), 2, 1);
		}else {
			//$this->ShowMsg("操作失败:" . $deliverywithgoodsObj->getError()); 
			$this->ajax_res("操作失败：".$deliverywithgoodsObj->getError(), -1);
		}
    }


	/**
     * 任务管理 - 拆开订单并新生成拆出的订单
     * @param unknown $inPath 2017年4月10日 14:20:00
     */
	function pageexcreteorder($inPath) {
		$orderObj = new m_order();
		if(empty($_POST['id'])){
			$this->ajax_res("缺少订单ID！",0);
			exit();
		}
		if(count($_POST['details']) == 0){
			$this->ajax_res("请选择要拆分的商品！",0);
			exit();
		}
		$order = $orderObj->getOrderDetail((int)$_POST['id']);


		$order['order_id'] = NULL;
		$order['remark'] = '订单号:'.$_POST['id'].',的子订单.';
		$newOrderData = [
			'order_id'=>(int)$_POST['id'],
			'details'=>(array)$_POST['details'],
			'fid'=>(int)$_POST['id'],
		];
		if($order['fid'] != 0){
			$newOrderData['fid'] = $order['fid'];
			$order['remark'] = '订单号:'.$order['fid'].',的子订单.';
		}

		$neworder = $orderObj->excreteOrder($order,$newOrderData);
		if($neworder){
			$this->ajax_res("操作成功！",1,$neworder);exit();
		}
		else{
			$this->ajax_res("操作失败：".$orderObj->getError(), -1);
		}
    }

	
	 /**
     * 添加送货 - 选择正式单
     * @param unknown $inPath
     */
	function pageadddelivery($inPath) {
		$this->params = $this->getDelivery($inPath);
        $this->params ['head_title'] = "任务池-配送管理";
        return $this->render('delivery/adddelivery.html', $this->params);
    }
	
	//获取未分派的任务
	function getDelivery($inPath){
        $url = $this->getUrlParams($inPath);
        
		$deliveryObj = new m_delivery();
		$orderby = $_GET['orderby'];
		if(empty($orderby)){
			$orderby = "order by delivery_time, goods_type";
		}
		$sql_b = "select DISTINCT c.delivery_id,c.order_id,c.is_for_goods from smpss_deliverywithgoods c ";
		$sql_b = $sql_b." left join smpss_delivery d on c.delivery_id=d.delivery_id";
		$sql_b = $sql_b." where c.sign_status!=3 and d.status!=3";
		$sql_order_1 = "select fid,order_id, hospital_name, office_name, '商品' goods_type,1 is_for_goods, delivery_no goods_no, delivery_time, large_size_count, remark from smpss_order where is_goods_signed = 0 and is_valid = 1 and (status = 3 or status = 4)";
		$sql_order_0 = "select fid,order_id, hospital_name, office_name, '发票' goods_type,0 is_for_goods, invoice_no goods_no,delivery_time, large_size_count, remark from smpss_order where is_invoice_signed = 0 and is_valid = 1 and (status = 3 or status = 4) and (invoice_no is not NULL and invoice_no!='无' and TRIM(invoice_no)!='')";
		$sql = "select * from (select a.fid,a.order_id, a.hospital_name, a.office_name, a.goods_type, a.is_for_goods, a.goods_no, a.delivery_time, a.large_size_count, a.remark from ($sql_order_1 union all $sql_order_0) as a left join ($sql_b) b on a.order_id=b.order_id and a.is_for_goods = b.is_for_goods where b.delivery_id is null ) unsigned_order ".$orderby;
		
		//echo $sql;
		$list = $deliveryObj->query($sql);
		
		$deliveryList = $list->items;
		
		$orderObj = new m_order();
		$ordergoodsObj = new m_ordergoods();
		$deliverywithgoodsObj = new m_deliverywithgoods();
		if($deliveryList) {
			foreach($deliveryList as $key => $val){
				$deliveryList[$key]['order_details'] = [];
				//计算大包装数量
				if($val['is_for_goods'] == 1){  //假如是商品（0：发票；1：商品）
					if($val['large_size_count'] == 0){  //没有大包装
						$condition = "smpss_ordergoods.order_id = ". $val['order_id']." and smpss_goods.is_20l = 1";
						$join = array("smpss_goods"=>"smpss_goods.goods_id = smpss_ordergoods.goods_id");
						$quantityObj = $ordergoodsObj->selectOne($condition,"IFNULL(sum(smpss_ordergoods.quantity),0) as 20l_quantity_quantity","","",$join);
						//将smpss_ordergoods和smpss_goods表关联，查询大包装数量
						$deliveryList[$key]['20l_quantity_quantity'] = $quantityObj['20l_quantity_quantity'];
					}else{ 
						$deliveryList[$key]['20l_quantity_quantity'] = $val['large_size_count'];
					}
					$order_details = $ordergoodsObj->getGoodsList($val['order_id']);
					//if($val['order_id']==526){
					//	echo json_encode($order_details
					//}
					if(!empty($order_details))$deliveryList[$key]['order_details'] = $order_details->items;
				}
				//计算等待的时间
				$deliveryList[$key]['day_wait'] = $orderObj->diffBetweenTwoDays($val['delivery_time'], date('Y-m-d H:i:s'));	
				//是否拒签 deliverywithgoods.sign_status=3
				$isdeny = $deliverywithgoodsObj->select("order_id={$val['order_id']} and is_for_goods={$val['is_for_goods']} and sign_status=3");
				$deliveryList[$key]['is_deny'] = empty($isdeny->items)?false:true;
				//是否有子订单
				$issun = $orderObj->select("fid={$val['order_id']}");
				$deliveryList[$key]['is_sun'] = empty($issun->items)?false:true;
			}
			//print_r($deliveryList);
		}
        $this->params['deliveryList'] = $deliveryList;
		return $this->params;
	}

	
	 /**
     * 添加送货 - 选择正式单
     * @param unknown $inPath
     */
	function pageadddeliverynew($inPath) {
        $url = $this->getUrlParams($inPath);
        
		$deliveryObj = new m_delivery();
		$sql_b = "select DISTINCT c.delivery_id,c.order_id,c.is_for_goods from smpss_deliverywithgoods c ";
		$sql_b = $sql_b." left join smpss_delivery d on c.delivery_id=d.delivery_id";
		$sql_b = $sql_b." where c.sign_status!=3 and d.status!=3";
		$sql_order_1 = "select fid,order_id, hospital_name, office_name, '商品' goods_type,1 is_for_goods, delivery_no goods_no, delivery_time, large_size_count, remark from smpss_order where is_goods_signed = 0 and is_valid = 1 and (status = 3 or status = 4)";
		$sql_order_0 = "select fid,order_id, hospital_name, office_name, '发票' goods_type,0 is_for_goods, invoice_no goods_no,delivery_time, large_size_count, remark from smpss_order where is_invoice_signed = 0 and is_valid = 1 and (status = 3 or status = 4) and (invoice_no is not NULL and invoice_no!='无' and TRIM(invoice_no)!='')";
		$sql = "select * from (select a.fid,a.order_id, a.hospital_name, a.office_name, a.goods_type, a.is_for_goods, a.goods_no, a.delivery_time, a.large_size_count, a.remark from ($sql_order_1 union all $sql_order_0) as a left join ($sql_b) b on a.order_id=b.order_id and a.is_for_goods = b.is_for_goods where b.delivery_id is null ) unsigned_order order by delivery_time, goods_type";
		
		//echo $sql;
		$list = $deliveryObj->query($sql);
		
		$deliveryList = $list->items;
		
		$orderObj = new m_order();
		$ordergoodsObj = new m_ordergoods();
		$deliverywithgoodsObj = new m_deliverywithgoods();
		if($deliveryList) {
			foreach($deliveryList as $key => $val){
				$deliveryList[$key]['order_details'] = [];
				//计算大包装数量
				if($val['is_for_goods'] == 1){  //假如是商品（0：发票；1：商品）
					if($val['large_size_count'] == 0){  //没有大包装
						$condition = "smpss_ordergoods.order_id = ". $val['order_id']." and smpss_goods.is_20l = 1";
						$join = array("smpss_goods"=>"smpss_goods.goods_id = smpss_ordergoods.goods_id");
						$quantityObj = $ordergoodsObj->selectOne($condition,"IFNULL(sum(smpss_ordergoods.quantity),0) as 20l_quantity_quantity","","",$join);
						//将smpss_ordergoods和smpss_goods表关联，查询大包装数量
						$deliveryList[$key]['20l_quantity_quantity'] = $quantityObj['20l_quantity_quantity'];
					}else{ 
						$deliveryList[$key]['20l_quantity_quantity'] = $val['large_size_count'];
					}
					$order_details = $ordergoodsObj->getGoodsList($val['order_id']);
					if(!empty($order_details))$deliveryList[$key]['order_details'] = $order_details->items;
				}
				//计算等待的时间
				$deliveryList[$key]['day_wait'] = $orderObj->diffBetweenTwoDays($val['delivery_time'], date('Y-m-d H:i:s'));	
				//是否拒签 deliverywithgoods.sign_status=3
				$isdeny = $deliverywithgoodsObj->select("order_id={$val['order_id']} and is_for_goods={$val['is_for_goods']} and sign_status=3");
				$deliveryList[$key]['is_deny'] = empty($isdeny->items)?false:true;
				//是否有子订单
				$issun = $orderObj->select("fid={$val['order_id']}");
				$deliveryList[$key]['is_sun'] = empty($issun->items)?false:true;
			}
			//print_r($deliveryList);
		}
        $this->params['deliveryList'] = $deliveryList;
        $this->params ['head_title'] = "任务池-配送管理";
        return $this->render('delivery/adddelivery.html', $this->params);
    }
	
	/**
     * 添加送货 - 选择车辆
     * @param unknown $inPath
     */
	function pageadddeliverystep2($inPath){
		$url = $this->getUrlParams($inPath);
		
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		if($is_ajax){
			$page = $_POST ['page'] ? ( int ) $_POST ['page'] : 1;
		}
				
		$orders = $_POST['orders'] ? $_POST['orders'] : array();
		//echo json_encode($orders);
		$quantity = $_POST['quantity'] ? $_POST['quantity'] : 0;
		
		$qoids = implode(',',$orders['ids']);
		$qoids_for_goods = implode(',',$orders['is_for_goods']);
		
		$this->params['qoids'] = $qoids;
		$this->params['qoids_for_goods'] = $qoids_for_goods;
		$this->params['quantity'] = $quantity;
		
		$where = "isrun = 0 ";
		// 增加车辆是否占用
		$key = $_POST['key'] ? $_POST['key'] : "";
		if(!empty($key)){
			$where .= " and car_license like '%$key%' or model like '%$key%'";
		}
		$carObj = new m_car();		
		$res = $carObj->getCarList($where,$page);
		$this->params['carList'] = $res->items;
				
		$is_ajax = $_POST['ajax'] ? $_POST['ajax'] : "";
		
		$datadictObj = new m_datadict();
		$driverlicensetype = $datadictObj->getOrderType(base_Constant::KEY_DRIVERLICENSE_TYPE);
		$driverKey = array_column($driverlicensetype,'value');
		//找出对应的文字 替换
		foreach($this->params['carList'] as $key=>$item){
			$dKey = array_search($item['mold'],$driverKey);
			$this->params['carList'][$key]['mold'] = $driverlicensetype[$dKey]['name'];
			$this->params['carList'][$key]['moldKey'] = $item['mold'];
		}
		if($is_ajax){
			$data['dataList'] = $this->params['carList'];
			$data['pageBar']['totalSize'] = $res->totalSize;
			$data['pageBar']['pageSize'] = base_Constant::PAGE_SIZE;
			$data['pageBar']['curPage'] = $page;
			
			$this->ajax_res("success", 0,$data);
			exit;
		}
		$this->params['pagebar'] = $this->PageBar($res->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
		
        return $this->render('delivery/adddeliverycar.html', $this->params);
	}
	
	/**
     * 添加送货 - 选择司机
     * @param unknown $inPath
     */
	function pageadddeliverystep3($inPath){
		$url = $this->getUrlParams($inPath);
		
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		$mold = $_POST['mold'] ? $_POST['mold'] : 0;
		$qoids = $_POST['qoids'] ? $_POST['qoids'] : '';
		$qoids_for_goods = $_POST['qoids_for_goods'] ? $_POST['qoids_for_goods'] : '';
		$quantity = $_POST['quantity'] ? $_POST['quantity'] : 0;
		$car_id = $_POST['car_id'] ? $_POST['car_id'] : '';
		
		$carObj = new m_car();		
		$res = $carObj->getCarList('status=1 and car_id = '.$car_id,0);
		if(count($res) == 0)$this->ShowMsg("该车辆已占用。");
		$this->params['qoids'] = $qoids;
		$this->params['qoids_for_goods'] = $qoids_for_goods;
		$this->params['quantity'] = $quantity;
		$this->params['car_id'] = $car_id;
		$this->params['mold'] = $mold;
		
        return $this->render('delivery/adddeliverycarman.html', $this->params);
	}
	
	/**
     * 添加送货 - 生成送货单
     * @param unknown $inPath
     */
	function pageadddeliverydone(){
		$url = $this->getUrlParams($inPath);		
		$post = base_Utils::shtmlspecialchars($_POST);
		if(!$post['car_id'])$this->ShowMsg("请选择送货车辆。");
		$carObj = new m_car();
		$deliverymanObj = new m_deliveryman();
		$deliverywithmanObj = new m_deliverywithman();
		$deliverywithgoodsObj = new m_deliverywithgoods();
		$deliveryObj = new m_delivery();

		$res = $carObj->getCarList('isrun=0 and status=1 and car_id = '.$post['car_id'],0);
		if(count($res) == 0)$this->ShowMsg("该车辆已占用。");
		
		if(!$post['driver_deliveryman_id'])$this->ShowMsg("请选择送货人员。");	
		$res = $deliverywithmanObj->selectOne('isrun=0 and status=1 and deliveryman_id = '.$post['driver_deliveryman_id']);
		if(count($res) == 0)$this->ShowMsg("该送货人员已占用。");
		
		$delivery_id = $deliveryObj->createDelivery($post);
		if ($delivery_id) {
			$deliveryman['delivery_id'] = $delivery_id;
			$deliveryman['manlist'] = $post['deliveryman'];
			$deliverywithmanObj = new m_deliverywithman();
			if(!$deliverywithmanObj->createWithman($deliveryman)){
				$this->ShowMsg("操作失败" . $deliverywithmanObj->getError());
			}
			
			$deliverygoods['delivery_id'] = $delivery_id;
			$deliverygoods['orderlist'] = explode(',',$post['qoids']);
			$deliverygoods['is_for_goods'] = explode(',',$post['qoids_for_goods']);
			$deliverywithgoodsObj = new m_deliverywithgoods();
			if(!$deliverywithgoodsObj->createWithgoods($deliverygoods)){
				$this->ShowMsg("操作失败" . $deliverywithgoodsObj->getError());
			}
			
			/* 发送送货单模板消息 */
			$postData = array();
			$driver_id = $post['driver_deliveryman_id'];
			$sql_driver = "SELECT m.deliveryman_id,u.open_id FROM smpss_deliveryman m LEFT JOIN smpss_weichatuser u ON u.weichatuser_id = m.weichatuser_id where m.deliveryman_id = {$driver_id}";
			$sql = "SELECT wm.deliveryman_id,u.open_id FROM smpss_deliverywithman wm LEFT JOIN smpss_deliveryman m ON wm.deliveryman_id = m.deliveryman_id LEFT JOIN smpss_weichatuser u ON u.weichatuser_id = m.weichatuser_id where wm.delivery_id = {$delivery_id} and wm.deliveryman_id != {$driver_id}";

			$driveruser = $deliverymanObj->query($sql_driver);
			$withman = $deliverywithmanObj->query($sql);
			$postUser = array();
			foreach($driveruser->items as $val){
				$pu['deliveryman_id'] = $val['deliveryman_id'];
				$pu['open_id'] = $val['open_id'];
				$postUser[] = $pu;
				//设置司机送货人员为占用状态
				$deliverymanObj->setWithman($pu['deliveryman_id'],1);
			}
			foreach($withman->items as $val){
				$pu['deliveryman_id'] = $val['deliveryman_id'];
				$pu['open_id'] = $val['open_id'];
				$postUser[] = $pu;
				//设置司机送货人员为占用状态
				$deliverymanObj->setWithman($pu['deliveryman_id'],1);
			}
			$postData['users'] = $postUser;
						
			$deliveryInfo = $deliveryObj->selectOne("delivery_id = {$delivery_id}");
			
			$key = base_Constant::KEY_DELIVERY_STATUS;
			$datadictObj = new m_datadict ();
			$datadict = $datadictObj->selectOne("value = {$deliveryInfo['status']} and key_id = {$key}");
			$deliveryInfo['status_name'] = $datadict['name'];
			
			$withgoods = $deliverywithgoodsObj->selectOne("delivery_id = {$delivery_id}");			
			$order_id = $withgoods['order_id'];
			
			$orderObj = new m_order();			
			$orderInfo = $orderObj->selectOne('order_id='.$order_id);
			
			$hospitalObj = new m_hospital();
			$hospitalInfo = $hospitalObj->selectOne("hospital_id=".$orderInfo['hospital_id']);
			
			$ordergoodsObj = new m_ordergoods();
			$goodsres = $ordergoodsObj->selectOne("order_id = ".$orderInfo['order_id']." and hospital_id = ".$orderInfo['hospital_id']);
						
			$goods_id = $goodsres['goods_id'];
			$goodsObj = new m_goods();
			$goodsInfo = $goodsObj->selectOne("goods_id = {$goods_id}");
			
			
			$update_openid = "update smpss_delivery set driver_openid='".$postData['users'][0]['open_id']."' where delivery_id=".$delivery_id;
			$deliveryObj->query($update_openid);
			//echo $update_openid;
			//echo json_encode($postData);
			//echo $postData['user'][0]['open_id'];
			
			//注意如果字数太长，或者微信模板不对，也将产生消息发送不出去。
			$postData["token"] = base_Constant::WP_APP_TOKEN;
			$postData['id'] = $delivery_id;
			$postData['goods_name'] = '商品';//$goodsInfo['name']."等，大包装".$deliveryInfo['20l_quantity'];
			$postData['consignee'] = $orderInfo['hospital_name'];			
			$postData['address'] = $hospitalInfo['address'];		
			$postData['status'] = $deliveryInfo['status_name'];
			$postData['open_id'] = $postData['users'][0]['open_id'];
			
			///exit();
			//var_dump(json_encode($postData));
			$resp = base_Utils::httpPost(base_Constant::WP_DELIVERY_CONFIRM_URL, urldecode(json_encode($postData)),array('Content-Type'=>'text/plain;charset=UTF-8'));
			//修改车辆为占用状态
			$carObj->setRun($post['car_id'],1);
			$this->ShowMsg("操作成功！", $this->createUrl("/delivery/index"), 2, 1);
		}
		
		$this->ShowMsg("操作失败" . $deliveryObj->getError());  
	}
	
	/**
     * 添加送货 - 查找司机
     * @param unknown $inPath
     */
	function pagegetdriverlist(){
		$url = $this->getUrlParams($inPath);
		$page = $_POST ['page'] ? ( int ) $_POST ['page'] : 1;
		$key = $_POST['key'] ? $_POST['key'] : '';
		$mold = (int)$_POST['mold'];
		$condition = "is_driver=1 and isrun = 0";
		$condition .= $mold>0?" and driverlicense_type<=".$mold:'';
		//isrun 增加判断是否空闲
		if(!empty($key)){
			$condition .= " and (name like '%$key%' or mobile like '$key%')";	
		}
		$deliverymanObj = new m_deliveryman();		
		$res = $deliverymanObj->getDeliverymanList($condition,$page);	
		
		$data['dataList'] = $res->items;
		$data['post'] = $condition;
		$data['pageBar']['totalSize'] = $res->totalSize;
		$data['pageBar']['pageSize'] = base_Constant::PAGE_SIZE;
		$data['pageBar']['curPage'] = $page;
		
		$this->ajax_res("success", 0,$data);
		exit;
	}
	
	/**
     * 添加送货 - 查找送货员
     * @param unknown $inPath
     */
	function pagegetdeliverymanlist(){
		$url = $this->getUrlParams($inPath);		
		$page = $_POST ['page'] ? ( int ) $_POST ['page'] : 1;
		
		$condition = "isrun = 0";	
		$key = $_POST['key'] ? $_POST['key'] : '';
		if(!empty($key)){
			$condition .= " and (name like '%$key%' or mobile like '$key%')";	
		}
		$deliverymanObj = new m_deliveryman();		
		$res = $deliverymanObj->getDeliverymanList($condition,$page);	
		
		$data['dataList'] = $res->items;
		$data['pageBar']['totalSize'] = $res->totalSize;
		$data['pageBar']['pageSize'] = base_Constant::PAGE_SIZE;
		$data['pageBar']['curPage'] = $page;
		
		$this->ajax_res("success", 0,$data);
		exit;
	}
			
	/**
     * 计算大包装数量
     * @param unknown $inPath
     */
	function pagesumquantity($inPath) {
        $url = $this->getUrlParams($inPath);
		
		$oids = $_POST['oid'] ? $_POST['oid'] : array();
		
		if(empty($oids)){
			$this->ajax_res("", 0, array("quantity" => 0));
			exit;
		}
		
		$qoids = implode(",",$oids);
        
		$deliveryObj = new m_delivery();
				
		$sql = "select sum(quantity) 20l_quantity from ( select smpss_ordergoods.goods_id goods_id, smpss_ordergoods.quantity quantity, smpss_goods.is_20l is_20l from smpss_ordergoods, smpss_goods where smpss_ordergoods.goods_id = smpss_goods.goods_id and smpss_ordergoods.order_id in (".$qoids.") ) order_goods where is_20l = 1";
		
		$res = $deliveryObj->query($sql);
		
		$quantity = $res->items;
		
		if(empty($quantity)){
			$qnumber = 0;	
		}
		$qnumber = $quantity[0]['20l_quantity'];
		if(empty($qnumber)){
			$qnumber = 0;
		}
		$this->ajax_res("", 0,array("quantity" => $qnumber));
		exit;
    }
	
	/**
     * 送货单 - 添加货品
     * @param unknown $inPath
     */
	function pageaddwithgoods($inPath) {
		$this->params = $this->getDelivery($inPath);
		
		$url = $this->getUrlParams($inPath);        
		$delivery_id = $url ['did'] ? ( int ) $url ['did'] : '';
		$this->params['delivery_id'] = $delivery_id;
		$this->params['head_title'] = "任务池-配送管理";
		
		$deliveryObj = new m_delivery();
		$deliveryInfo = $deliveryObj->selectOne("delivery_id = {$delivery_id}");
		$this->params['deliveryInfo'] = $deliveryInfo;
        return $this->render('delivery/addwithgoods.html', $this->params);
    }
	/**
     * 送货单 - 删除货品 - 保存
     * @param unknown $inPath
     */
	function pageeditdeliverywithgoods(){
		$url = $this->getUrlParams($inPath);		
						
		$post = base_Utils::shtmlspecialchars($_POST);
		$delivery_id = $post['delivery_id'];
		$deliveryObj = new m_delivery();
		$deliveryInfo = $deliveryObj->selectOne("delivery_id = {$delivery_id}");
		$deliveryInfo['quantity'] = $post['quantity'];
		
		if ($deliveryObj->createDelivery($deliveryInfo)) {		
			$order_info = $post['orders'];
			$deliverygoods['delivery_id'] = $delivery_id;
			$deliverygoods['orderlist'] = $order_info['ids'];
			$deliverygoods['is_for_goods'] = $order_info['is_for_goods'];
			
			$deliverywithgoodsObj = new m_deliverywithgoods();
			if(!$deliverywithgoodsObj->createNewWithgoods($deliverygoods)){
				$this->ShowMsg("操作失败" . $deliverywithgoodsObj->getError());
			}
			
			$this->ShowMsg("操作成功！", $this->createUrl("/delivery/deliverygoodslist",array("did"=>$delivery_id)), 2, 1);
		}
		
		$this->ShowMsg("操作失败" . $deliveryObj->getError());  
	}
    /**
     * 终止送货单
     */
	function pageCancelDelivery($inPath){
		$url = $this->getUrlParams($inPath);
		$post = base_Utils::shtmlspecialchars($_POST);
		$delivery_id = (int)$url['delivery_id'] > 0 ? (int)$url['delivery_id'] : (int)$_POST['delivery_id'];
		$deliverywithmanObj = new m_deliverywithman();
		$deliverywithmans = $deliverywithmanObj->select("delivery_id = {$delivery_id}");
		$deliverywithman = $deliverywithmans->items;
		$deliveryObj = new m_delivery();
		$deliveryInfo = $deliveryObj->selectOne("delivery_id = {$delivery_id}");
		
		if($deliveryInfo['status']=='2'){
			//$this->ajax_res("操作失败：已发车，不能删除。".json_encode($deliveryInfo), -1);
			$this->ajax_res("操作失败：已发车，不能删除。", -1);
			exit;
		}
		
		//删除送货记录
		$deliverywithgoodsObj = new m_deliverywithgoods();
		$deliverywithgoodsObj->delete("delivery_id = {$delivery_id}");
		//修改人员为空闲
		$deliverymanObj = new m_deliveryman();
		foreach($deliverywithman as $item){
			$deliverymanObj->setWithman($item['deliveryman_id']);
		}
		//修改车辆为空闲
		$carObj = new m_car();
		$carObj->setRun($deliveryInfo['car_id']);
		$deliveryObj = new m_delivery($delivery_id);
		if ($deliveryObj->cancelDelivery($delivery_id,$post)){
			$this->ajax_res("操作成功", 0);
		}else{
			$this->ajax_res("操作失败：".$carObj->getError(), -1);
		}
	}
}



?>