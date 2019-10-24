<?php
include "db.php";
// First we check if the Form was Submited
if(isset($_POST["add"])){
    $Firstname = htmlspecialchars($_POST["Firstname"]);
    $Lastname = htmlspecialchars($_POST["Lastname"]);
    $insertStament = "Insert into Gupta (Firstname,Lastname) values ('$Firstname','$Lastname')";
    $insertSuccess = $db->query($insertStament);
    // Then we check if the User was Successfully inserted into the table
    if($insertSuccess){
        header("Location: home.php");
    }else {
        Echo "Error Inserting User: ".$Firstname." ".$Lastname;
    }

}


?>