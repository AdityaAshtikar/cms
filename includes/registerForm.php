<div id="registerForm" style="display: none;">
		
		<div class="adminRegisterForm">
			<a class="btn btn-sm btn-info registerAdmin">Register As Faculty: </a><br>
			
			<div id="adminRegister" style="display: none;"><br>
				<form method="post" action="register.php">
					<?php echo $account->getErrors(Constants::$nmLength); ?>
					First Name: <input type="text" name="f_name" class="form-control" placeholder="First Name" required value=<?php echo getValues('f_name'); ?> ><br>
					
					<?php echo $account->getErrors(Constants::$nmLength); ?>
					Last Name: <input type="text" name="l_name" class="form-control" placeholder="Last Name" required value=<?php echo getValues('l_name'); ?> ><br>
					
					<?php echo $account->getErrors(Constants::$nmLength); ?>
					<?php echo $account->getErrors(Constants::$unExists); ?>
					<?php echo $account->getErrors(Constants::$onlyLettersAllowed); ?>
					Username: <input type="text" name="username" class="form-control" placeholder="Username" required value=<?php echo getValues('username'); ?> ><br>
					
					<?php echo $account->getErrors(Constants::$fidExists); ?>
					<span id="idHelp" class="form-text text-muted" style="color: blue;">Provide faculty ID for better experience.</span>
					Faculty ID: <input type="text" name="faculty_id" class="form-control" placeholder="Faculty ID" required value=<?php echo getValues('faculty_id'); ?> ><br>
					
					Department: <select name="dept" class="form-control" required>
						<option>Mech</option>
						<option>CSE</option>
						<option>ET & T</option>
						<option>Civil</option>
					</select><br>

					<?php echo $account->getErrors(Constants::$emLength); ?>
					<?php echo $account->getErrors(Constants::$emExists); ?>
					<span class="form-text text-muted" style="color: blue;">Provide correct email or you won't be able to log in.</span>
					Email: <input type="email" name="email" class="form-control" placeholder="Email" required value=<?php echo getValues('email'); ?> ><br>

					<?php echo $account->getErrors(Constants::$phoneInv); ?>
					Phone: <input type="text" name="phone" maxlength="10" minlength="10" class="form-control" placeholder="Phone Number" required value=<?php echo getValues('phone'); ?> ><br>

					<?php echo $account->getErrors(Constants::$pwDontMatch); ?>
					<?php echo $account->getErrors(Constants::$pwOnlyNumbersOrLetters); ?>
					<?php echo $account->getErrors(Constants::$pw8chars); ?>
					Password: <input type="password" name="password" id="showAdmin" class="form-control" placeholder="Password" required>
					<input type="checkbox" name="show" onclick="showPass()">Show
					<br>
					Confirm Password: <input type="password" name="c_password" class="form-control" placeholder="Confirm Password" required><br>
					<input type="submit" name="registerAdmin" value="Register as Admin" class="btn btn-primary">
				</form>
			</div><!-- adminRegister -->

		</div><!-- adminRegisterForm -->

		<div class="studentRegisterForm">
			<a class="btn btn-sm btn-info registerStudent">Register As Student: </a><br>
			
			<div id="studentRegister" style="display: none;"><br>
				<form method="post" action="register.php">
					<?php echo $account->getErrors(Constants::$nmLength); ?>
					First Name: <input type="text" name="f_name" class="form-control" placeholder="First Name" required value=<?php echo getValues('f_name'); ?> ><br>
					
					<?php echo $account->getErrors(Constants::$nmLength); ?>
					Last Name: <input type="text" name="l_name" class="form-control" placeholder="Last Name" required value=<?php echo getValues('l_name'); ?> ><br>
					
					<?php echo $account->getErrors(Constants::$nmLength); ?>
					<?php echo $account->getErrors(Constants::$unExists); ?>
					<?php echo $account->getErrors(Constants::$onlyLettersAllowed); ?>
					Username: <input type="text" name="username" class="form-control" placeholder="Username" required value=<?php echo getValues('username'); ?> ><br>
					
					Department: <select name="dept" class="form-control" required>
						<option>Mech</option>
						<option>CSE</option>
						<option>ET & T</option>
						<option>Civil</option>
					</select><br>
					<?php echo $account->getErrors(Constants::$emLength); ?>
					<?php echo $account->getErrors(Constants::$emExists); ?>

					<span class="form-text text-muted" style="color: blue;">Provide correct email or you won't be able to log in.</span>
					Email: <input type="email" name="email" class="form-control" placeholder="Email" required value=<?php echo getValues('email'); ?> ><br>

					<?php echo $account->getErrors(Constants::$phoneInv); ?>
					Phone: <input type="text" name="phone" maxlength="10" minlength="10" class="form-control" placeholder="Phone Number" required value=<?php echo getValues('phone'); ?> ><br>

					<?php echo $account->getErrors(Constants::$pwDontMatch); ?>
					<?php echo $account->getErrors(Constants::$pwOnlyNumbersOrLetters); ?>
					<?php echo $account->getErrors(Constants::$pw8chars); ?>
					Password: <input type="password" name="password" id="showStudent" class="form-control" placeholder="Password" required>
					<input type="checkbox" name="show" onclick="showPass()">Show
					<br>
					Confirm Password: <input type="password" name="c_password" class="form-control" placeholder="Confirm Password" required><br>
					<input type="submit" name="registerStudent" value="Register as Student" class="btn btn-primary">
				</form>
			</div><!-- studentRegister -->

		</div><!-- studentRegisterForm -->

	</div><!-- registerForm -->