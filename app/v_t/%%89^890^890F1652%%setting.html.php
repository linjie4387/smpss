<?php /* Smarty version 2.6.26, created on 2017-07-14 13:28:46
         compiled from simpla/system/setting.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/system/setting.html', 15, false),)), $this); ?>
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
<div id="main-content">
  <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
  <p id="page-intro">系统配置。注意：修改后需要重新登录</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>系统配置</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/system/setting'), $this);?>
" method="post" id="js-form" enctype="multipart/form-data">
            <fieldset class="clearfix">
              <p>
                <label><font class="red"> * </font>系统名称</label>
                <span>
                <input type="text" value="<?php echo $this->_tpl_vars['system_name']; ?>
" class="text-input medium-input" name="system_name" />
                </span> </p>
                <p>
                <label><font class="red"> * </font>域名</label>
                <span>
                    <input type="text" value="<?php echo $this->_tpl_vars['domain_name']; ?>
" class="text-input medium-input" name="domain_name" />
                </span> </p>
                <p>
                  <label><font class="red"> * </font>Cookie密匙</label>
                  <span>
                  <input type="text" value="<?php echo $this->_tpl_vars['cookie_key']; ?>
" class="text-input small-input" name="cookie_key" />
                  </span> </p>
                  <p>
                  <label><font class="red"> * </font>安全库存倍数</label>
                  <span>
                      <input type="text" value="<?php echo $this->_tpl_vars['safe_multiple']; ?>
" class="text-input small-input" name="safe_multiple" />
                  </span> </p>
                  <p>
                <label><font class="red"> * </font>是否启用伪静态</label>
                <span>
                <input type="radio" value="1" name="rewrite" <?php if ($this->_tpl_vars['rewrite'] == 1): ?> checked="checked"<?php endif; ?>/>启用<input type="radio" value="0" name="rewrite" <?php if ($this->_tpl_vars['rewrite'] == 0): ?> checked="checked"<?php endif; ?>/>禁用
                </span> </p>
              <p>
              	<label>Logo(图片大小220*40)</label>
              	<img style="max-width: 220px;" id="imagePreview" src="<?php echo $this->_tpl_vars['logo_dir']; ?>
" /><br>
				<input class="file am-margin-top-sm" id="imageInput" name="logo" onchange="loadImageFile();"  type=file accept="image/*"capture="camcorder">
              </p>
              <!-- 
              <p><label>清空数据</label><input type="checkbox" name="cleartable" value="1" /><span>勾选将清空供应商、医院、微信用户、订单、仪器所有数据。管理账号不会清空。</span></p>
              <p>
               -->
              </div>
                <input type="submit" name="" class="button" value=" 修改 " />
              </p>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  <script>
		var loadImageFile = (function () {
			if (window.FileReader) {   
				var oPreviewImg = null, oFReader = new window.FileReader(),   
				rFilter = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;   
				
				
				oFReader.onload = function (oFREvent) {   
					if (!oPreviewImg) {   
						var newPreview = document.getElementById("imagePreview");   
						oPreviewImg = new Image();
						newPreview.src = oFREvent.target.result;     
					} 
				};   
				
				
				return function () {   
					var aFiles = document.getElementById("imageInput").files;   
					if (aFiles.length === 0) { return; }   
					if (!rFilter.test(aFiles[0].type)) { alert("请选择图片!"); return; }   
					oFReader.readAsDataURL(aFiles[0]); 
				}
			}   
			if (navigator.appName === "Microsoft Internet Explorer") {   
				return function () {   
					alert(document.getElementById("imageInput").value);   
					document.getElementById("imagePreview").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = document.getElementById("imageInput").value;   
				}   
			}   
		})();
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