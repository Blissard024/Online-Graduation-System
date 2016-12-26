
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Academic Records</a></li>
    <li><a href="#tabs-4">Check Eligibility for Graduation</a></li>
    
    <li><a href="#tabs-2">Add Subject</a></li>
    <li><a href="#tabs-3">Remove Subject</a></li>
  </ul>
  <div id="tabs-1">

		  	<?php 
			  		echo message();
			  		$errors = errors();
					echo subject_errors($errors);
			?>
  	<div class="academic-info">
  		<table class="info-table">
			<tr>
				<td class="caption"><p>Faculty:</p></td>
				<td><p> <?php echo $student["faculty"] ?></p></td>
			</tr>
			<tr>
				<td class="caption"><p>Course:</p></td>
				<td><p> <?php echo get_courseName($student["course_code"],$conn)?></p></td>
			</tr>
		</table>
		<table class="info-table">
			<tr>
				<td class="caption"><p>CGPA:</p></td>
				<td><p> <?php echo $student["cgpa"] ?></p></td>
			</tr>
			<tr>
				<td class="caption"><p>Status:</p></td>
				<td><p> <?php echo $student["status"] ?></p></td>
			</tr>
			<tr>
				<td class="caption"><p>Earned Credit Hours:</p></td>
				<td><p> <?php echo (($passed_credits) ? $passed_credits : "0") ?></p></td>
			</tr>
			<tr>
				<td class="caption"><p>Remaining Credit Hours:</p></td>
				<td><p> <?php echo (($remaining_credits) ? $remaining_credits : "0") ?></p></td>
			</tr>
		</table>
  	</div>
  	<?php if (mysqli_num_rows($registered_subjects) === 0): ?>
	  		<div class="message ">
	  			<p>No subject is taken.</p>
	  		</div>
	  		<div class="form-errors ">
	  		</div>
	 <?php else: ?>
  	<p class="table-title">Registered Subjects</h1>
    <table class="subjects-table">
					<thead>
						<tr>
						  <th class="th-subject-name">Subject Name</th>
						  <th class="th-course-code">Subject Code</th>
						  <th class="th-credit-hours">Credit Hours</th>
						  <th class="th-mark">Mark</th>
					</thead>
					<tbody>
						<?php foreach ($registered_subjects as $subject): ?>
							<tr>
								  <td><p><?php echo $subject["subject_name"] ?></p></td>
								  <td><p><?php echo $subject["subject_code"] ?></p></td>
								  <td><p><?php echo $subject["credit_hours"] ?></p></td>
								  <td><p><?php echo mark_to_grade($subject["mark"]) ?></p></td>
							</tr>	
		  				<?php endforeach ?>
					</tbody>			
			</table>
	  <?php endif ?>
	  <form action="view_student_profile.php?id=<?php echo $student["student_id"] ?>" method="POST">
	  	<input type="submit" value="Back to Profile" />
	  </form>

  </div>
  <!--  add subject -->
  <div id="tabs-2">
  		<?php if (mysqli_num_rows($remaining_subjects) === 0): ?>
	  			<div class="message"><p>All subjects are taken ...</p></div>
	  			<div class="form-errors ">
	  		</div>
		 <?php else: ?>
	  	<form action="update_academic_records.php?id=<?php echo $student["student_id"] ?>" method="POST">
		  	<table class="subjects-table">
					<thead>
						<tr>
						  <th class="th-subject-name">Subject Name</th>
						  <th class="th-course-code">Subject Code</th>
						  <th class="th-credit-hours">Credit Hours</th>
						  <th class="th-mark">Mark</th>
						  <th class="th-checkbox">Add</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($remaining_subjects as $subject): ?>
							<tr>
								  <td><p><?php echo $subject["subject_name"] ?></p></td>
								  <td><p><?php echo $subject["subject_code"] ?></p></td>
								  <td><p><?php echo $subject["credit_hours"] ?></p></td>
								  <td class="td-mark"><input type="text"  name="marks[<?php echo $subject["subject_code"] ?>]" ></td>
								  <td><input type="checkbox" name="subject_codes[]"  value="<?php echo $subject["subject_code"] ?>"></td>
							</tr>	
		  				<?php endforeach ?>
					</tbody>			
			</table>
			<input type="submit" name="add_subject"  value="Add Subjects">
	  </form>
	  <?php endif ?>
  </div>
  <div id="tabs-3">
	  		<?php if (mysqli_num_rows($registered_subjects) === 0): ?>
	  			<div class="message"><p>No subject is taken.</p></div>
	  			<div class="form-errors ">
	  		</div>
	  		<?php else: ?>
		  		<form action="update_academic_records.php?id=<?php echo $student["student_id"] ?>" method="POST">
			  	<table class="subjects-table">
						<thead>
							<tr>
							  <th class="th-subject-name">Subject Name</th>
							  <th class="th-course-code">Subject Code</th>
							  <th class="th-credit-hours">Credit Hours</th>
							  <th class="th-mark">Mark</th>
							  <th class="th-checkbox">Delete</th>
						</tr>
						</thead>
						<tbody>
							<?php foreach ($registered_subjects as $subject): ?>
								<tr>
									  <td><p><?php echo $subject["subject_name"] ?></p></td>
									  <td><p><?php echo $subject["subject_code"] ?></p></td>
									  <td><p><?php echo $subject["credit_hours"] ?></p></td>
									  <td><p><?php echo $subject["mark"] ?></p></td>
									  <td><input type="checkbox" name="subject_codes[]"  value="<?php echo $subject["subject_code"] ?>"></td>
								</tr>	
			  				<?php endforeach ?>
						</tbody>			
				</table>
				<input type="submit" name="delete_subject"  value="Remove Subjects">
	  </form>
	  			
	  		<?php endif ?>
  </div>
  <div id="tabs-4">
  		<br>
  		<?php if ($student["status"] === "Active"): ?>
  			<p class="table-title"> Student is not eligible to graduate.</p>		
  		<?php else: ?>
  			<p class="table-title">Student is eligible to graduate.</p>
  		<?php endif ?>
  		<br><br>
  		<?php if (mysqli_num_rows($failed_subjects) !== 0): ?>
	  		<p class="table-title">Student needs to acheive grade of C or higher for following subjects: </p>
			  	<table class="subjects-table">
						<thead>
							<tr>
							  <th class="th-subject-name">Subject Name</th>
							  <th class="th-course-code">Subject Code</th>
							  <th class="th-credit-hours">Credit Hours</th>
							  <th class="th-mark">Grade</th>
						</tr>
						</thead>
						<tbody>
							<?php foreach ($failed_subjects as $subject): ?>
								<tr>
									  <td><p><?php echo $subject["subject_name"] ?></p></td>
									  <td><p><?php echo $subject["subject_code"] ?></p></td>
									  <td><p><?php echo $subject["credit_hours"] ?></p></td>
									  <td><p><?php echo mark_to_grade($subject["mark"]) ?></p></td>
								</tr>	
			  				<?php endforeach ?>
						</tbody>			
				</table>
				<br><br>
  		<?php endif ?>
  		<?php if (mysqli_num_rows($remaining_subjects) !== 0): ?>
			<p class="table-title">Student needs to pass the following subjects: </p>
		  	<table class="subjects-table">
					<thead>
						<tr>
						  <th class="th-subject-name">Subject Name</th>
						  <th class="th-course-code">Subject Code</th>
						  <th class="th-credit-hours">Credit Hours</th>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($remaining_subjects as $subject): ?>
							<tr>
								  <td><p><?php echo $subject["subject_name"] ?></p></td>
								  <td><p><?php echo $subject["subject_code"] ?></p></td>
								  <td><p><?php echo $subject["credit_hours"] ?></p></td>
							</tr>	
		  				<?php endforeach ?>
					</tbody>			
			</table>
		<?php endif ?>
  </div>

</div>
 	<script>
  $(function() {
    $( "#tabs" ).tabs({
  active: 0
});
  });
  </script>

