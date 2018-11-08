<?php
/**
 * 商品管理
 * @author mol
 *
 */
require_once dirname(__FILE__) . '/../base/PHPExcel/IOFactory.php';
/*require_once dirname(__FILE__) . '/../base/Qiniu/autoload.php';
use Qiniu\Auth;*/
class c_goods extends base_c {

    function __construct($inPath) {
		parent::__construct ();
		if (self::isLogin () === false) {
			$this->ShowMsg ( "请先登录！", $this->createUrl ( "/main/index" ) );
		}
		if (self::checkRights ( $inPath ) === false) {
			// $this->ShowMsg("您无权操作！",$this->createUrl("/system/index"));
		}
		$this->params ['inpath'] = $inPath;
		$this->params ['head_title'] = "商品管理-" . $this->params ['head_title'];
	}
	
	//跳转主页，不带导入导出功能
    function pageindex($inPath) {
		$this->params = $this->gotoindex($inPath,0);
		return $this->render('goods/index.html', $this->params);
	}
	//跳转主页，带导入导出功能
	function pageimportandexport($inPath) {
		$this->params = $this->gotoindex($inPath,1);
		$file_url = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/goods/demo.xls";
		$this->params['demofile'] = $file_url;
		return $this->render('goods/index.html', $this->params);
	}

	function gotoindex($inPath,$importandexport){
		$url = $this->getUrlParams ( $inPath );
		$page = $url ['page'] ? ( int ) $url ['page'] : 1;
		
		$condition = '';
		$goodsObj = new m_goods();
		
		if ($_POST) {
			$key = base_Utils::getStr($_POST['key'], 'html');
			$manu = base_Utils::getStr($_POST['manu'], 'html');
			$category = base_Utils::getStr($_POST['category'], 'html');
			$machine = base_Utils::getStr($_POST['machine'], 'html');
			if ($key) {
				$condition .= "(name like '%{$key}%' or extern_name like '%{$key}%' or goods_no like '%{$key}%' or remark like '%{$key}%')";
				$this->params['key'] = $key;
			}
			if($manu) {
				$condition .= strlen($condition)>0 ? " and (manu like '%{$manu}%' )":"(manu like '%{$manu}%' )";
				$this->params['manu'] = $manu;
			}
			if($category) {
				$condition .= strlen($condition)>0 ? " and (category like '%{$category}%' )":"(category like '%{$category}%' )";
				$this->params['category'] = $category;
			}
			if($machine) {
				$condition .= strlen($condition)>0 ? " and (machine like '%{$machine}%' )":"(machine like '%{$machine}%' )";
				$this->params['machine'] = $machine;
			}
		}
		
		$rs = $goodsObj->getGoodsList($condition, $page);
		$this->params['goodsList'] = $rs->items;
		
		$this->params['importandexport'] = $importandexport;
		$this->params['pagebar'] = $this->PageBar($rs->totalSize, base_Constant::PAGE_SIZE, $page, $inPath);
		return $this->params;
		
	}

