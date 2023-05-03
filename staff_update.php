<?php
    include 'con_db.php';
    
    $id = $_GET['updateid'];
    
    $sql = "SELECT * FROM staff_account WHERE staff_id=$id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    
    $name = $row['staff_name'];
    $email = $row['staff_email'];
    $phone = $row['staff_phone'];
    $password = $row['staff_password'];
    
    
    if(isset($_POST['submit'])){
  
        $name= trim($_POST['name']);
        $email= trim($_POST['email']);
        $phone= trim($_POST['phone']);
        $password= trim($_POST['password']);
    
    
    $sql = "UPDATE staff_account SET staff_id=$id, staff_name='$name', staff_email='$email',staff_phone='$phone',staff_password='$password' WHERE staff_id=$id ";
    
    $result = mysqli_query($con, $sql);
    
    if($result){
        header("location:staff_detail.php");
    }else{
        die(mysqli_error($con));
    }
 }
 
    
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GRC Cinema</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="js/admin_dashboard.js" type="text/javascript"></script>
  <link href="css/staff_update.css" rel="stylesheet" type="text/css"/>
</head>
<body>
    
    <div id="sidebar" class="sidebar">
          <p class="logo"><span>G</span>RC</p>
          <a href="admin_dashboard.html" class="icon-a"><i class="fa fa-dashboard icons"></i>&nbsp;&nbsp;Dashboard</a>
          <a href="#" class="icon-a"><i class="fa fa-users icons"></i>&nbsp;&nbsp;Customers</a>
          <a href="#" class="icon-a"><i class=" fa fa-light fa-ticket icons"></i>&nbsp;&nbsp;Orders</a>
          <a href="#" class="icon-a"><i class="fa fa-solid fa-film icons"></i>&nbsp;&nbsp;Movie</a>
          <a href="#" class="icon-a"><i class="fa fa-thin fa-couch icons"></i>&nbsp;&nbsp;Seat </a>
          <a href="staff_detail.php" class="icon-a"><i class="fa fa-user icons"></i>&nbsp;&nbsp;Accounts</a>
          <a href="#" class="icon-a"><i class="fa fa-list-alt icons"></i>&nbsp;&nbsp;Tasks</a>
          <a href="#" class="icon-a"><i class="fa-solid fa-bell fa-shake fa-lg icons"></i>&nbsp;&nbsp;Notice</a>
          <a href="#" class="icon-a"><i class="fa-solid fa-right-from-bracket icons"></i>&nbsp;&nbsp;Log Out</a>
      </div>

      <div id="main">
        <div class="head"> 
          <div class="col-div-6"></div>
            <span onclick="dashboard()" class="nav" style="font-size: 30px;cursor: pointer; color: white;">&#9776; Update Account</span>
            <span onclick="dashboard2()" class="nav2" style="font-size: 30px;cursor: pointer; color: white;">&#9776; Update Account</span>

          <div class="col-div-6"></div>
          <div class="profile">
              <img src="img/baby.jpg" class="pro-img"  alt="">
            <p >Baby Boss <span>President</span></p>
          </div>

          <div class="clearfix"></div>

          
          <div class="col-div-8">
            <div class="box-8">
              <div class="content-box">
                  <p>Updating Staff Account </p>
                <br>
                
                
                <form method="POST">
                <table>
                    <tr>      
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" autocomplete="off" value=<?php echo $name;?>>
                  </tr>
                  <br>
                  <tr>
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter your email" autocomplete="off" value=<?php echo $email; ?>>
                  </tr>
                  <br>
                  <tr>
                  <label>Mobile number</label>
                  <input type="text" name="phone" class="form-control" placeholder="Enter your mobile number" autocomplete="off" value=<?php echo $phone; ?>>
                  </tr>
                  <br>
                  <tr>
                  <label>Password</label>
                  <input type="text" name="password" class="form-control" placeholder="Enter your password" value=<?php echo $password; ?>>
                  </tr>
                  <br>
                </table>
                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
            </form>
              </div>
            </div>
          </div>

        </div>
      </div>
   
  
</body>
</html>