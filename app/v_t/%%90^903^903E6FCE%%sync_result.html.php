<?php /* Smarty version 2.6.26, created on 2016-04-29 14:17:56
         compiled from simpla/hospital/sync_result.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="main-content">
	<h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
	<p id="page-intro">数据同步结果。</p>
	<div class="clear"></div>
	<div class="content-box">
		<div class="content-box-header">
			<h3>数据同步结果</h3>
			<ul class="content-box-tabs">
				<li><a href="#tab1" class="default-tab">数据同步结果</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="content-box-content">
			<?php echo $this->_tpl_vars['info']; ?>

		</div>
		
		<hr />
          <table>
            <thead>
              <tr>
                <th>医院编号</th>
                <th>执信医疗医院名称</th>
                <th>工程部医院名称</th>
              </tr>
            </thead>
            <tbody>
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['result_list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['result_list'][$this->_sections['i']['index']]['code']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['result_list'][$this->_sections['i']['index']]['hospital_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['result_list'][$this->_sections['i']['index']]['engineer_name']; ?>
</td>
                </tr>
                <?php endfor; else: ?>
                <tr>
				   	<td colspan="3">没有不一致数据。</td>
				 </tr>
                <?php endif; ?>
            </tbody>
          </table>
		
	</div>
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