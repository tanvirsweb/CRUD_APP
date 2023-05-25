
<?php
    include "CrupApp_DatabaseConnection.php";
    $objCrudAdmin=new CrudApp();

    if(isset($_POST['add_info'])){
        $return_msg=$objCrudAdmin->add_data($_POST);
    }

    $students=$objCrudAdmin->display_data();
    if(isset($_GET['status'])){
        if($_GET['status']=='delete'){
            $delete_id=$_GET['id'];
            $msgDel=$objCrudAdmin->delete_data_by_id($delete_id);
            header("Refresh:0; url=CRUD.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link rel="stylesheet" href="Bootstrap5/bootstrap.min.css" type="text/css">
</head>
<body>
    <div class="container my-4 p-4 shadow">
        <h2><a class="nav-link" href="index.php">Student Database</a></h2>
        <form class="form" action="" method="post" enctype="multipart/form-data">
        
            <?php if(isset($return_msg)){ echo $return_msg;} ?>

            <input type="text" name="std_name" placeholder="Enter your name" class="form-control mb-2" required>
            <input type="number" name="std_roll" placeholder="Enter your roll" class="form-control mb-2" required>
            <label for="std_img_id">Upload Your Image</label>
            <input type="file"
            name="std_img" 
            id="std_img_id" class="form-control mb-2">
            <input type="submit" value="Add Information " name="add_info" class="form-control bg-warning" required>
        </form>
    </div>
    <div class="container my-4 p-4 shadow">
        <table class="table table-responsive">
        
            <thead>
                <tr>
                    <th>ID</th><th>Name</th><th>Roll</th><th>Image</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($student=mysqli_fetch_assoc($students)){ 
                ?>
                <tr>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['std_name']; ?></td>
                    <td><?php echo $student['std_roll']; ?></td>
                    <td>
                        <img style="height:100px" src="upload/<?php echo $student['std_img'];?>"> 
                    </td>                        
                    <td>
                        <a href="edit.php?status=edit&&id=<?php echo $student['id']; ?>&&previmg=<?php echo $student['std_img'];?>" class="btn btn-success">Edit</a>
                        <!-- take in edit.php file
                        passed parameter while going in new webpage
                        status=edit
                        id=...
                        -->
                        <a href="?status=delete&&id=<?php echo $student['id']; ?>" class="btn btn-warning">Delete</a>
                        <!-- stay in this page but delete this tuple -->
                    </td>
                </tr>
                <?php 
                }
                // end of while loop
                ?>
            </tbody>
        </table>
    </div>
    
</body>
</html>
