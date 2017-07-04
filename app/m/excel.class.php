<?php
/**
 * excel操作
 *
 */
require_once dirname(__FILE__) . '/../e/PHPExcel.php';

class m_excel extends base_m {
	
	/* 
	 * Excel导出
	 * $titles各列的标题，$data导出的数据，$name保存的文件名,标签名
	 */
	function push($titles=NULL,$data,$name='Excel',$sheet='Sheet1'){
		$c = 0;
		if(!empty($data[0])){
			$c = count($data[0]);
		}elseif(!empty($titles)){
			$c = count($titles);	
		}
	 	$col = $this->create_col($c);
		$objPHPExcel = new \PHPExcel();
		/* 
		 * 设置文件信息 
		 * 作者、最后修改人、标题、主题、描述、标记、类别
		*/
		$objPHPExcel->getProperties()->setCreator("admin")
					   ->setLastModifiedBy("admin")
					   ->setTitle("标题")
					   ->setSubject("主题")
					   ->setDescription("描述")
					   ->setKeywords("标记")
					  ->setCategory("类别");
		$n = 1;
		if(!empty($titles)){
			$i = 0;
			foreach($titles as $k => $v){
				if($k) {
					$colPro = explode(":", $k);
					$objPHPExcel->getActiveSheet()->getColumnDimension($colPro[0])->setWidth($colPro[1]);
					if(isset($colPro[2])) {
						$objPHPExcel->getActiveSheet()->getStyle($colPro[0])->getAlignment()->setWrapText(true);
					}
				}
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($col[$i].$n, $v);
				$i++;
			}
			$n++;
		}
		if(!empty($data)){
			foreach($data as $key => $val){
				$i = 0;
				foreach($val as $k => $v){
					if(strpos($k, "wrap_")===0) {
						$objPHPExcel->setActiveSheetIndex(0)->getStyle($col[$i].$n)->getAlignment()->setWrapText(true);
					}
					$objPHPExcel->setActiveSheetIndex(0)->setCellValueExplicit ( $col [$i] . $n, $v, PHPExcel_Cell_DataType::TYPE_STRING );
					//$objPHPExcel->setActiveSheetIndex(0)->setCellValue($col[$i].$n, $v);
					$i++;
				}
				$n++;
			}
		}
		
		$objPHPExcel->getActiveSheet()->setTitle($sheet);
		$objPHPExcel->setActiveSheetIndex(0);
		header('Content-Type: application/vnd.ms-excel;charset=utf-8');
		header('Content-Disposition: attachment;filename="'.$name.'.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
    }
	
	/* 
	 * Excel导出 （导出多标签）
	 * $data = array($title=>array(array(),array()...),$lists=>array(array(),array()...),$name=>'',$sheet=>array());
	 * $title 头部标题数组
	 * $lists 导出的数据
	 * $name 保存的文件名
	 * $sheet 标签数组，数组值为标签名
	 */
	function pushmore($data){
		if(!empty($data)){
			$objPHPExcel = new \PHPExcel();
			/* 设置文件信息，作者、最后修改人、标题、主题、描述、标记、类别 */
			$objPHPExcel->getProperties()->setCreator("admin")
						   ->setLastModifiedBy("admin")
						   ->setTitle("标题")
						   ->setSubject("主题")
						   ->setDescription("描述")
						   ->setKeywords("标记")
						  ->setCategory("类别");
			
			$sheetCount = !empty($data['sheet']) ? count($data['sheet']) : 1;
			$sheetNames = !empty($data['sheet']) ? $data['sheet'] : array("Sheet1");
			
			$titles = $data['title'];
			$lists = $data['lists'];
			for($i=0;$i<$sheetCount;$i++){
				if($i>0){
					$objPHPExcel->createSheet();	
				}
				$objPHPExcel->setActiveSheetIndex($i);
				$objPHPExcel->getActiveSheet()->setTitle($sheetNames[$i]);				
				
				$startRow = 1;
				$rows = $lists['s'.$i];
				
				$colRowsCount = !empty($rows[0]) ? count($rows[0]) : 0;
				
				if(isset($titles[$i])){
					$startCol = 0;
					$colHeadCount = !empty($titles[$i]) ? count($titles[$i]) : 0;
					$colHead = $this->create_col($colHeadCount);
					$title = $titles[$i];
					foreach($title as $k => $v){
						$objPHPExcel->getActiveSheet()->setCellValueExplicit($colHead[$startCol].$startRow,$v,PHPExcel_Cell_DataType::TYPE_STRING);
						$startCol++;
					}
					$startRow = $startRow + 1;
				}
				if($rows){
					$colHead = $this->create_col($colRowsCount);
					foreach($rows as $row){
						$startCol = 0;
						foreach($row as $k => $v){
							$objPHPExcel->getActiveSheet()->setCellValueExplicit($colHead[$startCol].$startRow,$v,PHPExcel_Cell_DataType::TYPE_STRING);
							$startCol++;
						}
						$startRow = $startRow + 1;
					}
					foreach($colHead as $col){
						$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);							
					}
				}
			}
			$objPHPExcel->setActiveSheetIndex(0);
			$name = !empty($data['name']) ? $data['name'] : date('Y-m-d');
			header('Content-Type: application/vnd.ms-excel;charset=utf-8');
			header('Content-Disposition: attachment;filename="'.$name.'.xls"');
			header('Cache-Control: max-age=0');
			$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
			$objWriter->save('php://output');
			return true;			
		}else{
			$this->setError ( 0, "获取数据失败" );
			return false;	
		}
    }
	
