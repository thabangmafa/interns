<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('Name', 'Relationship', 'Telephone');

$query = "SELECT * FROM `References` WHERE UserID = '".$_SESSION['id']."'";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 AND (Name LIKE "%'.$_POST["search"]["value"].'%" || Relationship LIKE "%'.$_POST["search"]["value"].'%" || Telephone LIKE "%'.$_POST["search"]["value"].'%")';
}

if(isset($_POST["rowid"]))
{
 $query .= '
 AND ID = "'.$_POST["rowid"].'" ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY Name ASC ';
}

$query1 = '';

if(@$_POST["length"] != -1 && !isset($_POST["rowid"]))
{
 $query1 = 'LIMIT ' . @$_POST['start'] . ', ' . @$_POST['length'];
}

$result = mysqli_query($conn,$query. $query1);



$data = array();


if(isset($_POST["rowid"]) && $_POST["rowid"] == '000')
{
				echo '<div class="row"><div class="message"></div>';
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Name">Name of Referee <span style="color:red">*</span></label>
							<input type="text" id="Name" class="form-control"
								 name="Name">
						</div>
					</div>';
					
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Relationship">Relationship to you <span style="color:red">*</span></label>
							<input type="text" id="Relationship" class="form-control"
								 name="Relationship">
						</div>
					</div>';
					
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Telephone">Telephone Number <span style="color:red">*</span></label>
							<input type="number" maxlength="10" id="Telephone" class="form-control"
								 name="Telephone">
						</div>
					</div>';
					
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Email">Email <span style="color:red">*</span></label>
							<input type="email" id="Email" class="form-control"
								 name="Email">
						</div>
					</div>';
					
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Organisation">Organisation <span style="color:red">*</span></label>
							<input type="text" id="Organisation" class="form-control"
								 name="Organisation">
						</div>
					</div>';
			echo '</div>';
			exit;
}



if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	while($row = mysqli_fetch_array($result))
	{
		echo '<div class="row">';
		echo '<input type="hidden" id="ID" class="form-control" name="ID" value="' . $row["ID"] . '">';
							echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Name">Name of Referee</label>
							<input type="text" id="Name" class="form-control"
								 name="Name" value="'.$row["Name"].'">
						</div>
					</div>';
					
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Relationship">Relationship to you</label>
							<input type="text" id="Relationship" class="form-control"
								 name="Relationship" value="'.$row["Relationship"].'">
						</div>
					</div>';
					
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Telephone">Telephone Number</label>
							<input type="number" id="Telephone" class="form-control"
								 name="Telephone" maxlength="10" value="'.$row["Telephone"].'">
						</div>
					</div>';
					
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Email">Email</label>
							<input type="email" id="Email" class="form-control"
								 name="Email" value="'.$row["Email"].'">
						</div>
					</div>';
					
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Organisation">Organisation</label>
							<input type="text" id="Organisation" class="form-control"
								 name="Organisation" value="'.$row["Organisation"].'">
						</div>
					</div>';
				echo '</div>';
	}
	exit;
}


while($row = mysqli_fetch_array($result))
{
 	
 $sub_array = array();
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Name">' . $row["Name"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Relationship">' . $row["Relationship"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Telephone">' . $row["Telephone"] . '</div>';
  $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Email">' . $row["Email"] . '</div>';
  $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Organisation">' . $row["Organisation"] . '</div>';
	$sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["ID"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div>';
 $data[] = $sub_array;
}



function get_all_data($conn)
{
 $query = "SELECT * FROM `References` where UserID = '".$_SESSION['id']."'";
 //echo $query;
 $result = mysqli_query($conn,$query);
 return $result->num_rows;
}

$output = array(
 "draw"    => intval(@$_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $result->num_rows,
 "data"    => $data
);

echo json_encode($output);
CloseCon($conn);
?>