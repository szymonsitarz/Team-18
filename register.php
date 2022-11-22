<!DOCTYPE html>
<html>
<?php

include 'connected.php';

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email =  $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    if($password==$cpassword){
        $hee= $db->prepare("SELECT * From cvs WHERE email= :email");
    $hee->bindParam(':email', $email);
    $hee->execute();
    if(!$hresult=$hee->fetch(PDO::FETCH_ASSOC)){
    $hashedpass = password_hash($password,PASSWORD_DEFAULT);
    $row= $db->prepare("INSERT INTO cvs(name, username, email, password) 
    VALUES (?,?,?,?)");
    $row->bindParam(1, $name, PDO::PARAM_STR);
    $row->bindParam(2, $username, PDO::PARAM_STR);
    $row->bindParam(3,$email, PDO::PARAM_STR);
    $row->bindParam(4,$hashedpass, PDO::PARAM_STR);
   $result= $row->execute();
   if( $result){
     header("Location: welcome.php");
    }else{echo "<script>alert('Something went wrong. Try again')</script>";}
    }else{echo "<script>alert('Woops! Email already exist. Try again')</script>";}
}else{echo "<script>alert('Woops! Password does not match. Try again')</script>";}
}

?>
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,400i,700">
</head>
<body class="body">
	<div class="container">
		<form action="login.php" method="POST" class="login-email">
		<table>
		
		<tr style="text-align:right "><td></td><td ><a  href="welcome.php" class="hover">Home</a></td></tr>
</table>
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
				<input type="text" placeholder="First Name" name="fname" required>
			</div>
            <div class="input-group">
				<input type="text" placeholder="Last Name" name="lname" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username"  required>
			</div>
            <div class="input-group">
				<input type="email" placeholder="Email" name="email" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" required>
			</div>
            <div class="input-group">
				<input type="password" placeholder="Confirm Password" name="cpassword" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btnn">Register</button>
			</div>
			<p class="login-register-text">Have an account? <a href="login.php">Log-in Here</a></p>
		</form>
	</div>
</body>
</html>