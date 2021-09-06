<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
  
$id=$_SESSION["id"];
$cid=$_GET['cid'];
?>

<?php      
                                            include('config.php');  
                                                              
                                                $sql = "select * from schedule where id= $cid;";  
                                                $result = mysqli_query($link, $sql);  
                                                if ($result->num_rows > 0) 
                                                {
                                                    while($row= $result->fetch_array(MYSQLI_NUM))
                                                    {
                                                        $cid=$row[0];
                                                        $mname=$row[1];
                                                        $mdept=$row[2];
                                                        $date=$row[3];
                                                        $stime=$row[4];
                                                        $subject=$row[6];
                                                     }
                                                }
                                                else{
                                                    header("location: login.php");
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
        body{ font: 18px sans-serif; }
    </style>
</head>
<body>
<h1 class="" style="padding-top: 1%; padding-bottom: 1%;color: rgb(0, 119, 255); text-align: center;font-style: oblique;">Puducherry Technological University</h1>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-center">
        <ul class="navbar-nav ">
            <li class="nav-item">
                
              <a class="nav-link active" href="#">Feedback</a>
                </li>
          </ul>
    </nav>
  
<br><br>
   
<div class="row justify-content-md-center">
    
<div class="col-md-8">

    <div class="card">
        <header class="card-header">
            <h4 class="card-title mt-2">Update Details</h4>
        </header>
        <article class="card-body">
        <form action="feedbackinsert.php" method="post">
            <div class="form-group">
                
            <?php      
                              
                $sql = "SELECT name,regno,enrollno,email,branch,year,category,trainfor,address,aadhar,phno,pass FROM `students` WHERE id= $id;";  
                
                $result = mysqli_query($link, $sql);  
                if ($result->num_rows > 0) 
                {
                    while($row= $result->fetch_array(MYSQLI_NUM))
                    {

                        $regnumber=$row[1];
                        
                        $sql2 = "SELECT * FROM `feedback` WHERE cid=$cid AND regno='$regnumber';";  
                        $result2 = mysqli_query($link, $sql2);  
                        if ($result2->num_rows > 0) 
                        {
                            header("location: login.php");
                            exit;
                        }

                        ?>



                    <label>Name </label>   <br>
                    
                    <label><?=$row[0]?> </label> 
                      <input type="text" class="form-control" hidden id="name" name="name" value="<?=$row[0]?>" required placeholder="Enter Full Name">
            </div> <!-- form-row-group end.// -->
            <div class="form-row">
                <div class="col form-group">
                    <label>Roll number</label><br>
                    <label><?=$row[1] ?></label>
                    <input type="text"id="cid" name="cid" hidden class="form-control " value="<?=$cid ?>">
                   
                    <input type="text"id="regno" name="regno" hidden class="form-control " value="<?=$row[1] ?>">
                   
                </div> <!-- form-group end.// -->
                <div class="col form-group">
                    <label>Enrolment ID (Optional)</label><br>
                    
                    <label><?=$row[2]?> </label> 
                      <input hidden type="text" class="form-control" id="gateid" name="gateid" value="<?=$row[2]?>" placeholder="Gate enrollment number">
                </div> <!-- form-group end.// -->
            </div> <!-- form-row end.// -->
            <div class="form-group">
                <label>Email address</label><br>
                    
                    <label><?=$row[3]?> </label> 
                <input hidden type="email" id="email" name="email" class="form-control" value="<?=$row[3]?>" placeholder="">
            </div> <!-- form-group end.// -->
    
            <script type="text/javascript">
    $(document).ready(()=>{
        $("#dept").val('<?= $row[4]?>');
    });     
    </script>
            <div class="form-row">
                <div class="col form-group">
                    <label for="Department">Department </label>
                    <br>
                    
                    <label><?=$row[4]?> </label> 
                    <select hidden class="form-control" name="dept" id="dept">
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
                    <br>
                    
                    <label><?=$row[5]?> </label> 
                      <input hidden type="number" class="form-control" value="<?=$row[5]?>" id="year" name="year" placeholder="">
                </div> <!-- form-group end.// -->
            </div> <!-- form-row end.// -->
  
            
        <div class="form-group">
                <label>Phone Number</label>
                
                <br>
                    
                    <label><?=$row[10]?> </label> 
                  <input hidden type="number" class="form-control" id="phno" name="phno" value="<?=$row[10]?>" placeholder="">
           
        </div> <!-- form-row end.// -->
        <div class="form-group">
                <label>Subject name</label><br>
                <input type="text" id="subject" name="subject" class="form-control" required value="<?=$subject?>" placeholder="">
            </div> <!-- form-group end.// -->
        <div class="form-group">
                <label>Topic Covered</label><br>
                <input type="text" id="topic" name="topic" class="form-control" required placeholder="">
            </div> <!-- form-group end.// -->
            <div class="form-group">
                <label>Faculty name</label><br>
                <input type="text" id="mname" name="mname" class="form-control" required value="<?=$mname?>" placeholder="">
            </div> <!-- form-group end.// -->
            <div class="form-group">
                <label>Department</label><br>
                <input type="text" id="mdept" name="mdept" class="form-control" required value="<?=$mdept?>" placeholder="">
            </div> <!-- form-group end.// -->
            <div class="form-group">
                <label>Date</label><br>
                <input type="date" id="date" name="date" class="form-control" required value="<?=$date?>" placeholder="">
            </div> <!-- form-group end.// -->   
            <div class="form-group">
                <label>Time</label><br>
                <input type="text" id="stime" name="stime" class="form-control" required value="<?=$stime?>" placeholder="">
            </div> <!-- form-group end.// -->
            <div class="form-group">
                <label>No of Hours</label><br>
                <input type="number" id="hrs" name="hrs" class="form-control" required placeholder="">
            </div> <!-- form-group end.// -->
            <div class="form-group">
                <label>Feedback</label><br>
                <input type="radio" name="feedback" selected value="Good">Good
                 <input type="radio" name="feedback" value="Average">Average
                <input type="radio" name="feedback" value="Satisfactory">Satisfactory
            </div> <!-- form-group end.// -->
            <div class="form-group">
                <label>Remarks/Suggestions:</label><br>
                <input type="text" id="remarks" name="remarks" class="form-control" required placeholder="">
            </div> <!-- form-group end.// -->
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block"> Add Feedback  </button>
            </div> <!-- form-group// -->      
        </form>
        </article> <!-- card-body end .// -->
        </div> <!-- card.// -->
        </div> <!-- col.//-->
        
        </div> <!-- row.//-->
        
        
            <?php
                    }
                }?>

    
</div>
</div>

</body>
</html>