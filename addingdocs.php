<?php //Form to add sub elements

/** @Author :- David Thaxter
*	@Version :- v1.0.1
*	@Date :- 01/02/2016
*	@Description:-
A simple html form to insert sub elements by first creating a value in the sub elements table and then adding one in the sub table.
*/
/*
*test data user id 50
*storage id 1
*should return 5 elemets
to implement user name retrival workspaceretrival module returival
*/
if(isset($_POST["Name"]))
{
	echo $_POST["moduleList"];
	echo $_POST["Name"];
	echo $_POST["Description"];
	echo $_POST["Deadline"];
	echo $_POST["start"];
	echo $_POST["location"];
	echo $_POST["starttime"];
	echo $_POST["endtime"];
	echo $_POST["typeList"];
	
	$conn = new PDO('mysql:host=localhost;dbname=studentware', 'studentware', 'studentware');
	
	$stmt = $conn->prepare("INSERT INTO sub_elements (:module_id,:name,:description)");
	$stmt->bindParam(':module_id', $_POST["moduleList"]);
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':description', $name);
	$stmt->execute();
	
	$stmt2 = $conn->prepare("SELECT element_id FROM sub_elements WHERE module_id = :module_id, name = :name, description = :description");
	$stmt2->bindParam(':module_id', $_POST["moduleList"]);
	$stmt2->bindParam(':name', $name);
	$stmt2->bindParam(':description', $name);
	$stmt2->execute();
	$result = $stmt2 -> fetch();
	$reminder_id = $result["element_id"];
	
	switch($_POST["typeList"]){
		case "reminder" :
			$stmt = $conn->prepare("INSERT INTO reminder (:reminder_id,:deadline,:start_date)");
			$stmt->bindParam(':reminder_id', $reminder_id);
			$stmt->bindParam(':deadline', $_POST["Name"]);
			$stmt->bindParam(':start_date', $_POST["Description"]);
			$stmt->execute();
			break;
		case "stickynotes" :
			break;
		case "calander" :
			break;
		case "checklist" :
		
			break;
	}
	
}


?>

<form id ="insertform"action="addingdocs.php" method="post">
	<select name="moduleList" form ="insertform">
		<option value="60">60</option>
		<option value="61">61</option>
		<option value="62">62</option>
		<option value="63">63</option>
	</select>
	<p>SubElementName</p><input type="text" name="Name">
	<p>Descrpition</p><input type="text" name="Description">
	<p>Deadline / End Date</p><input type="date" name="Deadline">
	<p>Start Date</p><input type="date" name="start">
	<p>Location</p><input type="text" name="location">
	<p>Start Time</p><input type="time" name="starttime">
	<p>EndTime</p><input type="time" name="endtime">
	<p>type</p>
	<select name="typeList" form ="insertform">
		<option value="reminder">reminder</option>
		<option value="stickynotes">stickynotes</option>
		<option value="calander">calander</option>
		<option value="checklist">checklist</option>
	</select>
	
	
	<input type="submit">
	
</form>