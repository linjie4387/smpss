<?php
/**
 * 仪器管理
 * @author mol
 *
 */

require_once dirname(__FILE__) . '/../base/PHPExcel/IOFactory.php';

class c_device extends base_c {
	
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			//$this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "仪器管理-" . $this->params ['head_title'];
	}
	
	function pageindex($inPath) {
        $url = $this->getUrlParams($inPath);
		$page = $url ['page'] ? (int)$url ['page'] : 1;
        
        $condition = '';
        $deviceObj = new m_device();

        if($_POST){
            $key = base_Utils::getStr($_POST['key'], 'html');
            if ($key) {
				$condition .= "(hospital_name like '%{$key}%' or serial_code like '%{$key}%')";
                $this->params['key'] = $key;
            }
            
            $supplier_id = (int)$_POST['supplier_id'];
            if($supplier_id){
                $condition = $condition ? $condition." and supplier_id = {$supplier_id}" : "supplier_id = {$supplier_id}";
                $this->params['supplier_id'] = $supplier_id;
            }
        }

        $rs = $deviceObj->getDeviceList($condition, $page);
        $this->params['deviceList'] = $rs->items;
        
        $supplierObj = new m_supplier();
        $this->params['supplierList'] = $supplierObj->getOptionList();
        
        $this->params['pagebar'] = $this->PageBar ($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);

        return $this->render('device/index.html', $this->params);
	}
    
    function pagelogindex($inPath) {
        $page = $url ['page'] ? (int)$url ['page'] : 1;
        
        $condition = '';
        $uploadlogObj = new m_uploadlog();
        $ymd = date("Y-m-d", time());
        $condition ="file_type=".m_uploadlog::FILE_TYPE_DEVICE;
        if($_POST){
            $stime = base_Utils::getStr($_POST['stime']);
            $etime = base_Utils::getStr($_POST ['etime']);

            if ($stime) {
                if ($etime)
                    $this->params['etime'] = $etime;
                $etime = $etime ? $etime : $ymd;
                $condition =$condition ? $condition." and date(upload_time) between '{$stime}' and '{$etime}'" : "date(upload_time) between '{$stime}' and '{$etime}'";
                $this->params['stime'] = $stime;
            }
        }
        
        $rs = $uploadlogObj->getUploadlogList($condition, $page);
        $this->params['uploadlogList'] = $rs->items;
        
        $this->params['pagebar'] = $this->PageBar ($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
        
        return $this->render('device/logindex.html', $this->params);
    }

    function pageadddevice($inPath) {
        $url = $this->getUrlParams($inPath);
        
        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
                $this->ShowMsg("操作失败" . '您还未选择文件');
            }

            $file_name = $_FILES['file']['name'];
            $file_type = substr(strrchr($file_name, '.'), 1);
            $file_tmp_name = $_FILES['file']['tmp_name'];
            $file_url = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/device/" . $_FILES['file']['name'];
            $target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/device/" . $_FILES['file']['name'];

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
            if ($highestColumnIdx < 35) {
                $this->ShowMsg("操作失败: " . "字段数不够".$highestColumn);
            }
            $highestColumnIdx = 35;

            $deviceObj = new m_device();
            //删除现有仪器数据
            $deviceObj->delete();
			//删除现有科室商品数据
			//$officegoodsObj = new m_officegoods();
			//$officegoodsObj->delete();
            for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
			//echo  $highestColumnIdx."///";
                for ($column = 0; $column < $highestColumnIdx; $column++) {
                    $columnName = PHPExcel_Cell::stringFromColumnIndex($column);
                    $value = (string)$sheet->getCellByColumnAndRow($column, $row)->getCalculatedValue();
					
                    switch ($column) {
                        case 0: $data['id_code'] = $value;  break;
                        case 1: $data['district_name'] = $value;    break;
                        case 2: $data['level_order'] = $value; break;
                        case 3: $data['level'] = $value; break;
                        case 4: $data['hospital_code'] = $value; break;
                        case 5: $data['hospital_level'] = $value; break;
                        case 6: $data['hospital_name'] = $value; break;
                        case 7: $data['invoice_name'] = $value; break;
                        case 8: $data['supplier_code'] = $value; break;
                        case 9: $data['service_level'] = $value; break;
                        case 10: $data['model_name'] = $value; break;
                        case 11: $data['instruction'] = $value; break;
                        case 12: $data['serial_code'] = $value; break;
                        case 13: $data['qrcode'] = $value; break;
                        case 14: $data['office_name'] = $value; break;
                        case 15: $data['contact_phone'] = $value; break;
                        case 16: $data['contact_name'] = $value; break;
                        case 17: $data['address'] = $value; break;
                        case 18: $data['post_code'] = $value; break;
                        case 19: $data['saler_name'] = $value; break;
                        case 20: $data['reagent_source'] = $value; break;
                        case 21: $data['deliveryman'] = $value; break;
                        case 22: $data['serviceman'] = $value; break;
                        case 23: $data['applyman'] = $value; break;
                        case 24:
                            if ($reader_format) {
                                $data['install_time'] = gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value));
                            }
                            else
                                $data['install_time'] = $value;
                            break;
                        case 25: $data['warranty_period'] = $value; break;
                        case 26:
                            if ($reader_format) {
                                $data['warranty_time'] = gmdate("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($value));
                            }
                            else
                                $data['warranty_time'] = $value;
                            break;
                        case 27: $data['service_period'] = $value; break;
                        case 28: $data['apply_period'] = $value; break;
                        case 29: $data['code'] = $value; break;
                        case 30: $data['supplier_install_order_id'] = $value; break;
                        case 31: $data['company_install_order_id'] = $value; break;
						case 32: $data['space'] = $value; break;
						case 33: $data['tax_num'] = $value; break;
						case 34: $data['delivery_msg'] = $value; break;
                    }
                }
                if (!$deviceObj->create($data)) {
                    $this->ShowMsg("操作失败: " . $deviceObj->getError());
                }
            }

            if (move_uploaded_file($file_tmp_name, $target_name)) {
                $uploadlogObj = new m_uploadlog();
                
                if ($uploadlogObj->createUploadlog($file_name, $target_name, $file_url)) {
                    $this->ShowMsg("操作成功！", $this->createUrl("/device/logindex"), 2, 1);
                }
                $this->ShowMsg("操作失败" . $uploadlogObj->getError());
            }
            else {
                $this->ShowMsg("操作失败" . '上传失败');
            }
        }
        
        $this->params['demo_xlsx'] =  "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/device/demo.xlsx";

        $this->params['demo_xls'] = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/device/demo.xls";
        $this->params['demo_csv'] = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/device/demo.csv";
        
        return $this->render('device/adddevice.html', $this->params);
    }
	//有的Excel
	function toStr(){
		
	}
    function pagedevicedetail($inPath) {
        $url = $this->getUrlParams($inPath);
        $device_id = (int)$url['did'] > 0 ? (int)$url ['did'] : (int)$_POST['device_id'];

        $deviceObj = new m_device();
        $device = $deviceObj->selectOne("device_id = {$device_id}");
        if (!$device) {
            $this->ShowMsg("操作失败" . '无此设备');
        }
        $this->params['device'] = $device;

        $districtObj = new m_district();
        $district = $districtObj->selectOne("district_id = {$device['district_id']}");
        if (!$district) {
            $this->ShowMsg("操作失败" . '无此区县');
        }
        $this->params['district'] = $district;

        $hospitalObj = new m_hospital();
        $hospital = $hospitalObj->selectOne("hospital_id = {$device['hospital_id']}");
        /*
        if (!$hospital) {
            $this->ShowMsg("操作失败" . '无此医院');
        }
         */
        $this->params['hospital'] = $hospital;

        $officeObj = new m_office();
        $office = $officeObj->selectOne("office_id = {$device['office_id']}");
        /*
        if (!$office) {
            $this->ShowMsg("操作失败" . '无此科室');
        }
         */
        $this->params['office'] = $office;

        $supplierObj = new m_supplier();
        $supplier = $supplierObj->selectOne("supplier_id = {$device['supplier_id']}");
        /*
        if (!$supplier) {
            $this->ShowMsg("操作失败" . '无此供应商');
        }
         */
        $this->params['supplier'] = $supplier;

        $modelObj = new m_model();
        $model = $modelObj->selectOne("model_id = {$device['model_id']}");
        /*
        if (!$model) {
            $this->ShowMsg("操作失败" . '无此型号');
        }
         */
        $this->params['model'] = $model;
        
        return $this->render('device/devicedetail.html', $this->params);
    }
    
}
?>