<?php 
include "db.php";

// PAGINATION CALCULATIONS

//
$sql = "select * from Gupta";
$allUsersResult = $db->query($sql);
$numberOfUsers = $allUsersResult->num_rows;
// determine how many Users to display Per Page

$page = (int)(isset($_GET["page"])) ? (int)$_GET["page"]  : 1;
$perPage = (int)(isset($_GET["perPage"])) && (int)($_GET["perPage"]) <= 50 ? (int)$_GET["perPage"] : 5;
$start = (isset($page)) ? ( $page * $perPage ) - $perPage : 0;
$pages = ceil($numberOfUsers / $perPage);

// Select liited Users
$selectStatement = "select * from Gupta order By Lastname limit ".$start.",".$perPage."";
$users = $db->query($selectStatement);
// Check if Users were Returned from the Gupta Table
if(!$users){
    echo "No Users Found In The Gupta Table";
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
        <center><h1>The Gupta List</h1></center>
        <!-- BUTTONS -->
            <div class="button-container">
                <button type="button btn-success" class="btn btn-success" style="float:left;"  data-toggle="modal" data-target="#exampleModal">Add User</button>
                <button class="btn btn-warning" style="float:right;" onclick="print()"> Print List</button>
            </div>

        <br><br>
        <!-- Search Input-->
        <div class="col-md-12 text-center">
            <h5> Search User</h5>
            <form method="post" action="search.php" class="form-group text-center" >
                <input type="text" name="search" class="form-control"  style="width:80%;transform:translateX(12%);position:absolute;z-index:1000;" >
            </form>
        </div>
        <!-- End Of Search Input-->
        <!-- MODAL --> 
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  style="" aria-labelledby="exampleModalLabel" aria-hidden="true">
        `  <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="insert.php">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Firstname</label>
                                <input name="Firstname" type="text" class="form-control" id="recipient-name" value="">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Latsname</label>
                                <input  name="Lastname" type="text" class="form-control" id="recipient-name" value="">
                            </div>
                            <div class="modal-footer">
                                <input name="add" type="submit" class="btn btn-primary" value="Save">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>`
        <!--END OF MODAL --> 
        <!-- MAIN CONTAINER-->
        <div class="container">
            <!-- TABE -->
            <br><br><br><br><br><br>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">UserId</th>
                        <th scope="col">Firstname</th>
                        <th scope="col">Lastname</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php while($user = $users->fetch_assoc()): ?>
                        <th scope="row"><?php echo $user["ID"]?></th>
                        <td><?php echo $user["Firstname"]?></td>
                        <td><?php echo $user["Lastname"] ?></td>
                        <td class="btn btn-danger" style="color:white;float:right;"><a href="remove.php?ID=<?php echo $user["ID"] ?>" style="color:white;">Delete</a></td>
                        <td class="btn btn-primary" style="color:white;float:right;"><a href="modify.php?ID=<?php echo $user["ID"] ?>" style="color:white;" >Edit</a></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
            </table>
                <div class="pagination">
                    <ul class="row" >
                        <?php for( $i = 1; $i <= $pages ; $i++): ?>
                        <li  style="list-style-type:none; text-decoration:none;">
                            <a href="home.php?page=<?php echo $i ?>&perPage=<?php echo $perPage ?>"> <?php echo $i ?></a>
                        </li>
                       
                        <?php endfor; ?>
                    </ul>
                    <br><br>
                </div>
                <h6 style="" class="pagecount"><?php echo $page." of ".$pages ?></h6>
  
        </div>
       
  
   <!-- canvas -->
   <script src="../js/jquery-3.4.1.min.js"></script>
   <script src="../js/bootstrap.min.js"></script>
</body>
</html>