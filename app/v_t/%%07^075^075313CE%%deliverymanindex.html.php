<?php /* Smarty version 2.6.26, created on 2017-05-13 09:44:41
         compiled from simpla/delivery/deliverymanindex.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/deliverymanindex.html', 12, false),array('modifier', 'cat', 'simpla/delivery/deliverymanindex.html', 66, false),)), $this); ?>
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
    <p id="page-intro">查看和管理所有送货员。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>送货员管理</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">送货员管理</a></li>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/delivery/adddeliveryman"), $this);?>
">添加送货员</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/manadm'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                <p>关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" />
                    <span>（姓名，手机号码）<input type="submit" name="" id="button" class="button" value="查询" /></span>
                    &nbsp;<span><input type="button" class="button" onclick="gotoadd();" value="添加送货员" /></span>
            </fieldset>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>送货员标识</th>
                <th>姓名</th>
                <th>手机号码</th>
                <th>微信用户</th>
                <th>是否是司机</th>
                <th>驾照类型</th>
                <th>添加时间</th>
                <th>添加人</th>
                <th>是否占用</th>
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
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['deliveryman_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['mobile']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['weichatuser_name']; ?>
</td>
                  <td>
                      <?php if ($this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['is_driver'] == 1): ?>
                      是
                      <?php else: ?>
                      否
                      <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['driverlicense_type_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['create_time']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['admin_name']; ?>
</td>
                  <td><?php if ($this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['isrun'] == 0): ?>空闲<?php else: ?> <span style="color: #FF0000;">占用</span> <?php endif; ?></td>
                  <td>
                    <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/delivery/adddeliveryman','data' => ((is_array($_tmp='did=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['deliveryman_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['deliveryman_id']))), $this);?>
" title="编辑">
                  		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/edit.png" alt="编辑" />
                  	</a>
                  	<a style="margin:10px;" onclick="javascript:do_del_man('<?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['name']; ?>
', '<?php echo $this->_tpl_vars['deliverymanList'][$this->_sections['i']['index']]['deliveryman_id']; ?>
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
			window.location.href = '<?php echo smarty_function_get_url(array('rule' => "/delivery/adddeliveryman"), $this);?>
';
		}
		
		function do_del_man(name, deliveryman_id,obj){
			if(!confirm("确定要删除送货员["+name+"]吗？")){
				return;
			}
			$.post("<?php echo smarty_function_get_url(array('rule' => '/delivery/deldeliveryman'), $this);?>
",{
				deliveryman_id : deliveryman_id
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