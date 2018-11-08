<?php /* Smarty version 2.6.26, created on 2017-01-24 19:09:22
         compiled from simpla/delivery/hasdelivery.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/hasdelivery.html', 35, false),)), $this); ?>
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
.am-primary {
	color:#14a6ef;
	/*background-color:rgba(59,180,242,.15) !important;
	border-color:#caebfb;  */
}

.am-warn {
	color:#F37B1D;
	/*background-color:rgba(243,123,29,.15) !important;
	border-color:#fbd0ae;*/
}

.am-danger {
	color:#dd514c;
	/*background-color:rgba(221,81,76,.15) !important;
	border-color:#f5cecd;*/
}
.td-bg-f { background-color:#FFFFFF;}
.td-bg-g { background-color:#f3f3f3;}
</style>
<div id="main-content">
    <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
    <p id="page-intro">查看和管理送货</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>任务管理</h3>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/hasdeliverylist'), $this);?>
" method="post" id="js-form">
            <div class="form">
                <fieldset>
                &nbsp;签收状态： <span>
                    <select id="one" name="status">
                        <option value="0">-----选择状态-----</option>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['sign_slist']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <option value="<?php echo $this->_tpl_vars['sign_slist'][$this->_sections['i']['index']]['value']; ?>
" <?php if ($this->_tpl_vars['sign_slist'][$this->_sections['i']['index']]['value'] == $this->_tpl_vars['status']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['sign_slist'][$this->_sections['i']['index']]['name']; ?>
</option>
                        <?php endfor; endif; ?>
                    </select></span>&nbsp;&nbsp;<input type="submit" name="" id="btnQry" class="button" value="查询" /></span>
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
                <th>单据号</th>
                <th>状态</th>
                <th>签收时间</th>
                <th>评价</th>
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
               	<?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
                <tr <?php if ($this->_sections['j']['first']): ?>style="border-top: 1px solid #E0E0E0;"<?php endif; ?>>
                  <?php if ($this->_sections['j']['first']): ?>
                  <td rowspan="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['count']; ?>
" <?php if ($this->_sections['i']['index']%2 == 0): ?>class="td-bg-g"<?php else: ?>class="td-bg-f"<?php endif; ?>><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['delivery_id']; ?>
</td>
                  <?php endif; ?>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['order_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['hospital_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['office_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['goods_type']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['goods_no']; ?>
</td>
                  <?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['sign_status'] == 1): ?>
                  <td class="am-warn">
                  <?php elseif ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['sign_status'] == 2): ?>
                  <td class="am-primary">
                  <?php elseif ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['sign_status'] == 3): ?>
                  <td class="am-danger">
                  <?php else: ?>
                  <td>
                  <?php endif; ?>
                  <?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['status_name']; ?>

                  <?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['remark']): ?>
                  <p style="padding:0;max-width:100px;">(<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['remark']; ?>
)</p>
                  <?php endif; ?>
                  </td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['sign_time']; ?>
</td>
                  <td>
                  	<span title="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['appraise_comment']; ?>
" <?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['appraise_comment']): ?>style="color:green;"<?php endif; ?>>
                  	<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['appraise_name']; ?>

                  	</span>
                  
                  </td>
                  <td style="min-width:40px;">
                  	<?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['sign_status'] == 1): ?>
                  	<a class="btn btn-danger btn-xs" href="javascript:hasDeliveryBack(<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['order_id']; ?>
,<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['delivery_id']; ?>
, <?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['data'][$this->_sections['j']['index']]['is_for_goods']; ?>
);">未完成</a>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endfor; endif; ?>
                <?php endfor; endif; ?>
            </tbody>
          </table>
            </form>
        </div>
      </div>
    </div>
    <script>
		function hasDeliveryBack(oid,did,isg){
			if(!confirm("您确定该订单【 "+oid+" 】未完成吗？")){
				return;
			}
			//window.location.href = url;	
			
			$.post("<?php echo smarty_function_get_url(array('rule' => '/delivery/hasdeliveryback'), $this);?>
",{
				did : did,
				oid:oid,
				isg:isg
			},function(res){
				if(res.code == 0){
					//window.location="<?php echo smarty_function_get_url(array('rule' => '/hospital/forecastdetail'), $this);?>
-sid-"+res.data+".html";
					alert("操作成功!");
					$("#btnQry").click();
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