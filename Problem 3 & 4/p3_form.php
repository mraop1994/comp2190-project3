<?php include 'p3_validation.php';?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>MP creation form, Problem 3</title>
		<link rel = "stylesheet" type = "text/css" href = "p3.css"/>
	</head>
	
	<body>
		<!--Creates a form-->
		<form method="post" action="p3_form.php">
			<h1>MP Creation Form</h1>
			
			<input class="input" type="text" name="firstname" placeholder="First Name" value="<?PHP if(isset($firstname)) echo htmlspecialchars($firstname); ?>">
			<span class="error"><?php echo $firstnameError;?></span><br><br>
		
			<input class="input" type="text" name="lastname" placeholder="Last Name" value="<?PHP if(isset($lastname)) echo htmlspecialchars($lastname); ?>">
			<span class="error"><?php echo $lastnameError;?></span><br><br>
			
			<input class="input" type="text" name="constituency" placeholder="Constituency" value="<?PHP if(isset($constituency)) echo htmlspecialchars($constituency); ?>">
			<span class="error"><?php echo $constituencyError;?></span><br><br>
			
			<input class="input" type="text" name="email" placeholder="Email Address" value="<?PHP if(isset($email)) echo htmlspecialchars($email); ?>">
			<span class="error"><?php echo $emailError;?></span><br><br>	
			
			<input class="input" type="text" name="years" placeholder="Years of Service" value="<?PHP if(isset($years)) echo htmlspecialchars($years); ?>">
			<span class="error"><?php echo $yearsError;?></span><br><br>
			
			<input class="input" type="password" name="password1" placeholder="Password" value="<?PHP if(isset($psw)) echo htmlspecialchars($psw); ?>">
			<span class="error"><?php echo $pswError;?></span><br><br>	
			
			<input class="input" type="password" name="password2" placeholder="Confirm Password" value="<?PHP if(isset($psw1)) echo htmlspecialchars($psw1) ; ?>">
			<span class="error"><?php echo $pswError;?></span><br><br>	
			
			<input type="hidden" name="pagename" value="6eb6ac241942dc7226aeb"/>
			<input class="submit" type="submit" name="submit" value="Submit">
		</form>
	</body>
</html>