<?php /* Smarty version 2.6.26, created on 2017-06-08 16:28:26
         compiled from simpla/delivery/addwithgoods.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/addwithgoods.html', 16, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
	.goods_qrcode:hover { display:block !important;}
</style>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="main-content">
    <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
    <p id="page-intro">查看和管理送货</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>添加货品</h3>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
      	<form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/editdeliverywithgoods'), $this);?>
" method="post" id="js-form">
        <div class="tab-content default-tab" id="tab1">
            <div class="form">
               <div style="font-size: 30px;line-height: 40px;">大包装数量 :<input id="quantity" name="quantity" type="hidden" value="<?php echo $this->_tpl_vars['deliveryInfo']['20l_quantity']; ?>
"><span style="padding-left:10px;"><?php echo $this->_tpl_vars['deliveryInfo']['20l_quantity']; ?>
+</span><span id="quantitystr" style="padding-left:10px;"><?php echo $this->_tpl_vars['deliveryInfo']['20l_quantity']; ?>
</span></div>
            </div>
          <hr />
          
          <table>
            <thead>
              <tr>
              	<th><input type="checkbox" name="checkall" id="check_all"></th>
                <th>正式单号</th>
                <th>医院名称</th>
                <th>科室名称</th>
                <th>货品类型</th>
                <th>单据号</th>
                <th></th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <td colspan="7"><?php echo $this->_tpl_vars['pagebar']; ?>
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
                  <td>
                  	<input id="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
" class="row-check" type="checkbox" name="orders[ids][]" value="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
" onchange="getquantity(this,<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
);" <?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['ischeck']): ?> checked<?php endif; ?>>
                  	<input style="display:none;" id="is_for_goods_<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
" class="row-check" type="checkbox" name="orders[is_for_goods][]" value="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
" <?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['ischeck']): ?> checked<?php endif; ?>>
                  </td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['hospital_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['office_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['goods_type']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['goods_no']; ?>
</td>
                </tr>
                <?php endfor; endif; ?>
            </tbody>
          </table>
          <div style="padding:10px 0px;">
          	<input type="hidden" name="delivery_id" value="<?php echo $this->_tpl_vars['delivery_id']; ?>
">
            <input type="button" onclick="donext();" name="" id="button" class="button" value="提 交" />
          </div>
          </form>
        </div>
      </div>
    </div>
    <script>
		var oids = new Array();
    	function getquantity(obj,type){
			$('#is_for_goods_'+obj.id).prop("checked",obj.checked);
			if(type == 0){
				return;	
			}
			if(obj.checked){
				if(oids.indexOf($(obj).val()) < 0){
					oids.push($(obj).val());
				}
			}else{
				oids.remove($(obj).val());
			}
			
			getdata(oids);
			
		}
		
		$("#check_all").change(function(){			
			var obj = this;
			$('.row-check').prop("checked",this.checked); 
			oids = new Array();
			
			$("input:checkbox[class='row-check'][name='orders[ids][]']").each(function(){
				if(obj.checked){
					if(oids.indexOf(this.value) < 0){
						oids.push(this.value);
					}
				}
			});
			
			getdata(oids);
		});
		
		function getdata(oids){
			$.post('<?php echo smarty_function_get_url(array('rule' => "/delivery/sumquantity"), $this);?>
',{
				oid : oids
			},function(res){
				if(res.data != null){
					$("#quantity").val(res.data.quantity);
					$("#quantitystr").html(res.data.quantity);
				}
			},'json');		
		}
		
		function donext(){
			if($("input:checkbox[class='row-check'][checked]").length < 1 ){
				alert('请选择数据');
				return;
			}
			$("#js-form").submit();
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