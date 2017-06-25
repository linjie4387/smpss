<?php /* Smarty version 2.6.26, created on 2017-05-10 11:00:28
         compiled from simpla/delivery/manlist.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/manlist.html', 66, false),array('modifier', 'cat', 'simpla/delivery/manlist.html', 81, false),)), $this); ?>
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
    <p id="page-intro">查看和管理送货单送货员信息</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <a href="javascript:history.go(-1);" class="btn-back" title="后退"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/back.png" /></a>
        <h3>送货单_<?php echo $this->_tpl_vars['delivery_id']; ?>
&nbsp;送货员管理</h3>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <div class="form">
                <?php if ($this->_tpl_vars['delivery_status'] == 1): ?>
                <fieldset>
                    <span><input type="button" class="button" onclick="gotoadd();" value="添加送货员" /></span>
                </fieldset>
                <?php endif; ?>
            </div>
          <hr />
          <table>
            <thead>
              <tr>
                <th>送货单号</th>
                <th>送货员姓名</th>
                <th>送货员手机号码</th>
                <?php if ($this->_tpl_vars['delivery_status'] == 1): ?>
                <th>管理</th>
                <?php endif; ?>
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
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['manList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['delivery_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['manList'][$this->_sections['i']['index']]['deliveryman_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['manList'][$this->_sections['i']['index']]['deliveryman_mobile']; ?>
</td>
                  <?php if ($this->_tpl_vars['delivery_status'] == 1): ?>
                  <td>
                      <a style="margin:10px;" title="删除" onclick="javascript:del_man('<?php echo $this->_tpl_vars['manList'][$this->_sections['i']['index']]['withman_id']; ?>
')">
                          <img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/delete.png" alt="删除" />
                      </a>
                  </td>
                  <?php endif; ?>
                </tr>
                <?php endfor; endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script>
        function del_man(withmanId){
            //$("#button").click();
            //return;
            if(!confirm("确定要删除该送货员吗？")){
                return;
            }
            $.post("<?php echo smarty_function_get_url(array('rule' => '/delivery/deletewithman'), $this);?>
",{
                   withman_id : withmanId
                   },function(res){
                   console.log(res);
                   if(res.code == 0){
                   alert("送货员删除成功！");
                   //jQuery.facebox("操作成功！");
                   //$("#button").click();
                   window.location.reload();
                   }else{
                   jQuery.facebox(res.msg);
                   }
                   },'json');
        }
        function gotoadd(){
            window.location.href = "<?php echo smarty_function_get_url(array('rule' => '/delivery/addwithman','data' => ((is_array($_tmp='did=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['delivery_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['delivery_id']))), $this);?>
";
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