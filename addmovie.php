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
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>GRC Cinema</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <link href="css/addmovie.css" rel="stylesheet" type="text/css"/>
        <script src="js/admin_dashboard3.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
        include'sidebar_detail.php';
        ?>
        
        <div id="main">
        <div class="head"> 
          <div class="col-div-6"></div>
            <span class="dashboard nav" onclick="dashboard()" >&#9776; Dashboard</span>
            <span class="dashboard nav2" onclick="dashboard2()" >&#9776; Dashboard</span>
            

          <div class="col-div-6"></div>
          
          <div class="profile">
              <img src="img/baby.jpg" class="pro-img"  alt="">
              <p >Baby Boss <span>President</span></p>
          </div>
          
          <div class="col-div-8">
            <div class="box-8">
                <div class="content-box">
                    <div class="heading">
                        <p class="add-title">Add Movie</p><br>
                    </div>
                
                    <div class="container" style='min-width: 1350px'>
            <div class="jumbotron">
                <form action="valinewpost.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="mv_name" class="form-control" placeholder="Enter Movie Name">
                    </div>
                    <div class="form-group">
                        <input type="text" name="mv_m_tag" class="form-control" placeholder="Enter Meta Tags">
                    </div>
                    <div class="form-group">
                        <input type="text" name="mv_link1" class="form-control" placeholder="Enter Link 1">
                    </div>
                    <div class="form-group">
                        <input type="text" name="mv_link2" class="form-control" placeholder="Enter Link 2">
                    </div>
                    <div class="form-group">
                        <input type="date" name="mv_date" class="form-control" placeholder="Enter Release Date">
                    </div>
                    <div class="form-group">
                        <input type="text" name="mv_duration" class="form-control" placeholder="Enter Movie Duration">
                    </div>
                    <div class="form-group">
                        <input type="text" name="mv_lang" class="form-control" placeholder="Enter Movie Language">
                    </div>
                    <div class="form-group">
                        <input type="text" name="mv_director" class="form-control" placeholder="Enter Movie Director">
                    </div>
                    <div class="form-group">
                        <input type="text" name="mv_writter" class="form-control" placeholder="Enter Movie Writter">
                    </div>
                    <div class="form-group">
                        <input type="text" name="mv_starring" class="form-control" placeholder="Enter Movie Starring">
                    </div>
                    <div class="form-group">
                        <input type="text" name="mv_music" class="form-control" placeholder="Enter Movie Music Production">
                    </div>
                    <div class="form-group">
                        <input type="text" name="country" class="form-control" placeholder="Enter Movie's Country">
                    </div>
                    <div class="form-group">
                        <input type="text" name="cat_id" class="form-control" placeholder="Enter Category ID">
                    </div>
                    <div class="form-group">
                        <input type="text" name="genre_id" class="form-control" placeholder="Enter Genre ID">
                    </div>
                    <div class="custom-file mb-3">
                        <input type="file" name="img" class="custom-file-input" id="customFile" name="filename">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-group">
                        <textarea type="text" name="mv_desc" class="form-control" placeholder="Enter Movie Description" rows="4"></textarea>
                    </div>
                    
                    <button type="submit" name="submit" class="btn btn-info btn-lg">Submit</button>
                </form>
            </div>
        </div> 
                </div>
            </div>
        </div>
        </div>
    </body>
</html>