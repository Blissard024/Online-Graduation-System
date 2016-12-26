<div class="register-student">
	<form action="#" method="POST">
		<div class="list">
			<ul>
				<li>
					<label for="first_name">First Name: </label>
					<input type="text" name="first_name" id="first_name" value="<?php echo $student["first_name"] ?>">
				</li>
				<li>
					<label for="last_name">Last Name: </label>
					<input type="text" name="last_name" id="last_name" value="<?php echo $student["last_name"] ?>">
				</li>
				<li>
					<label for="faculty">Faculty: </label>
					<select type="select" name="faculty" id="faculty">
						<option class="option" value="Faculty of Management" <?php if ($student["faculty"] === "Faculty of Management") echo "selected" ?>>Faculty of Management</option>
						<option class="option" value="Faculty of Computing and Informatics" <?php if ($student["faculty"] === "Faculty of Computing and Informatics") echo "selected" ?>>Faculty of Computing and Informatics</option>
						<option class="option" value="Faculty of Engineering" <?php if ($student["faculty"] === "Faculty of Engineering") echo "selected" ?>>Faculty of Engineering</option>
					</select>
				</li>
				<li>
					<label for="course_code">Course: </label>
					<select type="select" name="course_code" id="course_code">
						<option class="option" value="FOM_AE15" <?php if ($student["course_code"] === "FOM_AE15") echo "selected" ?>>Bachelor of Economics - Analytical Economics</option>
						<option class="option" value="FCI_SE15" <?php if ($student["course_code"] === "FCI_SE15") echo "selected" ?>>Bachelor of Computer Science - Software Engineering</option>
						<option class="option" value="FOE_CE15" <?php if ($student["course_code"] === "FOE_CE15") echo "selected" ?>>Bachelor of Electronics - Electronics Majoring in Computer</option>
					</select>	
				</li>
				<li>
					<label for="student_id">Student ID: </label>
					<input type="text" name="student_id" id="student_id" value="<?php echo $student["student_id"] ?>">
				</li>
				<li>
					<label for="status">Status: </label>
					<select type="select" name="status" id="status">
						<option class="option" value="Active" <?php if ($student["status"] === "Active") echo "selected" ?>>Active</option>
						<option class="option" value="Eligible for Graduation" <?php if ($student["status"] === "Eligible for Graduation") echo "selected" ?>>Eligible for Graduation</option>
						<option class="option" value="Applied for Graduation" <?php if ($student["status"] === "Applied for Graduation") echo "selected" ?>>Applied for Graduation</option>
						<option class="option" value="Approved" <?php if ($student["status"] === "Approved") echo "selected" ?>>Approved</option>
						<option class="option" value="Graduated" <?php if ($student["status"] === "Graduated") echo "selected" ?>>Graduated</option>
					</select>
				</li>
				<li>
					<label for="ticket_id">Ticket Number: </label>
					<input type="text" name="ticket_id" id="ticket_id" value="<?php echo $student["ticket_id"] ?>">
				</li>
			</ul>
					</div>
		<div class="list">
			<ul>
				<li>
					<label for="contact_number">Contact Number: </label>
					<input type="text" name="contact_number" id="contact_number" value="<?php echo $student["contact_number"] ?>">
				</li>
				<li>
					<label for="email">Email Address: </label>
					<input type="text" name="email" id="email" value="<?php echo $student["email_address"] ?>">
				</li>
				<li>
					<label for="mail_address">Mail Address: </label>
					<!-- <input type="textarea" name="mail_address" id="mail_address"> -->
					<textarea name="mail_address" id="mail_address"><?php echo $student["mail_address"] ?></textarea>
				</li>
				<li>
					<input type="submit" name="submit"  value="Update Profile">
	</form>

					<form action="view_student_profile.php?id=<?php echo $student["student_id"] ?>" method="POST">
	  					<input type="submit" value="Back" />
	 				 </form>
					<?php 
						echo message();
						$errors = errors();
						echo form_errors($errors);
				 	?>	
				</li>
			</ul>	
		</div>
</div>


	
