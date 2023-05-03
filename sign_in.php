<?php
session_start();

    require_once 'connection.php';

    if(isset($_COOKIE['username'])&& isset($_COOKIE['password'])){
        $uname = $_COOKIE['username'];
        $psd = $_COOKIE['password'];
    }
    else{
        $uname = "";
        $psd = "";
    }
    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // something was posted
        $user_name = $_POST['user-name'];
        $password = $_POST['psd'];
        
        $sql = $con->prepare("SELECT password, user_id FROM users WHERE user_name = ? LIMIT 1");
        $sql->bind_param("s", $user_name);
        $sql->execute();
        $sql->bind_result($hashed_password, $user_id);
        $sql->fetch();
        $sql->close();
        
        // verify the password
        $password_verify = password_verify($password, $hashed_password);
       
        // read from database
        if($hashed_password !== false && $password_verify){
            $stmt = $con->prepare("SELECT * FROM users WHERE user_name = ? LIMIT 1");
            $stmt->bind_param("s", $user_name);
            $stmt->execute();
            $result = $stmt->get_result();
        
            if($result){
                if($result && $result->num_rows > 0){
                    $user_data = mysqli_fetch_assoc($result);
                    if($user_data['user_type'] == "user"){
                        $_SESSION['user_id'] = $user_data['user_id'];
                        // to set cookie
                        if(isset($_POST['remember'])){
                            setcookie('username', $user_name, time()+60*60); // current time + (60sec * 60sec)
                            setcookie('password', $password, time()+60*60);  // current time + (60sec * 60sec)
                        }
                        // to expire cookie
                        else{
                            setcookie('username', $user_name, time()-10);    // current time - 10 sec
                            setcookie('password', $password, time()-10);     // current time - 10 sec
                        }
                        
                        if($user_data['verify_status'] == "1"){
                            header("Location: captcha.php");
                            exit;
                        }
                        else{
                            $_SESSION['status'] = "Please Verify your Email Address to Login";
                            $_SESSION['resendmail'] = "Do you want to resend the Verification Email?";
                            header("Location: sign_in.php");
                            exit(0);
                        }
                    }
                    else{
                        header("Location: admin_dashboard.php");
                        exit;
                    }
                }  
            }   
        }  
    }
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
        <link href="css/3D_Carousel_Slider.css" rel="stylesheet" type="text/css"/>
        <link href="css/sign_in.css" rel="stylesheet" type="text/css"/>
        <script src="js/sign_in.js" type="text/javascript"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;900&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;900&family=Tilt+Neon&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700;900&display=swap');
        </style>
        <title>GRC Cinema</title>
    </head>
    <body>
        <?php    
            if(isset($_SESSION['status']) && isset($_SESSION['resendmail'])){
                echo "<script>";
                echo "if(confirm('" . $_SESSION['status'] . "\\n" . $_SESSION['resendmail'] . "')){
                        window.location.href = 'resend_verification_email.php';
                      }
                      else{
                        window.location.href = 'sign_in.php';
                      }";
                echo "</script>";
                unset($_SESSION['status']);
                unset($_SESSION['resendmail']);
            }
            else{
                echo "<script>";
                echo "alert('" . $_SESSION['status'] . "')";
                echo "</script>";
                unset($_SESSION['status']);
            }
        ?>
        <div id="container">          
            <div class="box">
                <section class="slideshow" id="slider">
                    <input type="radio" name="slider" id="s1">
                    <input type="radio" name="slider" id="s2">
                    <input type="radio" name="slider" id="s3" checked>
                    <input type="radio" name="slider" id="s4">
                    <input type="radio" name="slider" id="s5">                    
       
                    <label for="s1" id="slide1">
                        <img src="images/Spirited_Away.png" alt="" width="100%" height="100%" />
                    </label>
                                
                    <label for="s2" id="slide2">
                        <img src="images/Anthem_of_the_Heart.png" alt="" width="100%" height="100%" />
                    </label>
                                
                    <label for="s3" id="slide3">
                        <img src="images/Suzume.png" alt="" width="100%" height="100%" />
                    </label>
                                
                    <label for="s4" id="slide4">
                        <img src="images/Summer_August.png" alt="" width="100%" height="100%" />
                    </label>
                                
                    <label for="s5" id="slide5">
                        <img src="images/After_the_Rain.png" alt="" width="100%" height="100%" />
                    </label>                                       
                </section>  
                <div class="form">
                    <form action="sign_in.php" method="post" id="signin_form">
                        <h1>Welcome back!</h1>
                        <div class="info">
                            <input type="text" id="user-name" name="user-name" value="<?php echo $uname; ?>" required />
                            <label for="user-name">User Name<span class="star">*</span></label>
                            <div id="error-message-1"></div>
                        </div>               
                    
                        <div class="info">
                            <input type="password" id="psd" name="psd" value="<?php echo $psd; ?>" required />
                            <label for="psd">Password<span class="star">*</span></label>
                            <div id="error-message-2"></div>
                        </div>
                        
                        <div class="checkbox">
                            <input id="remember" type="checkbox" name="remember" />
                            <label for="remember">Remember Me</label>
                            <a href="forget_password.php">Forgot Password?</a>
                        </div>                             
                        
                        <div class="form-submit">
                            <input type="submit" value="SIGN IN" />
                        </div>
                        
                        <div class="signup-btn">
                            <div>New to <b>GRC?</b></div>
                            <a href="sign_up.php">JOIN NOW</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <script type="text/javascript">
            document.getElementById("user-name").addEventListener("blur", checkUserName);
            document.getElementById("psd").addEventListener("blur", checkPsd);
            document.getElementById("psd").addEventListener("input", checkPsd);
        </script>
    </body>
</html>
