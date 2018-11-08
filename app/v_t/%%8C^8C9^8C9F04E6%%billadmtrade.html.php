<?php /* Smarty version 2.6.26, created on 2017-10-13 09:19:33
         compiled from simpla/order/billadmtrade.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/order/billadmtrade.html', 18, false),)), $this); ?>
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
<script src="/assets/layer/layer.js" type="text/javascript" charset="utf-8"></script>
<style>.promote{display:none;}</style>
<div id="main-content">
  <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
  <p id="page-intro">1.你可以在这里维护正式单的发货单号和发票单号以及备注。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
        <a href="javascript:history.go(-1);" class="btn-back" title="后退"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/back.png" /></a>
      <h3>正式单单据维护</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/order/billadmtradeorder'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              <p>
                <label>订单编号(只读)：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['order']['order_id']; ?>
" class="text-input small-input" name="oid" id="oid" readonly="true" />
                <span></span> </p>
              <p>
                <label>发货单号：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['order']['delivery_no']; ?>
" class="text-input small-input" name="delivery_no" id="delivery_no"/>
                <span></span> </p>
              <p>
                <label>发票单号：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['order']['invoice_no']; ?>
" class="text-input small-input" name="invoice_no" id="invoice_no"/>
                <span></span> </p>
              <p>
                <label>备注：</label>
                <textarea name="remark" class="text-input textarea"><?php echo $this->_tpl_vars['order']['remark']; ?>
</textarea>
                <span></span> </p>
              <dt>
                <input type="submit" name="" id="button" class="button" value="生成配送任务" /> &nbsp;&nbsp;
                <?php if (1 == 2): ?>
                <button type="button" id="overBtn" data-order_id="<?php echo $this->_tpl_vars['order']['order_id']; ?>
" class="button">结束订单</button>
                <?php endif; ?>
              </dt>
            </fieldset>
          </form>
        </div>
      </div>
      <!-- End #tab1 --> 
    </div>
    <!-- End .content-box-content --> 
  </div>
  
  <script type="text/javascript">
  	$('#overBtn').click(function(){
  		var order_id = $(this).data('order_id');
	  		layer.confirm('确定要结束此订单吗？', {
				  btn: ['确定','取消'] //按钮
				}, function(){
				 		var postdata = {
	    				order_id:order_id
	    			};
	    			$.ajax({type:'POST',url:'<?php echo smarty_function_get_url(array('rule' => '/order/over'), $this);?>
',data:postdata,dataType:'json',timeout:30000,success:function(msg,textStatus){
	    				layer.msg(msg.msg);
	    				if(msg.code == 1){
	    						window.location.href = '<?php echo smarty_function_get_url(array('rule' => '/order/tradeindex'), $this);?>
';
	    				}
			        },error:function(textStatus,errorThrown){
			        		layer.msg('提交拆分请求失败。');
			        }});
				});
  	});
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