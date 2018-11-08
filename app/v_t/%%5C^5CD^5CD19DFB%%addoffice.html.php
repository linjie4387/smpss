<?php /* Smarty version 2.6.26, created on 2017-10-24 11:35:56
         compiled from simpla/hospital/addoffice.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/hospital/addoffice.html', 13, false),)), $this); ?>
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
<style>.promote{display:none;}</style>
<div id="main-content">
  <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
  <p id="page-intro">1.你可以在这里添加新的科室或者编辑已有的科室。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>添加科室</h3>
      <ul class="content-box-tabs">
        <!-- 
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/index"), $this);?>
">医院查询</a></li>
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/addhospital"), $this);?>
">添加医院</a></li>
         -->
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/officeindex"), $this);?>
">科室查询</a></li>
        <li><a href="#tab1" class="default-tab">添加科室</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/hospital/addoffice'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['office']['office_id']; ?>
" name="office_id" />
              <p>
              <p>
                <label><font class="red"> * </font>所属医院：</label>
                <select id="one" name="hospital_id">
                    <option value="0">-----选择医院-----</option>
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['hospitalList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <option value="<?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id']; ?>
" <?php if ($this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id'] == $this->_tpl_vars['hospital_id']): ?>selected="selected"<?php endif; ?>>
                        <?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['name']; ?>

                    </option>
                    <?php endfor; endif; ?>
                </select>
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>科室名称：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['office']['name']; ?>
" class="text-input small-input" name="name" id="name" />
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>联系人：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['office']['contact_name']; ?>
" class="text-input small-input" name="contact_name" id="contact_name" />
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>联系电话：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['office']['contact_phone']; ?>
" class="text-input small-input" name="contact_phone" id="contact_phone" />
                <span></span> </p>
               
               <p>
                <label><font class="red"> * </font>库存空间：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['office']['space']; ?>
" class="text-input small-input" name="space" id="space" />
                <span></span> </p>
              <?php if (1 == 2): ?>
              <dt>
                <input type="submit" name="" id="button" class="button" value="<?php if ($this->_tpl_vars['office']['office_id']): ?>编辑<?php else: ?>添加<?php endif; ?>" />
              </dt>
              <?php endif; ?>
            </fieldset>
          </form>
        </div>
      </div>
      <!-- End #tab1 --> 
    </div>
    <!-- End .content-box-content --> 
  </div>
  <!-- End .content-box --> 
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