<div id="loginForm" style="display: none;">
		
		<div class="adminLoginForm">
			<a class="btn btn-sm btn-info loginAdmin">Login As Faculty: </a><br>

			<div id="adminForm" style="display: none;"><br>
				<form name="adminLoginForm" method="post" action="register.php">
					<input type="text" name="username" class="form-control" placeholder="username or Faculty ID" required><br>
					<input type="password" name="password" id="adminPass" class="form-control" placeholder="password" required>
					<span><input type="checkbox" name="show" onclick="showAdminLoginPass()">  Show</span><br>
					<span><input type="checkbox" name="rememberLogin">   Remember me</span><br><br>
					<input type="submit" name="loginAdmin" value="Login as Admin" class="btn btn-primary">
				</form>
			</div><!-- adminForm -->

		</div><!-- adminLoginForm -->

		<div class="studentLoginForm">
			<a class="btn btn-sm btn-info loginStudent">Login As Student: </a><br>

			<div id="studentForm" style="display: none;"><br>
				<form name="studentLoginForm" method="post" action="register.php">
					<input type="text" name="username" class="form-control" placeholder="username" required><br>
					<input type="password" name="password" id="studentPass" class="form-control" placeholder="password" required>
					<span><input type="checkbox" name="show" onclick="showStudentLoginPass()">Show</span><br><br>
					<span><input type="checkbox" name="rememberLogin">   Remember me</span><br><br>
					<input type="submit" name="loginStudent" value="Login as Student" class="btn btn-primary">
				</form>
			</div><!-- studentForm -->

		</div><!-- studentLoginForm -->

	</div><!-- loginForm -->