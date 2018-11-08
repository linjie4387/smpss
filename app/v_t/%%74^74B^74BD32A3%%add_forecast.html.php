<?php /* Smarty version 2.6.26, created on 2017-02-06 14:06:39
         compiled from simpla/hospital/add_forecast.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/hospital/add_forecast.html', 27, false),array('modifier', 'cat', 'simpla/hospital/add_forecast.html', 27, false),)), $this); ?>
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

.w-large {max-width:150px;}
.w-small {max-width:50px;}
</style>
<div id="main-content">
	<h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
	<p id="page-intro">1.你可以在这里新增科室安全库存预测，并打印科室安全库存预测单。</p>
	<div class="clear"></div>
	<div class="content-box">
		<div class="content-box-header">
			<h3>科室安全库存预测</h3>
			<ul class="content-box-tabs">
				<li><a href="<?php echo smarty_function_get_url(array('rule' => '/hospital/forecastofficegoods','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['office']['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['office']['office_id']))), $this);?>
" >历史安全库存预测</a></li>
	            <li><a href="#" class="default-tab">安全库存预测</a></li>
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
								<?php echo $this->_tpl_vars['office']['hospital_name']; ?>
_<?php echo $this->_tpl_vars['office']['name']; ?>

								<p>安全库存预测</p>
							</h3>
							
							<hr/>
							<table>
								<thead>
									<tr>
										<th class="w-large">商品名称</th>
										<th>规格</th>
										<th>单位</th>
										<th><?php echo $this->_tpl_vars['firstMon']; ?>
月</th>
										<th><?php echo $this->_tpl_vars['secondMon']; ?>
月</th>
										<th><?php echo $this->_tpl_vars['thirdMon']; ?>
月</th>
										<th>平均</th>
										<th>倍数</th>
										<th>前安全库存</th>
										<th>安全库存</th>
										<th>浮动</th>
										<th class="w-small">确认数</th>
										<th>备注</th>
									</tr>
								</thead>
								<tbody>
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
									<tr>
										<td class="w-large" id="gn_<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['name']; ?>
</td>
										<td id="gs_<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['specification']; ?>
</td>
										<td id="gu_<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['unit']; ?>
</td>										
										<td id="first_<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['firstMon']; ?>
</td>
										<td id="second_<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['secondMon']; ?>
</td>
										<td id="third_<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['thirdMon']; ?>
</td>
										<td id="avg_<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['avg']; ?>
</td>
										<td><?php echo $this->_tpl_vars['office']['safe_stock_ratio']; ?>
</td>
										<td><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['last_safe_stock']; ?>
</td>
										<td><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['safe_stock']+0.0; ?>
</td>
										<td <?php if ($this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['percent'] > 25): ?>style="color:red" <?php endif; ?>>
										<?php if ($this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['percent']): ?>
											<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['percent']; ?>
%
										<?php else: ?>
											-
										<?php endif; ?>
										</td>
										<td class="w-small">
                                        <input type="number" min="0" data="<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
" id="c_<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
" class="medium-input stock" value="<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['confirm_quantity']+0.0; ?>
"/></td>
										<td id="gr_<?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
"><?php echo $this->_tpl_vars['officegoodsList'][$this->_sections['i']['index']]['remark']; ?>
</td>
									</tr>
									<?php endfor; endif; ?>
								</tbody>
							</table>
							<div style="padding:10px 0px;">
								<input type="button" onclick="javascript:save();" id="button" class="button" value="保存" /> 
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
	//修改库存数量
	$(function(){
		$(".stock").change(function(){
			change($(this).attr('data'));
		});
		$(".safe").change(function(){
			change($(this).attr('data'));
		});
	});
	function change(goods_id){
		var stock = Math.ceil($("#k_"+goods_id).val());
		var safe = Math.ceil($("#s_"+goods_id).val());
		$("#k_"+goods_id).val(stock);
		$("#s_"+goods_id).val(safe);
		var o_quantity = (safe-stock);
		if(o_quantity>=0) {
			$("#o_"+goods_id).val(o_quantity);
			$("#c_"+goods_id).val(o_quantity);
		}else {
			$("#o_"+goods_id).val(0);
			$("#c_"+goods_id).val(0);
		}
	}
	function save(){
		if(!confirm("确认要提交本次销售预测吗？")){
			return false;
		}
		var forecast_detail =new Array();
		$(".stock").each(function(){
			var goods_id = $(this).attr('data');
			var goods_name = $("#gn_"+goods_id).html();
			var specification = $("#gs_"+goods_id).html();
			var unit = $("#gu_"+goods_id).html();
			var remark = $("#gr_"+goods_id).html();
			var detail = {
					"goods_id":goods_id,
					"goods_name":goods_name,
					"specification":specification,
					"unit":unit,
					"remark":remark,
					"firstMon":$("#first_"+goods_id).html(),
					"secondMon":$("#second_"+goods_id).html(),
					"thirdMon":$("#third_"+goods_id).html(),
					"avg":$("#avg_"+goods_id).html(),
					"confirm_quantity":$("#c_"+goods_id).val()
					};
			forecast_detail.push(detail);
		});
		//alert("<?php echo smarty_function_get_url(array('rule' => '/hospital/forecastdetail','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['office']['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['office']['office_id']))), $this);?>
"+"?sid=121");
		//return;
		$.post("<?php echo smarty_function_get_url(array('rule' => '/hospital/addforecast'), $this);?>
",{
			office_id : "<?php echo $this->_tpl_vars['office']['office_id']; ?>
",
			goods_list:forecast_detail
		},function(res){
			if(res.code == 0){
				window.location="<?php echo smarty_function_get_url(array('rule' => '/hospital/forecastdetail'), $this);?>
-sid-"+res.data+".html";
			}else{
				jQuery.facebox(res.msg);
			}
		},'json');
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