	//导出所有商品到excel表格
	function pageexport($inPath) {
		$excel = array ();
    	$excelObj = new m_excel ();

		$sheet['name'] = "全部商品信息_".date('Y-m-d');
		$sheet['sheet'] = array("商品信息");
		$goodsObj = new m_goodsmeta();
		$office_id = $_GET['officeid'];
		if(!$office_id){
			$office_id = $_POST['officeid'];
		}
		
		if($office_id){ //表示在科室中查看商品，并导出。
			$officegoodsObj = new m_officegoods ();
			$list  = $officegoodsObj->getGoodsList ( $office_id )->items;
			//echo json_encode($list);
			if ($list) {
				for($i = 0; $i < count ( $list ); $i ++) {
					//echo "goods_no = '".$list[$i]['goods_id']."'";
					$goodsMsg = $goodsObj->selectOne ( "goods_no = '".$list[$i]['goods_id']."'" );
					$goods[$i] ['goods_no'] = $goodsMsg ['goods_no'];
					$goods[$i] ['name'] = $goodsMsg ['name'];
					$goods[$i] ['specification'] = $goodsMsg ['specification'];
					$goods[$i] ['unit'] = $goodsMsg ['unit'];
					$goods[$i] ['testnum'] = $goodsMsg ['testnum'];
					$goods[$i] ['manu'] = $goodsMsg ['manu'];
					$goods[$i] ['machine'] = $goodsMsg ['machine'];
					$goods[$i] ['category'] = $goodsMsg ['category'];
					$goods[$i] ['is_20l'] = $goodsMsg ['is_20l'];
					$goods[$i] ['volume'] = $goodsMsg ['volume'];
					$goods[$i] ['colorcode'] = $goodsMsg ['colorcode'];
					$goods[$i] ['remark'] = $goodsMsg ['remark'];
					$goods[$i] ['price'] = $goodsMsg ['price'];
				}
			}
		}else{
			$sql = "select a.* from smpss_goodsmeta a  ";
			$sql=$sql." order by goods_no";	
			//echo $sql;
			//exit;
			$rsgoods = $goodsObj->query($sql);
			$goods = $rsgoods->items;
		}
		/*
		if($_POST){
			$office_id = $_POST['officeid'];
			if($office_id){
				 $sql=$sql." and b.office_id = ".$office_id;	
			}
			$manu = $_POST['manu'];
			if($office_id){
				 $sql=$sql." and a.manu like '%".$manu."%'";	
			}
			$category = $_POST['category'];
			if($category){
				 $sql=$sql." and a.category like '%".$category."%'";	
			}
			$key = $_POST['key'];
			if($key){
				 $sql=$sql." and (a.goods_no like '%".$key."%' or a.name like '%".$key."%' or a.remark like '%".$key."%')";	
			}
		}
		*/
		//echo json_encode($goods);
		//exit();
		$exc_goods = array ();
    	foreach ( $goods as $ed ) {
			$e ['goods_no'] = $ed ['goods_no'];
			$e ['name'] = $ed ['name'];
			$e ['specification'] = $ed ['specification'];
			$e ['unit'] = $ed ['unit'];
			$e ['testnum'] = $ed ['testnum'];
			$e ['manu'] = $ed ['manu'];
			$e ['machine'] = $ed ['machine'];
			$e ['category'] = $ed ['category'];
			$e ['is_20l'] = $ed ['is_20l'];
			$e ['volume'] = $ed ['volume'];
			$e ['colorcode'] = $ed ['colorcode'];
			$e ['remark'] = $ed ['remark'];
			$e ['price'] = $ed ['price'];
			$exc_goods[] = $e;
    	}
		$goods_title = array (
    			"A:20"=>'商品编号',
    			"B:20"=>'商品名称',
    			"C:10"=>'规格',
    			"D:10"=>'单位',
    			"E:10"=>'测试数',
    			"F:10"=>'厂商全名',
    			"G:10"=>'适用机型',
    			"H:10"=>'项目品类',
    			"I:10"=>'是否大包装',
    			"J:10"=>'容积',
    			"K:10"=>'色标',
    			"L:10"=>'备注',
    			"M:10"=>'价格'
    	);
		$sheet['title'][] = $goods_title;
		$sheet['lists']['s0'] = $exc_goods;
    	$excelObj->pushmore ( $sheet );
	}

	//导入所有商品更新现有商品信息
	function pageimport($inPath) {
		$url = $this->getUrlParams($inPath);
		
        if($_POST){
            $post = base_Utils::shtmlspecialchars($_POST);
            
            if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
                 $this->ajax_res ( "您还未选择文件.",-1);exit;
            }

            $file_name = $_FILES['file']['name'];
            $file_type = substr(strrchr($file_name, '.'), 1);
            $file_tmp_name = $_FILES['file']['tmp_name'];
            $file_url = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/goods/" . $_FILES['file']['name'];
            //$target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/goods/" . $_FILES['file']['name'];

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
                    $this->ajax_res ( "文件格式错误.",-1);exit;
            }

            $PHPExcel = $reader->load($file_tmp_name);
            if (!$PHPExcel) {
                $this->ajax_res ( "文件加载错误.",-1);exit;
            }
			
