 <?php
$db = new Mysqli;
$db->connect('localhost','root','','crud3');
// Checking connection string
 if(!$db){
    echo "Error ,No Connection";
 }
 
 ?>