<div class="left">
	<table>
		<tr>
			<td class="caption"><p>First Name:</p></td>
			<td><p> <?php echo $student["first_name"] ?></p></td>
		</tr>
		<tr>
			<td class="caption"><p>Last Name:</p></td>
			<td><p> <?php echo $student["last_name"] ?></p></td>
		</tr>
		<tr>
			<td class="caption"><p>Student ID:</p></td>
			<td ><p> <?php echo $student["student_id"] ?></p></td>
		</tr>
		<tr>
			<td class="caption"><p>Contact Number:</p></td>
			<td><p> <?php echo $student["contact_number"] ?></p></td>
		</tr>
		<tr>
			<td class="caption"><p>Email Address:</p></td>
			<td><p> <?php echo $student["email_address"] ?></p></td>
		</tr>

		<tr>
			<td class="caption"><p>Mail Address:</p></td>
			<td><p> <?php echo $student["mail_address"] ?></p></td>
		</tr>

	</table>
</div>
<div class="left">
	<table>
		<tr>
			<td class="caption"><p>Faculty</p></td>
			<td><p> <?php echo $student["faculty"] ?></p></td>
		</tr>
		
		<tr>
			<td class="caption"><p>Status:</p></td>
			<td><p> <?php echo $student["status"] ?></p></td>
		</tr>
		<tr>
			<td class="caption"><p>CGPA:</p></td>
			<td><p> <?php echo $student["cgpa"] ?></p></td>
		</tr>
		<tr>
			<td class="caption"><p class="caption">Ticket Number:</p></td>
			<td ><p> <?php echo $student["ticket_id"] ?></p></td>
		</tr>
		<tr>
			<td class="caption"><p>Course:</p></td>
			<td><p> <?php echo get_courseName($student["course_code"],$conn) ?></p></td>
		</tr>
	</table>

	<form action="update_student_profile.php?id=<?php echo $student["student_id"] ?>" method="POST">
	  <button type="submit" name="Update">Update Profile</button>
	</form>
		<form action="update_academic_records.php?id=<?php echo $student["student_id"] ?>" method="POST">
	  <button type="submit" name="Academic">Academic Records</button>
	</form>
</div>