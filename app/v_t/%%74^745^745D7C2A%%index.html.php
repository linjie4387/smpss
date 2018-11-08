<?php /* Smarty version 2.6.26, created on 2017-09-24 11:02:17
         compiled from simpla/device/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/device/index.html', 12, false),array('modifier', 'cat', 'simpla/device/index.html', 65, false),)), $this); ?>
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
    <p id="page-intro">查看和管理所有仪器。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>仪器查询</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">仪器查询</a></li>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/device/adddevice"), $this);?>
">导入仪器</a></li>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/device/logindex"), $this);?>
">更新记录</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/device/index'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                <p>供应商： <span>
                    <select id="one" name="supplier_id">
                        <option value="0">-----选择供应商-----</option>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['supplierList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <option value="<?php echo $this->_tpl_vars['supplierList'][$this->_sections['i']['index']]['supplier_id']; ?>
" <?php if ($this->_tpl_vars['supplierList'][$this->_sections['i']['index']]['supplier_id'] == $this->_tpl_vars['supplier_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['supplierList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['supplierList'][$this->_sections['i']['index']]['code']; ?>
</option>
                        <?php endfor; endif; ?>
                    </select></span>&nbsp;关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" />
                    <span>（医院名称，仪器序号）<input type="submit" name="" id="button" class="button" value="查询" /></span></p>
            </fieldset>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>仪器序号</th>
                <th>区县</th>
                <th>医院</th>
                <th>科室</th>
                <th>供应商</th>
                <th>型号</th>
                <th>仪器编号</th>
                <th>联系人</th>
                <th>联系电话</th>
                <th>管理</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td colspan="6"><?php echo $this->_tpl_vars['pagebar']; ?>
</td>
              </tr>
            </tfoot>
            <tbody>
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['deviceList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['serial_code']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['district_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['hospital_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['office_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['supplier_code']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['model_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['code']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['contact_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['contact_phone']; ?>
</td>
                  <td><a href="<?php echo smarty_function_get_url(array('rule' => '/device/devicedetail','data' => ((is_array($_tmp='did=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['device_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['device_id']))), $this);?>
" title="查询详情"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/info.png" alt="查询详情" /></a></td>
                </tr>
                <?php endfor; endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      </form>
    </div>
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