<?php
session_start();

    require_once 'connection.php';
    include 'functions.php';
    require 'phpmailer/includes/PHPMailer.php';
    require 'phpmailer/includes/SMTP.php';
    require 'phpmailer/includes/Exception.php';
    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    function send_password_reset($get_email, $otp){
        $mail = new PHPMailer(true);
    
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        
        $mail->Host = "smtp.gmail.com";
        $mail->Username   = "grccinema@gmail.com";                  //SMTP username
        $mail->Password   = "fkfofaznutdnfoux";                     //SMTP password
        
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
        $mail->addAddress($get_email);                              //Name is optional

        $mail->isHTML(true);
        $mail->Subject = "Reset Password Notification";
        
        $email_template = "
            <h3>Hello</h3>
            <p>You are receiving this email because we received a password reset request from your account.</p>
            <br/><br/>
            <p>OTP: <b>$otp</b></p>
        ";
        
        $mail->Body = $email_template;
        $mail->send();
        $mail->smtpClose();
    }
    
    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $otp = random_otp(6);
        
        $check_email = "SELECT email FROM users WHERE email = '$email' LIMIT 1";
        $check_email_run = mysqli_query($con, $check_email);
        
        if(mysqli_num_rows($check_email_run) > 0){
            $row = mysqli_fetch_array($check_email_run);
            $get_email = $row['email'];
            
            $update_otp = "UPDATE users SET OTP = '$otp' WHERE email = '$get_email' LIMIT 1";
            $update_otp_run = mysqli_query($con, $update_otp);
            
            if($update_otp_run){
                send_password_reset($get_email, $otp);
                $_SESSION['email'] = $email;
                $_SESSION['status'] = "We e-mailed you a password reset link";
                header("Location: OTP.php");
                exit(0);
            }
            else{
                $_SESSION['status'] = "No Email Found!";
                header("Location: forget_password.php");
                exit(0);
            }
        }
        else{
            $_SESSION['status'] = "No Email Found!";
            header("Location: forget_password.php");
            exit(0);
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
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="css/forget_password.css" rel="stylesheet" type="text/css"/>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;900&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;900&family=Tilt+Neon&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;700;900&display=swap');
        </style>
        <title>GRC Cinema</title>
    </head>
    <body>
        <div class="container">
            <form action="forget_password.php" method="post" id="form-1">
                <div class="heading">
                    <button class="back-btn"><a href="sign_in.php">&larr;</a></button>
                    <h1>Forgot Password</h1>
                </div>
                <p>Please enter your registered email address and we will send you an OTP to reset your password</p>
                <div class="psd-reset">
                    <input type="text" id="email" name="email" required />
                    <label for="email">Email Address<span class="star">*</span></label>
                    <div id="error-message-1"></div>
                </div>
                
                <div class="submit-btn">
                    <a href="sign_in.php">BACK</a>
                    <input type="submit" name="submit" value="SENT RESET EMAIL">
                </div>
            </form>
        </div>
    </body>
</html>
