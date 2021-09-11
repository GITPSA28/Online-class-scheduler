<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["adminloggedin"]) && $_SESSION["adminloggedin"] === true){
  
    $name=$_POST['name'];
    $dept=$_POST['dept'];
    $date=$_POST['date'];
    $stime=$_POST['stime'];
    $etime=$_POST['etime'];
    $subject=$_POST['subject'];
    $gmeet=$_POST['gmeet'];

}
else{
    header("location: welcome.php");
    exit;
}
// Include config file
require_once "config.php";
$sql = "INSERT INTO schedule VALUES ('','$name','$dept','$date','$stime','$etime','$subject','$gmeet')"; 
        
if ($link->query($sql) === TRUE) {



//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 3;                    
    $mail->isSMTP();                                   
    $mail->Host = 'smtp.gmail.com';                  //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                 
    $mail->Username   = 'Your@mail.id';                     //SMTP username 
    $mail->Password   = 'Y0urPassw0rd';                               //SMTP password
    $mail->SMTPSecure = "tls";            
    $mail->Port       = 587;                                   

    //Recipients
    $mail->setFrom('Your@mail.id', 'YourName');  
    
    $sqlmail="SELECT email,name FROM students";
    $result = mysqli_query($link, $sqlmail);  
        if ($result->num_rows > 0) 
        {
            while($row= $result->fetch_array(MYSQLI_NUM))
            {
                
                 $mail->addAddress($row[0], $row[1]);  
            }
        }
    $mail->isHTML(true);                                
    $mail->Subject = ''.$subject.' Class at '.$stime.' on '.$date.'';
    $mail->Body    = "<b> Here is your class details : <br>Faculty name : ".$name." <br> Class code : <a href=\" ".$gmeet." \">".$gmeet. "</a> </b>";
    

    $mail->send();
    header("location: adminviewshedule.php");
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

     } 
else 
{
echo "Error: " . $sql . "<br>" . $link->error;
}

// Close connection
mysqli_close($link);

?>
