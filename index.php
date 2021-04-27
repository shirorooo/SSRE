<?php
    include './config/config.php';

    $task = new Model();

    if(isset($_POST['booking'])){
        $insert = $task->insertData($_POST);
        print_r($insert);
        if($insert){
            echo "<script language='javascript'>window.alert('Data was not recorded! Please contact admin.')</script>";
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
    <link rel = "icon" href = "./css/img/158296698_1912727738878791_2848661181992942229_n.ico" type = "image/x-icon"> 
    <link rel="stylesheet" href="./css/style.css">

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
                    <img src="./css/img/Logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="far fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about-us">About Us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Book Now
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#forms">Delivery</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#forms">PasaBuy</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./urls/trackingOrder.php">Track Order Here</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <!-- -----------------------------------------------------BANNER----------------------------------------------------- -->
    <section id="banner">
        <div class="container">
            <div class="row">
                <div class="col-mid-6" id="lPan">
                    <h1>Welcome to Sky Shine Express!</h1>
                    <p>We are happy to serve and give you the best courier service you could ever have!</p>
                    <p style="font-weight: 600;">Want to send documents or presents? Why not try fillout our form.</p>
                    <a href="#forms"><button type="button" class="btn btn-dark">BOOK NOW</button></a>
                </div>
                <div class="col-mid-6 text-center" id="rPan">
                    <img src="./css/img/Goo.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <!-- -----------------------------------------------------SERVICES----------------------------------------------------- -->
    <section id="services">
        <div class="container">
            <h1 class="text-center title">SERVICES</h1>
            <div class="row">
                <div class="col-md-4 services">
                    <div class="card" style="width: 21rem;">
                        <img src="./css/img/Motorcycle.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="text-center">Motorcycle</h3>
                            <p>Base Rate: Php. 45.00</p>
                            <p>Additional Rate per Kilometer: Php. 5.00</p>
                            <p>Weight Limit: 20kgs</p>
                            <p>Pasabay Rate: Php. 45.00/30mins and Php. 55.00/1HR</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 services">
                    <div class="card" style="width: 21rem;">
                        <img src="./css/img/png-transparent-fast-delivery-truck-cargo-delivery-icon-express-delivery-freight-transport-text-service.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="text-center">Car Option #1</h3>
                            <p>Base Rate: Php. 125.00</p>
                            <p>Additional Rate per Kilometer: Php. 19.00</p>
                            <p>Weight Limit: 200kgs</p>
                            <p>Pasabay Rate: Php. 85.00/30mins and Php. 95.00/1HR</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 services">
                    <div class="card" style="width: 21rem;">
                        <img src="./css/img/png-transparent-fast-delivery-truck-cargo-delivery-icon-express-delivery-freight-transport-text-service.png" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h3 class="text-center">Car Option #2</h3>
                            <p>Base Rate: Php. 145.00</p>
                            <p>Additional Rate per Kilometer: Php. 19.00</p>
                            <p>Weight Limit: 300kgs</p>
                            <p>Pasabay Rate: Php. 85.00/30mins and Php. 95.00/1HR</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="break"></div>

    <!-- -----------------------------------------------------FORMS----------------------------------------------------- -->
    <section id="forms">
        <h1 class="text-center title">BOOK NOW</h1>
        <div class="container">
            <form method="post">
                <div class="row">
                    <div class="col-md-6" id="panels">
                        <h2>Sender's Form</h2>
                        <div class="contact-form row">
                            <div class="form-field col-lg-3">
                                <input class="input-text" type="text" name="sFName" placeholder="First Name" required="">
                            </div>
                            <div class="form-field col-lg-3" style="width: 100%;">
                                <input class="input-text" type="text" name="sMI" placeholder="Middle Initial" onKeyPress="if(this.value.length==1) return false;">
                            </div>
                            <div class="form-field col-lg-3 ">
                                <input class="input-text" type="text" name="sLName" placeholder="Last Name" required="">
                            </div>
                            <div class="form-field col-lg-10">
                                <input class="input-text" type="number" name="sCNum" placeholder="Contact Number" required="" onKeyPress="if(this.value.length==11) return false;">
                            </div>  
                            <div class="form-field col-lg-10">
                                <input class="input-text" type="text" name="sAddress" placeholder="Parcel's Pick-up Point" required="">
                            </div>
                            <div class="form-field col-lg-10">
                                <label for="date"><p>Parcel's Pick-up Date</p></label>
                                <input id="date" class="input-text" type="date" name="pickDate" placeholder="Parcel's Pick-up Date (mm-dd-YYY)" required="">
                            </div>
                            <div class="form-field col-lg-10">
                                <input class="input-text" type="text" name="packageContent" placeholder="Package Content" required="">
                            </div>
                            <div class="form-field col-lg-10">
                                <select class="form-select" aria-label="Default select example" name="courier" required="">
                                    <option selected disabled value="">-- Please Select Courier --</option>
                                    <option value="Motor Courier">Motorcycle Courier</option>
                                    <option value="Car Courier #1">Car Option #1 Courier</option>
                                    <option value="Car Courier #2">Car Option #2 Courier</option>
                                </select>
                            </div>
                            <div class="form-field col-lg-10">
                                <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    <i class="fas fa-chevron-circle-down"></i> Schedule specific date of delivery
                                </button>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <p>Do you want to have a specific delivery date? If yes please fill out the field below. But if you want the package to be delivered within our standard delivery period just leave this form blank.</p>
                                        <input class="input-text" type="date" name="dDate" placeholder="mm-dd-YYY">
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                    <div class="col-md-6" id="panels">
                        <h2>Receiver's Information</h2>
                        <div class="contact-form row">
                            <div class="form-field col-md-3">
                                <input class="input-text" type="text" name="rFName" placeholder="First Name" required="">
                            </div>
                            <div class="form-field col-md-3">
                                <input class="input-text" type="text" name="rMI" placeholder="Middle Initial" onKeyPress="if(this.value.length==1) return false;">
                            </div>
                            <div class="form-field col-md-3">
                                <input class="input-text" type="text" name="rLName" placeholder="Last Name" required="">
                            </div>
                            <div class="form-field col-md-10">
                                <input class="input-text" type="text" name="rAddress" placeholder="Receiver's Address" required="">
                            </div>
                            <div class="form-field col-md-10">
                                <input class="input-text" type="number" name="rCNum" placeholder="Contact Number" required="" onKeyPress="if(this.value.length==11) return false;">
                            </div>
                            <div class="form-field col-lg-10">
                                <select class="form-select" aria-label="Default select example" name="modePayment" required="">
                                    <option disabled selected value="">-- Mode of Payment --</option>
                                    <option value="Cash Upon Pick-up">Cash Upon Pick-up</option>
                                    <option value="Cash on Delivery">Cash on Delivery</option>
                                    <option value="GCash">GCash</option>
                                </select>
                            </div>
                            <div class="form-field col-md-10">
                                <button name="booking" type="submit" class="btn btn-dark submit-btn"><i class="fas fa-map-marked-alt"></i> BOOK NOW</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                <a href="https://www.facebook.com/groups/2423032981153978"><img src="css/img/facebook.png" alt=""></a>
            </div>
        </div>
    </section>
















    <script src="./js/main.js"></script>
    <!-- -----------------------------------------------------BOOTSTRAP----------------------------------------------------- -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>
</html>