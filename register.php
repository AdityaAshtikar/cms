<?php	
	include("includes/config.php");
	if (isset($_COOKIE['cookieToken'])) {
		$cookieToken = $_COOKIE['cookieToken'];
		$getCookie = mysqli_query($con, "SELECT cookieToken, isVerified, username FROM users WHERE cookieToken='$cookieToken'");
		if (mysqli_num_rows($getCookie) >0) {
			$row = mysqli_fetch_array($getCookie);
			$cookie = $row['cookieToken'];
			$username = $row['username'];
			$isVerified = $row['isVerified'];
			$_SESSION['username'] = $username;
			$_SESSION['mail'] = $isVerified;
			header("Location: index.php");
			die();
		} else {
			echo "Cookie not found in db";
		}
	}

	if (isset($_GET['deleted'])) {
		if (strcmp($_GET['deleted'], "true") == 0) {
	?>
			<div class="alert alert-info alert-dismissible" id="errorDiv">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Account Deleted</strong>
			</div>
	<?php
		}
	}

	include("classes/Constants.php");
	include("classes/Account.php");
	$account = new Account($con);
	$title = "Register";
	$cssStyle = "assets/css/register.css";
	include("includes/header.php");
	include("handlers/registerHandler.php");
	include("handlers/loginHandler.php");

	if(checkSession('username')) {
		header("Location: index.php");
		die();
	}

	if (isset($_GET['login'])) {
		if(strcmp($_GET['login'], 'inv')==0) {
?>
			<div class="alert alert-danger alert-dismissible" id="errorDiv">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Login or Register First!</strong>
			</div>
<?php
		}
	}

	if (isset($_GET['loginDetails'])) {
		if (strcmp($_GET['loginDetails'], "inv")==0) {
?>
			<div class="alert alert-danger alert-dismissible" id="errorDiv">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Invalid Login Details, Check your Form</strong>
			</div>
<?php
		}
	}

	if (isset($_GET['mail'])) {
		if (strcmp($_GET['mail'], "notSent")==0) {
?>
			<div class="alert alert-danger alert-dismissible" id="errorDiv">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Email could not be sent, please try again..</strong>
			</div>
<?php
		}
	}

	function getValues($string) {
		if (isset($_POST[$string])) {
			return $_POST[$string];
		}
	}
?>

<script>
	$(document).ready(function() {

		/* if login is clicked */
		$("#clickLogin").on("click", function() {
			$("#loginForm").toggle();
			$("#registerForm").hide();
		});

		$(".loginAdmin").on("click", function() {
			$("#adminForm").toggle();
			$("#studentForm").hide();
		});

		$(".loginStudent").on("click", function() {
			$("#studentForm").toggle();
			$("#adminForm").hide();
		});

		/* if register is clicked */	
		$("#clickRegister").on("click", function() {
			$("#registerForm").toggle();
			$("#loginForm").hide();
		});

		$(".registerAdmin").on("click", function() {
			$("#adminRegister").toggle();
			$("#studentRegister").hide();
		});

		$(".registerStudent").on("click", function() {
			$("#studentRegister").toggle();
			$("#adminRegister").hide();
		});
	});

/*	function checkEmptyInput() {
		var k = document.getElementsByTagName("input");
		if (input.value == "") {

		}
	}*/

	function showPass() {
		var x = document.getElementById('showAdmin');
		if (x.type == "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}

		var y = document.getElementById('showStudent');
		if (y.type == "password") {
			y.type = "text";
		} else {
			y.type = "password";
		}
	}

	function showAdminLoginPass() {
		var p = document.getElementById("adminPass");
		if (p.type == "password") {
			p.type = "text";
		} else {
			p.type = "password";
		}
	}

	function showStudentLoginPass() {
		var q = document.getElementById("studentPass");
		if (q.type == "password") {
			q.type = "text";
		} else {
			q.type = "password";
		}
	}

</script>
<!-- everything for registration and login form -->
<div id="mainContainer">
	<div id="loginContainer">
		<button id="clickLogin" class="btn">Login</button>
		<?php include("includes/loginForm.php"); ?>
	</div><!-- loginContainer -->
	<div id="registerContainer">
		<button id="clickRegister" class="btn">Register</button>
		<?php include("includes/registerForm.php"); ?>
	</div><!-- registerContainer -->
	<br>
	<div class="container-fluid">
		
	</div><!-- container-fluid -->
</div><!-- mainContainer -->
<?php include("includes/footer.php"); ?>