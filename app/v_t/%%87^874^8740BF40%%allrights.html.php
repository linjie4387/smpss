<?php /* Smarty version 2.6.26, created on 2017-09-24 11:02:41
         compiled from simpla/system/allrights.html */ ?>
<div class="rights">
	<p>
		<a href="javascript:void(0)">医院管理权限</a>
	</p>
	<ul>
		<li><input type="checkbox" name="hospital[]" value="医院管理:index"
			<?php if ($this->_tpl_vars['action']['menu']['hospital']['index']): ?>checked="checked" <?php endif; ?> /> 医院管理</li>
		<li><input type="checkbox" name="hospital[]"
			value="科室管理:officeindex"
			<?php if ($this->_tpl_vars['action']['menu']['hospital']['officeindex']): ?>checked="checked" <?php endif; ?> />
			科室管理</li>
		<li><input type="checkbox" name="hospital[]"
			value="一键同步数据:syncdata:button"
			<?php if ($this->_tpl_vars['action']['btn']['hospital_syncdata']): ?>checked="checked" <?php endif; ?> /> 一键同步工程部数据</li>
        <li><input type="checkbox" name="hospital[]"
            value="预订单打印:preorderprint:button"
            <?php if ($this->_tpl_vars['action']['btn']['hospital_preorderprint']): ?>checked="checked" <?php endif; ?> />预订单打印</li>
	</ul>
</div>
<!--  
<div class="rights">
    <p><a href="javascript:void(0)">供应商管理权限</a></p>
    <ul>
        <li>
            <input type="checkbox" name="supplier[]" value="供应商管理:index" <?php if ($this->_tpl_vars['action']['menu']['supplier']['index']): ?>checked="checked"<?php endif; ?> />
            供应商管理</li>
        <li>
            <input type="checkbox" name="supplier[]" value="型号管理:modelindex" <?php if ($this->_tpl_vars['action']['menu']['supplier']['modelindex']): ?>checked="checked"<?php endif; ?> />
            型号管理</li>
    </ul>
</div>
-->
<div class="rights">
	<p>
		<a href="javascript:void(0)">微信用户管理权限</a>
	</p>
	<ul>
		<li><input type="checkbox" name="user[]"
			value="医院用户管理:hospitalindex"
			<?php if ($this->_tpl_vars['action']['menu']['user']['hospitalindex']): ?>checked="checked" <?php endif; ?> />
			医院用户管理</li>
		<li><input type="checkbox" name="user[]"
			value="内部用户管理:engineerindex"
			<?php if ($this->_tpl_vars['action']['menu']['user']['engineerindex']): ?>checked="checked" <?php endif; ?> />
			内部用户管理</li>
		<li><input type="checkbox" name="user[]"
			value="删除用户:deluser:button"
			<?php if ($this->_tpl_vars['action']['btn']['user_deluser']): ?>checked="checked" <?php endif; ?> /> 删除用户</li>
	</ul>
</div>
<div class="rights">
	<p>
		<a href="javascript:void(0)">医院订单管理权限</a>
	</p>
	<ul>
		<li><input type="checkbox" name="order[]" value="预订单管理:index"
			<?php if ($this->_tpl_vars['action']['menu']['order']['index']): ?>checked="checked" <?php endif; ?> /> 预订单管理</li>
		<li><input type="checkbox" name="order[]"
			value="删除预订单:delorder:button"
			<?php if ($this->_tpl_vars['action']['btn']['order_delorder']): ?>checked="checked" <?php endif; ?> /> 删除预订单</li>
        <li><input type="checkbox" name="order[]" value="修改预订单备注:editremark:button"
			<?php if ($this->_tpl_vars['action']['btn']['order_editremark']): ?>checked="checked" <?php endif; ?> /> 修改预订单备注</li>
        <li><input type="checkbox" name="order[]" value="正式订单管理:tradeindex"
            <?php if ($this->_tpl_vars['action']['menu']['order']['tradeindex']): ?>checked="checked" <?php endif; ?> /> 正式订单管理</li>
        <li><input type="checkbox" name="order[]" value="新增订单:addorder"
            <?php if ($this->_tpl_vars['action']['menu']['order']['addorder']): ?>checked="checked" <?php endif; ?> /> 新增订单</li>
	</ul>
</div>
<div class="rights">
	<p>
		<a href="javascript:void(0)">仪器管理权限</a>
	</p>
	<ul>
		<li><input type="checkbox" name="device[]" value="仪器查询:index"
			<?php if ($this->_tpl_vars['action']['menu']['device']['index']): ?>checked="checked" <?php endif; ?> /> 仪器查询</li>
		<li><input type="checkbox" name="device[]" value="导入仪器:adddevice"
			<?php if ($this->_tpl_vars['action']['menu']['device']['adddevice']): ?>checked="checked" <?php endif; ?> /> 导入仪器</li>
		<li><input type="checkbox" name="device[]" value="更新记录:logindex"
			<?php if ($this->_tpl_vars['action']['menu']['device']['logindex']): ?>checked="checked" <?php endif; ?> /> 更新记录</li>
	</ul>
