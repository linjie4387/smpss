<?php /* Smarty version 2.6.26, created on 2017-05-10 11:19:43
         compiled from simpla/hospital/setofficegoods.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/hospital/setofficegoods.html', 32, false),array('modifier', 'cat', 'simpla/hospital/setofficegoods.html', 32, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "simpla/common/left.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<style>
.promote {
	display: none;
}

.edit-label {
	background-color:transparent;
	border:none;
}

#facebox table { width: 100%; border-collapse: collapse; }
#facebox table thead th { font-weight: bold; font-size: 15px; border-bottom: 1px solid #ddd; }
#facebox tbody { border-bottom: 1px solid #ddd; }
#facebox tbody tr { background: #fff; }
#facebox tbody tr.alt-row { background: #f3f3f3; }
#facebox table td, #main-content table th { padding: 10px; line-height: 1.3em; }
#facebox table tfoot td .bulk-actions { padding: 15px 0 5px 0; }
#facebox table tfoot td .bulk-actions select { padding: 4px; border: 1px solid #ccc; }

</style>
<div id="main-content">
	<h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
	<p id="page-intro">1.你可以在这里为科室分配商品。</p>
	<div class="clear"></div>
	<div class="content-box">
		<div class="content-box-header">
			<h3>科室商品分配</h3>
			<ul class="content-box-tabs">
				<li><a href="#tab1" class="default-tab">科室商品列表</a></li>
	            <li><a href="<?php echo smarty_function_get_url(array('rule' => '/hospital/addofficegoods','data' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['office']['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['office']['office_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&orderid=') : smarty_modifier_cat($_tmp, '&orderid=')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order_id']))), $this);?>
">添加科室商品</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="content-box-content">
			<div class="tab-content default-tab" id="tab1">
				<div class="form">
						<p>科室名称：<?php echo $this->_tpl_vars['office']['hospital_name']; ?>
_<?php echo $this->_tpl_vars['office']['name']; ?>
</p>
						<div>科室库存安全倍数：
							<input type="text" value="<?php echo $this->_tpl_vars['office']['safe_stock_ratio']; ?>
" id="safe_stock_ratio" />
							<a class="button" href="#" onclick="changeRatio();">
								<i class="icon-edit"></i>修改
							</a>
						</div>
				</div>
				<hr />
				<div class="form">
					<form action="<?php echo smarty_function_get_url(array('rule' => '/hospital/setofficegoods'), $this);?>
"
						method="post" id="js-form">
						<fieldset class="clearfix">
							<input type="hidden" value="<?php echo $this->_tpl_vars['office']['office_id']; ?>
" name="office_id" /> 
							<input type="hidden" value="<?php echo $this->_tpl_vars['order_id']; ?>
" name="order_id" />
							<p>
								<a href="javascript:void(0)">可以购买的商品列表</a>
							</p>
							<table>
								<thead>
									<tr>
										<th><input type="checkbox" name="comfig_all" id="check_all"></th>
										<th>商品名称</th>
										<th>商品编码</th>
										<th>规格</th>
										<th>厂商全名</th>
										<th>适用机型</th>
										<th>项目品类</th>
										<th>备注</th>
										<th>期初安全库存</th>
									</tr>
								</thead>
								<tbody>
									<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['goodsList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
									<td><input class="row-check" type="checkbox" name="checklist[]" value="<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_id']; ?>
"></td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['name']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_no']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['specification']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['manu']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['machine']; ?>
</td>
										<td><?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['category']; ?>
</td>
										<td><input type="text" readonly id="r_<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_id']; ?>
" data="<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_id']; ?>
" value="<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['remark']; ?>
" class="remark edit-label small-input"/>
											<i class="icon-edit" onclick="editremark(<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_id']; ?>
)"></i>
										</td>
										<td><input type="text" readonly id="s_<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_id']; ?>
" data="<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_id']; ?>
" value="<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['safe_stock']; ?>
" class="safe-stock edit-label small-input"/>
											<i class="icon-edit" onclick="editsafestock(<?php echo $this->_tpl_vars['goodsList'][$this->_sections['i']['index']]['goods_id']; ?>
)"></i>
										</td>
									</tr>
									<?php endfor; endif; ?>
								</tbody>
							</table>
							<div style="padding:10px 0px;">
								<input type="button" onclick="del();" id="button" class="button" value="删除商品" /> 
								<input type="button" onclick="addgoods();" name="" id="button" class="button" value="添加商品" />
								<input type="button" onclick="showupload();" name="" id="btnupload" class="button" value="批量导入" />
								<input type="button" onclick="download();" name="" id="btndownload" class="button" value="模板下载" />
								<input type="button" onclick="goback();" name="" id="button" class="button" value="返回" />
							</div>
						</fieldset>
					</form>
                    
                    <form action="<?php echo smarty_function_get_url(array('rule' => '/hospital/uploadmodel'), $this);?>
" method="post" id="js-file" enctype="multipart/form-data" style="padding:10px 0;display:none;">
                        <input type="file" id="file" name="file" />
                        <input type="hidden" value="<?php echo $this->_tpl_vars['office']['office_id']; ?>
" name="office_id" /> 
						<input type="hidden" value="<?php echo $this->_tpl_vars['order_id']; ?>
" name="order_id" />
                        <input type="button" onclick="submitfile();" class="button" value="确定并导入" />
						<input type="button" onclick="uploadcannel();" name="" id="btn_cannel" class="button" value="取消" />
                    </form>
				</div>
			</div>
			<!-- End #tab1 -->
		</div>
		<!-- End .content-box-content -->
	</div>
	<script>
		//全选
		$(function(){
			$("#check_all").change(function(){
				$('.row-check').prop("checked",this.checked); 
			});
			//修改备注
			$(".remark").change(function(){
				$.post("<?php echo smarty_function_get_url(array('rule' => '/hospital/modifyofficegoodsremark'), $this);?>
",{
					office_id : "<?php echo $this->_tpl_vars['office']['office_id']; ?>
",
					goods_id:$(this).attr('data'),
					remark:$(this).val()
				},function(res){
					console.log(res);
					if(res.code == 0){
						
					}else{
						jQuery.facebox(res.msg);
					}
				},'json');
			});
			
			$(".remark").blur(function(){
				$(this).addClass("edit-label");
				$(this).attr("readonly","readonly");
			});
			
			//修改期初库存
			$(".safe-stock").change(function(){
				$.post("<?php echo smarty_function_get_url(array('rule' => '/hospital/modifyofficegoodssafestock'), $this);?>
",{
					office_id : "<?php echo $this->_tpl_vars['office']['office_id']; ?>
",
					goods_id:$(this).attr('data'),
					safe_stock:$(this).val()
				},function(res){
					console.log(res);
					if(res.code == 0){
						
					}else{
						jQuery.facebox(res.msg);
					}
				},'json');
			});
			
			$(".safe-stock").blur(function(){
				$(this).addClass("edit-label");
				$(this).attr("readonly","readonly");
			});
		});
		//添加商品
		function addgoods(){
			window.location ="<?php echo smarty_function_get_url(array('rule' => '/hospital/addofficegoods','data' => ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['office']['office_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['office']['office_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '&orderid=') : smarty_modifier_cat($_tmp, '&orderid=')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order_id']))), $this);?>
";
		}
		
		function editremark(goods_id){
			$("#r_"+goods_id).removeClass("edit-label");
			$("#r_"+goods_id).removeAttr("readonly");
			$("#r_"+goods_id).focus();
		}
		
		function editsafestock(goods_id){
			$("#s_"+goods_id).removeClass("edit-label");
			$("#s_"+goods_id).removeAttr("readonly");
			$("#s_"+goods_id).focus();
		}
		//删除
		function del(){
			if($("input:checkbox[class='row-check'][checked]").length<=0){
				jQuery.facebox("请选择需要删除的科室商品！");
				return;
			}
			if(!confirm("确定要删除所选科室商品吗？")){
				return;
			}
			var goods_list = new Array();
			$("input:checkbox[class='row-check'][checked]").each(function(){
				var gid = this.value;
				goods_list.push(gid);
			});
			$.post("<?php echo smarty_function_get_url(array('rule' => '/hospital/delofficegoods'), $this);?>
",{
				office_id : "<?php echo $this->_tpl_vars['office']['office_id']; ?>
",
				goods_list:goods_list
			},function(res){
				console.log(res);
				if(res.code == 0){
					jQuery.facebox("操作成功！");
					window.location.reload();
				}else{
					jQuery.facebox(res.msg);
				}
			},'json');
		}
		
		function goback(){
			<?php if ($this->_tpl_vars['order_id'] == null || $this->_tpl_vars['order_id'] == 0): ?>
			window.location="<?php echo smarty_function_get_url(array('rule' => '/hospital/officeindex'), $this);?>
";
			<?php else: ?>
			window.location="<?php echo smarty_function_get_url(array('rule' => '/order/addrecord','data' => ((is_array($_tmp='oid=')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['order_id']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['order_id']))), $this);?>
";
			<?php endif; ?>
		}
		
		function download(){
			window.location="<?php echo smarty_function_get_url(array('rule' => '/hospital/downloadmodel'), $this);?>
";
		}
		
		function showupload(){
			$("#js-file").show();
		}
		function uploadcannel(){
			$("#js-file").hide();
		}
		function submitfile(){
			$("#js-file").submit();
		}
		
		function changeRatio(){
			$.post("<?php echo smarty_function_get_url(array('rule' => '/hospital/setofficeratio'), $this);?>
",{
				office_id : "<?php echo $this->_tpl_vars['office']['office_id']; ?>
",
				safe_stock_ratio:$("#safe_stock_ratio").val()
			},function(res){
				if(res.code == 0){
					jQuery.facebox("操作成功！");
				}else{
					jQuery.facebox(res.msg);
				}
			},'json');
		}
	</script>
	<!-- End .content-box -->
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