<?php
    include 'con_db.php';
    
    if(isset($_POST['submit'])){
        $name= trim($_POST['name']);
        $email= trim($_POST['email']);
        $phone= trim($_POST['phone']);
        $password= trim($_POST['password']);
    
    
    $sql = "INSERT INTO staff_account (staff_name,staff_email,staff_phone,staff_password) VALUES('$name','$email','$phone','$password')";
    
    $result = mysqli_query($con, $sql);
    
    if($result){
        header('location:staff_detail.php');
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
  <title>Staff</title>
  <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  
  <link href="css/staff_add.css" rel="stylesheet" type="text/css"/>
  <script src="js/admin_dashboard.js" type="text/javascript"></script>
  
</head>
<body>
<?php
      include'C:\xampp\htdocs\GRC\sidebar_detail.php'
      ?>
      <div id="main">
        <div class="head"> 
          <div class="col-div-6"></div>
          
            <span onclick="dashboard()" class="nav" style="font-size: 30px;cursor: pointer; color: white;">&#9776; Adding Account</span>
            <span onclick="dashboard2()" class="nav2" style="font-size: 30px;cursor: pointer; color: white;">&#9776; Adding Account</span>

          <div class="col-div-6"></div>
          <div class="profile">
              <img src="img/baby.jpg" class="pro-img"  alt="">
            <p >Baby Boss <span>President</span></p>
          </div>

          <div class="clearfix"></div>

          

          <div class="col-div-8">
            <div class="box-8">
              <div class="content-box">
                  <p>Adding Staff Account </p>
                <br>
                <form method="POST">
                <table>
                    <tr>      
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name" autocomplete="off">
                    
                  </tr>
                  <br>
                  <tr>
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email" autocomplete="off">
                  </tr>
                  <br>
                  <tr>
                    <label>Mobile number</label>
                    <input type="text" name="phone" class="form-control" placeholder="012-3456-7890" autocomplete="off" pattern="[0-9]{3}-[0-9]{4}-[0-9]{3,4}">
                  </tr>
                  <br>
                  <tr>
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                  </tr>
                  <br>
                </table>
                    <button type="submit" class="btn btn-primary" name="submit" >Submit</button>
 </form>
              </div>
            </div>
          </div>

        </div>
      </div>
</body>
</html>