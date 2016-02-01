<?php //display Documents
/** @Author :- David Thaxter
*	@Version :- v1.0.1
*	@Date :- 28/01/2016
*	@para :- $userid - the current users indentifyer.
*	@para :- $storageid - the current workspace.
*	@Description:-
This should display the recent document name dependant on the most recent limmited to 5 records 
and sorted by date.
*/
/*
*test data user id 50
*storage id 1
*should return 5 elemets
to implement user name retrival workspaceretrival module returival
*/

//start php function to display the upcomming events
function displayDocuments($storageid)
{
	echo '<table border ="0">';//start display of table
	
       //bad implementation
	   $conn = new PDO('mysql:host=localhost;dbname=studentware', 'studentware', 'studentware');
	   
	   
       $stmt = $conn->prepare("SELECT  `file_name` ,  `date` FROM  `document` WHERE storage_id =1  ORDER BY  `date` DESC LIMIT 10"); 
       //TO-DO CHANGE THIS TO FUNCTION WORKSPACE!!
       $stmt->bindValue(':storageid', $storageid);
       $stmt->execute();


		// loop through results of database query, displaying them in the table
		
		while($documents=$stmt->fetch(PDO::FETCH_OBJ)) {
			// echo out the contents of each row into a table
			echo'<tr>';	
				// echo into own cell in table
				echo'<td>';
				echo  $documents->file_name;
				echo'</td>';
				echo'<td>';
				echo  $documents->date;
				echo'</td>';
				echo'<td>';
				echo  "view";
				echo'</td>';
				echo'<td>';
				echo  "delete";
				echo'</td>';
			echo'<tr>';	
		}
	echo'</table>';//end display of table
	
}
?>
<?php //delete documents
/** @Author :- David Thaxter
*	@Version :- v1.0.1
*	@Date :- 28/01/2016
*	@para :- $Doucumentid - the current documentid.
*	@para :- $storageid - the current storage.
*	@Description:-
This should remove a document in the database Dependant on the storage id and then remove the document from the server.
*/
/*
*test data user id 50
*storage id 1
*should return 5 elemets
to implement user name retrival workspaceretrival module returival
*/

//start php function to display the upcomming events
function deleteDocuments($storageid,$documentid)
{
	$base_directory = 'documents/';

if(unlink($base_directory.$documentid))
    echo "File Deleted";
}
?>

<?php //Upload Documents
/** @Author :- David Thaxter
*	@Version :- v1.0.1
*	@Date :- 01/02/2016

*	@Description:-
This should enable the user to upload a document by creating a form and enabling them the upload to thier storage
 
*/
/*
*test data user id 50
*test storageid = 1


to implement user name retrival workspaceretrival module returival
*/

//start php function to display the upcomming events
function uploadDocuments()
{
//set storageid in session 

	$base_directory = 'documents/'.'1/'; ///set base directory to users storage location
	echo '<form action="upload.php" method="post" enctype="multipart/form-data">';
    echo 'Select image to upload:';
    echo '<input type="file" name="fileToUpload" id="fileToUpload">';
    echo '<input type="submit" value="Upload Image" name="submit">';
	echo '</form>';

if(unlink($base_directory.$documentid))
    echo "File Deleted";
}
?>





<div class = "col-md-6">
	<div class = "thumbnail">
		Recent Documents
	</div>
	<?php displayDocuments(1); ?>
</div>