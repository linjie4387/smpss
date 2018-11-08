<?php /* Smarty version 2.6.26, created on 2017-07-22 10:02:17
         compiled from simpla/device/devicedetail.html */ ?>
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
  <p id="page-intro">1.你可以在这里查询仪器详情。</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
        <h3><?php echo $this->_tpl_vars['device']['id_code']; ?>
&nbsp;仪器详情</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="content-box column-left">
            <div class="content-box-header">
                <h3 style="cursor: s-resize;">用户信息</h3>
            </div>
            <div class="content-box-content" style="display: block;">
                <div class="tab-content default-tab" style="display: block;">
                    <table>
                        <tbody>
                            <tr>
                                <td>区县</td>
                                <td><?php echo $this->_tpl_vars['district']['name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>用户级别顺序</td>
                                <td><?php echo $this->_tpl_vars['hospital']['level_order']; ?>
</td>
                            </tr>
                            <tr>
                                <td>用户级别</td>
                                <td><?php echo $this->_tpl_vars['hospital']['level']; ?>
</td>
                            </tr>
                            <tr>
                                <td>用户编号</td>
                                <td><?php echo $this->_tpl_vars['hospital']['code']; ?>
</td>
                            </tr>
                            <tr>
                                <td>医院等级</td>
                                <td><?php echo $this->_tpl_vars['hospital']['hospital_level']; ?>
</td>
                            </tr>
                            <tr>
                                <td>用户名称</td>
                                <td><?php echo $this->_tpl_vars['hospital']['name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>用户开票名称</td>
                                <td><?php echo $this->_tpl_vars['hospital']['invoice_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>使用科室</td>
                                <td><?php echo $this->_tpl_vars['office']['name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>联系电话</td>
                                <td><?php echo $this->_tpl_vars['office']['contact_phone']; ?>
</td>
                            </tr>
                            <tr>
                                <td>联系人</td>
                                <td><?php echo $this->_tpl_vars['office']['contact_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>地址</td>
                                <td><?php echo $this->_tpl_vars['hospital']['address']; ?>
</td>
                            </tr>
                            <tr>
                                <td>邮编</td>
                                <td><?php echo $this->_tpl_vars['hospital']['post_code']; ?>
</td>
                            </tr>
                            <tr>
                              <td>税号</td>
                              <td><?php echo $this->_tpl_vars['hospital']['tax_num']; ?>
</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="content-box column-right">
            <div class="content-box-header">
                <h3 style="cursor: s-resize;">仪器信息</h3>
            </div>
            <div class="content-box-content" style="display: block;">
                <div class="tab-content default-tab" style="display: block;">
                    <table>
                        <tbody>
                            <tr>
                                <td>厂家</td>
                                <td><?php echo $this->_tpl_vars['supplier']['code']; ?>
</td>
                            </tr>
                            <tr>
                                <td>维修级别</td>
                                <td><?php echo $this->_tpl_vars['device']['service_level']; ?>
</td>
                            </tr>
                            <tr>
                                <td>仪器型号</td>
                                <td><?php echo $this->_tpl_vars['model']['name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>说明</td>
                                <td><?php echo $this->_tpl_vars['device']['instruction']; ?>
</td>
                            </tr>
                            <tr>
                                <td>仪器序号</td>
                                <td><?php echo $this->_tpl_vars['device']['serial_code']; ?>
</td>
                            </tr>
                            <tr>
                                <td>仪器二维码</td>
                                <td><?php echo $this->_tpl_vars['device']['qrcode']; ?>
</td>
                            </tr>
                            <tr>
                                <td>装机时间</td>
                                <td><?php echo $this->_tpl_vars['device']['install_time']; ?>
</td>
                            </tr>
                            <tr>
                                <td>保修年限</td>
                                <td><?php echo $this->_tpl_vars['device']['warranty_period']; ?>
</td>
                            </tr>
                            <tr>
                                <td>保修日期</td>
                                <td><?php echo $this->_tpl_vars['device']['warranty_time']; ?>
</td>
                            </tr>
                            <tr>
                                <td>仪器编号</td>
                                <td><?php echo $this->_tpl_vars['device']['code']; ?>
</td>
                            </tr>
                            <tr>
                                <td>厂家安装单号</td>
                                <td><?php echo $this->_tpl_vars['device']['supplier_install_order_id']; ?>
</td>
                            </tr>
                            <tr>
                                <td>公司安装单号</td>
                                <td><?php echo $this->_tpl_vars['device']['company_install_order_id']; ?>
</td>
                            </tr>
                            <tr>
                              <td valign="top"><div style="margin-top:-1px;">配送信息</div></td>
                              <td><textarea style="width:100% ; border:1px solid #eee;" cols="" rows="5"><?php echo $this->_tpl_vars['device']['delivery_msg']; ?>
</textarea></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="content-box column-left">
            <div class="content-box-header">
                <h3 style="cursor: s-resize;">服务信息</h3>
            </div>
            <div class="content-box-content" style="display: block;">
                <div class="tab-content default-tab" style="display: block;">
                    <table>
                        <tbody>
                            <tr>
                                <td>销售</td>
                                <td><?php echo $this->_tpl_vars['device']['saler_name']; ?>
</td>
                            </tr>
                            <tr>
                                <td>试剂来源</td>
                                <td><?php echo $this->_tpl_vars['device']['reagent_source']; ?>
</td>
                            </tr>
                            <tr>
                                <td>送货</td>
                                <td><?php echo $this->_tpl_vars['device']['deliveryman']; ?>
</td>
                            </tr>
                            <tr>
                                <td>维修</td>
                                <td><?php echo $this->_tpl_vars['device']['serviceman']; ?>
</td>
                            </tr>
                            <tr>
                                <td>应用</td>
                                <td><?php echo $this->_tpl_vars['device']['applyman']; ?>
</td>
                            </tr>
                            <tr>
                                <td>保养周期</td>
                                <td><?php echo $this->_tpl_vars['device']['service_period']; ?>
</td>
                            </tr>
                            <tr>
                                <td>应用周期</td>
                                <td><?php echo $this->_tpl_vars['device']['apply_period']; ?>
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