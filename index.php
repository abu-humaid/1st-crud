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



	<div class="wrap-table shadow">
		<a href="add-student.php" class="btn btn-success btn-sm"> Add Student</a>
		<div class="card">
			<div class="card-body">
				<h2>All Data</h2>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
					<input class="p-1" type="text" name="search" placeholder="Location/gender/name/email">
					<input class="btn btn-primary" type="submit" name="search-btn" value="Search">
				</form>
				<br>
				<table class="table table-striped table-hover table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Age</th>
							<th>Location</th>
							<th>Gender</th>
							<th>Photos</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							//Search button issetting
							$search = '';
							if( isset($_POST['search-btn'])){
								$search = $_POST['search'];
							}
							//Data receive from database
							$sql = "SELECT * FROM students WHERE location='$search' OR gender='$search'OR name LIKE '%$search%' ";
							$data = $connection -> query($sql);
							$i = 1;
							while($single_data = $data -> fetch_assoc() ) :
						?>
						<tr>
							<td><?php echo $i; $i++; ?></td>
							<td><?php echo $single_data['name'] ?></td>
							<td><?php echo $single_data['email'] ?></td>
							<td><?php echo $single_data['cell'] ?></td>
							<td><?php echo $single_data['age'] ?></td>
							<td><?php echo $single_data['location'] ?></td>
							<td><?php echo $single_data['gender'] ?></td>
							<td><img src="students/<?php echo $single_data['photo'] ?>" alt=""></td>
							<td>
								<a class="btn btn-sm btn-info" href="single-student.php?id=<?php echo $single_data['id'] ?>">View</a>
								<a class="btn btn-sm btn-warning" href="edit.php?id=<?php echo $single_data['id'] ?>">Edit</a>
								<a id="delete_btn" class="btn btn-sm btn-danger" href="delete.php?id=<?php echo $single_data['id'] ?>">Delete</a>
							</td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>








	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script type="text/javascript">

		$('a#delete_btn').click(function(){
			let con = confirm('Are you sure ?');
			if( con == true){
				return true;
			}else {
				return false;
			} 
		});

	</script>

</body>
</html>
