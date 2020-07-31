<?php
	session_start();
	if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
		header("location: frontpage.php");
		exit;
	}
	if(time()-$_SESSION["login_time_stamp"] >1800)   
    { 
        session_unset(); 
        session_destroy(); 
        header("Location:frontpage.php"); 
    } 
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Registration Form</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="assets/css/form_style.css">
		<link href="assets/css/footer.css" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <!-- Bootstrap CSS -->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    	<title>Welcome-<?php $_SESSION['username']?></title>
  	</head>
  	<body>
		<?php require 'header2.html'?>		
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$camp = $_POST['camp'];
				global $name ;
				global $Id ;
				$name = $_POST['name'];
				$Id = $_POST['Id'];
				$year = date("Y"); 
			//      mkdir($year);
			//  mkdir("$year/$camp");
				if (!file_exists("$year/$camp")) {
					mkdir("$year/$camp");
				}
				function get_data()
				{
					$datae=array();
					$datae[]=array(
						'Id' => $_POST['Id'],
						'Name' => $_POST['name'],
						'class' => $_POST['class'],
						'school' => $_POST['school'],
						'camp' => $_POST['camp'],
						'contact' => $_POST['number'],
						'Gender' => $_POST['gender'],
						'DOB' => $_POST['dob'],
						'Fathers_Name' => $_POST['fatherName'],
						'Fathers_Occupation' => $_POST['fatherOccupation'],
						'Mothers_Name' => $_POST['motherName'],
						'Mothers_Occupation' => $_POST['motherOccupation']
					);
        		return json_encode($datae);
    		}

			$file_name=$name . '_' . $Id . '.txt';
			if(file_put_contents("$year/$camp/$file_name",get_data()))
			{
			echo '<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<p>Details added succesfully</p>
					</div>';
			}
				
			else
			{
				echo 'There is some error';
				
			}
		}
	?>
      
    <script>
    	setTimeout(function(){ 
            $('.alert alert-success').fadeIn('slow'); 
        	}, 5000);
    </script>
      
<!-- Registration -->
	<div class="container">
		<h1>Registration Form</h1>
		<form action="form2.php" method="post">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inpname" class="control-label">Full Name:</label>
							<input 
								type="text"
								class="form-control"
								id="inpname"
								name="name"
								required
							/>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<label for="inpgender" class="control-label" required>Gender:</label>
						<div>
							<label for="inpmale" class="radio-inline">
								<input
									type="radio"
									name="gender"  
									value="gender"
									id="inpmale"
								/>
							Male</label>
							<label for="inpfemale" class="radio-inline">
								<input
									type="radio"
									name="gender"
									value="gender"
									id="inpfemale"
								/>
							Female</label>
						</div>
					</div>
				</div>
			</div>
				<div class="row">
					<div class="col-xs-6">
						<label for="inpdob" class="control-label" required>Date Of Birth:</label>
						<input
							type="date"
							class="form-control"
							id="inpdob"
							name="dob"
						/>
					</div>
					<div class="col-xs-6">
						<div class="form-group">
							<label for="inpId" class="control-label">Id:</label>
							<input
								type="text"
								class="form-control"
								id="inpId"
								name="Id"
								placeholder="LDL Id"
							/>
						</div>						
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">							
							<label for="inpclass" class="control-label" >Class:</label>
							<input required
								type="text"
								class="form-control"
								id="inpclass"
								name="class"
								placeholder="eg. 2"
								title="Please add class accordingly"
							/>
						</div>						
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="inpschool" class="control-label">School:</label>
							<input
								type="text"
								class="form-control"
								id="inpschool"
								name="school"
							/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="selectcamp" class="control-label">Camp:</label>
							<select id="selectcamp" name="camp" class="form-control" required>
								<option>Samrat Chowk</option>
								<option>Sarvoday Nagar	</option>
								<option>RKGIT</option>
								<option>Charmurti</option>
								<option>Fortis</option>
								<option>Nursery Kids</option>
								<option>Kaushambi</option>
								<option>Mari Mata Temple</option>
								<option>Unnati</option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="inpnumber">Phone Number:</label>
							<input
								type="number"
								class="form-control"
								id="inpnumber"
								name="number"
								pattern="[0-9]{3}[0-9]{2}[0-9]{3}[0-9]{2}" 
								required
							/>
						</div>
					</div>
				</div>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="inpfatherName">Father's Name:</label>
								<input required
									type="text"
									class="form-control"
									id="inpfatherName"
									name="fatherName"
								/>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
							<label for="inpfatherOccupation">Father's Occupation:</label>
							<input
								type="text"
								class="form-control"
								id="inpfatherOccupation"
								name="fatherOccupation"
							/>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="inpmotherName">Mother's Name:</label>
							<input required
								type="text"
								class="form-control"
								id="inpmotherName"
								name="motherName"
							/>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="inpmotherOccupation">Mother's Occupation:</label>
							<input
								type="text"
								class="form-control"
								id="inpmotherOccupation"
								name="motherOccupation"
							/>
						</div>
					</div>
				</div>
				<br>
				<div class="form-group" id="button">
					<input type="Submit" class="btn btn-primary" />&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="button" name="Get Details" class="btn btn-primary" onclick='document.location="getdetails.php"'>Get Details</button>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
				</div>
			</form>
		</div>
		<?php require 'footer.html'?>
    </body>
</html>
