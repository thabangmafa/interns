<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('Language', 'Speak', 'Read', 'Write');

$query = "SELECT a.ID, b.Name as Language, c.Name as `Read`, d.Name as `Write`, e.Name as `Speak` FROM `LanguageProficiency` a 
LEFT JOIN LookupLanguages b on b.ID = a.Language
LEFT JOIN LookupProficiency c on c.ID = a.Read
LEFT JOIN LookupProficiency d on d.ID = a.Write
LEFT JOIN LookupProficiency e on e.ID = a.Speak
WHERE UserID = '".$_SESSION['id']."'";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 AND (b.Name LIKE "%'.$_POST["search"]["value"].'%")';
}

if(isset($_POST["rowid"]))
{
 $query .= '
 AND a.ID = "'.$_POST["rowid"].'" ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY b.Name ASC ';
}

$query1 = '';

if(@$_POST["length"] != -1 && !isset($_POST["rowid"]))
{
 $query1 = 'LIMIT ' . @$_POST['start'] . ', ' . @$_POST['length'];
}


$result = mysqli_query($conn,$query. $query1);

$LookupLanguages = mysqli_query($conn,"SELECT distinct * FROM LookupLanguages WHERE IsActive = '1'");

while($Languages = mysqli_fetch_array($LookupLanguages))
	{
		$Language[] = $Languages;
	}
	
$LookupProficiency = mysqli_query($conn,"SELECT distinct * FROM LookupProficiency WHERE IsActive = '1'");

while($Proficiency = mysqli_fetch_array($LookupProficiency))
	{
		$Prof[] = $Proficiency;
	}

$data = array();


if(isset($_POST["rowid"]) && $_POST["rowid"] == '000')
{
				echo '<div class="row">';
						echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Speak">Language</label>
							<fieldset class="form-group">
						<select class="form-select" name="Language" id="Language">' ?>

						<?php foreach ($Language as $sta){ 
						
						echo '<option value="'.$sta['ID'].'">'.$sta['Name'].'</option>'; 
						} 
						
						echo '
						</select>
					</fieldset>
						</div>
					</div>';
					
							echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Speak">Speak</label>
							<fieldset class="form-group">
						<select class="form-select" name="Speak" id="Speak">' ?>

						<?php foreach ($Prof as $sta){ 

						echo '<option value="'.$sta['ID'].'">'.$sta['Name'].'</option>'; 
						} 
						
						echo '
						</select>
					</fieldset>
						</div>
					</div>';
			
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="last-name-column">Read</label>
							<fieldset class="form-group">
						<select class="form-select" name="Read" id="Read">' ?>

						<?php foreach ($Prof as $sta){ 

						echo '<option value="'.$sta['ID'].'">'.$sta['Name'].'</option>'; 
						} 
						
						echo '
						</select>
					</fieldset>
						</div>
					</div>';
			
					echo '<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="last-name-column">Write</label>
							<fieldset class="form-group">
								<select class="form-select" name="Write" id="Write">' ?>

								<?php foreach ($Prof as $sta){ 

								echo '<option value="'.$sta['ID'].'">'.$sta['Name'].'</option>'; 
								} 
								
								echo '
								</select>
						</fieldset>
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
					<label for="Speak">Language</label>
					<fieldset class="form-group">
				<select class="form-select" name="Language" id="Language">' ?>

				<?php foreach ($Language as $lang){ 
				$selected = '';
				if($lang['Name'] == $row["Language"]){ $selected = "selected='selected'"; }
				echo '<option value="'.$lang['ID'].'" '.$selected.'>'.$lang['Name'].'</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
					
					echo '<div class="col-md-6 col-12">
				<div class="form-group">
					<label for="Speak">Speak</label>
					<fieldset class="form-group">
				<select class="form-select" name="Speak" id="Speak">' ?>

				<?php foreach ($Prof as $sta){ 
				$selected = '';
				if($sta['Name'] == $row["Speak"]){ $selected = "selected='selected'"; }
				echo '<option value="'.$sta['ID'].'" '.$selected.'>'.$sta['Name'].'</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
			
			echo '<div class="col-md-6 col-12">
				<div class="form-group">
					<label for="last-name-column">Read</label>
					<fieldset class="form-group">
				<select class="form-select" name="Read" id="Read">' ?>

				<?php foreach ($Prof as $sta){ 
				$selected = '';
				if($sta['Name'] == $row["Read"]){ $selected = "selected='selected'"; }
				echo '<option value="'.$sta['ID'].'" '.$selected.'>'.$sta['Name'].'</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
			
			echo '<div class="col-md-6 col-12">
				<div class="form-group">
					<label for="last-name-column">Write</label>
					<fieldset class="form-group">
				<select class="form-select" name="Write" id="Write">' ?>

				<?php foreach ($Prof as $sta){ 
				$selected = '';
				if($sta['Name'] == $row["Write"]){ $selected = "selected='selected'"; }
				echo '<option value="'.$sta['ID'].'" '.$selected.'>'.$sta['Name'].'</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
			echo '</div>';
	}
	exit;
}


while($row = mysqli_fetch_array($result))
{
 	
 $sub_array = array();
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Language">' . $row["Language"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Speak">' . $row["Speak"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Read">' . $row["Read"] . '</div>';
  $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Write">' . $row["Write"] . '</div>';
	$sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["ID"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div>';
 $data[] = $sub_array;
}



function get_all_data($conn)
{
 $query = "SELECT a.ID, b.Name as Language, c.Name as `Read`, d.Name as `Write`, e.Name as `Speak` FROM `LanguageProficiency` a 
LEFT JOIN LookupLanguages b on b.ID = a.Language
LEFT JOIN LookupProficiency c on c.ID = a.Read
LEFT JOIN LookupProficiency d on d.ID = a.Write
LEFT JOIN LookupProficiency e on e.ID = a.Speak
 where UserID = '".$_SESSION['id']."'";

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