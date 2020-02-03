<?php 
    include('functions.php');
    if (!isLoggedIn()){
        $_SESSION['msg'] = "You must log in first";
	    header('location: login.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div class="header">
		<h2>User Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">
			<img src="images/user_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
			<?php
		// define variables and set to empty values
		$nameErr = $Father_nameErr = $Mother_nameErr = "";
		$name = $Father_name = $Mother_name = $gender = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_POST["name"])) {
			$nameErr = "Name is required";
		} else {
			$name = test_input($_POST["name"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "Only letters and white space allowed";
			}
		}
		
		if (empty($_POST["Father_name"])) {
			$Father_nameErr = "Father Name is required";
		} else {
			$Father_name = test_input($_POST["Father name"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$Father_name)) {
			$Father_nameErr = "Only letters and white space allowed";
			}
		}	
		if (empty($_POST["Mother_name"])) {
			$Mother_nameErr = "Mother Name is required";
		} else {
			$Mother_name = test_input($_POST["Mother name"]);
			// check if name only contains letters and whitespace
			if (!preg_match("/^[a-zA-Z ]*$/",$Mother_name)) {
			$Mother_nameErr = "Only letters and white space allowed";
			}
		}
		if (empty($_POST["gender"])) {
			$genderErr = "Gender is required";
		} else {
			$gender = test_input($_POST["gender"]);
		}
		}

		function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
		}
		?>

		<h2><center>STET Application form </center></h2>
		<!--<p><span class="error">* required field</span></p>-->
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
		Name: <input type="text" name="Full name" value="<?php echo $name;?>">
		<br><br>
		Father's name: <input type="text" name="Father's name" value="<?php echo $Father_name;?>">
		<br><br>
		Mother's name: <input type="text" name="Mother's name" value="<?php echo $Mother_name;?>">
		<br><br>
		Gender:
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
		<input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
		<br><br>
		<input type="submit" name="submit" value="Submit">  
		</form>
		<?php
		
?>

</body>
</html>
