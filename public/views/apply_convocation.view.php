<?php if ($student["status"] === "Approved"): ?>

	<!-- step 0 -->
	<?php if ( $_SESSION["step"] == 0): ?>
		<div class="convocation-form">
		<form action="apply_convocation.php?id=<?php echo $student["student_id"] ?>" method="post">
			<ul>
				<li>
					<input type="radio" name="option" value="attend_convo">
					<label>I want to attend the convocation and recieve my graduation certificate.</label>
				</li>
				<li>
					<input type="radio" name="option" value="post_certificate">
					<label>I would rather university send my certificate to my mailing address. </label>
				</li>
				<input type="submit" name="step1" value="Next">
			</ul>
		</form>
	</div>
	<?php endif ?>
	
	<!-- step 1 -->
	<?php if ($_SESSION["step"] === 1): ?>
		 <?php if (count($convocations) === 0): ?> 
	  		<?php echo "<p class=\"table-message\">No convocation event is available right now.</p>" ?>
	  		<?php $_SESSION["step"] = 0 ?>
  		<?php else: ?>
		<h1>Step1: Select your own convocation and book your seats.</h1>

	  		<form action="apply_convocation.php?id=<?php echo $student["student_id"] ?>" method="POST">  	
	  		  	<table class="view-convocation">
	  			<thead>
	  				<tr>
	  				  <th class="th-name">Convocation Name</th>
	  				  <th class="th-date">Date</th>
	  				  <th class="th-start">Start Time</th>
	  				  <th class="th-end">End Time</th>
	  				  <th class="th-seat-arrangement">Select</th>
	  			</tr>
	  			</thead>
	  			<tbody>
	  				<?php foreach ($convocations as $convocation): ?>
	  					<tr>
	  					  <td><p><?php echo $convocation["convocation_name"] ?></p></td>
	  					  <td><p><?php echo $convocation["date"] ?></p></td>
	  					  <td><p><?php echo $convocation["starting_time"] ?></p></td>
	  					  <td><p><?php echo $convocation["ending_time"] ?></p></td>
	  					  <td><input type="radio" name="convocation"  value="<?php echo $convocation["convocation_id"] ?>"></td>
	  					</tr>
	  				<?php endforeach ?>
	  			</tbody>
	  			</table>

	  			<div class="paymentButtons">
					<input id="buttonSave" class="paymentButton" name="cancelConvocation" type="submit" value="Cancel">
	  				<input type="submit" class="paymentButton" name="book_seats"  value="Book Seats">
					<P class="errortext"><?php if(isset($_SESSION{"error"})) echo $_SESSION["error"]; unset($_SESSION["error"]); ?></P>
	  			</div>
	  			

		  </form>
		<?php endif ?>
	<?php endif ?>


		<!-- step 2 -->
	<?php if ($_SESSION["step"] === 2): ?>
		<h1>Step 2: Choose your desired graduation gown size</h1>

		<div class="grad-container">
			<div class="grad-form">
				<form action="" method="POST"> 
					<label class="label-gown">Gown Size: </label>
					<select type="select" name="gown_size" id="course_code">
							<option class="option" value="36" selected>36</option>
							<option class="option" value="39" >39</option>
							<option class="option" value="42" >42</option>
							<option class="option" value="45" >45</option>
							<option class="option" value="48" >48</option>
							<option class="option" value="51" >51</option>
							<option class="option" value="54" >54</option>
							<option class="option" value="57" >57</option>
							<option class="option" value="60" >60</option>
					</select>
					<input type="submit" name="cancelConvocation" value="Cancel">
					<input type="submit" name="payment" value="Next">
				</form>
			</div>
			<img class="gradGown" src="img/gradGown4.png">
			<img class="gradSize" src="img/gownSize3.png">

		</div>
		
	<?php endif ?>

	<?php if ($_SESSION["step"] === 3): ?>
	<?php $thisConvo = get_convocation($_SESSION["convocation_id"],$conn); ?>
		<h1>Step 3: Please review your ticket and make the payment to finish booking.</h1>
		<div class="ticket">
			<h2 class="title">Convocation Ceremony Ticket</h2>
			<div class="ticket-column first">
				<span class="ticket-row"><p class="caption">Student Name:</p><p class="info"><?php echo $student["first_name"] . " " . $student["last_name"] ?></p></span>
				<span class="ticket-row"><p class="caption">Student ID:</p><p class="info"><?php echo $student["student_id"] ?></p></span>
				<span class="ticket-row"><p class="caption">Convocation:</p><p class="info"><?php  echo $_SESSION["convocation_name"] ?></p></span>
			</div>
			<div class="ticket-column">
				<span class="ticket-row"></span>
				<span class="ticket-row"><p class="caption">Date:</p><p class="info"><?php echo $thisConvo["date"] ?></p></span>
				<span class="ticket-row"><p class="caption">Starting Time:</p><p class="info"><?php echo $thisConvo["starting_time"] ?></p></span>
				<span class="ticket-row"><p class="caption">Ending Time:</p><p class="info"><?php echo $thisConvo["ending_time"] ?></p></span>
			</div>
			<div class="ticket-column">
				<span class="ticket-row"><p class="caption">First Seat:</p><p class="info"><?php echo $_SESSION["firstSeat"] ?></p></span>
				<span class="ticket-row"><p class="caption">Second Seat:</p><p class="info"><?php echo $_SESSION["secondSeat"] ?></p></span>
				<span class="ticket-row"><p class="caption">Robe Size:</p><p class="info"><?php echo $_SESSION["gown_size"] ?></p></span>
			</div>
		</div>
		<div class="payment-form">
			<form action="apply_convocation.php?id=<?php echo $student["student_id"] ?>" method="post">
				<ul>
					<li>
						<label>Ticket Price: </label>        
					    <label><?php echo $settings["ticket_price"] ?> RM</label>
					</li>
					<li>
						<label>Select credit card:</label>        
					    <select  name="CardType" >
					      <option value="MasterCard">MasterCard</option>
					      <option value="American Express">American Express</option>
					      <option value="Visa">Visa</option>
					     
					    </select>
					</li>
					<li>
						<label>Credit Card Number: </label>
						<input type="text" name="CardNumber" maxlength="24" size="24" /> 
					</li>
				</ul>   
		</div>
		<div class="paymentButtons">
			<input id="buttonSave" class="paymentButton" name="cancelConvocation" type="submit" value="Cancel">

			<input id="buttonSave" class="paymentButton" name="makePayment" type="submit" value="Make Payment">
			<P class="errortext"><?php echo $errortext ?></P>
			</form>

		</div>
