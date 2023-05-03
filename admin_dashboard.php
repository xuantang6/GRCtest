<?php
include 'con_db.php';

?>
<!DOCTYPE html>
    
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>GRC Cinema</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link href="css/admin_dashboard.css" rel="stylesheet" type="text/css"/>
  <script src="js/admin_dashboard.js" type="text/javascript"></script>
</head>
    <body>
      <?php
      include'C:\xampp\htdocs\GRC\sidebar_detail.php'
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

          <div class="clearfix"></div>
<?php
$sql ="SELECT COUNT(*) AS total FROM movie";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result) > 0){
    $row = mysqli_fetch_assoc($result);
    $total_movie = $row["total"];
}
mysqli_close($con);
?>
          <div class="col-div-3">
            <a href="movielist.php"><div class="box">
                <p><?php echo $total_movie?><br/><span>Movie</span></p>
                <i id="g1" class="fa fa-solid fa-film icons box-icon"></i>
            </div></a>
          </div>
          <div class="col-div-3">
            <div class="box">
                <p>46<br/><span>Projects</span></p>
                <i id="g2" class="fa fa-list box-icon"></i>
            </div>
          </div>
          <div class="col-div-3">
            <div class="box">
                <p>182<br/><span>Orders</span></p>
                <i id="g3" class="fa fa-duoton fa-ticket box-icon"></i>
            </div>
          </div>
          <div class="col-div-3">
            <div class="box">
                <p>63<br/><span>Tasks</span></p>
                <i id="g4" class="fa fa-tasks box-icon"></i>
            </div>
          </div>
          <div class="clearfix"></div>
          <br><br>

          <div class="col-div-8">
            <div class="box-8">
              <div class="content-box">
                  <p>Top Selling <span style="cursor: pointer">View all</span></p>
                <br>
                <table>
                  <tr>
                    <th>Rank</th>
                    <th>Movie Title</th>
                    <th>Director</th>
                    <th>Sales</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Suzume</td>
                    <td>Mokoto Shinkai</td>
                    <td>4543</td>
                  </tr>
                  <tr>
                      <td>2</td>
                    <td>Your Name</td>
                    <td>Mokoto Shinkai</td>
                    <td>3522</td>
                  </tr>
                  <tr>
                      <td>3</td>
                    <td>Spirited Away</td>
                    <td>Hayao Miyazaki</td>
                    <td>2828</td>
                  </tr>
                  <tr>
                      <td>4</td>
                    <td>Violet  Evergarder</td>
                    <td>Taichi Ishidate</td>
                    <td>1992</td>
                  </tr>
                  <tr>
                      <td>5</td>
                    <td>Demon Slayer</td>
                    <td>Haruo Sotozaki</td>
                    <td>1292</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="col-div-8">
            <div class="box-8">
              <div class="content-box">
                  <p>Top Rating  <span style="cursor: pointer">View all</span></p>
                <br>
                <table>
                  <tr>
                    <th>Rank</th>
                    <th>Movie Title</th>
                    <th>Director</th>
                    <th>Sales</th>
                  </tr>
                  <tr>
                    <td>1</td>
                    <td>Suzume</td>
                    <td>Mokoto Shinkai</td>
                    <td>4543</td>
                  </tr>
                  <tr>
                      <td>2</td>
                    <td>Your Name</td>
                    <td>Mokoto Shinkai</td>
                    <td>3522</td>
                  </tr>
                  <tr>
                      <td>3</td>
                    <td>Spirited Away</td>
                    <td>Hayao Miyazaki</td>
                    <td>2828</td>
                  </tr>
                  <tr>
                      <td>4</td>
                    <td>Violet  Evergarder</td>
                    <td>Taichi Ishidate</td>
                    <td>1992</td>
                  </tr>
                  <tr>
                      <td>5</td>
                    <td>Demon Slayer</td>
                    <td>Haruo Sotozaki</td>
                    <td>1292</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          

<!--          <div class="col-div-4">
            <div class="box-4">
              <div class="content-box">
                <p>Total Sale <span style="cursor: pointer">View All</span></p>

                <div class="circle-wrap">
                <div class="circle">
                  <div class="mask full">
                    <div class="fill"></div>
                  </div>
                  <div class="mask half">
                    <div class="fill"></div>
                  </div>
                  <div class="inside-circle">73%</div>
                </div>
              </div>
              </div>
            </div>
          </div>-->

          <div class="clearfix"></div>
        </div>
      </div>
 
</body>
</html>