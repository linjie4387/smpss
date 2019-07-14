<?php
/**
 * 价格管理
 * @author mol
 *
 */
require_once dirname(__FILE__) . '/../base/PHPExcel/IOFactory.php';

class c_price extends base_c {
	
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
	
	function pageaddmodel($inPath) {
		
        $url = $this->getUrlParams($inPath);
		$page = $url ['page'] ? (int)$url ['page'] : 1;
		
		$status = $url ['status'] ? (int)$url ['status'] : '';
		
        $this->params['hospitalorder'] = '';
        return $this->render('price/addmodel.html', $this->params);
    }
	
	function pagepricemodel($inPath) {
		
        $url = $this->getUrlParams($inPath);
		$page = $url ['page'] ? (int)$url ['page'] : 1;
		
		$priceObj = new m_pricemodels();
		$list = $priceObj->getList("",$page);
		
        $this->params['list'] = $list;
        
        return $this->render('price/pricemodel.html', $this->params);
    }

    function pageimppricemodel($inPath) {
        $url = $this->getUrlParams($inPath);

        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);

            if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
                $this->ShowMsg("操作失败" . '您还未选择文件');
            }

            $file_name = $_FILES['file']['name'];
            $file_type = substr(strrchr($file_name, '.'), 1);
            $file_tmp_name = $_FILES['file']['tmp_name'];
			$tmp_target_name = 'pricemodel-'.date('YmdHis');
            //$target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/pricemodel/" . $_FILES['file']['name'];
			$target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/pricemodel/" . $tmp_target_name . "." . $file_type;
            $file_url = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/pricemodel/" .  $tmp_target_name . "." . $file_type;
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
			$this->impair($sheet);
			
            $sheet = $PHPExcel->getSheet(1);
			$this->imppriceexpress($sheet);
			
            $sheet = $PHPExcel->getSheet(2);
			$this->imppricefreight($sheet);
			
            $sheet = $PHPExcel->getSheet(3);
			$this->imppricetrain($sheet);
			
            if (move_uploaded_file($file_tmp_name, $target_name)) {
				
                $pricemodelsObj = new m_pricemodels();

                if ($pricemodelsObj->create($file_name, $target_name, $file_url)) {

                    $this->ShowMsg("操作成功！", $this->createUrl("/price/pricemodel"), 2, 1);
                }
                $this->ShowMsg("操作失败" . $uploadlogObj->getError());
            }
            else {
                $this->ShowMsg("操作失败" . '上传失败');
            }
        }
        
        $this->params['demo_xlsx'] =  "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/pricemodel/demo.xlsx";
        //$this->params['demo_xls'] = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/price/demo.xls";
        //$this->params['demo_csv'] = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/device/price.csv";
        
        return $this->render('price/pricemodel.html', $this->params);
    }
	

	//航空价格导入
	function impair($sheet) {
        
        if($sheet){
 
            $highestRow = $sheet->getHighestRow(); // 取得总行数
			//echo $highestRow."<br/>" ;
            $highestColumn = $sheet->getHighestColumn();
			//echo $highestColumn ;
            $highestColumnIdx = PHPExcel_Cell::columnIndexFromString($highestColumn); // 取得总列数

            if ($highestColumnIdx < 7 ) {
                $this->ShowMsg("操作失败: " . "航空价格字段数不够".$highestColumn."  ".$highestColumnIdx."   ".$highestRow);
            }
            $highestColumnIdx = 7;
			
            $priceObj = new m_priceair();
			
            //删除现有数据
            $priceObj->delete();

            for ($row = 3; $row <= $highestRow; $row++){//行数是以第1行开始
			    //echo  $row."   ";
				$province_id = -1;
                for ($column = 0; $column < $highestColumnIdx; $column++) {
                    $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
                    $value = (string)$sheet->getCellByColumnAndRow($column, $row)->getCalculatedValue();
					$value = str_replace(" ","",$value);
					$value = str_replace("—","",$value);
					$value = str_replace("-","",$value);
                    switch ($column) {
                        case 0: 
							$province_id = $this->getProvinceByName($value,$deep=3);
							if($province_id==''){
								$this->ShowMsg("操作失败: 省份名“".$value."”不正确，请下载并参考《城市名称列表.xlsx》" );
							}
							$data['province_id'] = $province_id;  
							$data['province_name'] = $value;  
							break;
                        case 1: 
							$city_id = $this->getCityByName($value,$province_id,$deep=3);
							if($city_id==''){
								$this->ShowMsg("操作失败: 城市名“".$value."”不正确，请下载并参考《城市名称列表.xlsx》" );
							}
							$data['city_id'] = $city_id;  
							$data['city_name'] = $value;  
							break;
                        case 2: $data['col1'] = $value; break;
                        case 3: $data['col2'] = $value; break;
                        case 4: $data['col3'] = $value; break;
                        case 5: $data['col4'] = $value; break;
                        case 6: $data['col5'] = $value; break;
                    }
                }
				//var_dump(json_encode($data));
				if (!$priceObj->create($data)) {
					$this->ShowMsg("操作失败: " . $priceObj->getError());
				}
			}
        }
    }
	
	
	//快递价格导入
	function imppriceexpress($sheet) {
        
        if($sheet){
 
            $highestRow = $sheet->getHighestRow(); // 取得总行数
			//echo $highestRow."<br/>" ;
            $highestColumn = $sheet->getHighestColumn();
			//echo $highestColumn ;
            $highestColumnIdx = PHPExcel_Cell::columnIndexFromString($highestColumn); // 取得总列数

            if ($highestColumnIdx < 4 ) {
                $this->ShowMsg("操作失败: " . "快递价格字段数不够".$highestColumn."  ".$highestColumnIdx."   ".$highestRow);
            }
            $highestColumnIdx = 4;
			
            $priceObj = new m_priceexpress();
			
            //删除现有数据
            $priceObj->delete();

            for ($row = 3; $row <= $highestRow; $row++){//行数是以第1行开始
			    //echo  $row."   ";
				$province_id = -1;
				
                for ($column = 0; $column < $highestColumnIdx; $column++) {
                    $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
                    $value = (string)$sheet->getCellByColumnAndRow($column, $row)->getCalculatedValue();
					$value = str_replace(" ","",$value);
					$value = str_replace("—","",$value);
					$value = str_replace("-","",$value);
                    switch ($column) {
                        case 0: 
							$province_id = $this->getProvinceByName($value,$deep=3);
							if($province_id==''){
								$this->ShowMsg("操作失败: 省份名“".$value."”不正确，请下载并参考《城市名称列表.xlsx》" );
							}
							$data['province_id'] = $province_id;  
							$data['province_name'] = $value;  
							break;
                        case 1: 
							$city_id = $this->getCityByName($value,$province_id,$deep=3);
							if($city_id==''){
								$this->ShowMsg("操作失败: 城市名“".$value."”不正确，请下载并参考《城市名称列表.xlsx》" );
							}
							$data['city_id'] = $city_id;  
							$data['city_name'] = $value;  
							break;
                        case 2: $data['first_weight'] = $value; break;
                        case 3: $data['next_weight'] = $value; break;
                    }
                }
                if (!$priceObj->create($data)) {
                    $this->ShowMsg("操作失败: " . $deviceObj->getError());
                }
            }
        }
    }
	
	//货运价格导入
	function imppricefreight($sheet) {
        
        if($sheet){
 
            $highestRow = $sheet->getHighestRow(); // 取得总行数
			//echo $highestRow."<br/>" ;
            $highestColumn = $sheet->getHighestColumn();
			//echo $highestColumn ;
            $highestColumnIdx = PHPExcel_Cell::columnIndexFromString($highestColumn); // 取得总列数

            if ($highestColumnIdx < 5 ) {
                $this->ShowMsg("操作失败: " . "快递价格字段数不够".$highestColumn."  ".$highestColumnIdx."   ".$highestRow);
            }
            $highestColumnIdx = 5;
			
            $priceObj = new m_pricefreight();
			
            //删除现有数据
            $priceObj->delete();

            for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
			    //echo  $row."   ";
				$province_id = -1;
				
                for ($column = 0; $column < $highestColumnIdx; $column++) {
                    $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
                    $value = (string)$sheet->getCellByColumnAndRow($column, $row)->getCalculatedValue();
					$value = str_replace(" ","",$value);
					$value = str_replace("—","",$value);
					$value = str_replace("-","",$value);
                    switch ($column) {
                        case 0: 
							$province_id = $this->getProvinceByName($value,$deep=3);
							if($province_id==''){
								$this->ShowMsg("操作失败: 省份名“".$value."”不正确，请下载并参考《城市名称列表.xlsx》" );
							}
							$data['province_id'] = $province_id;  
							$data['province_name'] = $value;  
							break;
                        case 1: 
							$city_id = $this->getCityByName($value,$province_id,$deep=3);
							if($city_id==''){
								$this->ShowMsg("操作失败: 城市名“".$value."”不正确，请下载并参考《城市名称列表.xlsx》" );
							}
							$data['city_id'] = $city_id;  
							$data['city_name'] = $value;  
							break;
                        case 2: $data['m3'] = $value; break;
                        case 3: $data['kg'] = $value; break;
                        case 4: $data['t'] = $value; break;
                    }
                }
                if (!$priceObj->create($data)) {
                    $this->ShowMsg("操作失败: " . $deviceObj->getError());
                }
            }
        }
    }
	
	//中铁价格导入
	function imppricetrain($sheet) {
        
        if($sheet){
 
            $highestRow = $sheet->getHighestRow(); // 取得总行数
			//echo $highestRow."<br/>" ;
            $highestColumn = $sheet->getHighestColumn();
			//echo $highestColumn ;
            $highestColumnIdx = PHPExcel_Cell::columnIndexFromString($highestColumn); // 取得总列数

            if ($highestColumnIdx < 7 ) {
                $this->ShowMsg("操作失败: " . "快递价格字段数不够".$highestColumn."  ".$highestColumnIdx."   ".$highestRow);
            }
            $highestColumnIdx = 7;
			
            $priceObj = new m_pricetrain();
			
            //删除现有数据
            $priceObj->delete();

            for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
			    //echo  $row."   ";
				$province_id = -1;
				
                for ($column = 0; $column < $highestColumnIdx; $column++) {
                    $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
                    $value = (string)$sheet->getCellByColumnAndRow($column, $row)->getCalculatedValue();
					$value = str_replace(" ","",$value);
					$value = str_replace("—","",$value);
					$value = str_replace("-","",$value);
                    switch ($column) {
                        case 0: 
							$province_id = $this->getProvinceByName($value,$deep=3);
							if($province_id==''){
								$this->ShowMsg("操作失败: 省份名“".$value."”不正确，请下载并参考《城市名称列表.xlsx》" );
							}
							$data['province_id'] = $province_id;  
							$data['province_name'] = $value;  
							break;
                        case 1: 
							$city_id = $this->getCityByName($value,$province_id,$deep=3);
							if($city_id==''){
								$this->ShowMsg("操作失败: 城市名“".$value."”不正确，请下载并参考《城市名称列表.xlsx》" );
							}
							$data['city_id'] = $city_id;  
							$data['city_name'] = $value;  
							break;
                        case 2: $data['train_number'] = $value; break;
                        case 3: $data['min_price'] = $value; break;
                        case 4: $data['unit_price'] = $value; break;
                        case 5: $data['begin_time'] = $value; break;
                        case 6: $data['end_time'] = $value; break;
                    }
                }
                if (!$priceObj->create($data)) {
                    $this->ShowMsg("操作失败: " . $deviceObj->getError());
                }
            }
        }
    }

	
	function getProvinceByName($province_name,$deep=0) {
		if($deep<0){
			return '';
		}
		$deep = $deep - 1;

		$regionObj = new m_priceregion();
		$region_list = $regionObj->getProvinceByName($province_name);

		if($region_list){
		  $region_id = $region_list[0]['region_id'];
			//var_dump(json_encode($region_list));
			return $region_id;
		}else{
			$regionObj->createProvince($province_name);
			$province_id = $this->getProvinceByName($province_name,$deep);
			return $province_id;
		}
		return '';
	}

	function getCityByName($city_name,$parent_id,$deep=0) {
		
		if($deep<0){
			return '';
		}
		$deep = $deep - 1;
		//echo 'city:'. $city_name."<br>";
		//echo 'parent_id:'. $parent_id."<br>";
	  	$regionObj = new m_priceregion();
		$region_list = $regionObj->getCityByName($city_name);
		//var_dump(json_encode($region_list));
		//echo '<br/>---------------------------------';
		//echo '<br/>';
		if($region_list){
			$city_id = $region_list[0]['region_id'];
			return $city_id;
		}else{
			$regionObj->createCity($city_name,$parent_id);
			$city_id = $this->getCityByName($city_name,$parent_id,$deep);
			return $city_id;
		}

		return '';
	}

}
    ?>