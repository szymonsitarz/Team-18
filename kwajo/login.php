<!DOCTYPE html>
<html>
<?php
include 'connected.php';

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
}

if(isset($_POST['submit'])){
    $username =  $_POST['username'];
    $password = $_POST['password'];
    $row= $db->prepare("SELECT * From cvs WHERE username= :username");
    $row->bindParam(':username', $username);
    $row->execute();
    if($result=$row->fetch(PDO::FETCH_ASSOC)){
		if(password_verify($password,$result['password'])){
		$_SESSION['username']=$result['username'];
        header("Location: welcome.php");
		}else{echo "<script>alert('Woops! Password was wrong . Try again')</script>";}
    }else{echo "<script>alert('Woops! Email was Wrong. Try again')</script>";}
}

?>
<head>
    <meta charset="UTF-8">
    <title>Log-in Page</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,400i,700">
</head>
<body class="body">
	<div class="container">
		<form action="login.php" method="POST" class="login-email">
		<table>
		
		<tr style="text-align:right "><td></td><td ><a  href="welcome.php" class="hover">Home</a></td></tr>
</table>
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username"  required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" required>
			</div>
			<div class="input-group">
				<button name="submit" class="btnn">Login</button>
			</div>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
		</form>
	</div>
</body>
</html>