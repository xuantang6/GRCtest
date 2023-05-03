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
        <link href="css/movielist.css" rel="stylesheet" type="text/css"/>
        <script src="js/admin_dashboard.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
      include'C:\xampp\htdocs\GRC\sidebar_detail.php'
      ?>
        
        <div id="main">
        <div class="head"> 
          <div class="col-div-6"></div>
            <span class="dashboard nav" onclick="dashboard()" >&#9776; Movie</span>
            <span class="dashboard nav2" onclick="dashboard2()" >&#9776; Movie</span>
            

          <div class="col-div-6"></div>
          
          <div class="profile">
              <img src="img/baby.jpg" class="pro-img"  alt="">
              <p >Baby Boss <span>President</span></p>
          </div>
          
          <div class="col-div-8">
            <div class="box-8">
                <div class="content-box">
                    <div class="heading">
                        <p>Movies List</p><br>
                        <div><a class="btn btn-warning text-light" href="addmovie.php">Add a Movie</a></div>
                        <form class="form-inline" action="/action_page.php">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search">
                         <button class="btn btn-success" type="submit">Search</button>
                        </form>
                    </div>
                
                    <div class="row">
                        <?php
                        $query = "SELECT * FROM movie";
                        $run = mysqli_query($con, $query);
                        
                        if($run){
                            while($row = mysqli_fetch_assoc($run)){
                        ?>
                        <div class="card-container">
                            <div class="card" style="width: 300px; text-align: center;">
                                <?php echo "<img src='thumb/".$row['img']."' height='380px'/>" ?>
                                <div class="card-body">
                                    <h4 class="card-title"><?php echo $row['mv_name']; ?></h4>
                                    <br/>
                                    <a href="viewmovie.php?id=<?php echo $row['id']; ?>" id="btn-1">View Details</a>
                                    <br/><br/>
                                    <a href="deletemovie.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" id="btn-2">Delete</a>
                                    <a href="editmovie.php?id=<?php echo $row['id']; ?>" class="btn btn-info" id="btn-3">Edit</a>
                                </div>
                           </div>
                        </div>
                        <?php        
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </body>
</html>
