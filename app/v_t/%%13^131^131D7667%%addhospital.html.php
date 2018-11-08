<?php /* Smarty version 2.6.26, created on 2017-01-25 14:27:37
         compiled from simpla/hospital/addhospital.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/hospital/addhospital.html', 12, false),)), $this); ?>
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
  <p id="page-intro">1.你可以在这里添加新的医院或者编辑已有的医院。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>添加医院</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/index"), $this);?>
">医院查询</a></li>
        <li><a href="#tab1" class="default-tab">添加医院</a></li>
        <!-- 
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/officeindex"), $this);?>
">科室查询</a></li>
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/addoffice"), $this);?>
">添加科室</a></li>
         -->
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/hospital/addhospital'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['hospital']['hospital_id']; ?>
" name="hospital_id" />
              <p>
              <label><font class="red"> * </font>编号(唯一)：</label>
              <input type="text" value="<?php echo $this->_tpl_vars['hospital']['code']; ?>
" class="text-input small-input" name="code" id="code" />
              <span></span> </p>
              <p>
                <label><font class="red"> * </font>医院名称：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospital']['name']; ?>
" class="text-input small-input" name="name" id="name" />
                <span></span> </p>
              <p>
                <label>开票名称：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospital']['invoice_name']; ?>
" class="text-input small-input" name="invoice_name" id="invoice_name" />
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>级别顺序：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospital']['level_order']; ?>
" class="text-input small-input" name="level_order" id="level_order" />
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>级别：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospital']['level']; ?>
" class="text-input small-input" name="level" id="level" />
                <span></span> <br /><small>比如: 钻石级</small></p>
              <p>
                <label><font class="red"> * </font>医院等级：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospital']['hospital_level']; ?>
" class="text-input small-input" name="hospital_level" id="hospital_level" />
                <span></span> <br /><small>比如: 三级甲等</small></p>
              <p>
                <label><font class="red"> * </font>所属区县：</label>
                <select id="one" name="district_id">
                    <option value="0">-----选择区县-----</option>
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['districtList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <option value="<?php echo $this->_tpl_vars['districtList'][$this->_sections['i']['index']]['district_id']; ?>
" <?php if ($this->_tpl_vars['districtList'][$this->_sections['i']['index']]['district_id'] == $this->_tpl_vars['hospital']['district_id']): ?>selected="selected"<?php endif; ?>>
                        <?php echo $this->_tpl_vars['districtList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['districtList'][$this->_sections['i']['index']]['name']; ?>

                    </option>
                    <?php endfor; endif; ?>
                </select>
                <span></span> </p>

              <p>
                <label><font class="red"> * </font>邮编：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospital']['post_code']; ?>
" class="text-input small-input" name="post_code" id="post_code" />
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>地址：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospital']['address']; ?>
" class="text-input small-input" name="address" id="address" />
                <span></span> </p>
              <dt>
                <input type="submit" name="" id="button" class="button" value="<?php if ($this->_tpl_vars['hospital']['hospital_id']): ?>编辑<?php else: ?>添加<?php endif; ?>" />
              </dt>
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