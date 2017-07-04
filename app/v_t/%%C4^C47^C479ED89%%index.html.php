<?php /* Smarty version 2.6.26, created on 2017-06-27 14:54:38
         compiled from simpla/hospital/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/hospital/index.html', 13, false),array('modifier', 'cat', 'simpla/hospital/index.html', 74, false),)), $this); ?>
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
    <p id="page-intro">查看和管理所有医院。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>医院管理</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">医院查询</a></li>
            <?php if (2 == 1): ?>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/addhospital"), $this);?>
">添加医院</a></li>
            <?php endif; ?>
            <!-- 
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/officeindex"), $this);?>
">科室查询</a></li>
        	<li><a href="<?php echo smarty_function_get_url(array('rule' => "/hospital/addoffice"), $this);?>
">添加科室</a></li>
        	 -->
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/hospital/index'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                <p>区县： <span>
                    <select id="one" name="district_id">
                        <option value="0">-----选择区县-----</option>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['districtList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <option value="<?php echo $this->_tpl_vars['districtList'][$this->_sections['i']['index']]['district_id']; ?>
" <?php if ($this->_tpl_vars['districtList'][$this->_sections['i']['index']]['district_id'] == $this->_tpl_vars['district_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['districtList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['districtList'][$this->_sections['i']['index']]['name']; ?>
</option>
                        <?php endfor; endif; ?>
                    </select></span>&nbsp;关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" />
                    <span>（名称，编号）<input type="submit" name="" id="button" class="button" value="查询" /></span>
                    <?php if (2 == 1): ?>
                    &nbsp;<span><input type="button" class="button" onclick="gotoadd();" value="添加医院" /></span>
                    <?php if ($this->_tpl_vars['button']['hospital_syncdata'] == 1): ?>
                     &nbsp;<span><input type="button" class="button" onclick="syncdata();" value="一键同步工程部数据" /></span></p>
                    <?php endif; ?> 
                    <?php endif; ?> 
                     
            </fieldset>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>编号</th>
                <th>名称</th>
                <th>区县</th>
                <th>级别</th>
                <th>医院等级</th>
                <th>邮编</th>
                <th>地址</th>
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
                <tr>
                  <td><?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['code']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['district_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['level']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_level']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['post_code']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['address']; ?>
</td>
                  <td>
                  	<a href="<?php echo smarty_function_get_url(array('rule' => '/hospital/officeindex','data' => ((is_array($_tmp='hid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id']))), $this);?>
" title="查询科室"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/list.png" alt="查询科室" /></a>
                    <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/hospital/addhospital','data' => ((is_array($_tmp='hid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id']))), $this);?>
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
    <script>
		function gotoadd(){
			window.location.href = '<?php echo smarty_function_get_url(array('rule' => "/hospital/addhospital"), $this);?>
';	
		}
		
		function syncdata(){
			if(!confirm("数据同步将会从工程部数据中导入新增医院及科室信息，确认要导入吗？")){
				return false;
			}
			window.location.href = '<?php echo smarty_function_get_url(array('rule' => "/hospital/syncdata"), $this);?>
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