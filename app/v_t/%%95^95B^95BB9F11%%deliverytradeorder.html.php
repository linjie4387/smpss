<?php /* Smarty version 2.6.26, created on 2017-01-24 18:58:18
         compiled from simpla/order/deliverytradeorder.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/order/deliverytradeorder.html', 16, false),)), $this); ?>
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
  <p id="page-intro">1.你可以在这里对正式订单进行发货确认。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>发货确认</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/order/deliverytradeorder'), $this);?>
" method="post" id="js-form" enctype="multipart/form-data" AUTOCOMPLETE="OFF" onSubmit="return check();">
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
                <label>发货单：</label>
                <input type="file" name="file" id="file" />
                <br />
                <span></span> </p>
                <p>
                <label><font class="red"> * </font>发货单号：(没有请填写“无”)</label>
                <input type="text" value="<?php echo $this->_tpl_vars['order']['delivery_no']; ?>
" class="text-input small-input" name="delivery_no" id="delivery_no"/>
                <span></span> </p>
                <p>
                <label><font class="red"> * </font>发票单号：(没有请填写“无”)</label>
                <input type="text" value="<?php echo $this->_tpl_vars['order']['invoice_no']; ?>
" class="text-input small-input" name="invoice_no" id="invoice_no" />
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
  </div>
  <!-- End .content-box --> 
  <script type="text/javascript">
  function check(){
	  var d = $("#delivery_no").val();
	  var i = $("#invoice_no").val();
	  if(!d){
		  alert("请输入发货单号。");return false;
	  }
	  if(!i){
		  alert("请输入发票单号。");return false;
	  }
	  return true;
  }
  </script>
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