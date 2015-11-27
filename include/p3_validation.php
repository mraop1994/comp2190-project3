<?php
    // Stores each field data from the form to a variable
    $firstname = to_store($_POST["firstname"]);
    $lastname = to_store($_POST["lastname"]);
    $constituency = to_store($_POST["constituency"]);
    $email = to_store($_POST["email"]);
    $years = to_store($_POST["years"]);
    $psw = to_store($_POST["password1"]);
    $psw1 = to_store($_POST["password2"]);
    
    // Assign values for database access
    $servername = "localhost";
    $username = "comp2190SA";
    $password = "2015Sem1";
    $dbname = "MPMgmtDB";
    
    // Creates function to retrieve data from the form
    function to_store($input) {
       $input = trim($input);
       $input = stripslashes($input);
       $input = htmlspecialchars($input);
       return $input;
    }
    
    try {
        // Connection to database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Begins validation upon clicking Submit in the form
        if(isset($_POST['submit'])){
            // Checks firstname field for the legal characters
            if (empty($_POST["firstname"])) {
                $firstnameError = "First name is required";
            } else {
                $firstname = to_store($_POST["firstname"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
                    $firstnameError = "Only letters, spaces and hypens allowed";
                    $firstname = "";
                }
            }
            
            // Checks lastname field for the legal characters
            if (empty($_POST["lastname"])) {
                $lastnameError = "Last name is required";
            } else {
                $lastname = to_store($_POST["lastname"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
                    $lastnameError = "Only letters, spaces and hypens allowed";
                    $lastname = "";
                }
            }
            
            // Checks constituency field for entry
            if (empty($_POST["constituency"])) {
                $constituencyError = "Constituency is required";
            } else {
                $constituency = to_store($_POST["constituency"]);
            }
            
            // Checks email field for the legal characters
            if (empty($_POST["email"])) {
                $emailError = "Email is required";
            } else {
                $email = to_store($_POST["email"]);
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
                    $emailError = "Email format incorrect";
                    $email = "";
                }
            }
            
            // Checks years of service field for the legal characters and range
            if (empty($_POST["years"])) {
                $yearsError = "This field is required";
            } else {
                $years = to_store($_POST["years"]);
                if (is_numeric($years)) {
                    if (!($years >=0 && $years <=50)){
                        $yearsError = "Enter interger values between 0 and 50";
                        $years = "";
                    }
                } else {
                    $yearsError = "Enter interger values between 0 and 50";
                    $years = "";
                }
            }
            
            // Checks password field for entry
            if (empty($_POST["password1"])) {
                $pswError = "Password is required";
            } else {
                $psw = to_store($_POST["password1"]);
            }
            
            // Checks password field for entry
            if (empty($_POST["password2"])) {
                $psw1Error = "Password is required";
            } else {
                $psw1 = to_store($_POST["password2"]);
            }
            
            // Checks all fields for entry
            if( !($firstname=='') && !($lastname=='') && !($constituency=='') && !($email=='') && !($years=='') &&!($psw=='') &&!($psw1=='') ) {
                // Compares both passwords
                if (!(strcmp($psw, $psw1) == 0)) {
                    echo "Passwords don't match";
                    $psw = "";  // Clears the password field if they don't match
                    $psw1 = "";
                } else {
                    $pswMatch = $psw;   // Assigns password to a new variable
                    $randNum = mt_rand();   // Assigns a random number to a new variable
                    $digestRand = $pswMatch . $randNum; // Concatenates the password and the random number
                    $digest = md5($digestRand); // Performs a message digest function on the concatenation and assigns it to new variable
                    
                    // Applying query to insert the fields from the form to a table in the database
                    $sql = "insert into Representatives (first_name, last_name, constituency, email, yrs_service, password_digest, salt) values ('$firstname', '$lastname', '$constituency', '$email', '$years', '$digest', '$randNum')";
                    $conn->exec($sql);
                    echo "New record created successfully";
                    
                    // Brings the user to a new page
                    header('Location: p3_table.php');
                    exit();
                }
            }
        }
    } catch(PDOException $e) {
        // Error message is displayed
        echo $sql . "<br>" . $e->getMessage();
    }
    
    // Closes database connection
    $conn = null;
?>