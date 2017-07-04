<?php
class io_reminder extends SGui{
	/**
	 * 催办提醒
	 */
	function pageremind(){
		error_log("reminder start.........");
		$orderObj = new m_order();
		$where = sprintf("DATE_SUB(CURDATE(), INTERVAL %d DAY)>create_time", base_Constant::SMS_REMIND_INTERVAL);
		$where = $where." and status=".m_order::ORDER_STATUS_WAIT;
		$orderList = $orderObj->select($where);
		$preOrderObj = new m_hospitalorder();
		$adminObj = new m_admin();
		foreach ($orderList as $order) {
			$preOrder = $preOrderObj->selectOne("hospitaorder_id={$order['hospitalorder_id']}");
			//$adminObj->selectOne("")
		}
	}
}