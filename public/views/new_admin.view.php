<p>Welcome to creating new admin page</p>
<div class="new_admin">
	<form action="new_admin.php" method="POST">
		<ul>
			<li>
				<label for="first_name">First name: </label>
				<input type="text" name="first_name" id="first_name">
			</li>
			<li>
				<label for="last_name">Last name: </label>
				<input type="text" name="last_name" id="last_name">
			</li>
			<li>
				<label for="username">Username: </label>
				<input type="text" name="username" id="username">
			</li>
			<li>
				<label for="password">Password: </label>
				<input type="password" name="password" id="password">
			</li>
			<li>
				<input type="submit" name="submit"  value="submit">
			</li>
		</ul>	
	</form>
</div>
<?php 
	echo message();
	$errors = errors();
	echo form_errors($errors);
	// if ($errors) {
	// 	echo "<p>Please fill up all the fields</p>";
	// }
?>	




		<!-- <form action="manage_admin.php">
			<input  class="bega" type="submit" value="back">
		</form>	 -->