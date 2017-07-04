<?php /* Smarty version 2.6.26, created on 2017-05-19 14:03:02
         compiled from simpla/system/log.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/system/log.html', 11, false),)), $this); ?>
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
  <p id="page-intro">系统日志信息！</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>系统日志</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/system/log",'data' => "type=2"), $this);?>
" <?php if ($this->_tpl_vars['type'] == 2): ?>class="default-tab"<?php endif; ?>>医院管理记录</a></li>
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/system/log",'data' => "type=3"), $this);?>
" <?php if ($this->_tpl_vars['type'] == 3): ?>class="default-tab"<?php endif; ?>>商品管理记录</a></li>
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/system/log",'data' => "type=5"), $this);?>
" <?php if ($this->_tpl_vars['type'] == 5): ?>class="default-tab"<?php endif; ?>>医院订单管理记录</a></li>
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/system/log",'data' => "type=4"), $this);?>
" <?php if ($this->_tpl_vars['type'] == 4): ?>class="default-tab"<?php endif; ?>>微信用户管理记录</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
		<div class="form">
          <form id="js-form" method="post" action="<?php echo smarty_function_get_url(array('rule' => '/system/log','data' => "type=".($this->_tpl_vars['type'])), $this);?>
">
            <fieldset class="clearfix">
              <p>开始时间： <span>
                <input type="text" value="<?php echo $this->_tpl_vars['stime']; ?>
" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text-input min-input" name="stime" />
                </span>&nbsp;结束时间： <span>
                <input type="text" value="<?php echo $this->_tpl_vars['etime']; ?>
" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text-input min-input" name="etime" />
                </span><small>(格式：2012-01-01)</small> <input type="submit" name="" id="button" class="button" value="查询" /></p>
            </fieldset>
          </form>
        </div>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>操作者</th>
              <th>操作内容</th>
              <th>时间</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td colspan="5"><?php echo $this->_tpl_vars['pagebar']; ?>
</td>
            </tr>
          </tfoot>
          <tbody>
          <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['log']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <td><?php echo $this->_tpl_vars['log'][$this->_sections['i']['index']]['log_id']; ?>
</td>
            <td><?php echo $this->_tpl_vars['log'][$this->_sections['i']['index']]['username']; ?>
</td>
            <td><?php echo $this->_tpl_vars['log'][$this->_sections['i']['index']]['content']; ?>
</td>
            <td><?php echo $this->_tpl_vars['log'][$this->_sections['i']['index']]['dateymd']; ?>
</td>
          </tr>
          <?php endfor; else: ?>
          <tr>
            <td colspan="5">无日志</td>
          </tr>
          <?php endif; ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/copy.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>