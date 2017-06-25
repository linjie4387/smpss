<?php /* Smarty version 2.6.26, created on 2017-05-10 11:40:59
         compiled from simpla/hospital/print.html */ ?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>正式订单下单凭证打印</title>
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="正式订单下单凭证打印">
<meta name="msapplication-TileColor" content="#0e90d2">

<link rel="stylesheet"
	href="http://cdn.amazeui.org/amazeui/2.4.2/css/amazeui.min.css">
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<style>
body {
	max-width: 1024px;
	background-color: #FFFFFF;
	margin: 0 auto;
	color: #333;
}
.content {
	font-family: serif;
	font-size:small;
}
.w-100 {
	width: 100%;
}

.blank-1 {
	width: 100%;
	height: 1em;
}

.am-text-center, th{
	text-align: center;
}

.a-left{
	text-align: left;
	line-height:100%;
}
table {
	width:100%;
	text-align:center;
	border:1px solid #999;
	font-size:14px !important;
}
thead tr{
	height:3em;
	background-color:#ddd;
}
tr {
	height:2em;
}
td,th {
	padding:5px;
	border:1px solid #999;
}

.PageNext {
	page-break-after: always;
}

.table-top {}
.table-top .title { width: 30%;float: left;margin: 10px 0;height: 60px;line-height: 60px;}
.table-top .remark {width: 70%;float: right;font-size: 14px;font-weight: 700;}
.table-top .remark .content { text-align: right;text-decoration: underline;height: 30px;line-height: 30px;margin-right:50px;}
.table-top .remark .linkman { width: 70%;float: left;text-align: left;height: 30px;line-height: 30px;padding-left:30%;}
.table-top .remark .date{ width: 30%;float: right;text-align: left;height: 30px;line-height: 30px;}

.barcode {position:absolute;left:25px;top:1em;width:100px;}
</style>
</head>
<body>
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['officegoodsList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<?php if (( $this->_sections['i']['index']%20 ) == 0): ?>
	<div class="w-100 am-text-center" style="padding: 0 25px;position:relative;">
		<div class="blank-1 "></div>
		<h2><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/barcode.jpeg" style="position:absolute;left:35px;top:2em;width:70px;" /><?php echo $this->_tpl_vars['office']['hospital_name']; ?>
</h2>
        <div class="table-top">
  			<div class="title"><h4 class="a-left">科室：<?php echo $this->_tpl_vars['office']['name']; ?>
</h4></div>
  			<div class="remark">
            	<div class="content">备注：所供试剂效期默认三个月以上，如低于会另行告知</div>
				<div class="linkman">联系人：</div>
  				<div class="date">日期：</div>
			</div>
		</div>
        
		<table>
			<thead>
				<tr>
					<th>序号</th>
					<th>商品名称</th>
					<th>规格</th>
					<th>单位</th>
					<th style="max-width:40px;">安全库存</th>
					<th style="max-width:40px;">实际库存</th>
					<th style="max-width:40px;">确认数量</th>
					<th>备注</th>
				</tr>
			</thead>
			<tbody>
				<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['officegoodsList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['start'] = (int)$this->_sections['i']['index'];
$this->_sections['j']['max'] = (int)20;
$this->_sections['j']['show'] = true;
if ($this->_sections['j']['max'] < 0)
    $this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
if ($this->_sections['j']['start'] < 0)
    $this->_sections['j']['start'] = max($this->_sections['j']['step'] > 0 ? 0 : -1, $this->_sections['j']['loop'] + $this->_sections['j']['start']);
else
    $this->_sections['j']['start'] = min($this->_sections['j']['start'], $this->_sections['j']['step'] > 0 ? $this->_sections['j']['loop'] : $this->_sections['j']['loop']-1);
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = min(ceil(($this->_sections['j']['step'] > 0 ? $this->_sections['j']['loop'] - $this->_sections['j']['start'] : $this->_sections['j']['start']+1)/abs($this->_sections['j']['step'])), $this->_sections['j']['max']);
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
				<tr>
					<td><?php echo $this->_sections['j']['index']+1; ?>
</td>
					<td class="a-left"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['j']['index']]['name']; ?>
</td>
					<td style="line-height:100%;min-width:75px;"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['j']['index']]['specification']; ?>
</td>
					<td><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['j']['index']]['unit']; ?>
</td>
					<td style="max-width:40px;"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['j']['index']]['safe_stock']+0.0; ?>
</td>
					<td style="max-width:40px;"></td>
					<td style="max-width:40px;"></td>
					<td style="line-height:95%;"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['j']['index']]['remark']; ?>
 <?php if (( $this->_tpl_vars['officegoodsList'][$this->_sections['j']['index']]['is_20l'] ) == 1): ?>库存空间：<?php echo $this->_tpl_vars['office']['space']; ?>
L<?php endif; ?></td>
				</tr>
				<?php endfor; endif; ?>
			</tbody>
		</table>
	</div>
	<div class="PageNext"></div>
	<?php endif; ?>
	<?php endfor; endif; ?>
</body>
</html>