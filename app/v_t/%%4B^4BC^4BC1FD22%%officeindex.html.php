<?php /* Smarty version 2.6.26, created on 2017-06-27 14:56:57
         compiled from simpla/hospital/officeindex.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/hospital/officeindex.html', 17, false),array('modifier', 'cat', 'simpla/hospital/officeindex.html', 89, false),)), $this); ?>
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
<style>
.c_g {color:#f00;}
.c_b {color:#666666; margin-top:-2px;}
</style>
<div id="main-content">
    <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
    <p id="page-intro">查看和管理所有科室。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>科室查询</h3>
        <ul class="content-box-tabs">
        <!-- 
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/index"), $this);?>
">医院查询</a></li>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/addhospital"), $this);?>
">添加医院</a></li>
         -->
            <li><a href="#tab1" class="default-tab">科室查询</a></li>
            <?php if (2 == 1): ?>
        	<li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/addoffice"), $this);?>
">添加科室</a></li>
            <?php endif; ?>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            
        <div class="form">
            <fieldset>
                <p><form action="<?php echo smarty_function_get_url(array('rule' => '/hospital/officeindex'), $this);?>
" method="post" id="js-form">
                	医院： <span>
                    <select id="one" name="hospital_id">
                        <option value="0">-----选择医院-----</option>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['hospitalList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <option value="<?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id']; ?>
" <?php if ($this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id'] == $this->_tpl_vars['hospital_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['name']; ?>
</option>
                        <?php endfor; endif; ?>
                    </select></span>
                    &nbsp;关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" /><span>（医院名称, 科室名称）</span>
                    <br/><span>科室商品：</span>
                    <input type="radio" name="product[]" value="0" <?php if ($this->_tpl_vars['product'] == 0): ?>checked<?php endif; ?>>所有&nbsp;&nbsp;
                    <input type="radio" name="product[]" value="1" <?php if ($this->_tpl_vars['product'] == 1): ?>checked<?php endif; ?>>已配置&nbsp;&nbsp;
                    <input type="radio" name="product[]" value="2" <?php if ($this->_tpl_vars['product'] == 2): ?>checked<?php endif; ?>>未配置&nbsp;&nbsp;
                    
                    <input type="submit" name="" id="button" class="button" value="查询" />
                    &nbsp;
                    <?php if (2 == 1): ?>
                    <span><input type="button" class="button" onclick="gotoadd();" value="添加科室" /></span>&nbsp; 
                    <input type="button" id="exportBtn" class="button" value="导出" title="导出所有科室信息。" />&nbsp; 
               		<input type="button" id="importBtn" class="button" onclick="$('#uploadxls input[type=file]').click();" value="导入" title="导入所有科室商品信息。" />
                    <?php endif; ?>
               </p></form>
            </fieldset>
            
            <form id="uploadxls" style="display:none;" tabindex="-1" action="<?php echo smarty_function_get_url(array('rule' => "/hospital/importOfficeGoods"), $this);?>
" method="post" enctype="multipart/form-data" target="upiframe">
			    <input type="file" id="file" name="file"><input type="hidden" name="upload" id="upload" value="" />
			    <iframe src="about:blank" tabindex="-1" style="display:none;"  name="upiframe"></iframe>
			</form>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>医院名称</th>
                <th>科室名称</th>
                <th>联系人</th>
                <th>联系电话</th>
                <th>创建管理员</th>
                <th>创建时间</th>
                <th>管理</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td colspan="7"><?php echo $this->_tpl_vars['pagebar']; ?>
</td>
              </tr>
            </tfoot>
            <tbody>
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['officeList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['hospital_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['contact_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['contact_phone']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['admin_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['create_time']; ?>
</td>
                  <td>
                  	<a href="<?php echo smarty_function_get_url(array('rule' => '/hospital/addoffice','data' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='hid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['hospital_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['hospital_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&oid=') : smarty_modifier_cat($_tmp, '&oid=')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['office_id']))), $this);?>
" title="编辑">
                  		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/edit.png" alt="编辑" />
                  	</a>
                    <?php if ($this->_tpl_vars['button']['hospital_preorderprint'] == 1): ?>&nbsp;
                    <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/hospital/setofficegoods','data' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='hid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['hospital_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['hospital_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&oid=') : smarty_modifier_cat($_tmp, '&oid=')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['office_id']))), $this);?>
" title="设置商品">
                        <?php if ($this->_tpl_vars['officeList'][$this->_sections['i']['index']]['hasGoods'] == 0): ?>
                        <i class="icon-cogs icon-large c_b" alt="设置商品"></i>
                        <?php else: ?>
                        <i class="icon-cogs icon-large" alt="设置商品"></i>
                        <?php endif; ?>
                    </a>
                    <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/hospital/printofficegoods','data' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='hid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['hospital_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['hospital_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&oid=') : smarty_modifier_cat($_tmp, '&oid=')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['office_id']))), $this);?>
" title="打印单据">
                        <img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/print.png" alt="打印单据" />
                    </a>
                    <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/hospital/forecastofficegoods','data' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='hid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['hospital_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['hospital_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&oid=') : smarty_modifier_cat($_tmp, '&oid=')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['officeList'][$this->_sections['i']['index']]['office_id']))), $this);?>
" title="销量预测">
                        <img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/bullish.png" alt="销量预测" />
                    </a>
                    <?php endif; ?>
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
    			var hospital_id = $('#one').val();
    			window.open('<?php echo smarty_function_get_url(array('rule' => "/hospital/exportOfficeGoods"), $this);?>
?hospital_id='+hospital_id+'');
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
							window.location.href = '<?php echo smarty_function_get_url(array('rule' => "/hospital/officeindex"), $this);?>
';
						},2000);
					}
				});
  			});
    	});
    	
		function gotoadd(){
			window.location.href = '<?php echo smarty_function_get_url(array('rule' => "/hospital/addoffice"), $this);?>
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