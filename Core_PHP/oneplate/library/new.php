<div id="slider">
  <a class="control_next">>></a>
  <a class="control_prev"><</a>
  <ul>';
			echo $var;		

foreach($images as $row){
echo "<li><img src='meal_images/$record['meal_id']/$row['meal_image']' style='width: 500px; height: 300px;'></li>";

}

						


	
									
  echo '</ul>  
</div>

<div class="slider_option" style="display:none;">
  <input type="checkbox" id="checkbox" >
  <label for="checkbox">Autoplay Slider</label>
</div> 
</br>