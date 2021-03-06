<?php
/**
 * 仪器表数据模型
 * @author mol
 */
class m_device extends base_m {
	public function primarykey() {
		return 'device_id';
	}
	public function tableName() {
		return base_Constant::TABLE_PREFIX . 'device';
	}
	public function relations() {
		return array();
	}
	
	public function getDeviceList($condition = '', $page = 1) {
		$this->setCount(true);
		$this->setPage($page);
		$this->setLimit(base_Constant::PAGE_SIZE);
        
		$rs = $this->select($condition, "*", "", "order by device_id desc");
        if ($rs) {
            $list = $rs->items;
            
            $districtObj = new m_district();
            $officeObj = new m_office();
            $supplierObj = new m_supplier();
            $modelObj = new m_model();
            
            for ($i=0; $i<count($list); $i++) {
                $district = $districtObj->selectOne("district_id = {$list[$i]['district_id']}");
                $list[$i]['district_name'] = $district['name'];

                $office = $officeObj->selectOne("office_id = {$list[$i]['office_id']}");
                $list[$i]['office_name'] = $office['name'];
                $list[$i]['contact_name'] = $office['contact_name'];
                $list[$i]['contact_phone'] = $office['contact_phone'];
                
                $supplier = $supplierObj->selectOne("supplier_id = {$list[$i]['supplier_id']}");
                $list[$i]['supplier_code'] = $supplier['code'];

                $model = $modelObj->selectOne("model_id = {$list[$i]['model_id']}");
                $list[$i]['model_name'] = $model['name'];
            }
            $rs->items = $list;

            return $rs;
        }
        else
            return array();
	}
    
    public function create($data) {
        $device = $this->selectOne("serial_code = '{$data['serial_code']}'");

        // 区县处理
        $districtObj = new m_district();
        $district = $districtObj->selectOne("name = '{$data['district_name']}'");
        if (!$district) {
            // 新增区县
            $districtData['name'] = $data['district_name'];
            
            $district_id = $districtObj->create($districtData);
            if (!$district_id) {
                $this->setError(0, "保存区县数据失败" . $districtObj->getError());
                return false;
            }
        }
        else {
            $district_id = $district['district_id'];
        }


        // 医院处理, 有可能为空
        if ($data['hospital_code']) {
            $hospitalObj = new m_hospital();
            $hospital = $hospitalObj->selectOne("code = '{$data['hospital_code']}'");
            if ($hospital) {
                $hospital_id = $hospitalData['hospital_id'] = $hospital['hospital_id'];
            }
            $hospitalData['district_id'] = $district_id;
            $hospitalData['code'] = $data['hospital_code'];
            $hospitalData['name'] = $data['hospital_name'];
            $hospitalData['invoice_name'] = $data['invoice_name'];
            $hospitalData['level'] = $data['level'];
            $hospitalData['level_order'] = $data['level_order'];
            $hospitalData['hospital_level'] = $data['hospital_level'];
            $hospitalData['post_code'] = $data['post_code'];
            $hospitalData['address'] = $data['address'];
            $hospitalData['tax_num'] = $data['tax_num'];

            $rs = $hospitalObj->create($hospitalData);
            if (!$rs) {
                $this->setError(0, "保存医院数据失败" . $hospitalObj->getError());
                return false;
            }
            if (!$hospital_id) {
                $hospital_id = $rs;
            }
        }

        // 科室处理, 有可能为空
        if ($hospital_id && $data['office_name']) {
            $officeObj = new m_office();
            $office = $officeObj->selectOne("hospital_id = {$hospital_id} and name = '{$data['office_name']}'");
            if ($office) {
                $office_id = $officeData['office_id'] = $office['office_id'];
            }
            $officeData['name'] = $data['office_name'];
            $officeData['hospital_id'] = $hospital_id;
            $officeData['contact_name'] = $data['contact_name'];
            $officeData['contact_phone'] = $data['contact_phone'];
        	$officeData['space'] = $data['space'];
            $rs = $officeObj->create($officeData);

            if (!$rs) {
                $this->setError(0, "保存科室数据失败" . $officeObj->getError());
                return false;
            }
            if (!$office_id) {
                $office_id = $rs;
            }
        }

        // 供应商处理
		if($data['supplier_code']){
			$supplierObj = new m_supplier();
			$supplier = $supplierObj->selectOne("code = '{$data['supplier_code']}'");
			if ($supplier) {
				$supplier_id = $supplierData['supplier_id'] = $supplier['supplier_id'];
			}
			else {
				$supplierData['code'] = $data['supplier_code'];
	
				$supplier_id = $supplierObj->create($supplierData);
				if (!$rs) {
					$this->setError(0, "保存供应商数据失败" . $supplierObj->getError());
					return false;
				}
			}
		}
        
        // 模型处理, 供应商有可能为空
        if ($supplier_id) {
            $modelObj = new m_model();
            $model = $modelObj->selectOne("supplier_id = {$supplier_id} and name = '{$data['model_name']}'");
            if (!$model) {
                $modelData['name'] = $data['model_name'];
                $modelData['supplier_id'] = $supplier_id;

                $model_id = $modelObj->create($modelData);
                if (!$model_id) {
                    $this->setError(0, "保存型号数据失败" . $modelObj->getError());
                    return false;
                }
            }
            else {
                $model_id = $model['model_id'];
            }
        }

        $this->set("id_code", $data['id_code']);
        $this->set("district_id", $district_id);
        $this->set("hospital_id", $hospital_id);
        $this->set("hospital_name", $data['hospital_name']);
        $this->set("office_id", $office_id);
        $this->set("supplier_id", $supplier_id);
        $this->set("model_id", $model_id);
        $this->set("serial_code", $data['serial_code']);
        $this->set("qrcode", $data['qrcode']);
        $this->set("service_level", $data['service_level']);
        $this->set("instruction", $data['instruction']);
        $this->set("install_time", $data['install_time']);
        $this->set("warranty_period", $data['warranty_period']);
        $this->set("warranty_time", $data['warranty_time']);
        $this->set("code", $data['code']);
        $this->set("supplier_install_order_id", $data['supplier_install_order_id']);
        $this->set("company_install_order_id", $data['company_install_order_id']);
		$this->set("space", $data['space']);
        $this->set("saler_name", $data['saler_name']);
        $this->set("reagent_source", $data['reagent_source']);
        $this->set("deliveryman", $data['deliveryman']);
        $this->set("serviceman", $data['serviceman']);
        $this->set("applyman", $data['applyman']);
        $this->set("service_period", $data['service_period']);
        $this->set("apply_period", $data['apply_period']);
        $this->set("admin_id", $_COOKIE['admin_id']);
        $this->set("create_time", date('Y-m-d H:i:s'));
        $this->set("delivery_msg",$data['delivery_msg']);
		
		if($data['id_code']){
			if ($device['device_id']) {
				$rs = $this->save($device['device_id']);
			}
			else {
				$rs = $this->save(false);
			}
		}else{
			$rs=true;
		}
        if ($rs)
        {
            return $rs;
        }

        $this->setError (0, "保存仪器数据失败" . $this->getError());
        return false;
    }

}