            $sheet = $PHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn();
            $highestColumnIdx = PHPExcel_Cell::columnIndexFromString($highestColumn); // 取得总列数
            if ($highestColumnIdx != 12) {
            	$this->ajax_res ( "导入字段数不够.".$highestColumnIdx,-1);exit;
            }
            $highestColumnIdx = 12;
			$goodsObj = new m_goodsmeta();
			$goodsObj->delete();
			$inrsetCount = 0;
            	
			
			for ($row = 2; $row <= $highestRow; $row++){//行数是以第1行开始
				$data = array();
				for ($column = 0; $column < $highestColumnIdx; $column++) {
					$columnName = PHPExcel_Cell::stringFromColumnIndex($column);
					$value = (string)$sheet->getCellByColumnAndRow($column, $row)->getCalculatedValue();
					switch ($column) {
						case 0: $data['goods_no'] = $value;  break;
						case 1: $data['name'] = $value;    break;
						case 2: $data['specification'] = $value;    break;
						case 3: $data['unit'] = $value;    break;
						case 4: $data['testnum'] = $value;    break;
						case 5: $data['manu'] = $value;    break;
						case 6: $data['machine'] = $value;    break;
						case 7: $data['category'] = $value;    break;
						case 8: $data['is_20l'] = $value;    break;
						case 9: $data['volume'] = $value;    break;
						case 10: $data['colorcode'] = $value;    break;
						case 11: $data['remark'] = $value;    break;
					}
				}
				$isSave = $goodsObj->selectOne('goods_no = '.$data['goods_no']);
				if(!$isSave){
					if(!$data['extern_name'])$data['extern_name'] = $data['name'];
					if($goodsObj->createOne($data))$inrsetCount++;
				}
			}
			$this->ajax_res ( "操作成功,共导入:".$inrsetCount.'条记录.',0);
		}else{
			$this->ajax_res ( "导入失败.",-1);
		}
	}

	function pageaddgoods($inPath) {
		
		$url = $this->getUrlParams($inPath);
		$goods_id = $url['gid'] > 0 ? $url['gid'] : $_POST['goods_id'];
		if(empty($goods_id)){
			$goods_id=$_GET['gid'];
		}
		$goodsObj = new m_goods();   //原生的goods表，主键为goods_id
		$goodsmetaObj = new m_goodsmeta();  //已将goods_no转成主键
		$goodsinfo = $goodsObj->selectOne("goods_id='".$goods_id."'");
		
		$goods_imgObj = new m_goodsimgs();
		$goods_imgs = $goods_imgObj->selectOne("goods_no='".$goodsinfo['goods_no']."'");
		//var_dump($goods_imgs);
		$flag = false;
		if ($_POST) {
			$post = base_Utils::shtmlspecialchars($_POST);
			if (is_uploaded_file($_FILES['regimg']['tmp_name'])){
				$target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/commodity/";
				$tempFiles = $_FILES['regimg']['tmp_name'];
				$file_name = uniqid().'.'.substr(strrchr($_FILES['regimg']['name'], '.'), 1);
				$target_name = $target_name.$file_name;
				if(!move_uploaded_file($tempFiles, $target_name))$this->ShowMsg('上传商品注册证图片失败.');
				$post['regimg'] = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/commodity/".$file_name;
				$flag =$goods_imgObj->create(['regimg'=>$post['regimg'],'goods_no'=>$goodsinfo['goods_no'],'id'=>$goods_imgs['id']]);
			}
			
			if (is_uploaded_file($_FILES['noticeimg']['tmp_name'])){
				$target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/commodity/";
				$tempFiles = $_FILES['noticeimg']['tmp_name'];
				$file_name = uniqid().'.'.substr(strrchr($_FILES['noticeimg']['name'], '.'), 1);
				$target_name = $target_name.$file_name;
				if(!move_uploaded_file($tempFiles, $target_name))$this->ShowMsg('上传说明书图片失败.');
				$post['noticeimg'] = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/commodity/".$file_name;
				$flag =$goods_imgObj->create(['noticeimg'=>$post['noticeimg'],'goods_no'=>$goodsinfo['goods_no'],'id'=>$goods_imgs['id']]);
			}
			
			if (is_uploaded_file($_FILES['labelimg']['tmp_name'])){
				$target_name = ROOT_APP . base_Constant::UPLOAD_DATA_DIR. "/commodity/";
				$tempFiles = $_FILES['labelimg']['tmp_name'];
				$file_name = uniqid().'.'.substr(strrchr($_FILES['labelimg']['name'], '.'), 1);
				$target_name = $target_name.$file_name;
				if(!move_uploaded_file($tempFiles, $target_name))$this->ShowMsg('上传商品标签图片失败.');
				$post['labelimg'] = "http://" . base_Constant::DOMAIN_NAME . base_Constant::ROOT_DIR . "/app" . base_Constant::UPLOAD_DATA_DIR. "/commodity/".$file_name;
				$flag =$goods_imgObj->create(['labelimg'=>$post['labelimg'],'goods_no'=>$goodsinfo['goods_no'],'id'=>$goods_imgs['id']]);
			}
			//if ($flag) {
			//	$this->ShowMsg( "操作成功！", $this->createUrl("/goods/addgoods?gid={$goods_id}" ), 2, 1);
			//}
			if ($goodsmetaObj->update($post, "TRUE")) {
				$this->ShowMsg( "操作成功！", $this->createUrl("/goods/addgoods?gid={$goods_id}" ), 2, 1);
			}
			$this->ShowMsg("操作失败" . $goodsObj->getError());
		}
		
		$this->params['goods'] = $goodsObj->selectOne("goods_id='".$goods_id."'");
		//echo json_encode($this->params['goods']);
		//$this->params['goods']['img'] = $goods_imgObj->selectOne("id=".$goods_imgs['id']);
		$this->params['goods']['img'] = $goods_imgObj->selectOne("goods_no='".$goods_id."'");
		return $this->render('goods/addgoods.html', $this->params);
	}

	//商品图片打印页
	function pagegoodsimgprint($inPath) {
		$url = $this->getUrlParams ( $inPath );
		$url = $this->getUrlParams($inPath);
		$goods_no = $url['gid'];
		
		$goods_imgObj = new m_goodsimgs();
		$goodsObj = new m_goodsmeta();
		$goods = $goodsObj->selectOne("goods_no ='".$goods_no."'");
		if(!$goods)$this->ShowMsg("该商品标识信息不存在.");
		$this->params['goods'] = $goods;
		$this->params['goods']['img'] = $goods_imgObj->selectOne("goods_no='".$goods_no."'");
		//print_r($this->params['goods']);exit;
		
		return $this->render('goods/goodsimgprint.html', $this->params);
	}
}
?>