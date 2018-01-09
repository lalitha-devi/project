<?php 
include("includes/config.php");
$dep = array();
$query = "select * from departments";
$res = mysql_query($query) or die(mysql_error());
if(mysql_num_rows($res) > 0){ 
	while($row = mysql_fetch_array($res)){
		$dep[] = $row['name']; 
	}
}
if(isset($_POST['submit'])){
	$name = $_POST['uname'];
	$depart = $_POST['dep'];
	$gender = $_POST['gender'];
	$desc = $_POST['desc'];	
	$hobbies = '';
	if($_POST['check_list']){
		foreach($_POST['check_list'] as $selected){
			$hobbies.= "#".$selected;
		}
		$hobbies = ltrim($hobbies,"#");		
	}
	//$_POST['pic']
	$image = $_FILES["pic"]['name'];
	$resp = move_uploaded_file($_FILES["pic"]['tmp_name'],'images/'.$image);
	if($resp){
		echo 'moved';
	}
	}
	
$query = "insert into users set name='$name',department='$depart',gender='$gender',hobbies='$hobbies',description='$desc',profile_image='$image'";
$res = mysql_query($query) or die(mysql_error());
if($res){
	echo 'Form submitted Successfully';
}
?>
<html>
	<head>
		<title>Task</title>
	</head>
	<body>
		<form method="post" enctype="multipart/form-data">
			<table cellpadding="5" cellspacing="10">
				<tr>
					<td>Name</td>
					<td><input type="text" name="uname" id="uname"></td>
				</tr>

				<tr>
					<td>Department</td>
					<td>
						<select name="dep" id="dep">
							<option value="">Select</option>
							<?php
							foreach($dep as $key => $val){?>
								<option value="<?=$val?>"><?=$val?></option
							<?php }
							?>
						</select>

					</td>
				</tr>
				<tr>
					<td>Gender</td>
					<td>
						Male <input type="radio" name="gender" value="Male">
						FMale <input type="radio" name="gender" value="Female">
					</td>									

				</tr>
				<tr>
					<td>Hobbies</td>

					<td>
						Reading Books <input type="checkbox" name="check_list"  value="Reading Books">
						Collecting Coins <input type="checkbox" name="check_list"  value="Collecting Coins">
						Gardening <input type="checkbox" name="check_list"  value="Gardening">
						Listening to Music <input type="checkbox" name="check_list" value="Listening to Music">
					</td>
				</tr>
				<tr>
					<td>Description</td>

					<td><textarea name="desc" id="desc"></textarea></td>
					
				</tr>

				<tr>
					<td>Profile Image</td>

					<td><input type="file" name="pic" id="pic"></td>					
				</tr>				
				<tr>
					<td></td>

					<td><input type="submit" name="submit" value="Submit"></td>
					
				</tr>				
			</table>
		</form>
	</body>
</html>