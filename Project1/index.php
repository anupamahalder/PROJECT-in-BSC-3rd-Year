<?php
  require('config.php');

  $query = " SELECT * FROM `notice_tb` LIMIT 10 ";
	$result = mysqli_query($conn,$query);
	$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
  $i=1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fisheries Accreditation</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;0,900;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.css'>

</head>
<body>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <nav class="navbar">
        <div class="max-width">
            <img src="images/logo.jpg" style="height: 40px;width: 100px; padding-right: 10px;" class="photo">
            <div class="logo">
                
                <a href="#">DEPARTMENT OF<span>FISHERIES</span></a></div>
                
                    <button class="toggle-menu">
                        <span></span>
                    </button>
        </div>
    
    <div id="menu" class="">
        <nav class="main-nav">
          <ul>
            <li>
              <a href="index.php">
                Home
              </a>
            </li>
            <li>
              <a href="about.html">
                About Us
              </a>
            </li>
            
            <li>
              <a href="programmesandschemas.html">
                Programmes and Schemas
              </a>
            </li>
            <li>
                <a href="#">
                  Acts and Regulation
                </a>
              </li>
              <li>
                <a href="signup.php">
                  Login/Signup
                </a>
              </li>
              <li>
                <a href="adminlogin.php">
                  Admin Login
                </a>
              </li>
          </ul>      
        </nav>
      </div>
    </nav>
    <!-- home section start -->

    <section class="home" id="home">
      <div class="max-width">
          <div class="row">
            <div class="home-content">
                <div class="photoslider">
                    <div class="slideshow-container">
                       <div class="mySlides fade">
                         <img src="images/slider1.jpg" class="photo">
                         <figcaption>Application of feed for increasing productivity</figcaption>
                       </div>
                       <div class="mySlides fade">
                         <img src="images/slider2.jpg" class="photo">
                         <figcaption>A - Rich haul from Moyna Model</figcaption>
                       </div>
                       <div class="mySlides fade">
                         <img src="images/slider3.jpg" class="photo">
                         <figcaption>Brackish water shrimp farming</figcaption>
                       </div>
                       <div class="mySlides fade">
                        <img src="images/slider4.jpg" class="photo">
                        <figcaption>Crab Fattening - A new avenue for coastal aqua culture</figcaption>
                      </div>
                      <div class="mySlides fade">
                        <img src="images/slider5.jpg" class="photo">
                        <figcaption>Induced breeding for quality fish seed production</figcaption>
                      </div>
                      <div class="mySlides fade">
                        <img src="images/slider6.jpg" class="photo">
                        <figcaption>Ornamental fish farming by women S.H.G</figcaption>
                      </div>
                       <br>
                       <div style="text-align:center">
                          <span class="dot"></span> 
                          <span class="dot"></span> 
                          <span class="dot"></span>
                          <span class="dot"></span> 
                          <span class="dot"></span> 
                          <span class="dot"></span>  
                        </div>
                    </div>
                 </div>
                 </div>
            </div>
          </div>
      </div>
    </section>
    <section class="noticeSection">
      <div class="noticeHead">
        <h1>Notice</h1>
      </div>
      <div class="notice">
        <div class="dl">
          <?php
            foreach ($posts as $post) 
          {?>
              <a href='notices/<?php echo $post['Notice'] ?>' target='_blank'>
                <?php echo $i++ .'. '. $post['Notice'] ?>
                (<?php echo $post['Date'] ?>)
              </a>
          <?php
          }?>
        </div>
      </div>
    </section>
    <!-- contact section start -->
    <section class="contact" id="contact">
        <div class="max-width">
            <h2 class="title">Contact Us</h2>
            <div class="contact-content">
                <div class="column left">
                    <div class="icons">
                        <div class="row">
                            <i class="fas fa-user"></i>
                            <div class="info">
                                <div class="head">Department of Fisheries</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-map-marker-alt"></i>
                            <div class="info">
                                <div class="head">Address</div>
                                <div class="sub-title">Kolkata, India</div>
                            </div>
                        </div>
                        <div class="row">
                            <i class="fas fa-envelope"></i>
                            <div class="info">
                                <div class="head">Email</div>
                                <div class="sub-title">hatcheryaccredition23@outlook.com</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column right">
                    <div class="text">Message us</div>
                    <form class="contact-form" action="feed.php" method="POST">
                        <div class="fields">
                            <div class="field name">
                                <input type="text" class="fullname" placeholder="Name" name="name">
                            </div>
                            <div class="field email">
                                <input type="text" class="email-input" placeholder="Email" name="email">
                            </div>
                        </div>
                        <div class="field">
                            <input type="text" class="subject" placeholder="Subject" name="subject">
                        </div>
                        <div class="field textarea">
                            <textarea class="message" cols="30" rows="10" placeholder="Message.." name="message"></textarea>
                        </div>
                        <div class="button-area">
                            <button class="send-msg" type="submit" name="send">Send message</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- footer section start -->

      <footer>
        <div class="container">
            <div class="sec aboutus">
                <h2>About Us</h2>
                <p>We set out to create a new, interactive way of accrediton making it faster, flexible, and accessible for as many people as possible, so that they unlock modern technical skills and reach their full potential.</p>
                <ul class="sci">
                    <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
                </ul>
            </div>
            <div class="sec quicklinks">
                <h2>Quick Links</h2>
                <ul>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Disclaimer</a></li>
                    <li><a href="sitemap.html">Sitemap</a></li>
                </ul>
            </div>
            
            <div class="sec contact">
                <h2>Contact Us</h2>
                <ul class="info">
                    <li>
                        <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <span>Behala<br>Kolkata, West Bengal,<br>India.</span>
                    </li>
                    <li>
                        <span><i class="fa fa-phone" aria-hidden="true"></i></span>
                        <p><a href="tel:+9112345678900">+91 123 4567 890</a><br>
                           <a href="tel:+9112345678900">+91 123 4567 890</a></p>
                    </li>
                    <li>
                        <span><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        <p><a href="mailto:onlinelibrary@gmail.com">onlinelibrary@gmail.com</a></p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <div class="copyrightText">
        <p>Copyright © 2021 Fisheries Accredition. ALL Rights Reserved.</p>
    </div>

    <script src="javascript/script1.js"></script>
    <script src="javascript/script2.js"></script>
</body>
</html>
