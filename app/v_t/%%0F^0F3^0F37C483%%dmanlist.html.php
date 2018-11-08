<?php /* Smarty version 2.6.26, created on 2017-07-13 10:13:28
         compiled from simpla/delivery/dmanlist.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/dmanlist.html', 70, false),)), $this); ?>
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
<div id="main-content">
    <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
    <p id="page-intro">查看送货单司机信息</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <a href="javascript:history.go(-1);" class="btn-back" title="后退"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/back.png" /></a>
        <h3>送货单_<?php echo $this->_tpl_vars['delivery_id']; ?>
&nbsp; 已选司机:<?php echo $this->_tpl_vars['delivery']['driver_name']; ?>
</h3>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <table data-did = "<?php echo $this->_tpl_vars['delivery_id']; ?>
" data-dmid = "<?php echo $this->_tpl_vars['delivery']['driver_deliveryman_id']; ?>
">
            <thead>
              <tr>
                <th>选择</th>
                <th>姓名</th>
                <th>手机号码</th>
                <th>微信用户</th>
                <th>驾照类型</th>
                <th>添加时间</th>
                <th>添加人</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td colspan="8"><?php echo $this->_tpl_vars['pagebar']; ?>
</td>
              </tr>
            </tfoot>
            <tbody>
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['deliverymanList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <tr>
                  <td>
                  <input type="radio" 
                  	<?php if ($this->_tpl_vars['delivery']['status'] <> 1): ?>disabled="disabled"<?php endif; ?> 
                    data-dname="<?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['name']; ?>
" 
                    name="deliveryman" 
                    <?php if ($this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['deliveryman_id'] == $this->_tpl_vars['delivery']['driver_deliveryman_id']): ?> checked<?php endif; ?> 
                    id="deliveryman" 
                    value="<?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['deliveryman_id']; ?>
" />
                  </td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['mobile']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['weichatuser_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['driverlicense_type_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['create_time']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['admin_name']; ?>
</td>
                </tr>
                <?php endfor; endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script language="JavaScript">
    	$(function(){
    		$('input[name="deliveryman"]').click(function(){
    			var did = $('table').attr('data-did');
    			var dmid = $(this).val();
    			var dmname = $(this).attr('data-dname'); 
    			var odmid = $('table').attr('data-dmid');
    			if(odmid == dmid)return false;
    			layer.confirm('确定要更换成【'+dmname+'】这个司机吗？', {
				  btn: ['确定','取消'] //按钮
				}, function(){
				 	var postdata = {dmid:dmid,did:did};
	    			$.ajax({type:'POST',url:"<?php echo smarty_function_get_url(array('rule' => '/delivery/changedman'), $this);?>
",data:postdata,dataType:'json',timeout:30000,success:function(msg,textStatus){
	    				layer.msg(msg.msg);
	    				if(msg.code == 1){
	    					window.location.href = '<?php echo smarty_function_get_url(array('rule' => '/delivery/index'), $this);?>
';
	    				}
	    				else{
	    					window.location.href = '<?php echo smarty_function_get_url(array('rule' => '/delivery/deliverydmanlist-did-'), $this);?>
-<?php echo $this->_tpl_vars['delivery_id']; ?>
';
	    				}
			        },error:function(textStatus,errorThrown){
			        	layer.msg('提交更换请求失败。');
			        }});
				},function(){
					window.location.href = '<?php echo smarty_function_get_url(array('rule' => '/delivery/deliverydmanlist-did-'), $this);?>
-<?php echo $this->_tpl_vars['delivery_id']; ?>
';
				});
    		});
    		
    	});
    	
    </script>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/copy.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>