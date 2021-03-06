<?php /* Smarty version 2.6.26, created on 2017-05-23 10:04:58
         compiled from simpla/delivery/addcar.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/addcar.html', 12, false),)), $this); ?>
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
  <p id="page-intro">1.你可以在这里添加新的车辆或者编辑已有的车辆。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>添加车辆</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/delivery/caradm"), $this);?>
">车辆查询</a></li>
        <li><a href="#tab1" class="default-tab">添加车辆</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/addcar'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['car']['car_id']; ?>
" name="car_id" />
              <p>
              <label><font class="red"> * </font>车牌号(唯一)：</label>
              <input type="text" value="<?php echo $this->_tpl_vars['car']['car_license']; ?>
" class="text-input small-input" name="car_license" id="car_license" />
              <span></span> </p>
              <p>
              <label><font class="red"> * </font>牌照类型：</label>
              <select id="one" name="license_type">
                  <option value="0">-----选择牌照类型-----</option>
                  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['licensetypeList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <option value="<?php echo $this->_tpl_vars['licensetypeList'][$this->_sections['i']['index']]['value']; ?>
" <?php if ($this->_tpl_vars['licensetypeList'][$this->_sections['i']['index']]['value'] == $this->_tpl_vars['car']['license_type']): ?>selected="selected"<?php endif; ?>>
                      <?php echo $this->_tpl_vars['licensetypeList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['licensetypeList'][$this->_sections['i']['index']]['name']; ?>

                  </option>
                  <?php endfor; endif; ?>
              </select>
              <span></span> </p>
              <p>
              <label><font class="red"> * </font>型号：</label>
              <input type="text" value="<?php echo $this->_tpl_vars['car']['model']; ?>
" class="text-input small-input" name="model" id="model" />
              <span></span> </p>
              <p>
              <label>容量：</label>
              <input type="text" value="<?php echo $this->_tpl_vars['car']['volume']; ?>
" class="text-input small-input" name="volume" id="volume" />
              <span></span> </p>
              <p>
              <label>车型：</label>
              <input type="text" value="<?php echo $this->_tpl_vars['car']['mold']; ?>
" class="text-input small-input" name="mold" id="mold" />
              <span></span> </p>
              <dt>
                <input type="submit" name="" id="button" class="button" value="<?php if ($this->_tpl_vars['car']['car_id']): ?>编辑<?php else: ?>添加<?php endif; ?>" />
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