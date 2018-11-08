<?php
class base_Constant {
	const PAGE_SIZE = 30;
    const DOMAIN_NAME = "admin.chens.mobi";
	const ROOT_DIR = "";
	const TABLE_PREFIX = "smpss_";
	const URL_SUFFIX = "html";
	const URL_FORMAT = "-";
	const REWRITE = FALSE;
	const COOKIE_KEY = "1b04c22c8bbf0ad9cda884d86ceb653b";
	const TEMP_DIR = "simpla";
    const UPLOAD_DATA_DIR = "/upload";
	const DEFAULT_TITLE = "中科执信";
	const VERSION = "v1.0 Release";
    const KEY_USER_TYPE = 1001;
    const KEY_USER_LEVEL = 1002;
    const KEY_USER_STATUS = 1003;
    const KEY_ORDER_STATUS = 1004;
    const KEY_ORDER_COMPANY = 1005;
    const KEY_TRADE_STATUS = 1006;
    const KEY_PIC_TYPE = 1007;
    const KEY_DELIVERY_STATUS = 1008;
    const KEY_SIGN_STATUS = 1009;
    const KEY_CARLICENSE_TYPE = 1010;
    const KEY_DRIVERLICENSE_TYPE = 1011;
    const KEY_APPAISE_TYPE = 1012;
    const LOGO_DATA_DIR = "/app/upload/logo/logo.jpg";
    const INSTALL_DIR = "/var/websites/smpss";
    const WP_ORDER_CONFIRM_URL = "http://wql.chens.mobi/index.php?s=/addon/Hospital/OrderEvent/orderaccept";
    const WP_DELIVERY_CONFIRM_URL = "http://wql.chens.mobi/index.php?s=/addon/Hospital/OrderEvent/deliveryaccept";
		//发车
		const WP_ORDER_SENDGOODS_URL = "http://wql.chens.mobi/index.php?s=/addon/Hospital/Hospital/deliverySendGoods";
		//签收和部分签收
		const WP_ORDER_SIGN_URL = "http://wql.chens.mobi/index.php?s=/addon/Hospital/Hospital/deliverysign";
		//拒签
		const WP_ORDER_UNSIGN_URL = "http://wql.chens.mobi/index.php?s=/addon/Hospital/Hospital/deliveryunsign'";
		const WP_ORDER_DEL_URL = "http://wql.chens.mobi/index.php?s=/addon/Hospital/OrderEvent/orderdel";
		const WP_CHANGE_DELIVERY_MAN_URL = "http://wql.chens.mobi/index.php?s=/addon/Hospital/OrderEvent/changeDeliveryman";
    const WP_APP_TOKEN = "gh_7d0ac53ebf4a";
    const SMS_REMIND_INTERVAL = 3;
    const FORECAST_SAFE_MULTIPLE = 1.5;
}
