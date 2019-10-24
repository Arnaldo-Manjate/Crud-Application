<?php
include "db.php";

$DeletedID = (int)$_GET["ID"];

$DeleteStatement = "Delete from Gupta where ID='$DeletedID'";
$deleteSuccess = $db->query($DeleteStatement);
// Check if user was successfull deleted
if( !$deleteSuccess ){
    echo "Error Deleting User with the ID : ".$DeletedID;
}else{
    header("location: home.php");
}

?>