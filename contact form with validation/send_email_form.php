<?php
echo<<<_contactHTML
<!DOCTYPE html>

<head>
<title>Contact</title>
<link href="contact.css" type="text/css" rel="stylesheet"/>
<meta charset="UTF-8">
<meta name="description" content="Web development service contact">
<meta name="keywords" content="HTML,CSS,XML,JavaScript,web,website,development,hosting,design,SEO,business,leafy,leafyweb,contact">
<meta name="author" content="Anthony Saldana">
</head>

<body>
_contactHTML;
if(isset($_POST['email_address']) && !empty($_POST['email_address']))
{
	//Edit these lines with the email you want the information sent to as well as a subject line.
	$email_to="" ;//insert the email you want the info sent to
	$email_subject=""; //insert the subject line
	
	function died($error)
	{
		//error code can go here
		echo "we're sorry but there seems to have been some error(s) found within the form you submitted. ";
		echo "These errors appear below: </br>";
		echo $error."</br>";
		echo "please go back and fix these errors";
		die();	
	}
	
	//simple validation to check if expected data has been input
	if(empty($_POST['email_address'])||
		empty($_POST['company_name'])||
		empty($_POST['helptext']))
		{
			died('<b style="font-size:1.5em;">One of the required fields is empty</b>');
		}
		
	$email_from = $_POST['email_address'];
	$phone = $_POST['phone_number'];
	$company = $_POST['company_name'];
	$help = $_POST['helptext'];
	
	$error_message = "";
	
	$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if(!preg_match($email_exp,$email_from)){
	$error_message .= "<b>The email you entered does not appear to be valid</b></br>";}
	
	 /*If you want to use a validation for strings such as names you can use this code
	 Assuming you have a variable such as
	 
	 $name=$_POST['name'];
	 $string_exp = "/^[A-Za-z .'-]+$/";
	 if(!preg_match($string_exp,$name)){
	 error_message .= "<b>The name you entered does not appear to be valid</b>"}*/
	 
	 //a validation for comments. This will check that the input on the helptext area is at least a certain length.
	 
	 if(strlen($help) < 20){
	 $error_message .= "<b>The text you left in the help section is not long enough </b></br>";}
	 
	 if(strlen($error_message) > 0){
	 died($error_message);}
	 
	 $message = "Form details from interested customer:\n\n";
	 
	 function clean($string)
	 {
	 	$sickstring = array("content-type","bcc:","to:","cc:","href");
	 	return str_replace($sickstring,"-",$string);
	 	//replaces any characters found in the array with a hyphen.
	 }
	 
	 $message .= "email: ".clean($email_from)."\n";
	 $message .= "phone: ".clean($phone)."\n";
	 $message .= "company: ".clean($company)."\n";
	 $message .= "help: ". clean($help)."\n";
	 /* if using the name variable
	 $message .= "name: ".clean($name)."\n"; */
	 
	 //lets make some headers
	 
	 $headers = "From: " . $Email_from . "\r\n".
	 "Reply_To: " . $Email_from . "\r\n".
	 "xmailer: php/" . phpversion();
	 
	 @mail($email_to, $email_subject, $message, $headers);
	 ?>
	 <!-- feel free to include html here to show success -->
	 <p id="success">Thank you for contacting us. We will be in touch with you very soon.</p>
	 
	 <?php
}
else echo"<p class='fail'>Please Go back and fill out the form</p>";
?>