	/*
	 * 上传Excel文件
	 * $file文件，$filetempname上传的文件路径，$pathName存放的目录名，$saveName保存的文件名
	 */
	function uploadFile($file,$filetempname,$pathName = 'xmlfile'){
		//自己设置的上传文件存放路径
		$saveDir = dirname(dirname(dirname(__FILE__))).'/assets/'.base_config::FILE_SAVE_PATH."/";
		if(!is_dir($saveDir)){
			mkdir($saveDir);
		}
		$filePath = $saveDir.$pathName.'/';
		if(!is_dir($filePath)){
			mkdir($filePath);
		}
		
		$str = "";
		//下面的路径按照你PHPExcel的路径来修改
		require_once dirname(__FILE__) . '/../e/PHPExcel/IOFactory.php';
		require_once dirname(__FILE__) . '/../e/PHPExcel/Reader/Excel5.php';
		//上传后的文件名
		$saveName = $file;
		$uploadfile = $filePath.$saveName;//上传后的文件名地址 
		//move_uploaded_file() 函数将上传的文件移动到新位置。若成功，则返回 true，否则返回 false.
		$result = move_uploaded_file($filetempname,$uploadfile);//假如上传到当前目录下
		//如果上传文件成功，就执行导入excel操作
		if($result){
			return $uploadfile;
		}else{
			return false;
		}
	}
	/*
	 * 保存数据到Excel
	 * 
	 */
	function saveFile($titles=NULL,$data,$pathName = 'xmlfile',$saveName=''){
		$filePath = dirname(__FILE__)."/../e_t/$pathName/";
		if(!is_dir($filePath)){
			mkdir($filePath);
		}
		$c = 0;
		if(!empty($data[0])){
			$c = count($data[0]);
		}
	 	$col = $this->create_col($c);
		$objPHPExcel = new \PHPExcel();
		/* 
		 * 设置文件信息 
		 * 作者、最后修改人、标题、主题、描述、标记、类别
		*/
		$objPHPExcel->getProperties()->setCreator("admin")
					   ->setLastModifiedBy("admin")
					   ->setTitle("标题")
					   ->setSubject("主题")
					   ->setDescription("描述")
					   ->setKeywords("标记")
					  ->setCategory("类别");
		$n = 1;
		if(!empty($titles)){
			$i = 0;
			foreach($titles as $k => $v){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($col[$i].$n, $v);
				$i++;
			}
			$n++;
		}
		foreach($data as $key => $val){
			$i = 0;
			foreach($val as $k => $v){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($col[$i].$n, $v);
				$i++;
			}
			$n++;
		}
		if($saveName==''){
			$name=$time;
		}else{
			$name=$saveName;
		}
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		$objPHPExcel->setActiveSheetIndex(0);
		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save($filePath.$name.'.xls');
		return "e_t/$pathName/".$name.'.xls';
	}
	/*
	 * 获取Excel值
	 * $file文件，$filetempname文件路径，$sql_head要生成的sql信息：table-表名，hasTitle-excel第一行是否为标题行，col-表的各个字段名
	 */
	function getExcelVal($filePath,$hasHead,$fileHead = NULL){
		$objReader = \PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel = $objReader->load($filePath); 
		
		$sheetCount = $objPHPExcel->getSheetCount();
		$data = array();
		for($i=0;$i<$sheetCount;$i++){
			$objWorksheet = $objPHPExcel->getSheet($i);
			$sheetName = $objWorksheet->getTitle();
			$highestRow = $objWorksheet->getHighestRow();		//取得总行数
			$highestColumn = $objWorksheet->getHighestColumn(); //取得总列数
			$minRow = $hasHead ? 1:0;	
			$highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
			if($highestRow <= $minRow){
				continue;	
			}
			$start_row = $hasHead ? 2:1;			
			$data['s'.$i]['n'] = $sheetName;
			for ($r = $start_row;$r <= $highestRow;$r++){
				//注意highestColumnIndex的列数索引从0开始
				$val = array();
				for ($c = 0;$c < $highestColumnIndex;$c++){
					if($fileHead){
						$val[$fileHead[$c]] = $objWorksheet->getCellByColumnAndRow($c, $r)->getValue();
					}else{
						$val[] = $objWorksheet->getCellByColumnAndRow($c, $r)->getValue();
					}
				}
				if(!empty($val)){
					$data['s'.$i]['v'][] = $val;
				}
			}
		}
		//echo json_encode($data);exit;
		return $data;
	}
	/*
	 * 获取Excel值
	 * $file文件，$filetempname文件路径，$sql_head要生成的sql信息：table-表名，hasTitle-excel第一行是否为标题行，col-表的各个字段名，$sheet Excel页签
	 */
	function getExcelSheetVal($filePath,$hasHead,$sheet,$fileHead = NULL){
		$objReader = \PHPExcel_IOFactory::createReader('Excel5');
		$objPHPExcel = $objReader->load($filePath); 
		
		$data = array();
		
		$objWorksheet = $objPHPExcel->getSheet($sheet);
		$sheetName = $objWorksheet->getTitle();
		$highestRow = $objWorksheet->getHighestRow();		//取得总行数
		$highestColumn = $objWorksheet->getHighestColumn(); //取得总列数
		$minRow = $hasHead ? 1:0;	
		$highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
		if($highestRow <= $minRow){
			continue;	
		}
		$start_row = $hasHead ? 2:1;	
		
		for ($r = $start_row;$r <= $highestRow;$r++){
			//注意highestColumnIndex的列数索引从0开始
			$val = array();
			for ($c = 0;$c < $highestColumnIndex;$c++){
				if($fileHead){
					$val[$fileHead[$c]] = $objWorksheet->getCellByColumnAndRow($c, $r)->getValue();
				}else{
					$val[] = $objWorksheet->getCellByColumnAndRow($c, $r)->getValue();
				}
			}
			if(!empty($val)){
				$data[] = $val;
			}
		}
		
		//echo json_encode($data);exit;
		return $data;
	}
	
