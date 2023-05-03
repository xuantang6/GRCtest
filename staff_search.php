<?php
include 'con_db.php';
?>

<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>GRC Cinema</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link href="css/staff_search.css" rel="stylesheet" type="text/css"/>
        <script src="js/admin_dashboard.js" type="text/javascript"></script>
    </head>
    <body>
        <?php
      include'C:\xampp\htdocs\GRC\sidebar_detail.php'
      ?>
        
        <div id="main">
        <div class="head"> 
          <div class="col-div-6"></div>
            <span onclick="dashboard()" class="nav" style="font-size: 30px;cursor: pointer; color: white;">&#9776; Accounts</span>
            <span onclick="dashboard2()" class="nav2" style="font-size: 30px;cursor: pointer; color: white;">&#9776; Accounts</span>

          <div class="col-div-6"></div>
          <div class="profile">
              <img src="img/baby.jpg" class="pro-img"  alt="">
            <p >Baby Boss <span>President</span></p>
          </div>

          <div class="clearfix"></div>


          <div class="col-div-8">
            <div class="box-8">
              <div class="content-box">

                <form action="staff_search.php" method="POST"> 
                    <p>Staff Accounts 
                        <span style="cursor: pointer"><button class="btn btn-outline-info "><a  href="staff_add.php" class="text-light" >Add User</a></button></span>
                        <span><button class="btn btn-outline-light btnsearch" name="submit">Search</button></span>
                        <span><input type="text" placeholder="Search..."  name="search" class="iptsearch" autocomplete="off" value=<?php echo $_POST['search'];?> ></span>
                    </p>
              </form>
                <br>
                <table>
                    
                    
                  <?php
                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];
                        $sql = "SELECT * FROM staff_account WHERE staff_name LIKE '%$search%' OR staff_id LIKE'%$search%' OR staff_email LIKE'%$search%' OR staff_phone LIKE'%$search%'";
                        $result = mysqli_query($con,$sql);
                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                echo '
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Operations</th>
                                    </tr>';
                                  
                                while($row= mysqli_fetch_assoc($result)){
                                    
                                
                                $id=$row['staff_id'];
                                $name=$row['staff_name'];
                                $email=$row['staff_email'];
                                $phone=$row['staff_phone'];
                                $password=$row['staff_password'];
                                printf("<tr>
                                        <th scope='row'>%d</th>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>%s</td>
                                        <td>
                                        <button class=' btn btn-outline-primary'> <a class='text-light' href='staff_update.php?updateid=%d'>Update</a></button>
                                        <button class='btn btn-outline-danger'> <a class='text-light' href='staff_delete.php?deleteid=%d'>Delete</a></button>
                                        </td>
                                        </tr>",$id,$name,$email,$phone,$password,$id,$id);
                                }
                                
                               }else{
                                echo"<p class='text-danger' >Data Not Found!</p>";
                            }
                                    
                            } 
                        }
                    
                    ?>
                  
                </table>
              </div>
            </div>
          </div>
          
          <div class="clearfix"></div>
          
        </div>
      </div>
<!--                <div class="container">
                <table class="table">
                    
                    //<?php
//                    if(isset($_POST['submit'])){
//                        $search = $_POST['search'];
//                        
//                        $sql = "SELECT * FROM staff_account WHERE staff_name LIKE '%$search%' OR staff_id LIKE'%$search%' OR staff_email LIKE'%$search%' OR staff_phone LIKE'%$search%'";
//                        $result = mysqli_query($con,$sql);
//                        if($result){
//                            if(mysqli_num_rows($result) > 0){
//                                echo '
//                                    <tr>
//                                    <th scope="col">#</th>
//                                    <th scope="col">Name</th>
//                                    <th scope="col">Email</th>
//                                    <th scope="col">Phone</th>
//                                    <th scope="col">Password</th>
//                                    <th scope="col">Operations</th>
//                                    </tr>';
//                                  
//                                while($row= mysqli_fetch_assoc($result)){
//                                    
//                                
//                                $id=$row['staff_id'];
//                                $name=$row['staff_name'];
//                                $email=$row['staff_email'];
//                                $phone=$row['staff_phone'];
//                                $password=$row['staff_password'];
//                                printf("<tr>
//                                        <th scope='row'>%d</th>
//                                        <td>%s</td>
//                                        <td>%s</td>
//                                        <td>%s</td>
//                                        <td>%s</td>
//                                        <td>
//                                        <button class=' btn btn-outline-primary'> <a class='text-light' href='staff_update.php?updateid=%d'>Update</a></button>
//                                        <button class='btn btn-outline-danger'> <a class='text-light' href='staff_delete.php?deleteid=%d'>Delete</a></button>
//                                        </td>
//                                        </tr>",$id,$name,$email,$phone,$password,$id,$id);
//                                }
//                                
//                               }else{
//                                echo'Data Not Found!';
//                            }
//                                    
//                            } 
//                        }
//                    
//                    ?>
                </table>
            </div>
        </div>-->
    </body>
</html>
