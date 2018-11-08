<?php /* Smarty version 2.6.26, created on 2018-04-27 10:11:25
         compiled from simpla/delivery/adddeliveryman.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/adddeliveryman.html', 12, false),)), $this); ?>
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
  <p id="page-intro">1.你可以在这里添加新的送货员或者编辑已有的送货员。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>添加送货员</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/delivery/manadm"), $this);?>
">送货员管理</a></li>
        <li><a href="#tab1" class="default-tab">添加送货员</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/adddeliveryman'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['deliveryman']['deliveryman_id']; ?>
" name="deliveryman_id" />
              <p>
              <label><font class="red"> * </font>姓名：</label>
              <input type="text" value="<?php echo $this->_tpl_vars['deliveryman']['name']; ?>
" class="text-input small-input" name="name" id="name" />
              <span></span> </p>
              <p>
              <label><font class="red"> * </font>手机号码：</label>
              <input type="text" value="<?php echo $this->_tpl_vars['deliveryman']['mobile']; ?>
" class="text-input small-input" name="mobile" id="mobile" />
              <span></span> </p>
              <p><label>微信用户：<?php echo $this->_tpl_vars['deliveryman']['weichatuser_id']; ?>
</label>
              <span><select name="weichatuser_id">
                  <option value="0">选择微信用户</option>
                  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['weichatuserList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
?><option value="<?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['weichatuser_id']; ?>
" <?php if ($this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['weichatuser_id'] == $this->_tpl_vars['deliveryman']['weichatuser_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['name']; ?>
</option><?php endfor; endif; ?>
              </select></span>
              </p>
              <p>
              <label><font class="red"> * </font>是否是司机</label>
              <span>
                  <input type="radio" value="1" name="is_driver" <?php if ($this->_tpl_vars['deliveryman']['is_driver'] == 1): ?> checked="checked"<?php endif; ?>/>是
                  <input type="radio" value="0" name="is_driver" <?php if ($this->_tpl_vars['deliveryman']['is_driver'] != 1): ?> checked="checked"<?php endif; ?>/>否
              </span> </p>
              <p id="dlt">
              <label><font class="red"> * </font>驾照类型：</label>
              <select id="one" name="driverlicense_type">
                  <option value="0">-----选择驾照类型-----</option>
                  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['driverlicensetypeList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <option value="<?php echo $this->_tpl_vars['driverlicensetypeList'][$this->_sections['i']['index']]['value']; ?>
" <?php if ($this->_tpl_vars['driverlicensetypeList'][$this->_sections['i']['index']]['value'] == $this->_tpl_vars['deliveryman']['driverlicense_type']): ?>selected="selected"<?php endif; ?>>
                      <?php echo $this->_tpl_vars['driverlicensetypeList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['driverlicensetypeList'][$this->_sections['i']['index']]['name']; ?>

                  </option>
                  <?php endfor; endif; ?>
              </select>
              <span></span>
              </p>
              <p>
              <label><font class="red"> * </font>状态：</label>
              <select id="isrun" name="isrun" style="width:200px">
                  <option value="0" <?php if ($this->_tpl_vars['deliveryman']['isrun'] == 0): ?>selected="selected"<?php endif; ?>>空闲</option>
                  <option value="1" <?php if ($this->_tpl_vars['deliveryman']['isrun'] == 1): ?>selected="selected"<?php endif; ?>>占用</option>
              </select>
              </p>
              <dt>
                <input type="submit" name="" id="button" class="button" value="<?php if ($this->_tpl_vars['deliveryman']['deliveryman_id']): ?>编辑<?php else: ?>添加<?php endif; ?>" />
              </dt>
            </fieldset>
          </form>
        </div>
      </div>
      <!-- End #tab1 --> 
    </div>
    <!-- End .content-box-content -->
    <script type="text/javascript">
        $(function(){
          $("input[name=is_driver]").click(function(){
                                       is_driver = this.value;
                                       if(is_driver==1) {
                                       $("#dlt").show();
                                       }else {
                                       $("#dlt").hide();
                                       }
                                       });
          });
        $(document).ready(function(){
                          is_driver = '<?php echo $this->_tpl_vars['deliveryman']['is_driver']; ?>
';
                          if(is_driver==1) {
                          $("#dlt").show();
                          }else {
                          $("#dlt").hide();
                          }

                          });
    </script>
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