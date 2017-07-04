<?php
/**
 * 试剂表数据模型
 * @author mol
 */
class m_reagent extends base_m {
	public function primarykey() {
		return 'reagent_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'reagent';
	}
	public function relations() {
		return array ();
	}
	public function getReagentList($condition = '', $page = 1) {
		$this->setCount ( true );
		$this->setPage ( $page );
		$this->setLimit ( base_Constant::PAGE_SIZE );
		$reagentTableName = $this->tableName ();
		$deviceTableName = base_Constant::TABLE_PREFIX . 'reagent_device';
		$modelTableName = base_Constant::TABLE_PREFIX . 'reagent_model';
		$rs = $this->select ( $condition, "{$reagentTableName}.*, {$deviceTableName}.device_name, {$modelTableName}.model_name", "", "order by reagent_id desc", array (
				"{$deviceTableName}" => "{$reagentTableName}.device={$deviceTableName}.device_id",
				"{$modelTableName}" => "{$reagentTableName}.model={$modelTableName}.model_id" 
		) );
		if ($rs) {
			$list = $rs->items;
			
			// $dataDictObj = new m_datadict();
			// for ($i=0; $i<count($list); $i++) {
			// $cat = $dataDictObj->selectOne("key_id = ".base_Constant::KEY_REAGENT_TYPE." and value={$list[$i]['cat_id']}");
			// $list[$i]['cat_name'] = $cat['name'];
			// }
			$rs->items = $list;
			return $rs;
		} else
			return array ();
	}
	public function create($data) {
		//$reagent = $this->selectOne ( "code = '{$data['code']}'" );
		$this->set ( "device", $data ['device'] );
		$this->set ( "model", $data ['model'] );
		$this->set ( "storage_condition", $data ['storage_condition'] );
		$this->set ( "code", $data ['code'] );
		$this->set ( "name", $data ['name'] );
		$this->set ( "generate_name", $data ['generate_name'] );
		$this->set ( "unit", $data ['unit'] );
		$this->set ( "specs", $data ['specs'] );
		$this->set ( "regist_id", $data ['regist_id'] );
		if($data ['valid_date'] ){
			$this->set ( "valid_date", $data ['valid_date'] );
		}
		$this->set ( "manufacturer", $data ['manufacturer'] );
		$this->set ( "apply_to", $data ['apply_to'] );
		$this->set ( "admin_id", $_COOKIE ['admin_id'] );
		$this->set ( "create_time", date ( 'Y-m-d H:i:s' ) );
		if ($reagent ['reagent_id']) {
			$rs = $this->save ( $reagent ['reagent_id'] );
		} else {
			$rs = $this->save ( false );
		}
		if ($rs) {
			return $rs;
		}
		
		$this->setError ( 0, "保存试剂数据失败" . $this->getError () );
		return false;
	}
}
