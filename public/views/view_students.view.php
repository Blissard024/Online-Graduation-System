<div class="view-students">
	<!-- search bar -->
	<form action="view_students.php" method="GET" class="searchform cf">
	  <input type="text" name="input" placeholder="Search for a student">
	  <select type="select" name="option" id="option">
			<option class="option" value="id" >Search By ID</option>
			<option class="option" value="name" <?php if ($_GET["option"] === "name") echo "selected"; ?> >Search By Name</option>
	  </select>
	  <button type="submit" name="search">Search</button>
	</form>

	<!-- results -->
	<table class="view-students-table">
	<thead>
		<tr>
		  <th class="th-name">Name</th>
		  <th class="th-id">ID</th>
		  <th class="th-status">Status</th>
		  <th class="th-course">Course Code</th>
		  <th>Profile</th>
	</tr>
	</thead>
	<tbody>
		<?php foreach ($students as $student): ?>
			<tr>
			  <td><p><?php echo "{$student["first_name"]} {$student["last_name"]} " ?></p></td>
			  <td><p><?php echo $student["student_id"] ?></p></td>
			  <td><p><?php echo $student["status"] ?></p></td>
			  <td><p><?php echo $student["course_code"] ?></p></td>
  			  <?php if ($student["status"] === "Applied for Graduation"): ?>
			  	<td class="student-profile"><a href="view_student_profile.php?id=<?php echo $student["student_id"] ?>"><img class="profile-img" src="img/StudentProfile-red.png"></a></td>
  			  <?php else: ?>
			  	<td class="student-profile"><a href="view_student_profile.php?id=<?php echo $student["student_id"] ?>"><img class="profile-img" src="img/StudentProfile.png"></a></td>	
			  <?php endif ?>



			</tr>	
		<?php endforeach ?>
	</tbody>
	</table>

</div>