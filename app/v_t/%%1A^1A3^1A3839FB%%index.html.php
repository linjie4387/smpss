<?php /* Smarty version 2.6.26, created on 2017-05-19 14:01:12
         compiled from simpla/account/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/account/index.html', 12, false),array('modifier', 'cat', 'simpla/account/index.html', 44, false),)), $this); ?>
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
  <p id="page-intro">查看所有管理员账号。</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>账号管理</h3>
      <ul class="content-box-tabs">
        <li><a href="#tab1" class="default-tab">账号管理</a></li>
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/account/addaccount"), $this);?>
">添加账号</a></li>
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/account/modifypwd"), $this);?>
">密码修改</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/account/index'), $this);?>
" method="post" id="js-form">
        <hr />              
        <table>
          <thead>
            <tr>
              <th>用户名称</th>
              <th>用户组</th>
              <th>接单公司</th>
              <th>微信用户</th>
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
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['account']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
            <td><?php echo $this->_tpl_vars['account'][$this->_sections['i']['index']]['admin_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['account'][$this->_sections['i']['index']]['group_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['account'][$this->_sections['i']['index']]['order_company_name']; ?>
</td>
            <td><?php echo $this->_tpl_vars['account'][$this->_sections['i']['index']]['weichatuser_name']; ?>
</td>
            <td>
            	<a style="padding:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/account/index','data' => ((is_array($_tmp='aid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['account'][$this->_sections['i']['index']]['admin_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['account'][$this->_sections['i']['index']]['admin_id']))), $this);?>
" title="编辑">
            		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/edit.png" alt="编辑" />
            	</a>&nbsp;
            	<a style="padding:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/system/rights','data' => ((is_array($_tmp='gid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['account'][$this->_sections['i']['index']]['gid']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['account'][$this->_sections['i']['index']]['gid']))), $this);?>
" title="查看权限">
            		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/info.png" alt="查看权限" />
            	</a>
                <a style="margin:10px;" onclick="javascript:delAccount('<?php echo $this->_tpl_vars['account'][$this->_sections['i']['index']]['admin_name']; ?>
',<?php echo $this->_tpl_vars['account'][$this->_sections['i']['index']]['admin_id']; ?>
)" title="删除">
                  	<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/delete.png" alt="删除" />
                </a>
            </td>
          </tr>
          <?php endfor; endif; ?>
            </tbody>
        </table>
      </div>
      </form>
    </div>
    <script type="text/javascript">
    function delAccount(uname, uid){
	    if(!confirm("确定要删除账号["+uname+"]吗？")){
			return;
		}
		$.post("<?php echo smarty_function_get_url(array('rule' => '/account/delaccount'), $this);?>
",{
			aid : uid
		},function(res){
			console.log(res);
			if(res.code == 0){
				alert("操作成功！");
				window.location.reload();
			}else{
				jQuery.facebox(res.msg);
			}
		},'json');
    }
    </script>
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