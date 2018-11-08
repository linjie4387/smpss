<?php /* Smarty version 2.6.26, created on 2017-09-24 11:02:28
         compiled from simpla/device/adddevice.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/device/adddevice.html', 12, false),)), $this); ?>
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
  <p id="page-intro">1.你可以在这里上传仪器文件。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>导入仪器</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/device/index"), $this);?>
">仪器查询</a></li>
        <li><a href="#tab1" class="default-tab">导入仪器</a></li>
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/device/logindex"), $this);?>
">更新记录</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/device/adddevice'), $this);?>
" method="post" id="js-form" enctype="multipart/form-data">
            <fieldset class="clearfix">
                <p>excel(2007)模版： <span><a href="<?php echo $this->_tpl_vars['demo_xlsx']; ?>
" title="文件">demo.xlsx</a>
                   </span>&nbsp;excel模版： <span><a href="<?php echo $this->_tpl_vars['demo_xls']; ?>
" title="文件">demo.xls</a>&nbsp;csv模版： <span><a href="<?php echo $this->_tpl_vars['demo_csv']; ?>
" title="文件">demo.csv</a>
                </span></p>
                <input type="hidden" value="0" name="is_loaded" />
              <p>
                <label><font class="red"> * </font>文件：</label>
                <input type="file" name="file" id="file" />
                <br />
                <span></span> </p>
              <dt>
                <input type="submit" name="" id="button" class="button" value="导入" />
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