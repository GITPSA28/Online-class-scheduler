<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"] != true){
    header("location: adminlogin.php");
    exit;
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
    <style>
        body{ font: 14px sans-serif; }
    </style>
</head>
<body>
<h1 class="" style="padding-top: 1%; padding-bottom: 1%;color: rgb(0, 119, 255); text-align: center;font-style: oblique;">Puducherry Technological University</h1>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
        <ul class="navbar-nav ">
            <li class="nav-item">
                
              <a class="nav-link active" href="#">Home</a>
                </li>
                <li>
                    
              <a class="nav-link " href="adminviewshedule.php">View Shedule</a>

            </li>
            <li>
                    
              <a class="nav-link " href="adminviewstudents.php">View Students</a>
              
            </li>
          </ul>
    </nav>
  
<br><br>
   
<div class="row justify-content-md-center">
    
<h1 class="my-5">Welcome <b><?php echo htmlspecialchars($_SESSION["admin"]); ?></b>. Add class Schedule.</h1>
<div class="col-md-8">

<div class="card">
    
    <article class="card-body">
    <form action="adminadds.php" method="post">
        <div class="form-group">
                <label>Faculty Name </label>   
                  <input type="text" class="form-control" id="name" name="name" required placeholder="Enter Full Name">
        </div> <!-- form-row-group end.// -->
        
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
                <label>Date</label>
                  <input type="date" class="form-control" id="date" name="date" required placeholder="">
            </div> <!-- form-group end.// -->
        </div> <!-- form-row end.// -->

        <div class="form-row">
            <div class="col form-group">
                <label for="category">Start Time </label>
                
                <input type="text" class="form-control" id="stime" name="stime" required placeholder="">
                   
            </div> <!-- form-group end.// -->
            <div class="col form-group">
            <label for="category">End Time </label>
                
                <input type="text" class="form-control" id="etime" name="etime" required placeholder="">
                   
            </div> <!-- form-group end.// -->
        </div> <!-- form-row end.// -->
        
        <div class="form-group">
            <label>Subject </label>   
              <input type="text" class="form-control" id="subject" name="subject" required placeholder="">
    </div> <!-- form-row-group end.// -->
    <div class="form-group">
                <label>Google meet link </label>   
                  <input type="text" class="form-control" id="gmeet" name="gmeet" required >
        </div> <!-- form-row-group end.// -->
        
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block"> Add Schedule  </button>
        </div> <!-- form-group// -->      
    </form>
    </article> <!-- card-body end .// -->
    </div> <!-- card.// -->
    </div> <!-- col.//-->
    
    </div> <!-- row.//-->

<div class="col-8" style="text-align:right;">

<a href="adminlogout.php" class="btn btn-danger ml-3">Sign Out of Admin Account</a>

</div>
</div>

</body>
</html>