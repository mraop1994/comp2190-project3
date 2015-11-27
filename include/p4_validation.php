<?php
    // Stores each field data from the form to a variable
    $email = to_store($_POST["email"]);
    $psw = to_store($_POST["password"]);
    
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
        
        // Begins validation upon clicking Login in the form
        if(isset($_POST['login'])){
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
            
            // Checks password field for entry
            if (empty($_POST["password"])) {
                $pswError = "Password is required";
            } else {
                $psw = to_store($_POST["password"]);
            }
            
            // Checks all fields for entry
            if( !($email=='') && !($psw=='') ) {
                // Applying query to retrieve the user's information from the database
                $stmt = $conn->prepare("SELECT * FROM Representatives where email = '$email'");
                $stmt->execute();
                $result = $stmt->fetch();
                
                // Stores the information for the user in new variables
                $getDigest = $result['password_digest'];
                $getSalt = $result['salt'];
                
                $loginSalt = $psw . $getSalt;   // Concatenates the password entered with the salt in the database
                $digestLogin = md5($loginSalt); // Performs a message digest function on the concatenation and assigns it to new variable
                
                // Comparing the new password digest with the one stored in the database
                if(strcmp($digestLogin, $getDigest) == 0){
                    // Brings the user to a new page
                    header('Location: p3_table.php');
                    exit();
                } else {
                    echo "Invalid Email or Password";
                    $psw = "";  // Clears the password field if it doesn't correspond with the email given
                }
            }
        }
    } catch(PDOException $e) {
        // Error message is displayed
        echo $conn . "<br>" . $e->getMessage();
    }
    
    // Closes database connection
    $conn = null;
?>