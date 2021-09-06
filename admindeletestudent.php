<?php      
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"] === true){
  

  include('config.php');  
  $id=$_GET['id'];
  
  
      $sql="DELETE FROM `students` WHERE `students`.`id` = $id";
   
    if ($link->query($sql) === TRUE) {
  echo "Student Record Deleted successfully";
  
  header("location: adminviewstudents.php");
         } 
  else 
  {
  echo "Error: " . $sql . "<br>" . $link->error;
  }

$link->close();
}
else{
    header("location: adminhome.php");
    exit;
}

        
?>  
