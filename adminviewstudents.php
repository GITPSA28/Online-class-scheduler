<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["adminloggedin"]) || $_SESSION["adminloggedin"] !== true){
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
                
              <a class="nav-link " href="adminhome.php">Home</a>
                </li>
                <li>
                    
              <a class="nav-link  " href="adminviewshedule.php">View Shedule</a>

            </li>
            <li>
                    
              <a class="nav-link active " href="adminviewstudents.php">View Students</a>
              
            </li>
          </ul>
    </nav>
  
<br><br>
   
<div class="row justify-content-md-center">
    
<div class="col-md-10">
    <div class="table-responsive">

  <table class="table">
        <tr>
     
          <th>id</th>
          <th>Name</th>
          <th>Register no</th>
          <th>Branch</th>
          <th>Year</th>
          <th>Category</th>
          <th>Training</th>
          <th>Address</th>
          <th>Phone no</th>
          <th>Email</th>
          <th>Pass</th>
          <th>aadhar</th>
          <th>Gate id</th>
          
          <th>Edit</th>
          
          <th>Delete</th>
        </tr>
        <?php      
                                            include('config.php');  
                                                              
                                                $sql = "select * from students";  
                                                $result = mysqli_query($link, $sql);  
                                                if ($result->num_rows > 0) 
                                                {
                                                    while($row= $result->fetch_array(MYSQLI_NUM))
                                                    {
                                                            echo "<tr>";
                                                            for($i=0;$i<13;$i++)
                                                        {
                                                            $value=$row[$i];
                                                        echo "<td>".$value."</td>";
                                                        }

                                                        ?>
                                                        <td><a href="adminupdatestudent.php?id=<?=$row[0]?>">Edit</a></td>
                                                        <td><a href="admindeletestudent.php?id=<?=$row[0]?>">Delete</a></td>
                                                        
                                                        </tr>
                                                        <?php
                                                        
                                                     }
                                                }
                                            ?>    
  </table>


  </div>
    
</div>
<div class="col-8" style="text-align:right;">

<a href="adminlogout.php" class="btn btn-danger ml-3">Sign Out of Admin Account</a>

</div>
</div>

</body>
</html>