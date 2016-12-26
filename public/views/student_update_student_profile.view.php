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
					<label for="contact_number">Contact Number: </label>
					<input type="text" name="contact_number" id="contact_number" value="<?php echo $student["contact_number"] ?>">
				</li>
				<li>
					<label for="email_address">Email Address: </label>
					<input type="text" name="email_address" id="email_address" value="<?php echo $student["email_address"] ?>">
				</li>
				<li>
					<label for="mail_address">Mail Address: </label>
					<!-- <input type="textarea" name="mail_address" id="mail_address"> -->
					<textarea name="mail_address" id="mail_address"><?php echo $student["mail_address"] ?></textarea>
				</li>
				<li>
					<input type="submit" name="submit"  value="Update Profile">
	</form>

					<form action="student_profile.php?id=<?php echo $student["student_id"] ?>" method="POST">
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


	
