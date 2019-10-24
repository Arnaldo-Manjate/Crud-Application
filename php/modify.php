<?php 

include "db.php";
 
$ID = (int)$_GET["ID"];
$SingleUserStatement ="SELECT * from Gupta where ID=$ID limit 1";
$querySuccess= $db->query($SingleUserStatement);
// Check if the query returned User
if($querySuccess){
    $singleUser = $querySuccess->fetch_assoc();
    $Firstname = $singleUser["Firstname"];
    $Lastname = $singleUser["Lastname"];
    // Collecting The Edited Fields from the Update form
    if(isset($_POST["send"])){
        $updatedFirstname = htmlspecialchars($_POST["Firstname"]);
        $updatedLastname = htmlspecialchars($_POST["Lastname"]);
        $updateStatement = "Update Gupta set Firstname='$updatedFirstname',Lastname='$updatedLastname' where ID='$ID'";
        // performing the update Statement
        $updateSuccess = $db->query($updateStatement);
        if($updateSuccess){
            header("location: home.php");
        }else{
            echo "Error Updating User : ".$Firstname." ".$Lastname."";
        }
    }
}else{
    echo "No User With the ID of ".$ID." was returned";
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <title>To Do List</title>
</head>
<body>
    <center><h1>Update User</h1></center>
    <div class=" " style="transform: translateX(9%);margin-top: 120px;">
        <form method="post" class="" style="text-align:center;width:80%;">
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Firstname</label>
                <input name="Firstname" type="text" class="form-control" id="recipient-name" value="<?php echo $Firstname ?>">
            </div>
            <div class="form-group">
                <label for="recipient-name" class="col-form-label">Latsname</label>
                <input name="Lastname" type="text" class="form-control" id="recipient-name" value="<?php echo $Lastname ?>">
            </div>
            <input class="btn btn-primary" type="submit" name="send" value="Save" >
            <button class="btn btn-danger" ><a href="home.php" style="color:white;">Close</a></button>
        </form>
    </div>
  
  
   <!-- canvas -->
   <script src="../js/jquery-3.4.1.min.js"></script>
   <script src="../js/bootstrap.min.js"></script>
</body>
</html>
