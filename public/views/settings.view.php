<?php 
			  		echo message();
			  		$errors = errors();
					echo subject_errors($errors);
?>

<div class="setting-form">
	<form action="settings.php" method="POST">
		<ul>
			<li>
				<label>Convocation Ticket Price: </label>
				<input name="ticket_price" type="text" value="<?php echo $settings["ticket_price"] ?>"> RM
			</li>
			<li>
				<label>Certification Postage Cost: </label>
				<input name="postage_cost" type="text" value="<?php echo $settings["postage_cost"] ?>"> RM
			</li>
			<li>
				<label>Eligibility Notification Email: </label><br>
				<textarea name="eligibility_notification_email"><?php echo $settings["autogen_email_content"]?></textarea>
			</li>
			<li>
				<input name="update_settings" type="submit" value="update">
			</li>
		</ul>
	</form>
</div>

