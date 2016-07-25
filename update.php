<?php

include 'crud.php';

// Main Object for CRUD
$data_all = new crud();

// Take Value and pass for query operation
if (isset($_POST['create'])) {
	$name       = $_POST['f_name'];
	$Profestion = $_POST['Profestion'];
	$age        = $_POST['age'];
    
    // Send data by this function
	$data_all->setName($name);
	$data_all->setProfession($Profestion);
	$data_all->setAge($age );
	
}

// Update Data
// Catch Action and id by GET method
if (isset($_GET['action']) && $_GET['action']=='update') {
	$id = (int)$_GET['id'];
	$u_result = $data_all->readbyid($id);
}

// Again do create for update
// Take Value and pass for query operation
if (isset($_POST['update'])) {
	$id         = $_POST['id'];
	$name       = $_POST['f_name'];
	$profession = $_POST['profession'];
	$age        = $_POST['age'];
    
    // Send data by this function
	$data_all->setName($name);
	$data_all->setProfession($profession);
	$data_all->setAge($age );
	
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD by php</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class='body'>
	<section class="form">
		<div class="from-input">
		<!-- For Create Data -->
		<?php if (isset($_POST['create']) && $data_all->create_all()) 
		{
			echo "Data Inserted Successfully..";
		} 
		?>
		<!-- For Update Data -->
		<?php if (isset($_POST['update']) && $data_all->update_all($id)) 
		{
			echo "Data Update Successfully..";
		} 
		?>

			<form action="" method="post" name="crud">
			<input type="hidden" name="id" value="<?php echo $u_result['id'];?>">
				<table>
					<tr>
						<td>Name : </td>
						<td><input type="text" name="f_name" value="<?php echo $u_result['name'];?>" required="1"></td>
					</tr>
					<tr>
						<td>Profestion : </td>
						<td><input type="text" name="profession" value="<?php echo $u_result['profession'];?>" required="1"></td>
					</tr>
					<tr>
						<td>Age : </td>
						<td><input type="number" name="age" value="<?php echo $u_result['age'];?>" required="1"></td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" name="update" value="UPDATE"></td>
					</tr>
				</table>
			</form>
		</div>
		<br><hr><br>
		<!-- FROM OUTPUT -->
		<div class="form-output">
			<table>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Profession</th>
					<th>Age</th>
					<th>Action</th>
				</tr>
				<?php
				$i = 0;
				foreach ($data_all->read_all() as $data_key => $data) {
				$i++;	
				?>
				<tr>
				    <td><?php echo $i; ?></td>
					<td><?php echo $data['name']; ?></td>
					<td><?php echo $data['profession']; ?></td>
					<td><?php echo $data['age']; ?></td>
					<td>
					<?php echo "<a href='update.php?action=update&id=".$data['id']."' >Edit</a>"; ?> || 
					<?php echo "<a href='index.php?action=delete&id=".$data['id']."' onClick='return confirm(\"Are you sure?\")''>Delete</a>"; ?>
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</section>
</div>
	
</body>
</html>