<?php /* Smarty version 2.6.26, created on 2017-06-07 21:20:29
         compiled from simpla/delivery/carindex.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/carindex.html', 12, false),array('modifier', 'cat', 'simpla/delivery/carindex.html', 64, false),)), $this); ?>
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
    <p id="page-intro">查看和管理所有车辆。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>车辆管理</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">车辆管理</a></li>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/delivery/addcar"), $this);?>
">添加车辆</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/caradm'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                <p>关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" />
                    <span>（车牌号）<input type="submit" name="" id="button" class="button" value="查询" /></span>
                    &nbsp;<span><input type="button" class="button" onclick="gotoadd();" value="添加车辆" /></span>
            </fieldset>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>车牌标识</th>
                <th>车牌号</th>
                <th>牌照类型</th>
                <th>准驾车型</th>
                <th>型号</th>
                <th>容量</th>
                <th>添加时间</th>
                <th>状态</th>
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
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['carList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['car_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['car_license']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['license_type_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['mold']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['model']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['volume']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['create_time']; ?>
</td>
                  <td>
                  <?php if ($this->_tpl_vars['carList'][$this->_sections['i']['index']]['isrun'] == 1): ?>
                  <span style="color:#F00">占用</span>
                  <?php else: ?>
                  <span>空闲</span>
                  <?php endif; ?>
                  </td>
                  <td>
                    <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/delivery/addcar','data' => ((is_array($_tmp='cid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['carList'][$this->_sections['i']['index']]['car_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['carList'][$this->_sections['i']['index']]['car_id']))), $this);?>
" title="编辑">
                  		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/edit.png" alt="编辑" />
                  	</a>
                  	<a style="margin:10px;" onclick="javascript:do_del_car('<?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['car_license']; ?>
', '<?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['car_id']; ?>
', this);" title="删除">
                  		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/delete.png" alt="删除" />
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
    <script>
		function gotoadd(){
			window.location.href = '<?php echo smarty_function_get_url(array('rule' => "/delivery/addcar"), $this);?>
';
		}
		
		function do_del_car(car_no, car_id,obj){
			if(!confirm("确定要删除车牌号为["+car_no+"]的车辆吗？")){
				return;
			}
			$.post("<?php echo smarty_function_get_url(array('rule' => '/delivery/delcar'), $this);?>
",{
				car_id : car_id
			},function(res){
				if(res.code == 0){
					jQuery.facebox("操作成功！");
					$(obj).parent().parent().remove();
				}else{
					jQuery.facebox(res.msg);
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