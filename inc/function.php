<?php
	function SendMail($receiver,$subject,$content)
	{
		$ServerName = $_SERVER['SERVER_NAME'];
		$isIP = preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\z/', $ServerName);
		if($ServerName =="localhost" || $isIP ==1)
		{ 
			
			/* please read below instruction to send email 
		    this code is working perfectly and we just need to do following  things 
		   
			open php.ini file and uncomment following line in file
			;extension=openssl
			remove ;(semicolon) from begging of above line and then it will look like following
			
			extension=openssld
			
			and then save file & restart wamp server.
			
			then login into your gmail account & and in same browser copy paste below url into address bar
			
			https://www.google.com/settings/security/lesssecureapps
			
			and then enable less secure mail option (turn on) */ 
			
			require_once('../lib/class.phpmailer.php');
			$UserName="demoblahblahblah@gmail.com"; // replace with your own gmail email address
			$Password="THQaUN2N"; // replace with your own gmail email password
			$SenderEmailAddress=$UserName; // replace with your own gmail email address
			$ContactName="Ankit M Patel"; // replace with your own name
			$ReceiverName=$receiver; // replace with your receiver email address, passed as an argument in function 
			$mail = new PHPMailer(true); 
			$mail->IsSMTP(); 
			try 
			{
			$mail->Host       = "mail.gmail.com"; 	// SMTP server
			$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
			$mail->SMTPAuth   = true;                  // enable SMTP authentication
			$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			$mail->Username   = $UserName;  // GMAIL username
			$mail->Password   = $Password;            // GMAIL password
			$mail->AddReplyTo($SenderEmailAddress,$SenderEmailAddress);
			$mail->AddAddress($receiver,$receiver);
			$mail->SetFrom($SenderEmailAddress,$SenderEmailAddress);
			
			//$mail->AddReplyTo($SenderEmailAddress,$ContactName);
			$mail->Subject = $subject;
			// replace with your subject, passed as an argument in function 
			$mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';
			$mail->Body = $content; // replace with your mail content, passed as an argument in function 
			$mail->Send();
			//echo "Message Sent OK<p></p>\n";
			} 
			catch (phpmailerException $e)
			{
			echo $e->errorMessage(); 
			} catch (Exception $e) 
			{
				echo $e->getMessage(); 
			}
		}
		else //we are on server 
		{
			$headers[] = 'MIME-Version: 1.0';
			$headers[] = 'Content-type: text/html; charset=iso-8859-1';

			// Additional headers
			$headers[] = 'To: $receiver';
			$headers[] = 'From: info@theeasylearnacademy.com';
			/* $headers[] = 'Cc: birthdayarchive@example.com';
			$headers[] = 'Bcc: birthdaycheck@example.com'; */

			// Mail it
		   mail($receiver, $subject, $content, implode("\r\n", $headers));
		} 
	}
?>