<?php endif ?>

<?php if ($_SESSION["step"] === 4): ?>
	
		<h1>Step 1: Please review your personal information. Your certificate will be mailed to the mailing address provided. </h1>
		<div class="register-student">
	<form action="apply_convocation.php?id=<?php echo $student["student_id"] ?>" method="POST">
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
					<div class="myButtons">
						<input class="b" type="submit" name="nextStep"  value="Next">
						<input class="b" type="submit" name="update_profile"  value="Update Profile">
		</form>

						<form  action="apply_convocation.php?id=<?php echo $student["student_id"] ?>" method="POST">
		  					<input class="b" name="cancelConvocation" type="submit" value="Cancel" />
		 				 </form>
	 				 </div>	
				</li>
			</ul>
		</div>
</div>
<?php 
		echo message();
		$errors = errors();
		echo form_errors($errors);
?>
<?php endif ?>

<?php if ($_SESSION["step"] === 5): ?>
	
		<h1>Step 2: Please make payment to finish the applying for convocation process. </h1>
		<div class="payment-form">
			<form action="apply_convocation.php?id=<?php echo $student["student_id"] ?>" method="post">
				<ul>
					<li>
						<label>Postage Cost: </label>        
					    <label><?php echo $settings["postage_cost"] ?> RM</label>
					</li>
					<li>
						<label>Select credit card:</label>        
					    <select  name="CardType" >
					      <option value="MasterCard">MasterCard</option>
					      <option value="American Express">American Express</option>
					      <option value="Visa">Visa</option>
					    </select>
					</li>
					<li>
						<label>Credit Card Number: </label>
						<input type="text" name="CardNumber" maxlength="24" size="24" /> 
					</li>
				</ul>   
		</div>
		<div class="paymentButtons">
			<input id="buttonSave" class="paymentButton" name="cancelConvocation" type="submit" value="Cancel">

			<input id="buttonSave" class="paymentButton" name="makePaymentForPostage" type="submit" value="Make Payment">
			<P class="errortext"><?php echo $errortext ?></P>
			</form>

		</div>

<?php endif ?>

<?php elseif ($student["status"] === "Graduated"): ?>
	<?php if ($student["ticket_id"] != -1 ): ?>
		<?php $ticket = get_ticket($student["ticket_id"],$conn); ?>
		<?php if(!$ticket) die("Student is graduated but has no ticket information") ?>
		<?php $thisConvo = get_convocation($ticket["convocation_id"],$conn); ?>
		<p class="convo-message">Congratulations. This is your convocation ticket.</p>
		<div class="ticket">
				<h2 class="title">Convocation Ceremony Ticket</h2>
				<div class="ticket-column first">
					<span class="ticket-row"><p class="caption">Student Name:</p><p class="info"><?php echo $student["first_name"] . " " . $student["last_name"] ?></p></span>
					<span class="ticket-row"><p class="caption">Student ID:</p><p class="info"><?php echo $student["student_id"] ?></p></span>
					<span class="ticket-row"><p class="caption">Convocation:</p><p class="info"><?php  echo $thisConvo["convocation_name"] ?></p></span>
				</div>
				<div class="ticket-column">
					<span class="ticket-row"></span>
					<span class="ticket-row"><p class="caption">Date:</p><p class="info"><?php echo $thisConvo["date"] ?></p></span>
					<span class="ticket-row"><p class="caption">Starting Time:</p><p class="info"><?php echo $thisConvo["starting_time"] ?></p></span>
					<span class="ticket-row"><p class="caption">Ending Time:</p><p class="info"><?php echo $thisConvo["ending_time"] ?></p></span>
				</div>
				<div class="ticket-column">
					<span class="ticket-row"><p class="caption">First Seat:</p><p class="info"><?php echo $ticket["first_seat_number"] ?></p></span>
					<span class="ticket-row"><p class="caption">Second Seat:</p><p class="info"><?php echo $ticket["second_seat_number"] ?></p></span>
					<span class="ticket-row"><p class="caption">Robe Size:</p><p class="info"><?php echo $ticket["robe_size"] ?></p></span>
				</div>
			</div>

	<?php elseif ($student["ticket_id"] == -1 ): ?>
		<p class="convo-message">Thanks for applying for convocation. Your certificate will be sent to you soon. </p>


	<?php endif ?>
	
<?php else: ?>
	<p class="convo-message">Sorry. You are not yet eligible to apply for convocation.</p>
<?php endif ?>