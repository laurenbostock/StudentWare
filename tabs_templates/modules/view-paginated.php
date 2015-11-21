<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>View Records</title>
</head>
<body>

<?php
/* 
	VIEW-PAGINATED.PHP
	Displays all data from 'players' table
	This is a modified version of view.php that includes pagination
*/

// connect to the database
include('db-connect.php');

// number of results to show per page
$per_page = 2;

// figure out the total pages in the database
$result = mysql_query("SELECT * FROM modules");
$total_results = mysql_num_rows($result);
$total_pages = ceil($total_results / $per_page);

// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $show_page = $_GET['page'];

    // make sure the $show_page value is valid
    if ($show_page > 0 && $show_page <= $total_pages) {
        $start = ($show_page - 1) * $per_page;
        $end = $start + $per_page;
    } else {
        // error - show first set of results
        $start = 0;
        $end = $per_page;
    }
} else {
    // if page isn't set, show first set of results
    $start = 0;
    $end = $per_page;
}

// display pagination

echo "<p><a href='view.php'>View All</a> | <b>View Page:</b> ";
for ($i = 1; $i <= $total_pages; $i++) {
    echo "<a href='view-paginated.php?page=$i'>$i</a> ";
}
echo "</p>";

// display data in table
echo "<link href='modules.css' rel='stylesheet' type='text/css'/>";
echo "<table style=' background-color:orange; width:30%; border-collapse: collapse;'>";
echo "<tr style='background-color:gray;'> <th>Module Name</th> <th></th> <th></th></tr>";

// loop through results of database query, displaying them in the table
for ($i = $start; $i < $end; $i++) {
    // make sure that PHP doesn't try to show results that don't exist
    if ($i == $total_results) {
        break;
    }

    // echo out the contents of each row into a table
    echo "<tr style='border-bottom: solid; border-width: 1px 0;'>";
    //	echo '<td>' . mysql_result($result, $i, 'name') . '</td>';
    echo '<td style="position:relative; left:20px; top:1px;">' . mysql_result($result, $i, 'module_name') . '</td>';
    echo '<td style="position:relative; left:50px; bottom:1px;"><a href="edit.php?id=' . mysql_result($result, $i, 'name') . '">Edit</a></td>';
    echo '<td style="position:relative; left:35px; bottom:1px;"><a href="delete.php?id=' . mysql_result($result, $i, 'name') . '">Delete</a></td>';
    echo "</tr>";
}
// close table>
echo "</table>";

// pagination

?>
<p><a href="new.php">Add a new record</a></p>

</body>
</html>