<?php /* Smarty version 2.6.26, created on 2017-09-24 11:01:25
         compiled from simpla/common/page/style2.html */ ?>
<div class="pagination">
<button type="submit" formaction="<?php echo $this->_tpl_vars['first']; ?>
">首页</button>
<?php if ($this->_tpl_vars['prepg'] == null): ?>
<button type="button" >上一页</button>
<?php else: ?>
<button type="submit" formaction="<?php echo $this->_tpl_vars['prepg']; ?>
">上一页</button>
<?php endif; ?>
<?php unset($this->_sections['sec']);
$this->_sections['sec']['name'] = 'sec';
$this->_sections['sec']['loop'] = is_array($_loop=$this->_tpl_vars['pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sec']['start'] = (int)$this->_tpl_vars['start'];
$this->_sections['sec']['max'] = (int)$this->_tpl_vars['max'];
$this->_sections['sec']['show'] = true;
if ($this->_sections['sec']['max'] < 0)
    $this->_sections['sec']['max'] = $this->_sections['sec']['loop'];
$this->_sections['sec']['step'] = 1;
if ($this->_sections['sec']['start'] < 0)
    $this->_sections['sec']['start'] = max($this->_sections['sec']['step'] > 0 ? 0 : -1, $this->_sections['sec']['loop'] + $this->_sections['sec']['start']);
else
    $this->_sections['sec']['start'] = min($this->_sections['sec']['start'], $this->_sections['sec']['step'] > 0 ? $this->_sections['sec']['loop'] : $this->_sections['sec']['loop']-1);
if ($this->_sections['sec']['show']) {
    $this->_sections['sec']['total'] = min(ceil(($this->_sections['sec']['step'] > 0 ? $this->_sections['sec']['loop'] - $this->_sections['sec']['start'] : $this->_sections['sec']['start']+1)/abs($this->_sections['sec']['step'])), $this->_sections['sec']['max']);
    if ($this->_sections['sec']['total'] == 0)
        $this->_sections['sec']['show'] = false;
} else
    $this->_sections['sec']['total'] = 0;
if ($this->_sections['sec']['show']):

            for ($this->_sections['sec']['index'] = $this->_sections['sec']['start'], $this->_sections['sec']['iteration'] = 1;
                 $this->_sections['sec']['iteration'] <= $this->_sections['sec']['total'];
                 $this->_sections['sec']['index'] += $this->_sections['sec']['step'], $this->_sections['sec']['iteration']++):
$this->_sections['sec']['rownum'] = $this->_sections['sec']['iteration'];
$this->_sections['sec']['index_prev'] = $this->_sections['sec']['index'] - $this->_sections['sec']['step'];
$this->_sections['sec']['index_next'] = $this->_sections['sec']['index'] + $this->_sections['sec']['step'];
$this->_sections['sec']['first']      = ($this->_sections['sec']['iteration'] == 1);
$this->_sections['sec']['last']       = ($this->_sections['sec']['iteration'] == $this->_sections['sec']['total']);
?>
<button type="submit" class="number <?php if ($this->_tpl_vars['currpage'] == $this->_tpl_vars['pages'][$this->_sections['sec']['index']]['page']): ?>current<?php endif; ?>" formaction="<?php echo $this->_tpl_vars['pages'][$this->_sections['sec']['index']]['url']; ?>
"><?php echo $this->_tpl_vars['pages'][$this->_sections['sec']['index']]['page']; ?>
</button>
<?php endfor; endif; ?>
<?php if ($this->_tpl_vars['nextpg'] == null): ?>
<button type="button" >下一页</button>
<?php else: ?>
<button type="submit" formaction="<?php echo $this->_tpl_vars['nextpg']; ?>
">下一页</button>
<?php endif; ?>
<button type="submit" formaction="<?php echo $this->_tpl_vars['last']; ?>
">尾页</button>
</div>
<div class="clear"></div>