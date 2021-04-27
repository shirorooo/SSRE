<?php
    include '../../config/config.php';

    $task = new Model();

    $allOrders = $task->countAllOrders();
    $allPendingDelivery = $task->countDeliveries();
    $allNewOrders = $task->countNewOrders();

    if(isset($_POST['updateOrder'])){
        $result = $task->updateOrderDetails($_POST);
        if(!empty($result)){
            echo "<script language='javascript'>window.alert('Receipt Updated Successfully!')</script>";
        }
    }
    if(isset($_POST['createPDF'])){
        $task->generateReceipt($_POST);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky Shine Riders Express</title>
    <link rel = "icon" href = "../../css/img/158296698_1912727738878791_2848661181992942229_n.ico" type = "image/x-icon"> 
    <link rel="stylesheet" href="../../css/updateRecord-style.css">

    <!-- -----------------------------------------------------BOOTSTRAP----------------------------------------------------- -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    
    <!-- -----------------------------------------------------FONTAWESOME----------------------------------------------------- -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body> 
    <!-- -----------------------------------------------------NAVIGATION----------------------------------------------------- -->
    <section id="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../../css/img/Logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="far fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Dashboard
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <li><a class="dropdown-item" href="admin-newOrders.php"><?= $allNewOrders?> New Orders</a></li>
                              <li><a class="dropdown-item" href="admin-forDelivery.php"><?= $allPendingDelivery?> For Delivery</a></li>
                              <hr class="dropdown-divider">
                              <li><a class="dropdown-item" href="admin.php"><?= $allOrders ?> All Records</p></a></li>
                            </ul>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <!-- ----------------------------------------FORMS---------------------------------------- -->
    <?php
        if(@$_GET['receiptNo']){
            $displayOrder = $task->displayOrderDetails($_GET['receiptNo']);
            if(!empty($displayOrder)){
                foreach($displayOrder as $data){
                    $order = $data['receiptNo'];
                    $status = $data['status'];
                    $modeOfPayment = $data['modePayment'];
                    $deliveryDate = $data['deliveryDate'];
                    $courier = $data['courier'];
                    $sName = $data['sLName'] . ', ' . $data['sFName'] . ' ' . $data['sMI'];
                    $sAddress = $data['sAddress'];
                    $sContact = $data['sCNum'];
                    $rName = $data['rLName'] . ', ' . $data['rFName'] . ' ' . $data['rMI'];
                    $rAddress = $data['rAddress'];
                    $rContact = $data['rCNum'];
                    $content = $data['packContent'];
                    $price = $data['price'];
    ?>
                    <section id="forms">
                        <form action="" method="post">
                            <div class="container">
                                <div class="contact-form row">
                                    <div class="form-field col-md-11">
                                        <input id="receiptNo" class="input-text" type="text" value="<?= $order ?>" name="receiptNo" readonly style="text-align: center; font-weight:600; font-size: 40px">
                                    </div>
                                    <div class="form-field col-md-11">
                                        <label for="#sName">
                                            <h4>Sender's Detail</h4>
                                        </label>
                                        <input id="sName" name="sName" class="input-text" type="text" value="<?= $sName ?>" required="" readonly>
                                    </div>
                                    <div class="form-field col-md-11">
                                        <input id="sAddress" name="sAddress" class="input-text" type="text" value="<?= $sAddress ?>" required="" readonly>
                                    </div>
                                    <div class="form-field col-md-11">
                                        <input id="sContact" name="sContact" class="input-text" type="text" value="<?= $sContact ?>" required="" readonly>
                                    </div>
                                    <div class="form-field col-md-11">
                                        <label for="#rName">
                                            <h4>Receiver's Detail</h4>
                                        </label>
                                        <input id="rName" name="rName" class="input-text" type="text" value="<?= $rName?>" required="" readonly>
                                    </div>
                                    <div class="form-field col-md-11">
                                        <input id="rAddress" name="rAddress" class="input-text" type="text" value="<?= $rAddress ?>" required="" readonly>
                                    </div>
                                    <div class="form-field col-md-11">
                                        <input id="rContact" name="rContact" class="input-text" type="text" value="<?= $rContact ?>" required="" readonly>
                                    </div>
                                    <div class="form-field col-md-11">
                                        <input id="package" name="package" class="input-text" type="text" value="<?= $content ?>" required="" readonly>
                                    </div>
                                    <div class="form-field col-md-11">
                                        <input id="dDate" name="dDate" class="input-text" type="text" value="<?= $deliveryDate ?>" required="" readonly>
                                    </div>
                                    <div class="form-field col-lg-11">
                                        <input id="modePayment" name="modePayment" class="input-text" type="text" value="<?= $modeOfPayment ?>" required="" readonly>
                                    </div>
                                    <div class="form-field col-lg-11">
                                        <select class="input-text" aria-label="Default select example" name="courier" required="">
                                            <option selected disabled value="">Current Courier: <?= $courier?></option>
                                            <option value="Motor Courier">Motorcycle Courier</option>
                                            <option value="Car Courier #1">Car Option #1 Courier</option>
                                            <option value="Car Courier #2">Car Option #2 Courier</option>
                                        </select>
                                    </div>
                                    <div class="form-field col-lg-11">
                                        <select class="input-text" aria-label="Default select example" name="status" required="">
                                            <option disabled selected value="">Current Status: <?= $status ?></option>
                                            <option value="For Delivery">For Delivery</option>
                                            <option value="On The Way">On The Way</option>
                                            <option value="Delivered">Delivered</option>
                                        </select>
                                    </div>
                                    <div class="form-field col-lg-5">
                                        <input id="temp" class="input-text" type="number" name="price" placeholder="Enter a new price" required="">
                                    </div>
                                    <div class="form-field col-lg-5">
                                        <h4>Current Price: <?= $price ?></h4>
                                    </div>
                                    <div class="form-field col-lg-5">
                                        <input name="updateOrder" type="submit" class="submit-btn" value="Update Order">
                                    </div>
                                    <div class="form-field col-lg-10">
                                        <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-file-pdf"></i> Create a PDF file.
                                        </button>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <p>Before the software generate your receipt inn a PDF file please make sure that the fields are populated correctly.</p>
                                                <input name="createPDF" type="submit" class="btn btn-outline-dark" value="Generate Receipt">
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </form>
                    </section>
    <?php
                }
            }
        } elseif(isset($_GET['receiptNo']) == $displayOrder['receiptNo']){
    ?>
            <br>
            <div class="container">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Oops!</h4>
                    Experienced an error! Please refrain from accessing this site without completing the URL.
                </div>
            </div>
    <?php
        }
    ?>

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