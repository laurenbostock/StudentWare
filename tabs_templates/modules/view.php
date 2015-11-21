<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>View Records</title>
</head>
<body>

<?php
/* 
	VIEW.PHP
	Displays all data from 'players' table
*/

// connect to the database
include('db-connect.php');


// get results from database
$result = mysql_query("SELECT * FROM modules")
or die(mysql_error());

echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>Username</th> <th>Module Name</th> <th></th> <th></th></tr>";

// loop through results of database query, displaying them in the table
while ($row = mysql_fetch_array($result)) {

    // echo out the contents of each row into a table
    echo "<tr>";
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['module_name'] . '</td>';
    echo '<td><a href="edit.php?id=' . $row['user_id'] . '">Edit</a></td>';
    echo '<td><a href="delete.php?id=' . $row['user_id'] . '">Delete</a></td>';
    echo "</tr>";
}

// close table>
echo "</table>";

?>
<p><a href="new.php">Add a new record</a></p>

</body>
</html>	