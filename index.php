<?php

include('config.php');
include('api.php');

require ('class.phpmailer.php');
require ('class.smtp.php');


$arr['topic']='Test by Alok';
$arr['start_date']=date('2022-06-10 00:15:30');
$arr['duration']=30;
$arr['password']='12345';
$arr['type']='2';

$result=createMeeting($arr);

// echo '<pre>';
// print_r($result);


if(isset($result->id)){
	echo "Join URL: <a href='".$result->join_url."'>".$result->join_url."</a><br/>";
	echo "Password: ".$result->password."<br/>";
	echo "Start Time: ".$result->start_time."<br/>";
	echo "Duration: ".$result->duration."<br/>";
}else{
	echo '<pre>';
	print_r($result);
}


$mail = new PHPMailer();
      $mail->CharSet = 'UTF-8';
      $mail->IsSMTP();
      $mail->Host       = "smtp.gmail.com";
      $mail->Port       = 465;
      $mail->SMTPAuth   = TRUE;
      //$mail->SMTPSecure = "TLS";
      $mail->SMTPAutoTLS = false;
      $mail->SMTPSecure = 'ssl';
      $mail->Username   = "demo@gmail.com";          
      $mail->Password   = "ndrftgyhlkedhhhtg";
      $mail->SMTPDebug  = 0;  
      $mail->setFrom($_POST['email'], $_POST['fname']);
      $mail->addAddress('kumaralok0108@gmail.com');
      $mail->addAddress('hashgaurav@gmail.com');
      
      
      $mail->isHTML(true);
      $mail->Subject = 'Zoom Meeting Schedule';


      $mail->Body ="Join URL: <a href='".$result->join_url."'>$result->join_url</a><br/>
                     Password: $result->password<br/>
                     Start Time:$result->start_time<br/>
                     Duration: $result->duration<br/>";
   
      //$mail->send();
      //print_r($_POST);

      $redirect = 'thankyou.php';
		if (!$mail->send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
			
		} else {
      echo '<script>alert("Thank you Zoom Meeting Schedule");  window.location="'.$redirect.'"; </script>';
		}		
?>


<!DOCTYPE html>
<html>
<body>

<h2>Zoom Meeting Schedule</h2>

<form action="" method ="POST">
   <label for="m_start_date">Meeting Strat data:</label><br>
  <input type="date" id="m_start_date" name="m_start_date" value=""><br>

  <label for="m_start_date">Meeting Strat data:</label><br>
  <input type="date" id="m_start_date" name="m_start_date" value=""><br>
  <label for="lname">Meeting Time:</label><br>
  <input type="time" id="meeting_time" name="meeting_time" value=""><br><br>
  <input type="submit" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be sent to a page called "/action_page.php".</p>

</body>
</html>