<?php
require_once 'movie_connection.php'; 
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/homepage.css" rel="stylesheet" type="text/css"/>
        <link href="css/cust_header.css" rel="stylesheet" type="text/css"/>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
         <!-- Link Swiper's CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Alkatra:wght@500;700&family=Ma+Shan+Zheng&family=Oswald:wght@700&family=Poppins:wght@100;200;300;400;500;600;700;900&family=Roboto:wght@500;900&display=swap');
        </style>
        <title>GRC Cinema</title>
    </head>
    <body>
        <?php
        include 'cust_header.php';
        ?>
        <!---
        <header>
            <a href="#" class="logo">
                <i class="bx bxs-movie"></i> Movies
            </a>
            <div class="bx bx-menu" id="menu-icon"></div>
            
            <!-- Menu --><!--
            <ul class="navbar">
                <li><a href="#home">Home</a></li>
                <li><a href="#movies">Movies</a></li>
                <li><a href="#coming">Coming</a></li>
                <li><a href="#newsletter">Newsletter</a></li>
            </ul>
            <a href="#" class="btn">Sign In</a>
        </header> -->
        <!-- Home -->
        <section class="home swiper" id="home">
            <div class="swiper-wrapper">
                <!-- Box 1 -->
                <div class="swiper-slide container" style="display: flex; align-items: center;">
                    <img src="images/Demon_Slayer-slideshow.png" alt="" />
                    <div class="home-text">
                        <span>Demon Slayer:<br>Swordsmith Village</span><br><br>
                        <a href="seatsel.php?id=6" class="btn">Book Now</a>
                        <a href="movieinfo.php?id=6" class="btn" id="btn-info">More Info</a>
                        <a href="https://www.youtube.com/watch?v=a9tq0aS5Zu8" class="play">
                            <i class='bx bx-play-circle'></i>
                        </a>
                    </div>
                </div>
                <!-- Box 2 -->
                <div class="swiper-slide container" style="display: flex; align-items: center;">
                    <img src="images/Your_Name-slideshow.png" alt="" />
                    <div class="home-text">
                        <span>Your Name</span><br><br>
                        <a href="seatsel.php?id=2" class="btn">Book Now</a>
                        <a href="movieinfo.php?id=2" class="btn" id="btn-info">More Info</a>
                        <a href="https://www.youtube.com/watch?v=k4xGqY5IDBE" class="play">
                            <i class='bx bx-play-circle'></i>
                        </a>
                        <div id="player"></div>
                    </div>
                </div>
                <!-- Box 3 -->
                <div class="swiper-slide container" style="display: flex; align-items: center;">
                    <img src="images/Venom-slideshow.png" alt="" />
                    <div class="home-text">
                        <span>Venom: Let There <br/> Be Carnage</span><br><br>
                        <a href="seatsel.php?id=7" class="btn">Book Now</a>
                        <a href="movieinfo.php?id=7" class="btn" id="btn-info">More Info</a>
                        <a href="https://www.youtube.com/watch?v=-ezfi6FQ8Ds" class="play">
                            <i class='bx bx-play-circle'></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </section>
        
        <!-- Movies -->
        <section class="movies" id="movies">
            <h2 class="heading">Opening This Week</h2>
            <!-- Movies Container -->
            <div class="movies-container">
            <?php
            $currentDate = date('Y-m-d');
            $query = "SELECT * FROM movie WHERE release_date <= '$currentDate'";
            $run = mysqli_query($con, $query);
        
            if($run){
                while($row = mysqli_fetch_assoc($run)){
            ?>
                <div class="box">
                    <div class="box-img">
                        <?php echo "<img src='thumb/".$row['img']."' />" ?>
                    </div>
                    <h3 class="movie-title"><?php echo $row['mv_name']; ?></h3>
                    <span><?php echo $row['duration']; ?> | <?php echo $row['mv_tag']; ?></span>
                    <br/>
                    <a href="#" id="btn-1">Book Now</a><br/>
                    <a href="movieinfo.php?id=<?php echo $row['id']; ?>" id="btn-2">More Info</a>                  
                </div>
            <?php
                }
            }
            ?>
            </div>
        </section>
        
        <!-- Coming Soon -->
        <section class="coming" id="coming">
            <h2 class="heading">Coming Soon</h2>
            <!-- Coming Soon Container -->
            <div class="coming-container swiper">
                <div class="swiper-wrapper">
                    <?php
                    $currentDate = date('Y-m-d');
                    $query = "SELECT * FROM movie WHERE release_date > '$currentDate'";
                    $run = mysqli_query($con, $query);
        
                    if($run){
                        while($row = mysqli_fetch_assoc($run)){
                    ?>
                        <div class="swiper-slide box">
                            <div class="box-img">
                                <?php echo "<img src='thumb/".$row['img']."' />" ?>
                            </div>
                            <h3 class="movie-title"><?php echo $row['mv_name']; ?></h3>
                            <span><?php echo $row['duration']; ?> | <?php echo $row['mv_tag']; ?></span>
                            <br/>
                            <a href="movieinfo.php?id=<?php echo $row['id']; ?>" id="btn-1">More Info</a>                  
                        </div>
                    <?php       
                        }
                    }
                    ?>
                </div>
            </div>
        </section>
        
        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        
        <!-- Link To Custom JS -->
        <script src="js/homepage.js" type="text/javascript"></script>
        
        <!-- The Most Popular -->
        <section class="popular" id="popular">
            <h2 class="heading" style='text-align: left;'>The Most Popular</h2>
            <a href="movieinfo.php?id=2" alt="">
                <div class="popular-img">
                    <div class="wrapper">
                        <img src="images/The_Most_Popular_1.png" class="image-1" />
                        <img src="images/The_Most_Popular_2.png" class="image-2" />
                    </div>
                </div>
            </a>
            </div>
        </section>
        <div style="height: 500px;"></div>
    </body>
</html>