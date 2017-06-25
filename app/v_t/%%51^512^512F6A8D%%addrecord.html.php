<?php /* Smarty version 2.6.26, created on 2017-05-10 11:30:01
         compiled from simpla/order/addrecord.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/order/addrecord.html', 15, false),array('modifier', 'cat', 'simpla/order/addrecord.html', 17, false),)), $this); ?>
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
    <p id="page-intro">正式订单商品数据录入</p>
    <div class="clear"></div>
    <div class="content-box">
        <div class="content-box-header">
            <a href="javascript:history.go(-1);" class="btn-back" title="后退"><img src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/images/icons/back.png" /></a>
            <h3>正式订单_<?php echo $this->_tpl_vars['order']['order_id']; ?>
&nbsp;商品数据</h3>
            <div class="clear"></div>
        </div>
        <div class="content-box-content">
            <div class="tab-content default-tab" id="tab1">
                <div class="form">
                    <form action="<?php echo smarty_function_get_url(array('rule' => '/order/addrecord'), $this);?>
" method="post" id="js-form" AUTOCOMPLETE="OFF">
                        <fieldset class="clearfix">
                            <p><span><?php echo $this->_tpl_vars['order']['hospital_name']; ?>
_<?php echo $this->_tpl_vars['order']['office_name']; ?>
 <?php if ($this->_tpl_vars['readonly'] == 0): ?>&nbsp; <a class="btn btn-success btn-xs" href="<?php echo smarty_function_get_url(array('rule' => '/hospital/setofficegoods','data' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order']['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order']['office_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&orderid=') : smarty_modifier_cat($_tmp, '&orderid=')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order']['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order']['order_id']))), $this);?>
">
                                商品配置
                            </a><?php endif; ?>&nbsp; <a class="btn btn-success btn-xs" href="<?php echo smarty_function_get_url(array('rule' => '/order/exportordergoods','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order']['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order']['order_id']))), $this);?>
">
                                数据导出
                            </a></span></p>
                            <hr />
                            <input type="hidden" value="<?php echo $this->_tpl_vars['order']['order_id']; ?>
" name="order_id" />
                            <ul>
                                <table id="myTable">
                                    <thead>
                                        <tr>
                                            <th>商品名称</th>
                                            <th>商品编码</th>
                                            <th>规格</th>
                                            <th>单位</th>
                                            <th>数量</th>
                                            <th>厂商全名</th>
                                            <th>适用机型</th>
                                            <th>项目品类</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['ordergoodsList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                                            <input type="hidden" value="<?php echo $this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['goods_id']; ?>
" class="text-input small-input" name="goodslist[goods_id][]"/>
                                            <td><?php if ($this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['is_exist'] == 0): ?><span style="text-decoration:line-through;"><?php endif; ?><?php echo $this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['name']; ?>
<?php if ($this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['is_exist'] == 0): ?></span><?php endif; ?></td>
                                            <td><?php echo $this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['goods_no']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['specification']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['unit']; ?>
</td>
                                            <td><?php if ($this->_tpl_vars['readonly'] == 0): ?><input type="text" value="<?php echo $this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['quantity']; ?>
" class="text-input small-input" name="goodslist[quantity][]" <?php if ($this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['is_exist'] == 0): ?>readonly="true"<?php endif; ?> /><?php elseif ($this->_tpl_vars['readonly'] == 1): ?><?php echo $this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['quantity']; ?>
<?php endif; ?></td>
                                            <td><?php echo $this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['manu']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['machine']; ?>
</td>
                                            <td><?php echo $this->_tpl_vars['ordergoodsList'][$this->_sections['i']['index']]['category']; ?>
</td>
                                        </tr>
                                        <?php endfor; endif; ?>
                                    </tbody>
                                </table>
                            </ul>
                            <dt>
                                <?php if ($this->_tpl_vars['readonly'] == 0): ?><input type="submit" name="" id="button" class="button" value="保存" /><?php endif; ?>
                            </dt>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
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