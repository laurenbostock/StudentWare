<?php
try{
       $conn = new PDO('mysql:host=localhost;dbname=studentware', 'studentware', 'studentware');
}
catch (PDOException $exception) 
{
	echo "Oh no, there was a problem" . $exception->getMessage();
}
?>