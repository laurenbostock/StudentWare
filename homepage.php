<?php
session_start();
require_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
  header("Location: index.php");
}

//create new workspace
if(isset($_POST['workspaceSubmit']))
{
  $name = $_POST['wName'];

  $stmt=$conn->prepare("INSERT INTO workspace VALUES (NULL, :wname, :userid)");
  $stmt->bindValue(':wname', $name);
  $stmt->bindValue(':userid', $_SESSION['user']);
  $stmt->execute();
  $workspaceid = $conn->lastinsertId();
}

if(!isset($_GET['workspace']))
{

 $stmt = $conn->prepare("SELECT * FROM workspace WHERE user_id = :userid");
 $stmt->bindValue(':userid', $_SESSION['user']);
 $stmt->execute();

 if ($workspaces = $stmt->fetch(PDO::FETCH_OBJ)) {
  $workspaceid = $workspaces->workspace_id;
 }
 else {
  $workspaceid = null;
 }
}
else {
$workspaceid = $_GET['workspace'];
}

if(isset($_POST['addModule']))
{
  $modulename = $_POST['module_name'];
  // Put the module into the database
    $stmt=$conn->prepare("INSERT INTO modules VALUES (NULL, :module_name, :workspaceid)");
    $stmt->bindValue(':workspaceid', $workspaceid);
    $stmt->bindValue(':module_name', $modulename);
    $stmt->execute();
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
                <li><a href="#">Module 1</a></li>
                <li><a href="#">Module 2</a></li>
                <li><a href="#">Module 3</a></li>
                <li><a href="#">Module 4</a></li>
              </ul>
          </div>
      </div>
    <div class="container text-center">
      <div class="row">
        <?php if ($workspaceid == null) {
         echo "You have no workspaces, please create one.";
       }
       else { ?>
        <div class="select">
        <p>Select Workspace:</p>
        <div class="dropdown">
          <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            Dropdown
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
          <?php
            $stmt = $conn->prepare("SELECT * FROM workspace WHERE user_id = :userid");
            $stmt->bindValue(':userid', $_SESSION['user']);
            $stmt->execute();

            while ($workspaces = $stmt->fetch(PDO::FETCH_OBJ)) {
              echo "<li><a href='homepage.php?workspace=".$workspaces->workspace_id."'>".$workspaces->workspace_name."</a></li>";
            }
          ?>
          </ul>
        </div>
        </div>
        <?php } ?>
         <div class="newWorkspace">
         <form action="" method="POST">
            <input type="text" name="wName" placeholder="Workspace name">
            <button type="submit" name="workspaceSubmit" class="btn btn-success"><i class="fa fa-plus"></i></button>
         </form> 
          </div>
        </div>
       <?php if ($workspaceid != null) { ?>
        <div class="row">
        <div class="col-md-6">
             <div class="thumbnail">
                 <h3>My Timetable</h3>
             </div>
       </div>
        <div class="col-md-6">
              <div class="thumbnail">
                  <h3>My Reminders</h3>
             </div>
       </div>
       </div>
       <div class="row">
       <div class="col-md-6">
             <div class="thumbnail">
                 <h3>My Modules</h3>  
                 <form action="" method="POST">
                    <input type="text" name="module_name" placeholder="Module name"/>
                    <button type="submit" name="addModule" class="btn btn-success"><i class="fa fa-plus"></i></button>
                    <button type="submit" name="deleteModule" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                  
                 <?php
                     $stmt = $conn->prepare("SELECT * FROM modules WHERE workspace_id=:workspace_id");
                     $stmt->bindValue(':workspace_id', $workspaceid);
                     $stmt->execute();  

                    //loop through results of database query, displaying them in the table
                     while($modules=$stmt->fetch(PDO::FETCH_OBJ)) { 
                      echo "<div class='checkbox'>";
                      echo "<label>";
                      echo"<input type='checkbox' name='moduleCheck[]' value='".$modules->module_id."'>".$modules->module_name;
                      echo"</label>";
                      echo"</div>";
                    } 

                    if(isset($_POST['deleteModule']))
                    {
                      $moduleToDelete = $_POST['moduleCheck'];
                      $N = count($moduleToDelete);

                      for($i=0; $i < $N; $i++)
                      {
                         $stmt = $conn->prepare("DELETE FROM modules WHERE workspace_id=:workspace_id AND module_id=:module_id");
                         $stmt->bindValue(':module_id', $moduleToDelete[$i]);
                          $stmt->bindValue(':workspace_id', $workspaceid);
                         $stmt->execute();  
                      }
                    }
                  ?>

                </form>
             </div>
       </div>
       <div class="col-md-6">
          <div class="thumbnail">
              <h3>My Calendar</h3>
          </div>
      </div>
    </div>
    <?php } ?>
  </div>

</body>
</html>