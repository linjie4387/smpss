<?php /* Smarty version 2.6.26, created on 2017-06-21 15:54:09
         compiled from simpla/delivery/adddelivery.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/adddelivery.html', 49, false),array('function', 'cycle', 'simpla/delivery/adddelivery.html', 97, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/header_new.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script src="/assets/layer/layer.js" type="text/javascript" charset="utf-8"></script>
<script src="/assets/js/mycommon.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="/assets/css/mycommon.css" type="text/css" />
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
.pop_th {
	background-color: #eee;
	color: #000;
	font-size: 12px;
	font-weight: bold;
}
.pop_td {
	color:#000;
}

.layui-layer-content table{width:98%;border: 1px #F0F0F0 solid;padding: 10px;margin:10px auto;}
.layui-layer-content table th{background-color: #eee;padding: 8px 0;}
.layui-layer-content table tr:hover{background-color:#EAEAEA;}
.layui-layer-content caption, th, td{padding:5px;text-align: left;vertical-align: middle; background-color:#fff}
.layui-layer-content caption, th, td input[type="text"]{width:60px;}

</style>
<div id="main-content">
    <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2> 
  <p id="page-intro">查看和管理待指派任务</p>
    <div class="clear"></div>
    <div class="content-box">
      <div class="content-box-header">
        <h3>待指派任务</h3>
        <ul class="content-box-tabs">
            <li><a href="<?php echo smarty_function_get_url(array('rule' => "/delivery/index"), $this);?>
">已指派任务</a></li>
            <li><a href="#tab1" class="default-tab">待指派任务</a></li>
        </ul>
        <div class="clear"></div>
      </div>
      <div class="content-box-content">
      
      	<form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/adddeliverystep2'), $this);?>
" method="post" id="js-form">
        <div class="tab-content default-tab" id="tab1">
           <table  border="0" width="100%">
           <tr>
            <div class="form">
            	<td>
               <span style="font-size: 30px;line-height: 40px;">大包装数量 :<input id="quantity" name="quantity" type="hidden" value="0">
               	<span id="quantitystr" style="padding-left:10px;">0</span>
               </span>
               </td>
               <td  style="width:250px; font-weight:bold;">
			    <input  name="orderby" type="radio" onclick="getOrderBy('order by ifnull(if(fid=0,order_id,fid),order_id) asc,goods_type,delivery_time asc')" value="" /> 按订单排序<input name="orderby" type="radio" onclick="getOrderBy('order by delivery_time,goods_type')"  /> 按时间排序
               </td>
               <td width="50"><input type="button" class="button" onclick="gotoadd();" value="添加任务" style="padding: 10px;"></td>
            </div>
          </tr>
          </table>
          <hr />
          <table id="9999" border="0">
            <thead>
              <tr>
              	<th style="width:20px;"><input type="checkbox" name="checkall" id="check_all"></th>
                <th colspan="2" align="center" nowrap="nowrap">正式单号</th>
                <th nowrap="nowrap">医院名称</th>
                <th nowrap="nowrap">科室名称</th>
                <th nowrap="nowrap">货品</th>
                <th nowrap="nowrap">单据号</th>
                <th nowrap="nowrap">大包装</th>
                <th nowrap="nowrap">备注</th>
                <th nowrap="nowrap">等待</th>
                <th nowrap="nowrap" style="display:none">拆单</th>
                <th nowrap="nowrap">操作</th>
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
                <tr  bgcolor="<?php echo smarty_function_cycle(array('values' => '#eee,#fff'), $this);?>
" childId="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
" parentId="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['fid']; ?>
<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
" id="row_<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
" <?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_deny']): ?><?php endif; ?>>
                  <td style="max-width:20px; min-width:20px; ">
                  <input data-order_id="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
" id="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
" class="row-check" type="checkbox" name="orders[ids][]" value="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
" onchange="getquantity(this,<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
);">
                  <input data-order_id="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
" style="display:none;" id="is_for_goods_<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
" class="row-check" type="checkbox" name="orders[is_for_goods][]" value="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
">
                  </td>
                  <td style="border:0px solid #000; padding:0px; width:25px;">
                  <?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['fid'] == 0): ?>
                  <!--div onClick="viewmytab('9999',this,'row_<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
')" class="btn-close">-</div-->
                  <img src="/assets/images/f_open.gif" style="width:20px;height:16px;cursor:hand" onClick="viewmytab('9999',this,'row_<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_for_goods']; ?>
')"/>
                  <?php endif; ?>
                  </td>
                  <td style="border:0px solid #000; padding:0px; width:70px; ">
                  <?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['fid'] == 0): ?>
                  <span  class="btn btn-danger btn-xs" style="text-align:left; padding-left:10px ;cursor:normal;"> 
                  <?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>

                  </span> 
                  <?php endif; ?></td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['hospital_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['office_name']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['goods_type']; ?>
</td>
                  <td><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['goods_no']; ?>
</td>
                  <td class="quantity"><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['20l_quantity_quantity']; ?>
</td>
                  <td class="am-danger"><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['remark']; ?>
</td>
                  <?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['day_wait'] > 3): ?>
                  <td class="am-danger">
                  <?php elseif ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['day_wait'] >= 2): ?>
                  <td class="am-warn">
                  <?php elseif ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['day_wait'] > 0): ?>
                  <td class="am-primary">
                  <?php else: ?>
                  <td>
                  <?php endif; ?>
                  <i class="icon-time"><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['day_wait']; ?>
天</i>
                  </td>
                  <td  style="display:none">
                  <?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['is_sun']): ?> <span style="color: #FF0000;">是</span><?php else: ?>无<?php endif; ?>
                  </td>
                  <td><?php if ($this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['goods_type'] == "商品"): ?>
                  	<a data-order_id="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
" style="margin:10px;cursor: pointer;" title="拆分">
                  		<img src="/assets/simpla/images/icons/pencil.png" alt="拆分"> 拆分
                  	</a>
                  	<div class="order_<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
" style="display:none;">
                  		<table border="1"  data-order_id="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_id']; ?>
"><thead>
						    <tr align="center" style="font-size: 1.2em;font-weight: bold;">
						      <th class="pop_th" align="center">拆分</th>
						      <th class="pop_th" align="center">商品</th>
						      <th class="pop_th" align="center">规格</th>
						      <th class="pop_th" align="center">单位</th>
						      <th class="pop_th" align="center">商品总数</th>
						      <th class="pop_th" align="center">备注</th>
						      <th class="pop_th" align="center">拆分数量</th>
						    </tr>
						  </thead>
						  <tbody>
						  	<?php unset($this->_sections['k']);
$this->_sections['k']['name'] = 'k';
$this->_sections['k']['loop'] = is_array($_loop=$this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['k']['show'] = true;
$this->_sections['k']['max'] = $this->_sections['k']['loop'];
$this->_sections['k']['step'] = 1;
$this->_sections['k']['start'] = $this->_sections['k']['step'] > 0 ? 0 : $this->_sections['k']['loop']-1;
if ($this->_sections['k']['show']) {
    $this->_sections['k']['total'] = $this->_sections['k']['loop'];
    if ($this->_sections['k']['total'] == 0)
        $this->_sections['k']['show'] = false;
} else
    $this->_sections['k']['total'] = 0;
if ($this->_sections['k']['show']):

            for ($this->_sections['k']['index'] = $this->_sections['k']['start'], $this->_sections['k']['iteration'] = 1;
                 $this->_sections['k']['iteration'] <= $this->_sections['k']['total'];
                 $this->_sections['k']['index'] += $this->_sections['k']['step'], $this->_sections['k']['iteration']++):
$this->_sections['k']['rownum'] = $this->_sections['k']['iteration'];
$this->_sections['k']['index_prev'] = $this->_sections['k']['index'] - $this->_sections['k']['step'];
$this->_sections['k']['index_next'] = $this->_sections['k']['index'] + $this->_sections['k']['step'];
$this->_sections['k']['first']      = ($this->_sections['k']['iteration'] == 1);
$this->_sections['k']['last']       = ($this->_sections['k']['iteration'] == $this->_sections['k']['total']);
?>
						  	<tr  bgcolor="<?php echo smarty_function_cycle(array('values' => '#eee,#fff'), $this);?>
" id="order_details_<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['goods_id']; ?>
">
						        <td class="pop_td">
						        	<input type="checkbox" value="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['goods_id']; ?>
" />
						        </td>
						        <td class="pop_td"><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['name']; ?>
</td>
						        <td class="pop_td"><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['specification']; ?>
</td>
						        <td class="pop_td"><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['unit']; ?>
</td>
						        <td class="pop_td"><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['quantity']; ?>
</td>
						        <td  class="pop_td" id="order_remark_<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['goods_id']; ?>
"><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['remark']; ?>
 <span></span></td>
						        <td class="pop_td"><input type="text" data-unit="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['unit']; ?>
" data-goodsid="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['goods_id']; ?>
" data-quantity="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['quantity']; ?>
" onblur="if(this.value><?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['quantity']; ?>
 || this.value<1)this.value=<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['quantity']; ?>
" value="<?php echo $this->_tpl_vars['deliveryList'][$this->_sections['i']['index']]['order_details'][$this->_sections['k']['index']]['quantity']; ?>
"  placeholder="拆分" /></td>
						      </tr>
						    <?php endfor; endif; ?>
						    </tbody>
						</table>
						<p align="center">
						<button type="button"  class="button" id="excreteBtn">拆分</button>&nbsp;&nbsp;<button type="button" class="button" >关闭</button>
						</p>
                  	</div>
                  	<?php endif; ?>
                  </td>
                </tr>
                <?php endfor; endif; ?>
            </tbody>
          </table>
          <div style="padding:10px 0px;">
            <input type="button" onclick="donext();" name="" id="button" class="button" value="下一步" />
            <a href="<?php echo smarty_function_get_url(array('rule' => "/delivery/index"), $this);?>
" style="padding: 6px !important;" class="button">查看已指派任务</a>
          </div>
          </form>
        </div>
      </div>
    </div>
    <script language="JavaScript">
    	
    	$(function(){
    		$('#tab1 .row-check').click(function(){
    			if($(this).is(':checked')){
    				var order_id = $(this).data('order_id');
	    			var order_idlen = $('#tab1 input[data-order_id="'+order_id+'"]').length
					//alert('2');
	    			if(order_idlen>1){
	    				$('#tab1 input[data-order_id="'+order_id+'"]').attr('checked',$(this).is(':checked'));
	    			}
    			}
    		});
    		
    		$('#tab1 a').click(function(){
    			var order_id = '.order_'+$(this).data('order_id');
    			layer.open({
				  type: 1,title:'拆分商品',
				  skin: 'layui-layer-rim', //加上边框
				  area: ['800px', '450px'], //宽高
				  content: $(order_id).html(),
				  success: function(layero, index){
					$('.layui-layer-content input[type="checkbox"]').click(function(){
						var goodsId = $(this).val();
						if($('.layui-layer-content #order_details_'+goodsId+' input[type="text"]').val() == 0){
							layer.msg('此商品数量不够拆分.');
							return false;
						}
						var status = $(this).is(':checked');
						$('.layui-layer-content #order_details_'+goodsId).css('background-color',status?'#FFDCDC':'#FFFFFF');
						$('.layui-layer-content #order_details_'+goodsId).find('input[type="text"]').attr('disabled',!status);
						$('.layui-layer-content #order_details_'+goodsId+' input[type="text"]').blur();
		    		});
		    		$('.layui-layer-content input[type="text"]').blur(function(){
						var goodsNum = $(this).val();
						var goodsId = $(this).data('goodsid');
						var unit = $(this).data('unit');
						var quantity = parseFloat($(this).data('quantity'));
						if(quantity - goodsNum >0){
							$('.layui-layer-content #order_remark_'+goodsId).find('span').html('拆出'+goodsNum+unit+',剩'+(quantity - goodsNum)+unit);
						}
						else{
							$('.layui-layer-content #order_remark_'+goodsId).find('span').html('整单拆出');
						}
		    		});
		    		
		    		$('.layui-layer-content #excreteBtn').click(function(){
		    			var order_id = $('.layui-layer-content table').data('order_id');
		    			var order_details = [];
		    			$('.layui-layer-content table tbody tr').each(function(){
		    				if($(this).find('input[type="checkbox"]').is(':checked')){
		    					var goods_id = $(this).find('input[type="checkbox"]').val();
			    				var excrete = $(this).find('input[type="text"]').val();
			    				var remark = $(this).find('#order_remark_'+goods_id+' span').text();
			    				order_details.push({
			    					goods_id:goods_id,
			    					excrete:excrete,
			    					remark:remark
			    				});
		    				}
		    			});
		    			var postdata = {
		    				id:order_id,details:order_details
		    			};
		    			$.ajax({type:'POST',url:'<?php echo smarty_function_get_url(array('rule' => '/delivery/excreteorder'), $this);?>
',data:postdata,dataType:'json',timeout:30000,success:function(msg,textStatus){
		    				layer.msg(msg.msg);
		    				if(msg.code == 1){
		    					window.location.reload();
		    				}
				        },error:function(textStatus,errorThrown){
				        	layer.msg('提交拆分请求失败。');
				        }});
		    		});
		    		
				  }
				});
    		});
    	});
    	
		var oids = new Array();
    	function getquantity(obj,type){

			$('#is_for_goods_'+obj.id).prop("checked",obj.checked);
			//alert(oids);
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
			/*$.post('<?php echo smarty_function_get_url(array('rule' => "/delivery/sumquantity"), $this);?>
',{
				oid : oids
			},function(res){
				if(res.data != null){
					$("#quantity").val(res.data.quantity);
					$("#quantitystr").html(res.data.quantity);
				}
			},'json');		*/
			var summary = 0.00;
			for(var i=0;i<oids.length;i++){
				var rid = "#row_"+oids[i]+"1";
				var cm = parseFloat($(rid).find(".quantity").html());
				summary = summary + cm;
			}
			$("#quantity").val(summary.toFixed(2));
			$("#quantitystr").html(summary.toFixed(2));
			
		}
		
		function donext(){
			if($("input:checkbox[class='row-check'][checked]").length < 1 ){
				alert('请选择数据');
				return;
			}
			$("#js-form").submit();
		}
		
		function gotoadd(){
			window.location.href = '<?php echo smarty_function_get_url(array('rule' => "/delivery/addhasdeliveryindex"), $this);?>
';
		}
		
		function getOrderBy(str){
			window.location.href = "/index.php/c/delivery/adddelivery?orderby="+str;
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