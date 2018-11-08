<?php /* Smarty version 2.6.26, created on 2016-10-24 21:46:27
         compiled from simpla/hospital/print_forecast.html */ ?>
<!doctype html>
<html class="no-js">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>安全库存预测单打印</title>
<meta name="renderer" content="webkit">
<meta http-equiv="Cache-Control" content="no-siteapp">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="安全库存预测单打印">
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
}
table {
	width:100%;
	text-align:center;
	border:1px solid #999;
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

.w-3 {
	width:33.33%;
	display: inline-block;
}
.PageNext {
	page-break-after: always;
}
</style>
</head>
<body>
	<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['detailList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<div class="w-100 am-text-center">
		<div class="blank-1 "></div>
		<h2><?php echo $this->_tpl_vars['forecast']['hospital_name']; ?>
</h2>
		<div style="width:100%"><span class="w-3 a-left">科室：<?php echo $this->_tpl_vars['forecast']['office_name']; ?>
</span><span class="w-3">制单人：</span><span class="w-3">日期：</span></h4></div>
		<table>
			<thead>
				<tr>
					<th>序号</th>
					<th>商品名称</th>
					<th>规格</th>
					<th>单位</th>
					<th><?php echo $this->_tpl_vars['firstMon']; ?>
月</th>
					<th><?php echo $this->_tpl_vars['secondMon']; ?>
月</th>
					<th><?php echo $this->_tpl_vars['thirdMon']; ?>
月</th>
					<th>前三月均数</th>
					<th>安全倍数</th>
					<th>安全库存量</th>
					<th>确认数量</th>
					<th>备注</th>
				</tr>
			</thead>
			<tbody>
				<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['detailList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<td class="a-left"><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['goods_name']; ?>
</td>
					<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['specification']; ?>
</td>
					<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['unit']; ?>
</td>
					<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['firstMon']; ?>
</td>
					<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['secondMon']; ?>
</td>
					<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['thirdMon']; ?>
</td>
					<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['avg']+0.0; ?>
</td>
					<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['safe_stock_ratio']+0.0; ?>
</td>
					<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['safe_stock']+0.0; ?>
</td>
					<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['confirm_quantity']+0.0; ?>
</td>
					<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['j']['index']]['remark']; ?>
</td>
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