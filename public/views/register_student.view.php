<div class="register-student">
	<form action="#" method="POST">
		<div class="list">
			<ul>
				<li>
					<label for="first_name">First Name: </label>
					<input type="text" name="first_name" id="first_name">
				</li>
				<li>
					<label for="last_name">Last Name: </label>
					<input type="text" name="last_name" id="last_name">
				</li>
				<li>
					<label for="faculty">Faculty: </label>
					<select type="select" name="faculty" id="faculty">
						<option class="option" value="Faculty of Management" selected>Faculty of Management</option>
						<option class="option" value="Faculty of Computing and Informatics" >Faculty of Computing and Informatics</option>
						<option class="option" value="Faculty of Engineering" >Faculty of Engineering</option>
					</select>
				</li>
				<li>
					<label for="course_code">Course: </label>
					<select type="select" name="course_code" id="course_code">
						<option class="option" value="FOM_AE15" selected>Bachelor of Economics - Analytical Economics</option>
						<option class="option" value="FCI_SE15" >Bachelor of Computer Science - Software Engineering</option>
						<option class="option" value="FOE_CE15" >Bachelor of Electronics - Electronics Majoring in Computer</option>
					</select>	
				</li>
				<li>
					<label for="student_id">Student ID: </label>
					<input type="text" name="student_id" id="student_id">
				</li>
				<li>
					<label for="password">Password: </label>
					<input type="password" name="password" id="password">
				</li>
				<li>
				<input type="submit" name="submit"  value="Register">
				<?php 
					echo message();
					if (isset($_SESSION["message2"])) {
						echo $_SESSION["message2"]; 
						$_SESSION["message2"] = "";
					}

					$errors = errors();
					echo form_errors($errors);
			 	?>	
				</li>
			</ul>
					</div>
		<div class="list">
			<ul>
				<li>
					<label for="contact_number">Contact Number: </label>
					<input type="text" name="contact_number" id="contact_number">
				</li>
				<li>
					<label for="email">Email Address: </label>
					<input type="text" name="email" id="email">
				</li>
				<li>
					<label for="mail_address">Mail Address: </label>
					<!-- <input type="textarea" name="mail_address" id="mail_address"> -->
					<textarea name="mail_address" id="mail_address"></textarea>
				</li>
				<li>
				</li>
			</ul>	
		</div>
	</form>
</div>


	
