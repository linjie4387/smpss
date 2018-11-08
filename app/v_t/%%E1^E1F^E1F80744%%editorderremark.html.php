<?php /* Smarty version 2.6.26, created on 2017-11-06 09:10:38
         compiled from simpla/order/editorderremark.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/order/editorderremark.html', 16, false),)), $this); ?>
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
  <p id="page-intro">1.你可以在这里修改医院预订单的备注。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>医院预订单备注管理</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/order/hospitalorderremark'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <p>
                <label>预订单编号(只读)：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospitalorder']['hospitalorder_id']; ?>
" class="text-input small-input" name="oid" id="oid" readonly="true" />
                <span></span> </p>
              <p>
                <label>下单人备注(只读)：</label>
                <textarea name="remark" class="text-input textarea" readOnly="true"><?php echo $this->_tpl_vars['hospitalorder']['remark']; ?>
</textarea>
                <span></span> </p>
              <p>
                <label>接单人备注<?php if ($this->_tpl_vars['button']['order_editremark'] != 1 && ( $this->_tpl_vars['hospitalorder']['admin_remark'] != '' || $this->_tpl_vars['hospitalorder']['admin_remark'] != null )): ?>(只读)<?php endif; ?>：</label>
                <?php if ($this->_tpl_vars['button']['order_editremark'] != 1 && ( $this->_tpl_vars['hospitalorder']['admin_remark'] != '' || $this->_tpl_vars['hospitalorder']['admin_remark'] != null )): ?>
                <textarea name="admin_remark" class="text-input textarea" readOnly="true"><?php echo $this->_tpl_vars['hospitalorder']['admin_remark']; ?>
</textarea>   
                <?php else: ?>
                <textarea name="admin_remark" class="text-input textarea"><?php echo $this->_tpl_vars['hospitalorder']['admin_remark']; ?>
</textarea>                
                <?php endif; ?>
                <span></span> </p>
              <dt>
                <input type="submit" name="" id="button" class="button" value=" 提  交 " />
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