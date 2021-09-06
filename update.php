<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
   

    include('config.php');  
                          
    $password=$_POST['pass'];
    // Check input errors before inserting in database
    if(!empty($_SESSION["id"]) && !empty($password)){
        
        // Prepare an insert statement
        $regno=$_POST["regno"];
        $id=$_SESSION["id"];
        $name=$_POST["name"];
        $branch=$_POST["dept"];
        $year=$_POST["year"];
        $category=$_POST["category"];
        $trainfor=$_POST["trainingfor"];
        $address=$_POST["address"];
        $phno=$_POST["phno"];
        $email=$_POST["email"];
        $aadhar=$_POST["aadhar"];
        $sql="UPDATE students SET `name` = ?, `regno` = ?, `branch` = ?, `year` = ?, `category` = ?, `trainfor` = ?, `address` = ?, `phno` = ?, `email` = ?, `pass` = ?, `aadhar` = ?, `enrollno` = ? WHERE `students`.`id` = $id;";
        $eid= $_POST["gateid"];
        if (empty($eid))
        {
            $eid= NULL;
        }
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            
            mysqli_stmt_bind_param($stmt, 'sssdssssssss',$name, $regno,$branch,$year,$category,$trainfor,$address,$phno,$email, $password,$aadhar,$eid );
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: profile.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
        
    // Close connection
    mysqli_close($link);
    }
}
else
{

    header("location: welcome.php");
    exit;
}
?>