<?php
/**
 * 医院管理
 * @author mol
 *
 */

require_once dirname(__FILE__) . '/../base/PHPExcel/IOFactory.php';

class c_hospital extends base_c {
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			// $this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "医院管理-" . $this->params ['head_title'];
	}
	function pageindex($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		
		$condition = '';
		$hospitalObj = new m_hospital ();
		
		if ($_POST) {
			$key = base_Utils::getStr ( $_POST ['key'], 'html' );
			if ($key) {
				$condition .= "(name like '%{$key}%' or code like '%{$key}%')";
				$this->params ['key'] = $key;
			}
			
			$district_id = ( int ) $_POST ['district_id'];
			if ($district_id) {
				$condition = $condition ? $condition . " and district_id = {$district_id}" : "district_id = {$district_id}";
				$this->params ['district_id'] = $district_id;
			}
		}
		
		$rs = $hospitalObj->getHospitalList ( $condition, $page );
		$this->params ['hospitalList'] = $rs->items;
		
		$districtObj = new m_district ();
		$this->params ['districtList'] = $districtObj->getOptionList ();
		
		$this->params ['pagebar'] = $this->PageBar ( $rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath );
		
		return $this->render ( 'hospital/index.html', $this->params );
	}
	function pageofficeindex($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		$hospital_id = ( int ) $url ['hid'] > 0 ? ( int ) $url ['hid'] : ( int ) $_POST ['hospital_id'];
		
		$condition = '';
		
		if ($_POST) {
			$key = base_Utils::getStr ( $_POST ['key'] );
			if ($key) {
				$condition .= "(hospital_name like '%{$key}%' or name like '%{$key}%')";
				$this->params ['key'] = $key;
			}
			
			$product = $_POST['product'];
			if($product) {
				if($product[0]==1){
					$having = "goods_count>0";
				}else if($product[0]==2){
					$having = "goods_count=0";
				}
			}
		}
		
		if ($hospital_id) {
			$condition = $condition ? $condition . " and hospital_id = {$hospital_id}" : "hospital_id = {$hospital_id}";
			$this->params ['hospital_id'] = $hospital_id;
		}
		
		$officeObj = new m_office ();
		$officegoodsObj = new m_officegoods();
		$rs = $officeObj->getOfficeListAndGoods ( $condition, $page, $having );
		foreach ($rs->items as &$office) {
			$officeGoods = $officegoodsObj->select("office_id={$office['office_id']}");
			if(!empty($officeGoods->items)) {
				$office['hasGoods'] = 1;
			}else {
				$office['hasGoods'] = 0;
			}
		}
		$this->params ['officeList'] = $rs->items;
		
		$hospitalObj = new m_hospital ();
		$this->params ['hospitalList'] = $hospitalObj->getOptionList ();
		
		$this->params ['pagebar'] = $this->PageBar ( $rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath );
		if($product){
			$this->params['product'] = $product[0];
		}else{
			$this->params['product'] = 0;
		}
		return $this->render ( 'hospital/officeindex.html', $this->params );
	}
	function pageaddhospital($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$hospital_id = ( int ) $url ['hid'] > 0 ? ( int ) $url ['hid'] : ( int ) $_POST ['hospital_id'];
		
		$hospitalObj = new m_hospital ( $hospital_id );
		
		if ($_POST) {
			$post = base_Utils::shtmlspecialchars ( $_POST );
			
			if ($hospitalObj->create ( $post, "TRUE" )) {
				$this->ShowMsg ( "操作成功！", $this->createUrl ( "/hospital/addhospital" ), 2, 1 );
			}
			$this->ShowMsg ( "操作失败" . $hospitalObj->getError () );
		}
		
		$districtObj = new m_district ();
		$this->params ['districtList'] = $districtObj->getOptionList ();
		
		$this->params ['hospital'] = $hospitalObj->selectOne ( "hospital_id = {$hospital_id}" );
		
		return $this->render ( 'hospital/addhospital.html', $this->params );
	}
	//增加科室信息
	function pageaddoffice($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$office_id = ( int ) $url ['oid'] > 0 ? ( int ) $url ['oid'] : ( int ) $_POST ['office_id'];
		$hospital_id = ( int ) $url ['hid'] > 0 ? ( int ) $url ['hid'] : ( int ) $_POST ['hospital_id'];
		
		$officeObj = new m_office ( $office_id );
		
		if ($_POST) {
			$post = base_Utils::shtmlspecialchars ( $_POST );
			if ($officeObj->create ( $post, "TRUE" )) {
				$this->ShowMsg ( "操作成功！", $this->createUrl ( "/hospital/addoffice" ), 2, 1 );
			}
			$this->ShowMsg ( "操作失败" . $officeObj->getError () );
		}
		
		$hospitalObj = new m_hospital ();
		$this->params ['hospitalList'] = $hospitalObj->getOptionList ();
		
		$office = $officeObj->selectOne ( "office_id = {$office_id}" );
		$this->params ['office'] = $office;
		if ($office ['hospital_id']) {
			$hospital_id = $office ['hospital_id'];
		}
		$this->params ['hospital_id'] = $hospital_id;
		
		return $this->render ( 'hospital/addoffice.html', $this->params );
	}
	
	//导出科室商品信息excel表格
	function pageexportOfficeGoods($inPath) {
		$excel = array ();
    	$excelObj = new m_excel ();
		$goodsObj = new m_goods();
		$officeObj = new m_office();
		$officegoodsObj = new m_officegoods();
		
		$sheet['name'] = "科室商品信息_".date('Y-m-d');
		$sheet['sheet'] = array("科室信息","全量商品信息");
		$maps = '';
		if((int)$_GET['hospital_id']!= 0)$maps = 'hospital_id='.(int)$_GET['hospital_id'];
		
		$rsoffice = $officeObj->select($maps);
		$offices = $rsoffice->items;
		$exc_goods = array ();
    	foreach ( $offices as $ed ) {
    		$officegoods = $officegoodsObj->select('office_id='.$ed['office_id']);
			$e ['hospital_id'] = $ed ['hospital_id'];
			$e ['hospital_name'] = $ed ['hospital_name'];
			$e ['office_id'] = $ed ['office_id'];
			$e ['name'] = $ed ['name'];
			if(count($officegoods->items)>0){
				foreach($officegoods->items as $item){
					$goods = $goodsObj->selectOne('goods_id='.$item['goods_id']);
					$e['goods_no'] = $goods['goods_no'];
					$e['goods_name'] = $goods['name'];
					$e['goods_specification'] = $goods['specification'];
					$e['goods_unit'] = $goods['unit'];
					$e['goods_manu'] = $goods['manu'];
					$e['goods_machine'] = $goods['machine'];
					$e['goods_category'] = $goods['category'];
					$e['safe_stock'] = $item['safe_stock'];
					$e['goods_remark'] = $item['remark'];
					$exc_goods[] = $e;
				}
			}
			else{
				$e['goods_no'] = '';
				$e['goods_name'] = '';
				$e['goods_specification'] = '';
				$e['goods_unit'] = '';
				$e['goods_manu'] = '';
				$e['goods_machine'] = '';
				$e['goods_category'] = '';
				$e['safe_stock'] = '';
				$e['goods_remark'] = '';
				$exc_goods[] = $e;
			}
			
    	}
		$goods_title = array (
			"A:10"=>'医院标识',
			"B:10"=>'医院名称',
			"C:10"=>'科室标识',
			"D:10"=>'科室名称',
			"E:10"=>'商品编号',
			"F:10"=>'商品名称',
			"G:10"=>'规格',
			"H:10"=>'单位',
			"I:10"=>'厂商全名',
			"J:10"=>'适用机型',
			"K:10"=>'项目品类',
			"L:10"=>'初期安全库存',
			"M:10"=>'备注',
    	);
		$sheet['title'][] = $goods_title;
		$sheet['lists']['s0'] = $exc_goods;
		
		//全部商品列表
		$rsgoods = $goodsObj->select();
		$goods = $rsgoods->items;
		$exc_goods = array ();
    	foreach ( $goods as $ed ) {
			$goodsInfo ['goods_no'] = $ed ['goods_no'];
			$goodsInfo ['name'] = $ed ['name'];
			$goodsInfo ['specification'] = $ed ['specification'];
			$goodsInfo ['unit'] = $ed ['unit'];
			$goodsInfo ['manu'] = $ed ['manu'];
			$goodsInfo ['machine'] = $ed ['machine'];
			$goodsInfo ['category'] = $ed ['category'];
			$goodsInfo ['is_20l'] = $ed ['is_20l'];
			$goodsInfo ['volume'] = $ed ['volume'];
			$goodsInfo ['colorcode'] = $ed ['colorcode'];
			$goodsInfo ['remark'] = $ed ['remark'];
			$exc_goods[] = $goodsInfo;
    	}
		$goods_title = array (
    			"A:20"=>'商品编号',
    			"B:20"=>'商品名称',
    			"C:10"=>'规格',
    			"D:10"=>'单位',
    			"E:10"=>'厂商全名',
    			"F:10"=>'适用机型',
    			"G:10"=>'项目品类',
    			"H:10"=>'是否大包装',
    			"I:10"=>'容积',
    			"J:10"=>'色标',
    			"K:10"=>'备注'				
    	);
		$sheet['title'][] = $goods_title;
		$sheet['lists']['s1'] = $exc_goods;
		
    	$excelObj->pushmore ( $sheet );
	}


	//导入所有商品更新现有商品信息
	function pageimportOfficeGoods($inPath) {
		$url = $this->getUrlParams($inPath);
		
        if($_POST){
        	$goodsObj = new m_goods();
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
                $this->ShowMsg("操作失败" . '您还未选择文件');
            }

            $file_name = $_FILES['file']['name'];
            $file_type = substr(strrchr($file_name, '.'), 1);
            $file_tmp_name = $_FILES['file']['tmp_name'];
            $file_url = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/officegoods/" . $_FILES['file']['name'];
            $target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/officegoods/" . $_FILES['file']['name'];

            $reader = '';
            switch ($file_type) {
                case 'xlsx':
                    $reader_format = 1;
                    $reader = PHPExcel_IOFactory::createReader('Excel2007');
                    break;
                case 'xls':
                    $reader_format = 1;
                    $reader = PHPExcel_IOFactory::createReader('Excel5');
                    break;
                case 'csv':
                    $reader = PHPExcel_IOFactory::createReader('CSV');
                    break;
                default:
                    $this->ShowMsg("操作失败: " . "文件格式错误");
            }

            $PHPExcel = $reader->load($file_tmp_name);
            if (!$PHPExcel) {
                $this->ShowMsg("操作失败: " . "文件加载错误");
            }
			
            $sheet = $PHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            
            $highestColumn = $sheet->getHighestColumn();
            $highestColumnIdx = PHPExcel_Cell::columnIndexFromString($highestColumn); // 取得总列数
            if ($highestColumnIdx != 13) {
                $this->ShowMsg("操作失败: 字段数不够.".$highestColumn);
            }
            $highestColumnIdx = 13;
			//清空科室的商品信息
			$officegoodsObj = new m_officegoods();
			$hospital_ids = array();
			for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
				$data = array();
				for ($column = 0; $column < $highestColumnIdx; $column++) {
					$columnName = PHPExcel_Cell::stringFromColumnIndex($column);
					$value = (string)$sheet->getCellByColumnAndRow($column, $row)->getCalculatedValue();
					switch ($column) {
						case 0: $data['hospital_id'] = $value;  break;
						case 1: /*$data['hospital_name'] = $value; */   break;
						case 2: $data['office_id'] = $value;    break;
						case 3: /*$data['office_name'] = $value;*/    break;
						case 4: $data['goods_no'] = $value;    break;
						case 5: $data['name'] = $value;    break;
						case 6: $data['specification'] = $value;    break;
						case 7: $data['unit'] = $value;    break;
						case 8: $data['manu'] = $value;    break;
						case 9: $data['machine'] = $value;    break;
						case 10: $data['category'] = $value;    break;
						case 11: $data['safe_stock'] = $value;    break;
						case 12: $data['remark'] = $value;    break;
					}
				}
				$hospital_ids[] = $data['hospital_id'];
			}
			//先删除对应的医院商品
			foreach($hospital_ids as $item){
				if((int)$item>0)$officegoodsObj->delete('hospital_id='.$item);
			}
			
			$inrsetCount = 0;
			for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
				$data = array();
				for ($column = 0; $column < $highestColumnIdx; $column++) {
					$columnName = PHPExcel_Cell::stringFromColumnIndex($column);
					$value = (string)$sheet->getCellByColumnAndRow($column, $row)->getCalculatedValue();
					switch ($column) {
						case 0: $data['hospital_id'] = $value;  break;
						case 1: /*$data['hospital_name'] = $value; */   break;
						case 2: $data['office_id'] = $value;    break;
						case 3: /*$data['office_name'] = $value;*/    break;
						case 4: $data['goods_no'] = $value;    break;
						case 5: $data['name'] = $value;    break;
						case 6: $data['specification'] = $value;    break;
						case 7: $data['unit'] = $value;    break;
						case 8: $data['manu'] = $value;    break;
						case 9: $data['machine'] = $value;    break;
						case 10: $data['category'] = $value;    break;
						case 11: $data['safe_stock'] = $value;    break;
						case 12: $data['remark'] = $value;    break;
					}
				}
				
				
				$goods = $goodsObj->selectOne('goods_no = '.$data['goods_no']);
				if($officegoodsObj->create($data['office_id'],$goods['goods_id'],$data['remark'],$data['safe_stock']))$inrsetCount++;
			}
			$this->ajax_res ( "操作成功,共导入:".$inrsetCount.'条记录.',0);
		}else{
			$this->ajax_res ( "导入失败.",-1);	
		}
	}
	
	/**
	 * 同步工程部数据
	 *
	 * @param unknown $inPath        	
	 */
	function pagesyncdata($inPath) {
		$hospitalObj = new m_hospital ();
		$officeObj = new m_office ();
		$engineerHospitalObj = new m_engineerhospital ();
		$engineerOfficeObj = new m_engineeroffice ();
		$officeTable = $officeObj->tableName ();
		$hospitalTable = $hospitalObj->tableName ();
		$engineerOfficeTable = $engineerOfficeObj->tableName ();
		$engineerHospitalTable = $engineerHospitalObj->tableName ();
		// 工程部医院
		$listHospital = $engineerHospitalObj->select ();
		foreach ( $listHospital->items as &$hos ) {
			$mapHospital ["{$hos['hospital_id']}"] = $hos;
		}
		$listOffice = $engineerOfficeObj->select ();
		foreach ( $listOffice->items as $office ) {
			$mapHospital ["{$office['hospital_id']}"] ["officelist"] [] = $office;
		}
		
		// 总导入医院及科室数量
		$hospitalCount = count ( $listHospital->items );
		$officeCount = count ( $listOffice->items );
		// 重复数量
		$existHospitalCount = 0;
		$existOfficeCount = 0;
		// 导入失败
		$errHospitalCount = 0;
		$errOfficeCount = 0;
		// 新增导入数量
		$successHospitalCount = 0;
		$successOfficeCount = 0;
		// 不一致数据
		$noMatch = array ();
		
		foreach ( $mapHospital as $hospital ) {
			$code = $hospital ['code'];
			$target = $hospitalObj->selectOne ( "code='{$code}'" );
			if ($target) { // 已存在,则忽略
				$existsHospital [] = $hospital;
				if ($target ['name'] == $hospital ['name']) {
					$existHospitalCount = $existHospitalCount + 1;
				} else {
					$noMatch [] = array (
							"code" => $code,
							"hospital_name" => $target ['name'],
							"engineer_name" => $hospital ['name'] 
					);
				}
				// 检查科室是否有变更
				$hospitalOffice = $hospital ['officelist'];
				foreach ( $hospitalOffice as $office ) {
					$officeName = $office ['name'];
					$data = $officeObj->selectOne ( "hospital_id={$target['hospital_id']} and name='{$officeName}'" );
					if ($data) { // 科室已存在
						$existOfficeCount = $existOfficeCount + 1;
					} else { // 不存在，则新增
						$office ['office_id'] = false;
						$office ['hospital_id'] = $target ['hospital_id'];
						$officeId = $officeObj->create ( $office );
						if (! $officeId) {
							$errOfficeCount = $errOfficeCount + 1;
						} else {
							$successOfficeCount = $successOfficeCount + 1;
						}
					}
				}
			} else { // 不存在的则添加
				$hospital ['hospital_id'] = false;
				// $engineerHospitalObj->setPkid(null);
				$rs = $hospitalObj->create ( $hospital );
				if (! $rs) { // 添加失败数+1
					$errHospitalCount = $errHospitalCount + 1;
				} else {
					$successHospitalCount = $successHospitalCount + 1;
					// 添加科室
					$hospitalOffice = $hospital ['officelist'];
					foreach ( $hospitalOffice as $office ) {
						$office ['office_id'] = false;
						$office ['hospital_id'] = $rs;
						$officeId = $officeObj->create ( $office );
						if (! $officeId) {
							$errOfficeCount = $errOfficeCount + 1;
						} else {
							$successOfficeCount = $successOfficeCount + 1;
						}
					}
				}
			}
		}
		/**
		 * $this->params[''] = $hospitalCount;
		 * $this->params[''] = $officeCount;
		 * $this->params[''] = $existHospitalCount;
		 * $this->params[''] = $existOfficeCount;
		 * $this->params[''] = $errHospitalCount;
		 * $this->params[''] = $errOfficeCount;
		 * $this->params[''] = $successHospitalCount;
		 * $this->params[''] = $successOfficeCount;
		 */
		$this->params ['info'] = sprintf ( "共%d个医院信息，%d个科室信息；其中导入成功%d个医院、%d个科室；失败%d个医院、%d个科室；数据一致的医院%d个，不一致的医院%d个。", $hospitalCount, $officeCount, $successHospitalCount, $successOfficeCount, $errHospitalCount, $errOfficeCount, $existHospitalCount, count ( $noMatch ) );
		$this->params ["result_list"] = $noMatch;
		return $this->render ( 'hospital/sync_result.html', $this->params );
	}
	
	/**
	 * 添加科室商品
	 * 
	 * @param unknown $inPath        	
	 */
	function pageAddOfficeGoods($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		$key = $url ['key'] ? $url ['key'] : $_POST ['key'];
		$manu = $url ['manu'] ? $url ['manu'] : $_POST ['manu'];
		$category = $url ['category'] ? $url ['category'] : $_POST ['category'];
		
		$office_id = ( int ) $url ['oid'] > 0 ? ( int ) $url ['oid'] : ( int ) $_POST ['office_id'];
		$order_id = ( int ) $url ['orderid'] > 0 ? ( int ) $url ['orderid'] : ( int ) $_POST ['order_id'];
		$officeObj = new m_office ( $office_id );
		$office = $officeObj->selectOne ( "office_id = {$office_id}" );
		if (! $office) {
			$this->ShowMsg ( "科室不存在" );
		}
		$goodsObj = new m_goods ();
		$where = "";
		if ($key) {
			$where = "(name like '%{$key}%' or extern_name like '%{$key}%' or goods_no like '%{$key}%' or remark like '%{$key}%')";;
			$this->params ['key'] = $key;
		}
		if($category) {
			if(strlen($where)>0){
				$where = $where . " and category like '%{$category}%'";
			}else {
				$where = "category like '%{$category}%'";
			}
			$this->params ['category'] = $category;
		}
		if($manu) {
			if(strlen($where)>0){
				$where = $where . " and manu like '%{$manu}%'";
			}else {
				$where = "manu like '%{$manu}%'";
			}
			$this->params ['manu'] = $manu;
		}
		$rs = $goodsObj->getGoodsList ( $where, $page );
		$this->params ['goodsList'] = $rs->items;
		$this->params ['office'] = $office;
		$this->params ['pagebar'] = $this->PageBar ( $rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath, "style2" );
		return $this->render ( 'hospital/addofficegoods.html', $this->params );
	}
	/**
	 * 设置科室商品：可通过科室管理进行设置，或在医院正式订单管理中进行设置
	 * 
	 * @param unknown $inPath        	
	 */
	function pagesetofficegoods($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$office_id = ( int ) $url ['oid'] > 0 ? ( int ) $url ['oid'] : ( int ) $_POST ['office_id'];
		$order_id = ( int ) $url ['orderid'] > 0 ? ( int ) $url ['orderid'] : ( int ) $_POST ['order_id'];
		
		$officeObj = new m_office ( $office_id );
		$office = $officeObj->selectOne ( "office_id = {$office_id}" );
		if (! $office) {
			$this->ShowMsg ( "科室不存在" );
		}
		
		$officegoodsObj = new m_officegoods ();
		// 提交
		if ($_POST) {
			$post = base_Utils::shtmlspecialchars ( $_POST );
			$officeGoodsList = $_POST ['officegoods'];
			if (! $officeGoodsList) {
				$this->ShowMsg ( "新增科室商品失败：未选择科室商品。" );
			}
			foreach ( $officeGoodsList as $goods_id ) {
				if($officegoodsObj->selectOne("office_id={$office_id} and goods_id={$goods_id}")){
					continue;
				}
				if (! $officegoodsObj->create ( $office_id, $goods_id )) {
					$this->ShowMsg ( "新增科室失败：" . $officegoodsObj );
				}
			}
			if (! $order_id)
				$this->ShowMsg ( "操作成功！", $this->createUrl ( "/hospital/setofficegoods-oid-".$office_id ), 2, 1 );
			else
				$this->ShowMsg ( "操作成功! ", $this->createUrl ( "/order/addrecord-oid-" . $order_id ), 2, 1 );
		}
		// 查询
		$this->params ['order_id'] = $order_id;
		$this->params ['office'] = $office;
		$this->params ['goodsList'] = $officegoodsObj->getGoodsList ( $office_id )->items;
		
		return $this->render ( 'hospital/setofficegoods.html', $this->params );
	}
	/**
	 * 修改科室商品备注
	 * 
	 * @param unknown $inPath        	
	 */
	public function pageModifyOfficeGoodsRemark($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$remark = $url ['remark'] ? $url ['remark'] : $_POST ['remark'];
		$office_id = ( int ) $url ['oid'] > 0 ? ( int ) $url ['oid'] : ( int ) $_POST ['office_id'];
		$goods_id = ( int ) $url ['gid'] > 0 ? ( int ) $url ['gid'] : ( int ) $_POST ['goods_id'];
		$officeGoodsObj = new m_officegoods ();
		$rs = $officeGoodsObj->modifyRemark ( $office_id, $goods_id, $remark );
		if ($rs) {
			$this->ajax_res ( "操作成功", 0 );
			exit ();
		} else {
			$this->ajax_res ( "操作失败：" . $officeGoodsObj->getError (), - 1 );
			exit ();
		}
	}
	
	/**
	 * 修改科室商品期初库存
	 *
	 * @param unknown $inPath
	 */
	public function pageModifyOfficeGoodsSafeStock($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$safe_stock = $url ['safe_stock'] ? $url ['safe_stock'] : $_POST ['safe_stock'];
		$office_id = ( int ) $url ['oid'] > 0 ? ( int ) $url ['oid'] : ( int ) $_POST ['office_id'];
		$goods_id = ( int ) $url ['gid'] > 0 ? ( int ) $url ['gid'] : ( int ) $_POST ['goods_id'];
		$officeGoodsObj = new m_officegoods ();
		$rs = $officeGoodsObj->modifySafeStock( $office_id, $goods_id, $safe_stock );
		if ($rs) {
			$this->ajax_res ( "操作成功", 0 );
			exit ();
		} else {
			$this->ajax_res ( "操作失败：" . $officeGoodsObj->getError (), - 1 );
			exit ();
		}
	}
	
	/**
	 * 删除科室商品
	 * 
	 * @param unknown $inPath        	
	 */
	public function pageDelOfficeGoods($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$office_id = ( int ) $url ['oid'] > 0 ? ( int ) $url ['oid'] : ( int ) $_POST ['office_id'];
		$goods_list = $url ['goods_list'] ? $url ['goods_list'] : $_POST ['goods_list'];
		$officeGoodsObj = new m_officegoods ();
		foreach ( $goods_list as $goods_id ) {
			if (! $officeGoodsObj->delOfficeGoods ( $office_id, $goods_id )) {
				$this->ajax_res ( "操作失败：" . $officeGoodsObj->getError (), - 1 );
				exit ();
			}
		}
		$this->ajax_res ( "操作成功", 0 );
	}
	
	/**
	 * 打印单据
	 * 
	 * @param unknown $inPath        	
	 */
	function pageprintofficegoods($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$office_id = ( int ) $url ['oid'] > 0 ? ( int ) $url ['oid'] : '';
		
		if (empty ( $office_id )) {
			$this->ShowMsg ( "获取科室信息失败" );
			exit ();
		}
		
		$officeObj = new m_office ();
		$office = $officeObj->selectOne ( "office_id = {$office_id}" );
		$this->params ['office'] = $office;
		
		$officegoodsObj = new m_officegoods ();
		$officegoodsList = $officegoodsObj->getGoodsList ( $office_id );
		if(empty($officegoodsList->items)){
			$this->ShowMsg("请先配置科室商品。");
			exit();
		}
		$forecastObj = new m_forecast();
		$goodsObj = new m_goods();
		foreach ($officegoodsList->items as &$officeGoods) {
			$forecast = $forecastObj->getOfficeGoodsForcast($officeGoods['office_id'], $officeGoods['goods_id']);
			$goodsInfo = $goodsObj->selectOne('goods_id='.$officeGoods['goods_id']);
			$officeGoods['is_20l'] = (int)$goodsInfo['is_20l'];
			if($forecast) {
				$officeGoods['safe_stock'] = $forecast['confirm_quantity'];
			}
		}
		$this->params ['officegoodsList'] = $officegoodsList->items;
		
		return $this->render ( 'hospital/print.html', $this->params );
	}
	/**
	 * 销量预测列表查询
	 */
	function pageforecastofficegoods($inPath){
		$url = $this->getUrlParams ( $inPath );
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		$key = $url ['key'] ? $url ['key'] : $_POST ['key'];
		$office_id = ( int ) $url ['oid'] > 0 ? ( int ) $url ['oid'] : ( int ) $_POST ['office_id'];
		$forecastObj = new m_forecast();
		$table = $forecastObj->tableName();
		$today = date ( "Y-m-d H:i:s" );
		$condition = "office_id={$office_id}";
		if ($_POST) {
			$stime = base_Utils::getStr ( $_POST ['stime'] );
			$etime = base_Utils::getStr ( $_POST ['etime'] );
			if ($stime) {
				if ($etime) {
					$this->params ['etime'] = $etime;
				}
				$etime = $etime ? $etime : $today;
				$condition = $condition ? $condition . " and date({$table}.dateymd) between '{$stime}' and '{$etime}'" : "date({$table}.dateymd) between '{$stime}' and '{$etime}'";
				$this->params ['stime'] = $stime;
			} else {
				if ($etime) {
					$this->params ['etime'] = $etime;
				}
				$etime = $etime ? $etime : $today;
				$condition = $condition ? $condition . " and date({$table}.dateymd) < '{$etime}'" : "date({$table}.dateymd) < '{$etime}'";
			}
		}
		$rs = $forecastObj->listForecast($condition, $page);
		$this->params['forecastList'] = $rs->items;
		$this->params ['pagebar'] = $this->PageBar ( $rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath );
		$this->params['office_id'] = $office_id;
		return $this->render ( 'hospital/sales_forecast.html', $this->params );
	}
	/**
	 * 销量预测
	 * @param unknown $inPath
	 */
	function pageForecast($inPath){
		$url = $this->getUrlParams ( $inPath );
		$office_id = ( int ) $url ['oid'] > 0 ? ( int ) $url ['oid'] : ( int ) $_POST ['office_id'];
		$officeObj = new m_office ();
		$office = $officeObj->selectOne ( "office_id = {$office_id}" );
		$this->params ['office'] = $office;
		$officegoodsObj = new m_officegoods ();
		$officegoodsList = $officegoodsObj->forecast ( $office_id );
		$this->params ['officegoodsList'] = $officegoodsList;
		$firstMon = date('n', strtotime('-3 month'));
		$secondMon = date('n', strtotime('-2 month'));
		$thirdMon = date('n', strtotime('-1 month'));
		$this->params['firstMon'] = $firstMon;
		$this->params['secondMon'] = $secondMon;
		$this->params['thirdMon'] = $thirdMon;
		return $this->render ( 'hospital/add_forecast.html', $this->params );
	}
	/**
	 * 新增销售预测
	 * @param unknown $inPath
	 */
	function pageAddForecast($inPath){
		$oid = $_POST['office_id'];
		$goodsList = $_POST['goods_list'];
		if(!$oid||!$goodsList){
			$this->ajax_res("操作失败：缺少参数。", -1);
			exit();
		}
		$forecastObj = new m_forecast();
		$forecastId = $forecastObj->create($oid, $goodsList);
		if(!$forecastId){
			$this->ajax_res("操作失败：".$forecastObj->getError(), -1);
			exit();
		}else {
			$this->ajax_res("操作成功：".$forecastObj->getError(), 0, $forecastId);
			exit();
		}
	}
	/**
	 * 销售预测明细查询
	 * @param unknown $inPath
	 */
	function pageForecastDetail($inPath){
		$url = $this->getUrlParams ( $inPath );
		$forecast_id = ( int ) $url ['sid'] > 0 ? ( int ) $url ['sid'] : ( int ) $_POST ['sid'];
		$forecastObj = new m_forecast();
		$rs = $forecastObj->getForecast($forecast_id);
		
		$officeObj = new m_office();
		$this->params['office']= $officeObj->get($rs['hospital_id']);
		if (!rs) {
			$this->ShowMsg($forecastObj->getError());
		}else {
			$this->params["forecast"] = $rs;
			$this->params["detailList"] = $rs['detail_list'];
		}
		$firstMon = date('n', strtotime('-3 month'));
		$secondMon = date('n', strtotime('-2 month'));
		$thirdMon = date('n', strtotime('-1 month'));
		$this->params['firstMon'] = $firstMon;
		$this->params['secondMon'] = $secondMon;
		$this->params['thirdMon'] = $thirdMon;
		if(!$url['print']){
			return $this->render ( 'hospital/forecast_detail.html', $this->params );
		}else{
			return $this->render ( 'hospital/print_forecast.html', $this->params );
		}
	}
	
	/**
	 * 科室商品导入模板
	 * @param unknown $inPath
	 */
	function pagedownloadmodel($inPath){
		
		$excel = array ();
    	$excelObj = new m_excel ();
    	$titles = array (
    			"A:10"=>'序号',
    			"B:20"=>'商品编号',
    			"C:20"=>'商品名称',
    			"D:10"=>'规格',
    			"E:10"=>'单位',
    			"F:10"=>'厂商全名',
    			"G:10"=>'适用机型',
    			"H:10"=>'项目品类',
    			"I:10"=>'初期安全库存',				
    			"J:20"=>'备注'
    	);
		$sheet['name'] = "科室商品模板_".date('Y-m-d');
		$sheet['sheet'] = array("导入模板","全量商品信息");
		$sheet['title'][] = $titles;
		$sheet['lists']['s0'] = $excel;
		
		$goodsObj = new m_goods();
		$rsgoods = $goodsObj->select("");
		$goods = $rsgoods->items;
		$exc_goods = array ();
    	foreach ( $goods as $ed ) {
			$e ['goods_no'] = $ed ['goods_no'];
			$e ['name'] = $ed ['name'];
			$e ['specification'] = $ed ['specification'];
			$e ['unit'] = $ed ['unit'];
			$e ['manu'] = $ed ['manu'];
			$e ['machine'] = $ed ['machine'];
			$e ['category'] = $ed ['category'];
			$e ['is_20l'] = $ed ['is_20l'];
			$e ['volume'] = $ed ['volume'];
			$e ['colorcode'] = $ed ['colorcode'];
			$e ['remark'] = $ed ['remark'];
			$exc_goods[] = $e;
    	}
		
		$goods_title = array (
    			"A:20"=>'商品编号',
    			"B:20"=>'商品名称',
    			"C:10"=>'规格',
    			"D:10"=>'单位',
    			"E:10"=>'厂商全名',
    			"F:10"=>'适用机型',
    			"G:10"=>'项目品类',
    			"H:10"=>'是否大包装',
    			"I:10"=>'容积',
    			"J:10"=>'色标',
    			"K:10"=>'备注'				
    	);
		$sheet['title'][] = $goods_title;
		$sheet['lists']['s1'] = $exc_goods;
		
    	$excelObj->pushmore ( $sheet );
	}
	
	/**
	 * 导入科室商品
	 * @param unknown $inPath
	 */
	function pageuploadmodel($inPath){
		$url = $this->getUrlParams($inPath);
		
        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
                $this->ShowMsg("操作失败" . '您还未选择文件');
            }

            $file_name = $_FILES['file']['name'];
            $file_type = substr(strrchr($file_name, '.'), 1);
            $file_tmp_name = $_FILES['file']['tmp_name'];
            $file_url = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/officegoods/" . $_FILES['file']['name'];
            $target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/officegoods/" . $_FILES['file']['name'];

            $reader = '';
            switch ($file_type) {
                case 'xlsx':
                    $reader_format = 1;
                    $reader = PHPExcel_IOFactory::createReader('Excel2007');
                    break;
                case 'xls':
                    $reader_format = 1;
                    $reader = PHPExcel_IOFactory::createReader('Excel5');
                    break;
                case 'csv':
                    $reader = PHPExcel_IOFactory::createReader('CSV');
                    break;
                default:
                    $this->ShowMsg("操作失败: " . "文件格式错误");
            }

            $PHPExcel = $reader->load($file_tmp_name);
            if (!$PHPExcel) {
                $this->ShowMsg("操作失败: " . "文件加载错误");
            }
            
            $sheet = $PHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn();
            $highestColumnIdx = PHPExcel_Cell::columnIndexFromString($highestColumn); // 取得总列数
            if ($highestColumnIdx < 10) {
                $this->ShowMsg("操作失败: " . "字段数不够".$highestColumn);
            }
            $highestColumnIdx = 10;


			
			$office_id = ( int ) $url ['oid'] > 0 ? ( int ) $url ['oid'] : ( int ) $_POST ['office_id'];
			$order_id = ( int ) $url ['orderid'] > 0 ? ( int ) $url ['orderid'] : ( int ) $_POST ['order_id'];
			$officeObj = new m_office ( $office_id );
			$office = $officeObj->selectOne ( "office_id = {$office_id}" );
			if (! $office) {
				$this->ShowMsg ( "科室不存在" );
			}
		
			$officegoodsObj = new m_officegoods ();
			$goodsObj = new m_goods();
			$delsql = "delete from smpss_officegoods  where  office_id = ifnull({$office_id},-1)";
			$officegoodsObj->query($delsql);
			for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
				$data = array();
				for ($column = 0; $column < $highestColumnIdx; $column++) {
					$columnName = PHPExcel_Cell::stringFromColumnIndex($column);
					$value = $sheet->getCellByColumnAndRow($column, $row)->getCalculatedValue();
					switch ($column) {
						case 0: $data['index'] = $value;  break;
						case 1: $data['goods_no'] = $value;    break;
						case 8: $data['safe_stock'] = $value;	break;
						case 9: $data['remark'] = $value;	break;
					}
				}
				
				$goodsinfo = $goodsObj->selectOne("goods_no = '".$data['goods_no']."'");
				if(empty($goodsinfo)){
					$this->ShowMsg ( "新增科室商品失败：未找到商品[".$data['goods_no']."]"  );	
				}
				
				$goods_id = $goodsinfo['goods_id'];
				if($officegoodsObj->selectOne("office_id={$office_id} and goods_id={$goods_id}")){
					continue;
				}
				$res = $officegoodsObj->createOne ( $office_id, $goods_id, $data['index'],$data['safe_stock'],$data['remark'] );
				
				if (!$res ) {
					$this->ShowMsg ( "新增科室失败：" . $officegoodsObj );
				}
			}
			
			if (! $order_id){
				$this->ShowMsg ( "操作成功！", $this->createUrl ( "/hospital/setofficegoods-oid-".$office_id ), 2, 1 );
			}
			else{
				$this->ShowMsg ( "操作成功! ", $this->createUrl ( "/order/addrecord-oid-" . $order_id ), 2, 1 );
			}
		
		}else{
			$this->ShowMsg ( "操作不正确" );	
		}
	}
	/**
	 * 设置科室库存安全系数
	 * @param unknown $inPath
	 */
	public function pageSetOfficeRatio($inPath){
		$url = $this->getUrlParams($inPath);
		$office_id = $_POST ['office_id'];
		$ratio = $_POST['safe_stock_ratio'];
		$officeObj = new m_office();
		if($officeObj->setSafeStockRatio($office_id, $ratio)){
			$this->ajax_res ( "操作成功", 0 );
		}else {
			$this->ajax_res ( "操作失败：" . $officeObj->getError (), - 1 );
			exit ();
		}
	}
	/**
	 * 科室字典查询
	 */
	public function pageGetOfficeOpt(){
		$hospital_id = ( int ) $_POST ['hospital_id'];
		$officeObj = new m_office ();
		$where["hospital_id"] = $hospital_id;
		$data = $officeObj->getOfficeList($where)->items;
		$this->ajax_res ( "操作成功", 0, $data );
		exit ();
	}
}
?>