<?php /* Smarty version 2.6.26, created on 2017-05-10 11:05:09
         compiled from simpla/goods/addgoods.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/goods/addgoods.html', 12, false),)), $this); ?>
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
  <p id="page-intro">1.你可以在这里添加新的商品或者编辑已有的商品。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>添加商品</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/goods/index"), $this);?>
">商品管理</a></li>
        <li><a href="#tab1" class="default-tab">添加商品</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/goods/addgoods'), $this);?>
" enctype="multipart/form-data"  method="post" id="js-form">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['goods']['goods_id']; ?>
" name="goods_id" />
              <p>
              <label><font class="red"> * </font>编码(唯一)：</label>
              <input type="text" value="<?php echo $this->_tpl_vars['goods']['goods_no']; ?>
" class="text-input small-input" name="goods_no" id="goods_no" />
              <span></span> </p>
              <p>
              <label><font class="red"> * </font>注册名：</label>
              <input type="text" value="<?php echo $this->_tpl_vars['goods']['name']; ?>
" class="text-input small-input" name="name" id="name" />
              <span></span> </p>
              <p>
                <label><font class="red"> * </font>通用名：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['extern_name']; ?>
" class="text-input medium-input" name="extern_name" id="extern_name" />
                <span></span> </p>
                
              <p>
                <label>厂商全名：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['manu']; ?>
" class="text-input medium-input" name="manu" id="manu" />
                <span></span> </p>
                
                <p>
                <label><font class="red"> * </font>单位：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['unit']; ?>
" class="text-input small-input" name="unit" id="unit" />
                <span></span><br/><small>比如: 桶</small></p>
              <p>
                <label><font class="red"> * </font>规格：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['specification']; ?>
" class="text-input small-input" name="specification" id="specification" />
                <span></span><br/><small>比如: 20L</small></p>
              <p>
                <label><font class="red"> * </font>容积：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['volume']; ?>
" class="text-input small-input" name="volume" id="volume" />
                <span></span><br/><small>比如: 20ML</small></p>
                
              <p>
                <label>适用机型：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['machine']; ?>
" class="text-input medium-input" name="machine" id="machine" />
                <span></span> </p>
              <p>
                <label>项目品类：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['category']; ?>
" class="text-input medium-input" name="category" id="category" />
                <span></span> </p>
                  
              <p>
                <label><font class="red"> * </font>是否是大包装</label>
                <span>
                    <input type="radio" value="1" name="is_20l" <?php if ($this->_tpl_vars['goods']['is_20l'] == 1): ?> checked="checked"<?php endif; ?>/>是<input type="radio" value="0" name="is_20l" <?php if ($this->_tpl_vars['goods']['is_20l'] != 1): ?> checked="checked"<?php endif; ?>/>否
                </span> </p>
              <p>
                <label>色标：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['colorcode']; ?>
" class="text-input medium-input" name="colorcode" id="colorcode" />
                <span></span> </p>
                <p>
                <label>备注：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['goods']['remark']; ?>
" class="text-input medium-input" name="remark" id="remark" />
                <span></span> </p>
                
              	<p>
                <label>商品注册证图片：</label>
                <span><?php if ($this->_tpl_vars['goods']['img']['regimg'] == ''): ?>暂无图片<?php else: ?><img src="<?php echo $this->_tpl_vars['goods']['img']['regimg']; ?>
" width="48"style="vertical-align: middle;" /><?php endif; ?></span>
                <input type="file" class="text-input medium-input" name="regimg" />
                 </p>
                <p>
                <label>说明书图片：</label>
                <span><?php if ($this->_tpl_vars['goods']['img']['noticeimg'] == ''): ?>暂无图片<?php else: ?><img src="<?php echo $this->_tpl_vars['goods']['img']['noticeimg']; ?>
" width="48"style="vertical-align: middle;" /><?php endif; ?></span>
                <input type="file" class="text-input medium-input" name="noticeimg" />
                </p>
                <p>
                <label>商品标签图片：</label>
                <span><?php if ($this->_tpl_vars['goods']['img']['labelimg'] == ''): ?>暂无图片<?php else: ?><img src="<?php echo $this->_tpl_vars['goods']['img']['labelimg']; ?>
" width="48"style="vertical-align: middle;" /><?php endif; ?></span>
                <input type="file" class="text-input medium-input" name="labelimg" />
                </p>
              <dt>
              	<input name="token" type="hidden" value="<?php echo $this->_tpl_vars['upload_token']; ?>
">
                <input type="submit" name="" id="button" class="button" value="<?php if ($this->_tpl_vars['goods']['goods_id']): ?>编辑<?php else: ?>添加<?php endif; ?>" />
                
                <input type="button" class="button" value="打印图片" onclick="window.open('<?php echo smarty_function_get_url(array('rule' => '/goods/goodsimgprint'), $this);?>
-gid-<?php echo $this->_tpl_vars['goods']['goods_no']; ?>
');" />
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