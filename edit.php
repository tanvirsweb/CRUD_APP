
<?php
    include "CrupApp_DatabaseConnection.php";
    $objCrudAdmin=new CrudApp();

    if(isset($_POST['add_info'])){
        $return_msg=$objCrudAdmin->update_data($_POST);
        header('Location:CRUD.php');        
        // go to another page
    }
    if(isset($_GET['status'])){
        // did we receive variable 'status'
        if($_GET['status']=='edit'){
            // check value of variable 'status'
            $id=$_GET['id'];
            $returndata=$objCrudAdmin->display_data_by_id($id);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Edit</title>
    <link rel="stylesheet" href="Bootstrap5/bootstrap.min.css" type="text/css">
</head>
<body>
    <div class="container my-4 p-4 shadow">
        <h2><a class="nav-link" href="CRUD.php">Student Database</a></h2>
        <form class="form" action="" method="post" enctype="multipart/form-data">
        
            <?php if(isset($return_msg)){ echo $return_msg;} ?>

            <input type="text" name="std_name" value="<?php echo $returndata['std_name']; ?>" class="form-control mb-2" required>
            <input type="number" name="std_roll" value="<?php echo $returndata['std_roll']; ?>"  class="form-control mb-2" required>
            <label for="std_img_id">Upload Your Image</label>
            <input type="file"
            name="std_img" 
            id="std_img_id" class="form-control mb-2" required>

            <input type="hidden" value="<?php echo $_GET['previmg']?>" name="previmg" class="form-control bg-warning">
            <input type="hidden" value="<?php echo $id?>" name="u_id" class="form-control bg-warning">

            <input type="submit" name="add_info" class="form-control bg-warning">
        </form>
    </div>
    
</body>
</html>
