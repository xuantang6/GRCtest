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
        include'sidebar_detail.php'
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
                        <p class="add-title">Edit Movie</p><br>
                    </div>
                
                    <div class="container" style='min-width: 1350px'>
            <div class="jumbotron" >
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['mv_name'] ?>" name="mv_name" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['mv_tag'] ?>" name="mv_m_tag" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['link1'] ?>" name="mv_link1" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['link2'] ?>" name="mv_link2" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="date" value="<?php echo $row['release_date'] ?>" name="mv_date" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['duration'] ?>" name="mv_duration" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['lang'] ?>" name="mv_lang" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['director'] ?>" name="mv_director" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['writter'] ?>" name="mv_writter" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['starring'] ?>" name="mv_starring" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['music'] ?>" name="mv_music" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['country'] ?>" name="country" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['cat_id'] ?>" name="cat_id" class="form-control" />
                    </div>
                    <div class="form-group">
                        <input type="text" value="<?php echo $row['genre_id'] ?>" name="genre_id" class="form-control" />
                    </div>
                    <div class="custom-file mb-3">
                        <input type="file" name="img" class="custom-file-input" id="customFile" />
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        <input type="hidden" value="<?php echo $row['img'] ?>" name="old_img" class="custom-file-input" id="customFile" />
                    </div>
                    <br/>
                    <br/>
                    <br/>
                    <div class="form-group">
                        <textarea type="text" name="mv_desc" class="form-control" rows="4"><?php echo $row['meta_description'] ?></textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-info btn-lg">Submit</button>
                </form>
            </div>
        </div>
                </div>
            </div>
        </div>
        </div>
        
        <?php
        if(isset($_POST['submit'])){
            $mv_name = $_POST['mv_name'];
            $mv_m_tag = $_POST['mv_m_tag'];
            $mv_link1 = $_POST['mv_link1'];
            $mv_link2 = $_POST['mv_link2'];
            $mv_lang = $_POST['mv_lang'];
            $mv_duration = $_POST['mv_duration'];
            $mv_director = $_POST['mv_director'];
            $mv_writter = $_POST['mv_writter'];
            $mv_starring = $_POST['mv_starring'];
            $mv_music = $_POST['mv_music'];
            $country = $_POST['country'];
            $cat_id = $_POST['cat_id'];
            $genre_id = $_POST['genre_id'];
            $mv_desc = $_POST['mv_desc'];
            $mv_date = date('Y-m-d', strtotime($_POST['mv_date']));
            $new_img = $_FILES['img']['name']; 
            $target = "C:/xampp/htdocs/PHP_Assignment/thumb/". basename($_FILES['img']['name']);
            $old_img = $_POST['old_img'];
            
            if($new_img != ""){
                $update_filename = $new_img;
            }
            else{
                $update_filename = $old_img;
            }
            
            $query1 = "UPDATE `movie` SET `cat_id`='$cat_id',`genre_id`='$genre_id',
                      `mv_name`='$mv_name',`mv_tag`='$mv_m_tag',`link1`='$mv_link1',`link2`='$mv_link2',
                      `img`='$update_filename',`release_date`='$mv_date',`duration`='$mv_duration',`lang`='$mv_lang',
                      `director`='$mv_director',`writter`='$mv_writter',`starring`='$mv_starring',`music`='$mv_music',
                      `country`='$country',`meta_description`='$mv_desc' WHERE id = $id";
        
            $result = mysqli_query($con, $query1);
            if($result){
                if($new_img != ""){
                    move_uploaded_file($_FILES['img']['tmp_name'], $target);                    
                }
                echo "<script>alert('Movie Successfully Updated...');window.location.href='movielist.php';</script>";
            }
        }        
        ?>
            <?php
        }
    }
}
else{
    header('Location: movielist.php');
}
?>
    </body>
</html>

