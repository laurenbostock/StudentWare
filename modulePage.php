<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
  header("Location: index.php");
}

if(!isset($_GET['module']))
{

 $stmt = $conn->prepare("SELECT * FROM module WHERE user_id = :userid");
 $stmt->bindValue(':userid', $_SESSION['user']);
 $stmt->execute();

 if ($modules = $stmt->fetch(PDO::FETCH_OBJ)) {
  $moduleid = $modules->module_id;
 }
}
else {
$moduleid = $_GET['module'];
}

$stmt = $conn->prepare("SELECT workspace_id FROM modules where module_id = :moduleid");
$stmt->bindValue(':moduleid', $moduleid);
$stmt->execute();

 if ($modules = $stmt->fetch(PDO::FETCH_OBJ)) {
  $workspaceid = $modules->workspace_id;
 }


?>

<!DOCTYPE HTML>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
     <link rel="stylesheet" type="text/css" href="css/style.css"/>
     <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
     <title>StudentWare Homepage</title> 
  </head>
  <body>
      <div class="row top">
        <img src="images/logo.png"/>
        <a href="logout.php?logout"><i class="fa fa-sign-out fa-4x topIcon"></i></a>
        <a href="#"><i class="fa fa-cog fa-4x topIcon"></i></a>
        <a href="#"><i class="fa fa-paint-brush fa-4x topIcon"></i></a>
      </div>
      <div class="navPane">
          <div class="navbar navbar-default navTest" role="navigation">
              <ul class="nav navbar-nav">
                <?php
                     echo "<li><a href='homepage.php?workspace=".$workspaceid."'>Home</a></li>";
                     $stmt = $conn->prepare("SELECT * FROM modules WHERE workspace_id=:workspace_id");
                     $stmt->bindValue(':workspace_id', $workspaceid);
                     $stmt->execute();  

                    //loop through results of database query, displaying them in the table
                     while($modules=$stmt->fetch(PDO::FETCH_OBJ)) { 
                       echo "<li><a href='modulePage.php?module=".$modules->module_id."'>".$modules->module_name."</a></li>";
                      }
                  ?>
                <li><a href="#">Lecture Notes</a></li>
              </ul>
          </div>
      </div>
    <div class="container text-center">
      <div class="row">
        </div>
        <div class="row">
        <div class="col-md-6">
             <div class="thumbnail">
                 <h3>Module Checklist</h3>
             </div>
       </div>
        <div class="col-md-6">
              <div class="thumbnail">
                  <h3>Module Documents</h3>
             </div>
       </div>
       </div>
       <div class="row">
       <div class="col-md-12">
             <div class="thumbnail">
                 <h3>StickyNotes</h3>  
             </div>
       </div>
    </div>
  </div>

</body>
</html>