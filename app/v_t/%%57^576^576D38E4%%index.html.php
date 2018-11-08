<?php /* Smarty version 2.6.26, created on 2017-11-03 16:52:00
         compiled from simpla/order/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/order/index.html', 26, false),array('modifier', 'cat', 'simpla/order/index.html', 107, false),)), $this); ?>
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
<style>
.tt {
	overflow : hidden;
	text-overflow: ellipsis;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
}
</style>
<div id="main-content">
    <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
    <p id="page-intro">查看和管理所有医院预订单。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>医院预订单管理</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">医院预订单管理</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/order/index'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                <p>预订单状态： <span>
                        <select id="one" name="status">
                            <option value="0">-----选择预订单状态-----</option>
                            <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['orderstatusList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                            <option value="<?php echo $this->_tpl_vars['orderstatusList'][$this->_sections['i']['index']]['value']; ?>
" <?php if ($this->_tpl_vars['orderstatusList'][$this->_sections['i']['index']]['value'] == $this->_tpl_vars['status']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['orderstatusList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['orderstatusList'][$this->_sections['i']['index']]['name']; ?>
</option>
                            <?php endfor; endif; ?>
                        </select></span>&nbsp;关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" />
                    <span>（预订单号，姓名，手机，医院）
                    <p>是否代下单： <span>
                        <select id="is_agent" name="is_agent">
                            <option value="0">-----选择是否代下单-----</option>
                            <option value="1" <?php if ($this->_tpl_vars['is_agent'] == 1): ?>selected="selected"<?php endif; ?>>否</option>
                            <option value="2" <?php if ($this->_tpl_vars['is_agent'] == 2): ?>selected="selected"<?php endif; ?>>是</option>
                        </select>
                    <!--input type="checkbox" name="showDel" id="showDel"  <?php if ($this->_tpl_vars['showDel']): ?>checked<?php endif; ?> />
                    <label style="display: -webkit-inline-box;font-weight: normal;" for="stockempty">显示已删除预订单</label--></span>
                    <input type="submit" name="" id="button" class="button" value="查询" /></span></p>
            </fieldset>
        </div>
        <hr />
          <table>
            <thead>
              <tr>
              	<th>预订单号</th>
                <th>医院</th>
                <th>科室</th>
                <th>提交人</th>
                <th>提交时间</th>
                <th>状态</th>
                <th>代下单</th>
                <th>评分</th>
                <th>备注</th>
                <th>操作管理</th>
                <th>流程管理</th>
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
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['hospitalorderList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td>
                       <?php if ($this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['status'] == 5): ?>
                  			<span style="font-weight:bold; color:#999;text-decoration:line-through;">
                            <?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']; ?>

                            </span>
                       <?php else: ?>
                       		<a style="font-weight:bold"><?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']; ?>
</a>
                       <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospital_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['office_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['name']; ?>
</br><?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['mobile']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['preapply_time']; ?>
</td>
                  <td>
                       <?php if ($this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['status'] == 5): ?>
                  			<span style="font-weight:bold; color:#999;text-decoration:line-through;">
                            <?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['status_name']; ?>

                            </span>
                       <?php else: ?>
                       		<a style="font-weight:bold"><?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['status_name']; ?>
</a>
                       <?php endif; ?>
                  </td>
                  <?php if ($this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['is_agent'] == 1): ?>
                  <td>否</td>
                  <?php else: ?>
                  <td>是</td>
                  <?php endif; ?>
                  <td>
                  	<span title="<?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['appraise_comment']; ?>
" <?php if ($this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['appraise_comment']): ?>style="color:green;"<?php endif; ?>><?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['appraise_name']; ?>
</span>
                  </td>
                  <td style="max-width:160px;">
                      <a title="<?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['remark']; ?>
<?php if ($this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['admin_remark'] != ''): ?>(<?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['admin_remark']; ?>
)<?php endif; ?>" class="tt"><?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['remark']; ?>
<?php if ($this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['admin_remark'] != ''): ?></br>(<?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['admin_remark']; ?>
)<?php endif; ?></a>
                  </td>
                  <td style="min-width:80px;">
                      <a href="<?php echo smarty_function_get_url(array('rule' => '/order/hospitalorderprint','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']))), $this);?>
" title="订单照片">
                          订单照片
                      </a>
                      <?php if ($this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['status'] == 1): ?>
                      </br>
                      <a href="<?php echo smarty_function_get_url(array('rule' => '/order/hospitalorderremark','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']))), $this);?>
" title="备注管理">
                          备注管理
                      </a>
                      <?php endif; ?>
                  </td>
                  <td style="min-width:80px;">
                  	<?php if ($this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['status'] == 1): ?>
                  	<a class="btn btn-primary btn-xs" <?php if (empty ( $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['admin_remark'] )): ?> remaknull='true'<?php else: ?> remaknull='false' <?php endif; ?> href="#" onclick="updatehospitalorder(this,<?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']; ?>
)">
                  			接收处理
                  	</a>
                  	<?php elseif ($this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['status'] == 3): ?>
                  	<a class="btn btn-success btn-xs" href="<?php echo smarty_function_get_url(array('rule' => '/order/updatehospitalorder','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']))), $this);?>
">
                  			处理完毕
                  	</a>
                  		<?php endif; ?>
                  	<!-- 
	                  <a href="<?php echo smarty_function_get_url(array('rule' => '/order/addhospitalorder','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']))), $this);?>
" title="编辑">
	                  	<img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/edit.png" alt="编辑" />
	                  </a>
	                 -->
	                 <?php if ($this->_tpl_vars['button']['order_delorder'] == 1 && $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['status'] == 1): ?>&nbsp;
	                 <a class="btn btn-danger btn-xs" onclick="javascript:del_order('<?php echo $this->_tpl_vars['hospitalorderList'][$this->_sections['i']['index']]['hospitalorder_id']; ?>
')">
                  			删除预订单
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
    function del_order(orderId){
    	//$("#button").click();
    	//return;
		if(!confirm("确定要删除该预订单吗？")){
			return;
		}
		var url = "<?php echo smarty_function_get_url(array('rule' => '/order/delhospitalorder'), $this);?>
-oid-"+orderId+".html";;
		//alert(url);
		window.location.href=url;
		//window.location.href="/order/delhospitalorder?hospitalorder_id="+orderId;
		/*
		$.post("<?php echo smarty_function_get_url(array('rule' => '/order/delhospitalorder'), $this);?>
",{
			hospitalorder_id : orderId
		},function(res){
			console.log(res);
			if(res.code == 0){
				alert("预订单删除成功！");
				//jQuery.facebox("操作成功！");
				$("#button").click();
			}else{
				jQuery.facebox(res.msg);
			}
		},'json');
		*/
	}
	
	function updatehospitalorder(obj,hospitalorderid){
		var url= "<?php echo smarty_function_get_url(array('rule' => '/order/updatehospitalorder'), $this);?>
"+"-oid-"+hospitalorderid+".html";
		var remaknull = obj.getAttribute('remaknull');
		if(remaknull=='true' || remaknull==true){
			alert("请先填写备注信息！");
			var remarkurl = "<?php echo smarty_function_get_url(array('rule' => '/order/hospitalorderremark'), $this);?>
"+"-oid-"+hospitalorderid+".html";
			//alert(remarkurl);
			window.location.href=remarkurl;
			return false;
		}
		//alert(url);
		window.location.href=url;
		// href="{get_url rule='/order/updatehospitalorder' data='oid='|cat:$hospitalorderList[i].hospitalorder_id}"
		//{get_url rule='/order/hospitalorderremark' data='oid='|cat:$hospitalorderList[i].hospitalorder_id}
		
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