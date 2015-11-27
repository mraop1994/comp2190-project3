<?php include 'p4_validation.php';?>
<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" type = "text/css" href = "p4.css"/>
		<title>MP Login Page, Problem 4</title>
	</head>
	
	<body>
		<!--Creates a form-->
		<form method="post" action="p4_login.php">
			<h1>Login</h1>
			
			<input class="input" type="text" name="email" placeholder="Email Address" value="<?PHP if(isset($email)) echo htmlspecialchars($email); ?>">
			<span class="error"><?php echo $emailError;?></span><br><br>
			
			<input class="input" type="password" placeholder="Password" name="password" value="<?PHP if(isset($psw)) echo htmlspecialchars($psw); ?>">
			<span class="error"><?php echo $pswError;?></span><br><br>
			
			<div id="rem-reg">
				<label><input type="checkbox" name="remember" value="remember" id="remember" /><span id="remember-text">Remember me</span></label>
				<span id="not-reg"><a href="p3_form.php">Not yet registered?</a></span>
			</div>
			
			<input type="hidden" name="pagename" value="6eb6ac241942dc7226aeb"/>
			<input class="login" type="submit" name="login" value="Login">
		</form>
	</body>
</html>