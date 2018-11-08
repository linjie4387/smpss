<?php /* Smarty version 2.6.26, created on 2017-07-29 22:56:49
         compiled from simpla/order/verifytradeorder.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/order/verifytradeorder.html', 16, false),array('modifier', 'cat', 'simpla/order/verifytradeorder.html', 27, false),)), $this); ?>
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
  <p id="page-intro">1.你可以在这里对下单进行确认。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>下单确认</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/order/verifytradeorder'), $this);?>
" method="post" id="js-form" enctype="multipart/form-data">
            <fieldset class="clearfix">
                <p>
                <label>订单编号(只读)：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['order']['order_id']; ?>
" class="text-input small-input" name="oid" id="oid" readonly />
                <span></span> </p>
                <p>
                <label>预订单编号(只读)：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['order']['hospitalorder_id']; ?>
" class="text-input small-input" name="hid" id="hid" readonly />
                <span></span> </p>
                <p>
                <label><font class="red"> * </font>是否复用<a href="<?php echo smarty_function_get_url(array('rule' => '/order/hospitalorderprint','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order']['hospitalorder_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order']['hospitalorder_id']))), $this);?>
" title="预订单照片">
                    预订单照片
                </a></label>
                <span>
                    <input type="radio" value="1" name="reuse" <?php if ($this->_tpl_vars['reuse'] == 1): ?> checked="checked"<?php endif; ?>/>复用
                    <input type="radio" value="0" name="reuse" <?php if ($this->_tpl_vars['reuse'] == 0): ?> checked="checked"<?php endif; ?>/>新建
                </span> </p>
                <p id="pz" <?php if ($this->_tpl_vars['reuse'] == 1): ?>style="display:none;"<?php endif; ?>>
                <label><font class="red"> * </font>下单凭证：</label>
                <input type="file" name="file" id="file" />
                <br />
                <span></span> </p>
              <dt>
                <input type="submit" name="" id="button" class="button" value="提交" />
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
    	 $("input[name=reuse]").click(function(){
    	  	reuse = this.value;
    	  	if(reuse==1) {
    	  		$("#pz").hide();
    	  	}else {
    	  		$("#pz").show();
    	  	}
    	 });
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