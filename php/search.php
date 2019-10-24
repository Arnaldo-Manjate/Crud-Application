<?php
 include "db.php";

if(isset($_POST["search"])){
    $search = htmlspecialchars($_POST["search"]);
    $searchStatement = "Select * from Gupta where (Firstname like '%$search%') or (Lastname like '%$search%')";
    $searchResult = $db->query($searchStatement);

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
            <form method="post" action="search.php" class="form-group" >
                <input type="text" name="search" class="form-control"  style="width:80%;transform:translateX(12%);position:absolute;z-index:1000;" >
            </form>
        </div>
        
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
            <?php if( mysqli_num_rows($searchResult) < 1 ): ?>
            <div style="transform: translateX(54%)">
                <h2 style="background-color:red;color:white;text-align:center">No User Found<!/h2>
                <div style="align">
                    <a href="home.php" class="btn btn-danger" style="text-align:center;transform:translateX(100%);height:50px;background-color:white;color:black;transform: translateX(-6%);">Back</a>
                </div>
                
            </div>
            <?php else : ?>
        <!-- End Of Search Input-->
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
                    <?php while($user = $searchResult->fetch_assoc()): ?>
                        <th scope="row"><?php echo $user["ID"]?></th>
                        <td><?php echo $user["Firstname"]?></td>
                        <td><?php echo $user["Lastname"] ?></td>
                        <td class="btn btn-danger" style="color:white;float:right;"><a href="remove.php?ID=<?php echo $user["ID"] ?>" style="color:white;">Delete</a></td>
                        <td class="btn btn-primary" style="color:white;float:right;"><a href="modify.php?ID=<?php echo $user["ID"] ?>" style="color:white;">Edit</a></td>
                    </tr>
                    <?php endwhile;?>
                </tbody>
    <?php endif;?>
            </table>

        </div>
       
  
   <!-- canvas -->
   <script src="../js/jquery-3.4.1.min.js"></script>
   <script src="../js/bootstrap.min.js"></script>
</body>
</html>