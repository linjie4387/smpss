<?php /* Smarty version 2.6.26, created on 2016-10-25 15:45:23
         compiled from simpla/hospital/forecast_detail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/hospital/forecast_detail.html', 31, false),array('modifier', 'cat', 'simpla/hospital/forecast_detail.html', 89, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.promote {
	display: none;
}

.edit-label {
	background-color:transparent;
	border:none;
}
.text-center {
	text-align:center;
}
</style>
<div id="main-content">
	<h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
	<p id="page-intro">1.你可以在这里查询科室安全库存预测，并打印科室安全库存预测单。</p>
	<div class="clear"></div>
	<div class="content-box">
		<div class="content-box-header">
			<h3>科室安全库存预测</h3>
			<ul class="content-box-tabs">
	            <li><a href="#" class="default-tab">科室安全库存预测</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="content-box-content">
			<div class="tab-content default-tab" id="tab1">
				<div class="form">
					<form action="<?php echo smarty_function_get_url(array('rule' => '/hospital/addforecast'), $this);?>
" onsubmit="return save();" method="post" id="js-form">
						<fieldset class="clearfix">
							<input type="hidden" value="<?php echo $this->_tpl_vars['office']['office_id']; ?>
" name="office_id" /> 
							<h3 class="text-center">
								<?php echo $this->_tpl_vars['forecast']['hospital_name']; ?>
_<?php echo $this->_tpl_vars['forecast']['office_name']; ?>

								<p>安全库存预测</p>
							</h3>
							
							<hr/>
							<table>
								<thead>
									<tr>
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
										<th>前安全库存</th>
										<th>安全库存</th>
										<th>确认数</th>
										<th>备注</th>
									</tr>
								</thead>
								<tbody>
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
									<tr>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['goods_name']; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['specification']; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['unit']; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['firstMon']; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['secondMon']; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['thirdMon']; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['avg']+0.0; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['safe_stock_ratio']+0.0; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['last_safe_stock']+0.0; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['safe_stock']+0.0; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['confirm_quantity']+0.0; ?>
</td>
										<td><?php echo $this->_tpl_vars['detailList'][$this->_sections['i']['index']]['remark']; ?>
</td>
									</tr>
									<?php endfor; endif; ?>
								</tbody>
							</table>
							<div style="padding:10px 0px;">
								<input type="button" onclick="javascript:print();" id="button" class="button" value="打印预览" /> 
							</div>
						</fieldset>
					</form>
				</div>
			</div>
			<!-- End #tab1 -->
		</div>
		<!-- End .content-box-content -->
	</div>
	<script>
	function print(){
		window.location="<?php echo smarty_function_get_url(array('rule' => '/hospital/forecastdetail','data' => ((is_array($_tmp=((is_array($_tmp='sid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['forecast']['id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['forecast']['id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&print=1') : smarty_modifier_cat($_tmp, '&print=1'))), $this);?>
";
	}
	</script>
	<!-- End .content-box -->
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/copy.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>