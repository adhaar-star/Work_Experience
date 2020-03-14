<?php /* Smarty version 2.6.16, created on 2017-03-08 10:36:05
         compiled from SiteInfo3.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'SiteInfo3.tpl', 6, false),array('modifier', 'date_format', 'SiteInfo3.tpl', 8, false),)), $this); ?>

<div class="subsection sitedetails">


<!--<table class="dataTable4">
<tr><td>Site Number</td><td><?php echo $this->_tpl_vars['siteData']['type'];  echo ((is_array($_tmp=$this->_tpl_vars['siteData']['refNumber'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%4s") : smarty_modifier_string_format($_tmp, "%4s")); ?>
</td></tr>
<tr><td>Site Name</td><td><?php echo $this->_tpl_vars['siteData']['name']; ?>
</td></tr>
<tr><td>Date</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['later'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d/%m/%Y') : smarty_modifier_date_format($_tmp, '%d/%m/%Y')); ?>

 </td></tr>
<tr><td>Time</td><td><?php echo ((is_array($_tmp=$this->_tpl_vars['later'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M:%S') : smarty_modifier_date_format($_tmp, '%H:%M:%S')); ?>
</td></tr>
<tr><td>Rep</td><td><?php echo $this->_tpl_vars['username']; ?>
</td></tr>
</table>-->
<div style="height:10px;">
	</div>
<div id="sitedetails1" style="font-size:20px;margin-left:4%;">
Site No:<?php echo ((is_array($_tmp=$this->_tpl_vars['siteData']['refNumber'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%4s") : smarty_modifier_string_format($_tmp, "%4s")); ?>
<br>
Site Name:<?php echo $this->_tpl_vars['siteData']['name']; ?>
<br>
DATE:<?php echo ((is_array($_tmp=$this->_tpl_vars['later'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d/%m/%Y') : smarty_modifier_date_format($_tmp, '%d/%m/%Y')); ?>
<br>
TIME:<?php echo ((is_array($_tmp=$this->_tpl_vars['later'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M:%S') : smarty_modifier_date_format($_tmp, '%H:%M:%S')); ?>
<br>
Rep:<?php echo $this->_tpl_vars['username']; ?>

</div>
