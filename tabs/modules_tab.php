<?php

//include 'delete.php';


$username = mysql_query("SELECT * FROM modules");

$result = mysql_query("SELECT * FROM modules WHERE user_id=" . $_SESSION['user']) or die(mysql_error());


// display data in table
echo "<link href='modules.css' rel='stylesheet' type='text/css'/>";
echo "<table style=' background-color:orange; width:30%; border-collapse: collapse;'>";
echo "<tr><th>Module Name</th> <th></th> <th></th></tr>";

// loop through results of database query, displaying them in the table
while ($row = mysql_fetch_array($result)) {

    // echo out the contents of each row into a table
    echo "<tr>";
    echo '<td>' . $row['module_name'] . '</td>';
    echo '<td><a href="edit.php?id=' . $row['module_id'] . '">Edit</a></td>';
    echo '<td ><a href="tabs/module_delete.php?id=' . $row['module_id'] . '">Delete</a></td>';
    echo "</tr>";
}


// close table>
echo "</table>";

// pagination


// check if the form has been submitted. If it has, start to process the form and save it to the database
if (isset($_POST['submit'])) {
    // get form data, making sure it is valid
    $module_name = mysql_real_escape_string(htmlspecialchars($_POST['module_name']));
    //$getid = mysql_query("INSERT INTO modules (module_id) SELECT module_id FROM accounts");

    $user_id = ($_SESSION['user']);

    // check to make sure both fields are entered
    if ($module_name == '') {
        // generate error message
        $error = 'ERROR: Please fill in all required fields!';

        // if either field is blank, display the form again
        //renderForm($module_name, $error);
        echo "You need to submit a word";
        return false;
    } else {


        // save the data to the database
        mysql_query("INSERT modules SET  module_name='$module_name', user_id='$user_id'    ")
        or die(mysql_error());


        // once saved, redirect back to the view page
        header("Location: homepage.php");
    }
} else // if the form hasn't been submitted, display the form
{
    //renderForm('','','');
}


?>