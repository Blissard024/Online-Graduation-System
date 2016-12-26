<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Convocation Events</a></li>
    <li><a href="#tabs-2">Create Convocation Event</a></li>
    <li><a href="#tabs-3">Delete Convocation Event</a></li>
  </ul>
  <div id="tabs-1">
  	<?php if (mysqli_num_rows($convocations) === 0): ?>
	  	<?php  echo "<p class=\"table-message\">There is no convocation event</p>" ?>
  	<?php else: ?>
  	<table class="view-convocation">
	<thead>
		<tr>
		  <th class="th-name">Convocation Name</th>
		  <th class="th-date">Date</th>
		  <th class="th-start">Start Time</th>
		  <th class="th-end">End Time</th>
		  <th class="th-seat-arrangement">Seat Arrangement</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach ($convocations as $convocation): ?>
			<tr>
			  <td><p><?php echo $convocation["convocation_name"] ?></p></td>
			  <td><p><?php echo $convocation["date"] ?></p></td>
			  <td><p><?php echo $convocation["starting_time"] ?></p></td>
			  <td><p><?php echo $convocation["ending_time"] ?></p></td>
			  <td class="student-profile"><a target="_blank" href="seat_arrangement.php?<?php echo "id={$convocation["convocation_id"]}" ?>">Update</a></td>
			</tr>	
		<?php endforeach ?>
	</tbody>
	</table>
	<?php endif ?>

  </div> 	
  <div id="tabs-2">
  	<div class="add-event-container">
	  	<form action="admin_convocation.php" method="POST">
	  		<ul>
	  			<li>
	  				<label for="convocation_name">Convocation Name: </label>
	  				<input id="convocation_name" name="convocation_name" type="text" value="" >
	  			</li>
	  			<li>
	  				<label for="convocation_date" >Convocation Date: </label>
	  				<input id="convocation_date" name="convocation_date" class="date" type="text" value="01/01/2016" >
	  			</li>
	  			<li>
	  				<label for="convocation_starting_time">Convocation Starting Time: </label>
	  				<input id="convocation_starting_time" name="convocation_starting_time" class="time" type="text" value="09:00 AM" >
	  			</li>
	  			<li>
	  				<label for="convocation_ending_time">Convocation Ending Time: </label>
	  				<input id="convocation_ending_time" name="convocation_ending_time" id="" class="time" type="text" value="12:00 PM" >
	  			</li>
	  			<li>
	  				<label for="ff">Available for Faculties: </label>
	  				<div class="checkbox-container">
		  				<div class="checkbox"><input type="checkbox" name="faculties[]" value="Faculty of Management" checked>Faculty of Management</div>
		  				<div class="checkbox"><input type="checkbox" name="faculties[]" value="Faculty of Engineering" checked>Faculty of Engineering</div>
		  				<div class="checkbox"><input type="checkbox" name="faculties[]" value="Faculty of Computing and Informatics" checked>Faculty of Computing and Informatics</div>
	  				</div>
	  			</li>
	  			<div class="buttonContainer" >
	  				<input type="submit" name="create_event" value="Create Convocation">
	  			</div>
	  		</ul>
	  	</form>

	  	  	<?php 
	  	  			if($tab ==1){
	  	  				echo message();
	  		  			$errors = errors();
	  					echo subject_errors($errors);
	  	  			}
	  		  		
	  		?>
  	</div>


  </div>
  <div id="tabs-3">
	  	<?php if (mysqli_num_rows($convocations) === 0): ?>
	  	<?php  echo "<p class=\"table-message\">There is no convocation event</p>" ?>
  		<?php else: ?>

	  		<form action="admin_convocation.php" method="POST">  	
	  		  	<table class="view-convocation">
	  			<thead>
	  				<tr>
	  				  <th class="th-name">Convocation Name</th>
	  				  <th class="th-date">Date</th>
	  				  <th class="th-start">Start Time</th>
	  				  <th class="th-end">End Time</th>
	  				  <th class="th-seat-arrangement">Delete</th>
	  			</tr>
	  			</thead>
	  			<tbody>
	  				<?php foreach ($convocations as $convocation): ?>
	  					<tr>
	  					  <td><p><?php echo $convocation["convocation_name"] ?></p></td>
	  					  <td><p><?php echo $convocation["date"] ?></p></td>
	  					  <td><p><?php echo $convocation["starting_time"] ?></p></td>
	  					  <td><p><?php echo $convocation["ending_time"] ?></p></td>
	  					  <td><input type="checkbox" name="deletions[]"  value="<?php echo $convocation["convocation_id"] ?>"></td>
	  					</tr>	
	  				<?php endforeach ?>
	  			</tbody>
	  			</table>
	  			<input type="submit" name="delete_convocation"  value="Delete Convocations">
		  </form>
		 
		<?php endif ?>
		<div class="ohoh">
			<?php 
	  		  		if($tab ==2){
	  	  				echo message();
	  		  			$errors = errors();
	  					echo subject_errors($errors);
	  	  			}
	  		?>
		</div>
  </div>


<script type="text/javascript">$( "#tabs" ).tabs({ active: <?php echo $tab ?>});</script>
<script type="text/javascript" src="js/jquery.timepicker.js"></script>
<script type="text/javascript">

   $("input.time").timepicker();
   $( "input.date" ).datepicker();

</script>
 

