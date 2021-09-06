<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
else
{
    $id=$_SESSION["id"];
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

    <nav class="navbar navbar-expand-sm bg-dark  navbar-dark justify-content-center">
        <ul class="navbar-nav ">
            <li class="nav-item">
                
              <a class="nav-link " href="welcome.php">Home</a>
                </li>
                <li>
              <a class="nav-link active" href="#"><?=$_SESSION["name"]?></a>
            </li>
          </ul>
    </nav>
  
<br><br>
   
<div class="row justify-content-center">
<div class="col-8">
    
<div class="table-responsive">

    <table class="table" style="font-size: large;">
        <tr class="bg-dark" style="color: white;">
            <th>Title</th><th>Info </th>
        </tr>

        <?php      
        include('config.php');  
                          
            $sql = "SELECT name,regno,branch,year,category,trainfor,address,phno,email,aadhar,enrollno FROM `students` WHERE id= $id;";  
            
            $result = mysqli_query($link, $sql);  
            if ($result->num_rows > 0) 
            {
                while($row= $result->fetch_array(MYSQLI_NUM))
                {
                    ?>
                    <tr>
                        <th>Name</th>
                        <td><?=$row[0]?></td>
                    </tr>
                    <tr>
                        <th>Registration number</th>
                        <td><?=$row[1]?></td>
                    </tr>
                    <tr>
                        <th>Branch</th>
                        <td><?=$row[2]?></td>
                    </tr>
                    <tr>
                        <th>Year</th>
                        <td><?=$row[3]?></td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td><?=$row[4]?></td>
                    </tr>
                    <tr>
                        <th>Training For</th>
                        <td><?=$row[5]?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?=$row[6]?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><?=$row[7]?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?=$row[8]?></td>
                    </tr>
                    <tr>
                        <th>Aadhar</th>
                        <td><?=$row[9]?></td>
                    </tr>
                    <tr>
                        <th>Enrollment id</th>
                        <td><?=$row[10]?></td>
                    </tr>
                   
                    <?php
                    
                 }
            }
        ?>  
    </table>

        </div>

</div>

<div class="col-8" style="text-align:right;">

<a href="updatestudent.php" class="btn btn-warning ml-3">Update Details</a>

</div>
</div>
</body>
</html>