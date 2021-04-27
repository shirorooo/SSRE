<?php
include '../config/config.php';

$task = new Model();

if(isset($_POST['searchOrder'])){
    $result = $task->searchOrderNumber($_POST);
    if(!empty($result)){
        header('location:./trackingOrder.php?order-number='.$result['receiptNo']);
    }
    else {
        header('location:./trackingOrder.php?order-not-match=Sorry Your Order Number Does Not Match');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sky Shine Express</title>
    <link rel = "icon" href = "../css/img/158296698_1912727738878791_2848661181992942229_n.ico" type = "image/x-icon"> 
    <link rel="stylesheet" href="../css/trackingOrder-style.css">

    <!-- -----------------------------------------------------BOOTSTRAP----------------------------------------------------- -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    
    <!-- -----------------------------------------------------FONTAWESOME----------------------------------------------------- -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body> 
    <!-- -----------------------------------------------------NAVIGATION----------------------------------------------------- -->
    <section id="nav-bar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="../css/img/Logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="far fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about-us">About Us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Book Now
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="../index.php#forms">Delivery</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="../index.php#forms">PasaBuy   </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>
    <!-- -----------------------------------------------------TRACK PARCEL----------------------------------------------------- -->
    <section id="track-order">
        <div class="container">
            <h1 class="text-center title">TRACK YOUR ORDER HERE</h1>
            <?php
                if(@$_GET['order-not-match'] == true){
            ?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">ORDER NUMBER NOT FOUND!</h4>
                    <p>The order number you've entered is invalid. Please double check your order number.</p>
                    <hr>
                    <p class="mb-0">If this is really your order number and still see this alert message please send us a message on our FB page: <a href="https://www.facebook.com/groups/2423032981153978" class="alert-link">Sky Shine Rider Express</a>.</p>
                </div>
            <?php
                }
            ?>
            <form action="" method="post">
                <input type="text" placeholder="Enter Order Number" name="trackNum" class="track-number" required="">
                <button class="btn btn-dark searchOrder" type="submit" name="searchOrder"><i class="fas fa-search"></i> Find Order Number</button>
            </form>
            <?php
                if(@$_GET['order-number']){
                    $displayOrder = $task->displayOrderDetails($_GET['order-number']);
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
                        <div class="details">
                            <p>Order Number: <?php echo $order ?></p>
                            <p>Order Status: <?php echo $status ?></p>
                            <p>Mode of Payment: <?php echo $modeOfPayment ?></p>
                            <p>Delivery Date: <?php echo $deliveryDate ?></p>
                            <p>Courier: <?php echo $courier ?></p>
                            <p>Sender's Name: <?php echo $sName ?></p>
                            <p>Sender's Address: <?php echo $sAddress ?></p>
                            <p>Sender's Contact: <?php echo $sContact ?></p>
                            <p>Receiver's Name: <?php echo $rName ?></p>
                            <p>Receiver's Address: <?php echo $rAddress ?></p>
                            <p>Receiver's Contact: <?php echo $rContact ?></p>
                            <p>Content: <?php echo $content ?></p>
                            <h4>Price: <?php echo $price ?></h4>
                        </div>
            <?php
                        }
                    }
                }
            ?>
            <br>
        </div>
    </section>

    <!-- -----------------------------------------------------ABOUT US----------------------------------------------------- -->
    <section id="about-us">
        <div class="container">
            <h1 class="text-center title">ABOUT US</h1>
            <p id="aboutUs-title">Sky Shine Express</p>
            <p>
                LOOKING FOR A COURIER SERVICE FOR YOUR BUSINESS? OR FOR PERSONAL NEEDS? SKY SHINE Express provides door-to-door courier and parcel delivery services reaching the whole Cavite province. We ensure speed and safe handling, guarantee customer satisfaction, and low rates. We provide the following services at minimal costs:
                <ul>
                    <li>Door-to-door deliveries</li>
                    <li>Scheduled Pick up and Delivery</li>
                    <li>Pasabuy</li>
                    <li>Pabili</li>
                </ul>
            </p>
            <p id="aboutUs-title">Careers</p>
            <p>As a growing business we also want to help you guys. Do you think you have what it takes to be one of the Sky Shine Riders? Send us your application by visiting our FB page <a href="https://www.facebook.com/groups/2423032981153978">Sky Shine Express</a> and sending us a message there! We will wait for you our future Sky Shine Rider!</p>
            <br>
        </div>
    </section>
    
    <!-- -----------------------------------------------------SOCIAL MEDIA----------------------------------------------------- -->
    <section id="contact">
        <div class="conatiner text-center">
            <h6>Sky Shine Express</h6>
            <p>Contact Us</p>
            <p>Contact Number:  09063323001</p>
            <p>Email Address: skyshineexpress@yahoo.com</p>
            <p>Find Us On Social Media</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/groups/2423032981153978"><img src="../css/img/facebook.png" alt=""></a>
            </div>
        </div>
    </section>
















    <!-- -----------------------------------------------------BOOTSTRAP----------------------------------------------------- -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>