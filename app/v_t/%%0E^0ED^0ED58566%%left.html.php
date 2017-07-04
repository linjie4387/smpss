<?php /* Smarty version 2.6.26, created on 2017-07-04 11:39:46
         compiled from simpla/common/left.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/common/left.html', 19, false),array('modifier', 'cat', 'simpla/common/left.html', 19, false),)), $this); ?>
<style>
    #profile-links .container .column-left a { position:relative;}
    #profile-links .container .column-left a i span{ position: absolute;top: -20px;right: -4px;font-size: 14px;background: #ff6c60;border-radius: 50%;width: 20px;height: 20px;text-align: center;line-height: 20px;color: #FFFFFF;}
    #profile-links .container .column-left:first-child a i span { background: #ff6c60;}
    #profile-links .container .column-left:nth-child(2) a i span { background: #FCB322;}
    #profile-links .container .column-left:nth-child(3) a i span { background: #57c8f2;}
    #profile-links .container .column-left:last-child a i span { background: #a9d86e;}
</style>
<div id="sidebar">
  <div id="sidebar-wrapper">
    <h1 id="sidebar-title"><a href="<?php echo $this->_tpl_vars['root_dir']; ?>
/"><?php echo $this->_tpl_vars['head_title']; ?>
</a></h1>
    <a href="<?php echo $this->_tpl_vars['root_dir']; ?>
/"><img id="logo" style="max-width: 220px;" src="<?php echo $this->_tpl_vars['logo_dir']; ?>
" alt="<?php echo $this->_tpl_vars['head_title']; ?>
" /></a> 
    <!-- Sidebar Profile links -->
    <div id="profile-links"> 您好, <a href="#" title="编辑资料"><?php echo $this->_tpl_vars['_adminname']; ?>
</a><br />
    <br/>
    <div class="container" style="width:100%; margin:auto;">
        <div style="width:25%" class="column-left">
            <?php if ($this->_tpl_vars['menu']['order']['tradeindex']): ?>
            <a href="<?php echo smarty_function_get_url(array('rule' => '/order/tradeindex','data' => ((is_array($_tmp='status=')) ? $this->_run_mod_handler('cat', true, $_tmp, 1) : smarty_modifier_cat($_tmp, 1))), $this);?>
"><i id="order_todo" class="icon-list-ol icon-2x">&nbsp;<span id="t_count">0</span></i></a>
            <?php else: ?>
            <a href="#"><i id="order_todo" class="icon-list-ol icon-2x">&nbsp;<span id="t_count">0</span></i></a>
            <?php endif; ?>
        </div>
        <div style="width:25%" class="column-left">
	    <?php if ($this->_tpl_vars['menu']['order']['index']): ?>
	    	<a href="<?php echo smarty_function_get_url(array('rule' => '/order/index','data' => ((is_array($_tmp='status=')) ? $this->_run_mod_handler('cat', true, $_tmp, 1) : smarty_modifier_cat($_tmp, 1))), $this);?>
"><i id="order_todo" class="icon-list-ul icon-2x">&nbsp;<span id="o_count">0</span></i></a>
	    <?php else: ?>
	        <a href="#"><i id="order_todo" class="icon-list-ul icon-2x">&nbsp;<span id="o_count">0</span></i></a>
	    <?php endif; ?>
	    </div>
	    <div style="width:25%" class="column-left">
	    	<?php if ($this->_tpl_vars['menu']['user']['engineerindex']): ?>
	    		<a href="<?php echo smarty_function_get_url(array('rule' => '/user/engineerindex','data' => ((is_array($_tmp='status=')) ? $this->_run_mod_handler('cat', true, $_tmp, 1) : smarty_modifier_cat($_tmp, 1))), $this);?>
"><i id="order_todo" class=" icon-user icon-2x">&nbsp;<span id="e_count">0</span></i></a>
			<?php else: ?>
	    		<a href="#"><i id="order_todo" class=" icon-user icon-2x">&nbsp;<span id="e_count">0</span></i></a>
	    	<?php endif; ?>
	    </div>
	    <div style="width:25%" class="column-left">
	    <?php if ($this->_tpl_vars['menu']['user']['hospitalindex']): ?>
	    	<a href="<?php echo smarty_function_get_url(array('rule' => '/user/hospitalindex','data' => ((is_array($_tmp='status=')) ? $this->_run_mod_handler('cat', true, $_tmp, 1) : smarty_modifier_cat($_tmp, 1))), $this);?>
"><i id="order_todo" class=" icon-user-md icon-2x ">&nbsp;<span id="h_count">0</span></i></a>
	    <?php else: ?>	
	    	<a href="#"><i id="order_todo" class=" icon-user-md icon-2x ">&nbsp;<span id="h_count">0</span></i></a>
	    <?php endif; ?>
	    </div>
    </div>
    <br/>
      <br />
      <a href="<?php echo smarty_function_get_url(array('rule' => "/system/index"), $this);?>
" title="管理首页">管理首页</a> | <a href="<?php echo smarty_function_get_url(array('rule' => "/main/logout"), $this);?>
" title="退出系统">退出系统</a> </div>
    <ul id="main-nav">
    <?php if ($this->_tpl_vars['menu']['district']): ?>
    <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'district'): ?>current<?php endif; ?>">区县管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['district']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/district/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['menu']['hospital']): ?>
    <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'hospital'): ?>current<?php endif; ?>">医院管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['hospital']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/hospital/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['menu']['supplier']): ?>
    <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'supplier'): ?>current<?php endif; ?>">供应商管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['supplier']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/supplier/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['menu']['goods']): ?>
    <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'goods'): ?>current<?php endif; ?>">商品管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/goods/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['menu']['order']): ?>
    <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'order'): ?>current<?php endif; ?>">医院订单管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['order']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/order/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['menu']['delivery']): ?>
    <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'delivery'): ?>current<?php endif; ?>">配送管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['delivery']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/delivery/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['menu']['device']): ?>
    <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'device'): ?>current<?php endif; ?>">仪器管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['device']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/device/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['menu']['reagent']): ?>
    <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'reagent'): ?>current<?php endif; ?>">试剂管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['reagent']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/reagent/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </li>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['menu']['user']): ?>
    <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'user'): ?>current<?php endif; ?>">微信用户管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/user/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
    </li>
    <?php endif; ?>
    
    
	<?php if ($this->_tpl_vars['menu']['report']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'account'): ?>current<?php endif; ?>">数据报表</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['report']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/report/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['menu']['account']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'account'): ?>current<?php endif; ?>">账号管理</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['account']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/account/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
	
	<?php if ($this->_tpl_vars['menu']['system']): ?>
      <li> <a href="javascript:;" class="nav-top-item <?php if ($this->_tpl_vars['inpath'][1] == 'system'): ?>current<?php endif; ?>">系统</a>
        <ul>
            <?php $_from = $this->_tpl_vars['menu']['system']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['items']):
?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/system/'), $this);?>
<?php echo $this->_tpl_vars['k']; ?>
" class="<?php if ($this->_tpl_vars['inpath'][2] == $this->_tpl_vars['k']): ?>current<?php endif; ?>"><?php echo $this->_tpl_vars['items']; ?>
</a></li>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
      </li>
	<?php endif; ?>
    </ul>
  </div>
</div>
<script>
$(function(){
	refreshCounter();
	setTimeout('refreshCounter()',6000);
});

function refreshCounter(){
	$.post("<?php echo smarty_function_get_url(array('rule' => '/system/reminder'), $this);?>
",{},
	function(res){
		if(res.code == 0){
			$("#t_count").html(res.data.t_count);
            $("#o_count").html(res.data.o_count);
            $("#e_count").html(res.data.e_count);
			$("#h_count").html(res.data.h_count);
			if(res.data.t_count>0){
				$("#t_count").addClass("red");
			}else {
				$("#t_count").removeClass("red");
			}
            if(res.data.o_count>0){
                $("#o_count").addClass("red");
            }else {
                $("#o_count").removeClass("red");
            }
           }else{
			//jQuery.facebox(res.msg);
		}
	},'json');
}
</script>