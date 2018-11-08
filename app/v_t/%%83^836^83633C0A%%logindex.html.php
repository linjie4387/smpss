<?php /* Smarty version 2.6.26, created on 2017-02-27 22:45:06
         compiled from simpla/reagent/logindex.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/reagent/logindex.html', 11, false),)), $this); ?>
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
    <p id="page-intro">查看和管理试剂文件上传历史。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>更新记录</h3>
        <ul class="content-box-tabs">
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/reagent/index"), $this);?>
">试剂查询</a></li>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/reagent/addreagent"), $this);?>
">导入试剂</a></li>
            <li><a href="#tab1" class="default-tab">更新记录</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/reagent/logindex'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                <p>开始时间： <span>
                    <input type="text" value="<?php echo $this->_tpl_vars['stime']; ?>
" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text-input min-input" name="stime" />
                </span>&nbsp;结束时间： <span>
                    <input type="text" value="<?php echo $this->_tpl_vars['etime']; ?>
" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="text-input min-input" name="etime" />
                </span><small>(格式：2012-01-01)</small>&nbsp;
                <input type="submit" name="" id="button" class="button" value="查询" />
                </span> </p>
            </fieldset>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>上传时间</th>
                <th>管理员</th>
                <th>文件名</th>
                <th>是否加载</th>
                <th>加载时间</th>
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
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['uploadlogList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['uploadlogList'][$this->_sections['i']['index']]['upload_time']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['uploadlogList'][$this->_sections['i']['index']]['admin_name']; ?>
</td>
                  <td><a href="<?php echo $this->_tpl_vars['uploadlogList'][$this->_sections['i']['index']]['file_url']; ?>
" title="文件"><?php echo $this->_tpl_vars['uploadlogList'][$this->_sections['i']['index']]['file_name']; ?>
</a></td>
                  <td><?php echo $this->_tpl_vars['uploadlogList'][$this->_sections['i']['index']]['is_loaded_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['uploadlogList'][$this->_sections['i']['index']]['load_time']; ?>
</td>
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