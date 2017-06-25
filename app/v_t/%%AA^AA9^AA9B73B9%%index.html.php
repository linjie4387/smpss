<?php /* Smarty version 2.6.26, created on 2017-05-10 10:57:23
         compiled from simpla/delivery/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/index.html', 13, false),array('modifier', 'cat', 'simpla/delivery/index.html', 65, false),)), $this); ?>
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
    <p id="page-intro">查看和管理所有送货信息。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>已指派任务</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">已指派任务</a></li>
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/delivery/adddelivery"), $this);?>
">待指派任务</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/index'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                <p>关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" />
                <span>（车牌号，司机姓名）&nbsp;发货状态： <span>
                    <select id="one" name="status">
                        <option value="0">-----选择状态-----</option>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['deliverystatusList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <option value="<?php echo $this->_tpl_vars['deliverystatusList'][$this->_sections['i']['index']]['value']; ?>
" <?php if ($this->_tpl_vars['deliverystatusList'][$this->_sections['i']['index']]['value'] == $this->_tpl_vars['status']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['deliverystatusList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['deliverystatusList'][$this->_sections['i']['index']]['name']; ?>
</option>
                        <?php endfor; endif; ?>
                    </select></span>&nbsp;&nbsp;<input type="submit" name="" id="btnQry" class="button" value="查询" /></span>
                    &nbsp;<span><input type="button" class="button" onclick="gotoadd();" value="待指派任务" /></span>
            </fieldset>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
                <th>送货单号</th>
                <th>车牌号</th>
                <th>司机姓名</th>
                <th>司机手机</th>
                <th>大包装数量</th>
                <th>状态</th>
                <th>创建时间</th>
                <th>发车时间</th>
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
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['deliveryList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['delivery_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['car_license']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['driver_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['driver_mobile']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['20l_quantity']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['status_name']; ?>
<br> 备注:<span style="color: #008000;"><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['remark']; ?>
</span> </td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['create_time']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['delivery_time']; ?>
</td>
                  <td>
                      <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/delivery/deliverygoodslist','data' => ((is_array($_tmp='did=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['delivery_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['delivery_id']))), $this);?>
" title="物品清单">
                          <img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/list.png" alt="物品清单" />
                      </a>
                    <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/delivery/deliverymanlist','data' => ((is_array($_tmp='did=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['delivery_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['delivery_id']))), $this);?>
" title="送货员">
                  		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/workers.png" alt="送货员" />
                  	</a>
                  	<a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/delivery/deliverydmanlist','data' => ((is_array($_tmp='did=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['delivery_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['delivery_id']))), $this);?>
" title="司机">
                  		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/drivers.png" alt="司机" />
                  	</a>
                  	<?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['status'] != 3 && $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['status'] != 4): ?>
                  	<a style="margin:10px;" onclick="javascript:do_del('<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['delivery_id']; ?>
', this);" title="终止" >
                  		<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/delete.png" alt="终止" />
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
		function gotoadd(){
			window.location.href = '<?php echo smarty_function_get_url(array('rule' => "/delivery/adddelivery"), $this);?>
';
		}
		
		function do_del(delivery_id, obj){
			
			layer.prompt({title:"确定要中止订单号["+delivery_id+"]吗？",success: function(){
					$('.layui-layer-content').prepend('<p> 请填写备注信息：</p>');
					$('.layui-layer-content').append('<br>修改状态:<input type="checkbox" style="vertical-align: middle;" /> 无法送达');
				}},
				function(val, index){
					var isUnable = $('.layui-layer-content input[type="checkbox"]').is(':checked')||0;
					$.post("<?php echo smarty_function_get_url(array('rule' => '/delivery/cancelDelivery'), $this);?>
",{
						delivery_id : delivery_id,isUnable:isUnable,remark:val
					},function(res){
						if(res.code == 0){
							jQuery.facebox("操作成功！");
							$("#btnQry").click();
						}else{
							jQuery.facebox(res.msg);
						}
					},'json');
				  	layer.close(index);
				}
			);
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