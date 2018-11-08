<?php /* Smarty version 2.6.26, created on 2018-10-08 17:48:55
         compiled from simpla/order/orderdetail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/order/orderdetail.html', 62, false),array('modifier', 'cat', 'simpla/order/orderdetail.html', 62, false),)), $this); ?>
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
<style>.promote{display:none;}</style>
<div id="main-content">
  <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
  <p id="page-intro">您可以在这里查询正式订单详情。</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
        <a href="javascript:history.go(-1);" class="btn-back" title="后退"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/back.png" /></a>
        <h3>正式订单_<?php echo $this->_tpl_vars['order']['order_id']; ?>
&nbsp;详情</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="content-box column-left">
            <div class="content-box-header">
                <h3 style="cursor: s-resize;">基本信息</h3>
            </div>
            <div class="content-box-content" style="display: block;">
                <div class="tab-content default-tab" style="display: block;">
                    <table>
                        <tbody>
                            <tr>
                                <td>正式订单号</td>
                                <td><?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['is_valid'] != 1): ?><span style="text-decoration:line-through;"><?php endif; ?><?php echo $this->_tpl_vars['order']['order_id']; ?>
<?php if ($this->_tpl_vars['orderList'][$this->_sections['i']['index']]['is_valid'] != 1): ?></span><?php endif; ?></td>
                            </tr>
                            <tr>
                                <td>是否是废单</td>
                                <?php if ($this->_tpl_vars['order']['is_valid'] == 1): ?>
                                <td>否</td>
                                <?php else: ?>
                                <td>是</td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td>医院</td>
                                <td><?php echo $this->_tpl_vars['order']['hospital_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>科室</td>
                                <td><?php echo $this->_tpl_vars['order']['office_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>提交人</td>
                                <td><?php echo $this->_tpl_vars['order']['name']; ?>
(<?php echo $this->_tpl_vars['order']['mobile']; ?>
)</td>
                            </tr>
                            <tr>
                                <td>接单公司</td>
                                <td><?php echo $this->_tpl_vars['order']['order_company_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>发货单号</td>
                                <td><?php echo $this->_tpl_vars['order']['delivery_no']; ?>
</td>
                            </tr>
                            <tr>
                                <td>发票单号</td>
                                <td><?php echo $this->_tpl_vars['order']['invoice_no']; ?>
</td>
                            </tr>
                            <tr>
                                <td>下单凭证</td>
                                <td><a href="<?php echo smarty_function_get_url(array('rule' => '/order/tradeprint','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order']['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order']['order_id']))), $this);?>
" title="下单凭证">
                                    下单凭证照片
                                </a></td>
                            </tr>
                            <tr>
                                <td>出库单凭证</td>
                                <td><a href="<?php echo smarty_function_get_url(array('rule' => '/order/deliveryprint','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order']['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order']['order_id']))), $this);?>
" title="出库单凭证">
                                    出库单凭证照片
                                </a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="content-box column-right">
            <div class="content-box-header">
                <h3 style="cursor: s-resize;">流程信息</h3>
            </div>
            <div class="content-box-content" style="display: block;">
                <div class="tab-content default-tab" style="display: block;">
                    <table>
                        <tbody>
                            <tr>
                                <td>状态</td>
                                <td><?php echo $this->_tpl_vars['order']['status_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>创建时间</td>
                                <td><?php echo $this->_tpl_vars['order']['create_time']; ?>
</td>
                            </tr>
                            <tr>
                                <td>确认时间</td>
                                <td><?php echo $this->_tpl_vars['order']['verify_time']; ?>
</td>
                            </tr>
                            <tr>
                                <td>确认人</td>
                                <td><?php echo $this->_tpl_vars['order']['verify_admin_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>出库时间</td>
                                <td><?php echo $this->_tpl_vars['order']['delivery_time']; ?>
</td>
                            </tr>
                            <tr>
                                <td>出库人</td>
                                <td><?php echo $this->_tpl_vars['order']['delivery_admin_name']; ?>
</td>
                            </tr>
                            <?php if ($this->_tpl_vars['order']['is_valid'] == 0): ?>
                            <tr>
                                <td>废单时间</td>
                                <td><?php echo $this->_tpl_vars['order']['delete_time']; ?>
</td>
                            </tr>
                            <tr>
                                <td>废单人</td>
                                <td><?php echo $this->_tpl_vars['order']['delete_admin_name']; ?>
</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="clear"></div>
      </div>
      <!-- End #tab1 -->
    </div>
    <!-- End .content-box-content -->
  </div>
  <!-- End .content-box --> 
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