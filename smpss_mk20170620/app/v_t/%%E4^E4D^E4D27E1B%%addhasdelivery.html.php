<?php /* Smarty version 2.6.26, created on 2017-06-07 16:31:54
         compiled from simpla/delivery/addhasdelivery.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_url', 'simpla/delivery/addhasdelivery.html', 19, false),)), $this); ?>
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


<link rel="stylesheet" href="/assets/select2/select2.css">
<script src="/assets/select2/select2.full.js"></script>
<script src="/assets/select2/i18n/zh-CN.js"></script>


<div id="main-content">
  <h2>欢迎您 <?php echo $this->_tpl_vars['_adminname']; ?>
</h2>
  <p id="page-intro">1.你可以在这里添加新的送货任务。2.带 <span class="red">*</span> 的项目必填</p>
  <div class="clear"></div>
  <div class="content-box">
    <div class="content-box-header">
      <h3>新增任务</h3>
      <ul class="content-box-tabs">
        <li><a href="<?php echo smarty_function_get_url(array('rule' => "/delivery/hasdeliverylist"), $this);?>
">任务管理</a></li>
        <li><a href="#tab1" class="default-tab">添加任务</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <div class="content-box-content">
      <div class="tab-content default-tab" id="tab1">
        <div class="form">
          <form action="<?php echo smarty_function_get_url(array('rule' => '/delivery/addhasdelivery'), $this);?>
" method="post" id="js-form">
            <fieldset class="clearfix">
              
              <p>
              <label><font class="red"> * </font>选择医院：</label>
                <select id="hospital_id" name="hospital_id">
                    <option value="0">-----选择医院-----</option>
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
                    <option value="<?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id']; ?>
" <?php if ($this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['hospital_id'] == $this->_tpl_vars['hospital_id']): ?>selected="selected"<?php endif; ?>>
                        <?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['pre']; ?>
<?php echo $this->_tpl_vars['hospitalList'][$this->_sections['i']['index']]['name']; ?>

                    </option>
                    <?php endfor; endif; ?>
                </select>
                <span></span>
              </p>
              
              <p>
              <label><font class="red"> * </font>选择科室：</label>
                <select id="office_id" name="office_id">
                    <option value="0">-----选择科室-----</option>
                </select>
                <span></span>
              </p>
              
              <p><label><font class="red"> * </font>选择接单公司：</label>
                <select  id="order_company_id" name="order_company_id">
	                  <option value="0">选择接单公司</option>
	                  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['orderCompanyList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	                  <option value="<?php echo $this->_tpl_vars['orderCompanyList'][$this->_sections['i']['index']]['value']; ?>
"><?php echo $this->_tpl_vars['orderCompanyList'][$this->_sections['i']['index']]['name']; ?>
</option>
	                  <?php endfor; endif; ?>
	              </select>
                <span></span>
              </p>
              
              <p>
                <label>单据号：</label>
                <input type="text" value="" class="text-input small-input" name="delivery_no" id="delivery_no" />
                <span></span>
              </p>
              
              <p>
                <label>收货人微信：</label>
                <select id="weichatuser_id" name="weichatuser_id">
                    <option value="0">-----选择收货人微信-----</option>
                    <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['weichatuserList']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                      <option value="<?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['weichatuser_id']; ?>
" data-mobile="<?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['mobile']; ?>
"><?php echo $this->_tpl_vars['weichatuserList'][$this->_sections['i']['index']]['name']; ?>
</option>
                    <?php endfor; endif; ?>
                </select><br/><small>医院用户的微信，通知用的。</small>
              </p>
              <p>
                <label><font class="red"> * </font>收货人姓名：</label>
                <input type="text" value="" class="text-input small-input" name="name" id="name" />
                <span></span>
              </p>
              
              <p>
                <label><font class="red"> * </font>收货人联系电话：</label>
                <input type="text" value="" class="text-input small-input" name="mobile" id="mobile" />
                <span></span>
              </p>
              <p>
                <label>备注：</label>
                <input type="text" value="" class="text-input medium-input" name="remark" id="remark" />
                <span></span> 
                <input name="ordertype" type="hidden" id="ordertype" value="9" />
              </p>
              
              <dt>
                <input type="submit" name="" id="sendbutton" class="button" value="添加任务" />
              </dt>
            </fieldset>
          </form>
        </div>
      </div>
      <!-- End #tab1 --> 
    </div>
    <!-- End .content-box-content --> 
  </div>
  
<script type="text/javascript">
	$(function(){
		$('#hospital_id').change(function(){
			var hospital_id = $(this).val();
			$.post("<?php echo smarty_function_get_url(array('rule' => '/delivery/getoffice'), $this);?>
",{
				hospital_id:hospital_id
			},function(res){
				if(res.code == 0){
					$('#office_id').empty('<option value="0">-----选择科室-----</option>');
					$.each(res.data, function(k,v) {
						$('#office_id').append('<option value="'+v.office_id+'">'+v.name+'</option>');
					});
				}else{
					jQuery.facebox(res.msg);
				}
			},'json');
		});
		
		$('#weichatuser_id').change(function(){
			var weichatuser_name = $(this).find('option:selected').text();
			var weichatuser_mobile = $(this).find('option:selected').attr('data-mobile');
			$('#name').val(weichatuser_name);
			$('#mobile').val(weichatuser_mobile);
		});
		
		
		$('#sendbutton').click(function(){
			var hospital_id = $(this).val();
			
			
			/*$.post("<?php echo smarty_function_get_url(array('rule' => '/delivery/getoffice'), $this);?>
",{
				hospital_id:hospital_id
			},function(res){
				if(res.code == 0){
					$('#office_id').empty('<option value="0">-----选择科室-----</option>');
					$.each(res.data, function(k,v) {
						$('#office_id').append('<option value="'+v.office_id+'">'+v.name+'</option>');
					});
				}else{
					jQuery.facebox(res.msg);
				}
			},'json');*/
		});
		$('#hospital_id').select2({placeholder: '选择医院',language: "zh-CN",allowClear:true});
		$('#weichatuser_id').select2({placeholder: '选择人员',language: "zh-CN",allowClear:true});
		
	});
	

</script>
  
  
  
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