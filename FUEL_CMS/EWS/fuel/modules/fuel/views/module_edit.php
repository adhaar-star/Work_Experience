<!-- RELATED ITEMS -->
<?php $this->load->module_view(FUEL_FOLDER, '_blocks/related_items'); ?>

<!-- NOTIFICATION EXTRA -->
<?php $this->load->module_view(FUEL_FOLDER, '_blocks/notification_extra'); ?>

<!-- WARNING WINDOW -->
<?php $this->load->module_view(FUEL_FOLDER, '_blocks/warning_window'); ?>

<head>
<style>
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th {
  font-weight: 500;
  color: #333;
  padding: 2px 10px;
  border-style: solid;
  border-color: #ccc;
  border-width: 1px;
  overflow: hidden;
  word-break: normal;
}
.tg .tg-rd2y{font-size:12px}
</style>

</head>
<div id="fuel_main_content_inner">

	<?php if (!empty($instructions)) : ?>
	<p class="instructions"><?=$instructions?></p>
	<?php endif; ?>
<?php 
$id =uri_segment(4);
$class=uri_segment(2);
?>
	<?= $form?>

<div id="hey" value="<?php echo $id;?>"></div>
<?php if($class=="jobs"){ $div_class="a";}else{$div_class="hidden";} ?>
<div id="main" class="<?php  echo $div_class; ?>" >
<div id='Status' style="margin-top:20px;margin-left:5px;">
<?php  
echo "<strong>"."Status History"."</strong>";?>
</br>
<table class="tg" style="margin-top: -30px; margin-left: 140px;">
<tr>
<th class="tg-rd2y">Status</th>                                     
<th class="tg-rd2y">Changed to</th>
<th class="tg-rd2y"> Time  &  Date</th>
</tr>
<?php
echo "</br>";
                         
			


	 
 $this->db->where('job_id',$id);
 $this->db->order_by("id", "desc");
	$query = $this->db->get('fuel_status_history');

foreach ($query->result() as $row)
{
  if(($row->Old_status)!="")
{
	echo "<tr>";
    echo "<th class='tg-rd2y'>".$row->Old_status."</th>";
	echo "<th class='tg-rd2y'>".$row->New_status."</th>";
	echo "<th class='tg-rd2y'>".$row->Updated."</th>";
	echo "</tr>";
	}
}
echo "</table>";
echo  "</br>";  
echo  "</br>";
echo  "</br>";

?>
</div>
</div>
</br>
</br>
</div>
</br>
</br>
</br>