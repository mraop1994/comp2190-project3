<?php include 'p3_validation.php';?>
<!DOCTYPE HTML> 
<html>
  <head>
  <title>MP creation form, Problem 3</title>
  <link rel = "stylesheet" type = "text/css" href = "p3.css"/>
  </head>
<body>

	<form method="post" action="p3_form.php"> 
	<label>First name:</label><br>
	<input class="input" type="text" name="firstname" value="">
	<span class="error"><?php echo $firstnameError;?></span><br><br>

	<label>Last name:</label><br>
	<input class="input" type="text" name="lastname" value="">
	<span class="error"><?php echo $lastnameError;?></span><br><br>

	<label>Constituency:</label><br>
	<input class="input" type="text" name="constituency" value="">
	<span class="error"><?php echo $constituencyError;?></span><br><br>
	
	<label>Email:</label><br>
	<input class="input" type="text" name="email" value="">
	<span class="error"><?php echo $emailError;?></span><br><br>	
	
	<label>Years of Service:</label><br>
	<input class="input" type="text" name="years" value="">
	<span class="error"><?php echo $yearsError;?></span><br><br>
	
	<label>Password:</label><br>
	<input class="input" type="password" name="password1" value="">
	<span class="error"><?php echo $pswError;?></span><br><br>	
	
	<label>Password:</label><br>
	<input class="input" type="password" name="password2" value="">
	<span class="error"><?php echo $pswError;?></span><br><br>		
	
	<input type="hidden" name="pagename" value="6eb6ac241942dc7226aeb"/>
	<input class="submit" type="submit" name="submit" value="Submit">
    <span class="success"><?php echo $successMessage;?></span>
    </form>

</body>
</html>