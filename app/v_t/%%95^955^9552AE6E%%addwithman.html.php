<?php /* Smarty version 2.6.26, created on 2017-05-31 18:32:32
         compiled from simpla/delivery/addwithman.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/addwithman.html', 17, false),)), $this); ?>
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
  <p id="page-intro">您可以在这里为送货单分配送货员。</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <a href="javascript:history.go(-1);" class="btn-back" title="后退"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/back.png" /></a>
      <h3>分配送货员</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/addwithman'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['delivery']['delivery_id']; ?>
" name="delivery_id" />

              <p><a href="javascript:void(0)">送货单_<?php echo $this->_tpl_vars['delivery']['delivery_id']; ?>
&nbsp;的送货员列表</a></p>
              <ul>
                  <?php $_from = $this->_tpl_vars['deliverymanList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['deliveryman']):
?>
                  <li>
                      <input type="checkbox" name="manlist[]" value="<?php echo $this->_tpl_vars['deliveryman']['deliveryman_id']; ?>
" <?php if ($this->_tpl_vars['deliveryman']['is_checked'] == 1): ?>checked="checked"<?php endif; ?> /><?php echo $this->_tpl_vars['deliveryman']['name']; ?>

                  </li>
                  <?php endforeach; endif; unset($_from); ?>
              </ul>

              <dt>
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