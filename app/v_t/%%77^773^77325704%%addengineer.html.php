<?php /* Smarty version 2.6.26, created on 2017-10-17 09:40:59
         compiled from simpla/user/addengineer.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/user/addengineer.html', 16, false),)), $this); ?>
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
  <p id="page-intro">1.你可以在这里审核新的微信工程部用户或者编辑已有的微信工程部用户。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>工程部用户维护</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/user/addengineer'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['weichatuser']['weichatuser_id']; ?>
" name="weichatuser_id" />
              <input type="hidden" value="<?php echo $this->_tpl_vars['weichatuser']['is_valid']; ?>
" name="is_valid" />
              <p>
                <label><font class="red"> * </font>微信OPENID(只读)：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['weichatuser']['open_id']; ?>
" class="text-input small-input" name="open_id" id="open_id" readOnly="true"/>
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>名称(只读)：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['weichatuser']['name']; ?>
" class="text-input small-input" name="name" id="name" readOnly="true"/>
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>手机(只读)：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['weichatuser']['mobile']; ?>
" class="text-input small-input" name="mobile" id="mobile" readOnly="true"/>
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>等级：</label>
                <select id="one" name="level">
                    <option value="0">-----选择状态----</option>
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['userlevelList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <option value="<?php echo $this->_tpl_vars['userlevelList'][$this->_sections['i']['index']]['value']; ?>
" <?php if ($this->_tpl_vars['userlevelList'][$this->_sections['i']['index']]['value'] == $this->_tpl_vars['weichatuser']['level']): ?>selected="selected"<?php endif; ?>>
                        <?php echo $this->_tpl_vars['userlevelList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['userlevelList'][$this->_sections['i']['index']]['name']; ?>

                    </option>
                    <?php endfor; endif; ?>
                </select>
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>状态：</label>
                <select id="one" name="status">
                    <option value="0">-----选择状态----</option>
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['userstatusList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <option value="<?php echo $this->_tpl_vars['userstatusList'][$this->_sections['i']['index']]['value']; ?>
" <?php if ($this->_tpl_vars['userstatusList'][$this->_sections['i']['index']]['value'] == $this->_tpl_vars['weichatuser']['status']): ?>selected="selected"<?php endif; ?>>
                        <?php echo $this->_tpl_vars['userstatusList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['userstatusList'][$this->_sections['i']['index']]['name']; ?>

                    </option>
                    <?php endfor; endif; ?>
                </select>
                <span></span> </p>
              <dt>
                <input type="submit" name="" id="button" class="button" value="编辑" />
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