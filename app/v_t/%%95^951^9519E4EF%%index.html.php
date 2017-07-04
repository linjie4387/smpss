<?php /* Smarty version 2.6.26, created on 2017-06-27 14:58:27
         compiled from simpla/goods/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/goods/index.html', 14, false),array('modifier', 'cat', 'simpla/goods/index.html', 87, false),)), $this); ?>
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
    <p id="page-intro">查看和管理所有商品。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>商品管理</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">商品管理</a></li>
            <?php if (2 == 1): ?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/goods/addgoods"), $this);?>
">添加商品</a></li>
            <?php endif; ?>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            
        <div class="form">
            <fieldset>
            	<form action="<?php echo smarty_function_get_url(array('rule' => '/goods/index'), $this);?>
" method="post" id="js-form">
            	<p>厂商：<input type="text" value="<?php echo $this->_tpl_vars['manu']; ?>
" placeholder="厂商信息" style="width:120px !important;" class="text-input small-input" name="manu" />
            	项目品类：<input type="text" value="<?php echo $this->_tpl_vars['category']; ?>
" placeholder="项目品类" class="text-input small-input" name="category" />
                关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" placeholder="编码，名称，备注" class="text-input small-input" name="key" />
               <input type="submit" name="" id="button" class="button" value="查询" />&nbsp;
               <?php if (2 == 1): ?>
               <input type="button" class="button" onclick="gotoadd();" value="添加商品" />&nbsp;
               <?php endif; ?>
            	<input type="button" id="exportBtn" class="button" value="导出" title="导出所有商品信息。" />&nbsp; 
               <input type="button" id="importBtn" class="button" onclick="$('#uploadxls input[type=file]').click();" value="导入" title="导入所有商品信息。" />
            	</form>
            	</p>
            </fieldset>
            
            <form id="uploadxls" style="display:none;" tabindex="-1" action="<?php echo smarty_function_get_url(array('rule' => "/goods/import"), $this);?>
" method="post" enctype="multipart/form-data" target="upiframe">
			    <input type="file" id="file" name="file"><input type="hidden" name="upload" id="upload" value="" />
			    <iframe src="about:blank" tabindex="-1" style="display:none;"  name="upiframe"></iframe>
			</form>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>编码</th>
                <th>注册名</th>
                <th>通用名</th>
                <th>单位</th>
                <th>规格</th>
                <th>包装</th>
                <th>厂商</th>
                <th>适用机型</th>
                <th>品类</th>
                <th>色标</th>
                <th>备注</th>
                <th>管理</th>
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
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['goodsList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_no']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['extern_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['unit']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['specification']; ?>
</td>
                  <td>
                      <?php if ($this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['is_20l'] == 1): ?>
                      大
                      <?php else: ?>
                      小
                      <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['manu']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['machine']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['category']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['colorcode']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['remark']; ?>
</td>
                  <td>
                    <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/goods/addgoods','data' => ((is_array($_tmp='gid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_id']))), $this);?>
" title="编辑">
                  		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/edit.png" alt="编辑" />
                  	</a>
                    </td>
                </tr>
                <?php endfor; endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      </form>
    </div>
    <script language="JavaScript">
    	
    	$(function(){
    		$('#exportBtn').click(function(){
    			window.open('<?php echo smarty_function_get_url(array('rule' => "/goods/export"), $this);?>
');
    		});
    		$('#uploadxls input[type=file]').change(function(){
    			var loadLayer = layer.load();
  				$('#uploadxls').submit();
  				$('#uploadxls iframe').off('load');
				$('#uploadxls iframe').on('load',function(){
					layer.close(loadLayer);   
					try{
						var data = JSON.parse($(this).contents().find('body').text());
					}catch(e){
						var data = {status:-1,msg:''};
					}
					$('#uploadxls input[type=file]').val(null);
					jQuery.facebox(data.msg);
					if(data.code == 0){
						setTimeout(function(){
							window.location.href = '<?php echo smarty_function_get_url(array('rule' => "/goods/index"), $this);?>
';
						},2000);
					}
				});
  			});
    	});
    	
		function gotoadd(){
			window.location.href = '<?php echo smarty_function_get_url(array('rule' => "/goods/addgoods"), $this);?>
';
		}
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