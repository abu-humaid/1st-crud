<?php include_once "app/db.php";?>
<?php include_once "app/functions.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>
	<?php
		// Add student form submit
		if( isset($_POST['add-student'])){
			//Get value
			  $name = $_POST['name'];
			  $email = $_POST['email'];
			  $cell = $_POST['cell'];
			  $age = $_POST['age'];
			  $location = $_POST['location'];

			 // Gender isseting
			 if( isset($_POST['gender'])){
				  $gender = $_POST['gender'];
			 }


				// Form validation
				if( empty($name) || empty($email) || empty($cell) || empty($age) || empty($location) || empty($gender) ){
					$mess = '<p class="alert alert-danger"> All fields are required !! <button class="close" data-dismiss="alert">&times;</button> </p>' ;
				}elseif (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
					$mess = '<p class="alert alert-danger"> Invalid email address !! <button class="close" data-dismiss="alert">&times;</button> </p>' ;
				}elseif ( $age < 20 || $age > 80) {
					$mess = '<p class="alert alert-danger"> Your age is not suitable for this apps !! <button class="close" data-dismiss="alert">&times;</button> </p>' ;
				}else {

					// File upload management
	 				$data = fileUpload($_FILES['photo'], 'students/', ['jpg','jpeg','png']);

					$photo = $data['file_name'];

					//isseting
					if (!empty($data['mess'])) {
						$mess = $data['mess'];
					} else {
						//Sending data to Database
						$sql = "INSERT INTO students (name, email, cell, age, location, gender,photo,status) VALUES ('$name','$email','$cell','$age','$location','$gender','$photo','active')";
						$connection -> query($sql);
						//Success message
						$mess = '<p class="alert alert-success"> Data stable!! <button class="close" data-dismiss="alert">&times;</button> </p>' ;
					}


				}

		}

	?>

	<div class="wrap shadow">
		<a href="index.php" class="btn btn-success btn-sm"> All Student</a>
		<div class="card">
			<div class="card-body">
				<h2>Sign Up</h2>
			<?php
				if( isset($mess)){
					echo $mess;
				}
			?>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Age</label>
						<input name="age" class="form-control" type="text">
					</div>
					<div class="form-group">
						<label for="">Location</label>
						<select class="form-control" name="location">
							<option value="">- select -</option>
							<option value="Mirpur">Mirpur</option>
							<option value="Banani">Banani</option>
							<option value="Uttara">Uttara</option>
							<option value="Boshundhara">Boshundhara</option>
							<option value="Gulshan">Gulshan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Gender</label>
						<br>
						<input value="Male" name="gender" class="" type="radio" id="male"><label for="male">Male</label>
						<input value="Female" name="gender" class="" type="radio" id="female"><label for="female">Female</label>
					</div>

					<div class="form-group">
						<label for="">Photos</label>
						<input name="photo" class="" type="file">
					</div>
					<div class="form-group">
						<input name="add-student" class="btn btn-primary" type="submit" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>








	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
</body>
</html>
