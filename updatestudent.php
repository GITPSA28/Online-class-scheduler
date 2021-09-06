<?php

// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
   
$id=$_SESSION["id"];

}
else
{

    header("location: welcome.php");
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
</head>
<body>
<h1 class="" style="padding-top: 1%; padding-bottom: 1%;color: rgb(0, 119, 255); text-align: center;font-style: oblique;">Puducherry Technological University</h1>

 
    <nav class="navbar navbar-expand-sm bg-dark  navbar-dark justify-content-center">
        <ul class="navbar-nav ">
            <li class="nav-item">
              <a class="nav-link active" href="#">Update</a>
            </li>
           
          </ul>
          
    </nav>
  
  
<br><br>
   
<div class="row justify-content-center">
    <div class="col-md-6">
    <div class="card">
    <header class="card-header">
        <h4 class="card-title mt-2">Update Details</h4>
    </header>
    <article class="card-body">
    <form action="update.php" method="post">
        <div class="form-group">
            
        <?php      
        include('config.php');  
                          
            $sql = "SELECT name,regno,enrollno,email,branch,year,category,trainfor,address,aadhar,phno,pass FROM `students` WHERE id= $id;";  
            
            $result = mysqli_query($link, $sql);  
            if ($result->num_rows > 0) 
            {
                while($row= $result->fetch_array(MYSQLI_NUM))
                {
                    ?>
                <label>Name </label>   
                  <input type="text" class="form-control" id="name" name="name" value="<?=$row[0]?>" required placeholder="Enter Full Name">
        </div> <!-- form-row-group end.// -->
        <div class="form-row">
            <div class="col form-group">
                <label>Roll number</label><br>
                <label><?=$row[1] ?></label>
                <input type="text"id="regno" name="regno" hidden class="form-control " value="<?=$row[1] ?>">
               
            </div> <!-- form-group end.// -->
            <div class="col form-group">
                <label>Enrolment ID (Optional)</label>
                  <input type="text" class="form-control" id="gateid" name="gateid" value="<?=$row[2]?>" placeholder="Gate enrollment number">
            </div> <!-- form-group end.// -->
        </div> <!-- form-row end.// -->
        <div class="form-group">
            <label>Email address</label>
            <input type="email" id="email" name="email" class="form-control" value="<?=$row[3]?>" placeholder="">
        </div> <!-- form-group end.// -->

        <script type="text/javascript">
$(document).ready(()=>{
    $("#dept").val('<?= $row[4]?>');
});     
</script>
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
                  <input type="number" class="form-control" value="<?=$row[5]?>" id="year" name="year" placeholder="">
            </div> <!-- form-group end.// -->
        </div> <!-- form-row end.// -->

        <script type="text/javascript">
$(document).ready(()=>{
    $("#category").val('<?= $row[6]?>');
});     
</script>
<script type="text/javascript">
$(document).ready(()=>{
    $("#trainingfor").val('<?= $row[7]?>');
});     
</script>
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
              <input type="text" class="form-control" id="address" name="address" value="<?=$row[8]?>" required placeholder="">
    </div> <!-- form-row-group end.// -->
    <div class="form-row">
        <div class="col form-group">
            <label>Aadhar number</label>
            <input type="number" class="form-control" id="aadhar" name="aadhar"value="<?=$row[9]?>" required placeholder="">
        </div> <!-- form-group end.// -->
        <div class="col form-group">
            <label>Phone Number</label>
              <input type="number" class="form-control" id="phno" name="phno" value="<?=$row[10]?>" placeholder="">
        </div> <!-- form-group end.// -->
    </div> <!-- form-row end.// -->
        <div class="form-group">
            <label>Update password</label>
            <input class="form-control"  id="pass" name="pass" value="<?=$row[11]?>" type="password">
           
        </div> <!-- form-group end.// -->  
       
        <div class="form-group">
            <button type="submit" class="btn btn-warning btn-block"> Update  </button>
        </div> <!-- form-group// -->      
    </form>
    </article> <!-- card-body end .// -->
    </div> <!-- card.// -->
    </div> <!-- col.//-->
    
    </div> <!-- row.//-->
    
    
        <?php
                }
            }?>
</body>
</html>