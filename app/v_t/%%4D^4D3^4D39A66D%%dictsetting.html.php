<?php /* Smarty version 2.6.26, created on 2017-02-03 14:30:07
         compiled from simpla/system/dictsetting.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/system/dictsetting.html', 11, false),)), $this); ?>
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
  <p id="page-intro">字典数据配置, 已经增加的值不可以删除!</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>字典配置</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/system/log",'data' => "key_id=1005"), $this);?>
" <?php if ($this->_tpl_vars['key_id'] == 1005): ?>class="default-tab"<?php endif; ?>>接单公司配置</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <div class="form">
                <form action="<?php echo smarty_function_get_url(array('rule' => '/system/dictsetting'), $this);?>
" method="post" id="js-form">
                    <fieldset class="clearfix">
                        <input type="hidden" value="<?php echo $this->_tpl_vars['key_id']; ?>
" name="key_id" />
                        <ul>
                            <table id="myTable">
                                <thead>
                                    <tr>
                                        <th>值</th>
                                        <th>名称</th>
                                        <th>描述</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['datalist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                        <td><input type="text" value="<?php echo $this->_tpl_vars['datalist'][$this->_sections['i']['index']]['value']; ?>
" class="text-input small-input" name="companylist[value][]" readonly="true" /></td>
                                        <td><input type="text" value="<?php echo $this->_tpl_vars['datalist'][$this->_sections['i']['index']]['name']; ?>
" class="text-input medium-input" name="companylist[name][]" /></td>
                                        <td><input type="text" value="<?php echo $this->_tpl_vars['datalist'][$this->_sections['i']['index']]['key_desc']; ?>
" class="text-input medium-input" name="companylist[key_desc][]" /></td>
                                    </tr>
                                    <?php endfor; endif; ?>
                                </tbody>
                            </table>
                        </ul>
                        <dt>
                            <a href="#" name="addRow">新增接单公司</a><br/><br/>
                            <input type="submit" name="" id="button" class="button" value="保存" />
                        </dt>
                    </fieldset>
                </form>
            </div>
        </div>
        <!-- End #tab1 --> 
    </div>
    <!-- End .content-box-content --> 
  </div>
  <script type="text/javascript">
      <!-- jQuery Code will go underneath this -->
      $(document).ready(function () {
                        // Code between here will only run when the document is ready
                        $("a[name=addRow]").click(function() {
                                                  // Code between here will only run
                                                  //when the a link is clicked and has a name of addRow
                                                  $("table#myTable tr:last").after("<tr><td><input type='text' value='' class='text-input small-input' name=\"companylist[value][]\" /></td><td><input type='text' value='' class='text-input medium-input' name=\"companylist[name][]\" /></td><td><input type='text' value='' class='text-input medium-input' name=\"companylist[key_desc][]\" /></td></tr>");
                                                  return false;
                                                  });
                        });
  </script>
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