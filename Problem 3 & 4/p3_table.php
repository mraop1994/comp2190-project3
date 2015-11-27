<?php
    // Assign values for database access
    $servername = "localhost";
    $username = "comp2190SA";
    $password = "2015Sem1";
    $dbname = "MPMgmtDB";
    
    // Class created to create rows
    class CreateRows extends RecursiveIteratorIterator {
        function __construct($it) {
            parent::__construct($it, self::LEAVES_ONLY);
        }
        
        function current() {
            return "<td style='padding: 4px; border-collapse: collapse; font-family:Tahoma; font-size:13px; text-align: center;	border: 1px white solid; border-width: 0px 0px 1px 0px;'>" . parent::current(). "</td>";
        }
        
        function beginChildren() {
            echo "<tr>";
        }
        
        function endChildren() {
            echo "</tr>" . "\n";
        }
    }
    
    try {
        // Connection to database
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Begins creation of the table
        echo "<style>body {background: url('http://jis.gov.jm/media/2003.10.28-5316-Kings-House.jpg') no-repeat fixed center center;background-size: cover;}tr:nth-child(odd){background: #eeeff4;}tr:nth-child(even){border: 0;background-color: #dfe1e8;}</style><table style='border: solid 1px black;'>";
        echo "<tr style='border: 1px white solid; border-width: 0px 0px 1px 0px; color: white; background-color: #687290;'><th>First Name</th><th>Last Name</th><th>Constituency</th><th>Email</th><th>Hash</th><th>Years of Service</th></tr>";
        
        // Applying query to retrieve required fields for the table
        $stmt = $conn->prepare("SELECT first_name, last_name, constituency, email, password_digest, yrs_service FROM Representatives");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        // Iteration begins for the creation of table data from database
        foreach(new CreateRows(new RecursiveArrayIterator($stmt->fetchAll())) as $i=>$j) {
            echo $j;
        }
        
        // Link created to bring the user back to the login page
        echo "</table>";
        echo "<a style='color:red;' href=";
        echo "p4_login.php";
        echo ">Go to login page</a>";
        
    } catch(PDOException $e) {
        // Error message is displayed
        echo $j . "<br>" . $e->getMessage();
    }
    
    // Closes database connection
    $conn = null;
?>