</div>
<!--
<div class="rights">
	<p>
		<a href="javascript:void(0)">试剂管理权限</a>
	</p>
	<ul>
		<li><input type="checkbox" name="reagent[]" value="试剂查询:index"
			<?php if ($this->_tpl_vars['action']['menu']['reagent']['index']): ?>checked="checked" <?php endif; ?> /> 试剂查询</li>
		<li><input type="checkbox" name="reagent[]"
			value="导入试剂:addreagent"
			<?php if ($this->_tpl_vars['action']['menu']['reagent']['addreagent']): ?>checked="checked" <?php endif; ?> />
			导入试剂</li>
		<li><input type="checkbox" name="reagent[]" value="更新记录:logindex"
			<?php if ($this->_tpl_vars['action']['menu']['reagent']['logindex']): ?>checked="checked" <?php endif; ?> /> 更新记录</li>
	</ul>
</div>
-->
<div class="rights">
    <p>
    <a href="javascript:void(0)">商品管理权限</a>
    </p>
    <ul>
        <li><input type="checkbox" name="goods[]" value="商品管理:index"
            <?php if ($this->_tpl_vars['action']['menu']['goods']['index']): ?>checked="checked" <?php endif; ?> /> 商品管理</li>
        <!--li>
        	<input type="checkbox" name="goods[]"
            value="新增商品:addgoods"
            <?php if ($this->_tpl_vars['action']['menu']['goods']['addgoods']): ?>checked="checked" <?php endif; ?> />
            新增商品
        </li-->
        <li>
        	<input type="checkbox" name="goods[]"
            value="导入导出商品:importandexport"
            <?php if ($this->_tpl_vars['action']['menu']['goods']['importandexport']): ?>checked="checked" <?php endif; ?> />
            导入导出商品
        </li>
    </ul>
</div>
<div class="rights">
    <p>
    <a href="javascript:void(0)">配送管理权限</a>
    </p>
    <ul>
    	<li><input type="checkbox" name="delivery[]"
            value="任务池:adddelivery"
            <?php if ($this->_tpl_vars['action']['menu']['delivery']['adddelivery']): ?>checked="checked" <?php endif; ?> />
            任务池</li>
        <li><input type="checkbox" name="delivery[]"
            value="任务管理:hasdeliverylist"
            <?php if ($this->_tpl_vars['action']['menu']['delivery']['hasdeliverylist']): ?>checked="checked" <?php endif; ?> />
            任务管理</li>
        <li><input type="checkbox" name="delivery[]" value="车辆管理:caradm"
            <?php if ($this->_tpl_vars['action']['menu']['delivery']['caradm']): ?>checked="checked" <?php endif; ?> /> 车辆管理</li>
        <li><input type="checkbox" name="delivery[]"
            value="送货员管理:manadm"
            <?php if ($this->_tpl_vars['action']['menu']['delivery']['manadm']): ?>checked="checked" <?php endif; ?> />
            送货员管理</li>        
    </ul>
</div>

<div class="rights">
	<p>
		<a href="javascript:void(0)">数据报表管理权限</a>
	</p>
	<ul>
		<li><input type="checkbox" name="report[]" value="运输统计:order"
			<?php if ($this->_tpl_vars['action']['menu']['report']['order']): ?>checked="checked" <?php endif; ?> /> 运输统计
		</li>
	</ul>
</div>

<div class="rights">
	<p>
		<a href="javascript:void(0)">账号权限</a>
	</p>
	<ul>
		<li><input type="checkbox" name="account[]" value="账号管理:index"
			<?php if ($this->_tpl_vars['action']['menu']['account']['index']): ?>checked="checked" <?php endif; ?> /> 账号管理</li>
		<li><input type="checkbox" name="account[]"
			value="添加账号:addaccount"
			<?php if ($this->_tpl_vars['action']['menu']['account']['addaccount']): ?>checked="checked" <?php endif; ?> />
			添加账号</li>
		<li><input type="checkbox" name="account[]"
			value="密码修改:modifypwd"
			<?php if ($this->_tpl_vars['action']['menu']['account']['modifypwd']): ?>checked="checked" <?php endif; ?> />
			密码修改</li>
	</ul>
</div>
<div class="rights">
	<p>
		<a href="javascript:void(0)">系统权限</a>
	</p>
	<ul>
		<li><input type="checkbox" name="system[]" value="系统信息:index"
			checked="checked" /> 系统信息</li>
		<li><input type="checkbox" name="system[]" value="系统配置:setting"
			<?php if ($this->_tpl_vars['action']['menu']['system']['setting']): ?>checked="checked" <?php endif; ?> /> 系统配置</li>
        <li><input type="checkbox" name="system[]" value="字典配置:dictsetting"
            <?php if ($this->_tpl_vars['action']['menu']['system']['dictsetting']): ?>checked="checked" <?php endif; ?> /> 字典配置</li>
		<li><input type="checkbox" name="system[]" value="权限管理:rights"
			<?php if ($this->_tpl_vars['action']['menu']['system']['rights']): ?>checked="checked" <?php endif; ?> /> 权限管理</li>
		<li><input type="checkbox" name="system[]"
			value="添加用户组:addrights"
			<?php if ($this->_tpl_vars['action']['menu']['system']['addrights']): ?>checked="checked" <?php endif; ?> />
			添加用户组</li>
		<li><input type="checkbox" name="system[]" value="系统日志:log"
			<?php if ($this->_tpl_vars['action']['menu']['system']['log']): ?>checked="checked" <?php endif; ?> /> 日志管理</li>
	</ul>
</div>
