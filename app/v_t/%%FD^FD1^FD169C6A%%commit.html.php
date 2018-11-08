<?php /* Smarty version 2.6.26, created on 2017-07-30 09:30:06
         compiled from simpla/delivery/commit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/commit.html', 10, false),array('modifier', 'cat', 'simpla/delivery/commit.html', 10, false),)), $this); ?>
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
  <p id="page-intro">你可以下面填写确认意见</p>
  <div class="clear"></div>
  <div class="content-box">
   <div class="content-box-header">
    <a href="<?php echo smarty_function_get_url(array('rule' => '/delivery/deliverygoodsbo','data' => ((is_array($_tmp='did=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order_fid']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order_fid']))), $this);?>
" class="btn-back" title="后退"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/back.png" /></a>
    <h3>配送任务清单_<?php echo $this->_tpl_vars['delivery_id']; ?>
&nbsp;任务确认</h3>
    <div class="clear"></div>
   </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/deliverycommit/createcommit'), $this);?>
" method="post">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['withgoods_id']; ?>
" name="withgoods_id" />
              <input type="hidden" value="<?php echo $this->_tpl_vars['order_id']; ?>
" name="order_id" />
              <input type="hidden" value="<?php echo $this->_tpl_vars['order_fid']; ?>
" name="order_fid" />
              <table width="100%" border="1">
                <tr>
                  <td width="12%" bgcolor="#FFFFFF">确认结果</td>
                  <td width="88%" bgcolor="#FFFFFF">
                    <select name="result" style="width:100%" id="result">
                    <option value="1" selected="selected">已经回单</option>
                    <option value="2">回单遗失</option>
                  </select></td>
                </tr>
                <tr>
                  <td>结果描述</td>
                  <td><textarea name="result_desc" cols="45" rows="5" id="result_desc" style="width:100%"><?php echo $this->_tpl_vars['result_desc']; ?>
</textarea></td>
                </tr>
                <tr>
                  <td height="46" align="right" bgcolor="#FFFFFF">&nbsp;</td>
                  <td align="right" bgcolor="#FFFFFF"><input type="submit" name="button" id="button" class="button" value="提  交" />
&nbsp;&nbsp;&nbsp;&nbsp;
<input type="button" name="button" id="button" class="button" value="取  消" /></td>
                </tr>
              </table>
            </fieldset>
          </form>
        </div>
      </div>
      <!-- End #tab1 --> 
    </div>
    <!-- End .content-box-content --> 
  </div>
  <script>
  function cancel(){
	  window.location.href="/delivery/deliverygoodsbyorder-did-<?php echo $this->_tpl_vars['withgoods_id']; ?>
.html";
  }
  </script>
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