;<?php exit;?>
;配置一共有5个字段，分别用","分割，用":"连接，如果有空格，空格不会被忽略
;host 主机IP，或者主机名
;user 用户名
;database 数据库名
;password 密码
;charset  数据库字符集
;数据库配置有2种，一种是主库(main)，一种是查询库(query)
;你可以配置多个，按示例文件那样，多的就在后面加数字开始

;default 是默认的数据库配置，如果没有找到你获取的zone，比如要在这个文件里找SDb::getConfig("friends")，
;由于friends没有配置，就读取default里的
[default]
;main   =   host:127.0.0.1,port:35306,user:smp73D,database:smpss,password:wPBGC4uJ6CvT7OIe,charset:utf8
;query  =   host:127.0.0.1,port:35306,user:smp73D,database:smpss,password:wPBGC4uJ6CvT7OIe,charset:utf8
;main   =   host:127.0.0.1,port:3306,user:root,database:smpss_mk,password:,charset:utf8,engine:mysql
;query  =   host:127.0.0.1,port:3306,user:root,database:smpss_mk,password:,charset:utf8,engine:mysql
main   =   host:adminmk.chens.mobi,port:25306,user:root,database:smpss_mk,password:w16eqwED,charset:utf8,engine:mysql
query  =   host:adminmk.chens.mobi,port:25306,user:root,database:smpss_mk,password:w16eqwED,charset:utf8,engine:mysql