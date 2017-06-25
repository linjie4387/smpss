<?php
/**
 * 试剂管理
 * @author zjx
 *
 */
require_once dirname ( __FILE__ ) . '/../base/PHPExcel/IOFactory.php';
class c_reagent extends base_c {
	function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			// $this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "试剂管理-" . $this->params ['head_title'];
	}
	/**
	 * 试剂管理首页
	 * 
	 * @param unknown $inPath        	
	 */
	function pageindex($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		
		$condition = '';
		$reagentObj = new m_reagent ();
		
		if ($_POST) {
			$key = base_Utils::getStr ( $_POST ['key'], 'html' );
			if ($key) {
				$condition .= "(name like '%{$key}%' or generate_name like '%{$key}%' or manufacturer like '%{$key}%')";
				$this->params ['key'] = $key;
			}
			
			$device = ( int ) $_POST ['device'];
			if ($device) {
				$condition = $condition ? $condition . " and device = {$device}" : "device = {$device}";
				$this->params ['device'] = $device;
			} else {
				$this->params ['device'] = 0;
			}
			
			$model = ( int ) $_POST ['model'];
			if ($model) {
				$condition = $condition ? $condition . " and model = {$model}" : "model = {$model}";
				$this->params ['model'] = $model;
			} else {
				$this->params ['model'] = 0;
			}
		}
		
		$rs = $reagentObj->getReagentList ( $condition, $page );
		$this->params ['reagentList'] = $rs->items;
		
		$deviceObj = new m_reagentdevice ();
		$this->params ['deviceList'] = $deviceObj->getOptionList ();
		if ($device) {
			$modelObj = new m_reagentmodel ();
			$this->params ['modelList'] = $modelObj->getOptionList ( $device );
		}else{
			$this->params ['modelList'] = array();
		}
		$this->params ['pagebar'] = $this->PageBar ( $rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath );
		
		return $this->render ( 'reagent/index.html', $this->params );
	}
	function pagegetmodelopt($inPath) {
		$device_id = ( int ) $_POST ['device_id'];
		$modelObj = new m_reagentmodel ();
		$data = $modelObj->getOptionList ( $device_id );
		$this->ajax_res ( "操作成功", 0, $data );
		exit ();
	}
	
	/**
	 * 查询历史
	 * 
	 * @param unknown $inPath        	
	 * @return void|boolean|string|mixed
	 */
	function pagelogindex($inPath) {
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		
		$condition = '';
		$uploadlogObj = new m_uploadlog ();
		$ymd = date ( "Y-m-d", time () );
		$condition = "file_type=" . m_uploadlog::FILE_TYPE_REAGENT;
		if ($_POST) {
			$stime = base_Utils::getStr ( $_POST ['stime'] );
			$etime = base_Utils::getStr ( $_POST ['etime'] );
			if ($stime) {
				if ($etime)
					$this->params ['etime'] = $etime;
				$etime = $etime ? $etime : $ymd;
				$condition = $condition ? $condition . " and date(upload_time) between '{$stime}' and '{$etime}'" : "date(upload_time) between '{$stime}' and '{$etime}'";
				$this->params ['stime'] = $stime;
			}
		}
		
		$rs = $uploadlogObj->getUploadlogList ( $condition, $page );
		$this->params ['uploadlogList'] = $rs->items;
		
		$this->params ['pagebar'] = $this->PageBar ( $rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath );
		
		return $this->render ( 'reagent/logindex.html', $this->params );
	}
	/**
	 * 导入试剂
	 * 
	 * @param unknown $inPath        	
	 */
	function pageaddreagent($inPath) {
		$url = $this->getUrlParams ( $inPath );
		
		if ($_POST) {
			$post = base_Utils::shtmlspecialchars ( $_POST );
			
			if (! is_uploaded_file ( $_FILES ['file'] ['tmp_name'] )) {
				$this->ShowMsg ( "操作失败" . '您还未选择文件' );
			}
			
			$file_name = $_FILES ['file'] ['name'];
			$file_type = substr ( strrchr ( $file_name, '.' ), 1 );
			$file_tmp_name = $_FILES ['file'] ['tmp_name'];
			$file_url = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR . "/reagent/" . $_FILES ['file'] ['name'];
			$target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR . "/reagent/" . $_FILES ['file'] ['name'];
			
			$reader = '';
			switch ($file_type) {
				case 'xlsx' :
					$reader_format = 1;
					$reader = PHPExcel_IOFactory::createReader ( 'Excel2007' );
					break;
				case 'xls' :
					$reader_format = 1;
					$reader = PHPExcel_IOFactory::createReader ( 'Excel5' );
					break;
				case 'csv' :
					$reader = PHPExcel_IOFactory::createReader ( 'CSV' );
					break;
				default :
					$this->ShowMsg ( "操作失败: " . "文件格式错误" );
			}
			
			$PHPExcel = $reader->load ( $file_tmp_name );
			if (! $PHPExcel) {
				$this->ShowMsg ( "操作失败: " . "文件加载错误" );
			}
			
			$sheet = $PHPExcel->getSheet ( 0 );
			$highestRow = $sheet->getHighestRow (); // 取得总行数
			$highestColumn = $sheet->getHighestColumn ();
			$highestColumnIdx = PHPExcel_Cell::columnIndexFromString ( $highestColumn ); // 取得总列数
			if ($highestColumnIdx < 12) {
				$this->ShowMsg ( "操作失败: " . "字段数不够" . $highestColumn );
			}
			$highestColumnIdx = 12;
			
			// 清空数据
			$reagentObj = new m_reagent ();
			$reagentObj->delete ();
			$reagentDeviceObj = new m_reagentdevice ();
			$reagentDeviceObj->delete ();
			$reagentModelObj = new m_reagentmodel ();
			$reagentModelObj->delete ();
			
			for($row = 2; $row <= $highestRow; $row ++) { // 行数是以第1行开始
				$device = array ();
				$model = array ();
				$data = array ();
				for($column = 0; $column < $highestColumnIdx; $column ++) {
					$columnName = PHPExcel_Cell::stringFromColumnIndex ( $column );
					$value = $sheet->getCellByColumnAndRow ( $column, $row )->getCalculatedValue ();
					switch ($column) {
						case 0 :
							$device ['device_name'] = $value;
							$deviceId = $reagentDeviceObj->create ( $device );
							if ($deviceId) {
								$data ['device'] = $deviceId;
							} else {
								$this->ShowMsg ( "操作失败" . $reagentDeviceObj->getError () );
							}
							break;
						case 1 :
							$model ['device_id'] = $deviceId;
							$model ['model_name'] = $value;
							$modelId = $reagentModelObj->create ( $model );
							if ($modelId) {
								$data ['model'] = $modelId;
							} else {
								$this->ShowMsg ( "操作失败" . $reagentModelObj->getError () );
							}
							break;
						case 2 :
							$data ['storage_condition'] = $value;
							break;
						case 3 :
							$data ['code'] = $value;
							break;
						case 4 :
							$data ['name'] = $value;
							break;
						case 5 :
							$data ['generate_name'] = $value;
							break;
						case 6 :
							$data ['unit'] = $value;
							break;
						case 7 :
							$data ['specs'] = $value;
							break;
						case 8 :
							$data ['regist_id'] = $value;
							break;
						case 9 :
							if(!empty($value)) {
								if ($reader_format) {
									$data ['valid_date'] = gmdate ( "Y-m-d", PHPExcel_Shared_Date::ExcelToPHP ( $value ) );
								} else
									$data ['valid_date'] = $value;
							}
							break;
						case 10 :
							$data ['manufacturer'] = $value;
							break;
						case 11 :
								$data ['apply_to'] = $value;
								break;
					}
				}
				if (! $reagentObj->create ( $data )) {
					$this->ShowMsg ( "操作失败: " . $deviceObj->getError () );
				}
			}
			
			if (move_uploaded_file ( $file_tmp_name, $target_name )) {
				$uploadlogObj = new m_uploadlog ();
				
				if ($uploadlogObj->createUploadlog ( $file_name, $target_name, $file_url, m_uploadlog::FILE_TYPE_REAGENT )) {
					$this->ShowMsg ( "操作成功！", $this->createUrl ( "/reagent/logindex" ), 2, 1 );
				}
				$this->ShowMsg ( "操作失败" . $uploadlogObj->getError () );
			} else {
				$this->ShowMsg ( "操作失败" . '上传失败' );
			}
		}
		
		$this->params ['demo_xlsx'] = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR . "/reagent/demo.xlsx";
		
		$this->params ['demo_xls'] = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR . "/reagent/demo.xls";
		$this->params ['demo_csv'] = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR . "/reagent/demo.csv";
		
		return $this->render ( 'reagent/addreagent.html', $this->params );
	}
}
?>