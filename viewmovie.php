<?php
include 'movie_connection.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "SELECT * FROM movie WHERE id = $id";
    $run = mysqli_query($con, $query);
    if($run){
        while($row = mysqli_fetch_assoc($run)){
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link href="css/viewmovie.css" rel="stylesheet" type="text/css"/>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;600;700;900&family=Roboto:wght@500&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Alkatra:wght@700&family=Oswald:wght@700&family=Poppins:wght@100;600;700;900&family=Roboto:wght@500;900&display=swap');
        </style>
        <title>GRC Cinema</title>
    </head>
    <body>
        <div class="container">
                <div class="row">
                    <div class="col">
                        <div><?php echo "<img src='thumb/".$row['img']."' height='400px' width='300px' />" ?></div>
                    </div>
                    <div class="col" id="col">
                        <h1><?php echo $row['mv_name']; ?></h1>
                        <br/><br/>
                        <div class="detail">
                            <pre>RELEASE DATE<span class="value"><?php echo $row['release_date']; ?></span></pre>
                            <pre>RUNNING TIME<span class="value"><?php echo $row['duration']; ?></span></pre>
                            <pre>DIRECTED BY<span class="value"><?php echo $row['director']; ?></span></pre>
                            <pre>WRITTEN BY<span class="value"><?php echo $row['writter']; ?></span></pre>
                            <pre>STARRING<span class="value"><?php echo $row['starring']; ?></span></pre>
                            <pre>MUSIC BY<span class="value"><?php echo $row['music']; ?></span></pre>
                            <pre>LANGUAGE<span class="value"><?php echo $row['lang']; ?></span></pre>
                        </div>
                    </div>
                </div>
                <br/>
                <div>        
                    <div>
                        <a class="btn btn-info" href="<?php echo $row['link1']; ?>">Download 1</a>
                        <a class="btn btn-success" href="<?php echo $row['link2']; ?>">Download 2</a>
                    </div>
                    <br/>
                    <p class="label">SYNOPSIS</p>
                    <p class="value"><?php echo $row['meta_description']; ?></p>
                    <div class="jumbotron">
                        <?php echo $row['mv_tag']; ?>
                    </div>
                </div>
            </div>
            
        <?php
        }
    }
}
        ?>
    </body>
</html>
