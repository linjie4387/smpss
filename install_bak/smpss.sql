-- --------------------------------------------------------

--
-- 表的结构 `smpss_datadict`
--

CREATE TABLE IF NOT EXISTS `smpss_datadict` (
`dict_id` int(10) NOT NULL AUTO_INCREMENT,
`key_id` int(10) NOT NULL COMMENT 'KEY标识',
`key_desc` varchar(120) NOT NULL DEFAULT '' COMMENT 'KEY描述',
`value` int(10) NOT NULL COMMENT '值',
`name` varchar(120) NOT NULL DEFAULT '' COMMENT '名称',
PRIMARY KEY (`dict_id`),
KEY `key_id` (`key_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='数据字典' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `smpss_datadict`
--

INSERT INTO `smpss_datadict` (`key_id`, `key_desc`, `value`, `name`) VALUES
(1001, '微信用户类型', 1, '医院'),
(1001, '微信用户类型', 2, '工程部'),
(1002, '微信工程部用户等级', 1, '普通'),
(1002, '微信工程部用户等级', 2, '管理员'),
(1003, '微信用户状态', 1, '待审核'),
(1003, '微信用户状态', 2, '正常'),
(1003, '微信用户状态', 3, '审核不通过')，
(1003, '微信用户状态', 4, '关闭权限'),
(1004, '订单状态', 1, '预订单下单'),
(1004, '订单状态', 2, '预订单处理中'),
(1004, '订单状态', 3, '预订单完毕'),
(1005, '接单公司', 1, '接单公司A'),
(1005, '接单公司', 2, '接单公司B'),
(1005, '接单公司', 3, '接单公司C');

-- --------------------------------------------------------

--
-- 表的结构 `smpss_district`
--

CREATE TABLE IF NOT EXISTS `smpss_district` (
`district_id` int(10) NOT NULL AUTO_INCREMENT,
`name` varchar(200) NOT NULL COMMENT '名称',
`create_time` datetime NOT NULL COMMENT '创建时间',
`admin_id` int(10) NOT NULL COMMENT '用户标识',
`modify_time` datetime COMMENT '修改时间',
`remark` text COMMENT '备注',
PRIMARY KEY (`district_id`)，
UNIQUE KEY `UQ_smpss_district_name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='区县表' AUTO_INCREMENT=3;

-- --------------------------------------------------------

--
-- 表的结构 `smpss_supplier`
--

CREATE TABLE IF NOT EXISTS `smpss_supplier` (
`supplier_id` int(10) NOT NULL AUTO_INCREMENT,
`code` varchar(200) NOT NULL COMMENT '编码',
`create_time` datetime NOT NULL COMMENT '创建时间',
`admin_id` int(10) NOT NULL COMMENT '用户标识',
`modify_time` datetime COMMENT '修改时间',
`remark` text COMMENT '备注',
PRIMARY KEY (`supplier_id`),
UNIQUE KEY `UQ_smpss_supplier_code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='供应商表' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------
--
-- 表的结构 `smpss_model`
--

CREATE TABLE IF NOT EXISTS `smpss_model` (
`model_id` int(10) NOT NULL AUTO_INCREMENT,
`supplier_id` int(10) NOT NULL COMMENT '供应商标识',
`name` varchar(200) NOT NULL COMMENT '名称',
`create_time` datetime NOT NULL COMMENT '创建时间',
`admin_id` int(10) NOT NULL COMMENT '用户标识',
`modify_time` datetime COMMENT '修改时间',
`remark` text COMMENT '备注',
PRIMARY KEY (`model_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='型号表' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `smpss_hospital`
--

CREATE TABLE IF NOT EXISTS `smpss_hospital` (
`hospital_id` int(10) NOT NULL AUTO_INCREMENT,
`name` varchar(200) NOT NULL COMMENT '用户名称',
`invoice_name` varchar(200) COMMENT '用户开票名称',
`code` varchar(200) NOT NULL COMMENT '用户编号',
`level` varchar(50) NOT NULL COMMENT '用户级别',
`level_order` varchar(50) NOT NULL COMMENT '用户级别顺序',
`hospital_level` varchar(50) NOT NULL COMMENT '医院等级',
`district_id` int(10) NOT NULL COMMENT '区县标识',
`post_code` varchar(50) COMMENT '邮编',
`address` varchar(200) COMMENT '地址',
`create_time` datetime NOT NULL COMMENT '创建时间',
`admin_id` int(10) NOT NULL COMMENT '用户标识',
`modify_time` datetime COMMENT '修改时间',
`remark` text COMMENT '备注',
PRIMARY KEY (`hospital_id`),
UNIQUE KEY `UQ_smpss_hospital_code` (`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='医院表' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `smpss_office`
--

CREATE TABLE IF NOT EXISTS `smpss_office` (
`office_id` int(10) NOT NULL AUTO_INCREMENT,
`name` varchar(200) NOT NULL COMMENT '名称',
`hospital_id` int(10) NOT NULL COMMENT '医院标识',
`hospital_name` varchar(200) NOT NULL COMMENT '医院名称',
`contact_name` varchar(50) COMMENT '联系人',
`contact_phone` varchar(50) COMMENT '联系电话',
`create_time` datetime NOT NULL COMMENT '创建时间',
`admin_id` int(10) NOT NULL COMMENT '用户标识',
`modify_time` datetime COMMENT '修改时间',
`remark` text COMMENT '备注',
PRIMARY KEY (`office_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='科室表' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `smpss_weichatuser`
--

CREATE TABLE IF NOT EXISTS `smpss_weichatuser` (
`weichatuser_id` int(10) NOT NULL AUTO_INCREMENT,
`open_id` varchar(200) NOT NULL COMMENT '微信的OPENID',
`name` varchar(200) NOT NULL COMMENT '名称',
`mobile` varchar(200) NOT NULL COMMENT '手机号码',
`hospital_id` int(10) COMMENT '医院标识',
`hospital_name` varchar(200) COMMENT '医院名称',
`office_id` int(10) COMMENT '科室标识',
`office_name` varchar(200) COMMENT '科室名称',
`type` int(10) NOT NULL DEFAULT '1' COMMENT '用户类型',
`level` int(10) NOT NULL DEFAULT '0' COMMENT '用户级别',
`status` int(10) NOT NULL DEFAULT '0' COMMENT '状态',
`is_valid` int(10) NOT NULL DEFAULT '1' COMMENT '是否有效',
`order_company` int(10) COMMENT '接单公司',
`apply_time` datetime NOT NULL COMMENT '申请时间',
`verify_time` datetime COMMENT '申请时间',
`verify_admin_id` int(10) COMMENT '审核用户标识',
`close_time` datetime COMMENT '关闭时间',
`close_admin_id` int(10) COMMENT '关闭用户标识',
`admin_id` int(10) COMMENT '用户标识',
`modify_time` datetime COMMENT '修改时间',
`remark` text COMMENT '备注',
PRIMARY KEY (`weichat_user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='微信用户表' AUTO_INCREMENT=6;

-- --------------------------------------------------------
--
-- 表的结构 `smpss_engineerdistrict`
--

CREATE TABLE IF NOT EXISTS `smpss_engineerdistrict` (
`engineerdistrict_id` int(10) NOT NULL AUTO_INCREMENT,
`weichatuser_id` int(10) NOT NULL COMMENT '微信用户标识',
`district_id` int(10) NOT NULL COMMENT '区县标识',
`create_time` datetime NOT NULL COMMENT '创建时间',
`admin_id` int(10) COMMENT '用户标识',
`modify_time` datetime COMMENT '修改时间',
`remark` text COMMENT '备注',
PRIMARY KEY (`engineerdistrict_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='工程师区县表' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------
--
-- 表的结构 `smpss_hospitalorder`
--

CREATE TABLE IF NOT EXISTS `smpss_hospitalorder` (
`hospitalorder_id` int(10) NOT NULL AUTO_INCREMENT,
`weichatuser_id` varchar(200) NOT NULL COMMENT '微信用户标识',
`name` varchar(200) NOT NULL COMMENT '姓名',
`mobile` varchar(200) NOT NULL COMMENT '手机号码',
`hospital_id` int(10) NOT NULL COMMENT '医院标识',
`hospital_name` varchar(200) NOT NULL COMMENT '医院名称',
`office_id` int(10) NOT NULL COMMENT '科室标识',
`office_name` varchar(200) NOT NULL COMMENT '科室名称',
`picture_url` varchar(200) NOT NULL COMMENT '图片地址',
`order_company` int(10) COMMENT '接单公司',
`status` int(10) NOT NULL DEFAULT '0' COMMENT '状态',
`preapply_time` datetime NOT NULL COMMENT '预订单申请时间',
`preverify_time` datetime COMMENT '预订单确认时间',
`preverify_admin_id` int(10) COMMENT '预订单确认用户标识',
`preclose_time` datetime COMMENT '预订单确认时间',
`preclose_admin_id` int(10) COMMENT '预订单确认用户标识',
`admin_id` int(10) NOT NULL COMMENT '用户标识',
`modify_time` datetime COMMENT '修改时间',
`remark` text COMMENT '备注',
PRIMARY KEY (`hospitalorder_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='医院订单表' AUTO_INCREMENT=6;

-- --------------------------------------------------------
--
-- 表的结构 `smpss_uploadlog`
--

CREATE TABLE IF NOT EXISTS `smpss_uploadlog` (
`uploadlog_id` int(10) NOT NULL AUTO_INCREMENT,
`upload_time` datetime NOT NULL COMMENT '上传时间',
`upload_admin_id` int(10) NOT NULL COMMENT '上传用户标识',
`file_name` varchar(200) NOT NULL COMMENT '文件名',
`file_path` varchar(200) NOT NULL COMMENT '文件路径',
`file_url` varchar(200) NOT NULL COMMENT '文件地址',
`is_loaded` int(10) NOT NULL DEFAULT '0' COMMENT '是否加载',
`load_time` datetime COMMENT '加载时间',
`remark` text COMMENT '备注',
PRIMARY KEY (`uploadlog_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='设备上传表' AUTO_INCREMENT=6;

-- --------------------------------------------------------

--
-- 表的结构 `smpss_device`
--

CREATE TABLE IF NOT EXISTS `smpss_device` (
`device_id` int(10) NOT NULL AUTO_INCREMENT,
`id_code` varchar(50) NOT NULL COMMENT '识别码',
`district_id` int(10) NOT NULL COMMENT '区县标识',
`hospital_id` int(10) COMMENT '医院标识',
`hospital_name` varchar(200) COMMENT '医院名称',
`office_id` int(10) COMMENT '科室标识',
`supplier_id` int(10)COMMENT '供应商标识',
`model_id` int(10) COMMENT '型号标识',
`serial_code` varchar(50) NOT NULL COMMENT '仪器序号',
`qrcode` varchar(50) NOT NULL COMMENT '仪器二维码',
`service_level` varchar(50) NOT NULL COMMENT '维修级别',
`instruction` varchar(200) NOT NULL COMMENT '说明',
`install_time` varchar(200) NOT NULL COMMENT '装机时间',
`warranty_period` varchar(200) NOT NULL COMMENT '保修年限',
`warranty_time` varchar(200) NOT NULL COMMENT '保修日期',
`code` varchar(200) COMMENT '仪器编号',
`supplier_install_order_id` varchar(200) COMMENT '厂家安装单号',
`company_install_order_id` varchar(200) COMMENT '公司安装单号',
`saler_name` varchar(50) NOT NULL COMMENT '销售',
`reagent_source` varchar(50) NOT NULL COMMENT '试剂来源',
`deliveryman` varchar(200) COMMENT '送货',
`serviceman` varchar(200) COMMENT '维修',
`applyman` varchar(200) COMMENT '应用',
`service_period` varchar(200) COMMENT '保养周期',
`apply_period` varchar(200) COMMENT '应用周期',
`create_time` datetime NOT NULL COMMENT '创建时间',
`admin_id` int(10) NOT NULL COMMENT '用户标识',
`modify_time` datetime COMMENT '修改时间',
`remark` text COMMENT '备注',
PRIMARY KEY (`device_id`),
UNIQUE KEY `UQ_smpss_device_serial_code` (`serial_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='仪器表' AUTO_INCREMENT=6;

-- --------------------------------------------------------

--
-- 表的结构 `smpss_admin`
--

CREATE TABLE IF NOT EXISTS `smpss_admin` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `admin_name` char(16) NOT NULL,
  `admin_pwd` char(32) NOT NULL,
  `gid` int(1) NOT NULL COMMENT '管理用户组ID',
  `order_company` int(10) COMMENT '接单公司',
  `createtime` int(10) NOT NULL COMMENT '创建时间',
  `lastlogintime` int(10) NOT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员表' AUTO_INCREMENT=5;

--
-- 转存表中的数据 `smpss_admin`
--

INSERT INTO `smpss_admin` (`admin_name`, `admin_pwd`, `gid`, `createtime`, `lastlogintime`) VALUES
('admin', '21218cca77804d2ba1922c33e0151105', 1, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_group`
--

CREATE TABLE IF NOT EXISTS `smpss_group` (
  `gid` int(10) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(60) NOT NULL,
  `action_code` text NOT NULL COMMENT '权限范围',
  `state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0禁用 1可以',
  PRIMARY KEY (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理组权限表' AUTO_INCREMENT=4;

--
-- 转存表中的数据 `smpss_group`
--

INSERT INTO `smpss_group` (`gid`, `group_name`, `action_code`, `state`) VALUES
(1, '超级管理员', 'a:3:{s:3:"all";i:0;s:6:"action";a:24:{i:0;s:14:"district_index";i:1;s:20:"district_adddistrict";i:2;s:14:"hospital_index";i:3;s:20:"hospital_addhospital";i:4;s:20:"hospital_officeindex";i:5;s:18:"hospital_addoffice";i:6;s:14:"supplier_index";i:7;s:20:"supplier_addsupplier";i:8;s:19:"supplier_modelindex";i:9;s:17:"supplier_addmodel";i:10;s:18:"user_hospitalindex";i:11;s:18:"user_engineerindex";i:12;s:11:"order_index";i:13;s:12:"device_index";i:14;s:16:"device_adddevice";i:15;s:15:"device_logindex";i:16;s:13:"account_index";i:17;s:18:"account_addaccount";i:18;s:17:"account_modifypwd";i:19;s:12:"system_index";i:20;s:14:"system_setting";i:21;s:13:"system_rights";i:22;s:16:"system_addrights";i:23;s:10:"system_log";}s:4:"menu";a:8:{s:8:"district";a:2:{s:5:"index";s:12:"区县管理";s:11:"adddistrict";s:12:"添加区县";}s:8:"hospital";a:4:{s:5:"index";s:12:"医院管理";s:11:"addhospital";s:12:"添加医院";s:11:"officeindex";s:12:"科室管理";s:9:"addoffice";s:12:"添加科室";}s:8:"supplier";a:4:{s:5:"index";s:15:"供应商管理";s:11:"addsupplier";s:15:"添加供应商";s:10:"modelindex";s:12:"型号管理";s:8:"addmodel";s:12:"添加型号";}s:4:"user";a:2:{s:13:"hospitalindex";s:18:"医院用户管理";s:13:"engineerindex";s:21:"工程部用户管理";}s:5:"order";a:1:{s:5:"index";s:12:"订单管理";}s:6:"device";a:3:{s:5:"index";s:12:"仪器管理";s:9:"adddevice";s:12:"导入仪器";s:8:"logindex";s:12:"查询历史";}s:7:"account";a:3:{s:5:"index";s:12:"账号管理";s:10:"addaccount";s:12:"添加账号";s:9:"modifypwd";s:12:"密码修改";}s:6:"system";a:5:{s:5:"index";s:12:"系统信息";s:7:"setting";s:12:"系统配置";s:6:"rights";s:12:"权限管理";s:9:"addrights";s:15:"添加管理组";s:3:"log";s:12:"系统日志";}}}', 1);

-- --------------------------------------------------------

--
-- 表的结构 `smpss_log`
--

CREATE TABLE IF NOT EXISTS `smpss_log` (
  `log_id` int(10) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL COMMENT '日志类型：1区县管理 2医院管理 3供应商管理 4微信用户管理 5订单管理',
  `object_id` int(10) NOT NULL COMMENT '对象ID',
  `content` text NOT NULL,
  `user_id` int(10) NOT NULL,
  `username` varchar(32) NOT NULL,
  `dateymd` date NOT NULL,
  `dateline` int(10) NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `dateymd` (`dateymd`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理日志表' AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- 表的结构 `smpss_system`
--

CREATE TABLE IF NOT EXISTS `smpss_system` (
  `sysname` varchar(100) NOT NULL,
  `options` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统配置信息表';
