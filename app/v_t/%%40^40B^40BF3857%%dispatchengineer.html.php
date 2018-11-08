<?php /* Smarty version 2.6.26, created on 2017-11-06 16:33:44
         compiled from simpla/user/dispatchengineer.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/user/dispatchengineer.html', 16, false),)), $this); ?>
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
  <p id="page-intro">1.你可以在这里为微信工程部普通用户分配区县。</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>工程部普通用户区县分配</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/user/dispatchengineer'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['weichatuser']['weichatuser_id']; ?>
" name="weichatuser_id" />

              <p><a href="javascript:void(0)"><?php echo $this->_tpl_vars['weichatuser']['name']; ?>
 负责的区县列表</a></p>
              <ul>
                  <?php $_from = $this->_tpl_vars['districtList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['district']):
?>
                  <li>
                      <input type="checkbox" name="engineerdistrict[]" value="<?php echo $this->_tpl_vars['district']['district_id']; ?>
" <?php if ($this->_tpl_vars['district']['is_checked'] == 1): ?>checked="checked"<?php endif; ?> /><?php echo $this->_tpl_vars['district']['name']; ?>

                  </li>
                  <?php endforeach; endif; unset($_from); ?>
              </ul>

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