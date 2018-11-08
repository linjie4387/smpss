<?php /* Smarty version 2.6.26, created on 2017-01-24 19:07:58
         compiled from simpla/delivery/adddeliverycar.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/adddeliverycar.html', 14, false),)), $this); ?>
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
    <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
    <p id="page-intro">添加送货 > 选择车辆</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>选择车辆</h3>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">        
          <form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/adddeliverystep3'), $this);?>
" method="post" id="js-form">
          <div class="form">
            <fieldset>
                <p>关键字：<input type="text" value="<?php echo $this->_tpl_vars['key']; ?>
" class="text-input small-input" id="key" name="key" />
                <span>（车牌号，型号）<span>
                    </span><input type="button" name="" id="button" class="button" value="查询" onclick="getCarList(1)" /></span>
            </fieldset>
        </div>
          <hr />
          <table>
            <thead>
              <tr>
              	<th>选择</th>
                <th>车牌号</th>
                <th>型号</th>
                <th>牌照类型</th>
                <th>容量</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td colspan="6" id="car_list_bar"><?php echo $this->_tpl_vars['pagebar']; ?>
</td>
              </tr>
            </tfoot>
            <tbody id="car_list">
                <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['carList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                  <td><input class="row-radio" type="radio" name="car_id" value="<?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['car_id']; ?>
"></td>
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['car_license']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['model']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['license_type_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['carList'][$this->_sections['i']['index']]['volume']; ?>
</td>
                </tr>
                <?php endfor; endif; ?>
            </tbody>
          </table>   
          <div style="padding:10px 0px;">
            <input type="button" onclick="javascript:history.go(-1);" name="" id="button" class="button" value="上一步" />&nbsp;         
            <input type="button" onclick="donext();" name="" id="button" class="button" value="下一步" />
           </div>       
          <input type="hidden" name="qoids" id="qoids" value="<?php echo $this->_tpl_vars['qoids']; ?>
" />
          <input type="hidden" name="qoids_for_goods" id="qoids_for_goods" value="<?php echo $this->_tpl_vars['qoids_for_goods']; ?>
" />
          <input type="hidden" name="quantity" id="quantity" value="<?php echo $this->_tpl_vars['quantity']; ?>
" />
          </form>
        </div>
      </div>
    </div>
    <script>
		function donext(){
			if($("input:radio[class='row-radio'][checked]").length < 1 ){
				alert('请选择数据');
				return;
			}
			$("#js-form").submit();
		}	
		
		function getCarList(curpage){			
			getListByAjax({
				main : "getCarList",
				url : '<?php echo smarty_function_get_url(array('rule' => "/delivery/adddeliverystep2"), $this);?>
',
				page : curpage,
				keyid : "key",
				callback : "getListCallback",
				listbar : $("#car_list"),
				pagebar : $("#car_list_bar"),
				colcount : 5
			});		
		}		
		function getListCallback(row){
			var htm = '<td><input class="row-radio" type="radio" name="car_id" value="'+row.car_id+'"></td>'+
					  '<td>'+row.car_license+'</td>'+
					  '<td>'+row.model+'</td>'+
					  '<td>'+row.license_type_name+'</td>'+
					  '<td>'+row.volume+'</td>';
			return htm;
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