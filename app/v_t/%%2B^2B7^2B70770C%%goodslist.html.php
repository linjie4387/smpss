<?php /* Smarty version 2.6.26, created on 2017-05-10 11:22:09
         compiled from simpla/delivery/goodslist.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/goodslist.html', 16, false),array('modifier', 'cat', 'simpla/delivery/goodslist.html', 57, false),)), $this); ?>
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
    <p id="page-intro">查看和管理送货单货品信息</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <a href="javascript:history.go(-1);" class="btn-back" title="后退"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/back.png" /></a>
        <h3>送货单_<?php echo $this->_tpl_vars['delivery_id']; ?>
&nbsp;货品管理</h3>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/deliverygoodslist'), $this);?>
" method="post" id="js-form">
              <div class="form">
                <fieldset>
                    <input type="hidden" value="<?php echo $this->_tpl_vars['delivery_id']; ?>
" name="delivery_id" />
                    签收状态： <span>
                        <select id="one" name="status">
                            <option value="0">-----选择状态-----</option>
                            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['signstatusList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <option value="<?php echo $this->_tpl_vars['signstatusList'][$this->_sections['i']['index']]['value']; ?>
" <?php if ($this->_tpl_vars['signstatusList'][$this->_sections['i']['index']]['value'] == $this->_tpl_vars['status']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['signstatusList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['signstatusList'][$this->_sections['i']['index']]['name']; ?>
</option>
                            <?php endfor; endif; ?>
                        </select></span> <input type="submit" name="" id="button" class="button" value="查询" /></span>
                    <?php if ($this->_tpl_vars['delivery_status'] == 1): ?>
                        &nbsp;<span><input type="button" class="button" onclick="gotoadd();" value="添加货品" /></span>
                    <?php endif; ?>
                </fieldset>
            </div>
          <hr />
          <table>
            <thead>
              <tr>
                <th>送货单号</th>
                <th>正式单号</th>
                <th>医院名称</th>
                <th>科室名称</th>
                <th>货品类型</th>
                <th>接单备注</th>
                <th>签收状态</th>
                <th>签收时间</th>
                <th>签收备注</th>
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
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['goodsList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <tr <?php if ($this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['is_valid'] == 2): ?>style="text-decoration:line-through;"<?php endif; ?>>
                  <td><?php echo $this->_tpl_vars['delivery_id']; ?>
</td>
                  <td><a href="<?php echo smarty_function_get_url(array('rule' => '/order/orderdetail','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['order_id']))), $this);?>
" title="正式单"><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['order_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['hospital_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['office_name']; ?>
</td>
                  <td>
                      <?php if ($this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['type'] == '商品'): ?>
                      <a href="<?php echo smarty_function_get_url(array('rule' => '/order/addrecord','data' => ((is_array($_tmp=((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['order_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&readonly=1') : smarty_modifier_cat($_tmp, '&readonly=1'))), $this);?>
" title="商品明细">
                      <?php else: ?>
                      <a title="<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['invoice_no']; ?>
"/>
                      <?php endif; ?>
                      <?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['type']; ?>

                  </td>
                  <td style="color:red;"><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['order_remark']; ?>
</td>
                  <td>
                  	<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['sign_status_name']; ?>

                  </td>
                  <td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['sign_time']; ?>
</td>
                  <td style="color:red;"><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['remark']; ?>
</td>
                  <td>
                  	<?php if ($this->_tpl_vars['delivery_status'] == 1): ?>
                      <a style="margin:10px;" title="删除" onclick="javascript:del_goods('<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['withgoods_id']; ?>
')">
                          <img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/delete.png" alt="删除" />
                      </a>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['sign_status'] > 2): ?>
                      <a style="margin:10px;" title="修改备注信息" onclick="javascript:edit_goods('<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['withgoods_id']; ?>
')">
                          <img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/edit.png" alt="修改备注信息" style="cursor: pointer;" />
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
    	function edit_goods(withgoodsId){
			layer.prompt({title:"请填写备注信息:",success: function(){
					$('.layui-layer-content').prepend('<p> 请填写备注信息：</p>');
					$('.layui-layer-content').append('<br>修改状态:<input type="checkbox" style="vertical-align: middle;" /> 已签收');
				}},
				function(val, index){
					var isSign = $('.layui-layer-content input[type="checkbox"]').is(':checked')||0;
					$.post("<?php echo smarty_function_get_url(array('rule' => '/delivery/editwithgoods'), $this);?>
",{
						withgoods_id :withgoodsId,remark:val,isSign:isSign
					},function(res){
						if(res.code == 0){
							jQuery.facebox("操作成功！");
							window.location.reload();
						}else{
							jQuery.facebox(res.msg);
						}
					},'json');
				  	layer.close(index);
				}
			);
        }
    	
    	
        function del_goods(withgoodsId){
            //$("#button").click();
            //return;
            if(!confirm("确定要删除该货品吗？")){
                return;
            }
            $.post("<?php echo smarty_function_get_url(array('rule' => '/delivery/deletewithgoods'), $this);?>
",{
                   withgoods_id : withgoodsId
                   },function(res){
                   if(res.code == 0){
                   alert("货品删除成功！");
                   //jQuery.facebox("操作成功！");
                   //$("#button").click();
                   window.location.reload();
                   }else{
                   jQuery.facebox(res.msg);
                   }
            },'json');
        }
        function gotoadd(){
            window.location.href = "<?php echo smarty_function_get_url(array('rule' => '/delivery/addwithgoods','data' => ((is_array($_tmp='did=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['delivery_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['delivery_id']))), $this);?>
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