<?php
    include '../../config/config.php';

    $task = new Model();

    if(isset($_POST['submit'])){
        $admin = $task->adminCredentials($_POST);
    }
    if(isset($_SESSION['user'])){
        header('location:./admin.php');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky Shine Express - Admin</title>
    <link rel = "icon" href = "../../css/img/158296698_1912727738878791_2848661181992942229_n.ico" type = "image/x-icon"> 
    <link rel="stylesheet" href="../../css/login-style.css">

    <!-- -----------------------------------------------------BOOTSTRAP----------------------------------------------------- -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    
    <!-- -----------------------------------------------------FONTAWESOME----------------------------------------------------- -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body> 

    <div class="container">
        <div class="login-form">
            <h1 class="text-center">Admin login</h1>
            <?php
                if(@$_GET['Error']==true){
            ?>
                <div class="alert alert-danger" role="alert" style="margin: 10px;">
                    Please check admin credentials!
                </div>
            <?php
                }
            ?>
            <form action="" method="post">
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" class="credentials" name="username" placeholder="Username" required="">
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="credentials" name="password" placeholder="Password" required="">
                </div>
                <button class="btn btn-outline-success" type="submit" name="submit">Login</button>
            </form>
        </div>
    </div>


    <!-- -----------------------------------------------------BOOTSTRAP----------------------------------------------------- -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</body>
</html>