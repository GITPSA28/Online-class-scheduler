<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["regno"]))){
        $username_err = "Please enter a Reg no.";
    } elseif(!preg_match('/^[A-Z0-9]+$/', trim($_POST["regno"]))){
        $username_err = "Registration number can only contain Uppercase letters, numbers.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM students WHERE regno = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["regno"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This register number is already Registerd.";
                } else{
                    $username = trim($_POST["regno"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["pass"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["pass"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["pass"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $name=$_POST["name"];
        $branch=$_POST["dept"];
        $year=$_POST["year"];
        $category=$_POST["category"];
        $trainfor=$_POST["trainingfor"];
        $address=$_POST["address"];
        $phno=$_POST["phno"];
        $email=$_POST["email"];
        $aadhar=$_POST["aadhar"];

        $sql="INSERT INTO students ( `name`, `regno`, `branch`, `year`, `category`, `trainfor`, `address`, `phno`, `email`, `pass`, `aadhar`, `enrollno`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
        
        $eid= $_POST["gateid"];
        if (empty($eid))
        {
            $eid= NULL;
        }
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssssssss",$name, $param_username,$branch,$year,$category,$trainfor,$address,$phno,$email, $param_password,$aadhar,$eid );
            
            // Set parameters
            $param_username = $username;
            $param_password = $password; 
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <script src=
    "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
        </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
<h1 class="" style="padding-top: 1%; padding-bottom: 1%;color: rgb(0, 119, 255); text-align: center;font-style: oblique;">Puducherry Technological University</h1>

 
    <nav class="navbar navbar-expand-sm bg-dark  navbar-dark justify-content-center">
        <ul class="navbar-nav ">
            <li class="nav-item">
              <a class="nav-link active" href="#">Register</a>
            </li>
           
          </ul>
          
    </nav>
  
  
<br><br>
   
<div class="row justify-content-center">
    <div class="col-md-6">
    <div class="card">
    <header class="card-header">
        <a href="login.php" class="float-right btn btn-outline-primary mt-1">Log in</a>
        <h4 class="card-title mt-2">Sign up</h4>
    </header>
    <article class="card-body">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
                <label>Name </label>   
                  <input type="text" class="form-control" id="name" name="name" required placeholder="Enter Full Name">
        </div> <!-- form-row-group end.// -->
        <div class="form-row">
            <div class="col form-group">
                <label>Roll number</label>
                <input type="text"id="regno" name="regno"  class="form-control  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" required placeholder="College Registration number">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div> <!-- form-group end.// -->
            <div class="col form-group">
                <label>Enrolment ID (Optional)</label>
                  <input type="text" class="form-control" id="gateid" name="gateid" placeholder="Gate enrollment number">
            </div> <!-- form-group end.// -->
        </div> <!-- form-row end.// -->
        <div class="form-group">
            <label>Email address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="">
        </div> <!-- form-group end.// -->
        <div class="form-row">
            <div class="col form-group">
                <label for="Department">Department </label>
                <select class="form-control" name="dept" id="dept">
                    <option value="CSE">Computer Science and Engineering</option>
                    
                    <option value="IT">Information Technology</option>
                    
                    <option value="Mech">Mechanical Enginerring</option>
                    
                    <option value="EEE">Electronics and Electrical Engineering</option>
                    
                    <option value="ECE">Electronics and Comunication Engineering</option>
                    
                    <option value="E&I">Electronics and Instrumentaion Engineering</option>
                    
                    <option value="Civil">Civil Engineering</option>
                    
                    <option value="Chem">Chemical Engineering</option>
                </select>
            </div> <!-- form-group end.// -->
            <div class="col form-group">
                <label>Year of study</label>
                  <input type="number" class="form-control" id="year" name="year" placeholder="">
            </div> <!-- form-group end.// -->
        </div> <!-- form-row end.// -->

        <div class="form-row">
            <div class="col form-group">
                <label for="category">Category </label>
                <select class="form-control" name="category" id="category">
                    <option value="General">General</option>
                    
                    <option value="SC/ST">SC/ST</option>
                   
                </select>
            </div> <!-- form-group end.// -->
            <div class="col form-group">
                <label for="trainingfor">Training for  </label>
                <select class="form-control" name="trainingfor" id="trainingfor">
                    <option value="gate">GATE</option>
                    <option value="cat">CAT</option>
                    <option value="both">Both</option>
                </select>
            </div> <!-- form-group end.// -->
        </div> <!-- form-row end.// -->
        
        <div class="form-group">
            <label>Address </label>   
              <input type="text" class="form-control" id="address" name="address" required placeholder="">
    </div> <!-- form-row-group end.// -->
    <div class="form-row">
        <div class="col form-group">
            <label>Aadhar number</label>
            <input type="number" class="form-control" id="aadhar" name="aadhar" required placeholder="">
        </div> <!-- form-group end.// -->
        <div class="col form-group">
            <label>Phone Number</label>
              <input type="number" class="form-control" id="phno" name="phno" placeholder="">
        </div> <!-- form-group end.// -->
    </div> <!-- form-row end.// -->
        <div class="form-group">
            <label>Create password</label>
            <input class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" id="pass" name="pass" type="password">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>

        </div> <!-- form-group end.// -->  
        <div class="form-group">
            <label>COnfirm password</label>
            <input class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" id="confirm_password" name="confirm_password" type="password">
            <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>

        </div> <!-- form-group end.// -->  
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block"> Register  </button>
        </div> <!-- form-group// -->      
    </form>
    </article> <!-- card-body end .// -->
    <div class="border-top card-body text-center">Have an account? <a href="login.php">Log In</a></div>
    </div> <!-- card.// -->
    </div> <!-- col.//-->
    
    </div> <!-- row.//-->
    
</div>
</div>
    
        
</body>
</html>