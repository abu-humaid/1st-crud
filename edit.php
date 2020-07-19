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
		if( isset($_GET['id'])){
			$id_url = $_GET['id'];
		}

		// Add student form submit
		if( isset($_POST['update-student'])){
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

							if (isset($_FILES['new_photo']['name'])) {
								$data = fileUpload($_FILES['new_photo'],'students/');
								$photo_name = $data['file_name'];
								unlink('students/'. $_POST['old_photo']);
							} else {
								$photo_name = $_POST['old_photo'];
							}

						//Sending data to Database
						$sql = "UPDATE students SET
								name = '$name',
								email = '$email',
								cell = '$cell',
								age = '$age',
								location = '$location',
								photo = '$photo_name'
								WHERE id='$id_url' ";
						$connection -> query($sql);
						//Success message
						$mess = '<p class="alert alert-success"> Data updated successfull !! <button class="close" data-dismiss="alert">&times;</button> </p>' ;



				}

		}

		// Recieveing data from database 
    $sql = "SELECT * FROM students WHERE id='$id_url' ";
    $data = $connection -> query($sql);
    $single_data = $data -> fetch_assoc();

	?>

	<div class="wrap shadow">
		<a href="index.php" class="btn btn-success btn-sm"> All Student</a>
		<div class="card">
			<div class="card-body">
				<h2>Update Student Data</h2>
			<?php
				if( isset($mess)){
					echo $mess;
				}
			?>
				<form action="<?php echo $_SERVER['PHP_SELF'];?>?id=<?php echo $id_url; ?>" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="">Name</label>
						<input name="name" class="form-control" value="<?php echo $single_data['name']; ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Email</label>
						<input name="email" class="form-control" value="<?php echo $single_data['email']; ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Cell</label>
						<input name="cell" class="form-control" value="<?php echo $single_data['cell']; ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Age</label>
						<input name="age" class="form-control" value="<?php echo $single_data['age']; ?>" type="text">
					</div>
					<div class="form-group">
						<label for="">Location</label>
						<select class="form-control" name="location">
							<option value="">- select -</option>
							<option <?php if( $single_data['location'] == 'Mirpur'): echo "selected"; endif; ?> value="Mirpur">Mirpur</option>
							<option<?php if( $single_data['location'] == 'Banani'): echo "selected"; endif; ?> value="Banani">Banani</option>
							<option <?php if( $single_data['location'] == 'Uttara'): echo "selected"; endif; ?> value="Uttara">Uttara</option>
							<option <?php if( $single_data['location'] == 'Boshundhara'): echo "selected"; endif; ?> value="Boshundhara">Boshundhara</option>
							<option <?php if( $single_data['location'] == 'Gulshan'): echo "selected"; endif; ?> value="Gulshan">Gulshan</option>
						</select>
					</div>
					<div class="form-group">
						<label for="">Gender</label>
						<br>
						<input value="Male" name="gender" <?php if( $single_data['gender'] == 'Male'): echo "checked"; endif; ?> class="" type="radio" id="male"><label for="male">Male</label>

						<input value="Female" name="gender" <?php if( $single_data['gender'] == 'Female'): echo "checked"; endif; ?> class="" type="radio" id="female"><label for="female">Female</label>
					</div>
          <div class="form-group">
            <img style="width:150px;" src="students/<?php echo $single_data['photo']; ?>" alt="">
						<input type="hidden" name="old_photo" value="<?php echo $single_data['photo']; ?>">
          </div>

					<div class="form-group">
						<label for="">Photos</label>
						<input name="new_photo" class="" type="file">
					</div>
					<div class="form-group">
						<input name="update-student" class="btn btn-primary" type="submit" value="Update">
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
