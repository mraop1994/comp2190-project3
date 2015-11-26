<?php
    $firstname ="";
    $lastname ="";
    $email ="";
    $constituency ="";
    $years ="";
    $psw ="";
    $psw1 ="";
    
    $firstnameError ="";
    $lastnameError ="";
    $emailError ="";
    $constituencyError ="";
    $pswError ="";
    $psw1Error ="";
    $yearsError ="";
    $successMessage ="";
    
    $servername = "localhost";
    $username = "comp2190SA";
    $password = "2015Sem1";
    $dbname = "MPMgmtDB";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        if(isset($_POST['submit'])){
            if (empty($_POST["firstname"])) {
                $firstnameError = "First name is required";
            } else {
                $firstname = test_input($_POST["firstname"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$firstname)) {
                    $firstnameError = "Only letters, spaces and hypens allowed";
                }
            }
            
            if (empty($_POST["lastname"])) {
                $lastnameError = "Last name is required";
            } else {
                $lastname = test_input($_POST["lastname"]);
                if (!preg_match("/^[a-zA-Z ]*$/",$lastname)) {
                    $lastnameError = "Only letters, spaces and hypens allowed";
                }
            }
            
            if (empty($_POST["constituency"])) {
                $constituencyError = "Constituency is required";
            } else {
                $constituency = test_input($_POST["constituency"]);
            }
            
            if (empty($_POST["email"])) {
                $emailError = "Email is required";
            } else {
                $email = test_input($_POST["email"]);
                if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
                    $emailError = "Email format incorrect";
                }
            }
            
            if (empty($_POST["years"])) {
                $yearsError = "This field is required";
            } else {
                $years = test_input($_POST["years"]);
                if (!is_numeric($years)) {
                    $yearsError = "Enter interger values";
                }
            }
            
            if (empty($_POST["password1"])) {
                $pswError = "Password is required";
            } else {
                $psw = test_input($_POST["password1"]);
            }
            
            if (empty($_POST["password2"])) {
                $psw1Error = "Password is required";
            } else {
                $psw1 = test_input($_POST["password2"]);
            }
            
            if( !($firstname=='') && !($lastname=='') && !($constituency=='') && !($email=='') && !($years=='') &&!($psw=='') &&!($psw1=='') ) {
                if (!(strcmp($psw, $psw1) == 0)) {
                    echo "Passwords don't match";
                } else {
                    $pswMatch = $psw;
                    $randNum = mt_rand();
                    $digestRand = $pswMatch + $randNum;
                    $digest = md5($digestRand);
                    
                    $sql = "insert into Representatives (first_name, last_name, constituency, email, yrs_service, password_digest, salt) values ('$firstname', '$lastname', '$constituency', '$email', '$years', '$digest', '$randNum')";
                    $conn->exec($sql);
                    echo "New record created successfully";
                }
            }
        }
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    
    function test_input($data) {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }
    
    $conn = null;
?>