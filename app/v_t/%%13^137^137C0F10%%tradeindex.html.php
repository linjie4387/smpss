<?php /* Smarty version 2.6.26, created on 2017-05-19 15:59:26
         compiled from simpla/order/tradeindex.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/order/tradeindex.html', 43, false),array('modifier', 'cat', 'simpla/order/tradeindex.html', 104, false),)), $this); ?>
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
</style>
<div id="main-content">
    <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
    <p id="page-intro">查看和管理所有医院正式订单。</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>正式订单管理</h3>
        <ul class="content-box-tabs">
            <li><a href="#tab1" class="default-tab">正式订单管理</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
            <form action="<?php echo smarty_function_get_url(array('rule' => '/order/tradeindex'), $this);?>
" method="post" id="js-form">
        <div class="form">
            <fieldset>
                <p>关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" name="key" />
                <span>（姓名，手机，医院）</span>&nbsp;正式订单状态： <span>
                <select id="one" name="status">
                    <option value="0">-----选择状态-----</option>
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
                </select></span>
           		<p>编号：<input type="text" value="<?php echo $this->_tpl_vars['order_id']; ?>
" class="text-input small-input" name="order_id" />
            	<span>（订单编号）</span>&nbsp;是否废单： <span>
                <select id="is_valid" name="is_valid">
                    <option value="0">-----选择是否废单-----</option>
                    <option value="1" <?php if ($this->_tpl_vars['is_valid'] == 1): ?>selected="selected"<?php endif; ?>>否</option>
                    <option value="2" <?php if ($this->_tpl_vars['is_valid'] == 2): ?>selected="selected"<?php endif; ?>>是</option>
                </select>
                <input type="submit" name="" id="button" class="button" value="查询" /></span></p>
            </fieldset>
        </div>
        <hr />
        
        <script type="text/javascript">
        	var showSub = function(oid){
        		var oid = oid||0;
        		var suborder = $('.suborder_'+oid).clone();
        		$('.suborder_'+oid).remove();
        		$('.sforder_'+oid).after(suborder);
        		$('.suborder_'+oid).toggle();
        	}
        </script>
        
        <style type="text/css">
        	.btnimg{cursor: pointer;}
        </style>
          <table>
            <thead>
              <tr>
                <th>订单号</th>
                <th>预订单号</th>
                <th>医院</th>
                <th>科室</th>
                <th>提交人</th>
                <th>接单公司</th>
                <th>状态</th>
                <th>等待</th>
                <th>凭证</th>
                <th>录入</th>
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
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['orderList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                <tr <?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['fid'] != 0): ?> class="suborder_<?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['fid']; ?>
" style="display: none;background-color:#FFE7E5;" <?php else: ?> class="sforder_<?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']; ?>
" <?php endif; ?> >
                    <td><?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['fid'] == 0): ?> <img src="/assets/images/open.gif" class="btnimg" onclick="showSub(<?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']; ?>
)" /> <?php endif; ?>
                    	<?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] == 3): ?><a href="<?php echo smarty_function_get_url(array('rule' => '/order/orderdetail','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']))), $this);?>
" title="正式单"><?php endif; ?>
                    	<?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['is_valid'] != 1): ?><span style="text-decoration:line-through;"><?php endif; ?>  <?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['fid'] == 0): ?> <?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']; ?>
 <?php endif; ?> 
                    	<?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['is_valid'] != 1): ?></span><?php endif; ?>
                    </td>
                    <td><a href="<?php echo smarty_function_get_url(array('rule' => '/order/hospitalorderdetail','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['hospitalorder_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['hospitalorder_id']))), $this);?>
" title="预订单">
                        <?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['hospitalorder_id']; ?>

                    </a></td>
                  <td><?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['hospital_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['office_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['name']; ?>
</br><?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['mobile']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_company_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status_name']; ?>
<?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['sign_status'] == 4): ?><br/><span style="color:red;">(部分签收)</span><?php endif; ?></td>
              		<?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] == 1): ?>
                  <?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['day_wait'] > 3): ?>
                  	<td class="am-danger">
                   <?php elseif ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['day_wait'] >= 2): ?>
                   <td class="am-warn">
                   <?php elseif ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['day_wait'] > 0): ?>
                   <td class="am-primary">
                   <?php else: ?>
                   <td>
                   <?php endif; ?>
                        <i class="icon-time"><?php echo $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['day_wait']; ?>
天</i>
                  </td>
                  <?php else: ?>
                  <td></td>
                  <?php endif; ?>
                  <td style="min-width:40px;">
                      <?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] != 1 && $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['hospitalorder_id'] != null): ?>
                      <a href="<?php echo smarty_function_get_url(array('rule' => '/order/tradeprint','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']))), $this);?>
" title="正式单凭证">
                          正式单
                      </a>
                      <?php endif; ?>
                      <?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] == 3 && $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['hospitalorder_id'] != null): ?>
                      </br>
                      <a href="<?php echo smarty_function_get_url(array('rule' => '/order/deliveryprint','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']))), $this);?>
" title="出库单凭证">
                          出库单
                      </a>
                      <?php endif; ?>
                  </td>
                  <td style="min-width:40px;">
                      <?php if (( $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] != 3 && $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] != 4 || $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['sign_status'] == 4 ) && $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['is_valid'] == 1): ?>
                      <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/order/addrecord','data' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&readonly=') : smarty_modifier_cat($_tmp, '&readonly=')))) ? $this->_run_mod_handler('cat', true, $_tmp, 0) : smarty_modifier_cat($_tmp, 0))), $this);?>
" title="录入">
                          <img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/edit.png" alt="录入" />
                      </a>
                      <?php endif; ?>
                      <?php if (( $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] == 3 || $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] == 4 || $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['is_valid'] == 2 ) && $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['sign_status'] != 4): ?>
                      <a style="margin:10px;" href="<?php echo smarty_function_get_url(array('rule' => '/order/addrecord','data' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&readonly=') : smarty_modifier_cat($_tmp, '&readonly=')))) ? $this->_run_mod_handler('cat', true, $_tmp, 1) : smarty_modifier_cat($_tmp, 1))), $this);?>
" title="数据">
                          <img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/info.png" alt="数据" />
                      </a>
                      <?php endif; ?>
                  </td>
                  <td style="min-width:40px;">
                    <?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['is_valid'] == 1): ?>
	                    <?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] == 1): ?>
	                  	<a class="btn btn-primary btn-xs" href="<?php echo smarty_function_get_url(array('rule' => '/order/verifytradeorder','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']))), $this);?>
">
	                  			下单确认
	                  	</a>
	                  	<?php elseif ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] == 2): ?>
	                  	<a class="btn btn-success btn-xs" href="<?php echo smarty_function_get_url(array('rule' => '/order/deliverytradeorder','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']))), $this);?>
">
	                  			出库完毕
	                  	</a>
	                    <?php elseif ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['status'] == 3): ?>
	                    <a class="btn btn-success btn-xs" href="<?php echo smarty_function_get_url(array('rule' => '/order/billadmtradeorder','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']))), $this);?>
">单据维护</a>
	                    <?php endif; ?>
	                    
	                    <?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['sign_status'] != 2): ?>
	                    <a class="btn btn-danger btn-xs" onclick="if(!confirm('确定要作废此订单吗？'))return false;" href="<?php echo smarty_function_get_url(array('rule' => '/order/delorder','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['orderList'][$this->_sections['i']['index']]['order_id']))), $this);?>
">订单作废</a>
	                    <?php endif; ?>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['fid'] == 0): ?> </div> <?php endif; ?>
                <?php endfor; endif; ?>
            </tbody>
          </table>
        </div>
      </div>
      </form>
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