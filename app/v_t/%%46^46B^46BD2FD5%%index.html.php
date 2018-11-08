<?php /* Smarty version 2.6.26, created on 2017-09-24 11:02:37
         compiled from simpla/system/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/system/index.html', 40, false),array('modifier', 'cat', 'simpla/system/index.html', 40, false),)), $this); ?>
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
<style>
.counter {
	color:#57a000;
	font-size:40px;
	padding-left: 20px;
}
</style>
<div id="main-content">
  <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
  <p id="page-intro">系统信息。</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>系统信息</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
          <div class="notification information png_bg"> <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/cross_grey_small.png" title="关闭" alt="close" /></a>
              <div> 区县总数：<?php echo $this->_tpl_vars['system']['districtcount']; ?>
 。医院总数：<?php echo $this->_tpl_vars['system']['hospitalcount']; ?>
 。科室总数：<?php echo $this->_tpl_vars['system']['officecount']; ?>
 。供应商总数：<?php echo $this->_tpl_vars['system']['suppliercount']; ?>
 。型号总数：<?php echo $this->_tpl_vars['system']['modelcount']; ?>
 。</div>
          </div>
        <div class="notification information png_bg"> <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/cross_grey_small.png" title="关闭" alt="close" /></a>
          <div> 医院微信用户总数：<?php echo $this->_tpl_vars['system']['weichatusercount_hospital']; ?>
 。工程部微信用户总数：<?php echo $this->_tpl_vars['system']['weichatusercount_engineer']; ?>
 。</div>
        </div>
        <div class="notification information png_bg"> <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/cross_grey_small.png" title="关闭" alt="close" /></a>
            <div> 订单总数：<?php echo $this->_tpl_vars['system']['ordercount']; ?>
 。</div>
        </div>
        <div class="notification information png_bg"> <a href="#" class="close"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/cross_grey_small.png" title="关闭" alt="close" /></a>
            <div> 仪器总数：<?php echo $this->_tpl_vars['system']['devicecount']; ?>
 。试剂总数：<?php echo $this->_tpl_vars['system']['reagentcount']; ?>
 。</div>
        </div>
        <div class="content-box column-left">
            <div class="content-box-header">
            	<h3 style="cursor: s-resize;">待处理订单</h3>
            </div>
            <div class="content-box-content" style="display: block;">
                <div class="tab-content default-tab" style="display: block;">
                	<?php if ($this->_tpl_vars['menu']['order']['index']): ?>&nbsp;
                   	待处理订单：<a href="<?php echo smarty_function_get_url(array('rule' => '/order/index','data' => ((is_array($_tmp='status=')) ? $this->_run_mod_handler('cat', true, $_tmp, 1) : smarty_modifier_cat($_tmp, 1))), $this);?>
" class="counter"><?php echo $this->_tpl_vars['system']['preordercount']; ?>
</a>
                   	<?php else: ?>
                   	待处理订单：<span class="counter"><?php echo $this->_tpl_vars['system']['preordercount']; ?>
</span>
                   	<?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="content-box column-right">
            <div class="content-box-header">
            	<h3 style="cursor: s-resize;">待审核用户</h3>
            </div>
            <div class="content-box-content" style="display: block;">
                <div class="tab-content default-tab" style="display: block;">
                	<div class="column-right" style="display: block;">
                	<?php if ($this->_tpl_vars['menu']['user']['engineerindex']): ?>&nbsp;
                        工程部微信用户：<a href="<?php echo smarty_function_get_url(array('rule' => '/user/engineerindex','data' => ((is_array($_tmp='status=')) ? $this->_run_mod_handler('cat', true, $_tmp, 1) : smarty_modifier_cat($_tmp, 1))), $this);?>
" class="counter"><?php echo $this->_tpl_vars['system']['preweichatusercount_engineer']; ?>
</a>
                    <?php else: ?>
                    	工程部微信用户：<span class="counter"><?php echo $this->_tpl_vars['system']['preweichatusercount_engineer']; ?>
</span>
                    <?php endif; ?>
                   </div>
                   <div class="tab-content default-tab" style="display: block;">
                   <?php if ($this->_tpl_vars['menu']['user']['hospitalindex']): ?>
                        医院微信用户：<a href="<?php echo smarty_function_get_url(array('rule' => '/user/hospitalindex','data' => ((is_array($_tmp='status=')) ? $this->_run_mod_handler('cat', true, $_tmp, 1) : smarty_modifier_cat($_tmp, 1))), $this);?>
" class="counter"><?php echo $this->_tpl_vars['system']['preweichatusercount_hospital']; ?>
</a>
                   <?php else: ?>
                   		医院微信用户：<span class="counter"><?php echo $this->_tpl_vars['system']['preweichatusercount_hospital']; ?>
</span>
                   <?php endif; ?>
                   </div>                   
                </div>
            </div>
        </div>
        <div class="clear"></div>
      </div>
    </div>
  </div>
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