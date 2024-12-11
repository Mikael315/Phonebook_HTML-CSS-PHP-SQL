<html> 
<head> 
	<meta  http-equiv="Content-Type" content="text/html;  charset=iso-8859-1"> 
	<title>Search  Contacts</title> 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
	<style type="text/css">
		.wrapper{
            width: 650px;
            margin: 0 auto;
			margin-top:50px;
        }
       p {
		   font-size:20px;
	   }
    </style>
</head> 
<body> 
	<div class="wrapper">
	<?php 
		if(isset($_POST['submit'])){ 
			if(isset($_GET['go'])){ 
				if(preg_match("/^[  a-zA-Z]+/", $_POST['name'])){ 
					$name=$_POST['name']; 
					//connect  to the database 
					$db=mysql_connect  ("localhost", "id21003530_bebicmikael", "12345-Bebic") or die ('I cannot connect to the database  because: ' . mysql_error()); 
					//-select  the database to use 
					$mydb=mysql_select_db("id21003530_login"); 
					//-query  the database table 
					$sql="SELECT  id, name, address, marks FROM contacts WHERE name LIKE '%".$name."%' OR address LIKE '%" . $name ."%'"; 
					//-run  the query against the mysql query function 
					$result=mysql_query($sql); 
					//-create  while loop and loop through result set 
					if(mysql_num_rows($result) > 0){
						while($row=mysql_fetch_array($result)){ 
							$Id =$row['id']; 
              $first_name =$row['first_name']; 
							$last_name =$row['last_name']; 
							$address=$row['address'];
							$phone_number=$row['phone_number'];
              $email =$row['email']; 
							//-display the result of the array 
							echo "<table class='table table-bordered table-striped table-hover '>";
								echo "<thead>";
									echo "<tr>";
										echo "<th>#</th>";
										echo "<th>First Name</th>";
                    echo "<th>Last Name</th>";
										echo "<th>Address</th>";
										echo "<th>Phone Number</th>";
										echo "<th>Email</th>";
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
									echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['phone_number'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
									echo "</tr>";
								echo "</tbody>";                            
							echo "</table>";
							echo "<p><a href='contacts.php' class='btn btn-primary'>Back</a></p>";
						} 
					} else {
						echo "<p>No matches found</p>";
						echo "<p><a href='contacts.php' class='btn btn-primary'>Back</a></p>";
					}
				} else { 
					echo  "<p>Please enter a search query</p>"; 
					echo "<p><a href='contacts.php' class='btn btn-primary'>Back</a></p>";
				} 
			} 
		} 
	?> 
	</div>
</body> 
</html> 