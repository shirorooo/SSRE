<?php

    include '../../config/config.php';

    global $allOrder;
    global $newOrders;
    global $pendingDelivery;
    global $orderDetail;

    $task = new Model();
    $allOrders = $task->countAllOrders();
    $allPendingDelivery = $task->countDeliveries();
    $allNewOrders = $task->countNewOrders();
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $orderDetail = $task->allOrders($currentPage);
    $pages = ceil($allOrders / 25);

    $previousPage = $currentPage - 1;
    $nextPage = $currentPage + 1;


    if(isset($_POST['logout'])){
        $task->logout();
    }
    if(!isset($_SESSION['user'])){
        header('location: ./login.php');
    }
    if(isset($_POST['searchReceipt'])){
        $data = $task->searchOrderNumber($_POST);
        if(!empty($data)){
            header('location:./updateRecord.php?receiptNo=' . $data['receiptNo']);
        } else {
            echo "<script language='javascript'>window.alert('Invalid Order Number!')</script>";
        }
    }
    if(isset($_POST['deleteSelected'])){
        $task->deleteSelected($_POST);
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
    <link rel="stylesheet" href="../../css/admin-style.css">

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
                              <li><a class="dropdown-item" href="#"><?= $allOrders?> All Records</p></a></li>
                            </ul>
                          </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              <?php echo "Welcome ".$_SESSION['user']."!"; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                              <hr class="dropdown-divider">
                              <li>
                                <form action="" method="post">
                                <button class="btn btn-danger" name="logout" style="width: 100%;">LOGOUT</button>
                                </form>
                            </li>
                            </ul>
                          </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <!-- -----------------------------------------------------TABLE----------------------------------------------------- -->
    <section id="table">
        <div class="container">
            <h1>
                ALL RECORDS
            </h1>

            <div class="input-field">
                <form class="d-flex" method="post">
                    <input class="form-control me-2" type="search" placeholder="Search Order Number" aria-label="Search" name="trackNum">
                    <button class="btn btn-outline-success" name="searchReceipt">Search</button>
                </form>
            </div>

            <?php
                if($pages==2){
            ?>
                    <nav id="pagination">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="admin.php?page=1">1</a></li>
                            <li class="page-item"><a class="page-link" href="admin.php?page=2">2</a></li>
                        </ul>
                    </nav>
            <?php
                } elseif($pages >= 3) { 
                    if(!empty($currentPage) && $currentPage>=3 && $currentPage != $pages){
            ?>
                        <nav id="pagination">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="admin.php?page=<?= $previousPage ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="admin.php?page=<?= $previousPage ?>"><?= $previousPage ?></a></li>
                                <li class="page-item"><a class="page-link" href="admin.php?page=<?= $currentPage; ?>" style="background: lightgrey;"><?= $currentPage ?></a></li>
                                <li class="page-item"><a class="page-link" href="admin.php?page=<?= $nextPage; ?>"><?= $nextPage; ?></a></li>
                                <li class="page-item">
                                    <a class="page-link" href="admin.php?page=<?= $nextPage ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>  
            <?php
                    } elseif(!empty($currentPage) && $currentPage>=3 && $currentPage == $pages){
            ?>
                        <nav id="pagination">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="admin.php?page=<?= $previousPage ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="admin.php?page=<?= $previousPage ?>"><?= $previousPage ?></a></li>
                                <li class="page-item"><a class="page-link" href="admin.php?page=<?= $currentPage; ?>"><?= $currentPage ?></a></li>
                            </ul>
                        </nav>
            <?php
                    } elseif($currentPage<3 || !empty($currentPage)){
            ?>
                        <nav id="pagination">
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="admin.php?page=1">1</a></li>
                                <li class="page-item"><a class="page-link" href="admin.php?page=2">2</a></li>
                                <li class="page-item"><a class="page-link" href="admin.php?page=3">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="admin.php?page=<?= $nextPage ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
            <?php
                    }
                } elseif($pages==1){
            ?>
                    <nav id="pagination">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="admin.php?page=1">1</a></li>
                        </ul>
                    </nav>
            <?php
                }
            ?>
            <div class="delete">
                    <button class="btn" name="delete" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-trash-alt"></i></button>
                </div>

            <form action="" method="post">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Are you sure you want to delete selected orders?</h3>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-success" name="deleteSelected">Confirm</button>
                        </div>
                        </div>
                    </div>
                </div>

                <table class="table table-hover table-bordered myOrders" style="width:100%">
                    <thead>
                        <tr>
                        <th scope="col"></th>
                        <th scope="col">Receipt</th>
                        <th scope="col">Sender's Name</th>
                        <th scope="col">Price</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <?php
                            foreach($orderDetail as $data):
                                $sID = $data['sID'];
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
                            <tr>
                                <td><input type="checkbox" name="checkbox[]" value="<?= $sID ?>"></td>
                                <th scope="row"><?= $order ?></th>
                                <td><?= $sName ?></td>
                                <td><?= $price ?></td>
                                <td>
                                    <a href="updateRecord.php?receiptNo=<?php echo $order; ?>" class="btn btn-success">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </form>
        </div>
    </section>

    <!-- -----------------------------------------------------FOOTER----------------------------------------------------- -->
    <section id="contact">
        <div class="conatiner text-center">
            <p><i class="far fa-copyright"></i> Sky Shine Express 2021, All rights reserved</p>
        </div>
    </section>


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