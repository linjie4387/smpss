<?php /* Smarty version 2.6.26, created on 2018-04-26 13:47:22
         compiled from simpla/report/order.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/report/order.html', 26, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> 
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.tt {
	overflow: hidden;
	text-overflow: ellipsis;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
}
</style>
<div id="main-content">
	<h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
	<p id="page-intro">按预订单创建时间段导出订单运输统计数据报表。</p>
	<div class="clear"></div>
	<div class="content-box">
		<div class="content-box-header">
			<h3>订单统计</h3>
			<ul class="content-box-tabs">
				<li><a href="#tab1" class="default-tab">运输统计</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="content-box-content">
			<div class="tab-content default-tab" id="tab1">
				<form action="<?php echo smarty_function_get_url(array('rule' => '/report/order'), $this);?>
" method="post" id="js-form">
					<div class="form">
						<fieldset>
							<p>起始日期： 
                    		<input type="text" value="<?php echo $this->_tpl_vars['stime']; ?>
" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text-input min-input" name="stime" id="stime" />
                    		<small>(格式：2017-01-01)</small>
                    		</p>
                    		<p>结束日期： 
                    		<input type="text" value="<?php echo $this->_tpl_vars['etime']; ?>
" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text-input min-input" name="etime" id="etime" />
                			<small>(格式：2017-01-01)</small>
							</p>
							<span><input type="submit" name="" id="button" class="button" value="导出报表" /></span>
						</fieldset>
					</div>
					
				</form>
			</div>
		</div>
	</div>
	<script>
		
	</script>
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