<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
   

    include('config.php');  
                          
    $password=$_POST['pass'];
    // Check input errors before inserting in database
    if(!empty($_SESSION["id"])){
        
        // Prepare an insert statement
        $regno=$_POST["regno"];
        $cid=$_POST["cid"];
        $name=$_POST["name"];
        $eid= $_POST["gateid"];
        if (empty($eid))
        {
            $eid= NULL;
        }
        $branch=$_POST["dept"];
        $year=$_POST["year"];
        $phno=$_POST["phno"];
        $email=$_POST["email"];
        $mname=$_POST['mname'];
        $topic=$_POST['topic'];
        $mdept=$_POST['mdept'];
        $date=$_POST['date'];
        $stime=$_POST['stime'];
        $subject=$_POST['subject'];
        $hrs=$_POST['hrs'];
        $feedback=$_POST['feedback'];
        $remarks=$_POST['remarks'];
       // $sql="UPDATE students SET `name` = ?, `regno` = ?, `branch` = ?, `year` = ?, `category` = ?, `trainfor` = ?, `address` = ?, `phno` = ?, `email` = ?, `pass` = ?, `aadhar` = ?, `enrollno` = ? WHERE `students`.`id` = $id;";
        $sql = "INSERT INTO feedback VALUES ('','$cid','$name','$regno','$eid','$email','$branch','$year','$phno','$subject','$topic','$mname','$mdept','$date','$stime','$hrs','$feedback','$remarks')"; 
        
        if ($link->query($sql) === TRUE) {
            header("location: welcome.php");
             } 
      else 
      {
      echo "Error: " . $sql . "<br>" . $con->error;
      }
   
        }
        
    // Close connection
    mysqli_close($link);
    }

else
{

    header("location: welcome.php");
    exit;
}
?>