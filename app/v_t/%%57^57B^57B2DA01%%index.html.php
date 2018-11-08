<?php /* Smarty version 2.6.26, created on 2017-02-06 14:06:22
         compiled from simpla/reagent/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/reagent/index.html', 12, false),)), $this); ?>
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
    <p id="page-intro">查看和管理所有试剂。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>试剂查询</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">试剂查询</a></li>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/reagent/addreagent"), $this);?>
">导入试剂</a></li>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/reagent/logindex"), $this);?>
">更新记录</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/reagent/index'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                <p>设备类型： 
                	<span>
	                    <select id="device" name="device" onchange="selectModel();">
	                        <option value="0">--选择设备类型--</option>
	                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['deviceList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	                        <option value="<?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['device_id']; ?>
" <?php if ($this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['device_id'] == $this->_tpl_vars['device']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['deviceList'][$this->_sections['i']['index']]['device_name']; ?>
</option>
	                        <?php endfor; endif; ?>
	                    </select>
                    </span>
                    机型： 
                	<span>
	                    <select id="model" name="model">
	                        <option value="0">--选择机型--</option>
	                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['modelList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	                        <option value="<?php echo $this->_tpl_vars['modelList'][$this->_sections['i']['index']]['model_id']; ?>
" <?php if ($this->_tpl_vars['modelList'][$this->_sections['i']['index']]['model_id'] == $this->_tpl_vars['model']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['modelList'][$this->_sections['i']['index']]['model_name']; ?>
</option>
	                        <?php endfor; endif; ?>
	                    </select>
                    </span>
                    &nbsp;关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" />
                    <span>（商品名称，通用名，厂商）<input type="submit" name="" id="button" class="button" value="查询" /></span>
                 </p>
            </fieldset>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>商品编号</th>
                <th>商品名称</th>
                <th>设备类型</th>
                <th>机型</th>
                <th>通用名</th>
                <th>储存条件</th>
                <th>单位</th>
                <th>规格</th>
                <th>注册证号/备案凭证号</th>
                <th>批准文号有效期至</th>
                <th>厂商全名</th>
                <th>适用机型</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td colspan="12"><?php echo $this->_tpl_vars['pagebar']; ?>
</td>
              </tr>
            </tfoot>
            <tbody>
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['reagentList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['code']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['device_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['model_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['generate_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['storage_condition']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['unit']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['specs']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['regist_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['valid_date']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['manufacturer']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['reagentList'][$this->_sections['i']['index']]['apply_to']; ?>
</td>
                </tr>
                <?php endfor; endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      </form>
    </div>
    <script>
    	function selectModel(){
    		var deviceId = $('#device').val();
    		$.post("<?php echo smarty_function_get_url(array('rule' => '/reagent/getmodelopt'), $this);?>
",{
    			device_id : deviceId
    		},function(res){
    			console.log(res);
    			//alert(res.data.length);
    			if(res.code == 0){
    				$("#model").html('');
    				$("#model").append( "<option value=\"0\">--选择机型--</option>" );
    				for(var i=0;i<res.data.length;i++){
    					//alert(res.data[i].model_id);
    					$("#model").append( "<option value=\""+res.data[i].model_id+ "\">"+res.data[i].model_name+"</option>" );
    				}
    			}else{
    				//jQuery.facebox(res.msg);
    			}
    		},'json');
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