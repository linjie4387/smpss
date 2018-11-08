<?php /* Smarty version 2.6.26, created on 2018-04-26 13:47:00
         compiled from simpla/user/hospitalindex.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/user/hospitalindex.html', 17, false),array('modifier', 'cat', 'simpla/user/hospitalindex.html', 86, false),)), $this); ?>
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
    <p id="page-intro">查看和管理所有医院微信用户。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>医院微信用户管理</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">医院微信用户查询</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/user/hospitalindex'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                <p>用户状态： 
                	<span>
                        <select id="user_status" name="status">
                            <option value="0">-----选择用户状态-----</option>
                            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['userstatusList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <option value="<?php echo $this->_tpl_vars['userstatusList'][$this->_sections['i']['index']]['value']; ?>
" <?php if ($this->_tpl_vars['userstatusList'][$this->_sections['i']['index']]['value'] == $this->_tpl_vars['status']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['userstatusList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['userstatusList'][$this->_sections['i']['index']]['name']; ?>
</option>
                            <?php endfor; endif; ?>
                        </select>
                    </span>
                    &nbsp;关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" />
                    <span>（姓名，手机，医院）</span>
                </p>    
                <p>用户类型： 
                	<span>
                        <select id="user_type" name="user_type">
                            <option value="0">-----选择用户类型-----</option>
                            <option value="1" <?php if ($this->_tpl_vars['user_type'] == 1): ?>selected="selected"<?php endif; ?>>医院用户</option>
                            <option value="3" <?php if ($this->_tpl_vars['user_type'] == 3): ?>selected="selected"<?php endif; ?>>代下单用户</option>
                        </select>
                    </span>
                是否关注： <span>
                        <select id="subscribe" name="subscribe">
                            <option value="0">-----选择关注状态-----</option>
                            <option value="1" <?php if ($this->_tpl_vars['subscribe'] == 1): ?>selected="selected"<?php endif; ?>>是</option>
                            <option value="2" <?php if ($this->_tpl_vars['subscribe'] == 2): ?>selected="selected"<?php endif; ?>>否</option>
                        </select>
                            
                		<input type="submit" name="" id="button" class="button" value="查询" />
                	</span>
                </p>
            </fieldset>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>微信OPENID</th>
                <th style="display:none">是否关注</th>
                <th>名称</th>
                <th>手机</th>
                <th>类型</th>
                <th>等级</th>
                <th>医院</th>
                <th>科室</th>
                <th>状态</th>
                <th>管理</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td colspan="6"><?php echo $this->_tpl_vars['pagebar']; ?>
</td>
              </tr>
            </tfoot>
            <tbody>
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['weichatuserList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['open_id']; ?>
</td>
                  <td style="display:none"><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['subscribe_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['mobile']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['type_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['level_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['hospital_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['office_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['status_name']; ?>
</td>
                  <td>
                  	<a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/user/addhospitaluser','data' => ((is_array($_tmp='uid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['weichatuser_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['weichatuser_id']))), $this);?>
" title="编辑">
                  		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/edit.png" alt="编辑" />
                  	</a>&nbsp;
                  	<?php if ($this->_tpl_vars['button']['user_deluser'] == 1): ?>&nbsp;
                  	<a style="margin:10px;" onclick="javascript:do_del_user('<?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['name']; ?>
',<?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['weichatuser_id']; ?>
,this)" title="删除">
                  		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/delete.png" alt="删除" />
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
    
<script>
    function do_del_user(uname, uid,obj){
		if(!confirm("确定要删除用户["+uname+"]吗？")){
			return;
		}
		$.post("<?php echo smarty_function_get_url(array('rule' => '/user/deletehospitaluser'), $this);?>
",{
			weichatuser_id : uid
		},function(res){
			console.log(res);
			if(res.code == 0){
				jQuery.facebox("操作成功！");
				$(obj).parent().parent().remove();
				//$("#r_"+oid).remove();
				//$("#s_"+oid).html("已取消");
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