	/*
	 * excel生成insert sql
	 */
	function createSql($uploadfile,$sql_head){
		$sql = 'INSERT INTO '.$sql_head['table'];
		$head = $sql_head['col'];
		$col = '';
		
		foreach($head as $val){
			$col .= $val;
			if($val!=end($head)){
				$col .= ',';
			}
		}
		$sql .= '('.$col.') VALUES ';
		$objReader = \PHPExcel_IOFactory::createReader('Excel5');//use excel2007 for 2007 format 
		//$objReader = \PHPExcel_IOFactory::createReader('Excel2007');
		$objPHPExcel = $objReader->load($uploadfile); 
		
		
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$highestRow = $objWorksheet->getHighestRow();		//取得总行数
		$highestColumn = $objWorksheet->getHighestColumn(); //取得总列数
		
		$highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);

		$start_row = 1;
		if($sql_head['hasTitle']){
			$start_row++;
		}
		
		for ($r = $start_row;$r <= $highestRow;$r++){
			$v = "(";
			//注意highestColumnIndex的列数索引从0开始
			for ($c = 0;$c < $highestColumnIndex;$c++){
				$v .= "'".$objWorksheet->getCellByColumnAndRow($c, $r)->getValue()."'";
				if($c!=$highestColumnIndex-1){
					$v .= ",";
				}else{
					$v .= ")";
				}
			}    
			$sql .= $v;
			if($r!=$highestRow){
				$sql .=',';
			}else{
				$sql .=';';
			}
		}
		return $sql;
	}
	
	/*
	 * 动态生成excel的列
	 */
	function create_col($count){
		$c= array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
		$rs = array();
		for($i=0;$i<$count;$i++){
			if($i>25){ 
				$rs[$i] = $c[($i/26-1)].$c[$i%26];
				continue;
			}
			$rs[$i] = $c[$i];
		}
		return $rs;
	}
	
	function downloadFile($name,$filename){
		$filepath = dirname(__FILE__)."/../e_t/$filename";
		
		header('Content-Description: File Transfer');
 
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$name.'.xls');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($filepath));
		readfile($filepath);
	}
}