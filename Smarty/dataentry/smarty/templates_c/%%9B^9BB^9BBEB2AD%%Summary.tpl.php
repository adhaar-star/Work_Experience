<?php /* Smarty version 2.6.16, created on 2017-02-27 07:06:28
         compiled from Summary.tpl */ ?>
<h1>Sites & Machines Totals</h1>
<table class="dataTable" cellspacing="0">
<tr><th>Total Active<br>TVR Sites</th>
<th>Total Active<br>MVN Sites</th>
<th>Total Active<br>TVR Machines</th> 
<th>Total Active<br>MVN Machines</th>
<th>TVR Total</th>
<th>MVN Total</th>
<th>Total Active<br>Sites</th>
<th>Total Active<br>Machines</th></tr>
<tr>
<td align="center"><?php echo $this->_tpl_vars['totals']['activeTVRsites']; ?>
</td>
<td align="center"><?php echo $this->_tpl_vars['totals']['activeMVNsites']; ?>
</td>
<td align="center"><?php echo $this->_tpl_vars['totals']['activeTVRmachines']; ?>
</td>
<td align="center"><?php echo $this->_tpl_vars['totals']['activeMVNmachines']; ?>
</td>
<td align="center"><?php echo $this->_tpl_vars['totals']['totalTVR']; ?>
</td>
<td align="center"><?php echo $this->_tpl_vars['totals']['totalMVR']; ?>
</td>
<td align="center"><?php echo $this->_tpl_vars['totals']['activeSites']; ?>
</td>
<td align="center"><?php echo $this->_tpl_vars['totals']['activeMachines']; ?>
</td>
</tr>
</table>