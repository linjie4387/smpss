<?php /* Smarty version 2.6.26, created on 2017-05-10 11:25:24
         compiled from simpla/delivery/adddeliverycarman.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/adddeliverycarman.html', 9, false),)), $this); ?>
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
    <p id="page-intro">待指派任务 > 选择司机</p>
    <div class="clear"></div>
    
    	
        <form action="<?php echo smarty_function_get_url(array('rule' => "/delivery/adddeliverydone"), $this);?>
" method="post" id="js-form">
        <div class="content-box column-left">
            <div class="content-box-header">
                <h3 style="cursor: s-resize;">选择司机</h3>
            </div>
            <div class="content-box-content" style="display: block;">
            	<div class="form">
                    <fieldset>
                        <p>关键字：<input type="text" value="<?php echo $this->_tpl_vars['driverkey']; ?>
" class="text-input small-input" id="driverkey" name="driverkey" />
                        <input type="hidden" name="mold" id="mold" value="<?php echo $this->_tpl_vars['mold']; ?>
" />
                        <span>（姓名，手机号）<span>
                            </span><input type="button" name="" id="button" class="button" value="查询" onclick="getDriver(1)" /></span>
                    </fieldset>
                </div>
            	<hr />
                <table style="overflow-x: auto;max-height:480px;display: block;">
                    <thead>
                      <tr>
                        <th>选择</th>
                        <th>姓名</th>
                        <th>手机号码</th>
                        <th>驾照类型</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <td id="driverlist_page" colspan="4"></td>
                      </tr>
                    </tfoot>
                    <tbody id="driverlist">
                        
                    </tbody>
                  </table> 
            </div>
        </div>
        
        <div class="content-box column-right">
            <div class="content-box-header">
                <h3 style="cursor: s-resize;">选择送货员</h3>
            </div>
            <div class="content-box-content" style="display: block;">
            	<div class="form">
                    <fieldset>
                        <p>关键字：<input type="text" value="<?php echo $this->_tpl_vars['deliverykey']; ?>
" class="text-input small-input" id="deliverykey" name="deliverykey" />
                        <span>（姓名，手机号）<span>
                            </span><input type="button" name="" id="button" class="button" value="查询" onclick="getDeliveryMan(1)" /></span>
                    </fieldset>
                </div>
            	<hr />
                <table style="overflow-x: auto;max-height:480px;display: block;">
                    <thead>
                      <tr>
                        <th>选择<!--<input type="checkbox" name="checkall" id="check_all">--></th>
                        <th>姓名</th>
                        <th>手机号码</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <td id="deliverymanlist_page" colspan="4"></td>
                      </tr>
                    </tfoot>
                    <tbody id="deliverymanlist-lock">
                        
                    </tbody>
                    <tbody id="deliverymanlist">
                        
                    </tbody>
                  </table>  
            </div>
        </div>
        <div class="clear"></div>
        <div style="padding:10px 0px;">
            <input type="hidden" name="qoids" id="qoids" value="<?php echo $this->_tpl_vars['qoids']; ?>
" /> 
            <input type="hidden" name="qoids_for_goods" id="qoids_for_goods" value="<?php echo $this->_tpl_vars['qoids_for_goods']; ?>
" /> 
            <input type="hidden" name="quantity" id="quantity" value="<?php echo $this->_tpl_vars['quantity']; ?>
" />            
            <input type="hidden" name="car_id" id="car_id" value="<?php echo $this->_tpl_vars['car_id']; ?>
" />
            
            <input type="button" onclick="javascript:history.go(-1);" name="" id="button" class="button" value="上一步" />&nbsp;         
            <input type="button" onclick="donext();" name="" id="button" class="button" value="提 交" />
       </div> 
       </form>
    <script>
		function donext(){
			if($("input:radio[class='row-radio'][checked]").length < 1 ){
				alert('请选择司机');
				return;
			}
			if($("input:checkbox[class='row-check'][checked]").length < 1 ){
				alert('请选择送货员');
				return;
			}
			$("#js-form").submit();
		}	
		
		function getDriver(curpage){			
			getListByAjax({
				main : "getDriver",
				url : '<?php echo smarty_function_get_url(array('rule' => "/delivery/getdriverlist"), $this);?>
',
				page : curpage,
				keyid : "driverkey",
				mold :$('#mold').val()||0,
				callback : "getDriverCallback",
				listbar : $("#driverlist"),
				pagebar : $("#driverlist_page"),
				colcount : 4
			});		
		}		
		function getDriverCallback(row,ischeck,chagehtm){
			var htm = '<td><input class="row-radio" type="radio" name="driver_deliveryman_id" value="'+row.deliveryman_id+'"></td>'+
					  "<td>"+row.name+"</td>"+
					  "<td>"+row.mobile+"</td>"+
					  "<td>"+row.driverlicense_type_name+"</td>";
			return htm;
		}
		
		function getDeliveryMan(curpage){	
			getListByAjax({
				main : "getDeliveryMan",
				url : '<?php echo smarty_function_get_url(array('rule' => "/delivery/getdeliverymanlist"), $this);?>
',
				page : curpage,
				keyid : "deliverykey",
				callback : "getDeliveryManCallback",
				listbar : $("#deliverymanlist"),
				listlock : $("#deliverymanlist-lock"),
				pagebar : $("#deliverymanlist_page"),
				colcount : 3,
				ischeck : true
			});		
		}		
		
		function getDeliveryManCallback(row,ischeck,chagehtm){
			var htm = "";			
			if(ischeck){
				if(rowids.indexOf(row.deliveryman_id) > -1){
					return htm;	
				}else{
					htm = '<td><input class="row-check" type="checkbox" name="deliveryman[]" value="'+row.deliveryman_id+'" '+chagehtm+'></td>'+
					  "<td>"+row.name+"</td>"+
					  "<td>"+row.mobile+"</td>";
				}
			}else{
				htm = '<td><input class="row-check" type="checkbox" name="deliveryman[]" value="'+row.deliveryman_id+'"></td>'+
					  "<td>"+row.name+"</td>"+
					  "<td>"+row.mobile+"</td>";	
			}
			
			return htm;
		}
		
		
		
		$("#check_all").change(function(){
			var obj = this;	
			
			if(obj.checked){			
				$("#deliverymanlist .row-check").each(function(){
					rowids.push(obj.value);
					$("#deliverymanlist-lock").append($(this).parent().parent());
				});
			}else{
				$("#deliverymanlist-lock .row-check").each(function(){
					rowids.remove(obj.value);
					$("#deliverymanlist").append($(this).parent().parent());	
				});
			}
			
			$('.row-check').prop("checked",this.checked);
		});
		
		$(function(){
			getDriver(1);
			getDeliveryMan(1);
		});
		
				
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