<?php /* Smarty version 2.6.26, created on 2017-07-30 09:21:40
         compiled from simpla/order/deliveryprint.html */ ?>
<!doctype html>
<html class="no-js">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>正式订单发货凭证打印</title>
	<meta name="renderer" content="webkit"> 
	<meta http-equiv="Cache-Control" content="no-siteapp"> 
	<meta name="mobile-web-app-capable" content="yes"> 
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="正式订单发货凭证打印">
	<meta name="msapplication-TileColor" content="#0e90d2">

	<link rel="stylesheet" href="http://cdn.amazeui.org/amazeui/2.4.2/css/amazeui.min.css">
	<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
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
	</style>
</head>
<body>
<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['orderpic']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
<section>
    <div>
        <div class="blank-1"></div>
        <div class="info w-100">
            <div><strong>订单号</strong>：<?php echo $this->_tpl_vars['order']['order_id']; ?>
</div>
            <div><strong>医院</strong>：<?php echo $this->_tpl_vars['order']['hospital_name']; ?>
</div>
            <div><strong>科室</strong>：<?php echo $this->_tpl_vars['order']['office_name']; ?>
</div>
            <div><strong>提交人</strong>：<?php echo $this->_tpl_vars['order']['name']; ?>
</div>
            <div><strong>联系电话</strong>：<?php echo $this->_tpl_vars['order']['mobile']; ?>
</div>
            <div><strong>是否代下单</strong>：<?php if ($this->_tpl_vars['order']['is_agent'] == 2): ?>是<?php else: ?>否<?php endif; ?></div>
            <div><strong>确认时间</strong>：<?php echo $this->_tpl_vars['order']['verify_time']; ?>
</div>
            <div><strong>发货时间</strong>：<?php echo $this->_tpl_vars['order']['delivery_time']; ?>
</div>
            <div><strong>发货单号</strong>：<?php echo $this->_tpl_vars['order']['delivery_no']; ?>
</div>
            <div><strong>发票单号</strong>：<?php echo $this->_tpl_vars['order']['invoice_no']; ?>
</div>
        </div>
    </div>
    <div class="blank-1"></div>
    <div style="text-align:center;">
        <div class="pic-box">
           <img id="pic-<?php echo $this->_tpl_vars['orderpic'][$this->_sections['i']['index']]['id']; ?>
" class="pic-obj mw-100" src="<?php echo $this->_tpl_vars['orderpic'][$this->_sections['i']['index']]['pic_url']; ?>
?imageMogr2/rotate/-90">
           <div class="pic-btn-obj">
                <input type="hidden" value="<?php echo $this->_tpl_vars['orderpic'][$this->_sections['i']['index']]['pic_url']; ?>
" class="img-source" />
                <span onClick="rotate_left(this)" class="am-badge am-badge-primary"><i class="am-icon-rotate-left"></i></span>
                <span onClick="rotate_right(this)" class="am-badge am-badge-primary"><i class="am-icon-rotate-right"></i></span>
           </div>
        </div>
    </div>
</section>
<?php if (! $this->_sections['i']['last']): ?>
<!--分页-->
<div class="PageNext"></div>
<?php endif; ?>
<?php endfor; endif; ?>

<div class="blank-1"></div>
<script>
	var initrotate = -90;
	function rotate_left(obj){
		var parent = $(obj).parent();
		var source = parent.find('.img-source').val();
		initrotate = initrotate - 90;
		var src = source + "?imageMogr2/rotate/" + initrotate;
		parent.parent().find('.pic-obj').attr("src",src);
	}
	
	function rotate_right(obj){
		var parent = $(obj).parent();
		var source = parent.find('.img-source').val();
		initrotate = initrotate + 90;
		var src = source + "?imageMogr2/rotate/" + initrotate;
		parent.parent().find('.pic-obj').attr("src",src);
	}
</script>
</body>
</html>