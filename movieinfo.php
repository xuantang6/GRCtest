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
        <link href="css/movieinfo.css" rel="stylesheet" type="text/css"/>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;600;700;900&family=Roboto:wght@500&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Alkatra:wght@700&family=Oswald:wght@700&family=Poppins:wght@100;600;700;900&family=Roboto:wght@500;900&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700;900&display=swap');
        </style>
        <title>GRC Cinema</title>
    </head>
    <body>
        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
    
                $query = "SELECT * FROM movie WHERE id = $id";
                $run = mysqli_query($con, $query);
                if($run){
                    while($row = mysqli_fetch_assoc($run)){
            ?>
            <div class="container">
                <div class="container-box">
                    <div class="container-image">
                        <?php echo "<img src='thumb/".$row['img']."' height='470px' width='300px' />" ?>
                    </div>
                    <div class="container-body">
                        <h4 class="body-title"><?php echo $row['mv_name']; ?></h4>
                        <div class="body-detail">
                            <pre>RELEASE DATE<span class="value"><?php echo $row['release_date']; ?></span></pre>
                            <pre>RUNNING TIME<span class="value"><?php echo $row['duration']; ?></span></pre>
                            <pre>DIRECTED BY<span class="value"><?php echo $row['director']; ?></span></pre>
                            <pre>WRITTEN BY<span class="value"><?php echo $row['writter']; ?></span></pre>
                            <pre>STARRING<span class="value"><?php echo $row['starring']; ?></span></pre>
                            <pre>MUSIC BY<span class="value"><?php echo $row['music']; ?></span></pre>
                            <pre>LANGUAGE<span class="value"><?php echo $row['lang']; ?></span></pre>
                            <div class="synopsis">
                                <p class="label">SYNOPSIS</p>
                                <p class="value"><?php echo $row['meta_description']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video">
                <?php 
                    $url = $row['link1'];
                    parse_str(parse_url($url, PHP_URL_QUERY), $query_params);       
                    $video_id = $query_params['v'];
                ?>
                <iframe width="650" height="350" src="https://www.youtube.com/embed/<?php echo $video_id; ?>" frameborder="0" allowfullscreen></iframe>
            </div>
            <?php
                include 'rate-review.php';
                
                $currentDate = date('Y-m-d');
                $releaseDate = $row['release_date'];
                
                if($releaseDate <= $currentDate){
            ?>
            <div class="button">
                <a href="seatsel.php?id=<?php echo $row['id']; ?>" id="btn-1">BUY NOW</a>
            </div>
            <?php 
                }
            ?>
            <?php        
                    }
                }
            }
            ?>
    </body>
</html>
