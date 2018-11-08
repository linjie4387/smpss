<?php /* Smarty version 2.6.26, created on 2018-10-08 17:48:58
         compiled from simpla/order/hospitalorderdetail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/order/hospitalorderdetail.html', 37, false),array('modifier', 'cat', 'simpla/order/hospitalorderdetail.html', 37, false),)), $this); ?>
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
  <p id="page-intro">您可以在这里查询预订单详情。</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
        <h3><?php echo $this->_tpl_vars['hospitalorder']['hospitalorder_id']; ?>
&nbsp;预订单详情</h3>
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
                                <td>预订单号</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['hospitalorder_id']; ?>
</td>
                            </tr>
                            <tr>
                                <td>医院</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['hospital_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>科室</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['office_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>凭证</td>
                                <td><a href="<?php echo smarty_function_get_url(array('rule' => '/order/hospitalorderprint','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['hospitalorder']['hospitalorder_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['hospitalorder']['hospitalorder_id']))), $this);?>
" title="预订单照片">
                                    预订单照片
                                </a></td>
                            </tr>
                            <tr>
                                <td>提交人</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['name']; ?>
(<?php echo $this->_tpl_vars['hospitalorder']['mobile']; ?>
)</td>
                            </tr>
                            <tr>
                                <td>是否代下单</td>
                                <?php if ($this->_tpl_vars['hospitalorder']['is_agent'] == 1): ?>
                                <td>否</td>
                                <?php else: ?>
                                <td>是</td>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <td>接单公司</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['order_company_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>下单备注</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['remark']; ?>
</td>
                            </tr>
                            <tr>
                                <td>接单备注</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['admin_remark']; ?>
</td>
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
                                <td><?php echo $this->_tpl_vars['hospitalorder']['status_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>下单时间</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['preapply_time']; ?>
</td>
                            </tr>
                            <tr>
                                <td>审核时间</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['preverify_time']; ?>
</td>
                            </tr>
                            <tr>
                                <td>审核人</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['preverify_admin_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>关闭时间</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['preclose_time']; ?>
</td>
                            </tr>
                            <tr>
                                <td>关闭人</td>
                                <td><?php echo $this->_tpl_vars['hospitalorder']['preclose_admin_name']; ?>
</td>
                            </tr>
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