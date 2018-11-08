<?php /* Smarty version 2.6.26, created on 2017-11-28 21:26:34
         compiled from simpla/hospital/addofficegoods.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/hospital/addofficegoods.html', 14, false),array('modifier', 'cat', 'simpla/hospital/addofficegoods.html', 33, false),)), $this); ?>
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

</style>
<div id="main-content">
	<h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
	<p id="page-intro">1.你可以在这里为科室分配商品。</p>
	<div class="clear"></div>
	<div class="content-box">
		<div class="content-box-header">
			<h3>添加科室商品</h3>
			<ul class="content-box-tabs">
				<li><a href="<?php echo smarty_function_get_url(array('rule' => '/hospital/setofficegoods-hid'), $this);?>
-<?php echo $this->_tpl_vars['office']['hospital_id']; ?>
-oid-<?php echo $this->_tpl_vars['office']['office_id']; ?>
">科室商品列表</a></li>
	            <li><a href="#" class="default-tab">添加科室商品</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="content-box-content">
			<div class="tab-content default-tab" id="tab1">
				<div class="form">
					<form action="<?php echo smarty_function_get_url(array('rule' => '/hospital/setofficegoods'), $this);?>
" method="post" id="qry-form">
						<fieldset class="clearfix">
							<input type="hidden" value="<?php echo $this->_tpl_vars['office']['office_id']; ?>
" name="office_id" /> 
							<input type="hidden" value="<?php echo $this->_tpl_vars['order_id']; ?>
" name="order_id" />
							<p>
                            	厂商：
								<input type="text" class="text-input small-input" id="manu" name="manu" value="<?php echo $this->_tpl_vars['manu']; ?>
"/>
								&nbsp;&nbsp;项目品类:
								<input type="text" class="text-input small-input" id="category" name="category" value="<?php echo $this->_tpl_vars['category']; ?>
"/> 
                                &nbsp;&nbsp;关键字：
                                <input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" placeholder="编码，名称，备注" class="text-input small-input" name="key" />
								<input type="submit" class="button" formaction="<?php echo smarty_function_get_url(array('rule' => '/hospital/addofficegoods','data' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['office']['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['office']['office_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&orderid=') : smarty_modifier_cat($_tmp, '&orderid=')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order_id']))), $this);?>
" value="查询" />
							</p>
						</fieldset>
							<input type="hidden" value="<?php echo $this->_tpl_vars['office']['office_id']; ?>
" name="office_id" /> 
							<input type="hidden" value="<?php echo $this->_tpl_vars['order_id']; ?>
" name="order_id" />
							<table>
								<thead>
									<tr>
										<th><input type="checkbox" name="comfig_all" id="check_all"></th>
										<th>商品名称</th>
										<th>商品编号</th>
										<th>单位</th>
										<th>规格</th>
										<th>厂商全名</th>
										<th>适用机型</th>
										<th>项目品类</th>
									</tr>
								</thead>
								<hr />
								<tbody>
									<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['goodsList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
									<td><input class="row-check" type="checkbox" name="officegoods[]" value="<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_id']; ?>
"></td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['name']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_no']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['unit']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['specification']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['manu']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['machine']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['category']; ?>
</td>
									</tr>
									<?php endfor; endif; ?>
								</tbody>
								<tfoot>
					              <tr>
					                <td colspan="5"><?php echo $this->_tpl_vars['pagebar']; ?>
</td>
					              </tr>
					            </tfoot>
							</table>
						<input type="submit" class="button" onclick="addOfficeGoods();" value="确认添加" />
					</form>
				</div>
			</div>
			<!-- End #tab1 -->
		</div>
		<!-- End .content-box-content -->
	</div>
	<script>
		//全选
		$(function(){
			$("#check_all").change(function(){
				$('.row-check').prop("checked",this.checked); 
			});
		});
		
		//确认添加
		function addOfficeGoods(){
			if($("input:checkbox[class='row-check'][checked]").length<=0){
				jQuery.facebox("请选择需要添加的科室商品！");
				return;
			}
			return true;
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