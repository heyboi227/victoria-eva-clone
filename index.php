<?php
// File requirements for establishing database connection, and getting data for the navigation dropdown menus
require("session.php");
require("../php/cfg/dbconfig.php");
require("get-database.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="main.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2c77941c98.js" crossorigin="anonymous"></script>
    <script src="splide-3.0.9/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="splide-3.0.9/dist/css/splide.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="parallax.js-1.5.0/parallax.min.js"></script>
    <title>Victoria Eva - Clone</title>
</head>

<body>
    <div id="container">
        <div id="header-container">
            <div id="header">
                <div id="logo-wrapper">
                    <div id="logo">
                        <a href="index.php"><img src="img/logo_gold.png" alt="Site logo" /></a>
                        <p>Your beauty is our duty</p>
                    </div>
                    <div id="btn-mobile">
                        <i class="fas fa-bars fa-lg"></i>
                    </div>
                </div>
                <div id="nav-auth">
                    <div id="nav">
                        <ul class="nav-links">
                            <li><a href="index.php" class="active">Home</a></li>
                            <li><a href="#">About us</a></li>
                            <li class="services-link link-dropdown-menu"><a href="#" id="services-list-drop">Services <i class="fas fa-chevron-down fa-xs"></i></a>
                                <div id="services-list-container">
                                    <ul class="services-list">
                                        <?php foreach ($services as $service) {
                                            echo "<li>" . $service->name . "</li>";
                                        } ?>
                                    </ul>
                                </div>
                            </li>
                            <li class="brands-link link-dropdown-menu"><a href="#" id="brands-list-drop">Brands <i class="fas fa-chevron-down fa-xs"></i></a>
                                <div id="brands-list-container">
                                    <ul class="brands-list">
                                        <?php foreach ($brands as $brand) {
                                            echo "<li>" . $brand->name . "</li>";
                                        } ?>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="#">Online shop</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                    <div id="auth">
                        <?php if (!(isset($_SESSION['loggedin']) && $_SESSION["loggedin"] === true)) {
                            echo "<a href='signup.php' class='signup-btn'>Sign Up</a>";
                            echo "<a href='login.php'>Login</a>";
                            echo "<div id='edit-profile'>";
                            echo "<ul class='edit-profile-list'>";
                            echo "<li><a href='edit-profile.php'>Edit profile</a></li>";
                            echo "<li><a href='logout.php'>Logout</a></li>";
                            echo "</ul>";
                            echo "</div>";
                        } else {
                            echo "<div class='profile-info'>";
                            echo "<i class='fas fa-user fa-2x'></i>" . "<p>" . $_SESSION['username'] . "</p>";
                            echo "<div id='edit-profile'>";
                            echo "<ul class='edit-profile-list'>";
                            echo "<li><a href='edit-profile.php'>Edit profile</a></li>";
                            echo "<li><a href='logout.php'>Logout</a></li>";
                            echo "</ul>";
                            echo "</div>";
                            echo "</div>";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="image-slider" class="splide">
            <div class="splide__progress">
                <div class="splide__progress__bar">
                </div>
            </div>
            <div class="splide__track">
                <ul class="splide__list">
                    <li class="splide__slide"><img src="img/beauty-slide-1.jpg" alt="Slider image 1">
                        <div id="first-slide-content">
                            <h1>Davines</h1>
                            <div class="border-down-info special"></div>
                            <h1>gentle impersonation</h1>
                            <div class="find-more-btn">
                                <a href="#">Book your appointment</a>
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide"><img src="img/beauty-slide-3.jpg" alt="Slider image 2">
                        <div id="second-slide-content">
                            <h1>Pearlsmile</h1>
                            <div class="border-down-info special"></div>
                            <h1>smile with confidence</h1>
                            <div class="find-more-btn">
                                <a href="#">Book your appointment</a>
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </li>
                    <li class="splide__slide"><img src="img/beauty-slide-7.jpg" alt="Slider image 3">
                        <div id="third-slide-content">
                            <h1>ZO Skin Health, Inc.</h1>
                            <div class="border-down-info special"></div>
                            <h1>the next generation of skin health solution</h1>
                            <div class="find-more-btn">
                                <a href="#">Book your appointment</a>
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="scroll"></div>
        </div>
        <div class="clearfix"></div>
        <div id="services">
            <div class="title">
                <h1>Our Services</h1>
                <div class="border-down clearfix"></div>
            </div>
            <div id="service-list">
                <div class="service">
                    <img class="service-img" src="img/beauty-1.jpg" alt="Hairdressing illustration" />
                    <h3>Hairdressing</h3>
                    <div class="find-more-btn">
                        <a href="#">Find out more</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
                <div class="service">
                    <img class="service-img" src="img/beauty-6.jpg" alt="Nail service illustration" />
                    <h3>Nail service</h3>
                    <div class="find-more-btn">
                        <a href="#">Find out more</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
                <div class="service">
                    <img class="service-img" src="img/beauty-4.jpg" alt="Make-up illustration" />
                    <h3>Make-up</h3>
                    <div class="find-more-btn">
                        <a href="#">Find out more</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
                <div class="break clearfix"></div>
                <div class="service">
                    <img class="service-img" src="img/beauty-8.jpg" alt="Hair removal illustration" />
                    <h3>Hair removal</h3>
                    <div class="border-down-service clearfix"></div>
                    <div class="find-more-btn">
                        <a href="#">Find out more</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
                <div class="service">
                    <img class="service-img" src="img/beauty-5.jpg" alt="Cosmetology illustration" />
                    <h3>Cosmetology</h3>
                    <div class="border-down-service clearfix"></div>
                    <div class="find-more-btn">
                        <a href="#">Find out more</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
                <div class="service">
                    <img class="service-img" src="img/beauty-7.jpg" alt="Brow & lash services illustration" />
                    <h3>Brow & lash services</h3>
                    <div class="border-down-service clearfix"></div>
                    <div class="find-more-btn">
                        <a href="#">Find out more</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="standout">
            <div id="ear-candling">
                <h1>Ear candling</h1>
                <div class="find-more-btn-black">
                    <a href="cosmetology.php#cleaning-ears">Find out more</a>
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="welcome">
            <div id="welcome-image">
                <div id="advantages-list-container">
                    <h3>Our Advantages</h3>
                    <ul class="icons-list">
                        <li>Perfect hygiene <i class="far fa-check-square"></i></li>
                        <li>Best brands <i class="far fa-check-square"></i></li>
                        <li>Hypoallergenic and ecologically clean products <i class="far fa-check-square"></i></li>
                        <li>Highly qualified specialists <i class="far fa-check-square"></i></li>
                        <li>High-quality service <i class="far fa-check-square"></i></li>
                        <li>Cozy atmosphere <i class="far fa-check-square"></i></li>
                    </ul>
                </div>
            </div>
            <div id="welcome-text">
                <div id="welcome-text-flex">
                    <h2>Welcome to <span style="color: #c7ac56;">Victoria</span> Eva!</h2>
                    <div class="border-gradient-top"></div>
                    <p>Our beauty bar - is a world of unique technology of the modern beauty industry, impeccable service and unique atmosphere of leisure and relaxation. With Victoria Eva you'll always look great!</p>
                    <div class="border-gradient-bottom"></div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="info">
            <div class="border-down"></div>
            <div id="info-cards">
                <div class="info-card">
                    <div class="circle">
                        <i class="fas fa-plus-square fa-2x inside-circle"></i>
                    </div>
                    <h2>2013</h2>
                    <div class="border-down-info"></div>
                    <p>The history of Victoria Eva begins in 2013, in Limassol, in a private complex "The Residence".</p>
                    <div class="find-more-btn">
                        <a href="#">Find out more</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
                <div class="info-card">
                    <div class="circle">
                        <i class="fas fa-hospital fa-2x inside-circle"></i>
                    </div>
                    <h2>Price List</h2>
                    <div class="border-down-info"></div>
                    <p>Please feel free to check out our price list for a full range of services we have for you.</p>
                    <div class="find-more-btn">
                        <a href="#">Download</a>
                        <i class="far fa-calendar-alt"></i>
                    </div>
                </div>
                <div class="info-card special-offer">
                    <div class="circle special-circle">
                        <i class="fas fa-thumbs-up fa-2x inside-circle"></i>
                    </div>
                    <h2>Special Offer</h2>
                    <div class="border-down-info special"></div>
                    <p>Summer special offer on teeth whitening, pay €50 instead of €69,00 with promo code!</p>
                    <div class="find-more-btn-inverted">
                        <a href="#">Find out more</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
                <div class="info-card">
                    <div class="circle">
                        <i class="far fa-clock fa-2x inside-circle"></i>
                    </div>
                    <h2>Opening Hours</h2>
                    <div class="border-down-info"></div>
                    <ul class="working-hours">
                        <li>
                            <strong>Tue, Wed, Fri, Sat</strong>
                            <span class="to-right">10.00 - 19.00</span>
                        </li>
                        <li>
                            <strong>Mon, Thu, Sun</strong>
                            <span class="to-right">closed</span>
                        </li>
                    </ul>
                    <div class="border-down-info"></div>
                    <p class="gold-paragraph">We are open until our last client!</p>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div id="reviews">
            <div id="image-slider-2" class="splide" data-parallax="scroll" data-image-src="img/background-img-10.jpg" data-z-index="0">
                <div class="splide__track">
                    <ul class="splide__list">
                        <li class="splide__slide">
                            <img src="img/testimonial-1.jpg" alt="User review profile image 1">
                            <h1>Person 1</h1>
                            <div class="border-down-info special clearfix"></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis neque non leo consequat auctor. Donec ultrices bibendum turpis, sed semper sem rhoncus vitae. Pellentesque quis quam eros. Vivamus id elementum ex. In sodales massa sed aliquet faucibus. Sed blandit tincidunt posuere. Cras euismod congue lacinia. Aliquam at dolor consequat, posuere neque at, finibus ligula.</p>
                        </li>
                        <li class="splide__slide">
                            <img src="img/testimonial-2.jpg" alt="User review profile image 2">
                            <h1>Person 2</h1>
                            <div class="border-down-info special clearfix"></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis neque non leo consequat auctor. Donec ultrices bibendum turpis, sed semper sem rhoncus vitae. Pellentesque quis quam eros. Vivamus id elementum ex. In sodales massa sed aliquet faucibus. Sed blandit tincidunt posuere. Cras euismod congue lacinia. Aliquam at dolor consequat, posuere neque at, finibus ligula.</p>
                        </li>
                        <li class="splide__slide">
                            <img src="img/testimonial-3.jpg" alt="User review profile image 3">
                            <h1>Person 3</h1>
                            <div class="border-down-info special clearfix"></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis neque non leo consequat auctor. Donec ultrices bibendum turpis, sed semper sem rhoncus vitae. Pellentesque quis quam eros. Vivamus id elementum ex. In sodales massa sed aliquet faucibus. Sed blandit tincidunt posuere. Cras euismod congue lacinia. Aliquam at dolor consequat, posuere neque at, finibus ligula.</p>
                        </li>
                        <li class="splide__slide">
                            <img src="img/testimonial-4.jpg" alt="User review profile image 4">
                            <h1>Person 4</h1>
                            <div class="border-down-info special clearfix"></div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer quis neque non leo consequat auctor. Donec ultrices bibendum turpis, sed semper sem rhoncus vitae. Pellentesque quis quam eros. Vivamus id elementum ex. In sodales massa sed aliquet faucibus. Sed blandit tincidunt posuere. Cras euismod congue lacinia. Aliquam at dolor consequat, posuere neque at, finibus ligula.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="footer">
            <div id="footer-logo">
                <img src="img/logo_gold.png" alt="Site logo" />
                <h4>Your beauty is our duty</h4>
            </div>
            <div id="contact-info">
                <p><i class="fas fa-map-marker-alt"></i> 99 A. N. N, Limassol, Cyprus&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-phone-alt"></i><a href="#">+357 11 22 33 44</a></p>
                <p><i class="fas fa-phone-alt"></i><a href="#">+357 44 33 22 11</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-envelope"></i><a href="#">dummy@victoriaeva.com</a></p>
            </div>
            <div id="social-media">
                <a href="#" class="facebook"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#" class="instagram"><i class="fab fa-instagram fa-lg"></i></a>
            </div>
            <div class="border-down-footer"></div>
            <div id="copyright">
                <p>Created by <a href="https://bluebookstudio.com/" class="blue-book">Blue Book</a>. Cloned by Milos Jeknic. All rights reserved.</p>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</body>
<script src="/jquery.js"></script>
<script src="main.js"></script>
<script src="splide.js"></script>
<script src="scroller.js"></script>

</html>