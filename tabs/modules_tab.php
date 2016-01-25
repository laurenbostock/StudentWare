<?php
$user_id = $_SESSION['user'];

$stmt = $conn->prepare("SELECT * FROM modules WHERE user_id=:user_id");
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();

// display data in table
echo "<table style='background-color:orange; width:30%; border-collapse: collapse;'>";
echo "<tr><th>Module Name</th></tr>";

// loop through results of database query, displaying them in the table
 while($modules=$stmt->fetch(PDO::FETCH_OBJ)) {
		// echo out the contents of each row into a table
		echo '<tr><td>' . $modules->module_name . '</td>';
		echo "<form method='POST'>";
   		echo "<td><a href='?delete=".$modules->module_id."'>Delete</a></td>";
   		echo "<td><a href='?edit'>Edit</a></td></td>";
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

  //check if the set variable exists
    if (isset($_GET['delete']))
    {
    	$id = $_GET['delete'];
    	echo "$id";
        $stmt=$conn->prepare("DELETE * FROM modules WHERE module_id=:id");
        $stmt->bindValue(':id', $id);
		$stmt->execute();
    }

function delete($id) {
	
}

function edit() {
} 

?>
