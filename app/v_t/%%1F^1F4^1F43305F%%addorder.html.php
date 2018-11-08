<?php /* Smarty version 2.6.26, created on 2017-10-11 15:56:02
         compiled from simpla/order/addorder.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/order/addorder.html', 28, false),)), $this); ?>
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
<script type="text/javascript" src="<?php echo $this->_tpl_vars['root_dir']; ?>
/assets/simpla/scripts/searchList.js"></script>
<style>
.promote{display:none;}
p.inline label {display:inline;}
#main-content ul li { background:none;}
.mws-search-select { position:relative;}
.mws-search-select .mws-search-box { width:180px;padding-right: 20px;}
.mws-search-select .mws-search-btn { position: absolute;left: 21%;top: 10px;width: 0;height: 0;border-left: 3px solid transparent;border-right: 3px solid transparent;border-top: 6px solid #333;}
.mws-search-select .mws-search-list { list-style: none;position: absolute;background-color: #FFFFFF;width: 21.5%;left: 0;top:29px;border: 1px solid #d5d5d5;border-top: none;max-height: 270px;margin: 0;overflow-y: auto;z-index:1001;display:none;}
.mws-search-select .mws-search-list li { margin:0;padding-left:10px;}
.mws-search-select .mws-search-list li:hover { background: #5697cc !important;color:#FFFFFF;}
.mws-search-select .mws-search-list li.on { background-color: #5697cc !important;color:#FFFFFF;}
</style>
<div id="main-content">
  <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
  <p id="page-intro">1.你可以在这里录入医院科室订单。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>医院订单录入</h3>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/order/saveorder'), $this);?>
" method="post" id="js-form" AUTOCOMPLETE="OFF" onSubmit="return check();">
            <fieldset class="clearfix">
              <input type="hidden" value="<?php echo $this->_tpl_vars['hospitalorder']['hospitalorder_id']; ?>
" name="hospitalorder_id" />
              <input type="hidden" value="<?php echo $this->_tpl_vars['hospitalorder']['weichatuser_id']; ?>
" name="weichatuser_id" />
              <input type="hidden" value="<?php echo $this->_tpl_vars['hospitalorder']['hospital_id']; ?>
" name="hospital_id" />
              <input type="hidden" value="<?php echo $this->_tpl_vars['hospitalorder']['office_id']; ?>
" name="office_id" />
              <p>
                <label><font class="red"> * </font>医院：</label>
                <div id="hospital_box" class="mws-search-select">
                    <ul class="mws-search-list">
                        <li data="">-----选择医院-----</li>
                        <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['hospitalList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                        <li data="<?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id']; ?>
"><?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['name']; ?>
</li>
                        <?php endfor; endif; ?>
                    </ul>
                    <span class="mws-search-btn"></span>
                    <input class="mws-search-val" type="hidden" id="hospital_id" name="hospital_id" value="" />
                    <input class="mws-search-box text-input small-input" type="text" value="" />
                </div>
                <span></span> 
              </p>
              <p>
                <label><font class="red"> * </font>科室：</label>
                <select name="office_id" id="office_id">
                    <option value="0">-----选择科室----</option>
                </select>
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>发货单号：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospitalorder']['delivery_no']; ?>
" class="text-input small-input" name="delivery_no" id="delivery_no"/>
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>发票单号：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospitalorder']['invoice_no']; ?>
" class="text-input small-input" name="invoice_no" id="invoice_no"/>
                <span></span> </p>
              <p>
                <label><font class="red"> * </font>大件数量：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospitalorder']['large_size_count']; ?>
" class="text-input small-input" name="large_size_count" id="large_size_count"/>
                <span></span> </p>
             <p class="inline">
                <label><font class="red"> * </font>是否冷链：</label>
                <input type="radio" value="0" name="is_coldchain" id="is_coldchain"  checked="checked" /><label>否</label>  
                <input type="radio" value="1" name="is_coldchain" id="is_not_coldchain" /><label>是</label>  
             </p>
                
              <p>
                <label>备注：</label>
                <input type="text" value="<?php echo $this->_tpl_vars['hospitalorder']['remark']; ?>
" class="text-input small-input" name="remark" id="remark"/>
                <span></span> </p>
              
              <dt>
                <input type="submit" name="" id="button" class="button" value="保存" />
              </dt>
            </fieldset>
          </form>
        </div>
      </div>
      <!-- End #tab1 --> 
    </div>
    <!-- End .content-box-content --> 
  </div>
  <!-- End .content-box --> 
  <script>
	  function selectOffice() {
			var hospital_id = $('#hospital_id').val();
			$.post("<?php echo smarty_function_get_url(array('rule' => '/hospital/getOfficeOpt'), $this);?>
",
					{hospital_id : hospital_id},
					function(res){
						console.log(res);
						if(res.code == 0){
							$("#office_id").html('');
							$("#office_id").append( "<option value=\"0\">--选择科室--</option>" );
							for(var i=0;i<res.data.length;i++){
								$("#office_id").append( "<option value=\""+res.data[i].office_id+ "\">"+res.data[i].name+"</option>" );
							}
						}else{
							//jQuery.facebox(res.msg);
						}
					},'json');
			
	}
	  
	function check(){
		$office = $("#office_id").val();
		if(!$office) {
			alert("请选择医院及科室。");return false;
		}
		$delivery_no = $("#delivery_no").val();
		$invoice_no = $("#invoice_no").val();
		if(!$delivery_no||!$invoice_no){
			alert("请输入发货单号和发票单号。");return false;
		}
		$large_size_count = $("#large_size_count").val();
		if(!$large_size_count){
			alert("请输入大包装数量。");return false;
		}
		return true;
	}
	
	$(function(){
		searchList.init({
			obj:$("#hospital_box"),			
			fnc:true,
			callback:selectOffice
		});
	});
  </script>
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