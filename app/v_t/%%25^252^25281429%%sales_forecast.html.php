<?php /* Smarty version 2.6.26, created on 2017-06-02 16:31:59
         compiled from simpla/hospital/sales_forecast.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/hospital/sales_forecast.html', 12, false),array('modifier', 'cat', 'simpla/hospital/sales_forecast.html', 12, false),)), $this); ?>
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
<div id="main-content">
    <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
    <p id="page-intro">查看和管理所有安全库存预测单。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>安全库存预测查询</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">历史预测</a></li>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/hospital/forecast','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['office_id']))), $this);?>
" >添加安全库存预测</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/hospital/officeindex'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                    <p>创建日期： <span>
                    <input type="text" value="<?php echo $this->_tpl_vars['stime']; ?>
" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text-input min-input" name="stime" id="stime" />
                    -<input type="text" value="<?php echo $this->_tpl_vars['etime']; ?>
" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text-input min-input" name="etime" id="etime" />
                </span><small>(格式：2012-01-01)</small>
                    <input type="submit" name="" id="btnQry" class="button" value="查询" />
                    <input type="button" onclick="add_forecast();" id="btnAdd" class="button" value="添加安全库存预测" /> 
            </fieldset>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>单据编号</th>
                <th>创建管理员</th>
                <th>创建时间</th>
                <th>管理</th>
              </tr>
            </thead>
            <tbody>
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['forecastList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['forecastList'][$this->_sections['i']['index']]['bill_no']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['forecastList'][$this->_sections['i']['index']]['admin_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['forecastList'][$this->_sections['i']['index']]['create_time']; ?>
</td>
                  <td>
                  	<a href="<?php echo smarty_function_get_url(array('rule' => '/hospital/forecastdetail','data' => ((is_array($_tmp='sid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['forecastList'][$this->_sections['i']['index']]['id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['forecastList'][$this->_sections['i']['index']]['id']))), $this);?>
" title="查看详情">
                  		<i class="icon-external-link">查看详情</i>
                  	</a>
                  </td>
                </tr>
                <?php endfor; endif; ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="4"><?php echo $this->_tpl_vars['pagebar']; ?>
</td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
      </form>
    </div>
    <script>
		function add_forecast(){
			window.location.href = "<?php echo smarty_function_get_url(array('rule' => '/hospital/forecast','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['office_id']))), $this);?>
";
		}
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