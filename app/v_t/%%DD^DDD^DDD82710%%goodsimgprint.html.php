<?php /* Smarty version 2.6.26, created on 2017-05-10 11:15:05
         compiled from simpla/goods/goodsimgprint.html */ ?>
<!doctype html>
<html class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>商品相关照片打印</title>
	<meta name="renderer" content="webkit"> 
	<meta http-equiv="Cache-Control" content="no-siteapp"> 
	<meta name="mobile-web-app-capable" content="yes"> 
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="正式订单发货凭证打印">
	<meta name="msapplication-TileColor" content="#0e90d2">
	<link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.4.2/css/amazeui.min.css">
	<style>
		body { max-width:1024px;background-color:#FFFFFF;margin:0 auto;color:#333;}
		
		.w-100 { width:100%;}
		.mw-100 { max-width:100%;max-height:800px;}
		.blank-1 { width:100%;height:1em;}
		.am-text-center { text-align:center;}
		
		.info tbody tr td { padding:5px;border:1px solid #555}
		.info div { padding:5px 30px 5px 0;display: inline-block;}
		
		.pic-box { position:relative;display:inline-block;max-width:100%;}
		.pic-box .pic-btn-obj { display:none;position: absolute;top: 10px;left: 10px;}
		.pic-box:hover .pic-btn-obj{ display:block !important;}
		
		.PageNext{page-break-after: always;}
		
		.info img{border: 2px #F0F0F0 solid;}
		
	</style>
</head>
<body>
	
<section>
    <div>
        <div class="blank-1"></div>
        <div class="info w-100">
        	<div><strong>商品标识</strong>：<?php echo $this->_tpl_vars['goods']['goods_no']; ?>
 </div>
            <div><strong>商品名称</strong>：<?php echo $this->_tpl_vars['goods']['name']; ?>
</div>
            <div><strong>规格</strong>：<?php echo $this->_tpl_vars['goods']['specification']; ?>
</div>
            <div><strong>容积</strong>：<?php echo $this->_tpl_vars['goods']['volume']; ?>
</div>
            <div><strong>单位</strong>：<?php echo $this->_tpl_vars['goods']['unit']; ?>
</div>
        </div>
        <div class="info w-100">
        	<div><strong>项目品类</strong>：<?php echo $this->_tpl_vars['goods']['category']; ?>
 </div>
            <div><strong>适用机型</strong>：<?php echo $this->_tpl_vars['goods']['machine']; ?>
</div>
            <div><strong>厂商全名</strong>：<?php echo $this->_tpl_vars['goods']['manu']; ?>
</div>
        </div>
        
        <div class="info w-100">
        	<?php if ($this->_tpl_vars['goods']['img']['regimg'] == ''): ?>暂无商品注册证图片<?php else: ?><p>商品注册证图片</p><img src="<?php echo $this->_tpl_vars['goods']['img']['regimg']; ?>
" width="100%"style="vertical-align: middle;" /><?php endif; ?>
        	<br />
        </div>
        <div class="info w-100">
        	<?php if ($this->_tpl_vars['goods']['img']['noticeimg'] == ''): ?>暂无说明书图片<?php else: ?><p>说明书图片</p><img src="<?php echo $this->_tpl_vars['goods']['img']['noticeimg']; ?>
" width="100%"style="vertical-align: middle;" /><?php endif; ?>
        	<br />
        </div>
        <div class="info w-100">
        	<?php if ($this->_tpl_vars['goods']['img']['labelimg'] == ''): ?>暂无商品标签图片<?php else: ?><p>商品标签图片</p><img src="<?php echo $this->_tpl_vars['goods']['img']['labelimg']; ?>
" width="100%"style="vertical-align: middle;" /><?php endif; ?>
        </div>
        
        
    </div>

</section>

</body>
</html>