<?php
require_once 'connection.php';

    require 'phpmailer/includes/PHPMailer.php';
    require 'phpmailer/includes/SMTP.php';
    require 'phpmailer/includes/Exception.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    function send_email_verify($email, $verify_token){
        $mail = new PHPMailer(true);
    
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        
        $mail->Host = "smtp.gmail.com";
        $mail->Username   = "grccinema@gmail.com";                  //SMTP username
        $mail->Password   = "pednlnnxjuicxatn";                     //SMTP password
        
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        // 配置 SSL/TLS 上下文选项
        $context = stream_context_get_default([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ]
        ]);

        // 设置 SMTP 选项
        $mail->SMTPOptions = [
            'ssl' => $context,
            'tls' => $context,
        ];

        //Recipients
        $mail->setFrom('grccinema@gmail.com');
        $mail->addAddress($email);                                 //Name is optional

        $mail->isHTML(true);
        $mail->Subject = "Email Verification from GRC Cinema";
        
        $email_template = "
            <h2>You have Registered with GRC Cinema</h2>
            <h5>Verify your email address to Login with the below given link</h5>
            <br/><br/>
            <a href='http://localhost/GRC/verify_email.php?token=$verify_token'>Activate</a>
        ";
        
        $mail->Body = $email_template;
        $mail->send();
        $mail->smtpClose();
    }

    if(isset($_POST['submit'])){
        // something was posted
        $user_name = $_POST['user-name'];
        $email = $_POST['email'];
        $email_pattern = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $password = $_POST['psd'];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $password_pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()\-_=+{};:,.<>§~\|\/?]).{8,}$/';
        $confirm_password = $_POST['confirm-psd'];
        $verify_token = md5(rand());
    
    // check if username is already taken 
    if ($user_name) {
        $uname = $con->prepare("SELECT * FROM users WHERE user_name = ? LIMIT 1");
        $uname->bind_param("s", $user_name);
        $uname->execute();
        $run = $uname->get_result();
        if ($run && $run->num_rows > 0) {
            $error_message_1 = "The username is already taken.";
        } 
        else{
            $error_message_1 = ""; 
        }
    }
    
    // check whether email entered is validity or not
    if ($email) {
        if (preg_match($email_pattern, $email)) {
            // check if mobile phone is already taken
            $mail = $con->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
            $mail->bind_param("s", $email);
            $mail->execute();
            $result = $mail->get_result();
            if ($result && $result->num_rows > 0) {
                $error_message_2 = "The email address is already taken.";
            }
            else{
                $error_message_2 = "";
            }
        }
        else {
            $error_message_2 = "The email address pattern is incorrect.";
        }
    }
    
    // check whether password entered is validity or not
    if ($password) {
        if (preg_match($password_pattern, $password) == 0) {
            $error_message_3 = "Please refer to the below password policy.";
        }
        else{
            $error_message_3 = "";
        }
    }

    // check whether the confirm password is same as the password or not
        if ($confirm_password) {
            if ($confirm_password !== $password) {
                $error_message_4 = "The password do not match.";
            }
            else{
                $error_message_4 = "";
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
        <link href="css/sign_up.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="js/sign_up.js" type="text/javascript"></script>
        <script src="https://kit.fontawesome.com/8d6dbf3dd8.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;900&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;900&family=Tilt+Neon&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;900&display=swap');
        </style>
        <title>GRC Cinema</title>
    </head>
    
    <body>       
        <div id="container">
            <div class="title">
                <div class="icons">
                    <img src="images/add-user.png" alt="" width="50px" height="50px" />
                </div>
                <h1 class="form-title">Sign Up</h1>
            </div>
            
            <form action="sign_up.php" method="post" id="signup-form">
                <div class="row-1">
                    <div class="info">
                        <input type="text" id="user-name" name="user-name" required value="<?php if(!isset($user_name)){ 
                                                                                echo "";                                                                       
                                                                            }
                                                                            else{
                                                                                echo $user_name;                                                                                   
                                                                            } ?>" />
                        <label for="user-name">User Name<span class="star">*</span></label>
                        <i class="fa-regular fa-user"></i>
                        <div id="error_message_1"></div>
                    </div>               
                    
                    <div class="info">
                        <input type="text" id="email" name="email" required value="<?php if(!isset($email)){ 
                                                                                echo "";                                                                       
                                                                            }
                                                                            else{
                                                                                echo $email;                                                                                   
                                                                            } ?>" />
                        <label for="email">Email Address<span class="star">*</span></label>
                        <i class="fa-solid fa-phone"></i>
                        <div id="error_message_2"></div>
                    </div>
                </div>
                
                <div class="row-2">
                    <div class="info">
                        <input type="password" id="psd" name="psd" required />
                        <label for="psd">Password<span class="star">*</span></label>
                        <div id="error_message_3"></div>
                    </div>
                    
                    <div class="info">
                        <input type="password" id="confirm-psd" name="confirm-psd" required />
                        <label for="confirm-psd">Confirm Password<span class="star">*</span></label>
                        <div id="error_message_4"></div>
                    </div>
                </div>
                
                <div id="psd-requirements">
                    <p>Password must contain the following:</p>
                    <div id="letter" class="invalid">A <span class="requirement">lowercase</span> letter</div>
                    <div id="capital" class="invalid">A <span class="requirement">capital (uppercase)</span> letter</div>
                    <div id="number" class="invalid">A <span class="requirement">number</span> and a <span class="requirement">symbol</span></div>
                    <div id="length" class="invalid">Minimum <span class="requirement">8 characters</span></div>
                </div>
                
                <div class="row-3">
                    <div class="form-submit">
                        <input type="submit" name="submit" id="btnSubmit" value="SIGN UP" />
                    </div>
                    
                    <div class="sign-in">
                        <div>Already Member?</div>
                        <a href="sign_in.php" id="signin-btn">Sign In</a>
                    </div>
                </div>
            </form>
        </div>
        
        <script type="text/javascript">
            document.getElementById("user-name").addEventListener("blur", checkUserName);
            document.getElementById("email").addEventListener("blur", checkEmail);
            document.getElementById("email").addEventListener("input", checkEmail);
            document.getElementById("psd").addEventListener("blur", checkPsd);
            document.getElementById("psd").addEventListener("input", checkPsd);
            document.getElementById("psd").addEventListener("keyup", display);
            document.getElementById("confirm-psd").addEventListener("blur", checkConfirmPsd);    
            document.getElementById("confirm-psd").addEventListener("input", checkConfirmPsd);     
        </script>
        
        <?php        
        // If the validation is successful 
        if(isset($_POST['submit'])){
            if (!empty($error_message_1) || !empty($error_message_2) || !empty($error_message_3) || !empty($error_message_4)) {
                echo "<script type='text/JavaScript'>;
                        document.getElementById('error_message_1').innerText = '{$error_message_1}';
                        document.getElementById('error_message_2').innerText = '{$error_message_2}';
                        document.getElementById('error_message_3').innerText = '{$error_message_3}';
                        document.getElementById('error_message_4').innerText = '{$error_message_4}';
                    </script>";
            }
            else{
                // save user to database
                $current_date = date('Y-m-d');
                send_email_verify($email, $verify_token);
                echo "<script>alert('Registration Successful. We have sent you an email. PLease ACTIVATE it!');</script>";
                $query = $con->prepare("INSERT INTO users (user_name,email,password,verify_token,join_date) VALUES (?, ?, ?, ?, ?)");
                $query->bind_param("sssss", $user_name, $email, $password_hash, $verify_token, $current_date);
                $query->execute();
                echo "<script type='text/JavaScript'>window.location.href='sign_in.php';</script>";   
            }        
        }
        ?>
    </body>
</html>