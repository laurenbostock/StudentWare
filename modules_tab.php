
<?php
$user_id = $_SESSION['user'];

$stmt = $conn->prepare("SELECT * FROM Modules WHERE user_id=:user_id");
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();

// display data in table
echo "<link href='modules.css' rel='stylesheet' type='text/css'/>";
echo "<table style='background-color:orange; width:30%; border-collapse: collapse;'>";
echo "<tr><th>Module Name</th></tr>";

// loop through results of database query, displaying them in the table
 while($modules=$stmt->fetch(PDO::FETCH_OBJ)) {
		// echo out the contents of each row into a table
		echo '<tr><td>' . $modules->module_name . '</td>';
		echo "<form method='POST'>";
   		echo "<td><input type='button' name='Delete' value='Delete'/></td>";
   		echo "<td><input type='button' name='Edit' onclick='displayedit()' value='Edit'/></td>";
		echo"</form></tr>";
	} 
	// close table>
	echo "</table>"; 
	
	// check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 	$module_name = $_POST['module_name'];
 
 	// check to make sure both fields are entered
 	if ($module_name == '') {
		echo "You need to submit a word";
 		return false;
	 }
	 else
	 {
		 // Put the module into the database
		$stmt=$conn->prepare("INSERT INTO Modules VALUES (NULL, :module_name, :user_id)");
		$stmt->bindValue(':user_id', $user_id);
		$stmt->bindValue(':module_name', $module_name);
		$stmt->execute();
 	}
 }

function delete() {

 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 // delete the entry
 $result = mysql_query("DELETE FROM modules WHERE module_id =$id")
 or die(mysql_error());

echo"data deleted"; 
} 
}

function displayedit() {
		echo '<tr><td>' . $modules->module_name . '</td>';
		echo "<form method='POST'>";
   		echo "<td><input type='text' name='ModuleName'><input type='text' name='ModuleID'value='. $modules->module_id . '></td>";
   		echo "<td><input type='button' name='Update' onclick='edit' value='Update'/></td>";
		echo"</form></tr>";
} 

function edit()
{
	$module_name = $_GET['ModuleName'];
	$module_id = $_GET['ModuleID'];
	
	$stmt=$conn->prepare("UPDATE Modules SET module_name = ':module_name' WHERE module_id =':module_id'");
		$stmt->bindValue(':module_id', $module_id);
		$stmt->bindValue(':module_name', $module_name);
		$stmt->execute();
}
?>
